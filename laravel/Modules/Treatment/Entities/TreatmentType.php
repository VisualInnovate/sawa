<?php

namespace Modules\Treatment\Entities;

use App\Enums\TreatmentType as EnumsTreatmentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Room\Entities\Room;

class TreatmentType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function treatmrnts()
    {
        return $this->hasMany(Treatment::class, 'treatment_type_id', 'id');

    }
    public function rooms()
    {
    return $this->hasMany(Room::class,'treatment_id','id');
    }
}
