<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param GetRequest $request
     * @return array
     */
    public function rules(GetRequest $request): array
    {
        return [
            'data.name' => [
                'required',
                'string',
                'max:36'
            ]
        ];
    }

    /**
     * @return array
     */
    public function validationData(): array
    {
        return array_replace_recursive(
            $this->all(),
            $this->route()->parameters()
        );
    }
}
