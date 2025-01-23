<?php
session_start();
if (filter_has_var(INPUT_COOKIE, "inactividad")) {
    $mensaje = "Bienvenido " . $_SESSION['usuario'] . " su rol es: " . $_SESSION["rol"] .
            " y el id de la sesion es: " . session_id();
    if (filter_input(INPUT_COOKIE, "inactividad") === "1") {
        $mensaje .= " gracias por volver";
    }
    setcookie("inactividad", "1", time() + 60 * 20);
} else {
    header("Location: ./index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php echo $mensaje; ?></p>
        <a href="cerrar_sesion.php">Cerrar sesion</a>
    </body>
</html>
