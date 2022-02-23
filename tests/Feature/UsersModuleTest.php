<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    function LoadUsersList()
    {
        $this->get('usuarios')
        ->assertStatus(200)
        ->assertSee('Listado de usuarios')
        ->assertSee('Paco')
        ->assertSee('Juana');

    }

    /**
     * A basic test example.
     *
     * @test
     */
    function MessageEmptyList()
    {
        $this->get('usuarios?empty')
        ->assertStatus(200)
            ->assertSee('no hay usuarios registrados');
    }

    /** @test */
    function loadUsersDetails(){
        $this->get('usuarios/5')
        ->assertStatus(200)
        ->assertSee("Mostrando detalle del usuario: 5");
    }

    /* @test */
    function loadNewUserPage(){
        $this->get('/usuarios/nuevo')
        ->assertStatus(200)
        ->assertSee('Crear nuevo usuario');
    }
}
