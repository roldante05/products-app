@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Inicia sesión en tu cuenta
            </h2>
        </div>
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="my-2" >
                    <label for="username" class="sr-only">Usuario</label>
                    <input id="username" name="username" type="text" autocomplete="username"  class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Usuario">
                    @error('username')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">Contraseña</label>
                    <input id="password" name="password" type="password" autocomplete="current-password"  class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Contraseña">
                    @error('password')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>

       

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
