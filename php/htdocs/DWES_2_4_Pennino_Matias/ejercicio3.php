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
        
        $mat1 = [[1,2,3],[1,2,1]];
        $mat2 = [[1,2,2],[3,3,1]];
        echo muestra_matriz($mat1);
        ?>
        <br>
        <?php
        echo muestra_matriz($mat2);
        ?>
        <br>
        <?php
        if(is_array($suma = suma_matriz($mat1, $mat2))){
            foreach ($suma as $valor) {
                foreach ($valor as $mostrar) {
                    echo "$mostrar ";
                }
                echo "</br>";
            }
        }else{
            echo "La suma no es posible";
        }
        ?>
    </body>
</html>
