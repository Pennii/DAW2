<?php

const MATRICULAS = "/^[A-Z]{3}[1-9]{3}$/";
$precios = [["nombre" => "aceite", "precio" => 65], ["nombre" => "filtros",
        "precio" => 87], ["nombre" => "distribucion", "precio" => 950], ["nombre" =>
        "neumaticos", "precio" => 225]];

function validar_texto($campo) {
    //quitamos espacios del inicio y final
    $campo = trim($campo);
    //quitamos las etiquetas html y otros caracteres especiales
    $campo = strip_tags($campo);
    $campo = htmlspecialchars($campo, ENT_QUOTES);
    if ($campo == "") {
        $campo = false;
    }

    return $campo;
}

function validar_matricula($matricula) {
    //Llamamos a la expresion regular para los matriculas
    $valido = false;
    //Validamos el texto
    $matricula = validar_texto($matricula);
    if (is_string($matricula)) {
        //El matricula sera valido si el texto coincide con la exp regular y es de 30 caracteres max
        $valido = preg_match(MATRICULAS, $matricula);
    }
    //Si no pasamos un texto valido devuelve false, si pasamos uno correcto lo devuelve
    if ($valido) {
        $salida = $matricula;
    } else {
        $salida = "Invalido";
    }
    return $salida;
}

function campos_vacios($campos) {
    $faltas = [];
    $salida = "falta cargar los datos:";
    $camposCargados = array_keys($campos);
    $listaCampos = ["matricula", "marcas", "modelo", "color", "reparacion", "iva"];
    foreach ($campos as $clave => $campo) {
        if (empty($campo)) {
            array_push($faltas, $clave);
        }
    }
    foreach ($listaCampos as $clave => $campo) {
        if (!in_array($campo, $camposCargados)) {
            array_push($faltas, $campo);
        }
    }
    foreach ($faltas as $campo) {
        $salida .= " -$campo";
    }
    return $salida;
}

function precio_bruto($reparaciones) {
    $total = 0;
    global $precios;
    foreach ($precios as $datos) {
        foreach ($reparaciones as $reparacion) {
            $total += $reparacion == $datos["nombre"] ? $datos["precio"] : 0;
        }
    }
    return $total;
}

function campos_malos($campos) {
    $datos = [];
    $salida = "error al ingresar los campos";
    foreach ($campos as $nombre => $campo) {
        if ($campo === "Invalido") {
            array_push($datos, $nombre);
        }
    }
    foreach ($datos as $campo) {
        $salida .= " -$campo";
    }
    return $salida;
}
