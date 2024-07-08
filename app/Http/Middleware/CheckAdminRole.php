<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckAdminRole
{
    public function handle($request, Closure $next)
    {
        $user = Session::get('user');

        if (!$user || $user['role'] !== 'admin') {
            return redirect('/products');
        }

        return $next($request);
    }
}
