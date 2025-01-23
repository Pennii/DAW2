<?php

session_start();
require_once './funciones.php';
if (isset($_SESSION["usuario"]) && $_SESSION["rol"] == "administrador" && filter_has_var(INPUT_POST, "cargarEspectaculo")) {
    $datos = filter_input_array(INPUT_POST);
    if (espectaculoDisponible($datos["codigoEspectaculo"]) && grupoDisponible($datos["codigoGrupo"])) {
        $cargado = cargarEspectaculo($datos);
        $mensaje = $cargado?"Espectaculo cargado":"No se ha podido cargar el espectaculo";
    }else{
        $mensaje = "Codigos de espectaculo o grupo incorrectos";
    }
    header("Location: alta_espectaculo.php?mensaje=$mensaje");
}else{
    header("Location alta_espectaculo.php");
}

