<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Empleado;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('persona')->get();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = new Usuario();
        return view('usuario.action', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'cUsuUsuario' => 'required|string|max:50|unique:usuarios,cUsuUsuario',
                'cUsuPassword' => 'required|string|min:6|confirmed',
                'dni' => 'required|string|size:8'
            ]);


            $empleado = Empleado::whereHas('persona', function ($query) use ($request) {
                $query->where('cPerDNI', $request->dni);
            })->first();

            if (!$empleado) {
                return redirect()->route('usuario.index')->with('error', 'No se encontró un empleado con ese DNI.');
            }

            $usuarioExistente = Usuario::where('iUsuPersonaID', $empleado->iEmpPersonaID)->first();
            if ($usuarioExistente) {
                return redirect()->route('usuario.index')->with('error', 'La persona ya tiene un usuario asociado.');
            }

            // Crear usuario
            $usuario = Usuario::create([
                'cUsuUsuario' => $request->cUsuUsuario,
                'cUsuPassword' => bcrypt($request->cUsuPassword),
                'iUsuPersonaID' => $empleado->iEmpPersonaID,
                'cUsuEstado' => 'A',
                'cUsuRol' => $request->cUsuRol
            ]);

            return redirect()->route('usuario.index')->with('mensaje', 'Usuario creado satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')->with('error', 'Ocurrió un error al crear el usuario');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($iUsuID)
    {
        $usuario = Usuario::findOrFail($iUsuID);
        return view('usuario.action', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $iUsuID)
    {
        $usuario = Usuario::findOrFail($iUsuID);

        try {
            $request->validate([
                'cUsuUsuario' => 'required|string|max:50|unique:usuarios,cUsuUsuario,' . $usuario->iUsuID  . ',iUsuID',
                'cUsuPassword' => 'nullable|string|min:6|confirmed',
                'cUsuRol' => 'required|string'
            ]);


            if ($request->filled('cUsuPassword')) {
                $usuario->cUsuPassword = bcrypt($request->cUsuPassword);
            }


            $usuario->cUsuUsuario = $request->cUsuUsuario;
            $usuario->cUsuRol = $request->cUsuRol;
            $usuario->save();

            return redirect()->route('usuario.index')->with('mensaje', 'Usuario actualizado satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')->with('error', 'Ocurrió un error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($iUsuID)
    {
        $usuario = Usuario::findOrFail($iUsuID);

        try {
            $usuario->delete();
            return redirect()->route('usuario.index')->with('mensaje', 'Usuario eliminado satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')->with('error', 'Ocurrió un error al eliminar el usuario: ' . $e->getMessage());
        }
    }

    public function buscarEmpleado($dni)
    {
        $empleado = Empleado::whereHas('persona', function ($query) use ($dni) {
            $query->where('cPerDNI', $dni);
        })->first();

        if ($empleado) {
            return response()->json($empleado->persona);
        }

        return response()->json(null, 404);
    }
}
