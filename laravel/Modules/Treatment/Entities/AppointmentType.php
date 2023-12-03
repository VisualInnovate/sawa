<?php

namespace Modules\Treatment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    
    
}
