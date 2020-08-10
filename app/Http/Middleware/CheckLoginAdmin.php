<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->isSupperAdmin()){
                return $next($request);
            }
        }
        return redirect()->route('admin.login.get');
    }
}
