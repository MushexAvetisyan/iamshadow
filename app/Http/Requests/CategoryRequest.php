<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ];
    }
}
