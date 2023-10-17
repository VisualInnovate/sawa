<?php

namespace Modules\Child\Http\Controllers\Repository;

use Modules\Evaluation\Entities\ChildScores;
use Modules\Evaluation\Entities\EvaluationResults;
use Modules\Evaluation\Entities\sideProfile;

class ChildRepository
{
    public static function getChildWithSideProfile($child)
    {

        return EvaluationResults::selectRaw
            ("
                evaluations.id evaluations_id, 
                side_profiles.id side_profile_id ,
                evaluations.title evaluation_title ,
                side_profiles.title side_profile_title
            ")
            ->leftJoin("evaluations", "evaluation_results.evaluation_id", '=', 'evaluations.id')
            ->leftJoin("side_profiles", "side_profiles.id", '=', 'evaluations.side_profile_id')
            ->where('evaluation_results.child_id', $child->id)
            ->groupBy("evaluations.id","side_profiles.id","evaluations.title","side_profiles.title")
            ->get();
    }

    public static function getResultsWithSideProfile($request)
    {

       return EvaluationResults::selectRaw
       ("
            evaluations.title evaluation_title ,
            side_profiles.title side_profile_title ,
            evaluation_results.grow_age grow_age ,
            evaluation_results.late_percentage late_percentage ,
            evaluation_results.diff_age diff_age ,
            evaluation_results.id id ,
            evaluation_results.basal_age basal_age ,
            evaluation_results.created_at result_created_at,
            evaluation_results.child_age child_age
        ")
            ->leftJoin("evaluations", "evaluation_results.evaluation_id", '=', 'evaluations.id')
            ->leftJoin("side_profiles", "side_profiles.id", '=', 'evaluations.side_profile_id')
            ->where('evaluation_results.child_id', $request->child_id)
            ->where('side_profiles.id', $request->sideprofile_id)
            ->get();
    }
}
