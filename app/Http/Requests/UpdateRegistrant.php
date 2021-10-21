<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrant extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required|string|max:255|unique:registrants,name,{$this->id}",
            'birthday' => 'required|date|date_format:m/d/Y',
            'contact_no' => "required|digits:11|unique:registrants,contact_no,{$this->id}",
            'age' => 'required|numeric|gte:18',
            'street' => 'required|max:255',
            'barangay' => 'required|max:255',
            'city_id' => 'required|max:6',
            'landmark' => 'required|max:255',
        ];
    }
}
