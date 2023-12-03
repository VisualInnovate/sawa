<?php

namespace Modules\Room\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [''];
  
    public function users()
    {
        return $this->belongsToMany(User::class, 'room_therapists');
    }
}
