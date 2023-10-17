<?php

namespace Modules\Evaluation\Http\Controllers\Repository;

use Illuminate\Support\Facades\Auth;
use Modules\Child\Entities\Child;
use Modules\Evaluation\Entities\Evaluation;
use Modules\Evaluation\Entities\EvaluationResults;
use Modules\Evaluation\Entities\Question;

class EavlautionRepository
{

    public static function insert($request)
    {
        return Evaluation::create($request->validated()); //create evaluation
    }

    public static function assignHeadersQuestions($evaluation, $key, $title) //assign header and question to specific evaluation
    {
        $evaluation->evaluationHeader()->attach($key, [
            "title" => $title
        ]);
    }

    public static function deleteAssignedHeaderQuestions($evaluation)
    {
        $evaluation->evaluationHeader()->detach();
    }

    public static function getEvalauationByIdWithHeaderAndQuestions($evaluation)
    {
        return Evaluation::find($evaluation->id)->evaluationHeader;
    }

    public static function EvaluationUpdate($evaluation, $request)
    {
        $evaluation->update($request->validated());
    }

    public static function SaveScoreForEvalutionByChildIdAndQuestionId($evaluation, $question_id, $child_id, $score)
    {

        $evaluation->question()->attach($question_id, [
            'child_id' => $child_id,
            'score' => $score
        ]);
    }

    public static function getSpecifcEvalautionWithHeaderAndQuestions($evalaution)
    {
        return Question::selectRaw("questions.evaluation_id evaluation_id ,
        questions.evaluation_header_id header_id ,
        evaluations.title evaluation_title,
        questions.title question_title,
        evaluation_headers.title evaluation_headers_title")
            ->join("evaluations", "questions.evaluation_id", '=', 'evaluations.id')
            ->join("evaluation_headers", "questions.evaluation_header_id", '=', 'evaluation_headers.id')
            ->where('evaluations.id', $evalaution->id)
            ->get();
    }

    public static function getResultForSpecificChildWithSpecificSideProfile($child, $sideProfile, $evaluation)
    {
        return EvaluationResults::selectRaw("children.name child_name ,
        children.birth_date birth_date ,
         users.name therapist_name ,
        evaluations.title evaluation_title ,
        evaluation_results.grow_age grow_age ,
         evaluation_results.late_percentage late_percentage ,
         evaluation_results.diff_age diff_age ,
          evaluation_results.id id ,
          evaluation_results.basal_age basal_age ,
           evaluation_results.created_at result_created_at,
           evaluation_results.child_age child_age
           ")
            ->join("evaluations", "evaluation_results.evaluation_id", '=', 'evaluations.id')
            ->join("children", "evaluation_results.child_id", '=', 'children.id')
            ->join("users", "evaluation_results.therapist_id", '=', 'users.id')
            ->where('child_id', $child->id)
            ->where('evaluations.side_profile_id', $sideProfile->id)
            ->where('evaluations.id', $evaluation->id)
            ->get();
    }

    public static function getResultForSpecificChildWithSpecificSideProfileWithDate($child, $sideProfile, $evaluation, $date1, $date2)
    {

        if ($date2 == null || $date1 == null)
            return EavlautionRepository::getResultForSpecificChildWithSpecificSideProfile($child, $sideProfile, $evaluation);

        if ($date1 > $date2) {
            $temp = $date2;
            $date2 = $date1;
            $date1 = $temp;
        }
        return EvaluationResults::selectRaw("children.name child_name ,
         users.name therapist_name ,
        evaluations.title evaluation_title ,
        evaluation_results.grow_age grow_age ,
         evaluation_results.late_percentage late_percentage ,
         evaluation_results.diff_age diff_age ,
          evaluation_results.id id ,
          evaluation_results.basal_age basal_age ,
           evaluation_results.created_at result_created_at")
            ->join("evaluations", "evaluation_results.evaluation_id", '=', 'evaluations.id')
            ->join("children", "evaluation_results.child_id", '=', 'children.id')
            ->join("users", "evaluation_results.therapist_id", '=', 'users.id')
            ->where('child_id', $child->id)
            ->where('evaluations.side_profile_id', $sideProfile->id)
            ->where('evaluations.id', $evaluation->id)
            ->where('evaluation_results.created_at', '>=', $date1)
            ->where('evaluation_results.created_at', '<=', $date2)
            ->get();
    }

    public static function getEvaluationsForSpecificChildWithSpecificSideProfile($child, $sideProfile)
    {
        return EvaluationResults::selectRaw("
        evaluations.title evaluation_title ,
        evaluations.id id
        ")
            ->join("evaluations", "evaluation_results.evaluation_id", '=', 'evaluations.id')
            ->join("children", "evaluation_results.child_id", '=', 'children.id')
            ->where('child_id', $child->id)
            ->where('evaluations.side_profile_id', $sideProfile->id)
            ->groupBy('evaluations.id')
            ->groupBy('evaluations.title')
            ->get();
    }

    public static function insertbasalAge($evalaution_id, $child_id, $basalAge)
    {
        return EvaluationResults::create([
            'grow_age' => null,
            'diff_age' => null,
            'late_percentage' => null,
            'basal_age' => ($basalAge->min_age + $basalAge->type) / 12,
            'evaluation_id' => $evalaution_id,
            'child_id' => $child_id,
            'therapist_id' => Auth::user()->id
        ]);
    }

    public static function editDateEvaluationResult($evaluationResult, $date)
    {
        $evaluationResult->update([
            'created_at' => $date
        ]);

        return $evaluationResult->fresh();
    }
}
