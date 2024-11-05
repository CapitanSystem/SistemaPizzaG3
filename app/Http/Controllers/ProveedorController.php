<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = DB::table('proveedores')
        ->select('iProID', 'cProEmpresa', 'cProRucEmpresa', 'cProRazonSocial')
        ->orderBy('iProID', 'desc')
        ->get();

    return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedor = new Proveedor();
        return view('proveedor.action', ['proveedor' => new Proveedor()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $proveedor = new Proveedor();
            $proveedor->cProEmpresa = $request->input('empresa');
            $proveedor->cProRucEmpresa = $request->input('ruc');
            $proveedor->cProRazonSocial = $request->input('razonSocial');
            $proveedor->save();
            return redirect()->route('proveedor.index')->with('mensaje', 'Proveedor:  ' . $proveedor->cProEmpresa . ' creado safistactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('proveedor.index')->with('error', 'No se puede crear al Proveedor' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($iProID)
    {
        $proveedor = Proveedor::findOrFail($iProID);
        return view('proveedor.action', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $iProID)
    {
        try {
            $proveedor = Proveedor::findOrFail($iProID);
            $proveedor->cProEmpresa = $request->input('empresa');
            $proveedor->cProRucEmpresa = $request->input('ruc');
            $proveedor->cProRazonSocial = $request->input('razonSocial');
            $proveedor->save();
            return redirect()->route('proveedor.index')->with('mensaje', 'Proveedor:  ' . $proveedor->cProEmpresa . ' actualizado safistactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('proveedor.index')->with('error', 'No se puede actualizar el Proveedor');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $iProID)
    {
        try {
            $proveedor=Proveedor::findOrFail($iProID);
            $proveedor->delete();
            return redirect()->route('proveedor.index')->with('mensaje','Proveedor:  '.$proveedor->cProEmpresa.' eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('proveedor.index')->with('error','No se puede eliminar el proveedor porque esta siendo usado.');
        }
    }
}
