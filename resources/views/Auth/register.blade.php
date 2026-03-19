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
        <h1 class="mb-4">Registro de Usuarios</h1>

        <form action="{{ route('registro.store') }}" method="POST">
            @csrf

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="name" placeholder="Nombre" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="gmail" placeholder="Correo" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                <input type="text" name="phone" placeholder="Teléfono" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control"
                    required>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_admin" value="1" class="form-check-input">
                <label class="form-check-label">Es administrador</label>
            </div>

            <button type="submit" class="btn btn-outline-primary">
                <i class="fa-solid fa-floppy-disk"></i> Guardar
            </button>

        </form>
    @endsection

</body>

</html>
