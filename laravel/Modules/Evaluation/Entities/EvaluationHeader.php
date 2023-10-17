<?php

namespace Modules\Evaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class evaluationHeader extends Model
{
    use HasFactory;

   protected $guarded= array();

    protected static function newFactory()
    {
        return \Modules\Evaluation\Database\factories\EvaluationHeaderFactory::new();
    }
    public function evaluation()
    {
        return $this->belongsToMany(Evaluation::class,"questions")->withPivot("title");
    }

    public function questions()
    {
        return $this->hasMany(question::class);
    }

    public function delete() //overwrite function delete
    {
        DB::transaction(function()
        {
            $this->evaluation()->detach();
            parent::delete();
        });
    }


}
