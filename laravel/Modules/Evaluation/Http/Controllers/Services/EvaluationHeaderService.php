<?php

namespace Modules\Evaluation\Http\Controllers\Services;

class EvaluationHeaderService
{
    public static function getTypeAndMinAge($from, $to)
    {
        //I assume to will be 1.5 (year and half  )
        $diff = ($to - $from) * 12;//calculate difference between months
        if ($diff == 6 || $diff == 12)

            return [
                "status" => 200,
                "message" => "success",
                "type" => $diff,
                "min_age" => $from * 12,
            ];

        return [
            "status" => 412,
            "message" => "sorry question category duration must be 6 months or 12 months ",
        ];
    }
}
