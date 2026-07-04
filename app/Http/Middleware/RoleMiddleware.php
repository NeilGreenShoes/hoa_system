<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['email' => 'Please log in first.']);
        }

        $userRole = strtolower(Auth::user()->role->roleName);

        $lowercaseRoles = array_map('strtolower', $roles);

        if (!in_array($userRole, $lowercaseRoles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
