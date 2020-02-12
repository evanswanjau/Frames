<?php

namespace App\Http\Middleware;

use App\Provider;
use Closure;
use Illuminate\Support\Facades\Auth;

class ProviderMiddleware
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
        $provider = Provider::findOrFail(Auth::guard('provider')->user()->id);

        if ($provider->register_status == 0){
            Auth::guard('provider')->logout();
            session()->flash('message','Your account Not Active Yet.');
            session()->flash('type','warning');
            return redirect('/provider');
        }
        if ($provider->status == 1){
            Auth::guard('provider')->logout();
            session()->flash('message','Your account is Blocked.');
            session()->flash('type','danger');
            return redirect('/provider');
        }


        return $next($request);
    }
}
