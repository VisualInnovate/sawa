<?php

namespace Modules\Calender\Entities\Builders;

use Illuminate\Database\Eloquent\Builder;;

class CalenderBuilder extends Builder
{
    public function currentAuth()
    {
       return $this->where('user_id',auth()->user()->id );

    }
}
