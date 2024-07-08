<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Ruta al archivo JSON
    private $filePath;

    public function __construct()
    {
        $this->filePath = base_path('products.json');
    }


    private function getProductos()
    {
        try {
            if (!File::exists($this->filePath)) {
                return [];
            }

            $fileContents = File::get($this->filePath);
            return json_decode($fileContents, true);
        } catch (\Exception $e) {
            Log::error('Error leyendo el archivo JSON: ' . $e->getMessage());
            return []; // Retornar un array vacío en caso de error
        }
    }


    private function saveProductos($productos)
    {
        try {
            Log::info('Guardando productos en el archivo JSON');
            File::put($this->filePath, json_encode($productos, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            Log::error('Error guardando el archivo JSON: ' . $e->getMessage());
            // Puedes devolver un mensaje de error o lanzar una excepción según sea necesario
        }
    }


    public function index(Request $request)
    {
        $productos = collect($this->getProductos());

        // Filtro de búsqueda
        if ($request->has('search')) {
            $search = $request->input('search');
            $productos = $productos->filter(function ($producto) use ($search) {
                return str_contains(strtolower($producto['title']), strtolower($search)) ||
                    str_contains(strtolower($producto['price']), strtolower($search)) ||
                    str_contains(strtolower($producto['created_at']), strtolower($search));
            });
        }

        // Paginación
        $perPage = 10; // Número de elementos por página
        $currentPage = $request->input('page', 1);
        $currentItems = $productos->slice(($currentPage - 1) * $perPage, $perPage)->values();

        if ($request->ajax()) {
            return view('products.table', [
                'productos' => $currentItems,
                'currentPage' => $currentPage,
                'totalPages' => ceil($productos->count() / $perPage)
            ])->render();
        }

        return view('products.index', [
            'productos' => $currentItems,
            'currentPage' => $currentPage,
            'totalPages' => ceil($productos->count() / $perPage)
        ]);
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect('products/create')
                ->withErrors($validator)
                ->withInput();
        }

        $productos = $this->getProductos();

        $newProduct = [
            'id' => count($productos) + 1,
            'title' => htmlspecialchars($request->title),
            'price' => htmlspecialchars($request->price),
            'created_at' => now()->format('Y-m-d H:i:s'),
        ];

        $productos[] = $newProduct;
        $this->saveProductos($productos);

        Log::info('Producto creado', ['producto' => $newProduct]);

        return redirect()->route('products.index');
    }


    public function update(Request $request, $id)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect('products/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $productos = $this->getProductos();

        $productos = collect($productos)->map(function ($producto) use ($request, $id) {
            if ($producto['id'] == $id) {
                $producto['title'] = htmlspecialchars($request->title);
                $producto['price'] = htmlspecialchars($request->price);
            }
            return $producto;
        })->toArray();

        $this->saveProductos($productos);

        Log::info('Producto actualizado', ['producto' => $productos]);

        return redirect()->route('products.index');
    }


    public function destroy($id)
    {
        try {
            $productos = $this->getProductos();
            $productos = collect($productos)->reject(function ($producto) use ($id) {
                return $producto['id'] == $id;
            })->values()->toArray();

            $this->saveProductos($productos);

            Log::info('Producto eliminado', ['id' => $id]);

            return response()->json(['message' => 'Producto eliminado con éxito']);
        } catch (\Exception $e) {
            Log::error('Error al eliminar el producto: ' . $e->getMessage());
            return response()->json(['error' => 'Error al eliminar el producto'], 500);
        }
    }
    

    public function edit($id)
    {
        $productos = $this->getProductos();
        $producto = collect($productos)->firstWhere('id', $id);

        if (!$producto) {
            abort(404); // Maneja el caso donde el producto no se encuentra
        }

        return view('products.edit', compact('producto'));
    }

    public function validator($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $messages = [
            'title.required' => 'El campo título es obligatorio',
            'title.string' => 'El campo título debe ser una cadena de texto',
            'title.max' => 'El campo título no puede tener más de 255 caracteres',
            'price.required' => 'El campo precio es obligatorio',
            'price.numeric' => 'El campo precio debe ser un número',
            'price.min' => 'El campo precio no puede ser negativo',
        ];

        $validator->setCustomMessages($messages);

        return $validator;
    }
}
