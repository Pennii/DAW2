<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php if(filter_has_var(INPUT_GET, "mensaje")) echo htmlspecialchars(filter_input(INPUT_GET, "mensaje")); ?></p>
        <form action="inicio_proceso.php" method="post">
            <label>Nombre de usuario:</label>
            <input type="text" name="usuario">
            <br>
            <label>Contraseña:</label>
            <input type="password" name="clave">
            <br>
            <button name="iniciarSesion">Iniciar sesion</button>
        </form>  
    </body>
</html>
