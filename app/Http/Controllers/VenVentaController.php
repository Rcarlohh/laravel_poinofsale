<?php

namespace App\Http\Controllers;

use App\Models\VenVenta;
use App\Models\Producto;
use App\Models\VenCatEstado;
use App\Models\VenVentaProducto;
use Illuminate\Http\Request;

class VenVentaController extends Controller
{
    public function index(Request $request)
    {
        $query = VenVenta::with('estado');

        if ($request->has('folio') && $request->folio != '') {
            $query->where('strFolio', 'like', '%' . $request->folio . '%');
        }

        if ($request->has('estado') && $request->estado != '') {
            $query->whereHas('estado', function ($q) use ($request) {
                $q->where('id', $request->estado);
            });
        }

        $ventas = $query->get();
        $estados = VenCatEstado::all();

        return view('ventas.index', compact('ventas', 'estados'));
    }

    public function edit($id)
    {
        $venta = VenVenta::findOrFail($id);
        $estados = VenCatEstado::all();

        return view('ventas.edit', compact('venta', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $venta = VenVenta::findOrFail($id);
        $request->validate([
            'strFolio' => 'required|string|max:50',
            'dteFechaVenta' => 'required|date',
            'idVenCatEstado' => 'required|exists:vencatestado,id',
        ]); 

        $venta->update($request->all());

        return redirect()->route('ventas.index', $id)->with('success', 'Venta actualizada correctamente.');
    }

    public function create()
    {
        $estados = VenCatEstado::all();
        $productos = Producto::all(); // Recupera todos los productos, asegúrate de importar el modelo Producto al principio del archivo
        $productosAgregados = []; // Inicializa la variable $productosAgregados como un arreglo vacío
        $precioTotal = 0; // Inicializa la variable $precioTotal en 0
        return view('ventas.create', compact('estados', 'productos', 'productosAgregados', 'precioTotal'));
    }
    
    
    public function destroy($id)
    {
        $venta = VenVenta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
    // Dentro de tu clase VenVentaController

public function store(Request $request)
{
    $request->validate([
        'productos' => 'required|array',
        'productos.*.productoId' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|numeric|min:1',
        'strFolio' => 'required|string|max:50',
        'idVenCatEstado' => 'required|exists:vencatestado,id',
        // Asegúrate de validar el resto de los campos según tu lógica de negocio y estructura de la base de datos
    ]);

    // Crear la venta
    $venta = new VenVenta([
        'idUsuario' => $request->idUsuario, // Asegúrate de enviar este campo desde el formulario
        'strFolio' => $request->strFolio,
        'dteFechaVenta' => now(), // o $request->dteFechaVenta si permites que el usuario especifique la fecha
        'idVenCatEstado' => $request->idVenCatEstado,
    ]);
    $venta->save();

    // Procesar cada producto agregado
    foreach ($request->productos as $prod) {
        $venta->productos()->create([
            'idVenVenta' => $venta->id,
            'idProProducto' => $prod['productoId'],
            'decCantidad' => $prod['cantidad'],
            'curTotal' => $prod['cantidad'] * Producto::find($prod['productoId'])->curPrecio,
        ]);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente.');
}

}
