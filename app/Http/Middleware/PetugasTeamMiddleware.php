<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PetugasTeamMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // belum join team
        if ($user->ketuaTeams()->count() == 0 && $user->teams()->count() == 0) {
            return redirect()->route('belum.team');
        }

        return $next($request);
    }
}