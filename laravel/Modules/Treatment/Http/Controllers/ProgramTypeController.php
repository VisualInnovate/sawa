<?php

namespace Modules\Treatment\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Treatment\Entities\ProgramType;
use Illuminate\Contracts\Support\Renderable;
use Modules\Treatment\Http\Requests\ProgramSystemRequest;
use Modules\Treatment\Http\Requests\ProgramTypeRequest;

class ProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $program_types =ProgramType::get();
        return response()->json([
            'success' => true,
            'program_type'=>$program_types,
            'code'=>200
        ]);
    }

    public function store(ProgramTypeRequest $request)
    {
     $program_types = ProgramType::create([
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
      $program_type =ProgramType::find($id);
      return response()->json([
        'success' => true,
        'program_type'=>$program_type,
        'code'=>200
    ]);
    }
    public function update(Request $request, $id)
    {
        
    $sample = ProgramType::find($id);
    $sample->update([
        'title'=>$request->title
    ]);   

        return response()->json([
          'success' => true,
          'assessment_type'=>$sample,
          'code'=>200
      ]);
    }

    
    public function destroy($id)
    {
        $program_type =ProgramType::find($id);
        $program_type->delete();
        return response()->json([
          'success' => true,
          'massage'=>'The Type delete success',
          'code'=>200
      ]);
    }
}