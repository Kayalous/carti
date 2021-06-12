<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiTokensController extends Controller
{

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'password',
        ]);


        Auth::user()->tokens()->delete();


        return back(303);
    }


    protected function deleteApiToken(Request $request)
    {
        $request->validate([
            'password' => 'password',
            'token_id' => 'required'
        ]);


        Auth::user()->tokens()->where('id', $request->token_id)->delete();

        return back(303);

    }
}
