<?php

namespace Modules\Treatment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Treatment extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'program_type_id',
        'program_system_id',
        'treatment_type_id',
        'assessment_type_id',
        'appointment_type_id',
        'session_type_id',
        'thierbst_id', 
        'thierbst_schedule_id'
    ];
}
