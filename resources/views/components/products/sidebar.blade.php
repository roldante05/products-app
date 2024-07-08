<div class="h-screen flex flex-col bg-gray-800 text-white w-64 space-y-6 py-7 px-2">
    <a href="#" class="text-white flex items-center space-x-2 px-4">
        <span class="material-icons">dashboard</span>
        <span class="text-2xl font-extrabold">Dashboard</span>
    </a>
    <nav>
      
        <a href="/products" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            Productos
        </a>
        @if(session('user') && session('user.role') === 'admin')
        <a href="/users" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            Usuarios
        </a>
        @endif
        <a href="/logout" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            Cerrar Sesión
        </a>
    </nav>
</div>
