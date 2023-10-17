<?php

namespace Modules\Child\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "parent_id" => "integer",
            "name" => "required|string",
            'gender' => [ 'in:0,1'],
            'lang' => [ 'string'],
            'nationalty' => ['string'],
            'national_id' => [ 'string'],
            "birth_date" => [ 'required',"date"],
            'birth_place' => [ 'string'],
            'address' => [ 'string'],

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
