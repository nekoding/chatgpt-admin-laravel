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
        // /api/languages?locale=en_us -> ambil data translate yang pake en_us aja, jika localenya tidak ketemu ambil base nya aja
        $data = $request->validate([
            'locale'    => 'required|string'
        ]);

        $response = Cache::remember($data['locale'], now()->addMinutes(5), function () use ($data) {
            return \App\Models\Language::with([
                'translates' => fn ($query) => $query->where('lang_code', $data['locale'])
            ])->get();
        });

        return new \App\Http\Resources\Language\LanguageCollection($response);
    }
}
