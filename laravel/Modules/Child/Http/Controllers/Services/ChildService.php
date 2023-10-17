<?php

namespace Modules\Child\Http\Controllers\Services;

use Carbon\Carbon;
use Modules\Child\Http\Controllers\Repository\ChildRepository;

class ChildService
{
    public function getChildWithSideProfile($child)
    {
        return  ChildRepository::getChildWithSideProfile($child);
    }

    public function calcChildAgeInMonths($child)
    {
        $childAgeInMonth = (Carbon::parse($child->birth_date)->diffInMonths(Carbon::now('EET')));
        if ((int)Carbon::parse($child->birth_date)->diff(Carbon::now('EET'))->format('%d') >= 15)
            $childAgeInMonth++;
        return $childAgeInMonth;
    }

    public function calcChildAgeInMonthsWithAgeParam($age)
    {
        $childAgeInMonth = (Carbon::parse($age)->diffInMonths(Carbon::now('EET')));
        if ((int)Carbon::parse($age)->diff(Carbon::now('EET'))->format('%d') >= 15)
            $childAgeInMonth++;
        return $childAgeInMonth;
    }


    public function getChildWithAgeInMonthAndCheckIfCanDoExam($child, $evaluation)
    {
        $child->childInMonths = $this->calcChildAgeInMonths($child);
        if (!$evaluation->six_month) {
            $child->canDoExam = 1;
            return $child;
        }
        $data = $child->resultEavluation()
            ->where('evaluation_id', $evaluation->id)
            ->orderBy('created_at', 'DESC')->first();
        $child->canDoExam = 0;
        if ($data) {
            if (Carbon::parse($data->created_at)->diffInMonths(Carbon::now()) >= 6)
                $child->canDoExam = 1;
        } else {
            $child->canDoExam = 1;
        }
        return $child;
    }
}
