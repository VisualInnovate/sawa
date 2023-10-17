<?php

namespace Modules\Calender\Http\Controllers\Services;

use Carbon\Carbon;

class CalenderService
{

    public static function groupEventsOnTheSameDay($events)
    {
        $result = [];
        $max = 0;
        $events->each(function ($event) use (&$result, &$max) {
            $result[$event->day][] = [
                'title' => $event->title,
                'start_time' => Carbon::parse($event->start_time)->format("h:i A"),
                'day' => Carbon::parse($event->day)->format("M-d"),
                'id' => $event->id,
            ];

            if (count($result[$event->day]) > $max) {
                $max = count($result[$event->day]);
            }
        });

        return [
            "events" => array_reverse($result),
            'max' => $max

        ];


        /*
            $max = 0;

            $events->each(function ($event) use (&$result, &$max) {
                $result[$event->day]['day'] = $event->day;
                $result[$event->day]['events'][] = [
                    'title' => $event->title,
                    'start_time' => $event->start_time,
                ];

                if (count($result[$event->day]['events']) > $max) {
                    $max = count($result[$event->day]['events']);
                }
            });

            return response()->json([
                "events" => array_reverse(array_values($result)),
                'max' => $max
            ]);

        */
    }
}
