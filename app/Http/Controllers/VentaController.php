<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['cliente.persona', 'detalles'])->get();
        return view('venta.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $clientes = Cliente::with('persona')->whereHas('persona')->get();
        $productos = Producto::where('cProEstado', 'A')
            ->whereHas('categoria', function ($query) {
                $query->whereIn('cCattipo', ['V', 'A']);
            })
            ->get();

        return view('venta.action', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'iVenClienteID' => 'required|exists:clientes,iCliID',
            'fVenTotal' => 'required|numeric',
            'dVenFecha' => 'required|date',
            'idArrayProducto' => 'required|array',
            'ArrayCantidad' => 'required|array',
            'Arraysubtotal' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            // Crear la venta y obtener el modelo con el ID
            $venta = new Venta();
            $venta->iVenClienteID = $request->iVenClienteID;
            $venta->fVenTotal = $request->fVenTotal;
            $venta->dVenFecha = $request->dVenFecha;
            $venta->save();

            // Verificar que la venta se creó correctamente
            if (!$venta || !$venta->exists) {
                throw new \Exception('Error al crear la venta');
            }

            // Obtener el ID de la venta recién creada
            $ventaId = $venta->getKey(); // Esto obtendrá el ID independientemente del nombre de la columna

            // Crear los detalles de la venta
            foreach ($request->idArrayProducto as $index => $productoID) {
                // Crear el detalle de la venta
                DetalleVenta::create([
                    'iDetVentaID' => $ventaId,
                    'iDetProductoID' => $productoID,
                    'iDetCantidad' => $request->ArrayCantidad[$index],
                    'fDetSubTotal' => $request->Arraysubtotal[$index],
                ]);

                // Actualizar el stock del producto
                $producto = Producto::findOrFail($productoID);
                $producto->iProStock -= $request->ArrayCantidad[$index];
                $producto->save();
            }

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('venta.index')->with('mensaje', 'Venta registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('venta.index')->with('error', 'No se pudo registrar la venta: ' . $e->getMessage());
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
    public function destroy( $id)
    {

        DB::beginTransaction();
        try {

            $venta = Venta::findOrFail($id);

            DetalleVenta::where('iDetVentaID', $venta->iVentID)->delete();

            $venta->delete();

            DB::commit();

            return redirect()->route('venta.index')->with('mensaje', 'Venta eliminada exitosamente.');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('venta.index')->with('error', 'No se puede eliminar la venta: ' . $e->getMessage());
        }
    }
}
