<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actingAsAdmin()
    {
        $this->actingAs(\App\Models\User::factory()->create());
    }
}
