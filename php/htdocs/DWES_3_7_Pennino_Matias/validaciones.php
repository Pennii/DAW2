<?php

function validar_texto($texto) {
    $texto = trim($texto);
    $texto = strip_tags($texto);
    $texto = htmlspecialchars($texto);
    return $texto;
}

function validar_actor($actores) {
    $conexion = new mysqli("localhost", 'root', '', 'espectaculos');
    $salida = $actores;
    foreach ($actores as $actor) {
        $actor = validar_texto($actor);
        try {
            $consultaActores = $conexion->stmt_init();
            $consultaActores->prepare("SELECT CDACTOR FROM ACTOR WHERE NOMBRE = ?;");
            $consultaActores->bind_param('s', $actor);
            $ejecutado = $consultaActores->execute();
        } catch (Exception $exc) {
            exit("Error al realizar la consulta de actores" . $exc->getMessage());
        }
        if ($ejecutado) {
            $resultado = $consultaActores->get_result();
            if ($resultado->num_rows == 0) {
                $salida = false;
            }
        }
    }
    $conexion->close();
    return $salida;
}

function validar_actor_pdo($actores) {
    $conexion = new PDO("mysql:host=localhost;dbname=espectaculos","root","");
    $salida = $actores;
    foreach ($actores as $actor) {
        $actor = validar_texto($actor);
        try {
            $consultaActores = $conexion->prepare("SELECT CDACTOR FROM ACTOR WHERE NOMBRE = :nom;");
            $consultaActores->bindParam(':nom', $actor);
            $ejecutado = $consultaActores->execute();
        } catch (Exception $exc) {
            exit("Error al realizar la consulta de actores" . $exc->getMessage());
        }
        if ($ejecutado) {
            if ($consultaActores->rowCount() == 0) {
                $salida = false;
            }
        }
    }
    return $salida;
}

function validar_espectaculo($espectaculo) {
    $conexion = new mysqli("localhost", 'root', '', 'espectaculos');
    $salida = $espectaculo;

    $espectaculo = validar_texto($espectaculo);
    try {
        $consultaEspectaculo = $conexion->stmt_init();
        $consultaEspectaculo->prepare("SELECT * FROM ESPECTACULO WHERE NOMBRE = ?;");
        $consultaEspectaculo->bind_param('s', $espectaculo);
        $ejecutado = $consultaEspectaculo->execute();
    } catch (Exception $exc) {
        exit("Error al realizar la consulta de espectaculos" . $exc->getMessage());
    }
    if ($ejecutado) {
        $resultado = $consultaEspectaculo->get_result();
        if ($resultado->num_rows == 0) {
            $salida = false;
        }
    }

    $conexion->close();
    return $salida;
}

function validar_espectaculo_pdo($espectaculo) {
    $conexion = new PDO("mysql:host=localhost;dbname=espectaculos","root","");
    $salida = $espectaculo;

    $espectaculo = validar_texto($espectaculo);
    try {
        $consultaEspectaculo = $conexion->prepare("SELECT * FROM ESPECTACULO WHERE NOMBRE = :nom;");
        $consultaEspectaculo->bindParam(':nom', $espectaculo);
        $ejecutado = $consultaEspectaculo->execute();
    } catch (Exception $exc) {
        exit("Error al realizar la consulta de espectaculos" . $exc->getMessage());
    }
    if ($ejecutado) {
        if ($consultaEspectaculo->rowCount() == 0) {
            $salida = false;
        }
    }
    return $salida;
}
