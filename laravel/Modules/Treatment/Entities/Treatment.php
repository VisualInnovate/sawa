<?php

namespace Modules\Treatment\Entities;

use App\Enums\AssessmentType;
use App\Models\User;
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
        'appointment_type_id',
        'session_type_id',
        'user_id',
        'room_id',
    ];

    public function programType()
    {
        return $this->belongsTo(ProgramType::class, 'program_type_id', 'id');
    }

    public function programSystem ()
    {
        return $this->belongsTo(ProgramSystem::class,'program_system_id','id');
    }
    public function treatment_type ()
    {
        return $this->hasMany(TreatmentType::class,'treatment_type_id','id');
    }
    public function appointment ()
    {
        return $this->belongsTo(AppointmentType::class,'appointment_type_id','id');
    }
    public function sessionTypes()
    {
        return $this->belongsTo(SessionType::class, 'session_type_id', 'id');
    }
    public function treatmentType() {
        return $this->belongsTo(TreatmentType::class,'treatment_type_id','id');

    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
