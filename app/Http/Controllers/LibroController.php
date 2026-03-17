<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Obtener todos los registros de libros
        $libros = Libro::all();

        // Se manda la variable de los registros a la vista
        return view('libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Libro::create([
            // <NombreFormulario> => $request-><NombreBD>
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'precio' => $request->precio
        ]);

        // Redirección a una ruta específica
        return redirect()->route('libros.create');
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
   public function edit(Libro $libro)
    {
        // Retornar vista con los datos del libro
        return view('libros.edit', compact('libro'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        // Realizar validaciones de los campos del formulario
        $request->validate([
            'nombre' => 'required',
            'autor' => 'required',
            'editorial' => 'required',
            'precio' => 'required',
        ]);
        //realixzar la actualixzacion en la base de datos
        $libro->update($request->all());
        return redirect()->route('libros.index')
        ->with('Success','Actualización con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        //Eliminacion del registro
        $libro -> delete();

        //redireccionar al usuario
        return redirect()->route('libros.idex')
        ->with('Success','Libro eliminado');
    }
}
