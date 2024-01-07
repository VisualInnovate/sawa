<?php

namespace Modules\Treatment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    public function treatments()
    {
        return $this->hasMany(Treatment::class, 'program_type_id', 'id');
    }
    
}
