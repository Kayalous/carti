<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function show () {
        if (Auth::user()->can('administrate'))
            return Inertia::location('/admin');
        else
            return Inertia::location('/user/profile');
    }
}
