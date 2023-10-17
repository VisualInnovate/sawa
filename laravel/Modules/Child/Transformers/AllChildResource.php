<?php

namespace Modules\Child\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Child\Http\Controllers\Services\ChildService;

class AllChildResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "age" => (new childService)->calcChildAgeInMonths($this),
            "report_text" => $this->report_text,
            "report_date" => $this->report_date
        ];
    }
}
