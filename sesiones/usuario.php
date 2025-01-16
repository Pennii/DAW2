<?php
session_start();
try {
    $conexion = new PDO("mysql:host=localhost;dbname=espectaculos", "root", "");
} catch (Exception $exc) {
    exit($exc->getTraceAsString());
}

//Eliminamos las cookies que no nos interesan en el momento
if (filter_has_var(INPUT_COOKIE, "conexionFallida")) {
    setcookie("conexionFallida", "", time() - 1);
}

//Modificamos la cookie de usuario, si no existe redirigimos al inicio
//Accedemos a la variable $_COOKIE porque filter_input da problemas
if (isset($_COOKIE["usuario"])) {
    $usuario = $_COOKIE["usuario"]["nombre"];
    $nVistas = $_COOKIE["usuario"]["nVistas"];
    $fCon = $_COOKIE["usuario"]["fCon"];
    setcookie("usuario[nombre]", $usuario, time() + 3600 * 24 * 7);
    setcookie("usuario[nVistas]", ++$nVistas, time() + 3600 * 24 * 7);
    setcookie("usuario[fCon]", date("d-m-Y H:i:s"), time() + 3600 * 24 * 7);

    try {
        $rol = $conexion->query("SELECT ID_ROL FROM USUARIOS WHERE LOGIN = '$usuario'")->fetch(PDO::FETCH_ASSOC)["ID_ROL"];
        $rolUsuario = $conexion->query("SELECT ROL FROM ROL WHERE ID = '$rol'")->fetch(PDO::FETCH_ASSOC)["ROL"];
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    $_SESSION["usuario"] = $usuario;
    $_SESSION["rol"] = $rolUsuario;
    $mensaje = "El usuario ". $_SESSION['usuario'] . " se ha conectado por ultima "
            . "vez el $fCon, siendo esta su visita numero: $nVistas, su rol es: "
            . "".$_SESSION["rol"]." y el id de la sesion es: ". session_id();
} else {
    header("Location: ./index.html");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php echo filter_input(INPUT_COOKIE, "conexionExitosa"); ?></p>
        <p>
            <?php
            echo $mensaje;
            ?>
        </p>
        <form action="cookieUsuario_proceso.php" method="post">
            <input type="text" value="<?php echo $usuario; ?>" hidden="hidden" name="usuario">
            <input type="text" value="<?php echo $fCon; ?>" hidden="hidden" name="fecha">
            <button name="eliminar">Eliminar cookie usuario</button>
            <button name="reiniciar">Reiniciar valor de cookie usuario</button>
        </form>
    </body>
</html>
