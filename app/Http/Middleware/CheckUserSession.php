<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckUserSession
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }
    
        Log::info('User session exists:', Session::get('user'));
        return $next($request);
    }
    
}