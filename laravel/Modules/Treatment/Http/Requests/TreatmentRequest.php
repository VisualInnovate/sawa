<?php

namespace Modules\Treatment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreatmentRequest extends FormRequest
{
        public function rules()
    {
        return [
            'title' => 'required|unique:appointment_types|max:255',
            'price' => 'required',
            'program_type_id' => 'required|exists:program_types,id',
            'program_system_id' => 'required|exists:program_systems,id',
            'treatment_type_id' => 'required|exists:treatment_types,id',
            'appointment_type_id' => 'required|exists:appointment_types,id',
            'session_type_id' => 'required|exists:session_types,id',
            'assessment_type_id' => 'required|exists:assessment_types,id',
            'thierbst_id' => 'required|exists:users,id',
            'thierbst_schedule_id' => 'required|exists:parents,id'
        ];
    }
    public function authorize()
    {
        return true;
    }
}
