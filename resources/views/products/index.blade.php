<!-- resources/views/products.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Productos</h1>
    <div class="flex justify-between mb-4">
        @if(session('user') && session('user.role') === 'admin')
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Producto</a>
        @endif
        <form id="search-form" class="flex items-center">
            <input type="text" name="search" id="search-input" placeholder="Buscar productos" value="{{ request('search') }}" class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
            <a href="{{route('products.index')}}" class="bg-red-300 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mx-2" > 
                <span class="material-symbols-outlined">
                    delete
                    </span>
            </a>
        </form>
    </div>
    <div id="products-table">
        @include('products.table', [
            'productos' => $productos,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ])
    </div>
</div>
@endsection
@section('scripts')
    <script src="/js/products.js"></script>
@endsection
