<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageManagementControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_guard_access()
    {
        //
    }

    public function test_list_data()
    {
        //
    }

    public function test_insert_data()
    {

        $this->actingAsAdmin();

        $form = [
            'title_id'  => 'testing',
            'default'   => 'testing',
            'translations'  => [
                'en_us'     => 'testing',
                'en_uk'     => 'testing',
                'ja_jp'     => 'テスト',
                'in_id'     => 'pengujian',
                'zh_cn'     => '測試'
            ]
        ];

        $this->post(route('languages.store'), $form)
            ->assertRedirect(route('languages.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseCount('languages', 1);
        $this->assertDatabaseCount('language_translations', 5);
    }

    public function test_update_data()
    {
        //
    }

    public function test_delete_data()
    {
        //
    }

    public function test_import_data()
    {
        //
    }
}
