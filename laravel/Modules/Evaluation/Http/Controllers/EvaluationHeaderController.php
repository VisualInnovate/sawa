<?php

namespace Modules\Evaluation\Http\Controllers;

use App\Http\Controllers\ControllerHandler;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Evaluation\Entities\EvaluationHeader;
use Modules\Evaluation\Http\Controllers\Services\EvaluationHeaderService;
use Modules\Evaluation\Http\Requests\EvaluationHeaderRequest;

class EvaluationHeaderController extends Controller
{
    private $ControllerHandler;
    
    public function __construct()
    {

        $this->middleware(
            'permission:
                evaluationheaders.index|evaluationheaders.create|evaluationheaders.show|
                evaluationheaders.update',
            ['only' => ['index','store']]
        );

        $this->middleware('permission:evaluationheaders.create',['only' => ['store']]);
        $this->middleware('permission:evaluationheaders.update',['only' => ['update']]);
        $this->middleware('permission:evaluationheaders.show',['only' => ['show']]);
        $this->middleware('permission:evaluationheaders.delete',['only' => ['destroy']]);

        $this->ControllerHandler=new ControllerHandler(new EvaluationHeader());
    }


    public function index()
    {


        return $this->ControllerHandler->getAll("headers");

    }


    public function show(evaluationHeader $header)
    {


        return $this->ControllerHandler->show("header",$header);
    }


    public function store(EvaluationHeaderRequest $request)
    {


        $typeAndMinAge=EvaluationHeaderService::getTypeAndMinAge($request->from,$request->to);//calculate type of header and min age
        if($typeAndMinAge["status"]==412)  // if type is not 6 or 12 month return invalid (business role)
            return response($typeAndMinAge,412);

        $data["title"]= $request->title; //for bulk store
        $data["type"]=$typeAndMinAge["type"];
        $data["min_age"]=$typeAndMinAge["min_age"];


        return $this->ControllerHandler->store("header",$data);
    }


    public function update(EvaluationHeaderRequest $request , evaluationHeader $header)
    {

        // here some validation check parent or admin
        //

        $typeAndMinAge=EvaluationHeaderService::getTypeAndMinAge($request->from,$request->to);//calculate type of header and min age
        if($typeAndMinAge["status"]==412)  // if type is not 6 or 12 month return invalid (business role)
            return response($typeAndMinAge,200);

        $data["title"]= $request->title; //for bulk store
        $data["type"]=$typeAndMinAge["type"];
        $data["min_age"]=$typeAndMinAge["min_age"];

        return $this->ControllerHandler->update("header",$header,$data);
    }


    public function destroy(evaluationHeader $header)
    {
        // here some validation check parent or admin
        return $this->ControllerHandler->destory("header",$header);

    }

}
