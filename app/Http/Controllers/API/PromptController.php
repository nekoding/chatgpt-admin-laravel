<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Prompt\PromptCollection;
use App\Http\Resources\Prompt\PromptResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PromptController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $data = $request->validate([
            'key' => 'nullable|string'
        ]);

        $prompts = Cache::remember('prompts-api', now()->addMinutes(5), function () {
            return \App\Models\OpenAiPrompt::all();
        });

        if (isset($data['key'])) {
            return new PromptResource($prompts->where('key', $data['key'])->first());
        }

        return new PromptCollection($prompts);
    }
}
