<?php

session_start();
require_once './funciones.php';
require_once './Actor.php';

if (filter_has_var(INPUT_POST, "iniciarSesion")) {
    $datos = filter_input_array(INPUT_POST);
    if (validar_datos($datos)) {
        $_SESSION["usuario"] = $datos["usuario"];
        $_SESSION["rol"] = obtenerRol($_SESSION["usuario"]);

        if ($_SESSION["rol"] == "administrador") {
            header("Location: areaAdmin.php");
        } else {
            $mensaje = "no tienes permiso de entrar a area admin";
            header("Location: index.php?mensaje=$mensaje");
        }
    } else {
        $mensaje = "Datos incorrectos";
        header("Location: index.php?mensaje=$mensaje");
    }
} else {
    header("Location: index.php");
}

    