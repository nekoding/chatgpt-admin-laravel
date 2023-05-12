<?php

namespace Tests\Feature\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        $user = \App\Models\User::factory()->create();

        $this->postJson(route('api.auth.login'), [
            'email' => $user->email,
            'password' => 'password'
        ])
            ->assertOk()
            ->assertJsonIsObject('data')
            ->assertSee('access_token');
    }

    public function test_register()
    {
        $fakedata = [
            'name'                  => 'Harkani',
            'email'                 => 'harkani@mail.com',
            'password'              => 'password',
            'password_confirmation' => 'password'
        ];

        $this->postJson(route('api.auth.signup'), $fakedata)
            ->assertCreated()
            ->assertJsonIsObject('data')
            ->assertSee('access_token');
    }

    public function test_logout()
    {
        $user = \App\Models\User::factory()->create();

        $token = Auth::guard('jwt')->login($user);

        $this->postJson(route('api.auth.logout'), [], [
            'Authorization' => 'Bearer ' . $token
        ])
            ->assertOk();

        $this->postJson(route('api.auth.logout'), [], [
            'Authorization' => 'Bearer ' . $token
        ])
            ->assertUnauthorized();
    }

    public function test_refresh_token()
    {
        $user = \App\Models\User::factory()->create();

        $token = Auth::guard('jwt')->login($user);

        $this->postJson(route('api.auth.refresh'), [], [
            'Authorization' => 'Bearer ' . $token
        ])
            ->assertOk();
    }
}
