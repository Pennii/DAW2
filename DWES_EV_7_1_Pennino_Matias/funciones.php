<?php
require_once './Conexion.php';
Conexion::conectar();
$conexion = Conexion::getConexion(); 


function sanear_texto($campo) {
    $campo = trim($campo);
    $campo = strip_tags($campo);
    $campo = htmlspecialchars($campo);

    return $campo;
}

//Valida los datos de login de usuario
function validar_datos(array $datos) {
    global $conexion;
    foreach ($datos as $clave => $valor) {
        $datos[$clave] = sanear_texto($valor);
    }
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

//Devuelve el rol en base al id_rol del usuario
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