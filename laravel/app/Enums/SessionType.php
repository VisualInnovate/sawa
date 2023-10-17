<?php
namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum SessionType: string
{
    use EnumToArray;
    case specialized = 'specialized';
    case individual = 'individual';
    case collective = 'collective';

    public function lang():string
    {
        return match($this){
            self::specialized=>__('lookups.specialized'),
            self::individual=>__('lookups.individual'),
            self::collective=>__('lookups.collective'),

        };
    }

}

