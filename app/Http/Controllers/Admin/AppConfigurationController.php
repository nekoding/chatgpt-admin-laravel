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
        $apiKey = $data && isset($data->value) ? Crypt::decryptString($data['value']) : null;

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
        $configs = \App\Models\Config::whereIn('key', ['ai_model', 'max_token', 'temperature'])->get()->pluck('value', 'key');
        $openAiModelList = \App\Models\Config::OPENAI_MODEL;
        return view('pages.configurations.prompt.index', compact('openAiModelList', 'configs'));
    }

    public function openAiPromptStore(Request $request)
    {
        $data = $request->validate([
            'ai_model'      => 'required|string|in:' . implode(",", array_values(\App\Models\Config::OPENAI_MODEL)),
            'max_token'     => 'nullable|numeric',
            'temperature'   => 'nullable|numeric|min:0|max:2',
        ]);

        foreach ($data as $key => $value) {
            \App\Models\Config::updateOrCreate([
                'key'   => $key,
            ], [
                'value' => $value
            ]);
        }

        return response('OK');
    }
}
