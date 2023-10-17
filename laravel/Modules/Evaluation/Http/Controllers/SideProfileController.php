<?php

namespace Modules\Evaluation\Http\Controllers;

use App\Http\Controllers\ControllerHandler;
use http\Env\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Evaluation\Entities\Evaluation;
use Modules\Evaluation\Entities\SideProfile;
use Modules\Evaluation\Http\Controllers\Repository\SideprofileRepository;
use Modules\Evaluation\Http\Requests\SideProfileRequest;

class SideProfileController extends Controller
{
    private $ControllerHandler;

    public function __construct()
    {

        $this->middleware('permission:sideProfile.index', ['only' => ['index']]);
        $this->middleware('permission:sideProfile.show', ['only' => ['show']]);
        $this->middleware('permission:sideProfile.create', ['only' => ['store']]);
        $this->middleware('permission:sideProfile.update', ['only' => ['update']]);
        $this->middleware('permission:sideProfile.delete', ['only' => ['destroy']]);
        $this->middleware('permission:sideProfile.evaluations,sideProfile.child.getChildAndSideProfile', ['only' => ['getAllEvaluation']]);


        $this->ControllerHandler = new ControllerHandler(new SideProfile());
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return $this->ControllerHandler->getAll("sideProfile");
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function show(SideProfile $sideProfile)
    {


        return $this->ControllerHandler->show("sideProfile", $sideProfile);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SideProfileRequest $request)
    {
        return $this->ControllerHandler->store("sideProfile", $request->validated());
    }

    public function update(SideProfileRequest $request, SideProfile $sideProfile)
    {
        return $this->ControllerHandler->update('sideProfile', $sideProfile, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(SideProfile $sideProfile)
    {
        //        return response(['k'=>$sideProfile]);

        return $this->ControllerHandler->destory('sideProfile', $sideProfile);
    }


    public function getAllEvaluation(SideProfile $sideProfile)
    {
        return $this->ControllerHandler->show("evaluations", $sideProfile->evaluations);
    }


    public function getSideprofileWithEvalautions()
    {
        return  $this->ControllerHandler->show("evaluations", SideprofileRepository::getSideProfilesWithEvalautions());
    }
}
