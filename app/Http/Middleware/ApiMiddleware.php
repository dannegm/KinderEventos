<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;

class ApiMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $token = $request->input('auth_token');

        if ( empty($token) ) {
            return response()->json([
                'status' => '403',
                'errno' => 1,
                'message' => 'Token needed'
            ], 403);
        }

        $users = User::where('auth_token', $token);
        if ($users->count () == 0) {
            return response()->json([
                'status' => '403',
                'errno' => 2,
                'message' => 'Invalid Token'
            ], 403);

        } else {
            $user = $users->first();
            Auth::guard('api');
            Auth::login($user);
            return $next($request);
        }
    }
}