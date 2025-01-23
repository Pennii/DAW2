
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
            $conexion = new PDO("mysql:hostname=localhost;dbname=espectaculos","root", "");
        } catch (Exception $exc) {
            echo "Error al conectarse a la bd " . $exc->getTraceAsString();
        }
        try {
            $consulta = $conexion->prepare("SELECT * FROM ESPECTACULO WHERE NOMBRE LIKE :letra ORDER BY ESTRELLAS DESC;");
            $letra = "%n%";
            $consulta->bindParam(":letra", $letra);
            $ejecutado = $consulta->execute();
        } catch (Exception $ex) {
            $conexion->close();
            exit("Error al realizar la consulta " . $exc->getMessage());
        }
        if ($ejecutado) {
            if ($consulta->rowCount() > 0) {
                ?>
                <table border="1">
                    <tr>
                        <?php
                        $fila = $consulta->fetch(PDO::FETCH_ASSOC);
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
                    } while ($fila = $consulta->fetch(PDO::FETCH_ASSOC))
                    ?> 
                </table>
                <?php
            } else {
                echo "No hay registros para espectaculos con esa letra";
            }
        } else {
            echo "No se ha realizado la consulta";
        }
        ?>
    </body>
</html>
