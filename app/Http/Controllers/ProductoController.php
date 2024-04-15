<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ProCatCategoria;
use App\Models\ProCatSubcategoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $categorias = ProCatCategoria::all();
        $subcategorias = ProCatSubcategoria::all();

        $productosQuery = Producto::query();

        if ($request->has('nombre')) {
            $productosQuery->where('strNombreProducto', 'like', '%' . $request->input('nombre') . '%');
        }
        if ($request->has('categoria')) {
            $productosQuery->where('idProCatCategoria', $request->input('categoria'));
        }
        if ($request->has('subcategoria')) {
            $productosQuery->where('idProCatSubCategoria', $request->input('subcategoria'));
        }

        $productos = $productosQuery->get();

        return view('productos.index', compact('categorias', 'subcategorias', 'productos'));
    }

    public function create()
    {
        $categorias = ProCatCategoria::all();
        $subcategorias = ProCatSubcategoria::all();
        return view('productos.create', compact('categorias', 'subcategorias'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'strNombreProducto' => 'required|string|max:50',
            'strDescripcion' => 'required|string|max:50',
            'idProCatCategoria' => 'required|exists:procatcategoria,id',
            'idProCatSubCategoria' => 'required|exists:procatsubcategoria,id',
            'decMaximo' => 'required|numeric',
            'decMinimo' => 'required|numeric',
            'curCosto' => 'required|numeric',
            'curPrecio' => 'required|numeric',
            'strImage' => 'nullable|url',
            'blodImage' => 'nullable|file|image|max:1024',
        ]);

        $producto = new Producto($request->except(['blodImage']));

        if ($request->hasFile('blodImage')) {
            $path = $request->file('blodImage')->store('public/productos');
            $producto->strImage = Storage::url($path);
            Log::info('Ruta de almacenamiento de la imagen: ' . Storage::url($path));
        } else {
            Log::warning('No se ha proporcionado un archivo de imagen.');
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = ProCatCategoria::all();
        $subcategorias = ProCatSubcategoria::all();
        return view('productos.edit', compact('producto', 'categorias', 'subcategorias'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'strNombreProducto' => 'required|string|max:50',
            'strDescripcion' => 'required|string|max:50',
            'idProCatCategoria' => 'required|exists:procatcategoria,id',
            'idProCatSubCategoria' => 'required|exists:procatsubcategoria,id',
            'decMaximo' => 'required|numeric',
            'decMinimo' => 'required|numeric',
            'curCosto' => 'required|numeric',
            'curPrecio' => 'required|numeric',
            // Agrega validaciones adicionales según tus necesidades
        ]);

        // Actualizar el producto
        Producto::findOrFail($id)->update($request->all());

        // Redireccionar con un mensaje
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        // Eliminar el producto
        Producto::findOrFail($id)->delete();

        // Redireccionar con un mensaje
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    public function printProduct($id)
    {
        $producto = Producto::find($id); // Obtener el producto por su ID

        // Crear el PDF con la vista y los datos del producto
        $pdf = PDF::loadView('viewsPdf.productoReporte', compact('producto'));

        // Retornar el PDF al navegador
        return $pdf->stream('viewsPdf.productoReporte.pdf');
    }
}
