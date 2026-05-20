<?php

// app/Http/Middleware/IsAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            //abort(403);
            return redirect('/abort/403')
                ->with('error', 'You are not allowed here.');
        }

        return $next($request);
    }
}