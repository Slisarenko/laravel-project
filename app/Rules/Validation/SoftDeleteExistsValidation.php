<?php

namespace App\Rules\Validation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

class SoftDeleteExistsValidation implements Rule
{
    private string $message;
    private string $table;

    /**
     * Create a new rule instance.
     *
     * @param $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $data = [];

        Arr::set($data, $attribute, $value);

        $validator = Validator::make(
            $data,
            [
                $attribute => [
                    ValidationRule::exists($this->table)->where(function ($query) {
                        return $query->where('deleted_at', null);
                    }),
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
