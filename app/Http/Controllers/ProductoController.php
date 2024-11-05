<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productos = Producto::join('categorias', 'productos.iProCategoriaID', '=', 'categorias.iCatID')
            ->select(
                'productos.iProID',
                'productos.iProCategoriaID',
                'productos.cProNombre',
                'categorias.cCatNombre',
                'productos.cProTamanio',
                'productos.fProPrecioCompra',
                'productos.fProPrecioVenta',
                'productos.iProStock',
                'productos.cProImagen',
                'productos.cProEstado'
            )
            ->orderBy('productos.iProID', 'desc')
            ->get();

        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto = new Producto();
        $categorias = DB::table('categorias')
            ->select('iCatID', 'cCatNombre')
            ->orderBy('cCatNombre', 'asc')
            ->get();
        return view('producto.action', compact('producto', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->cProNombre = $request->input('nombre');
        $producto->cProTamanio = $request->input('tamanio');
        $producto->fProPrecioCompra = $request->input('precioC');
        $producto->fProPrecioVenta = $request->input('precioV');
        $producto->iProStock = $request->input('stock');
        $producto->iProCategoriaID = $request->input('categoria_id');

        $prefijo = Str::random(2);
        $image = $request->file('imagen');
        if (!is_null($image)) {
            $nombreImagen = $prefijo . '-' . $image->getClientOriginalName();
            $image->move('productos', $nombreImagen);
            $producto->cProImagen = $nombreImagen;
        }

        $producto->save();
        return redirect()->route('producto.index')->with('mensaje', 'Producto:  ' . $producto->cProNombre . ' creado safistactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($iProID)
    {
        $producto = Producto::findOrFail($iProID);
        $categorias = DB::table('categorias')
            ->select('iCatID', 'cCatNombre')
            ->orderBy('cCatNombre', 'asc')
            ->get();
        return view('producto.action', compact(['producto', 'categorias']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $iProID)
    {
        try {
            $producto = Producto::findOrFail($iProID);
            $producto->cProNombre = $request->input('nombre');
            $producto->cProTamanio = $request->input('tamanio');
            $producto->fProPrecioCompra = $request->input('precioC');
            $producto->fProPrecioVenta = $request->input('precioV');
            $producto->iProStock = $request->input('stock');
            $producto->iProCategoriaID = $request->input('categoria_id');

            $prefijo = Str::random(2);
            $image = $request->file('imagen');
            if (!is_null($image)) {

                $imagenAntigua = 'productos/' . $producto->cProImagen;
                if (file_exists($imagenAntigua)) {
                    @unlink($imagenAntigua);
                }

                $nombreImagen = $prefijo . '-' . $image->getClientOriginalName();
                $image->move('productos', $nombreImagen);
                $producto->cProImagen = $nombreImagen;
            }


            $producto->save();
            return redirect()->route('producto.index')->with('mensaje', 'Producto:  ' . $producto->cProNombre . ' actualizado safistactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('producto.index')->with('error', 'No se puede actualizar el Producto');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($iProID)
    {
        try {
            $producto = Producto::findOrFail($iProID);
            $imagenAntigua = 'productos/' . $producto->cProImagen;
            if (file_exists($imagenAntigua)) {
                @unlink($imagenAntigua);
            }

            $producto->delete();
            return redirect()->route('producto.index')->with('mensaje', 'Registro ' . $producto->cProNombre . ' eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('producto.index')->with('error', 'No se puede eliminar el registro ' . $producto->cProNombre . ' porque esta siendo usado.');
        }
    }
}
