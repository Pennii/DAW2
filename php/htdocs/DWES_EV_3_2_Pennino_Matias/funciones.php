<?php

const CODIGOS_ESPECTACULO = "/^[A-Za-z]{3}$/";
const NOMBRES_VALIDOS = "/^([A-Za-z]+)([ ][A-Za-zñ]+)*$/";

function sanear_texto($campo) {
    //quitamos espacios del inicio y final
    $campo = trim($campo);
    //quitamos las etiquetas html y otros caracteres especiales
    $campo = strip_tags($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function validar_codigo($codigo) {
    $codigo = sanear_texto($codigo);

    return $salida = preg_match(CODIGOS_ESPECTACULO, $codigo) ? $codigo : false;
}

function codigo_disponible($codigo) {
    try {
        $conexion = new mysqli("localhost", "root", "", "espectaculos");
    } catch (Exception $exc) {
        exit("Error al crear la conexion con la base de datos " . $exc->getMessage());
    }
    try {
        $consultaCodEsp = $conexion->stmt_init();
        $consultaCodEsp->prepare("SELECT CDESPEC FROM ESPECTACULO WHERE CDESPEC = ?");
        $consultaCodEsp->bind_param("s", $codigo);
        $consultaCodEsp->execute();
    } catch (Exception $exc) {
        exit("Error al consultar codigos de espectaculo " . $exc->getMessage());
    }
    $resultados = $consultaCodEsp->get_result()->num_rows;
    return $salida = $resultados ? false : $codigo;
}

function validar_nombre($nombre) {
    $nombre = sanear_texto($nombre);
    return $salida = preg_match(NOMBRES_VALIDOS, $nombre) ? $nombre : false;
}

function validar_tipo($tipo) {
    $tipo = sanear_texto($tipo);
    try {
        $conexion = new mysqli("localhost", "root", "", "espectaculos");
    } catch (Exception $exc) {
        exit("Error al crear la conexion con la base de datos " . $exc->getMessage());
    }

    try {
        $consultaTipo = $conexion->stmt_init();
        $consultaTipo->prepare("SELECT DISTINCT TIPO FROM ESPECTACULO WHERE TIPO = ?");
        $consultaTipo->bind_param("s", $tipo);
        $consultaTipo->execute();
    } catch (Exception $exc) {
        exit("Error al seleccionar los datos de los grupos " . $exc->getMessage());
    }
    $resultados = $consultaTipo->get_result()->num_rows;
    return $salida = $resultados ? $tipo : false;
}

function validar_estrellas($estrellas) {
    $aux = is_numeric($estrellas) ? $estrellas + 0 : false;
    return $salida = is_integer($aux) && ($estrellas >= 1 && $estrellas <= 5) ? $estrellas : false;
}

function validar_grupo($codigo) {
    $codigo = sanear_texto($codigo);
    try {
        $conexion = new mysqli("localhost", "root", "", "espectaculos");
    } catch (Exception $exc) {
        exit("Error al crear la conexion con la base de datos " . $exc->getMessage());
    }
    try {
        $consultaCodGru = $conexion->stmt_init();
        $consultaCodGru->prepare("SELECT CDGRUPO FROM GRUPO WHERE CDGRUPO = ?");
        $consultaCodGru->bind_param("s", $codigo);
        $consultaCodGru->execute();
    } catch (Exception $exc) {
        exit("Error al consultar codigos de grupo " . $exc->getMessage());
    }
    $resultados = $consultaCodGru->get_result()->num_rows;
    return $salida = $resultados ? $codigo : false;
}
