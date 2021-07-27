<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeOptionRequest extends FormRequest
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
        $id = $this->get('option_id');
        if(is_null($id))
        {
            $name = "required|unique:attribute_options,attribute_id,$id";
        } else {
            $name = "required|unique:attribute_options,attribute_id,$id";
        }
        return [
            "name" => $name,
        ];
    }
}