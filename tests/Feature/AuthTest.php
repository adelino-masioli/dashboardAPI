<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_default_user()
    {
        $this->post('/register', [
            'name'     => 'Junior Ferreira',
            'email'    => 'alfjuniorbh.web@gmail.com',
            'password' => 'secret'
        ])->assertStatus(302);
    }

    public function  test_corret_login()
    {
        $user = factory(User::class)->create();

        $this->postJson('/login', [
            'email'    => $user->email,
            'password' => 'secret'
        ])->assertStatus(200)
        ->assertJson([
            'status' => 'ok'
        ])->assertSessionHas('success', 'Successfully logged in.');
    }

    public function test_recive_wrong_messages_invalid_credentials()
    {
        $user = factory(User::class)->create();

        $this->postJson('/login', [
            'email'    => $user->email,
            'password' => 'wrong-pass'
        ])->assertStatus(422)
        ->assertJson([
            'message' => 'These credentials do not match our records.'
        ]);
    }
}
