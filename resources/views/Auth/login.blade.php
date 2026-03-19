<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    @extends('layouts.app')
    @section('content')
        <h1>INICIO DE SESIÓN</h1>
        <form action="{{ route('acceso.store') }}" method="POST">
            @csrf

            <input type="email" name="email" placeholder="Correo" class="form-control" required>
            <br>
            <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
            <br>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Enviar</button>

                <a href="{{ route('registro.store') }}" class="ms-3 text-decoration-none">
                    Registrarse
                </a>
            </div>
        </form>
    @endsection
</body>

</html>
