<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class isOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
 
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $userOwner = User::where('name', 'owner')->first();

        if($user && $user->id === $userOwner->id){
            return $next($request);
        }

        return response()->json([
            'message' => 'anda tidak bisa akses halaman owner',
        ], 401);
    }
}