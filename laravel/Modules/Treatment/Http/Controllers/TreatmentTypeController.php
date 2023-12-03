<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Treatment\Entities\TreatmentType;
use Modules\Treatment\Http\Requests\TreatmentTypeRequest;

class TreatmentTypeController extends Controller
{
    public function index()
    {
        $program_types =TreatmentType::get();
        return response()->json([
            'success' => true,
            'program_type'=>$program_types,
            'code'=>200
        ]);
    }

    public function store(TreatmentTypeRequest $request)
    {
     $program_types = TreatmentType::create([
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
      $program_type =TreatmentType::find($id);
      return response()->json([
        'success' => true,
        'program_type'=>$program_type,
        'code'=>200
    ]);
    }
    public function update(Request $request, $id)
    {
        $program_type =TreatmentType::find($id);
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
        $program_type =TreatmentType::find($id);
        $program_type->delete();
        return response()->json([
          'success' => true,
          'massage'=>'The Type delete success',
          'code'=>200
      ]);
    }
}
