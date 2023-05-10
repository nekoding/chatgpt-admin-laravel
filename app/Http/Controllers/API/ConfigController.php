<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConfigController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $params = $request->validate([
            'key' => 'nullable|string'
        ]);

        if (isset($params['key'])) {
            $config = Cache::remember('config-' . $params['key'], now()->addMinutes(5), function () use ($params) {
                return \App\Models\Config::select('key', 'value')->where('key', $params['key'])->first();
            });

            return new \App\Http\Resources\Config\ConfigResource($config);
        }

        $configs = Cache::remember('config-app', now()->addMinutes(5), function () {
            return \App\Models\Config::select('key', 'value')->get();
        });

        return new \App\Http\Resources\Config\ConfigCollection($configs);
    }
}
