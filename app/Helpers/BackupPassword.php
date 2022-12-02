<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use ZipArchive;

class BackupPassword
{
    /**
     * Path to .zip-file.
     */
    public ?string $path;

    /**
     * The chosen password.
     */
    protected string $password;

    /**
     * Read the .zip, apply password and encryption, then rewrite the file.
     */
    public function __construct(string $path)
    {
        $this->password = \config('backup.security.password');

        // If no password is set, just return the backup-path
        if (! $this->password) {
            return $this->path = $path;
        }

        \consoleOutput()->info('Uporaba gesla in šifriranja za zip z uporabo ZipArchive...');

        $this->makeZip($path);

        \consoleOutput()->info('Uspešno uporabljeno geslo in šifriranje za zip.');
    }

    /**
     * Use native PHP ZipArchive.
     */
    protected function makeZip(string $path): void
    {
        $encryption = \config('backup.security.encryption');

        $zipArchive = new ZipArchive();

        $zipArchive->open($path, ZipArchive::OVERWRITE);
        $zipArchive->addFile($path, 'backup.zip');
        $zipArchive->setPassword($this->password);
        Collection::times($zipArchive->numFiles, fn ($i) => $zipArchive->setEncryptionIndex($i - 1, $encryption));
        $zipArchive->close();

        $this->path = $path;
    }
}
