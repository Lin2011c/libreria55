<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')
    @section('content')
        <h1 class="mb-4">Editar Libro: {{ $libro->nombre }}</h1>

        <form action="{{ route('libros.update', $libro) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-book"></i></span>
                <input type="text" name="nombre" value="{{ $libro->nombre }}" placeholder="Nombre" class="form-control">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="autor" value="{{ $libro->autor }}" placeholder="Autor" class="form-control">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                <input type="text" name="editorial" value="{{ $libro->editorial }}" placeholder="Editorial"
                    class="form-control">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                <input type="number" name="precio" value="{{ $libro->precio }}" placeholder="Precio" class="form-control">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('libros.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                </button>
            </div>

        </form>
    @endsection
</body>

</html>
