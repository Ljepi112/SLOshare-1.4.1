<?php

namespace App\Interfaces;

interface ByteUnitsInterface
{
    public function bytesFromUnit(string $units): int;
}
