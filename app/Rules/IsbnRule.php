<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsbnRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return is_string($value) && (10 === strlen($value) || 13 === strlen($value));
    }

    public function message(): string
    {
        return 'ISBN must be 10 or 13 characters long.';
    }
}
