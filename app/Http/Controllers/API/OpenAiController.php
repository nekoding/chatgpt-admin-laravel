<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpenAiController extends Controller
{

    /**
     * Save prompt and response from chat-gpt to database
     *
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'prompt' => 'required|string',
            'result' => 'required|string'
        ]);



        /**
         * [app_fe] -> [app_node] -> [app_be]
         *                        -> [chat_gpt]
         * 
         * 
         */
    }
}
