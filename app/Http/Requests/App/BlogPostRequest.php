<?php

namespace App\Http\Requests\App;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:80'],
            'content' => ['required', 'max:1024'],
        ];
    }
}
