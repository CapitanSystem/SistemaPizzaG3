<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with(['proveedor', 'detalles'])->get();

        return view('compra.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::where('cProEstado', 'A')
            ->whereHas('categoria', function ($query) {
                $query->whereIn('cCattipo', ['C', 'A']);
            })
            ->get();
        return view('compra.action', compact('proveedores', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'iComProveedorID' => 'required|exists:proveedores,iProID',
            'fComTotal' => 'required|numeric',
            'dComFecha' => 'required|date',
            'idArrayProducto' => 'required|array',
            'ArrayCantidad' => 'required|array',
            'Arraysubtotal' => 'required|array',
        ]);

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Crear la compra
            $compra = Compra::create([
                'iComProveedorID' => $request->iComProveedorID,
                'fComTotal' => $request->fComTotal,
                'dComFecha' => $request->dComFecha,
            ]);


            // Crear los detalles de la compra
            foreach ($request->idArrayProducto as $index => $productoID) {
                DetalleCompra::create([
                    'iDetComCompraID' => $compra->iComID,
                    'iDetComProductoID' => $productoID,
                    'iDetComCantidad' => $request->ArrayCantidad[$index],
                    'fDetComSubTotal' => $request->Arraysubtotal[$index],
                ]);

                $producto = Producto::findOrFail($productoID);
                $producto->iProStock += $request->ArrayCantidad[$index];
                $producto->save();
            }

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('compra.index')->with('mensaje', 'Compra registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('compra.index')->with('error', 'No se puede crear el Cliente' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $compra = Compra::findOrFail($id);
            DetalleCompra::where('iDetComCompraID', $compra->iComID)->delete();
            $compra->delete();
            DB::commit();
            return redirect()->route('compra.index')->with('mensaje', 'Compra eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('compra.index')->with('error', 'No se puede eliminar la compra' . $e->getMessage());
        }
    }
}
