<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Merchant
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->can('add products'))
            return $next($request);

        request()->session()->flash('flash.banner', "You don't have permission to add items.");
        request()->session()->flash('flash.bannerStyle', 'danger');
        return back();
    }
}