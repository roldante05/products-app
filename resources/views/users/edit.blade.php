<!-- resources/views/editUser.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Usuario</h1>
        
        <form action="/users/update/{{ $id }}" method="post">
            @csrf

            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nombre de usuario</label>
                <input type="text" class="w-full mt-2 p-2 border border-gray-300 rounded-lg" id="username" name="username" value="{{ $user['username'] }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input type="password" class="w-full mt-2 p-2 border border-gray-300 rounded-lg" id="password" name="password" value="{{ $user['password'] }}">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700">Rol</label>
                <select id="role" name="role" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
                    <option value="">Selecciona un rol</option>
                    <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user['role'] == 'user' ? 'selected' : '' }}>User</option>
                    <!-- Agrega aquí las opciones que necesites -->
                </select>
            </div>

            <button type="submit" class="w-full bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection
