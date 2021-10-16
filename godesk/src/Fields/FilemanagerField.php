<?php

namespace SpaceCode\GoDesk\Fields;

use Closure;
use Illuminate\Validation\Rule;
use SpaceCode\GoDesk\Services\FileManagerService;
use SpaceCode\GoDesk\Traits\CoverHelpers;
use Laravel\Nova\Contracts\Cover;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class FilemanagerField extends Field implements Cover
{
    use CoverHelpers;

    /**
     * @var string
     */
    public $component = 'filemanager-field';

    /**
     * @var array
     */
    public $uploadRules = [];

    /**
     * @var bool
     */
    protected $createFolderButton;

    /**
     * @var bool
     */
    protected $uploadButton;

    /**
     * @var bool
     */
    protected $dragAndDropUpload;

    /**
     * @var bool
     */
    protected $renameFolderButton;

    /**
     * @var bool
     */
    protected $deleteFolderButton;

    /**
     * @var bool
     */
    protected $renameFileButton;

    /**
     * @var bool
     */
    protected $deleteFileButton;

    /**
     * @var bool
     */
    protected $downloadFileButton;

    /**
     * @var Closure
     */
    public $readonlyCallback;

    /**
     * @param string $name
     * @param string|null $attribute
     * @param mixed|null $resolveCallback
     */
    public function __construct(string $name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->setButtons();
        $this->withMeta(['visibility' => 'public']);
        $this->rounded();
    }

    /**
     * @return $this
     */
    public function displayAsImage(): self
    {
        return $this->withMeta(['display' => 'image']);
    }

    /**
     * @param string $folderName
     * @return $this
     */
    public function folder(string $folderName): self
    {
        $folder = is_callable($folderName) ? call_user_func($folderName) : $folderName;
        return $this->withMeta(['folder' => $folder, 'home' => $folder]);
    }

    /**
     * @param string $rules
     * @return $this
     */
    public function validateUpload(string $rules): self
    {
        $this->uploadRules = ($rules instanceof Rule || is_string($rules)) ? func_get_args() : $rules;
        return $this;
    }

    /**
     * @param $filter
     * @return $this
     */
    public function filterBy($filter): self
    {
        $defaultFilters = config('godesk.filemanager.filters', []);
        if (count($defaultFilters) > 0) {
            $filters = array_change_key_case($defaultFilters);
            if (isset($filters[$filter])) {
                $filteredExtensions = $filters[$filter];
                return $this->withMeta(['filterBy' => $filter]);
            }
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function privateFiles(): self
    {
        return $this->withMeta(['visibility' => 'private']);
    }

    /**
     * @return $this
     */
    public function hideCreateFolderButton(): self
    {
        $this->createFolderButton = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function hideUploadButton(): self
    {
        $this->uploadButton = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function hideRenameFolderButton(): self
    {
        $this->renameFolderButton = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function hideDeleteFolderButton(): self
    {
        $this->deleteFolderButton = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function hideRenameFileButton(): self
    {
        $this->renameFileButton = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function hideDeleteFileButton(): self
    {
        $this->deleteFileButton = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function hideDownloadFileButton(): self
    {
        $this->downloadFileButton = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function noDragAndDropUpload(): self
    {
        $this->dragAndDropUpload = false;
        return $this;
    }

    /**
     * @param Closure|bool $callback
     * @return $this
     */
    public function readonly($callback = true): self
    {
        $this->readonlyCallback = $callback;
        return $this;
    }

    /**
     * @param NovaRequest $request
     * @return bool
     */
    public function isReadonly(NovaRequest $request): bool
    {
        return with($this->readonlyCallback, function ($callback) use ($request) {
            if ($callback === true || (is_callable($callback) && call_user_func($callback, $request))) {
                $this->setReadonlyAttribute();
                return true;
            }
            return false;
        });
    }

    /**
     * @return $this
     */
    protected function setReadonlyAttribute(): self
    {
        $this->withMeta(['extraAttributes' => ['readonly' => true]]);
        return $this;
    }

    /**
     * @return array
     */
    public function resolveInfo(): array
    {
        if ($this->value) {
            $service = new FileManagerService();
            $data = $service->getFileInfoAsArray($this->value);
            if (empty($data)) {
                return [];
            }
            return $this->fixNameLabel($data);
        }
        return [];
    }

    /**
     * @return mixed|string|void|null
     */
    public function resolveThumbnailUrl(): ?string
    {
        if ($this->value) {
            $service = new FileManagerService();
            $data = $service->getFileInfoAsArray($this->value);
            if ((isset($data['type']) && $data['type'] !== 'image') || empty($data)) {
                return null;
            }
            return $data['url'];
        }
        return null;
    }

    /**
     * @return array
     */
    public function meta(): array
    {
        return array_merge(
            $this->resolveInfo(),
            $this->buttons(),
            $this->getUploadRules(),
            $this->getCoverType(),
            $this->meta
        );
    }

    /**
     * Set default button options.
     */
    private function setButtons()
    {
        $this->createFolderButton = config('godesk.filemanager.buttons.create_folder', true);
        $this->uploadButton = config('godesk.filemanager.buttons.upload_button', true);
        $this->dragAndDropUpload = config('godesk.filemanager.buttons.upload_drag', true);
        $this->renameFolderButton = config('godesk.filemanager.buttons.rename_folder', true);
        $this->deleteFolderButton = config('godesk.filemanager.buttons.delete_folder', true);
        $this->renameFileButton = config('godesk.filemanager.buttons.rename_file', true);
        $this->deleteFileButton = config('godesk.filemanager.buttons.delete_file', true);
        $this->downloadFileButton = config('godesk.filemanager.buttons.download_file', true);
    }

    /**
     * @return array
     */
    private function buttons(): array
    {
        $buttons = [
            'create_folder' => $this->createFolderButton,
            'upload_button' => $this->uploadButton,
            'upload_drag' => $this->dragAndDropUpload,
            'rename_folder' => $this->renameFolderButton,
            'delete_folder' => $this->deleteFolderButton,
            'rename_file' => $this->renameFileButton,
            'delete_file' => $this->deleteFileButton,
            'download_file' => $this->downloadFileButton,
        ];

        return ['buttons' => $buttons];
    }

    /**
     * @return  array
     */
    private function getUploadRules(): array
    {
        return ['upload_rules' => $this->uploadRules];
    }

    /**
     * @return  array
     */
    private function getCoverType(): array
    {
        return ['rounded' => $this->isRounded()];
    }

    /**
     * @param array $data
     * @return array
     */
    private function fixNameLabel(array $data): array
    {
        $data['filename'] = $data['name'];
        unset($data['name']);
        return $data;
    }
}