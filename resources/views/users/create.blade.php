<!-- resources/views/createUser.blade.php -->

@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Crear Usuario</h2>
        <form method="POST" action="/users/createUser">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Nombre de usuario:</label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                @error('username')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña:</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                @error('password')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Rol:</label>
                <select id="role" name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                    <option value="">Selecciona un rol</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                    <!-- Agrega aquí las opciones que necesites -->
                </select>
                @error('role')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-between items-center">
                <input type="submit" value="Crear usuario" class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none">
            </div>
        </form>
    </div>
</div>
@endsection
