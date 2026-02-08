<?php

namespace App\Services\Language;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageService
{
    /**
     * @param Request $request
     * @return array
     */
    public static function getViewData(Request $request): array
    {
        return[
            'languages' => Language::with('book')
                ->withCount('book')
                ->search($request->get('search'))
                ->sortable()->latest()->paginate(10),
        ];
    }
}
