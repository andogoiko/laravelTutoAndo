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

Route::get('/', function () {
    return 'welcome';
});

/** llamamos a los métodos del controlador deseado mediante @ */

Route::get('/usuarios', 'userController@index');

/* laravel lee las rutas en cascada, así que redireccionará directamente a la que coincida
esto puede hacer que no redirija a donde se desea, por lo que se puede poner una condición
o cambiar el orden (como en este caso) */

Route::get('/usuarios/nuevo', 'userController@create');

/* introduciendo parámetro a través de la url (dinámico) */
/* laravel nos permite simplificar el recoger el id de usuario colocando {} */

Route::get('/usuarios/{id}', 'userController@show')
->where('id', '\w+');

/* parámetros opcionales */
/* si el controlador solo dispone de 1 método y este se llama __invoke podemos prescindir de llamar al método con @ */

Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');
