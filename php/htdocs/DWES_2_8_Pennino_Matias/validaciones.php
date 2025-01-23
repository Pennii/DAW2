<?php

$nombresValidos = "/^([A-Za-zÁÉÍÓÚáéíóú]+)([ ][A-Za-zÁÉÍÓÚáéíóú]+)?$/";


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

function validar_anio($campo) {
    //quitamos los espacios vacios
    $campo = validar_texto($campo);
    //establecemos el rango de edad
    $rangos = ["options" => ["default" => 0, "min_range" => 1800, "max_range" => 2099]];
    //quitamos caracteres especiales
    $campo = filter_var($campo, FILTER_SANITIZE_NUMBER_INT);
    //validamos si es un entero en el rango
    $campo = filter_var($campo, FILTER_VALIDATE_INT, $rangos);

    return $campo;
}


function validar_modulo($campo) {
    $invalido = false;
    //establecemos los modulos que son correctos
    $modulos = ["DWES","DWEC","FOL","DIW"];
    foreach ($campo as $nombre => $modulo) {
        //validamos el texto
        $campo[$nombre] = validar_texto($modulo);
        //si encontramos algo que no pertenezca al array el campo es invalido
        if (!in_array($campo[$nombre], $modulos)) {
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

//Validamos que un nombre sea correcto
function validar_nombre($nombre) {
    //Llamamos a la expresion regular para los nombres
    global $nombresValidos;
    $valido = false;
    //Validamos el texto
    $nombre = validar_texto($nombre);
    if (is_string($nombre)) {
        //El nombre sera valido si el texto coincide con la exp regular
        $valido = preg_match($nombresValidos, $nombre);
    }
    //Si no pasamos un texto valido devuelve false, si pasamos uno correcto lo devuelve
    if ($valido) {
        $salida = $nombre;
    } else {
        $salida = false;
    }
    return $salida;
}

