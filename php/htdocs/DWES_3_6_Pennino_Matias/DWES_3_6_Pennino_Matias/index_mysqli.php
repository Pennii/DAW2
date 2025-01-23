<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        try {
            $conexion = new mysqli("localhost", "root", '', "espectaculos");
        } catch (Exception $exc) {
            echo "Error al conectarse a la bd " . $exc->getTraceAsString();
        }
        try {
            $consulta = $conexion->stmt_init();
            $consulta->prepare("SELECT * FROM ESPECTACULO WHERE NOMBRE LIKE ? ORDER BY ESTRELLAS DESC;");
            $letra = "%n%";
            $consulta->bind_param("s", $letra);
            $ejecutado = $consulta->execute();
        } catch (Exception $ex) {
            $conexion->close();
            exit("Error al realizar la consulta " . $exc->getMessage());
        }
        if ($ejecutado) {
            ?>
            <table border="1">
                <tr>
                    <?php
                    $resultado = $consulta->get_result();
                    $fila = $resultado->fetch_assoc();
                    foreach ($fila as $nombre => $atributo) {
                        ?>
                        <th>
                            <?php echo $nombre ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                do {
                    ?>
                    <tr>
                        <?php
                        foreach ($fila as $atributo) {
                            ?>
                            <td>
                                <?php echo $atributo; ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                } while ($fila = $resultado->fetch_assoc())
                ?> 
            </table>
            <?php
        } else {
            echo "No se ha realizado la consulta";
        }
        $consulta->close();
        $conexion->close();
        ?>
    </body>
</html>
