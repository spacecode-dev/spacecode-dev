<?php

namespace SpaceCode\GoDesk\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use SpaceCode\GoDesk\Services\FileManagerService;
use Laravel\Nova\Http\Requests\NovaRequest;

class FilemanagerToolController extends Controller
{
    /**
     * @var mixed
     */
    protected $service;

    /**
     * @param FileManagerService $filemanagerService
     */
    public function __construct(FileManagerService $filemanagerService)
    {
        $this->service = $filemanagerService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getData(Request $request)
    {
        return $this->service->ajaxGetFilesAndFolders($request);
    }

    /**
     * @param $resource
     * @param $attribute
     * @param NovaRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getDataField($resource, $attribute, NovaRequest $request)
    {
        return $this->service->ajaxGetFilesAndFolders($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createFolder(Request $request)
    {
        return $this->service->createFolderOnPath($request->get('folder'), $request->get('current'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteFolder(Request $request)
    {
        return $this->service->deleteDirectory($request->get('current'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function upload(Request $request)
    {
        $uploadingFolder = $request->get('folder') ?? false;

        return $this->service->uploadFile(
            $request->file,
            $request->get('current') ?? '',
            $request->get('visibility'),
            $uploadingFolder,
            $this->getRules($request->get('rules'))
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function move(Request $request)
    {
        return $this->service->moveFile($request->get('old'), $request->get('path'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getInfo(Request $request)
    {
        return $this->service->getFileInfo($request->file);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removeFile(Request $request)
    {
//        return $this->service->removeFile($request->file, $request->type);
        return $this->service->removeFile($request->file);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function renameFile(Request $request)
    {
        return $this->service->renameFile($request->file, $request->get('name'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function downloadFile(Request $request)
    {
        return $this->service->downloadFile($request->file);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function rename(Request $request)
    {
        return $this->service->renameFile($request->get('path'), $request->get('name'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function folderUploadedEvent(Request $request)
    {
        return $this->service->folderUploadedEvent($request->get('path'));
    }

    /**
     * @param $rules
     * @return mixed
     */
    private function getRules($rules)
    {
        return json_decode($rules);
    }
}
