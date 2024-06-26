<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MethodSpoofing
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('_method')) {
            $request->setMethod($request->input('_method'));
        }

        return $next($request);
    }
}
