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
        require_once './validaciones.php';
        $cantidad = 3;//cantidad de campos a considerar para un envio completo
        $dolar = 0.9;//valor del dolar a comparacion del euro
        $campos = filter_input_array(INPUT_GET);
        if (is_array($campos)) {
            $completo = count($campos) == $cantidad;
            if ($completo) {
                //si el envio es valido validamos los datos
                $campos["articulos"] = validar_articulos($campos["articulos"]);
                $campos["pais"] = validar_pais($campos["pais"]);
                print_r($campos);
                $invalido = false;
                foreach ($campos as $campo) {
                    if ($campo === false) {
                        //si algun campo es invalido entonces el envio es invalido
                        $invalido = true;
                    }
                }
            }
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="get">
            <table style="align: center; text-align: left;" border="1px">
                <tbody>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Artículo</th>
                        <th>Precio</th>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="articulos[]" value="Cable HDMI"
                                   <?php if (filter_has_var(INPUT_GET, "articulos") && $campos["articulos"] != false && in_array("Cable HDMI", $campos["articulos"])) echo "checked"; ?>></td>
                        <td>Cable HDMI</td>
                        <td>6.79€</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="articulos[]" value="Cable rj45 cat6 bobina"
                                   <?php if (filter_has_var(INPUT_GET, "articulos") && $campos["articulos"] != false && in_array("Cable rj45 cat6 bobina", $campos["articulos"])) echo "checked"; ?>></td>
                        <td>Cable rj45 cat6 bobina</td>
                        <td>69.00€</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="articulos[]" value="Conector rj45 100ud"
                                   <?php if (filter_has_var(INPUT_GET, "articulos") && $campos["articulos"] != false && in_array("Conector rj45 100ud", $campos["articulos"])) echo "checked"; ?>></td>
                        <td>Conector rj45 100ud</td>
                        <td>12.09€</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="articulos[]" value="Switch 4 puertos"
                                   <?php if (filter_has_var(INPUT_GET, "articulos") && $campos["articulos"] != false && in_array("Switch 4 puertos", $campos["articulos"])) echo "checked"; ?>></td>
                        <td>Switch 4 puertos</td>
                        <td>19.99€</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="articulos[]" value="Switch 8 puertos"
                                   <?php if (filter_has_var(INPUT_GET, "articulos") && $campos["articulos"] != false && in_array("Switch 8 puertos", $campos["articulos"])) echo "checked"; ?>></td>
                        <td>Switch 8 puertos</td>
                        <td>29.99€</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <label>Ingresa tu pais</label>
            <input type="text" name="pais" value="<?php echo filter_input(INPUT_GET, "pais"); ?>">
            <br>
            <button name="enviar" value="1">enviar</button>
            <!<!-- comprobamos si es posible transformar el precio -->
            <?php if (filter_has_var(INPUT_GET, "enviar") && !$invalido){?><button name="transformar" value="1">Transformar</button><?php } ?>
        </form>
        <?php
        if (filter_has_var(INPUT_GET, "enviar")|| filter_has_var(INPUT_GET, "transformar")) {
            if ($completo) {
                if (!$invalido) {
                    //si el envio fue valido se añaden los articulos a una cadena para mostrarlos
                    $articulos = "";
                    foreach ($campos["articulos"] as $articulo) {
                        $articulos = $articulos . " - " . $articulo;
                    }
                    $precio = calcular_precio($campos["articulos"], $campos["pais"]);
                    $moneda = "€";
                    //asignamos el precio total y la moneda
                    if (filter_has_var(INPUT_GET, "transformar")) {
                        //si se transforma el texto entonces se cambia el precio y la moneda
                        $precio = $precio * $dolar;
                        $moneda = "$";
                    }
                    //se muestra la salida de la compra
                    $salida = "Se ha comprado: $articulos. El total de envio ha sido $precio $moneda";
                    if (strtolower($campos["pais"]) != "españa") {
                        //si el pais no es españa se añade la aclaracion de los 10 euros extra
                        $salida = $salida . " se han añadidio 10€ por gastos de envio";
                    }
                }
            }
            if (!$completo || $invalido) {
                //en caso de que el envio este incompleto o invalido se muestra el mensaje de error
                $salida = "error al ingresar datos";
            }
        } else {
            //mensaje para cuando no se ha realizado ningun envio
            $salida = "Ingresa datos";
        }
        echo $salida;
        ?>
    </body>
</html>
