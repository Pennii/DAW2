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
        function suma($num1,$num2){
            return $num1+$num2;
        }
        function resta($num1,$num2){
            return $num1 - $num2;
        }
        function multiplicacion($num1,$num2){
            return $num1 * $num2;
        }
        function division($num1,$num2){
            return $num1 / $num2;
        }
        function resto($num1,$num2){
            return $num1 % $num2;
        }
        function incremento(&$num1){
            $num1++;
        }
        
        ?>
    </body>
</html>
