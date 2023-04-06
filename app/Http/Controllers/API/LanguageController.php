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
     */
    public function __invoke(Request $request)
    {
        // /api/languages?locale=en_us -> ambil data translate yang pake en_us aja, jika localenya tidak ketemu ambil base nya aja
        $data = $request->validate([
            'locale'    => 'required|string'
        ]);

        $data = Cache::remember($data['locale'], now()->addMinutes(), function () use ($data) {
            $result = \App\Models\Language::when($data['locale'], function (Builder $query, $value) {
                return $query->with(['translates' => function ($q) use ($value) {
                    return $q->where('lang_code', $value);
                }]);
            })->get();


            $result = $result->map(function ($item) {
                return [
                    $item['title_id'] => [
                        'default'   => $item['default'],
                        'translate' => $item->translates[0]?->text ?? null
                    ]
                ];
            })->toArray();

            return $result;
        });

        return response()->json([
            'status'    => 200,
            'message'   => 'OK',
            'data'      => $data
        ]);
    }
}
