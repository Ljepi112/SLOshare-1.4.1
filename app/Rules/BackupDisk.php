<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BackupDisk implements Rule
{
    public function passes($attribute, $value): bool
    {
        $configuredBackupDisks = config('backup.backup.destination.disks');

        return in_array($value, $configuredBackupDisks);
    }

    public function message(): string
    {
        return 'Trenutni disk ni konfiguriran kot rezervni disk';
    }
}
