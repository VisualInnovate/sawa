<?php

namespace Modules\Calender\Http\Controllers\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Calender\Entities\Calender;


class CalenderRepository
{

    public static function getEventsOnDayForParents()
    {
        return Calender::query()
            ->select('title', DB::raw('DATE(start) as start_date'), DB::raw('TIME(start) as start_time'), DB::raw('DAYNAME(start) as day'), 'id')
            ->orderBy('start', 'asc')
            ->whereBetween('start', [Carbon::now()->startOfWeek(Carbon::SATURDAY), Carbon::now()->endOfWeek(Carbon::FRIDAY)])
            ->where('status', 0)
            ->get();
    }
}
