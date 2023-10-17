<?php

namespace App\Http\Controllers;

use App\Models\ChildParent;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        $parents = ChildParent::select('id', 'email', 'fname', 'lname', 'phone', 'image')->get();

        $parents->each(function ($parent) {
            $parent->image = url($parent->image);
        });

        return response()->json([
            'parents' => $parents,
        ]);
    }
}
