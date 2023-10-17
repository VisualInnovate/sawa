<?php

namespace Modules\Evaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildScores extends Model
{
    use HasFactory;

    protected $guarded = array();

    protected static function newFactory()
    {
        return \Modules\Evaluation\Database\factories\ChildScoresFactory::new();
    }


}
