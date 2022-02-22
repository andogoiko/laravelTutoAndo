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

Route::get('/usuarios', function(){
    return 'Usuarios';
});

/* laravel lee las rutas en cascada, así que redireccionará directamente a la que coincida
esto puede hacer que no redirija a donde se desea, por lo que se puede poner una condición
o cambiar el orden (como en este caso) */

Route::get('/usuarios/nuevo', function () {
    return 'Crear nuevo usuario';
});

/* introduciendo parámetro a través de la url (dinámico) */
/* laravel nos permite simplificar el recoger el id de usuario colocando {} */

Route::get('/usuarios/{id}', function ($id) {
    return "Mostrando detalle del usuario: {$id}";
})->where('id', '\w+');

/* parámetros opcionales */

Route::get('/saludo/{name}/{nickname?}', function($name, $nickname = null){
    if($nickname){
        return "Bienvenido {$name}, tu apodo es: {$nickname}";
    }else{
        return "Bienvenido {$name}, no tienes apodo";
    }
});
