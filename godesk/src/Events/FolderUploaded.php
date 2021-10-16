<?php

namespace SpaceCode\GoDesk\Events;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Queue\SerializesModels;

class FolderUploaded
{
    use SerializesModels;

    /**
     * @var mixed
     */
    public $storage;

    /**
     * @var mixed
     */
    public $folderPath;

    /**
     * FolderUploaded constructor.
     * @param FilesystemAdapter $storage
     * @param string $folderPath
     */
    public function __construct(FilesystemAdapter $storage, string $folderPath)
    {
        $this->storage = $storage;
        $this->folderPath = $folderPath;
    }
}