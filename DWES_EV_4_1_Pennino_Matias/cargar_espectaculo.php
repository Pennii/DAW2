<?php

session_start();
require_once './funciones.php';
if (isset($_SESSION["usuario"]) && $_SESSION["rol"] == "administrador" && filter_has_var(INPUT_POST, "cargarEspectaculo")) {
    $datos = filter_input_array(INPUT_POST);
    if (espectaculoDisponible($datos["codigoEspectaculo"]) && grupoDisponible($datos["codigoGrupo"])) {
        cargarEspectaculo($datos);
        $mensaje = "espectaculo cargado";
    }else{
        $mensaje = "no se ha podido cargar el espectaculo";
    }
    header("Location: alta_espectaculo.php?mensaje=$mensaje");
}

