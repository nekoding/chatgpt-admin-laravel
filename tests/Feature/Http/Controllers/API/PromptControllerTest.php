<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PromptControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_prompts()
    {
        \App\Models\OpenAiPrompt::factory()->count(4)->create();

        $this->get(route('api.prompts.index'))
            ->assertJsonCount(4, 'data')
            ->assertJsonIsArray('data');
    }

    public function test_get_specific_prompts()
    {
        $prompts = \App\Models\OpenAiPrompt::factory()->count(4)->create();
        $this->get(route('api.prompts.index', ['key' => $prompts[0]->key]))
            ->assertJsonIsObject('data');
    }
}
