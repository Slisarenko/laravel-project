<?php

namespace App\Http\Requests\User;

use App\Rules\Validation\UserFilterValidation;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'filter' => [
                new UserFilterValidation()
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
