<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\TokenGuard;

class ApiAuthenticate
{
    protected $auth;

    public function __construct(Request $request, AuthManager $auth) {
        $this->HeaderSecKey = 'Authorization';
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = 'api') {
        $res401 = response(['isSuccess' => false, 'message' => 'Unauthorized', 'errorCode' => 401], 401);

        if (empty($this->auth->guard('api')->user())) {
            return $res401;
        }

        $request->user = auth('api')->user();
        define('_user', $request->user);
        if(!_user->is_active) {
            return $res401;
        }
        return $next($request);
    }
}

