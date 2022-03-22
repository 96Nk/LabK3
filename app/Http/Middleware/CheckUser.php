<?php

namespace App\Http\Middleware;

use App\Helpers\CookieHelper;
use App\Models\UserSession;
use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_active === 1) {
            return $next($request);
        }
        auth()->logout();
        return redirect(route('login'));
    }
}
