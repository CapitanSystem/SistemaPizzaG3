<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::with('persona')
            ->orderBy('iEmpID', 'desc')
            ->get();

        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleado = new Empleado();
        $empleado->persona = new Persona();
        return view('empleado.action', compact('empleado'));
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


            $empleado = Empleado::create([
                'dEmpFechaInicio' => $request->input('dEmpFechaInicio'),
                'dEmpFechaFin' => $request->input('dEmpFechaFin'),
                'fEmpSueldo' => $request->input('fEmpSueldo'),
                'iEmpPersonaID' => $persona->iPerID
            ]);

            return redirect()->route('empleado.index')->with('mensaje', 'Empleado creado satisfactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('empleado.index')->with('error', 'No se puede crear el Empleado.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($iEmpID)
    {
        $empleado = Empleado::with('persona')->findOrFail($iEmpID);
        return view('empleado.action', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $iEmpID)
    {
        try {

            $empleado = Empleado::with('persona')->findOrFail($iEmpID);

            $empleado->persona->update([
                'cPerNombre' => $request->input('cPerNombre'),
                'cPerApellido' => $request->input('cPerApellido'),
                'cPerDNI' => $request->input('cPerDNI'),
                'cPerEmail' => $request->input('cPerEmail'),
                'cPerFNacimiento' => $request->input('cPerFNacimiento'),
                'cPerTelefono' => $request->input('cPerTelefono'),
                'cPerDireccion' => $request->input('cPerDireccion'),
            ]);


            $empleado->update([
                'dEmpFechaInicio' => $request->input('dEmpFechaInicio'),
                'dEmpFechaFin' => $request->input('dEmpFechaFin'),
                'fEmpSueldo' => $request->input('fEmpSueldo'),
            ]);

            return redirect()->route('empleado.index')->with('mensaje', 'Empleado actualizado satisfactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('empleado.index')->with('error', 'No se puede actualizar el Empleado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($iEmpID)
    {
        try {

            $empleado = Empleado::with('persona')->findOrFail($iEmpID);

            $empleado->delete();

            $empleado->persona->delete();

            return redirect()->route('empleado.index')->with('mensaje', 'Empleado eliminado satisfactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('empleado.index')->with('error', 'No se puede eliminar el Empleado.');
        }
    }
}
