<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:App\Models\User,id',
            'title' => 'required',
            'language_id' => 'required',
            'post_category_id' => 'required',
            'content' => 'required|strip_tags|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
