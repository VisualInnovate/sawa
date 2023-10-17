<?php
namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum TreatmentType: string
{
    use EnumToArray;
    case kinetic = 'kinetic';
    case listing = 'listing';
    case natural = 'natural';
    case psychological = 'psychological';

    public function lang():string
    {
        return match($this){
            self::kinetic=>__('lookups.kinetic'),
            self::listing=>__('lookups.listing'),
            self::natural=>__('lookups.natural'),
            self::psychological=>__('lookups.psychological')
        };
    }

}
