<?php

$nombresValidos = "/^([A-ZÑ][a-zñ]+)([ ][A-ZÑ][a-zñ]+)*$/";
$emailValidos = "/^([a-zA-Z\d-]+)@([a-zA-Z\d-]+)(\.es|\.com)$/";
$urlValidas = "/^(w{3})\.[a-zA-Z\/]+\.(es|com)$/";

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
    foreach ($campo as $nombre => $aficion) {
        //validamos el texto
        $campo[$nombre] = validar_texto($aficion);
        //si encontramos algo que no pertenezca al array el campo es invalido
        if (!in_array($campo[$nombre], $aficiones)) {
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

//Validamos que un nombre sea correcto
function validar_nombre($nombre) {
    //Llamamos a la expresion regular para los nombres
    global $nombresValidos;
    $valido = false;
    //Validamos el texto
    $nombre = validar_texto($nombre);
    if (is_string($nombre)) {
        //El nombre sera valido si el texto coincide con la exp regular y es de 30 caracteres max
        $valido = preg_match($nombresValidos, $nombre) && strlen($nombre) <= 30;
    }
    //Si no pasamos un texto valido devuelve false, si pasamos uno correcto lo devuelve
    if ($valido) {
        $salida = $nombre;
    } else {
        $salida = false;
    }
    return $salida;
}

//Validamos los email
function validar_email($email) {
    //Llamamos a la expresion regular para los mails
    global $emailValidos;
    $valido = false;
    //Validamos el mail
    $email = validar_texto($email);
    //Sanitizamos el correo
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (is_string($email)) {
        /*Si el correo coincide con la exp regular devolvemos un array con las
         *coincidencias, siendo la posicion 0 la que almacena la cadena completa,
         * y se crea una posicion para cada grupo de la expresion*/
        preg_match($emailValidos, $email, $valido);
    }
    return $valido;
}

//Validamos las url
function validar_url($url) {
    //Llamamos a la expresion regular para las url
    global $urlValidas;
    $valido = false;
    //Validamos el texto y lo sanitizamos
    $url = validar_texto($url);
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if (is_string($url)) {
        //Si la url coincide con la exp regular devolvemos el array de coincidencias
        preg_match($urlValidas, $url, $valido);
    }
    return $valido;
}
