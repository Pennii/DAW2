<?php
    if(filter_has_var(INPUT_POST, "registrar")){
        header("Location: ./registro.html");
    }else{
        $datos = filter_input_array(INPUT_POST);
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=login', 'root', '');
        } catch (exception $ex) {
            echo $ex->getMessage();
        }
        try {
            $consultarUsuario = $conexion->query("SELECT * FROM USUARIOS WHERE USUARIO = '".$datos["usuario"]."'");
        } catch (exception $ex) {
            echo $ex->getMessage();
        }
        $fila = $consultarUsuario->fetch(PDO::FETCH_ASSOC);
        if (password_verify($datos["clave"], $fila["Clave"])) {
            try {
                $obtenerHabitaciones = $conexion->query("SELECT * FROM HABITACIONES");
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            setcookie('tabla',);
            setcookie("nombre", $datos["usuario"], time() + 120);
            header("Location: ./logeado.html");
        }else{
            header("Location: ./index.html");
        }
    }
    ?>