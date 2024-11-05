<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::join('personas', 'clientes.iCliPersonaID', '=', 'personas.iPerID')
            ->select(
                'clientes.iCliID',
                'clientes.iCliPersonaID',
                'personas.cPerNombre',
                'personas.cPerApellido',
                'personas.cPerDNI',
                'personas.cPerEmail',
                'personas.cPerFNacimiento',
                'personas.cPerTelefono',
                'personas.cPerDireccion',
            )
            ->orderBy('clientes.iCliID', 'desc')
            ->get();

        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = new Cliente();
        $cliente->persona = new Persona();
        return view('cliente.action', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $persona = Persona::create([
                'cPerNombre' => $request->input('cPerNombre'),
                'cPerApellido' => $request->input('cPerApellido'),
                'cPerDNI' => $request->input('cPerDNI'),
                'cPerEmail' => $request->input('cPerEmail'),
                'cPerFNacimiento' => $request->input('cPerFNacimiento'),
                'cPerTelefono' => $request->input('cPerTelefono'),
                'cPerDireccion' => $request->input('cPerDireccion'),
            ]);
            $persona->cliente()->create([
                'iCliPersonaID' => $persona->iPerID
            ]);
            return redirect()->route('cliente.index')->with('mensaje', 'Cliente ' . $persona->cPerNombre . ' creado satisfactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->route('cliente.index')->with('error', 'No se puede crear el Cliente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($iCliID)
    {
        $cliente = Cliente::with('persona')->findOrFail($iCliID);
        return view('cliente.action', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $iCliID)
    {
        try {

            $cliente = Cliente::with('persona')->findOrFail($iCliID);


            $cliente->persona->update([
                'cPerNombre' => $request->input('cPerNombre'),
                'cPerApellido' => $request->input('cPerApellido'),
                'cPerDNI' => $request->input('cPerDNI'),
                'cPerEmail' => $request->input('cPerEmail'),
                'cPerFNacimiento' => $request->input('cPerFNacimiento'),
                'cPerTelefono' => $request->input('cPerTelefono'),
                'cPerDireccion' => $request->input('cPerDireccion'),
            ]);

            return redirect()->route('cliente.index')->with('mensaje', 'Cliente actualizado satisfactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('cliente.index')->with('error', 'No se puede actualizar el Cliente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($iCliID)
    {
        try {

            $cliente = Cliente::with('persona')->findOrFail($iCliID);

            $cliente->delete();

            $cliente->persona->delete();

            return redirect()->route('cliente.index')->with('mensaje', 'Cliente eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('cliente.index')->with('error', 'No se puede eliminar el Cliente porque está siendo utilizado.');
        } catch (\Exception $e) {
            return redirect()->route('cliente.index')->with('error', 'Ocurrió un error al intentar eliminar el Cliente.');
        }
    }
}
