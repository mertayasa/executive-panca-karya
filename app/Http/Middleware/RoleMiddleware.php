<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware{

    public function handle($request, Closure $next, $role_name){
        $role = $role_name == 'staff' ? 0 : ($role_name == 'owner' ? 1 : 2);
        if(Auth::user()->level != $role){
            abort(403);
        }
        return $next($request);
    }
}
