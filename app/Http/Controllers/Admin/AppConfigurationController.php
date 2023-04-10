<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AppConfigurationController extends Controller
{

    /**
     * Handle OpenAI Index Page
     *
     * @return void
     */
    public function openAiConfigIndex()
    {
        $data = \App\Models\Config::where('key', 'api_key')->first();
        $apiKey = $data ? Crypt::decryptString($data['value']) : null;

        return view('pages.configurations.openai.index', compact('apiKey'));
    }

    /**
     * Handle OpenAI Store 
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
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

    public function openAiPromptIndex()
    {
        $openAiModelList = \App\Models\Config::OPENAI_MODEL;
        return view('pages.configurations.prompt.index', compact('openAiModelList'));
    }

    public function openAiPromptStore(Request $request)
    {
        //
    }
}
