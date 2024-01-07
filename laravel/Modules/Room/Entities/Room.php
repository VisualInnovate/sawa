<?php

namespace Modules\Room\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Treatment\Entities\TreatmentType;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'capacity', 'treatment_id', 'room_type_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function treatmentType()
{
    return $this->belongsTo(TreatmentType::class, 'treatment_id'); // Adjust the model name and foreign key as needed
}

}
