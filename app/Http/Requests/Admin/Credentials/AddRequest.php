<?php

namespace App\Http\Requests\Admin\Credentials;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'credential_type_id' => 'required|exists:credential_types,id',
            'credential' => 'required|max:255',
            'cred_key' => 'max:255',
            'status' => 'required|boolean'
        ];
    }
}
