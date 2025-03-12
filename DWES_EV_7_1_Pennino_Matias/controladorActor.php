<?php

require_once './funciones.php';
require_once './Actor.php';
if (filter_has_var(INPUT_POST, "eliminar")) {
    $datos = filter_input_array(INPUT_POST);
    $codigoActor = $datos["actor"];
    if (Actor::eliminarActor($codigoActor)) {
        $mensaje = "Actor eliminado";
    } else {
        $mensaje = "No se ha podido eliminar al actor";
    }
}
if (filter_has_var(INPUT_POST, "buscar")) {
    $datos = filter_input_array(INPUT_POST);
    $codigoActor = $datos["actor"];
    if ($datosActor = Actor::verActor($codigoActor)) {
        $mensaje = "";

        foreach ($datosActor as $campo => $atributo) {
            $mensaje .= "$campo: $atributo ";
        }
    } else {
        $mensaje = "No se pudo listar el actor";
    }
}
if (filter_has_var(INPUT_POST, "asignar")) {
    $datos = filter_input_array(INPUT_POST);
    $codigoActor = $datos["actor"];
    $codigoSupervisor = $datos["supervisor"];
    if ($codigoActor != $codigoSupervisor) {
        $datosActor = Actor::verActor($codigoActor);
        $actor = new Actor($datosActor["cdactor"], $datosActor["nombre"], $datosActor["sexo"], $datosActor["cdgrupo"], $datosActor["fecha_alta"], $datosActor["cache_base"], $datosActor["cdsupervisa"]);

        $actor->setSupervisor($codigoSupervisor);
        if ($actor->guardarActor()) {
            $mensaje = "Actor guardado con exito";
        } else {
            $mensaje = "No se ha podido guardar el actor";
        }
    } else {
        $mensaje = "Un actor no puede supervisarse a si mismo";
    }
}

header("Location: muestraMensajes.php?mensaje=$mensaje");
