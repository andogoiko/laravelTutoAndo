<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    function WelcomeUsersWithNickname()
    {
        $this->get('saludo/paco/paquisimo')
        ->assertStatus(200)
        ->assertSee("Bienvenido paco, tu apodo es: paquisimo");
    }

    /** @test */

    function WelcomeUsersNoNickname()
    {
        $this->get('saludo/paco')
        ->assertStatus(200)
        ->assertSee("Bienvenido paco, no tienes apodo");
    }
}
