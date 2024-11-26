<?php

//conexion
try {
    //utf8
    $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
    $conexion = new PDO("mysql:host=localhost;dbname=$bd", 'root', '', $opciones);
} catch (Exception $exc) {
    exit("Error al conectar con la base de datos" . $exc->getMessage());
}

//consulta que devuelve datos (select)
try {
    $consulta = $conexion->query("SELECT...");
} catch (Exception $exc) {
    exit("Error al realizar la consulta " . $exc->getMessage());
}

//obtener datos de un select
//para obtener un tipo de fetch se pasa como parametro
$registro = $consulta->fetch(PDO::fetch_);

//consulta que no devuelve datos (insert, update, delete)
try {
    $conexion->beginTransaction();
    //devuelve las filas afectadas o false
    $consulta = $conexion->exec("$query");
    $conexion->commit();
} catch (Exception $exc) {
    $conexion->rollBack();
    exit("Error al realizar la consulta " . $exc->getMessage());
}

//preparada
try {
    $consulta = $conexion->prepare("INSERT INTO $tabla ($atributo) VALUES (?)");
    $consulta->bindParam(1, $valorInterrogacion);
    
    $consulta = $conexion->prepare("INSERT INTO $tabla ($atributo) VALUES (:$valor)");
    $consulta->bindParam(":$valor", $valor2Puntos);
    
    $consulta->execute();
} catch (Exception $exc) {
    exit("Error al realizar la consulta " . $exc->getMessage());
}
