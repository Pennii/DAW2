
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <p><?php if(filter_has_var(INPUT_GET, "salida")) echo htmlspecialchars(filter_input(INPUT_GET, "salida")); ?></p>
        <form action="registro_proceso.php" method="post">
            <label>Nombre de usuario: </label>
            <input type="text" name="usuario">
            <br>
            <label>Contraseña: </label>
            <input type="text" name="clave">
            <br>
            <button name="crear">Crear</button>
        </form>
    </body>
</html>
