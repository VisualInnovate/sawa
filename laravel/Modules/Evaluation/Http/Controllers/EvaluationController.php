<?php

namespace Modules\Evaluation\Http\Controllers;

use App\Http\Controllers\ControllerHandler;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Child\Entities\Child;
use Modules\Evaluation\Entities\Evaluation;
use Modules\Evaluation\Entities\EvaluationHeader;
use Modules\Evaluation\Entities\EvaluationResults;
use Modules\Evaluation\Entities\SideProfile;
use Modules\Evaluation\Http\Controllers\Repository\EavlautionRepository;
use Modules\Evaluation\Http\Controllers\Services\EvaluationService;
use Modules\Evaluation\Http\Requests\EvaluationRequest;
use Modules\Evaluation\Http\Requests\EvaluationSubmitRequest;

class EvaluationController extends Controller
{
    private $ControllerHandler;

    public function __construct()
    {

        $this->middleware(
            'permission:
            evaluation.showEvaluationsForChildWithSpecificSideProfile|evaluations.index|evaluations.create|evaluations.show|
                evaluations.update|sideProfile.evaluations|evaluations.showAllEvaluation',
            ['only' => ['index', 'store']]
        );

        $this->middleware('permission:evaluations.create', ['only' => ['store']]);
        $this->middleware('permission:evaluations.update', ['only' => ['update']]);
        $this->middleware('permission:evaluations.show', ['only' => ['show']]);
        $this->middleware('permission:evaluations.delete', ['only' => ['destroy']]);



        $this->ControllerHandler = new ControllerHandler(new evaluation());
    }

    public function index()
    {
        return $this->ControllerHandler->getAll("evaluations");
    }

    public function show(evaluation $evaluation)
    {

        return $this->ControllerHandler->show("evaluation", EavlautionRepository::getEvalauationByIdWithHeaderAndQuestions($evaluation)->groupBy("id"));
    }

    public function EvaluationShow(evaluation $evaluation)
    {
        return $this->ControllerHandler->show("evaluation", $evaluation);
    }

    public function store(EvaluationRequest $request)
    {
        return (new EvaluationService)
            ->createEvaluation($request)
            ->evaluationAssignHeaderAndQuestions($request->questions); //create evaluation

        //assign headers and question to evaluation and return response
    }

    public function update(EvaluationRequest $request, evaluation $evaluation)
    {


        return (new EvaluationService)
            ->deleteAssignedHeadersAndQuestions($evaluation)
            ->updateEvaluationTitle($request)
            ->evaluationAssignHeaderAndQuestions($request->questions); //assign headers and question to evaluation and return response
    }

    public function destroy(Evaluation $evaluation)
    {
        (new EvaluationService)->deleteAssignedHeadersAndQuestions($evaluation);
        return $this->ControllerHandler->destory("evaluations", $evaluation);
    }

    public function submitEvaluation(EvaluationSubmitRequest $request, Evaluation $evaluation)
    {
        return (new EvaluationService)->storeEvalautionResult($request, $evaluation);
    }

    public function showResultExamForChildren(Child $child, SideProfile $sideProfile, Evaluation $evaluation)
    {

        return $this->ControllerHandler->show("resultEvaluation", EavlautionRepository::getResultForSpecificChildWithSpecificSideProfile($child, $sideProfile, $evaluation));
    }
    public function showResultExamForChildrenWithDate(Child $child, SideProfile $sideProfile, Evaluation $evaluation, Request $request)
    {

        return $this->ControllerHandler->show("resultEvaluation", EavlautionRepository::getResultForSpecificChildWithSpecificSideProfileWithDate($child, $sideProfile, $evaluation, $request->date1, $request->date2));
    }

    public function showEvaluationsForChildWithSpecificSideProfile(Child $child, SideProfile $sideProfile)
    {
        return $this->ControllerHandler->show("evaluations", EavlautionRepository::getEvaluationsForSpecificChildWithSpecificSideProfile($child, $sideProfile));
    }

    public function basalAge(Evaluation $evaluation, EvaluationHeader $evaluationHeader, Request $request)
    {
        return (new EvaluationService)->storeEvalautionResult($request, $evaluation, $evaluationHeader);
    }

    public function editDateEvaluations(EvaluationResults $evaluationResults, Request $request)
    {
        return EavlautionRepository::editDateEvaluationResult($evaluationResults, $request->date);
    }
}
