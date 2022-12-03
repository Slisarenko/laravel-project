<?php

namespace App\Http\Requests\User;

use App\Rules\Validation\PasswordValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'data.email' => [
                Rule::unique('users', 'email'),
                'required',
                'string',
                'max:36'
            ],
            'data.name' => [
                'required',
                'string',
                'max:36'
            ],
            'data.password' => new PasswordValidation(),
            'data.confirmPassword' => [
                new PasswordValidation(),
                'same:data.password'
            ]
        ];
    }

    /**
     * @return array
     */
    public function validationData()
    {
        return array_replace_recursive(
            $this->all(),
            $this->route()->parameters()
        );
    }
}
