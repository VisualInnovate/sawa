<?php

namespace Modules\Child\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Modules\Evaluation\Entities\Evaluation;
use Modules\Evaluation\Entities\EvaluationResults;

class Child extends Model
{
    use HasFactory;

    protected $guarded = array();

    protected static function newFactory()
    {
        return \Modules\Child\Database\factories\ChildFactory::new();
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class, 'evaluation_results');
    }
    public function sideProfile()
    {
        return $this->belongsToMany(Evaluation::class, 'evaluation_results')->with('sideProfile');
    }

    public function resultEavluation()
    {
        return $this->hasMany(EvaluationResults::class);
    }

    public function delete()
    {
        DB::transaction(function () {
            $this->evaluations()->detach();
            $this->sideProfile()->detach();
            $this->resultEavluation()->delete();
            parent::delete();
        });
    }
}
