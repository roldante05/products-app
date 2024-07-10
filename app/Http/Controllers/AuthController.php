<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $validator = $this->validator($request);
    
        if ($validator->fails()) {
            return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        $users = json_decode(file_get_contents(base_path('users.json')), true);
    
        foreach ($users as $user) {
            if ($user['username'] === $request->username && Hash::check($request->password, $user['password'])) {
                session(['user' => [
                    'username' => $user['username'],
                    'role' => $user['role'],
                ]]);
                Log::info('User logged in:', session('user'));
                return redirect('/products');
            }
        }
    
        return redirect('/login')->with('error', 'Invalid credentials');
    }
    

    public function logout()
    {
        session()->forget('user');
        return redirect('/login');
    }

    public function validator($request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $messages = [
            'username.required' => 'El campo nombre de usuario es obligatorio',
            'username.string' => 'El campo nombre de usuario debe ser una cadena de texto',
            'username.max' => 'El campo nombre de usuario no puede tener más de 255 caracteres',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.string' => 'El campo contraseña debe ser una cadena de texto',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres',
        ];

        $validator->setCustomMessages($messages);

        return $validator;
    }
}
