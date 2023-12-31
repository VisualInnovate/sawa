<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Treatment\Entities\ProgramSystem;
use Modules\Treatment\Http\Requests\ProgramSystemRequest;
use Modules\Treatment\Http\Requests\ProgramTypeRequest;

class ProgramSystemController extends Controller
{
    public function index()
    {
        $programtype =ProgramSystem::get();
        return response()->json([
            'success' => true,
            'programsystems'=>$programtype,
            'code'=>200
        ]);
    }

    public function store(ProgramSystemRequest $request)
    {
     $appointments = ProgramSystem::create([
        'title'=>$request->title,
       ]);
       return response()->json([
        'success' => true,
        'program_type'=>$appointments,
        'code'=>200
    ]);
    }

    public function show($id)
    {
      $appointment =ProgramSystem::find($id);
      return response()->json([
        'success' => true,
        'program_type'=>$appointment,
        'code'=>200
    ]);
    }

  

  
    public function update(Request $request, $id)
{
 
    $sample = ProgramSystem::find($id);
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
        $appointment =ProgramSystem::find($id);
        $appointment->delete();
        return response()->json([
          'success' => true,
          'massage'=>'The Type delete success',
          'code'=>200
      ]);
    }
}
