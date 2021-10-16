<?php

namespace SpaceCode\GoDesk\Console;

use Illuminate\Console\Command;
use Laravel\Nova\Trix\PendingAttachment;

/**
 * Class PruneStateAttachmentsCommand
 * @package SpaceCode\GoDesk\Console
 */
class PruneStateAttachmentsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'godesk:prune-attachments';

    /**
     * @var string
     */
    protected $description = 'Prune the stale attachments from the system';

    public function handle()
    {
        PendingAttachment::where('created_at', '<=', now()->subDays(1))
            ->orderBy('id', 'desc')
            ->chunk(100, function ($attachments) {
                $attachments->each->purge();
            });
    }
}
