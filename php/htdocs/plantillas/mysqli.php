<?php

//conectarse a la bd
try {
    $conexion = mysqli_connect("localhost", "root", '', $database);
    $conexion = new mysqli("localhost", "root", '', $database);
} catch (Exception $exc) {
    echo "Error al conectarse a la bd " . $exc->getTraceAsString();
}

//select
try {
    $consulta = mysqli_query($conexion, "SELECT * FROM $tabla;");
    $consulta = $conexion->query("SELECT * FROM $tabla;");
} catch (Exception $exc) {
    mysqli_close($conexion);
    $conexion->close();
    exit("Error al realizar la consulta " . $exc->getMessage());
}

//insert
try {
    mysqli_begin_transaction($conexion);
    $insertar = mysqli_query($conexion, "INSERT INTO $tabla VALUES();");
    mysqli_commit($conexion);

    $conexion->begin_transaction();
    $insertar = $conexion->query("INSERT INTO $tabla VALUES();");
    $conexion->commit();
} catch (Exception $exc) {
    mysqli_rollback($conexion);
    mysqli_close($conexion);

    $conexion->rollback();
    $conexion->close();
    exit("error al insertar " . $exc->getMessage());
}

//delete
try {
    mysqli_begin_transaction($conexion);
    $insertar = mysqli_query($conexion, "DELETE FROM $tabla WHERE $condicion;");
    mysqli_commit($conexion);

    $conexion->begin_transaction();
    $borrar = $conexion->query("DELETE FROM $tabla WHERE $condicion;");
    $conexion->commit();
} catch (Exception $exc) {
    mysqli_rollback($conexion);
    mysqli_close($conexion);

    $conexion->rollback();
    $conexion->close();
    exit("error al eliminar las tablas" . $exc->getMessage());
}

//update
try {
    mysqli_begin_transaction($conexion);
    $insertar = mysqli_query($conexion, "UPDATE $tabla SET $atributo = $valorCondicion;");
    mysqli_commit($conexion);

    $conexion->begin_transaction();
    $actualizarEspectaculos = $conexion->query("UPDATE $tabla SET $atributo = $valorCondicion;");
    $conexion->commit();
} catch (Exception $exc) {
    mysqli_rollback($conexion);
    mysqli_close($conexion);

    $conexion->rollback();
    $conexion->close();
    exit("error al actualizar las tablas" . $exc->getMessage());
}

//preparadas
try {
    mysqli_begin_transaction($conexion);
    $borrar = mysqli_stmt_init($conexion);
    mysqli_stmt_prepare($borrar, "DELETE FROM $tabla WHERE $condicion = ?");
    //types: i = entero d = real s = string b = binario
    mysqli_stmt_bind_param($borrar, 'idsb', $valorInterrogacion);
    mysqli_stmt_execute($borrar);
    mysqli_stmt_close($borrar);
    mysqli_commit($conexion);

    $conexion->begin_transaction();
    $borrar = $conexion->stmt_init();
    $borrar->prepare("DELETE FROM $tabla WHERE $condicion = ?;");
    //alternativa al bind_param
    $borrar->execute($valoresInterrogacion[]);
    $borrar->close();

    $conexion->commit();
} catch (Exception $exc) {
    mysqli_rollback($conexion);
    mysqli_stmt_close($borrar);
    mysqli_close($conexion);

    $conexion->rollback();
    $borrar->close();
    $conexion->close();
    exit("error al eliminar las tablas" . $exc->getMessage());
}