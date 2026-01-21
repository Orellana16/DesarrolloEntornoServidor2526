<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- FALTA ESTA IMPORTACIÓN

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargamos los vendedores vinculados al usuario con paginación
        // Nota: Asegúrate de tener la relación 'vendedores' en el modelo User
        $vendedores = Auth::user()->vendedores()->paginate(5);

        // Determinamos el mensaje según si hay resultados
        $mensaje = ($vendedores->count() === 0) ? 'vacio' : 'exito';

        // Devolvemos la vista con los datos
        return view('listaVendedores', compact('mensaje', 'vendedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:100',
            'nif' => 'required|max:9|unique:vendedor,nif|string', 
            'fecha_nac' => 'required|date',
            'sexo' => 'required|in:M,F,O',
            'sueldo_base' => 'required|numeric|min:0',
        ]);

        // Crear vinculado al usuario logueado usando la relación
        Auth::user()->vendedores()->create($validated);

        return redirect()->route('listadoVendedores')->with('mensaje_exito', 'Vendedor Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // findOrFail es mejor: si no existe, lanza un 404 automáticamente
        $vendedor = Vendedor::findOrFail($id);
        $mensaje = 'exito';

        return view('detalleVendedor', compact('mensaje', 'vendedor'));
    }

    public function create()
    {
        return view('crearVendedor');
    }

    public function edit($id)
    {
        $vendedor = Vendedor::findOrFail($id);
        return view('editarVendedor', compact('vendedor'));
    }

    public function update(Request $request, $id)
    {
        $vendedor = Vendedor::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|max:100',
            'nif' => 'required|max:9|unique:vendedor,nif,' . $vendedor->id,
            'fecha_nac' => 'required|date',
            'sexo' => 'required|in:M,F,O',
            'sueldo_base' => 'required|numeric|min:0',
        ]);

        $vendedor->update($validated);

        return redirect()->route('listadoVendedores')->with('mensaje_exito', 'Vendedor Actualizado');
    }

    public function destroy($id)
    {
        $vendedor = Vendedor::find($id);
        
        if (!$vendedor) {
            return redirect()->route('listadoVendedores')->with('mensaje_eliminar', 'error_eliminar');
        }

        $vendedor->delete();
        return redirect()->route('listadoVendedores')->with('mensaje_eliminar', 'eliminado');
    }
}