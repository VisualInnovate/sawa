<?php

namespace App\Enums;

use App\Http\Traits\EnumToArray;


enum AssessmentSystem: string
{
    use EnumToArray;
    case consultation = 'consultation';
    case family = 'Family interview';
    case team = 'Team interview';

    case other = 'other';

    public function lang():string
    {
        return match($this){
            self::consultation=>__('lookups.consultation'),
            self::family=>__('lookups.familyInterview'),
            self::team=>__('lookups.teamInterview'),
            self::other=>__('lookups.other'),

        };
    }

}
