<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries(Request $request)
    {
        $countries = Country::select("id", "nationality")->get();

        return response()->json([
            "countries" => $countries
        ]);
    }
}
