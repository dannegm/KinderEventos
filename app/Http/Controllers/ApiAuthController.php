<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller {
    protected function guard() {
        return Auth::guard('api');
    }

    public function requestToken (Request $request) {

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $exp = time() + (30 * 24 * 60 * 60);
            $header = [
                'email' => $email,
                'password' => $password
            ];
            $header = implode('|', $header);

            $playload = [
                'iss' => '__hostname_here__',
                'company' => 'Kinder',
                'exp' => $exp,
            ];
            $playload = implode('|', $playload);
            $token = hash_hmac('sha256', $header . $playload, env('APP_SECRET', 'SOMETHING HERE'));
            
            $user = User::find( Auth::id () );
            $user->auth_token = $token;
            $user->save();

            return response()->json([
                'status' => '200',
                'message' => 'Auth success',
                'token' => $token,
                'username' => $user->name,
                'email' => $user->email,
                'data' => [
                    'user' => $user->email,
                    'token' => $token,
                    'exp' => $exp
                ]
            ], 200);

        } else {
            return response()->json([
                'status' => '403',
                'message' => 'Invalid User'
            ], 403);
        }
    }

    // Logout
    public function logout (Request $request) {
        $exp = time() + (30 * 24 * 60 * 60);
        $playload = [
            'iss' => '__hostname_here__',
            'company' => 'Kinder',
            'exp' => $exp,
        ];
        $playload = implode('|', $playload);
        $token = hash_hmac('sha256', $playload, env('APP_SECRET', 'SOMETHING HERE'));
            
        $user = User::find( Auth::guard('api')->id() );
        $user->auth_token = $token;
        $user->save();

        Auth::logout();

        return response()->json([
            'status' => '200',
            'message' => 'logout success'
        ], 200);
    }
}
