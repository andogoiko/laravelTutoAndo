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

    public function show($id){

        return view('users.show')->with('id', $id);
    }

    public function create(){
        return view('users.new');
    }
}
