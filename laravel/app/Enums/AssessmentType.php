<?php

namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum AssessmentType: string
{
    use EnumToArray;
    case sideProfile = 'Side Profile';
    case Elm = 'Elm';
    case Gars  = 'Gars';

    case Mchat = 'Mchat';

    public function lang():string
    {
        return match($this){
            self::sideProfile=>__('lookups.sideProfile'),
            self::Elm=>__('lookups.Elm'),
            self::Gars=>__('lookups.Gars'),
            self::Mchat=>__('lookups.Mchat'),

        };
    }

}
