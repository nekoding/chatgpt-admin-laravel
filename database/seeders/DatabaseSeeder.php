<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $configSeeder = [
            'api_key'       => null,
            'max_token'     => null,
            'temperature'   => null,
            'prompt'        => 'example prompt',
            'ai_model'      => \App\Models\Config::OPENAI_MODEL["GPT3Dot5Turbo"]
        ];

        foreach ($configSeeder as $key => $value) {
            \App\Models\Config::create([
                'key'   => $key,
                'value' => $value
            ]);
        }

        $prompts = [
            [
                'key'               => 'prompt-1',
                'prompt_template'   => 'Example prompt chat gpt'
            ]
        ];

        \App\Models\OpenAiPrompt::upsert($prompts, ['key', 'prompt_template']);
    }
}
