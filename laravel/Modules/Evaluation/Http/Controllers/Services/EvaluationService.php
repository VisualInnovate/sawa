<?php

namespace Modules\Evaluation\Http\Controllers\Services;


use Carbon\Carbon;
use http\Env\Request;
use http\Env\Response;
use Modules\Child\Entities\Child;
use Modules\Child\Http\Controllers\Services\ChildService;
use Modules\Evaluation\Entities\evaluation;
use Modules\Evaluation\Entities\EvaluationHeader;
use Modules\Evaluation\Entities\EvaluationResults;
use Modules\Evaluation\Entities\Question;
use Modules\Evaluation\Http\Controllers\EvaluationController;
use Modules\Evaluation\Http\Controllers\Repository\EavlautionRepository;
use function MongoDB\Driver\Monitoring\removeSubscriber;

class EvaluationService
{
    protected $evalaution;


    public function deleteAssignedHeadersAndQuestions($evaluation)
    {
        $this->evalaution = $evaluation;

        EavlautionRepository::deleteAssignedHeaderQuestions($this->evalaution);
        return $this;
    }

    public function updateEvaluationTitle($request)
    {
        EavlautionRepository::EvaluationUpdate($this->evalaution, $request);
        return $this;
    }


    public function createEvaluation($request)
    {
        $this->evalaution = EavlautionRepository::insert($request);
        return $this;
    }

    /**
     * @param $request : this request li
     * @param $evaluation
     * @return void
     */
    public function storeEvalautionResult($request, $evaluation, $basalAge=null)
    {
        //        return response(['k'=>$basalAge]);
        $score = 0;
        foreach ($request->answers as $answer) {

            $evaluationHeader = question::find($answer['question_id'])->evaluationHeader;
            $type = $evaluationHeader->type;
            $questionCount = count(EvaluationHeader::find($evaluationHeader->id)->questions()->where('evaluation_id', $evaluation->id)->get());
            $score += $answer['value'] ? $type / $questionCount : 0;
            EavlautionRepository::SaveScoreForEvalutionByChildIdAndQuestionId($evaluation, $answer['question_id'], $request->child_id, $answer['value'] ? $type / $questionCount : 0);

        }

        $childAge=(new ChildService)->calcChildAgeInMonths(Child::find($request->child_id));

        $diffAge=$childAge-$score;
        $latePercenatage=($diffAge/$childAge)*100; //this will throw an exception if child age less than one  month

        $evaluation->child()->attach($request->child_id, [
            "therapist_id" => auth()->user()->id,
            "grow_age"=>$score,
            "diff_age"=>$diffAge,
            "late_percentage"=>$latePercenatage,
            "created_at"=>$request->date,//time zone Amman
            "basal_age"=>$basalAge==null?$basalAge:$basalAge->min_age+ $basalAge->type,
            "child_age"=>$childAge
        ]);


        return response(['message' =>"success","status"=>200 ],200);
    }

    /**
     * @param $evaluation : the evaluation that created from controller or sent to Api
     * @param $questions : like [{headerId => 2 , questions=>[question1 , question2 , question3]}, ...]   -> header id is index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function evaluationAssignHeaderAndQuestions($questions)
    {
        foreach ($questions as $question) {//O(n^2) where n is categories number * 3

            foreach ($question['questions'] as $val)
                EavlautionRepository::assignHeadersQuestions($this->evalaution, $question['headerId'], $val);

        }

        return response([//this response for controller
            "status" => 200,
            "message" => "Evaluation added successfully ",
            "evaluation" => EavlautionRepository::getEvalauationByIdWithHeaderAndQuestions($this->evalaution)  // get evaluation with header and question after save in DB
        ], 200);
    }
}
