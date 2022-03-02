<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'welcome';
});

/** llamamos a los métodos del controlador deseado mediante @ */

Route::get('/usuarios', 'userController@index')
->name('users.index');

/* laravel lee las rutas en cascada, así que redireccionará directamente a la que coincida
esto puede hacer que no redirija a donde se desea, por lo que se puede poner una condición
o cambiar el orden (como en este caso) */

Route::get('/usuarios/nuevo', 'userController@create')
->name('users.create');

Route::get("/usuarios/{user}/editar", 'userController@edit')->name('users.edit');

/* introduciendo parámetro a través de la url (dinámico) */
/* laravel nos permite simplificar el recoger el id de usuario colocando {} */

Route::get('/usuarios/{user}', 'userController@show')
->where('user', '\w+')
->name('users.show');

Route::post('usuarios', 'userController@store');

/* parámetros opcionales */
/* si el controlador solo dispone de 1 método y este se llama __invoke podemos prescindir de llamar al método con @ */

Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');
