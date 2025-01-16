<?php
require_once './funciones.php';
try {
    $conexion = new PDO("mysql:host=localhost;dbname=espectaculos", "root", "");
} catch (Exception $exc) {
    exit($exc->getTraceAsString());
}
$datos = filter_input_array(INPUT_POST);
$datos["usuario"] = validar_usuario($datos["usuario"]);
$datos["clave"] = validar_clave($datos["clave"]);

if ($datos["usuario"] && $datos["clave"] && usuario_disponible($datos["usuario"], $conexion)) {
    //Agrego el cifrado de contraseña
    $datos["clave"] = password_hash($datos["clave"], PASSWORD_DEFAULT);
    try {
        $conexion->beginTransaction();
        $insertarUsuario = $conexion->prepare("INSERT INTO USUARIOS (login, clave) VALUES (:nombre, :clave)");
        $insertarUsuario->bindParam(":nombre", $datos["usuario"]);
        $insertarUsuario->bindParam(":clave", $datos["clave"]);
        $insertarUsuario->execute();
        $conexion->commit();
    } catch (Exception $exc) {
        echo $exc->getLine();
    }
    if ($insertarUsuario->rowCount() > 0) {
        $salida = "usuario creado correctamente";
        header("Location: login.php?registro=$salida");
    } else {
        $salida = "No se ha podido crear el usuario";
        header("Location: registrar.php?salida=$salida");
    }
} else {
    $salida = "Error al ingresar datos";
    header("Location: registrar.php?salida=$salida");
}


