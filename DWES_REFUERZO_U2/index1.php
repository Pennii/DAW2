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
        require_once 'validaciones.php';
        $cantidadCampos = 3;
        $campos = filter_input_array(INPUT_GET);
        if (is_array($campos)) {
            $completo = count($campos) == $cantidadCampos;
            $invalido = false;
            if ($completo) {
                $campos["dni"] = validar_dni($campos["dni"]);
                $campos["modulos"] = validar_modulos($campos["modulos"]);
                foreach ($campos as $campo) {
                    if ($campo === false) {
                        $invalido = true;
                    }
                }
            }else{
                $invalido = true;
            }
        }
        ?>
        <form action="<?php filter_input(INPUT_SERVER, "PHP_SELF") ?>" method="get">
            <label>Ingresa tu DNI</label>
            <input type="text" name="dni" placeholder="7 numeros y 1 letra">
            <br>
            <br>
            <label>DIW</label>
            <input type="checkbox" name="modulos[]" value="diw">
            <label>Despliegue</label>
            <input type="checkbox" name="modulos[]" value="despliegue">
            <label>DWEC</label>
            <input type="checkbox" name="modulos[]" value="dwec">
            <label>DWES</label>
            <input type="checkbox" name="modulos[]" value="dwes">
            <br>
            <br>
            <button name="enviar" value="1">Enviar datos</button>
        </form>
        <br>
        <?php
        if (filter_input(INPUT_GET, "enviar")) {
            if (!$invalido) {
                $salida = "todo correcto";
            }else{
                $salida = "datos invalidos";
            }
        } else {
            $salida = "Ingresa los datos";
        }
        echo $salida;
        ?>
    </body>
</html>
