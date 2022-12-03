<?php

namespace App\Rules\Validation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class UserFilterValidation implements Rule
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
     * @param string $attribute
     * @param mixed $password
     * @return bool|JsonResponse
     */
    public function passes($attribute, $password): JsonResponse|bool
    {
        $allowedKeys = ['id', 'email', 'createdAt'];
        $data = [];

        Arr::set($data, $attribute, $password);

        try {
            $keys = array_keys(json_decode($data[$attribute], true));
        } catch (\Throwable $exception) {
            $this->message = $exception->getMessage();

            return false;
        }

        $diffs = array_diff($keys, $allowedKeys);
        foreach ($diffs as $diff) {
            if (!in_array($diff, $allowedKeys)) {
                $this->message = sprintf('Set correct filters, %s is not allowed', $diff);
                return false;
            }
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
