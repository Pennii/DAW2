<?php

try {
    $conexion = new PDO("mysql:host=localhost;dbname=espectaculos", "root", "");
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

function sanear_texto($campo) {
    $campo = trim($campo);
    $campo = strip_tags($campo);
    $campo = htmlspecialchars($campo);

    return $campo;
}

function validar_datos(array $datos) {
    global $conexion;
    foreach ($datos as $clave => $valor) {
        $datos[$clave] = sanear_texto($valor);
    }
    //Cambiamos la consulta para que solo devuelva la clave y compararla con la contraseña ingresada
    try {
        $consultarUsuario = $conexion->prepare("SELECT CLAVE FROM USUARIOS WHERE LOGIN = :login");
        $consultarUsuario->bindParam(":login", $datos["usuario"]);
        $consultarUsuario->execute();
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    $fila = $consultarUsuario->fetch(PDO::FETCH_ASSOC);
    $resultado = $fila ? password_verify($datos["clave"], $fila["CLAVE"]) : false;
    return $resultado;
}

function obtenerRol($usuario) {
    global $conexion;
    try {
        $rol = $conexion->query("SELECT ID_ROL FROM USUARIOS WHERE LOGIN = '$usuario'")->fetch(PDO::FETCH_ASSOC)["ID_ROL"];
        $rolUsuario = $conexion->query("SELECT TIPO FROM ROLES WHERE ID_ROL = '$rol'")->fetch(PDO::FETCH_ASSOC)["TIPO"];
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    return $rolUsuario;
}

function espectaculoDisponible($codigo) {
    global $conexion;
    $codigo = sanear_texto($codigo);
    try {
        $consultarCodigo = $conexion->query("SELECT CDESPEC FROM ESPECTACULO WHERE CDESPEC = '$codigo'");
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    return $resultado = $consultarCodigo->fetch() ? false : true;
}

function grupoDisponible($codigo) {
    global $conexion;
    $codigo = sanear_texto($codigo);

    try {
        $consultaCodGru = $conexion->query("SELECT CDGRUPO FROM GRUPO WHERE CDGRUPO = '$codigo'");
    } catch (Exception $exc) {
        $exc->getMessage();
    }
    return $resultado = $consultaCodGru->fetch() ? true : false;
}

function cargarEspectaculo($datos) {
    global $conexion;
    $espectaculo = sanear_texto($datos["codigoEspectaculo"]);
    $nombre = sanear_texto($datos["nombre"]);
    $tipo = sanear_texto($datos["tipo"]);
    $grupo = sanear_texto($datos["codigoGrupo"]);
    try {
        $conexion->beginTransaction();
        $insertarEspectaculo = $conexion->prepare("INSERT INTO ESPECTACULO (CDESPEC, NOMBRE, TIPO, CDGRU) VALUES (:espec, :nom, :tipo, :gru)");
        $insertarEspectaculo->bindParam(":espec", $espectaculo);
        $insertarEspectaculo->bindParam(":nom", $nombre);
        $insertarEspectaculo->bindParam(":tipo", $tipo);
        $insertarEspectaculo->bindParam(":gru", $grupo);
        $espectaculoCargado = $insertarEspectaculo->execute();
        $conexion->commit();
    } catch (Exception $exc) {
        $conexion->rollBack();
       $espectaculoCargado = $exc->getMessage();
    }
    return $espectaculoCargado;
}

function obtenerEspectaculos(){
     global $conexion;
    $todosEspectaculos = [];
    try {
        $espectaculos = $conexion->query("SELECT * FROM ESPECTACULO ORDER BY ESTRELLAS, TIPO");
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    while ($espectaculo = $espectaculos->fetch(PDO::FETCH_ASSOC)) {
            array_push($todosEspectaculos, $espectaculo);    
    }
    return $todosEspectaculos;
}