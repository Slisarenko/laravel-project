<?php

namespace App\Rules\Validation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class PasswordValidation implements Rule
{
    private string $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param $password
     * @return bool
     */
    public function passes($attribute, $password)
    {
        $data = [];

        Arr::set($data, $attribute, $password);

        $validator = Validator::make(
            $data,
            [
                $attribute => [
                    'required',
                    'string',
                    'max:8',
                    'min:3'
                ]
            ]
        );

        if ($validator->fails()) {
            $this->message = $validator->getMessageBag()->first();

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
