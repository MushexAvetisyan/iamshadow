<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover' => 'required|file',
            'image' => 'nullable|file',
            'pages' => 'required|integer',
            'year' => 'required|integer',
            'author_id' => 'required|exists:authors,id', // Ensure a valid author_id
            'language_id' => 'required|exists:languages,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
