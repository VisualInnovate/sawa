<?php

namespace Modules\Evaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class question extends Model
{
    use HasFactory;

    protected $guarded = array();

    protected static function newFactory()
    {
        return \Modules\Evaluation\Database\factories\QuestionFactory::new();
    }

    public function evaluationHeader()
    {
        return $this->belongsTo(EvaluationHeader::class);
    }


    public function scopeGetQuestionWithEvaluation($query,$evaluation_id)
    {
        return $query->questions()->where('evaluation_id',$evaluation_id);
    }


}
