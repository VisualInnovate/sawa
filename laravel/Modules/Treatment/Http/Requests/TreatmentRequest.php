<?php

namespace Modules\Treatment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreatmentRequest extends FormRequest
{
        public function rules()
    {
        return [
            'title' => 'required|max:255',
            'price' => 'required',
            'program_type_id' => 'required',
            'program_system_id' => 'required',
            'treatment_type_id' => 'required|exists:treatment_types,id',
            'appointment_type_id' => 'required|exists:appointment_types,id',
            'session_type_id' => 'required|exists:session_types,id',
            // 'room_id'=>'required'
        ];
    }
    public function authorize()
    {
        return true;
    }
}
