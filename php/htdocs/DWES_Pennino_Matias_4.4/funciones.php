<?php

function sanear_texto($campo) {
    $campo = trim($campo);
    $campo = strip_tags($campo);
    $campo = htmlspecialchars($campo);

    return $campo;
}

function validar_usuario($usuario) {
    $usuario = sanear_texto($usuario);
    return preg_match("/^[a-zA-Z0-9]{1,12}$/", $usuario) ? $usuario : false;
}

function usuario_disponible($usuario, PDO $conexion) {
    try {
        $consultarUsuarios = $conexion->prepare("SELECT * FROM USUARIOS WHERE LOGIN = :nombre");
        $consultarUsuarios->bindParam(":nombre", $usuario);
        $consultarUsuarios->execute();
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
    return $consultarUsuarios->rowCount() == 0;
}

function validar_clave($clave) {
    $clave = sanear_texto($clave);
    return preg_match("/^[0-9]{1,300}$/", $clave) ? $clave : false;
}

function validar_datos(array $datos, PDO $conexion) {
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
    $resultado = $fila?password_verify($datos["clave"], $fila["CLAVE"]):false;
    return $resultado;
}
