<?php

if (filter_has_var(INPUT_POST, "registrar")) {
    header("Location: registrar.php");
} else if (filter_has_var(INPUT_POST, "iniciar")) {
    if (!filter_has_var(INPUT_COOKIE, "contador")) {
        setcookie("contador", 1, time() + 3600);
    }
    header("Location: login.php");
} else {
    header("Location: index.html");
}
