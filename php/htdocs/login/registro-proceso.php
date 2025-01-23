<?php
try {
    $conexion = new PDO('mysql:host=localhost;dbname=login', 'root', '');
} catch (exception $ex) {
    echo $ex->getMessage();
}

if (filter_has_var(INPUT_POST, "registrar")) {
    $datos = filter_input_array(INPUT_POST);
    try {
        $consultarUsuario = $conexion->query("SELECT * FROM USUARIOS WHERE USUARIO = '" . $datos["usuario"]."'");
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
    if (!$consultarUsuario->rowCount()) {
        $datos["clave"] = password_hash($datos["clave"], PASSWORD_DEFAULT);
        try {
            $conexion->beginTransaction();
            $insertarUsuario = $conexion->prepare("INSERT INTO USUARIOS (NOMBRE, USUARIO, CLAVE) VALUES (:nom, :usu, :cla)");
            $insertarUsuario->bindParam(":nom",$datos['nombre']);
            $insertarUsuario->bindParam(":usu",$datos['usuario']);
            $insertarUsuario->bindParam(":cla",$datos['clave']);
            $insertarUsuario->execute();
            $conexion->commit();
        } catch (\Throwable $th) {
            $conexion->rollBack();
            echo $th->getMessage();
        }
    }else{
        echo "existe usuario";
    }
    header("Location: ./registrar.html");
}else{
    header("Location: ./registrar.html");
}
