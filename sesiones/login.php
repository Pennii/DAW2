<?php
//Si me encuentro en la pagina y el usuario borra la cookie de contador, al momento de recargar la pagina lo redirecciono a la pagina de inicio 
if (!filter_has_var(INPUT_COOKIE, "contador")) {
    header("Location: ./index.html");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>
            <?php
            if (filter_has_var(INPUT_GET, "mensajeLogin") && filter_has_var(INPUT_GET, "conteoClaves")) {
                echo htmlspecialchars(filter_input(INPUT_GET, "conteoClaves")) . " " . htmlspecialchars(filter_input(INPUT_GET, "mensajeLogin"));
            }
            ?>
        </p>
        <p>
            <?php
            if (filter_has_var(INPUT_GET, "registro")) {
                echo htmlspecialchars(filter_input(INPUT_GET, "registro"));
            }
            ?>
        </p>
        <form action="login_proceso.php" method="post">
            <label>Nombre de usuario: </label>
            <input type="text" name="usuario">
            <br>
            <label>Contraseña: </label>
            <input type="text" name="clave">
            <br>
            <button name="ingresar" <?php if (filter_has_var(INPUT_COOKIE, "conexionFallida")) { ?>disabled<?php } ?>>Iniciar sesión</button>
        </form>
        <p>
            <?php
            if (filter_has_var(INPUT_COOKIE, "conexionFallida")) {
                echo filter_input(INPUT_COOKIE, "conexionFallida");
            }
            ?>
        </p>
    </body>
</html>
