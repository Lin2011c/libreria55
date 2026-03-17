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
        <h1>Registro de Usuarios</h1>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nombre" class="form-control" required>
            <br>
            <input type="email" name="gmail" placeholder="Correo" class="form-control" required>
            <br>
            <input type="text" name="phone" placeholder="Teléfono" class="form-control" required>
            <br>
            <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
            <br>
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" class="form-control"
                required>
            <br>

            <div class="form-check">
                <input type="checkbox" name="is_admin" value="1">
                <label>Es administrador</label>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    @endsection
</body>

</html>
