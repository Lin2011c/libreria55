<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consulta</title>
</head>

<body>

    @extends('layouts.app')
    @section('content')
        <h1>LIBROS DISPONIBLES</h1>

        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('libros.create') }}" class="btn btn-success mb-3">
                <i class="fa-solid fa-plus"></i> Nuevo libro
            </a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>AUTOR</th>
                    <th>EDITORIAL</th>
                    <th>PRECIO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($libros as $libro)
                    <tr>
                        <td>{{ $libro->id }}</td>
                        <td>{{ $libro->nombre }}</td>
                        <td>{{ $libro->autor }}</td>
                        <td>{{ $libro->editorial }}</td>
                        <td>{{ $libro->precio }}</td>
                        <td>
                            <a href="{{ route('libros.edit', $libro) }}">
                                <button class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>

                            <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Eliminar el registro?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection

</body>

</html>
