<?php
$fecha = "/^([0][1-9]|[12][0-9]|[3][01])[\/-]([0][1-9]|[1][0-2])[\/-]([\d]{4})$/";
$textoSoloLetras = "/^([a-zA-Z ]+)$/";
$horas = "/^([0-1][0-9]|[2][0-3]):([0-5][0-9]):([0-5][0-9])$/";
$textoConNumeros = "/^([a-zA-Z][\w\d]+)$/";

$nombresValidos = "/^([A-ZÑ][a-zñ]+)([ ][A-ZÑ][a-zñ]+)*$/";
$emailValidos = "/^([a-zA-Z\d-]+)@([a-zA-Z\d-]+)(\.es|\.com)$/";
$urlValidas = "/^(w{3})\.[a-zA-Z\/]+\.(es|com)$/";
