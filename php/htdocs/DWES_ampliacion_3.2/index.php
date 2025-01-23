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
        $nombre = 'El elenco';
        $provincia = 'Almeria';
        $espectaculo = 'eurovision';
        $cdespec = 'EUR';
        $estrellas = 5;
        $tipo = 'musical';
        try {
            $conexion = new PDO('mysql:hostname=localhost;dbname=espectaculos', 'root', '');
        } catch (Exception $ex) {
            echo $exc->getLine();
        }

        try {
            $consultaGrupo = $conexion->prepare('SELECT CDGRUPO FROM GRUPO WHERE NOMBRE = :nom');
            $consultaGrupo->bindParam(':nom', $nombre);
            $consultaGrupo->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getLine();
        }
        if ($consultaGrupo->rowCount() == 0) {
            try {
                $consultarCodigoGrupo = $conexion->prepare('SELECT CDGRUPO FROM GRUPO ORDER BY 1 DESC');
                $consultarCodigoGrupo->execute();
            } catch (Exception $exc) {
                echo $exc->getMessage();
                echo $exc->getLine();
            }
            $codigo = $consultarCodigoGrupo->fetch(PDO::FETCH_ASSOC);

            $codigo = $codigo['CDGRUPO'];

            $codigo = $codigo >= 9 ? '' . ++$codigo : '0' . ++$codigo;
            try {
                $conexion->beginTransaction();
                $insertarGrupo = $conexion->prepare('INSERT INTO GRUPO VALUES(:cod, :nom, :prov)');
                $insertarGrupo->bindParam(':cod', $codigo);
                $insertarGrupo->bindParam(':nom', $nombre);
                $insertarGrupo->bindParam(':prov', $provincia);
                $insertarGrupo->execute();
                $conexion->commit();
            } catch (Exception $exc) {
                $conexion->rollBack();
                echo $exc->getMessage();
                echo $exc->getLine();
            }
        } else {
            $codigo = $consultaGrupo->fetch(PDO::FETCH_ASSOC);
            $codigo = $codigo['CDGRUPO'];
        }

        try {
            $consultarEspectaculo = $conexion->prepare('SELECT * FROM ESPECTACULO WHERE CDESPEC = :cod');
            $consultarEspectaculo->bindParam(':cod', $cdespec);
            $consultarEspectaculo->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getLine();
        }
        if ($consultarEspectaculo->rowCount() == 0) {
            try {
                $insertarEspectaculo = $conexion->prepare('INSERT INTO ESPECTACULO VALUES(:cod, :nom, :tipo, :estrellas, :grupo)');
                $insertarEspectaculo->bindParam(':cod', $cdespec);
                $insertarEspectaculo->bindParam(':nom', $espectaculo);
                $insertarEspectaculo->bindParam(':tipo', $tipo);
                $insertarEspectaculo->bindParam(':estrellas', $estrellas);
                $insertarEspectaculo->bindParam(':grupo', $codigo);
                $insertarEspectaculo->execute();
            } catch (Exception $exc) {
                echo $exc->getMessage();
                echo $exc->getLine();
            }
            echo 'Espectaculo insertado';
        } else {
            echo 'Ya existe el espectaculo';
        }
        try {
            $consultarActores = $conexion->query('SELECT * FROM ACTOR WHERE NOMBRE LIKE "%s%" LIMIT 3');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        while ($fila = $consultarActores->fetch(PDO::FETCH_ASSOC)) {
            echo $fila['cdactor'];
            $horas = 5;
            $fecha = date('Y-d-m');
            try {
                $conexion->beginTransaction();
                $insertarActor = $conexion->prepare('INSERT INTO INTERVIENE VALUES(:espec, :act, :horas, :fecha)');
                $insertarActor->bindParam(':espec', $cdespec);
                $insertarActor->bindParam(':act', $fila['cdactor']);
                $insertarActor->bindParam(':horas', $horas);
                $insertarActor->bindParam(':fecha', $fecha);
                $insertarActor->execute();
                $conexion->commit();
            } catch (Exception $exc) {
                $conexion->rollBack();
                echo $exc->getMessage();
            }
            echo'<br>Se inserto el actor ' . $fila['cdactor'] . '<br>';
        }
        try {
            $actorMenor = $conexion->prepare("SELECT * FROM INTERVIENE WHERE CDESPEC = :espec ORDER BY CDACTOR ASC LIMIT 1");
            $actorMenor->bindParam(':espec', $cdespec);
            $actorMenor->execute();
            $codigoMenor = $actorMenor->fetch(PDO::FETCH_ASSOC);
            $codigoMenor = $codigoMenor['cdactor'];
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        try {
            $conexion->beginTransaction();
            $eliminarActor = $conexion->prepare('DELETE FROM INTERVIENE WHERE CDACTOR = :cod');
            $eliminarActor->bindParam(':cod',$codigoMenor);
            $eliminarActor->execute();
            $conexion->commit();
        } catch (Exception $exc) {
            $conexion->rollBack();
            echo $exc->getMessage();
        }
        ?>
    </body>
</html>
