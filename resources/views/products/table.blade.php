@if (count($productos) > 0)
<table class="table-auto w-full text-center">
    <thead>
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Título</th>
            <th class="px-4 py-2">Precio</th>
            @if(session('user') && session('user.role') === 'admin')
            <th class="px-4 py-2">Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td class="border px-4 py-2">{{ $producto['id'] }}</td>
                <td class="border px-4 py-2">{{ $producto['title'] }}</td>
                <td class="border px-4 py-2">{{ $producto['price'] }}</td>
                @if(session('user') && session('user.role') === 'admin')
                <td class="border px-4 py-2">
                    <a href="{{ route('products.edit', $producto['id']) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                    <button data-id="{{ $producto['id'] }}" class="delete-product bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4 flex justify-center">
    @for ($i = 1; $i <= $totalPages; $i++)
        <a href="#" class="mx-1 px-3 py-1 {{ $i == $currentPage ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded paginate-link" data-page="{{ $i }}">{{ $i }}</a>
    @endfor
</div>
@else
<p class="text-gray-500">No hay productos disponibles.</p>
@endif