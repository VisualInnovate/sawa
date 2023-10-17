<?php

namespace Modules\Calender\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'start'=>Carbon::parse($this->start)->format('Y-m-d'),
            'end'=>Carbon::parse($this->end)->format('Y-m-d'),
            'id'=>$this->id
        ];
    }
}
