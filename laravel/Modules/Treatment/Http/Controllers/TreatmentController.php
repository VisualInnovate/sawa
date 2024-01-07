<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Treatment\Entities\Treatment;
use Illuminate\Contracts\Support\Renderable;
use Modules\Treatment\Http\Requests\TreatmentRequest;

class TreatmentController extends Controller
{
    public function index()
    {

        $treatment = Treatment::with(
            'sessionTypes',
            'programType',
            'appointment',
            'programSystem',
            'treatmentType',
            'users',
        )->get();
        // $prgramTypes =Treatment::with('programType')->get();
        //$appointment =Treatment::with('appointment')->get();
        // $prgramsystem  = Treatment::with('programSystem')->get();
      //  $treatmentType = Treatment::with('treatmentType')->get();
        return response()->json([

            'treatments' => $treatment,

        ]);
    }


    public function allInputData()
    {
    }


    public function store(Request $request)
    {

        Treatment::create($request->all());
        return response()->json("sucsses");
    }

    public function show($id)

    {
        $data =Treatment::find($id);
        return response()->json([
            'oneTreatment' => $data,
        ]);

    }


    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $treatment = Treatment::find($id);
        $treatment->update($request->all());
        return response()->json($treatment);
    }
    public function destroy($id)
    {
        //
    }
}
