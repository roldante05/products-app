<!-- resources/views/components/product-dropdown.blade.php -->
@props(['producto'])
<tbody x-data="{ open: false }">
    <tr @click="open = !open" class="cursor-pointer border-t border-b" >
        <td class="px-4 py-2">{{ $producto['id'] }}</td>
        <td class="px-4 py-2">{{ $producto['title'] }}</td>
        <td class="px-4 py-2">{{ $producto['price'] }}</td>
        <td class="px-4 py-2">
            <a href="{{ route('products.edit', $producto['id']) }}"
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Editar</a>
            <form action="{{ route('products.destroy', $producto['id']) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
            </form>
        </td>
    </tr>
    <tr x-show="open" class="bg-gray-200 transition-all duration-300 ease-in-out transform origin-top border-t border-b" x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-y-0"
    x-transition:enter-end="opacity-100 transform scale-y-1"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-y-1"
    x-transition:leave-end="opacity-0 transform scale-y-0">
        <td colspan="4" class="px-4 py-2">
            <div>
                <p><strong>ID:</strong> {{ $producto['id'] }}</p>
                <p><strong>Título:</strong> {{ $producto['title'] }}</p>
                <p><strong>Precio:</strong> {{ $producto['price'] }}</p>
                <p><strong>Creado el:</strong> {{ $producto['created_at'] }}</p>
            </div>
        </td>
    </tr>
</tbody>