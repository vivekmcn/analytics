<?php

namespace App\Http\Requests\Admin\Customers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|max:100',
            'email' => "required|email|max:100|unique:users,email,$this->user_id,id",
            'phone' => 'required|max:30',
            'address' => 'required|max:255',
        ];
    }
}
