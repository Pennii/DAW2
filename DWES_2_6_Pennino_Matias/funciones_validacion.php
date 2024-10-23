<?php

/* validamos si la cadena ingresada es un texto, consideramos que puede escribirse
  mas de una palabra */

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

//validamos si se ingreso una edad entre 5 y 99
function validar_edad($campo) {
    //quitamos los espacios vacios
    $campo = trim($campo);
    //establecemos el rango de edad
    $rangos = ["options" => ["default" => 0, "min_range" => 5, "max_range" => 99]];
    //quitamos caracteres especiales
    $campo = filter_var($campo, FILTER_SANITIZE_NUMBER_INT);
    //validamos si es un entero en el rango
    $campo = filter_var($campo, FILTER_VALIDATE_INT, $rangos);

    return $campo;
}

//validamos si el sexo es valido
function validar_sexo($campo) {
    $salida = false;
    //establecemos los sexos posibles
    $sexos = ["hombre", "mujer"];
    //validamos el texto
    $campo = validar_texto($campo);
    //si es valido devuelve el campo sino false
    $valido = in_array($campo, $sexos);
    if ($valido) {
        $salida = $campo;
    }
    return $salida;
}

//validamos si las aficiones pasadas son validas
function validar_aficion($campo) {
    $invalido = false;
    //establecemos las aficiones que son correctas
    $aficiones = ["deportes", "musica", "alimentacion", "moda"];
    foreach ($campo as $aficion) {
        //validamos el texto
        $aficion = validar_texto($aficion);
        //si encontramos algo que no pertenezca al array el campo es invalido
        if (!in_array($aficion, $aficiones)) {
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

function validar_provincia($campo) {
    $invalido = false;
    //establecemos las aficiones que son correctas
    $provincias = ["0", "almeria", "granada", "huelva", "sevilla", "malaga", "cadiz"];
    //validamos el texto
    $campo = validar_texto($campo);
    $valido = in_array($campo, $provincias);
    //si el campo es valido se devuelve, sino se devuelve false
    if ($valido) {
        $salida = $campo;
    } else {
        $salida = false;
    }
    return $salida;
}
