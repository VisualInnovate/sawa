<?php

namespace Modules\Calender\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Calender\Entities\Builders\CalenderBuilder;

class Calender extends Model
{
    use HasFactory;

    protected $guarded = array();

    protected $table = "events";

    protected static function newFactory()
    {
        return \Modules\Calender\Database\factories\CalenderFactory::new();
    }

    public function newEloquentBuilder($query)
    {
        return new CalenderBuilder($query);
    }
    //    public function scopeCurrentAuth($query)
    //    {
    //        return $query->where('user_id','=',auth()->user()->id );
    //
    //    }

}
