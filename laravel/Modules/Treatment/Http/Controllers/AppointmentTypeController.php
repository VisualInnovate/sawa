<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Treatment\Entities\AppointmentType;
use Modules\Treatment\Http\Requests\AppointmentTypeRequest;

class AppointmentTypeController extends Controller
{
    public function index()
    {
        $appointments =AppointmentType::get();
        return response()->json([
            'success' => true,
            'program_type'=>$appointments,
            'code'=>200
        ]);
    }

    public function store(AppointmentTypeRequest $request)
    {
     $appointments = AppointmentType::create([
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
      $appointment =AppointmentType::find($id);
      return response()->json([
        'success' => true,
        'program_type'=>$appointment,
        'code'=>200
    ]);
    }

  

  
    public function update(Request $request, $id)
    {
        $appointment =AppointmentType::find($id);
        $appointment->update([
            'title'=>$request->title
        ]);
        return response()->json([
          'success' => true,
          'program_type'=>$appointment,
          'code'=>200
      ]);
    }

    public function destroy($id)
    {
        $appointment =AppointmentType::find($id);
        $appointment->delete();
        return response()->json([
          'success' => true,
          'massage'=>'The Type delete success',
          'code'=>200
      ]);
    }
}
