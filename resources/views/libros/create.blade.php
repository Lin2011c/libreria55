<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
</head>

<body>
    <h1 class="mb-4">Registrar usuario</h1>

    <form action="{{ route('libros.store') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book"></i></span>
            <input type="text" name="nombre" placeholder="Nombre" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-user"></i></span>
            <input type="text" name="autor" placeholder="Autor" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
            <input type="text" name="editorial" placeholder="Editorial" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
            <input type="number" name="precio" placeholder="Precio" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>

    </form>
</body>

</html>
