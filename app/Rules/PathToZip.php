<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class PathToZip implements Rule
{
    public function passes($attribute, $value): bool
    {
        return Str::endsWith($value, '.zip');
    }

    public function message(): string
    {
        return 'Mora biti zip datoteka';
    }
}
