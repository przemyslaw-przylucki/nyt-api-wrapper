<?php

namespace App\Http\Requests\Api;

use App\Rules\IsbnRule;
use Illuminate\Foundation\Http\FormRequest;

class NewYorkTimesBestSellerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'author' => ['nullable'],
            'isbn' => ['nullable', 'array'],
            'isbn.*' => [new IsbnRule],
            'title' => ['nullable'],
            'offset' => ['nullable', 'integer', 'multiple_of:20', 'min:0'],
        ];
    }
}
