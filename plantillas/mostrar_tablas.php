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
        $conexion = new mysqli('localhost', 'root', '', 'biblioteca');
        $error = $conexion->connect_error;
        if ($error) {
            echo $error;
        } else {
            $consulta = $conexion->query("SELECT * FROM prestamos;");
            if ($consulta) {
                ?>
                <table border="1">
                    <?php
                    $cabecera = false;
                    while ($fila = $consulta->fetch_assoc()) {
                        ?>
                        <tr>
                            <?php
                            foreach ($fila as $atributo) {
                                if (!$cabecera) {
                                    ?>
                                    <?php
                                    foreach ($fila as $campo => $atr) {
                                        ?>

                                        <th>
                                            <?php
                                            echo $campo;
                                            ?>
                                        </th>
                                        <?php
                                    }
                                    ?></tr>
                                <tr>
                                    <?php
                                    $cabecera = true;
                                }
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
                    }
                    ?>
                </table>
                <?php
            }
        }
        $conexion->close();
        ?>
    </body>
</html>
