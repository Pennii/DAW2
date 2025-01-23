<?php

if (filter_has_var(INPUT_POST, "reiniciar")) {
    setcookie("usuario[nVistas]", 1, time() + 3600 * 24 * 7);
    setcookie("usuario[nombre]", filter_input(INPUT_POST, "usuario"), time() + 3600 * 24 * 7);
    setcookie("usuario[fCon]", filter_input(INPUT_POST, "fecha"), time() + 3600 * 24 * 7);
    header("Location: ./usuario.php");
}
if (filter_has_var(INPUT_POST, "eliminar")) {
    setcookie("usuario[nombre]", "", time()-1);
    setcookie("usuario[nVistas]", "", time()-1);
    setcookie("usuario[fCon]", "", time()-1);
    header("Location: ./usuario.php");
}
if (!filter_has_var(INPUT_POST, "eliminar") && !filter_has_var(INPUT_POST, "reiniciar")) {
    header("Location: ./index.php");
}