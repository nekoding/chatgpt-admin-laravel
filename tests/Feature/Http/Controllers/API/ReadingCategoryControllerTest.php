<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadingCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_tarot_reading_category()
    {
        \App\Models\Language::factory([
            'title_id'  => '10123-category_title',
            'default'   => 'abc'
        ])->create();

        $this->get(route('api.reading-categories.index', ['locale' => 'en_us']))
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
