<?php
session_start();
if ($_SESSION["rol"] != "administrador") {
    header("Location: index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php if(filter_has_var(INPUT_GET, "mensaje")) echo htmlspecialchars(filter_input(INPUT_GET, "mensaje")); ?></p>
        <a href="areaAdmin.php">Volver a la area admin</a>
        <a href="cerrar_sesion.php">Cerrar sesion</a>
    </body>
</html>
