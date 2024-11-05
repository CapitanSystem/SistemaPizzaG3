<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('rsc.login');
    }

    public function mostrarDashboard()
    {
        return view('rsc.dashboard');
    }

    protected function redirectTo()
    {
        return '/login';
    }


    public function login(Request $request)
    {
        $request->validate([
            'cUsuUsuario' => 'required',
            'cUsuPassword' => 'required',
        ]);

        // Buscar el usuario
        $usuario = Usuario::where('cUsuUsuario', $request->cUsuUsuario)->first();

        // Comprobar si el usuario existe
        if ($usuario) {
            // Comprobar la contraseña
            if (password_verify($request->cUsuPassword, $usuario->cUsuPassword)) {
                Auth::login($usuario); // Autenticamos al usuario
                return redirect()->intended('dashboard');
            } else {
                return back()->withErrors(['cUsuUsuario' => 'Credenciales incorrectas.']);
            }
        }

        return back()->withErrors(['cUsuUsuario' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
