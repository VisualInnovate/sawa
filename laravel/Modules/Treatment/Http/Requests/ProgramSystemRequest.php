<?php

namespace Modules\Treatment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramSystemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:appointment_types|max:255',
        ];
    }
    public function messages()
    {

        return [
            'title.required' => [
                'ar' => 'العنوان  فارغ',
                'en' => 'Residence title is empty ',
            ],
            'title.unique' => [
                'ar' => 'العنوان  موجود',
                'en' => 'Residence title is empty ',
            ],
         
        ];
    }
    public function authorize()
    {
        return true;
    }
}
