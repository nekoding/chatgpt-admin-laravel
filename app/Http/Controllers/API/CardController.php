<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $params = $request->validate([
            'locale'        => 'required|string',
            'limit'         => 'nullable|numeric',
            'random_order'  => 'nullable|boolean'
        ]);

        $cards = \App\Models\Card::limit($params['limit'] ?? 20)->with([
            'titleLang.translates' => fn ($query) => $query->where('lang_code', $params['locale']),
            'uprightLang.translates' => fn ($query) => $query->where('lang_code', $params['locale']),
            'reversedLang.translates' => fn ($query) => $query->where('lang_code', $params['locale'])
        ])
            ->when($params['random_order'], function ($query, $value) {
                if ($value) {
                    return $query->inRandomOrder();
                }

                return $query;
            })
            ->get();

        return new \App\Http\Resources\Card\CardCollection($cards);
    }
}
