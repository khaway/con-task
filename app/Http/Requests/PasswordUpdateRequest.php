<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class PasswordUpdateRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'reset_token' => ['required', 'string', 'max:4'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed']
        ];
    }
}
