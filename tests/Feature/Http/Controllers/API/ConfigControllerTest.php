<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

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
    }

    public function test_get_config()
    {
        $this->get(route('api.configs.index'))
            ->assertOk()
            ->assertJsonIsArray('data')
            ->assertJsonCount(5, 'data');
    }

    public function test_get_specific_config()
    {
        $this->get(route('api.configs.index', ['key' => 'api_key']))
            ->assertOk()
            ->assertJsonIsObject('data');
    }
}
