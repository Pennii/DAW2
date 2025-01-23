<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "administrador") {
    header("Location: index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?php if (filter_has_var(INPUT_GET, "mensaje")) echo htmlspecialchars(filter_input(INPUT_GET, "mensaje")); ?></p>
        <form action="cargar_espectaculo.php" method="post">
            <label>Codigo de espectaculo</label>
            <input type="text" name="codigoEspectaculo">
            <br>
            <label>Nombre</label>
            <input type="text" name="nombre">
            <br>
            <label>Tipo</label>
            <select name="tipo">
                <option value="teatro">Teatro</option>
                <option value="musical">Musical</option>
                <option value="cine">Cine</option>
                <option value="tv">TV</option>
            </select>
            <br>
            <label>Codigo de grupo</label>
            <input type="text" name="codigoGrupo">
            <br>
            <button name="cargarEspectaculo">Cargar espectaculo</button>
        </form>
        <a href="cerrar_sesion.php">Cerrar Sesion</a>
    </body>
</html>
