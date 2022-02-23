<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function index(){
        /** llamamos a la vista simplemente poniendo el nombre del archivo */
        
        $users = [
            'Paco',
            'Carmen',
            'Joselito',
            'Alfredo',
            'Juana'
        ];

        $title = 'Listado de usuarios';

        // son lo mismo

        /**
            *return view('users', [
            *    'users' => $users,
            *    'title' => 'Listado de usuarios'
            *]);
         */

        /* return view('users')->with([
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]); */

        return view('users', compact('title', 'users'));
    }

    public function show($id){
        return "Mostrando detalle del usuario: {$id}";
    }

    public function create(){
        return 'Crear nuevo usuario';
    }
}
