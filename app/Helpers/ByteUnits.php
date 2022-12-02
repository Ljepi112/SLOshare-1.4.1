<?php

namespace App\Helpers;

use App\Interfaces\ByteUnitsInterface;
use ByteUnits as ByteUnitsLibrary;

class ByteUnits implements ByteUnitsInterface
{
    public function bytesFromUnit(string $units): int
    {
        return ByteUnitsLibrary\parse($units)->numberOfBytes();
    }
}
