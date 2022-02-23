<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function __invoke($name, $nickname = null){
        if($nickname){
            
            return view('welcomeUser')
                ->with('name', $name)
                ->with('nickname', $nickname);;
        }else{
            
            return view('welcomeUserNoNickname')
                ->with('name', $name);
        }
    }
}
