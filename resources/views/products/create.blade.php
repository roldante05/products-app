<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Crear Nuevo Producto</h1>
    <form method="POST" action="{{ route('products.store') }}" class="max-w-xl mx-auto">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Ingrese el título del producto" class="border border-gray-300 px-4 py-2 w-full rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="Ingrese el precio del producto" class="border border-gray-300 px-4 py-2 w-full rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Crear Producto</button>
        </div>
    </form>
</div>
@endsection
