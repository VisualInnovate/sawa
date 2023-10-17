<?php

namespace Modules\Calender\Entities;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Booking extends Model
{
    use HasFactory;

    protected $table = "bookings";

    protected $fillable = [
        'event_id',
        'user_id',
        'child_id',
        'requester_name',
        'requester_phone',
        'relative_degree',
        'addtional_phone',
        'addtional_phone_owner',
        'addtional_phone_degree',
        "conversion_type",
        'child_doctor',
        'child_problem',
        'child_problems_notes',
        "child_aids",
        "child_aids_notes",
        'child_parents_problems',
        'parents_priorities',
        "doctor_code",
        'accepted',
        'booking_result',
        'accepted_notes',
    ];



    protected static function newFactory()
    {
        return \Modules\Calender\Database\factories\BookingsFactory::new();
    }
}
