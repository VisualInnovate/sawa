<?php

namespace Modules\Calender\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'child_id' => ['required', 'integer'],
            // Requester Info
            'requester_name' => ['required', 'string'],
            'requester_phone' => ['required', 'string'],
            'relative_degree' => ['required', 'string'],
            'addtional_phone' => ['required', 'string'],
            'addtional_phone_owner' => ['required', 'string'],
            'addtional_phone_degree' => ['required', 'string'],
            //Child

            "conversion_type" => ['required', 'string'],
            'child_doctor' => ['required', 'string'],

            'child_problem' => ['required', 'string'],
            'child_problems_notes' => ['nullable', 'string'],
            "child_aids" => ['required', 'boolean'],
            "child_aids_notes" => ['required_if:child_aids,true'],
            'child_parents_problems' => ['required', 'string'],
            'parents_priorities' => ['required', 'string'],
            "doctor_code" => ['nullable', 'integer'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('parent')->check();
    }
}
