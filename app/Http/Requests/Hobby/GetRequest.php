<?php

namespace App\Http\Requests\Hobby;

use App\Rules\Validation\SoftDeleteExistsValidation;
use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
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
            'id' => [
                'integer',
                'required',
                'min:1',
                'exists:App\Models\Hobby,id',
                new SoftDeleteExistsValidation('hobbies')
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
