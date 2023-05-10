<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_all_languages()
    {
        \App\Models\Language::factory([
            'title_id'  => uniqid(),
            'default'   => 'abc'
        ])->create();

        $this->get(route('api.languages.index', ['locale' => 'en_us']))
            ->assertJsonCount(1, 'data')
            ->assertJsonIsArray('data');
    }

    public function test_get_specific_title_id()
    {
        \App\Models\Language::factory([
            'title_id'  => 'abc',
            'default'   => 'def'
        ])->create();

        $this->get(route('api.languages.index', ['locale' => 'en_us', 'title_id' => 'abc']))
            ->assertJsonIsObject('data');
    }
}
