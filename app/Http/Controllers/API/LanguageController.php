<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LanguageController extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'locale'    => 'required|string',
            'title_id'  => 'nullable|string'
        ]);

        $response = Cache::remember($data['locale'], now()->addMinutes(5), function () use ($data) {
            return \App\Models\Language::with([
                'translates' => fn ($query) => $query->where('lang_code', $data['locale'])
            ])->get();
        });

        if (isset($data['title_id'])) {
            $response = $response->filter(fn ($item) => $item->title_id == $data['title_id'])->first();
            return new \App\Http\Resources\Language\LanguageResource($response);
        }

        return new \App\Http\Resources\Language\LanguageCollection($response);
    }
}
