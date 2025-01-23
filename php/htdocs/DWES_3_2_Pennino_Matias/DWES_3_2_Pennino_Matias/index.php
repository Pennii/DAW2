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
        $conexion = new mysqli('localhost', 'root', '', 'espectaculos');
        $error = $conexion->connect_error;
        if ($error) {
            echo $error;
        } else {
            $consulta = $conexion->query("SELECT * FROM ESPECTACULO;");
            $fila = $consulta->fetch_assoc();
            ?>
            <table border="1">
                <tr>
                    <?php
                    foreach ($fila as $campo => $atributo) {
                        ?>
                        <th>
                            <?php
                            echo $campo;
                            ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                while ($fila) {
                    ?>
                    <tr>
                        <?php
                        foreach ($fila as $atributo) {
                            ?>
                            <td>
                                <?php
                                echo $atributo;
                                ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                    $fila = $consulta->fetch_assoc();
                }
                ?>
            </table>
        <?php }
        $conexion->close();
        ?>
    </body>
</html>
