<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;

    protected $table = 'site_settings';

    protected $fillable = [
        'name',
        'logo',
        'cover',
        'number_1',
        'number_2',
        'address',
        'email',
        'description',
        'social_links',
    ];
}
