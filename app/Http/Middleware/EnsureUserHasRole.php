<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $userRole = $user->role ?? 'guest';

        if (! in_array($userRole, $roles)) {
            abort(403, 'Unauthorized. You do not have permission to access this area.');
        }

        return $next($request);
    }
}
