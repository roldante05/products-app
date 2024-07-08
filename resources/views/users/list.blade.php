<!-- resources/views/users.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Usuarios</h1>
    <div class="flex justify-between mb-4">
        <a href="/users/create" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Crear usuario</a>
    </div>
    <div id="users-table">
        @if (count($users) > 0)
        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nombre de usuario</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $id => $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user['username'] }}</td>
                        <td class="border px-4 py-2">{{ $user['role'] }}</td>
                        <td class="border px-4 py-2">
                            <a href="/users/edit/{{ $id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                            <form action="/users/destroy/{{ $id }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 flex justify-center">
        </div>
        @else
            <p class="text-gray-500">No hay usuarios disponibles.</p>
        @endif
    </div>
</div>
@endsection
