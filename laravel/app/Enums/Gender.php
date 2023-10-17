<?php

namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum Gender: int
{
    use EnumToArray;
    case male = 1;
    case female = 0;


    public function lang(): string
    {
        return match ($this) {
            self::male => __('lookups.male'),
            self::female => __('lookups.female'),
        };
    }
}
