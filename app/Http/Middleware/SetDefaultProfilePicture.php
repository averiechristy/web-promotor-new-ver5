<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultProfilePicture
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && !$user->avatar) {
            // Assign default profile picture to the user
            $user->avatar = 'default.jpg'; // Ganti dengan nama file default Anda
            $user->save();
        }
    
        return $next($request);
    }
}
