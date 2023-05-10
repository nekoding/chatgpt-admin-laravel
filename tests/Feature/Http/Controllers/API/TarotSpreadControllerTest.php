<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TarotSpreadControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_tarot_spread_data()
    {
        \App\Models\Language::factory([
            'title_id'  => '10123-spread-detail',
            'default'   => 'abc'
        ])->create();

        $this->get(route('api.tarot-spreads.index', ['locale' => 'en_us']))
            ->assertJsonCount(1, 'data')
            ->assertJsonIsObject()
            ->assertJson([
                'data' => [
                    [
                        'lang' => ['default' => 'abc']
                    ]
                ]
            ], false);
    }
}
