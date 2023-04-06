<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AppConfigurationController extends Controller
{

    public function openAiConfigIndex()
    {
        $data = \App\Models\Config::where('key', 'api_key')->first();
        $apiKey = $data ? Crypt::decryptString($data['value']) : null;

        return view('pages.configurations.openai.index', compact('apiKey'));
    }

    public function openAiConfigStore(Request $request)
    {
        $data = $request->validate([
            'api_key' => 'required|string'
        ]);

        // save to database
        $encrypted = Crypt::encryptString($data['api_key']);

        \App\Models\Config::updateOrCreate([
            'key'   => 'api_key',
        ], [
            'value' => $encrypted
        ]);

        return response('OK');
    }
}
