<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //Método para regresar vista de registro
    public function registerForm()
    {
        return view('auth.register');
    }

    //Método para registrar los usuarios
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);


        //Incio de sesión automatico
        Auth::login($user);

        return redirect()->route('libros.index');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    //Metodo para iniciar sesion
    public function login(Request $request)
    {

        //Validar datos en el formulario
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //Intentar realizar el ini inicio de sesion con la informacion proporcionada del formulario
        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            //Ruta a la que se redirige despues de iniciar sesion
            return redirect()->route('libros.index');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ]);
    }

    //metodo para cerrar sesión

    public function logout(Request $request)
    {
        //cerrrar sesion
        Auth::logout();

        //cerrar credenciales del usuario
        $request->session->invalidate();
        $request->session->regenerateToken();

        return redirect('/acceso');
    }

    //metodo para regresar vista admin

    public  function adminDashboard()
    {
        return view('admin.dashboard');
    }
}
