<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "usuario") {
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
          <p><?php if(filter_has_var(INPUT_GET, "mensaje")) echo htmlspecialchars(filter_input(INPUT_GET, "mensaje")); ?></p>
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
                            <td><a href="reservar_espectaculo.php?mensaje=espectaculo reservado"> reservar </a></td>
                </tr>
                <?php }
                ?>
        </table>
    </body>
</html>