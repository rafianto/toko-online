<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
        if($this->method() == 'PUT')
        {
            $code = "required|unique:attributes,code," . $this->get('id');
            $name = "required|unique:attributes,name," . $this->get('id');
        } else {
            $code = "required|unique:attributes,code,NULL";
            $name = "required|unique:attributes,name,NULL";
        }
        return [
            "code" =>$code,
            "name" => $name,
            "type" => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.required' => 'Attribute code is required',
            'name.required' => 'Attribute name is required',
            'type.required' => 'Attribute type is required',
            'code.unique' => 'Attribute code is must be unique. The code was available.',
            'name.unique' => 'Attribute name is must be unique. The name was available.',
        ];
    }
}