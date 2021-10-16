<?php

namespace SpaceCode\GoDesk\Services;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SpaceCode\GoDesk\Events\FileRemoved;
use SpaceCode\GoDesk\Events\FileUploaded;
use SpaceCode\GoDesk\Events\FolderRemoved;
use SpaceCode\GoDesk\Events\FolderUploaded;
use SpaceCode\GoDesk\Exceptions\InvalidConfig;
use InvalidArgumentException;

class FileManagerService
{
    use GetFiles;

    /**
     * @var mixed
     */
    protected $storage;

    /**
     * @var mixed
     */
    protected $disk;

    /**
     * @var mixed
     */
    protected $currentPath;

    /**
     * @var mixed
     */
    protected $exceptFiles;

    /**
     * @var mixed
     */
    protected $exceptFolders;

    /**
     * @var mixed
     */
    protected $exceptExtensions;

    /**
     * @var AbstractNamingStrategy
     */
    protected $namingStrategy;

    /**
     * @throws InvalidConfig
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->disk = config('godesk.filemanager.disk', 'public');
        $this->exceptFiles = collect([]);
        $this->exceptFolders = collect([]);
        $this->exceptExtensions = collect([]);
        $this->globalFilter = null;

        try {
            $this->storage = Storage::disk($this->disk);
        } catch (InvalidArgumentException $e) {
            throw InvalidConfig::driverNotSupported();
        }
        $this->namingStrategy = app()->makeWith(
            DefaultNamingStrategy::class,
            ['storage' => $this->storage]
        );
    }

    /**
     * @param Request $request
     * @param false $filter
     * @return JsonResponse
     * @throws Exception
     */
    public function ajaxGetFilesAndFolders(Request $request, $filter = false)
    {
//        $folder = $this->cleanSlashes($request->get('folder'));
//        if (! $this->folderExists($folder)) {
//            $folder = '/';
//        }
        $folder = $request->get('folder');
        $folder = $this->cleanSlashes($folder);
        $this->setRelativePath($folder);
        $order = $request->get('sort');
        if (! $order) {
            $order = config('godesk.filemanager.order', 'mime');
        }
        $filter = $request->get('filter', config('godesk.filemanager.filter', false));
        $files = $this->getFiles($folder, $order, $filter);
        $filters = $this->getAvailableFilters($files);
        $parent = (object) [];
        if ($files->count() > 0) {
            $folders = $files->filter(function ($file) {
                return $file->type == 'dir';
            });
            if ($folder !== '/') {
                $parent = $this->generateParent($folder);
            }
        }
        return response()->json([
            'files'   => $files,
            'path'    => $this->getPaths($folder),
            'filters' => $filters,
            'buttons' => $this->getButtons(),
            'parent'  => $parent,
        ]);
    }

    /**
     * @param $folder
     * @param $currentFolder
     * @return JsonResponse
     */
    public function createFolderOnPath($folder, $currentFolder)
    {
        $folder = $this->fixDirname($this->fixFilename($folder));
        $path = $currentFolder.'/'.$folder;
        if ($this->storage->has($path)) {
            return response()->json(['error' => __('The folder exist in current path')]);
        }
        if ($this->storage->makeDirectory($path)) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    /**
     * @param $path
     * @return JsonResponse
     */
    public function deleteDirectory($path)
    {
        if ($this->storage->deleteDirectory($path)) {
            event(new FolderRemoved($this->storage, $path));
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    /**
     * @param $file
     * @param $currentFolder
     * @param $visibility
     * @param false $uploadingFolder
     * @param array $rules
     * @return JsonResponse
     * @throws ValidationException
     */
    public function uploadFile($file, $currentFolder, $visibility, $uploadingFolder = false, array $rules = [])
    {
        if (count($rules) > 0) {
            $pases = Validator::make(['file' => $file], [
                'file' => $rules,
            ])->validate();
        }
        $fileName = $this->namingStrategy->name($currentFolder, $file);
        if ($this->storage->putFileAs($currentFolder, $file, $fileName)) {
            $this->setVisibility($currentFolder, $fileName, $visibility);
            if (! $uploadingFolder) {
                $this->checkJobs($this->storage, $currentFolder.$fileName);
                event(new FileUploaded($this->storage, $currentFolder.$fileName));
            }
            return response()->json(['success' => true, 'name' => $fileName]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * @param $file
     * @return JsonResponse
     */
    public function downloadFile($file)
    {
        if (! config('godesk.filemanager.buttons.download_file')) {
            return response()->json(['success' => false, 'message' => __('File not available for Download')], 403);
        }
        if ($this->storage->has($file)) {
            return $this->storage->download($file);
        } else {
            return response()->json(['success' => false, 'message' => __('File not found')], 404);
        }
    }

    /**
     * @param $file
     * @return JsonResponse
     */
    public function getFileInfo($file)
    {
        $fullPath = $this->storage->path($file);
        try {
            $info = new NormalizeFile($this->storage, $fullPath, $file);
            return response()->json($info->toArray());
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * @param $file
     * @return array|mixed
     */
    public function getFileInfoAsArray($file)
    {
        if (! $this->storage->exists($file)) {
            return [];
        }
        $fullPath = $this->storage->path($file);
        $info = new NormalizeFile($this->storage, $fullPath, $file);
        return $info->toArray();
    }

    /**
     * @param $file
     * @return JsonResponse
     */
    public function removeFile($file)
    {
        if ($this->storage->delete($file)) {
            event(new FileRemoved($this->storage, $file));
            return response()->json(true);
        }
        return response()->json(false);
    }

    /**
     * @param $file
     * @param $newName
     * @return JsonResponse
     */
    public function renameFile($file, $newName)
    {
        $path = str_replace(basename($file), '', $file);
        try {
            if ($this->storage->move($file, $path.$newName)) {
                $fullPath = $this->storage->path($path.$newName);
                $info = new NormalizeFile($this->storage, $fullPath, $path.$newName);
                return response()->json(['success' => true, 'data' => $info->toArray()]);
            }
            return response()->json(false);
        } catch (Exception $e) {
            $directories = $this->storage->directories($path);
            if (in_array($file, $directories)) {
                return $this->renameDirectory($file, $newName);
            }
            return response()->json(false);
        }
    }

    /**
     * @param $dir
     * @param $newName
     * @return JsonResponse
     */
    protected function renameDirectory($dir, $newName)
    {
        $path = str_replace(basename($dir), '', $dir);
        $newDir = $path.$newName;
        if ($this->storage->exists($newDir)) {
            return response()->json(false);
        }
        $this->storage->makeDirectory($newDir);
        $files = $this->storage->files($dir);
        $directories = $this->storage->directories($dir);
        $dirNameLength = strlen($dir);
        foreach ($directories as $subDir) {
            $subDirName = substr($dir, $dirNameLength);
            array_push($files, ...$this->storage->files($subDir));

            if (! Storage::exists($newDir.$subDirName)) {
                $this->storage->makeDirectory($newDir.$subDirName);
            }
        }
        $copiedFileCount = 0;
        foreach ($files as $file) {
            $filename = substr($file, $dirNameLength);
            $this->storage->copy($file, $newDir.$filename) === true ? $copiedFileCount++ : null;
        }
        if ($copiedFileCount === count($files)) {
            $this->storage->deleteDirectory($dir);
        }
        $fullPath = $this->storage->path($newDir);
        $info = new NormalizeFile($this->storage, $fullPath, $newDir);
        return response()->json(['success' => true, 'data' => $info->toArray()]);
    }

    /**
     * @param $oldPath
     * @param $newPath
     * @return JsonResponse
     */
    public function moveFile($oldPath, $newPath)
    {
        if ($this->storage->move($oldPath, $newPath)) {
            return response()->json(['success' => true]);
        }
        return response()->json(false);
    }

    /**
     * @param $path
     * @return JsonResponse
     */
    public function folderUploadedEvent($path)
    {
        event(new FolderUploaded($this->storage, $path));
        return response()->json(['success' => true]);
    }

    /**
     * @param $folder
     * @return bool
     */
    private function folderExists($folder)
    {
        $directories = $this->storage->directories(dirname($folder));
        $directories = collect($directories)->map(function ($folder) {
            return basename($folder);
        });
        return in_array(basename($folder), $directories->toArray());
    }

    /**
     * @param $folder
     * @param $file
     * @param $visibility
     */
    private function setVisibility($folder, $file, $visibility)
    {
        if ($folder != '/') {
            $folder .= '/';
        }
        $this->storage->setVisibility($folder.$file, $visibility);
    }

    /**
     * @param $files
     * @return array
     */
    private function getAvailableFilters($files)
    {
        $filters = config('godesk.filemanager.filters', []);
        if (count($filters) > 0) {
            return collect($filters)->filter(function ($extensions) use ($files) {
                foreach ($files as $file) {
                    if (in_array($file->ext, $extensions)) {
                        return true;
                    }
                }
                return false;
            })->toArray();
        }

        return [];
    }

    /**
     * @return Repository|Application|mixed
     */
    private function getButtons()
    {
        return config('godesk.filemanager.buttons', [
            'create_folder'   => true,
            'upload_button'   => true,
            'select_multiple' => true,
            'upload_drag'     => true,
            'rename_folder'   => true,
            'delete_folder'   => true,
            'rename_file'     => true,
            'delete_file'     => true,
        ]);
    }

    /**
     * @param $storage
     * @param $filePath
     */
    private function checkJobs($storage, $filePath)
    {
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $availableJobs = collect(config('godesk.filemanager.jobs', []));
        if (count($availableJobs)) {
            $filters = config('godesk.filemanager.filters', []);
            $filters = array_change_key_case($filters);
            $find = collect($filters)->filter(function ($extensions, $key) use ($ext) {
                if (in_array($ext, $extensions)) {
                    return true;
                }
            });
            $filterFind = array_key_first($find->toArray());
            if ($jobClass = $availableJobs->get($filterFind)) {
                $job = new $jobClass($storage, $filePath);
                if ($customQueue = config('godesk.filemanager.queue_name')) {
                    $job->onQueue($customQueue);
                }
                app(Dispatcher::class)->dispatch($job);
            }
        }
    }
}
