<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

     
        if ($request->role->user_id !== auth()->user()->id) {
            return redirect('/roles')->with('error', 'Unauthorized Page');
            
          }
          return $next($request);

            
        
    }
}
