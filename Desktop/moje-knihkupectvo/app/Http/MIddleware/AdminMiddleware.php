<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {
    public function handle(Request $request, Closure $next) {
        if (!auth()->user() || !auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Nemáš oprávnenie na prístup do admina.');
        }
        return $next($request);
    }
}