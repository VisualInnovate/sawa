<?php

namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum ProgramType: string
{
    use EnumToArray;
    case diurnal = 'diurnal';
    case clinics = 'Clinics';
    case merge  = 'merge';



    public function lang():string
    {
        return match($this){
            self::diurnal=>__('lookups.diurnal'),
            self::clinics=>__('lookups.clinics'),
            self::merge=>__('lookups.merge'),


        };
    }

}
