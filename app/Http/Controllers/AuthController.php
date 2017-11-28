<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class AuthController extends Controller {

    public function login () {
        $data = [
            'title' => 'Entrar',
            'section' => 'login',
        ];
        return view ('login.login', $data);
    }

    public function doLogin (Request $request) {
        $email = $request->input ('email');
        $password = $request->input ('password');

        if (Auth::attempt (['email' => $email, 'password' => $password])) {
            return redirect ()->route ('events.index');
        } else {
            return back ()->with ('error', 'El email o la contraseña son incorrectos');
        }
    }

    public function logout () {
    	Auth::logout ();
        return redirect()->route('index');
    }
}
