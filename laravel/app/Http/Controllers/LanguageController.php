<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {

        $request->validate([
            'lang' => ["string", "in:en,ar"]
        ]);

        $lang = $request->input('lang');

        app()->setLocale($lang);

        Session::put('locale', $lang);

        return response()->json([
            'message' => 'Language updated successfully',
            "app_locale" => app()->getLocale()
        ]);
    }

    public function getLangs(Request $request)
    {
        $langs = Lang::select("id", "lang", "native")->get();

        return response()->json([
            "langs" => $langs
        ]);
    }
}
