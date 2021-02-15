<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WinkAuthenticate
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('wink')->check()) {
            auth()->shouldUse('wink');
        } else {
            throw new AuthenticationException(
                'Unauthenticated.',
                ['wink'],
                route('wink.auth.login')
            );
        }

        return $next($request);
    }
}
