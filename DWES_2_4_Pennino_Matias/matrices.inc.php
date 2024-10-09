<?php

function muestra_matriz(array $matriz) {
    $invalida = false;
    $salida = null;
    foreach ($matriz as $valor) {
        if (!is_array($valor)) {
            $invalida = true;
        }
        foreach ($valor as $num) {
            if (!is_numeric($num)) {
                $invalida = true;
            }
        }
    }

    if (!$invalida) {
        foreach ($matriz as $fila) {
            foreach ($fila as $mostrar) {
                $salida = $salida . "$mostrar ";
            }
            $salida = $salida . "</br>";
        }
    }
    return $salida;
}

function suma_matriz(array $matriz1, array $matriz2) {
    $invalida = false;
    $salida = null;
    $conteo1 = 0;
    $conteo2 = 0;

    foreach ($matriz1 as $valor) {
        //VERIFICAMOS SI EL VALOR ACTUAL ES UNA MATRIZ
        if (!is_array($valor)) {
            $invalida = true;
        } else {
            $col = 0;
            //SI ES UNA MATRIZ VERIFICAMOS QUE SUS VALORES SEAN NUMERICOS
            foreach ($valor as $num) {
                if (!is_numeric($num)) {
                    $invalida = true;
                } else {
                    /* PARA SIMPLIFICAR LAS CLAVES ALMACENAREMOS LOS VALORES EN
                      UN NUEVO ARRAY */
                    $suma1[$conteo1][] = $num;
                    //LAS COLUMNAS SE SUMARAN EN UN NUEVO ARRAY AUXILIAR
                    $col++;
                }
            }
            $columnas1[] = $col;
        }
        //ESTA VARIABLE NOS PERMITE CONTAR LAS FILAS DE LA MATRIZ
        $conteo1++;
    }

    //REPETIMOS EL PROCESO PARA LA SEGUNDA MATRIZ
    foreach ($matriz2 as $valor) {
        if (!is_array($valor)) {
            $invalida = true;
        } else {
            $col = 0;
            foreach ($valor as $num) {
                if (!is_numeric($num)) {
                    $invalida = true;
                } else {
                    $suma2[$conteo2][] = $num;
                    $col++;
                }
            }
            $columnas2[] = $col;
        }
        $conteo2++;
    }

    //SI LA MATRIZ ES VALIDA Y TIENEN LAS MISMAS FILAS COMPARAREMOS LAS COLUMNAS
    if (!$invalida && $conteo1 == $conteo2) {
        for ($i = 0; $i < count($columnas1); $i++) {
            if ($columnas1[$i] != $columnas2[$i]) {
                $invalida = true;
            }
        }
    }

    /* SI TODO ES CORRECTO HAREMOS LA SUMA, SI HAY ALGO QUE PRODUZCA QUE LA 
      OPERACION SEA IMPOSIBLE SE DEVOLVERA FALSE */
    if (!$invalida) {
        for ($i = 0; $i < count($suma1); $i++) {
            for ($j = 0; $j < count($suma1[$i]); $j++) {
                $resultado[$i][$j] = $suma1[$i][$j] + $suma2[$i][$j];
            }
        }
        $salida = $resultado;
    }else{
        $salida = false;
    }

    return $salida;
}
