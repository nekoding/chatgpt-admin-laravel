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
            'random_order'  => 'nullable|boolean',
            'image_type'    => 'nullable|string'
        ]);

        // handle limit abuse
        if (isset($params['limit'])) {

            // if user try to spam limit data with more than 50
            // set 50 data only
            if ($params['limit'] > 50) {
                $params['limit'] = 50;
            }
        }

        $cards = \App\Models\Card::limit($params['limit'] ?? 20)->with([
            'titleLang.translates' => fn ($query) => $query->where('lang_code', $params['locale']),
            'uprightLang.translates' => fn ($query) => $query->where('lang_code', $params['locale']),
            'reversedLang.translates' => fn ($query) => $query->where('lang_code', $params['locale'])
        ])
            ->when($params['random_order'] ?? false, function ($query, $value) {
                if ($value) {
                    return $query->inRandomOrder();
                }

                return $query;
            })
            ->when($params['image_type'] ?? false, function ($query, $value) {
                if ($value) {
                    return $query->with(['images' => function ($query) use ($value) {
                        return $query->where('data->card_key', $value);
                    }]);
                }

                return $query;
            })
            ->get();

        return new \App\Http\Resources\Card\CardCollection($cards);
    }
}
