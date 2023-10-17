<?php

namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum TherapistCategory: string
{
    use EnumToArray;
    case autism = 'autism';
    case neurologists = 'neurologists';


    public function lang():string
    {
        return match($this){
            self::autism=>__('lookups.autism'),
            self::neurologists=>__('lookups.neurologists'),
        };
    }

}
