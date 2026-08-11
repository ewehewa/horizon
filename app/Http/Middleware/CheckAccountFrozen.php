<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountFrozen
{
    /**
     * Handle an incoming request.
     * If the user's account is frozen, redirect to the frozen notice page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->account_frozen) {
            // Allow access to the frozen notice page itself, logout, and support
            $allowed = [
                'account.frozen',
                'logout',
                'support',
            ];

            if (!in_array($request->route()->getName(), $allowed)) {
                return redirect()->route('account.frozen');
            }
        }

        return $next($request);
    }
}
