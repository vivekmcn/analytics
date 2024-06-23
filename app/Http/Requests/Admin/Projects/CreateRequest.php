<?php

namespace App\Http\Requests\Admin\Projects;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|max:100',
            'logo' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'status' => 'required|boolean'
        ];
    }
}
