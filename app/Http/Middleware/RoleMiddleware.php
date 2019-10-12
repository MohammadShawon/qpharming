<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        
        if(Auth::guest())
        {
            return redirect()->to('login');
        }
        /*
         * Check the user role
         * */
        $role = explode('|',$role);
        foreach($role as $value)
        {
            if ($request->user()->hasRole($value))
            {
                return $next($request);
            }
        }
        
        

        /*
         * Check the Individual Permission
         * */
        if ($permission !== null && !$request->user()->can($permission))
        {
            abort(404);
        }
        
    }
}
