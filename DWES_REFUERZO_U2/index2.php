<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'validaciones.php';
        $cantidadCampos = 6;
        $campos = filter_input_array(INPUT_GET);
        if (is_array($campos)) {
            $incompleto = count($campos) != $cantidadCampos;
            $invalido = false;
            if (!$incompleto) {
                $campos["nombre"] = validar_nombre($campos["nombre"]);
                $campos["id"] = validar_id($campos["id"]);
                $campos["iva"] = validar_iva($campos["iva"]);
                $campos["categoria"] = validar_categorias($campos["categoria"]);
                foreach ($campos as $campo) {
                    if ($campo === "Invalido") {
                        $invalido = true;
                    }
                }
                $incompleto = empty($campos["nombre"]) || empty($campos["id"]) || empty($campos["precio"]);
            } else {
                $invalido = true;
            }
        }
        ?>
        <form action="<?php echo filter_input(INPUT_SERVER, "PHP_SELF"); ?>" method="get">
            <label>Ingresa el producto</label>
            <input type="text" name="nombre" value="<?php if (filter_has_var(INPUT_GET, "nombre")) echo filter_input(INPUT_GET, "nombre") ?>">
            <br><br>
            <label>Ingresa el ID</label>
            <input type="text" name="id" value="<?php if (filter_has_var(INPUT_GET, "id")) echo filter_input(INPUT_GET, "id") ?>">
            <label>Ingresa el precio</label>
            <input type="text" name="precio" value="<?php if (filter_has_var(INPUT_GET, "precio")) echo filter_input(INPUT_GET, "precio") ?>">
            <br><br>
            <label>IVA</label>
            <br><br>
            <label>21%</label><input type="radio" name="iva" value = "21" <?php if (filter_has_var(INPUT_GET, "iva")) if (filter_input(INPUT_GET, "iva") == "21") echo "checked"; ?>>
            <label>18%</label><input type="radio" name="iva" value = "18" <?php if (filter_has_var(INPUT_GET, "iva")) if (filter_input(INPUT_GET, "iva") == "18") echo "checked"; ?>>
            <br><br>
            <label>Ingresa la Categoria</label><br>
            <input type="checkbox" name="categoria[]" value="cosmetica" <?php if (filter_has_var(INPUT_GET, "categoria") && $campos["categoria"] != false && in_array("cosmetica", $campos["categoria"])) echo "checked"; ?>>
            <label>cosmetica</label>
            <input type="checkbox" name="categoria[]" value="hogar" <?php if (filter_has_var(INPUT_GET, "categoria") && $campos["categoria"] != false && in_array("hogar", $campos["categoria"])) echo "checked"; ?>>
            <label>hogar</label>
            <input type="checkbox" name="categoria[]" value="alimentacion" <?php if (filter_has_var(INPUT_GET, "categoria") && $campos["categoria"] != false && in_array("alimentacion", $campos["categoria"])) echo "checked"; ?>>
            <label>alimentacion</label>
            <input type="checkbox" name="categoria[]" value="textil" <?php if (filter_has_var(INPUT_GET, "categoria") && $campos["categoria"] != false && in_array("textil", $campos["categoria"])) echo "checked"; ?>>
            <label>textil</label>      
            <button name="guardar" value="1">guardar</button>
        </form>
        <?php
        if (filter_input(INPUT_GET, "guardar")) {
            if ($invalido) {
                if ($incompleto) {
                    
                   $salida = campos_vacios($campos);
                } else {
                    $salida = campos_erroneos($campos);
                }
            }else{
                $salida = "ta bien";
                print_r($campos);
            }
        }
        echo $salida;
        ?>
    </body>
</html>
