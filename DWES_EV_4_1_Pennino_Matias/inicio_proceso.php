<?php
session_start();
require_once './funciones.php';

if (filter_has_var(INPUT_POST, "iniciarSesion")) {
    $datos = filter_input_array(INPUT_POST);
    if (validar_datos($datos)) {
        $_SESSION["usuario"] = $datos["usuario"];
        $_SESSION["rol"] = obtenerRol($_SESSION["usuario"]);
        
        switch ($_SESSION["rol"]) {
            case "administrador":
                header("Location: alta_espectaculo.php");
                break;
            case "usuario":
                header("Location: reservar_espectaculo.php");
                break;
            case "invitado":
                header("Location: ver_espectaculos.php");
                break;

            default:
                $mensaje = "no puedes ver nada";
                header("Location: index.php?mensaje=$mensaje");
                break;
        }
    }else{
        $mensaje = "Datos incorrectos";
        header("Location: index.php?mensaje=$mensaje");
    }
}else{
    header("Location: indeex.php");
}

    