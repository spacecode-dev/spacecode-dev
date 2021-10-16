<?php

namespace SpaceCode\GoDesk\Events;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Queue\SerializesModels;

class FolderRemoved
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
     * FolderRemoved constructor.
     * @param FilesystemAdapter $storage
     * @param string $folderPath
     */
    public function __construct(FilesystemAdapter $storage, string $folderPath)
    {
        $this->storage = $storage;
        $this->folderPath = $folderPath;
    }
}