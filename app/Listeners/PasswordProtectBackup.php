<?php

namespace App\Listeners;

use App\Helpers\BackupPassword;
use Spatie\Backup\Events\BackupZipWasCreated;

class PasswordProtectBackup
{
    /**
     * Handle the event.
     */
    public function handle(BackupZipWasCreated $backupZipWasCreated): string
    {
        return (new BackupPassword($backupZipWasCreated->pathToZip))->path;
    }
}
