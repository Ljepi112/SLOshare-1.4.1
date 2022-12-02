<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class ProcessBackup implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;

    public int $timeout = 0;

    public function __construct(protected $option = '')
    {
    }

    public function handle(): void
    {
        $backupJob = BackupJobFactory::createFromArray(config('backup'));

        if ($this->option === 'only-db') {
            $backupJob->dontBackupFilesystem();
        }

        if ($this->option === 'only-files') {
            $backupJob->dontBackupDatabases();
        }

        if (! empty($this->option)) {
            $prefix = str_replace('_', '-', $this->option).'-';

            $backupJob->setFilename($prefix.date('Y-m-d-H-i-s').'.zip');
        }

        $backupJob->run();
    }
}
