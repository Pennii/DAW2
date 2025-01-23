<?php

require_once './funciones.php';
try {
    $conexion = new PDO("mysql:host=localhost;dbname=espectaculos", "root", "");
} catch (Exception $exc) {
    exit($exc->getTraceAsString());
}
$datos = filter_input_array(INPUT_POST);
//Si el usuario es valido craemos las cookies y lo llevamos a la pagina de usuario
if (validar_datos($datos, $conexion)) {
    $usuario = validar_usuario($datos["usuario"]);
    date_default_timezone_set('CET');
    $fecha = date("d-m-Y H:i:s");
    $datosConexion = ["usuario" => $usuario, "fecha" => $fecha];
    //Creamos la cookie de conexion exitosa para la pagina de redireccion
    setcookie("conexionExitosa", "Hola $usuario, bienvenido", time() + 3600);

    //Creamos la cookie de usuario
    if (!filter_has_var(INPUT_COOKIE, "usuario")) {
        $nVistas = 1;
        setcookie("usuario[nombre]", $usuario, time() + 3600 * 24 * 7);
        setcookie("usuario[nVistas]", $nVistas, time() + 3600 * 24 * 7);
        setcookie("usuario[fCon]", $fecha, time() + 3600 * 24 * 7);
    }
    //Reiniciamos el contador de contraseñas y redirigimos al usuario
    setcookie("contador", 1, time() + 3600);
    header("Location: ./usuario.php");
} else {
    $actual = filter_input(INPUT_COOKIE, "contador");
    setcookie("contador", $actual + 1, time() + 3600);
    //Si en el tercer intento el usuario no logra iniciar sesion se le bloqueara el boton para hacerlo por 1 hora
    if ($actual >= 3) {
        setcookie("conexionFallida", "Se ha superado el maximo de intentos permitidos, vuelve luego", time() + 3600);
    }
    $conteoClaves = "se han probado " . filter_input(INPUT_COOKIE, "contador") . " contraseñas";
    $mensajeLogin = "error al ingresar datos";
    $ruta = "login.php?conteoClaves=$conteoClaves&mensajeLogin=$mensajeLogin";
    header("Location: $ruta");
}