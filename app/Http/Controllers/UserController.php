<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = json_decode(file_get_contents(base_path('users.json')), true);
        return view('users.list', ['users' => $users]);
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect('/create-user')
                ->withErrors($validator)
                ->withInput();
        }

        // Leer el archivo users.json
        $users = json_decode(file_get_contents(base_path('users.json')), true);

        // Crear un nuevo usuario
        $newUser = [
            'id' => count($users) + 1, // Asignar un ID único al nuevo usuario
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ];

        // Añadir el nuevo usuario al array de usuarios
        $users[] = $newUser;

        // Guardar el array de usuarios en el archivo users.json
        file_put_contents(base_path('users.json'), json_encode($users));

        return redirect('/users');
    }
    public function edit($id)
    {
        $users = json_decode(file_get_contents(base_path('users.json')), true);
        $user = $users[$id];

        return view('users.edit', ['user' => $user, 'id' => $id]);
    }

    public function destroy($id)
    {
        $users = json_decode(file_get_contents(base_path('users.json')), true);

        // Eliminar el usuario del array
        unset($users[$id]);

        // Guardar el array de usuarios en el archivo users.json
        file_put_contents(base_path('users.json'), json_encode($users));

        return redirect('/users');
    }
    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect('users/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $users = json_decode(file_get_contents(base_path('users.json')), true);

        $users[$id] = [
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ];

        file_put_contents(base_path('users.json'), json_encode($users));

        return redirect('/users');
    }
    public function show()
    {
        return view('users.create');
    }


    public function validator($request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:255',
        ]);

        $messages = [
            'username.required' => 'El campo nombre de usuario es obligatorio',
            'username.string' => 'El campo nombre de usuario debe ser una cadena de texto',
            'username.max' => 'El campo nombre de usuario no puede tener más de 255 caracteres',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.string' => 'El campo contraseña debe ser una cadena de texto',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres',
            'role.required' => 'El campo rol es obligatorio',
            'role.string' => 'El campo rol debe ser una cadena de texto',
            'role.max' => 'El campo rol no puede tener más de 255 caracteres',
        ];

        $validator->setCustomMessages($messages);

        return $validator;
    }
}
