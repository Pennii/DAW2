<?php

require_once './Actor.php';

if (isset($_POST["actor"])) {
    $listado = [];
    $actorSeleccionado = $_POST["actor"];
    $actores = Actor::listarActores();
    $listado[] = '<option value="">Seleccione un supervisor</option>';
//    echo '<option value="">Seleccione un supervisor</option>';
    foreach ($actores as $actor) {
        if ($actor["cdactor"] != $actorSeleccionado) { // Excluye el actor seleccionado
            $listado[] = "<option value='{$actor["cdactor"]}'>{$actor["nombre"]}</option>";
//            echo "<option value='{$actor["cdactor"]}'>{$actor["nombre"]}</option>";
        }
    }
    header('Content-type: application/json; charset=utf-8');
    echo json_encode(["listado" => $listado]);
}
?>
