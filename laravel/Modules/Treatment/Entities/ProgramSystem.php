<?php

namespace Modules\Treatment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramSystem extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    
    
}
