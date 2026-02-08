<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|strip_tags|min:10',
            'category_id' => 'required|exists:App\Models\Category,id'
        ];
    }
}
