<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoriaController extends Controller
{

    public function index(Request $request)
    {
        $categorias = DB::table('categorias')
            ->select('iCatID', 'cCatNombre', 'cCatTipo', 'cCatDescripcion', 'cCatEstado')
            ->orderBy('iCatID', 'desc')
            ->get();

        return view('categoria.index', compact('categorias'));
    }




    public function create()
    {
        $categoria = new Categoria();
        return view('categoria.action', ['categoria' => new Categoria()]);
    }


    public function store(Request $request)
    {
        try {
            $categoria = new Categoria();
            $categoria->cCatNombre = $request->input('nombre');
            $categoria->cCatTipo = $request->input('tipo');
            $categoria->cCatDescripcion = $request->input('descripcion');
            $categoria->save();
            return redirect()->route('categoria.index')->with('mensaje', 'Categoria ' . $categoria->cCatNombre . ' creada safistactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categoria.index')->with('error', 'No se puede crear la Categoria');
        }
    }


    public function show(Categoria $categoria)
    {
        //
    }


    public function edit($iCatID)
    {
        $categoria = Categoria::findOrFail($iCatID);
        return view('categoria.action', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $iCatID)
    {
        try {
            $categoria = Categoria::findOrFail($iCatID);
            $categoria->cCatNombre = $request->input('nombre');
            $categoria->cCatTipo = $request->input('tipo');
            $categoria->cCatDescripcion = $request->input('descripcion');
            $categoria->cCatEstado = $request->input('estado');
            $categoria->save();
            return redirect()->route('categoria.index')->with('mensaje', 'Categoria ' . $categoria->cCatNombre . ' actualizada safistactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categoria.index')->with('error', 'No se puede actualizar la Categoria');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($iCatID)
    {
        try {
            $categoria=Categoria::findOrFail($iCatID);
            $categoria->delete();
            return redirect()->route('categoria.index')->with('mensaje','Categoria:  '.$categoria->cCatNombre.' eliminada correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categoria.index')->with('error','No se puede eliminar la Categoria porque esta siendo usado.');
        }
    }
}
