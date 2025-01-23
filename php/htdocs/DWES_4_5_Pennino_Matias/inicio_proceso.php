<?php

session_start();
require_once './funciones.php';
if (filter_has_var(INPUT_POST, "iniciar")) {
    $datos = filter_input_array(INPUT_POST);
    if (validar_datos($datos)) {
        if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] === $datos["usuario"]) {
            
        } else {
            session_destroy();
            $_SESSION["usuario"] = sanear_texto($datos["usuario"]);
            $_SESSION["rol"] = obtenerRol($_SESSION["usuario"]);
        }
        //Creamos la cookie de inactividad
        setcookie("inactividad", "0", time() + 60 * 20);

        if (isset($datos["recordarUsuario"])) {
            setcookie("recordarUsuario", $_SESSION["usuario"], time() + 60 * 20);
        }

        header("Location: usuario.php");
    } else {
        $mensajeLogin = "Los datos introducidos no son correctos";
        $ruta = "index.php?mensajeLogin=$mensajeLogin";
        header("Location: $ruta");
    }
} else {
    header("Location: index.php");
    setcookie("inactividad", "0", time() - 1);
    session_destroy();
}
