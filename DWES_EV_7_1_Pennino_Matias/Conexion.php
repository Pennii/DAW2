<?php

require_once './funciones.php';

class Conexion {

    private static ?PDO $conexion = null;

    public static function conectar() {
        if (self::$conexion == null) {
            self::$conexion = new PDO("mysql:host=localhost;dbname=espectaculos", "root", "");
        }
        return self::$conexion != null;
    }

    public static function getConexion() {
        return self::$conexion;
    }

    public function desconectar() {
        if (self::$conexion != null) {
            self::$conexion = null;
        }
        return self::$conexion == null;
    }
}
