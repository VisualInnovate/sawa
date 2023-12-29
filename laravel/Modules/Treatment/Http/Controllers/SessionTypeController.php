<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Treatment\Entities\SessionType;
use Modules\Treatment\Http\Requests\SessionTypeRequest;

class SessionTypeController extends Controller
{
    
    public function index()
    {
        $sessionTypes =SessionType::get();
        return response()->json([
            'success' => true,
            'sessionTypes'=>$sessionTypes,
            'code'=>200
        ]);
    }

    public function store(SessionTypeRequest $request)
    {
     $program_types = SessionType::create([
        'title'=>$request->title,
       ]);
       return response()->json([
        'success' => true,
        'program_type'=>$program_types,
        'code'=>200
    ]);
    }

    public function show($id)
    {
      $program_type =SessionType::find($id);
      return response()->json([
        'success' => true,
        'program_type'=>$program_type,
        'code'=>200
    ]);
    }
    public function update(Request $request, $id)
    {
        $program_type =SessionType::find($id);
        $program_type->update([
            'title'=>$request->title
        ]);
        return response()->json([
          'success' => true,
          'program_type'=>$program_type,
          'code'=>200
      ]);
    }

    
    public function destroy($id)
    {
        $program_type =SessionType::find($id);
        $program_type->delete();
        return response()->json([
          'success' => true,
          'massage'=>'The Type delete success',
          'code'=>200
      ]);
    }
}
