<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Treatment\Entities\AssessmentType;
use Modules\Treatment\Http\Requests\AssessmentTypeRequest;

class AssessmentTypeController extends Controller
{
    public function index()
    {
        $appointments =AssessmentType::get();
        return response()->json([
            'success' => true,
            'program_type'=>$appointments,
            'code'=>200
        ]);
    }

    public function store(AssessmentTypeRequest $request)
    {
     $appointments = AssessmentType::create([
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
      $appointment =AssessmentType::find($id);
      return response()->json([
        'success' => true,
        'program_type'=>$appointment,
        'code'=>200
    ]);
    }

  

  
    public function update(Request $request, $id)
{
   
    $sample = AssessmentType::find($id);
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
        $appointment =AssessmentType::find($id);
        $appointment->delete();
        return response()->json([
          'success' => true,
          'massage'=>'The Type delete success',
          'code'=>200
      ]);
    }
}
