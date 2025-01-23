
<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "invitado") {
    header("Location: index.php");
}
require_once './funciones.php';
$espectaculos = obtenerEspectaculos();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <?php
                foreach ($espectaculos[0] as $campo => $espectaculo) {
                    ?><th><?php echo $campo ?></th><?php
                }
                ?>
            </tr>
            <?php
            foreach ($espectaculos as $espectaculo) {
                ?><tr>
                    <?php
                    foreach ($espectaculo as $campo) {
                        ?><td><?php echo $campo ?></td><?php
                    }
                    ?>
                </tr>
            <?php }
            ?>
        </table>
        <a href="cerrar_sesion.php">Cerrar Sesion</a>
    </body>
</html>
