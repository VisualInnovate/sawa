<?php

namespace Modules\Treatment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Treatment\Entities\Treatment;
use Illuminate\Contracts\Support\Renderable;
use Modules\Treatment\Http\Requests\TreatmentRequest;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return response()->json('kjhgkjhkjhkj');
    }

  
    public function create()
    {
        
    }

    
    public function store(TreatmentRequest $request)
    {
        Treatment::create($request->all());
        return response()->json("sucsses");
    }

    public function show($id)
    {
        
    }

   
    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
