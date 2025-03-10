<?php

if (isset($_GET['id'])) {
    get_persons($_GET['id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    buscar_personas(filter_input(INPUT_POST, "usuario"));
}

function get_persons($id) {

    //Cambia por los detalles de tu base datos
    $dbserver = "localhost";
    $dbuser = "root";
    $password = "";
    $dbname = "ejemploAjax";

    $database = new mysqli($dbserver, $dbuser, $password, $dbname);

    if ($database->connect_errno) {
        die("No se pudo conectar a la base de datos");
    }

    $jsondata = array();

    //Sanitize ipnut y preparar query
    if (is_array($id)) {
        $id = array_map('intval', $id);
        $querywhere = "WHERE `ID` IN (" . implode(',', $id) . ")";
    } else {
        $id = intval($id);
        $querywhere = "WHERE `ID` = " . $id;
    }

    if ($result = $database->query("SELECT * FROM `cyb_users` " . $querywhere)) {

        if ($result->num_rows > 0) {

            $jsondata["success"] = true;
            $jsondata["data"]["message"] = sprintf("Se han encontrado %d usuarios", $result->num_rows);
            $jsondata["data"]["users"] = array();
            while ($row = $result->fetch_object()) {
                //$jsondata["data"]["users"][] es un array no asociativo. Tendremos que utilizar JSON_FORCE_OBJECT en json_enconde
                //si no queremos recibir un array en lugar de un objeto JSON en la respuesta
                //ver http://www.php.net/manual/es/function.json-encode.php para más info
                $jsondata["data"]["users"][] = $row;
            }
        } else {

            $jsondata["success"] = false;
            $jsondata["data"] = array(
                'message' => 'No se encontró ningún resultado.'
            );
        }

        $result->close();
    } else {

        $jsondata["success"] = false;
        $jsondata["data"] = array(
            'message' => $database->error
        );
    }

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);

    $database->close();
}

function buscar_personas($nombre) {
    if (is_string($nombre)) {
        $nombre = trim($nombre);
        $nombre = strip_tags($nombre);
        $nombre = htmlspecialchars($nombre);
        $conexion = new PDO("mysql:host=localhost;dbname=ejemploajax", "root", "");

        $obtenerUsuarios = $conexion->prepare("SELECT * FROM CYB_USERS WHERE USERNAME = :nom");
        $obtenerUsuarios->bindParam(":nom", $nombre);
        $obtenerUsuarios->execute();

        $usuarios = $obtenerUsuarios->fetchAll(PDO::FETCH_ASSOC);
        $resultado = $usuarios;
    } else {
        $resultado = "No se ingreso un nombre valido";
    }
    header('Content-type: application/json; charset=utf-8');
    echo json_encode(["resultado" => $resultado]);
}

exit();
