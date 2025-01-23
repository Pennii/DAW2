<?php
//Movi parte del codigo del ejercicio anterior arriba para crear la cookie
require_once './funciones.php';
try {
    $conexion = new PDO("mysql:host=localhost;dbname=espectaculos", "root", "");
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
if (filter_has_var(INPUT_POST, "iniciar")) {
    //Si la cookie contador no existe se crea con valor a 1, si ya existe se aumenta su valor
    if (!filter_has_var(INPUT_COOKIE, "contador")) {
        setcookie("contador", 1, time() + 3600);
    }
}
if (filter_has_var(INPUT_POST, "ingresar")) {
    //Si me encuentro en la pagina y el usuario borra la cookie de contador, al momento de recargar la pagina lo redirecciono a la pagina de inicio 
    if (!filter_has_var(INPUT_COOKIE, "contador")) {
        header("Location: ./index.php");
    } else {
        $actual = filter_input(INPUT_COOKIE, "contador");
        setcookie("contador", $actual + 1, time() + 3600);
    }
    $conteoClaves = "se han probado " . filter_input(INPUT_COOKIE, "contador") . " contraseñas";
    $datos = filter_input_array(INPUT_POST);
    //Si el usuario es valido craemos las cookies y lo llevamos a la pagina de usuario
    if (validar_datos($datos, $conexion)) {
        $usuario = validar_usuario($datos["usuario"]);
        date_default_timezone_set('CET');
        $fecha = date("d-m-Y H:i:s");
        $datosConexion = ["usuario" => $usuario, "fecha" => $fecha];
        //Creamos la cookie de conexion exitosa para la pagina de redireccion
        setcookie("conexionExitosa", "Hola $usuario, bienvenido", time() + 3600);

        //Creamos la cookie de usuario
        if (!filter_has_var(INPUT_COOKIE, "usuario")) {
            $nVistas = 1;
            setcookie("usuario[nombre]", $usuario, time() + 3600 * 24 * 7);
            setcookie("usuario[nVistas]", $nVistas, time() + 3600 * 24 * 7);
            setcookie("usuario[fCon]", $fecha, time() + 3600 * 24 * 7);
        }
   
        if (filter_has_var(INPUT_COOKIE, "ultimaConexion")) {
            //Si existe una conexion anterior esta cookie almacenara sus datos para mostrarlos
            setcookie("anteriorConexion", filter_input(INPUT_COOKIE, "ultimaConexion"), time() + 3600 * 24 * 31);
        }
        //Esta cookie solo se mostrara en caso de que realicemos la primera conexion
        setcookie("ultimaConexion", serialize($datosConexion), time() + 3600 * 24 * 31);

        //Reiniciamos el contador de contraseñas y redirigimos al usuario
        setcookie("contador", 1, time() + 3600);
        header("Location: ./usuario.php");
    } else {
        //Si en el tercer intento el usuario no logra iniciar sesion se le bloqueara el boton para hacerlo por 1 hora
        if ($actual == 2) {
            setcookie("conexionFallida", "Se ha superado el maximo de intentos permitidos, vuelve luego", time() + 3600);
        }
        $mensajeLogin = "error al ingresar datos";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!<!-- Inicio del codigo de la actividad 4_1 -->
        <?php
        if (filter_has_var(INPUT_POST, "crear")) {
            $datos = filter_input_array(INPUT_POST);
            $datos["usuario"] = validar_usuario($datos["usuario"]);
            $datos["clave"] = validar_clave($datos["clave"]);

            if ($datos["usuario"] && $datos["clave"] && usuario_disponible($datos["usuario"], $conexion)) {
                //Agrego el cifrado de contraseña
                $datos["clave"] = password_hash($datos["clave"], PASSWORD_DEFAULT);
                try {
                    $conexion->beginTransaction();
                    $insertarUsuario = $conexion->prepare("INSERT INTO USUARIOS (login, clave) VALUES (:nombre, :clave)");
                    $insertarUsuario->bindParam(":nombre", $datos["usuario"]);
                    $insertarUsuario->bindParam(":clave", $datos["clave"]);
                    $insertarUsuario->execute();
                    $conexion->commit();
                } catch (Exception $exc) {
                    echo $exc->getLine();
                }
                if ($insertarUsuario->rowCount() > 0) {
                    $salida = "usuario creado correctamente";
                } else {
                    $salida = "No se ha podido crear el usuario";
                }
            } else {
                $salida = "Error al ingresar datos";
            }
            echo $salida;
        }
        if (filter_has_var(INPUT_POST, "registrar")) {
            ?>
            <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="post">
                <label>Nombre de usuario: </label>
                <input type="text" name="usuario">
                <br>
                <label>Contraseña: </label>
                <input type="text" name="clave">
                <br>
                <button name="crear">Crear</button>
            </form>
            <?php
        } else if (filter_has_var(INPUT_POST, "iniciar") || filter_has_var(INPUT_POST, "ingresar")) {
            ?>
            <?php if (filter_has_var(INPUT_POST, "ingresar")) { ?>
                <div>
                    <p><?php echo "$mensajeLogin $conteoClaves"; ?></p><?php } ?>
                <p><?php if (filter_has_var(INPUT_COOKIE, "conexionFallida")) echo filter_input(INPUT_COOKIE, "conexionFallida"); ?></p>
            </div>
            <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="post">
                <label>Nombre de usuario: </label>
                <input type="text" name="usuario">
                <br>
                <label>Contraseña: </label>
                <input type="text" name="clave">
                <br>
                <button name="ingresar" <?php if (filter_has_var(INPUT_COOKIE, "conexionFallida")) { ?>disabled<?php } ?>>Iniciar sesión</button>
            </form>
        <?php } else if (!filter_has_var(INPUT_POST, "ingresar")) {
            ?>
            <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="post">
                <button name="registrar">Registrarse</button>
                <button name="iniciar">Iniciar sesion</button>
            </form>  
        <?php } ?>
        <!<!-- Fin de la actividad 4_1 -->
    </body>
</html>
