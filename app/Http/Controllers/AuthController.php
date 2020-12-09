<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login() {
        return view('administracion.auth.login');
    }

    public function auth(Request $request) {

        $credencials = $request->only(['email','password']);

        if (Auth::attempt($credencials)) {
            return redirect('/administracion/pedidos');
        }

        return back();

    }

}
