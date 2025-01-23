<?php

function validarTexto($texto) {
    $texto = trim($texto);
    $texto = strip_tags($texto);
    return $texto;
}

function validarCodigo($codigo) {
    $codigo = validarTexto($codigo);
    try {
        $conexion = new mysqli('localhost', 'root', '', 'espectaculos');
        $consultarCodigo = $conexion->stmt_init();
        $consultarCodigo->prepare('SELECT CDGRUPO FROM GRUPO WHERE CDGRUPO = ?');
        $consultarCodigo->execute([$codigo]);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    $fila = $consultarCodigo->get_result();
    return $fila->num_rows > 0 ? $codigo : false;
}

function validarActor($codigo) {
    $codigo = validarTexto($codigo);
    try {
        $conexion = new mysqli('localhost', 'root', '', 'espectaculos');
        $consultarCodigo = $conexion->stmt_init();
        $consultarCodigo->prepare('SELECT CDACTOR FROM ACTOR WHERE CDACTOR = ?');
        $consultarCodigo->execute([$codigo]);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    $fila = $consultarCodigo->get_result();
    return $fila->num_rows > 0 ? $codigo : false;
}
