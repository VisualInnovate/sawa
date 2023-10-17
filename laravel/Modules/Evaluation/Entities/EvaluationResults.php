<?php

namespace Modules\Evaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Child\Entities\Child;

class EvaluationResults extends Model
{
    use HasFactory;

    protected $guarded = array();

    protected static function newFactory()
    {
        return \Modules\Evaluation\Database\factories\EvaluationResultsFactory::new();
    }




}
