<?php

namespace App\Http\Requests\User;

use App\Rules\Validation\SoftDeleteExistsValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteRequest extends FormRequest
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
     * @param GetRequest $request
     * @return array
     */
    public function rules(GetRequest $request)
    {
        return [
            'data.isForceDelete' => [
                'nullable',
                'boolean'
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
