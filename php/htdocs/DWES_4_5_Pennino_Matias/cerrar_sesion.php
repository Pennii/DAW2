<?php
session_start();
session_destroy();
setcookie("inactividad", "0", time() - 1);
header("Location: index.php");
