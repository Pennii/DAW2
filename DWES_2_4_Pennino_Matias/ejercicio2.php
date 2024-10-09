<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './matrices.inc.php';
        define("TAM",20);
        
        for ($contador = 1; $contador <= 50; $contador++) {
            $array[] = $contador;
        }
        $contador = 0;
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $tabla[$i][] = $array[$contador++];
            }
        }
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $tabla2[$i][] = $tabla[$j][$i];
            }
        }
        ?>
        <p>Tabla A</p>
        <table border="1">
            <?php
            foreach ($tabla as $fila => $columna) {
                echo "<tr>";
                foreach ($columna as $valor) {
                    if ($valor % 2 != 0) {
                        echo "<td style = 'background-color:orange' width = ".TAM.">$valor</td>";
                    } else {
                        echo "<td>$valor</td>";
                    }
                }
                echo"</tr>";
            }
            ?>
        </table>
        <p>Tabla B</p>
        <table border="1">
            <?php
            foreach ($tabla2 as $fila => $columna) {
                echo "<tr>";
                foreach ($columna as $valor) {
                    if ($valor % 2 != 0) {
                        echo "<td style = 'background-color:orange' width = ".TAM.">$valor</td>";
                    } else {
                        echo "<td width = ".TAM.">$valor</td>";
                    }
                }
                echo"</tr>";
            }
            ?>
        </table>
         </body>
</html>