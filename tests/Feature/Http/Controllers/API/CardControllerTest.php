<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        \App\Models\Card::factory()->count(50)->create();
    }

    public function test_get_card_list()
    {
        $this->getJson(route('api.cards.index', ['locale' => 'en_us', 'random_order' => 0, 'limit' => 50]))
            ->assertOk()
            ->assertJsonIsArray('data')
            ->assertJsonCount(50, 'data');
    }

    public function test_get_card_list_with_custom_limit()
    {
        $this->getJson(route('api.cards.index', ['locale' => 'en_us', 'random_order' => 0, 'limit' => 10]))
            ->assertOk()
            ->assertJsonIsArray('data')
            ->assertJsonCount(10, 'data');
    }

    public function test_get_card_list_with_random_order()
    {
        $this->getJson(route('api.cards.index', ['locale' => 'en_us', 'random_order' => 1, 'limit' => 10]))
            ->assertOk()
            ->assertJsonIsArray('data')
            ->assertJsonCount(10, 'data');
    }
}
