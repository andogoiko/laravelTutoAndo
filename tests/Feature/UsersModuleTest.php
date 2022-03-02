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

        $this->assertDatabaseMissing('users', [
            'email'=> 'hola@pruebita.net',
        ]);

    }

    /** @test */

    function emailIsRequired()
    {


        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'owo',
                'email' => '',
                'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());

     
    }

    /** @test */

    function emailMustBeValid()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'carmen',
                'email' => 'soy-carmen',
                'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test */

    function emailMustBeUnique()
    {

        factory(User::class)->create([
            'email' => 'factoria@gmail.com'
        ]);

        $this->from('usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => 'factoria',
            'email' => 'factoria@gmail.com',
            'password' => '123456'
        ])->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    /** @test */

    function passwordIsRequired()
    {


        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'pipo',
                'email' => 'pipo@gmail.com',
                'password' => ''
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function loadEditUserPage()
    {

        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            ->assertViewHas('user', function($viewUser) use ($user){ //comprueba que el usuario existe, si no existe la prueba no pasa
                return $viewUser->id == $user->id;
            });
    }

    /** @test */

    function itUpdatesUser()
    {

        $user = factory(User::class)->create();

        $this->put("/usuarios/$user->id", [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}");
        $this->assertCredentials([
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => '123456',
        ]);
    }

    /** @test */

    function nameIsRequiredWhenUpdating()
    {

        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
        ->put("usuarios/{$user->id}", [
                'name' => '',
                'email' => 'hola@pruebita.net',
                'password' => '123456'
            ])->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', [
            'email' => 'hola@pruebita.net',
        ]);
    }


    /** @test */

    function emailMustBeValidWhenUpdating()
    {

        $user = factory(User::class)->create(['name' => 'NombreEste']);

        $this->from("usuarios/{$user->id}/editar")
        ->put("usuarios/{$user->id}", [
            'name' => 'Pruebita',
            'email' => 'correo-no-valido',
            'password' => '123456'
        ])->assertRedirect("usuarios/{$user->id}/editar")
        ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Pruebita',
        ]);
    }

    /** @test */

    function emailMustBeUniqueWhenUpdating()
    {

        factory(User::class)->create([
            'email' => 'existe@gmail.com'
        ]);

        $user = factory(User::class)->create([
            'email' => 'sisoy@pruebita.net'
        ]);

        $this->from("usuarios/{$user->id}/editar")
        ->put("usuarios/{$user->id}", [
            'name' => 'Ereh',
            'email' => 'existe@gmail.com',
            'password' => '123456'
        ])->assertRedirect("usuarios/{$user->id}/editar")
        ->assertSessionHasErrors(['email']);

        
    }

    /** @test */

    function emailIsOptionalWhenUpdating()
    {

        

        $user = factory(User::class)->create([
            'email' => 'joselito@gmail.com'
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Joselito',
                'email' => 'joselito@gmail.com',
                'password' => '12345678'
            ])->assertRedirect("usuarios/{$user->id}"); // (users.show)

        $this->assertDatabaseHas('users', [
            'name' => 'Joselito',
            'email' => 'joselito@gmail.com'
        ]);
    }

    /** @test */

    function passwordIsOptionalWhenUpdating()
    {

        $oldPassword = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->from("usuarios/{$user->id}/editar")
        ->put("usuarios/{$user->id}", [
            'name' => 'waaaa',
            'email' => 'waaaa@pruebita.net',
            'password' => ''
        ])->assertRedirect("usuarios/{$user->id}"); // (users.show)

        $this->assertCredentials([
            'name' => 'waaaa',
            'email' => 'waaaa@pruebita.net',
            'password' => $oldPassword //Moito importante
        ]);
    }

    /** @test */

    function itDeletesAUser()
    {

        

        $user = factory(User::class)->create([
            'email' => 'pepoclown@gmail.com'
        ]);

        $this->delete("usuarios/{$user->id}")
        ->assertRedirect('usuarios');

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);

        $this->assertSame(0, User::count());

    }
   
}
