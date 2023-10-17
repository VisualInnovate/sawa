<?php

namespace App\Http\Controllers;

use App\Enums\TreatmentType;
use Illuminate\Http\Request;

class LookupsController extends Controller
{
    public function treatmeantType()
    {
        return response(['types'=>TreatmentType::local()]);
    }
}
