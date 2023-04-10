<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_card_list()
    {

        \App\Models\Card::factory()->count(50)->create();

        $this->getJson(route('api.cards.index'))
            ->assertOk()
            ->assertSee(1234);
    }
}
