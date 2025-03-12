<?php
require_once './Actor.php';
session_start();
if ($_SESSION["rol"] != "administrador") {
    header("Location: index.php");
}
$actores = Actor::listarActores();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrar Actores</title>
        <!--Se importa jquery-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <form action="controladorActor.php" method="post">
            <label>Actores:</label>
            <select name="actor" id="actorSelect">
                <option value="">Seleccione un actor</option>
                <?php
                foreach ($actores as $actor) {
                    ?>
                    <option value="<?php echo $actor["cdactor"]; ?>"><?php echo $actor["nombre"]; ?></option>
                    <?php
//                echo "<option value='{$actor["cdactor"]}'>{$actor["nombre"]}</option>";
                }
                ?>
            </select>
            <br>
            <button name="eliminar">Eliminar</button>
            <button name="buscar">Buscar</button>
            <br>
            <button name="asignar">Asignar supervisor</button>
            <!--Ambos select tienen un id con el cual ajax trabajará-->
            <select name="supervisor" id="supervisorSelect">
                <option value="">Seleccione un supervisor</option>
                <?php
                foreach ($actores as $actor) {
                    ?>
                    <option value="<?php echo $actor["cdactor"]; ?>"><?php echo $actor["nombre"]; ?></option>
                    <?php
//                    echo "<option value='{$actor["cdactor"]}'>{$actor["nombre"]}</option>";
                }
                ?>
            </select>
        </form>

        <script>
//          Con este script, javascript se comunicara con un archivo php para poder
//          cambiar la informacion de los desplegables sin recargar la pagina
            $(document).ready(function () {
                $("#actorSelect").change(function () {
                    let actorSeleccionado = $(this).val();

                    $.ajax({
                        url: "filtrarSupervisores.php",
                        type: "POST",
                        data: {actor: actorSeleccionado},
//                      Si el servidor puede devolver los datos entonces se ejecuta
//                      lo siguiente
                        success: function (response) {
//                            De esta forma asignamos los actores que no sean iguales
//                            al elegido anteriormente
                            let salida = "";
                            $.each(response, function (key, value) {
                                salida += value;
                            });
                            $("#supervisorSelect").html(salida);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
