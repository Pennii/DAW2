<?php
header('Content-Type: application/json');
 try {
    $conexion = new PDO('mysql:host=localhost;dbname=login', 'root', '');
} catch (exception $ex) {
    echo $ex->getMessage();
}
$datos = $conexion->query("SELECT * FROM HABITACIONES");
$salida = $datos->fetchAll(PDO::FETCH_ASSOC);
echo $salida?json_encode(['habitaciones'=>$salida]):json_encode(['error'=>true]);
