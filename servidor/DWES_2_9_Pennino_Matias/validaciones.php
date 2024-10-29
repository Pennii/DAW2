<?php
//validamos el numero
function validar_numero($campo) {
    //quitamos los espacios vacios
    $campo = trim($campo);
    //quitamos caracteres especiales
    $campo = filter_var($campo, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    //validamos si es un entero en el rango
    $campo = filter_var($campo, FILTER_VALIDATE_FLOAT);
    return $campo;
}
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
function validar_operacion($campo) {
    $invalido = false;
    //establecemos las aficiones que son correctas
    $operaciones = ["suma", "resta", "multiplicacion", "division"];
    foreach ($campo as $nombre => $operacion) {
        //validamos el texto
        $campo[$nombre] = validar_texto($operacion);
        //si encontramos algo que no pertenezca al array el campo es invalido
        if (!in_array($campo[$nombre], $operaciones)) {
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