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
        include 'funciones.php';
        $valor1 = 5;
        $valor2 = 3;
        echo suma($valor1, $valor2);
        echo resta($valor1, $valor2);
        echo multiplicacion($valor1, $valor2);
        echo division($valor1, $valor2);
        echo resto($valor1, $valor2);
        echo 'La variable $valor1 vale ' . $valor1;
        echo incremento($valor1, $valor2);
        echo 'La variable $valor1 vale ' . $valor1;
        ?>
    </body>
</html>
