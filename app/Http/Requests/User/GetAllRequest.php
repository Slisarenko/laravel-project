<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAllRequest extends FormRequest
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
     * @param FilterRequest $request
     * @return array
     */
    public function rules(FilterRequest $request): array
    {
        return [
            'limit' => [
                'string',
                'required_with_all:page'
            ],
            'page' => [
                'string',
                'required_with_all:limit'
            ],
            'sortField' => [
                'string'
            ],
            'sortOrder' => [
                Rule::in(['asc', 'desc']),
                'nullable'
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
