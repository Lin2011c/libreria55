<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registrar usuario</h1>

    <form action="{{ route('libros.store') }}" method="POST">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre">
        <br><br>
        <input type="text" name="autor" placeholder="Autor">
        <br><br>
        <input type="text" name="editorial" placeholder="Editorial">
        <br><br>
        <input type="number" name="precio" placeholder="Precio">
        <br><br>

        <input type="submit" value="Guardar">

    </form>
</body>
</html>