<?php

namespace Modules\Treatment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramSystem extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    public function treatment()
    {
        return $this->hasMany(Treatment::class, 'program_system_id', 'id');
    }
}
