<?php

namespace Modules\Treatment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    
    
}
