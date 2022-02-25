<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UsersModuleTest extends TestCase
{

    //recrea la database antes de ejecutar las pruebas, asií no hay que andar cambiando las variables de entorno
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @test
     */
    function LoadUsersList()
    {

        factory(User::class)->create([
            'name' => 'Paco',
            'email' => 'Paquisimo@gmail.com',
            'password' => 'Paco',
            'profession_id' => null,
            'is_admin' => true,
        ]);


        $this->get('usuarios')
        ->assertStatus(200)
        ->assertSee('Listado de usuarios')
        ->assertSee('Paco');

    }

    /**
     * A basic test example.
     *
     * @test
     */
    function MessageEmptyList()
    {

        //DB::table('users')->truncate();

        $this->get('usuarios')
        ->assertStatus(200)
            ->assertSee('no hay usuarios registrados');
    }

    /** @test */
    function displayUsersDetails(){

        $user = factory(User::class)->create([
            'name' => 'Alfredo Vidal'
        ]);

        $this->get('usuarios/'.$user->id)
        ->assertStatus(200)
        ->assertSee("Alfredo Vidal");
    }

    /* @test */
    function loadNewUserPage(){
        $this->get('/usuarios/nuevo')
        ->assertStatus(200)
        ->assertSee('Crear nuevo usuario');
    }
}
