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

    /** @test */
    function displayError404IfUserNoExist(){
        $this->get('/usuarios/999')
        ->assertStatus(404)
        ->assertSee('Página no encontrada');
    }

    /** @test */
    function loadNewUserPage(){
        $this->get('/usuarios/nuevo')
        ->assertStatus(200)
        ->assertSee('Crear usuario');
    }

    /** @test */

    function itCreatesNewUser(){

        
        $this->post('/usuarios/', [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect('usuarios');
        $this->assertCredentials([
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => '123456',
        ]);
    }

    /** @test */

    function nameIsRequired()
    {
         
        
        $this->from('usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => '',
            'email' => 'hola@pruebita.net',
            'password' => '123456'
        ])->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());

        //$this->assertDatabaseMissing('users', [
        //    'email'=> 'duilio@styde.net',
        //]);

    }
   
}
