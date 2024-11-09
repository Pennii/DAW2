<?php

const DNI_VALIDO = "/^[1-9]{7}[A-Z]$/";
const NOMBRE_VALIDO = "/^[A-Z]+$/";
const ID_VALIDO = "/^[0-9]+$/";

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

function validar_modulos($campo) {
    $invalido = false;
    //establecemos las checkbox que son correctas
    $modulos = ["diw", "dwec", "despliegue", "dwes"];
    foreach ($campo as $nombre => $modulo) {
        //validamos el texto
        $campo[$nombre] = validar_texto($modulo);
        //si encontramos algo que no pertenezca al array el campo es invalido
        if (!in_array($campo[$nombre], $modulos)) {
            $invalido = true;
        }
    }
    //si el campo es valido se devuelve, sino se devuelve false
    $salida = $invalido ? false : $campo;
    return $salida;
}

function validar_categorias($campo) {
    $invalido = false;
    //establecemos las checkbox que son correctas
    $categorias = ["cosmetica", "hogar", "alimentacion", "textil"];
    foreach ($campo as $nombre => $categoria) {
        //validamos el texto
        $campo[$nombre] = validar_texto($categoria);
        //si encontramos algo que no pertenezca al array el campo es invalido
        if (!in_array($campo[$nombre], $categorias)) {
            $invalido = true;
        }
    }
    //si el campo es valido se devuelve, sino se devuelve false
    $salida = $invalido ? false : $campo;
    return $salida;
}

function validar_dni($dni) {
    //Llamamos a la expresion regular para los nombre
    $valido = false;
    //Validamos el texto
    $dni = validar_texto($dni);
    if (is_string($dni)) {
        //El nombre sera valido si el texto coincide con la exp regular y es de 30 caracteres max
        $valido = preg_match(DNI_VALIDO, $dni);
    }
    //Si no pasamos un texto valido devuelve false, si pasamos uno correcto lo devuelve
    if ($valido) {
        $salida = $dni;
    } else {
        $salida = false;
    }
    return $salida;
}

function validar_nombre($nombre) {
    //Llamamos a la expresion regular para los nombres
    $valido = false;
    //Validamos el texto
    $nombre = validar_texto($nombre);
    if (is_string($nombre)) {
        //El nombre sera valido si el texto coincide con la exp regular y es de 30 caracteres max
        $valido = preg_match(NOMBRE_VALIDO, $nombre);
    }
    //Si no pasamos un texto valido devuelve false, si pasamos uno correcto lo devuelve
    if ($valido) {
        $salida = $nombre;
    } else {
        $salida = "Invalido";
    }
    return $salida;
}

function validar_id($id) {
    //Llamamos a la expresion regular para los nombres
    $valido = false;
    //Validamos el texto
    $id = validar_texto($id);
    if (is_string($id)) {
        //El nombre sera valido si el texto coincide con la exp regular y es de 30 caracteres max
        $valido = preg_match(ID_VALIDO, $id);
    }
    //Si no pasamos un texto valido devuelve false, si pasamos uno correcto lo devuelve
    if ($valido) {
        $salida = $id;
    } else {
        $salida = "Invalido";
    }
    return $salida;
}

function validar_iva($campo) {
    $salida = "Invalido";
    //establecemos los radios posibles
    $ivas = ["21", "18"];
    //validamos el texto
    $campo = validar_texto($campo);
    //si es valido devuelve el campo sino false
    $valido = in_array($campo, $ivas);
    if ($valido) {
        $salida = $campo;
    }
    return $salida;
}

function campos_erroneos($campos) {
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

function campos_vacios($campos) {
    $faltas = [];
    $salida = "falta cargar los datos:";
    $camposCargados = array_keys($campos);
    $listaCampos = ["nombre", "id", "precio", "iva", "categoria"];
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
