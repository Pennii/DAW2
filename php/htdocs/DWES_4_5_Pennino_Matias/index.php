<?php
/*if (filter_has_var(INPUT_COOKIE, "recordarUsuario")) {
    header("Location: usuario.php");
}*/
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php if(filter_has_var(INPUT_GET, "mensajeLogin")) echo htmlspecialchars(filter_input(INPUT_GET, "mensajeLogin")); ?></p>
        <form action="inicio_proceso.php" method="post">
            <label>Nombre de usuario:</label>
            <input type="text" name="usuario" value="<?php if(filter_has_var(INPUT_COOKIE, "recordarUsuario")) echo filter_input(INPUT_COOKIE, "recordarUsuario"); ?>">
            <br>
            <label>Contraseña:</label>
            <input type="password" name="clave">
            <br>
            <label>Recuerdame</label>
            <input type="checkbox" name="recordarUsuario">
            <br>
            <button name="iniciar">Iniciar sesion</button>
        </form>  
    </body>
</html>
