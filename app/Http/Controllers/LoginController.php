<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\RegistraLog;

class LoginController extends Controller
{
    use RegistraLog;
    public function auth(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credenciais)) {
            if (!Auth::user()->ativo) {
                Auth::logout();
                return back()->with('erro', 'Sua conta está desativada.')->withInput();
            }

            $request->session()->regenerate();
            $this->registrarLog('login', 'Sistema', "Realizou login");
            return redirect()->intended('index');
        }

        return back()->with('erro', 'Email ou senha inválidos')->withInput();
    }

    public function logout(Request $request)
    {
        $this->registrarLog('logout', 'Sistema', "Realizou logout");

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}