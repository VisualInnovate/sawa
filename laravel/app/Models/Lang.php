<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;

    protected $table = "languages";

    protected $fillable = [
        'lang',
        'native',
        'iso_code',
        'is_active',
        'is_rtl',
        'is_default',
    ];
}
