<?php

class Conexion {

    private $nombre;
    private $host;
    private $usuario;
    private $clave;
    private $conexion;

    public function __construct($nombre, $host, $usuario, $clave="") {
        $this->nombre = $nombre;
        $this->host = $host;
        $this->usuario = $usuario;
        $this->clave = $clave;

        $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->nombre", "$this->usuario", "$this->clave");
    }

    public function validar_datos(array $datos) {
        foreach ($datos as $clave => $valor) {
            $datos[$clave] = Conexion::sanear_texto($valor);
        }
        try {
            $consultarUsuario = $this->conexion->prepare("SELECT CLAVE FROM USUARIOS WHERE LOGIN = :login");
            $consultarUsuario->bindParam(":login", $datos["usuario"]);
            $consultarUsuario->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $fila = $consultarUsuario->fetch(PDO::FETCH_ASSOC);
        $resultado = $fila ? password_verify($datos["clave"], $fila["CLAVE"]) : false;
        return $resultado;
    }

    public function obtenerRol($usuario) {
        $usuario = Conexion::sanear_texto($usuario);
        try {
            $rolUsuario = $this->conexion->query("SELECT TIPO FROM ROLES, USUARIOS WHERE LOGIN = '$usuario' AND ROLES.ID_ROL = USUARIOS.ID_ROL")->fetch(PDO::FETCH_ASSOC)["TIPO"];
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $rolUsuario;
    }

    public static function sanear_texto($campo) {
        $campo = trim($campo);
        $campo = strip_tags($campo);
        $campo = htmlspecialchars($campo);

        return $campo;
    }
}
