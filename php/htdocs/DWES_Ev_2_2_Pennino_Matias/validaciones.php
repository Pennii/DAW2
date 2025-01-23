<?php

function validar_texto($campo) {
    //quitamos espacios del inicio y final
    $campo = trim($campo);
    //quitamos las etiquetas html y otros caracteres especiales
    $campo = strip_tags($campo);
    $campo = htmlspecialchars($campo, ENT_QUOTES);
    //si el texto queda vacio se devuelve false
    if ($campo == "") {
        $campo = false;
    }

    return $campo;
}

function validar_articulos($campo) {
    $invalido = false;
    //establecemos los articulos que son correctos
    $articulos = ["Cable HDMI", "Cable rj45 cat6 bobina", "Conector rj45 100ud", "Switch 4 puertos", "Switch 8 puertos"];
    foreach ($campo as $nombre => $articulo) {
        //validamos el texto
        $campo[$nombre] = validar_texto($articulo);
        //si encontramos algo que no pertenezca al array el campo es invalido
        if (!in_array($campo[$nombre], $articulos)) {
            $invalido = true;
        }
    }
    //si el campo es valido se devuelve, sino se devuelve false
    if (!$invalido) {
        $salida = $campo;
    } else {
        $salida = false;
    }
    return $salida;
}

function validar_pais($campo) {
    //validamos el texto
    $campo = validar_texto($campo);
    //establecemos los paises validos
    $paises = ["españa", "alemania", "portugal", "italia"];
    if ($campo == "") {
        //si el campo esta vacio la salida y el campo se establecen a españa
        $salida = "españa";
        $campo = "españa";
    } else if (in_array(strtolower($campo), $paises)) {
        //si el campo es valido se devuelve, sino se devuelve false
        $salida = $campo;
    } else {
        $salida = false;
    }

    return $salida;
}

function calcular_precio(array $articulos, $pais) {
    $precioTot = 0;
    foreach ($articulos as $articulo) {
        //le sumaremos el precio de la tabla al total por cada articulo
        switch ($articulo) {
            case "Cable HDMI":
                $precioTot = $precioTot + 6.79;

                break;
            case "Cable rj45 cat6 bobina":
                $precioTot = $precioTot + 69;

                break;
            case "Conector rj45 100ud":
                $precioTot = $precioTot + 12.09;

                break;
            case "Switch 4 puertos":
                $precioTot = $precioTot + 19.99;

                break;

            default:
                $precioTot = $precioTot + 29.99;
                break;
        }
    }
    if (strtolower($pais) != "españa") {
        //si el pais de destino no es españa se añaden 10 euros
        $precioTot = $precioTot + 10;
    }
    return $precioTot;
}
