<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function index(){
        /** llamamos a la vista simplemente poniendo el nombre del archivo */

        //$users = DB::table('users')->get();

        $users = User::all();

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

        return view('users.index', compact('title', 'users'));
    }

    public function show(User $user){

        return view('users.show')->with('user', $user);
    }

    public function create(){
        return view('users.create');
    }

    public function store(){
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users.index');
    }
}
