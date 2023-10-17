<?php

namespace Modules\Evaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Child\Entities\Child;

class evaluation extends Model
{
    use HasFactory;

    protected $fillable=['title','side_profile_id','six_month'];

    protected static function newFactory()
    {
        return \Modules\Evaluation\Database\factories\EvaluationFactory::new();
    }

    public function evaluationHeader()
    {
        return $this->belongsToMany(EvaluationHeader::class,"questions")->withPivot("id","title")->as("questions");

    }

    public function question()
    {
        return $this->belongsToMany(Question::class,'child_scores')->withPivot("id","score")->as("score");
    }

    public function scopeGetEvaluation($query,$evaluation)
    {
        return $query->find($evaluation->id)->evaluationHeader();
    }

    public function child()
    {
        return $this->belongsToMany(Child::class,'evaluation_results')->withTimestamps()->withPivot("id","therapist_id","grow_age","diff_age","late_percentage","child_age")->as("result");
    }

    public function sideProfile()
    {
        return $this->belongsTo(SideProfile::class);
    }
}
