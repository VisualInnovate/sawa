<?php

namespace Modules\Evaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class sideProfile extends Model
{
    use HasFactory;

    protected $guarded = array();

    protected static function newFactory()
    {
        return \Modules\Evaluation\Database\factories\SideProfileFactory::new();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function delete() // overwrite function delete in model to delete relations also
    {
        DB::transaction(function()
        {
            $this->evaluations()->delete();

            parent::delete();
        });
    }
}
