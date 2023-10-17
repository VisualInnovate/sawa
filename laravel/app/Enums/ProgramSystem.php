<?php

namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum ProgramSystem: string
{
    use EnumToArray;
    case monthly = 'Monthly';
    case individual = 'Individually';
    case household  = 'household';



    public function lang():string
    {
        return match($this){
            self::monthly=>__('lookups.monthly'),
            self::individual=>__('lookups.individual'),
            self::household=>__('lookups.household'),
        };
    }

}
