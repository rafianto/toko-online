<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $name = null;
        $sku = null;
        if($this->method() == 'PUT')
        {

            $name = 'required|unique:products,name,' . (int)$this->get('id') . ',id';
            $sku = 'required|unique:products,sku,' . (int)$this->get('id') . ',id';

        } else {

            $name = 'required|unique:products,name,';
            $sku = 'required|unique:products,sku';

        }

        return [
            "sku" => $sku,
            "name" => $name,
            "weight" => 'required|numeric',
            "price" => 'required',
            'status' => 'required|numeric',
        ];
    }
}