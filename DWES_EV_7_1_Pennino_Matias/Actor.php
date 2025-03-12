<?php

require_once './funciones.php';
require_once './Conexion.php';

class Actor {

    private $cdActor;
    private $nombre;
    private $fechaAlta;
    private $cacheBase;
    private $sexo;
    private $cdSupervisa;
    private $cdGrupo;

    public function __construct($cdActor, $nombre, $sexo, $cdGrupo, $fechaAlta = null, $cacheBase = null, $cdSupervisa = null) {
        $this->cdActor = sanear_texto($cdActor);
        $this->nombre = sanear_texto($nombre);
        $this->sexo = sanear_texto($sexo);
        $this->cdGrupo = sanear_texto($cdGrupo);
        $this->fechaAlta = sanear_texto($fechaAlta);
        $this->cacheBase = sanear_texto($cacheBase);
        $this->cdSupervisa = sanear_texto($cdSupervisa);
    }

    public function setCache($nuevo) {
        $nuevo = sanear_texto($nuevo);
        if (is_float($nuevo)) {
            $this->cacheBase = $nuevo;
            $cambiado = true;
        } else {
            $cambiado = false;
        }
        return $cambiado;
    }

    public function setSupervisor($nuevo) {
        $nuevo = sanear_texto($nuevo);
        try {
            $conexion = new Conexion("espectaculos", "localhost", "root");
            $consultarSupervisor = $conexion->getConexion()->prepare("SELECT CDACTOR FROM ACTOR WHERE CDACTOR = :codigo");
            $consultarSupervisor->bindParam(":codigo", $nuevo);
            $consultarSupervisor->execute();
        } catch (Exception $exc) {
            
        }
        $cambiado = $consultarSupervisor->fetch() ? true : false;
        if ($cambiado) {
            $this->cdSupervisa = $nuevo;
        }
        return $cambiado;
    }

    public static function getNumActores() {
        try {
            $conexion = new Conexion("espectaculos", "localhost", "root");
            $consultarActores = $conexion->getConexion()->query("SELECT CDACTOR FROM ACTOR");
        } catch (Exception $exc) {
            
        }
        return $consultarActores->rowCount();
    }

    public static function verActor($codigo) {
        $codigo = sanear_texto($codigo);
        try {
            $conexion = new Conexion("espectaculos", "localhost", "root");
            $consultarActor = $conexion->getConexion()->prepare("SELECT * FROM ACTOR WHERE CDACTOR = :codigo");
            $consultarActor->bindParam(":codigo", $codigo);
            $consultarActor->execute();
        } catch (Exception $exc) {
            
        }
        return $consultarActor->fetch(PDO::FETCH_ASSOC);
    }

    public static function listarActores() {
        $actores = [];
        try {
            $conexion = new Conexion("espectaculos", "localhost", "root");
            $consultarActores = $conexion->getConexion()->query("SELECT * FROM ACTOR");
        } catch (Exception $exc) {
            
        }
        while ($actor = $consultarActores->fetch(PDO::FETCH_ASSOC)) {
            array_push($actores, $actor);
        }
        return $actores;
    }

    /* Considero que la funcion de eliminar codigo puede ser estatica porque no 
     * hace falta crear una instancia de la clase actor para eliminar uno de la 
     * base de datos. Si bien se podria hacer, esta es otra opcion.
     */

    public static function eliminarActor($codigo) {
        $codigo = sanear_texto($codigo);

        if (self::verActor($codigo)) {
            try {
                $conexion = new Conexion("espectaculos", "localhost", "root");
                $conexion->getConexion()->beginTransaction();
                $eliminarActor = $conexion->getConexion()->prepare("DELETE FROM ACTOR WHERE CDACTOR = :codigo");
                $eliminarActor->bindParam(":codigo", $codigo);
                $eliminarActor->execute();
                $conexion->getConexion()->commit();
                $eliminado = true;
            } catch (Exception $exc) {
                $conexion->getConexion()->rollBack();
                $eliminado = false;
            }
        } else {
            $eliminado = false;
        }
        return $eliminado;
    }

    public function guardarActor() {
        if (self::verActor($this->cdActor)) {
            try {
                $conexion = new Conexion("espectaculos", "localhost", "root");
                $conexion->getConexion()->beginTransaction();
                $guardarActor = $conexion->getConexion()->prepare("UPDATE ACTOR SET CDACTOR = :codigoActor, "
                        . "NOMBRE = :nom, FECHA_ALTA = :fec, CACHE_BASE = :cache, SEXO = :sexo, "
                        . "CDSUPERVISA = :supervisor, CDGRUPO = :grupo WHERE CDACTOR = :codigoBuscar");
                $guardarActor->bindParam(":codigoActor", $this->cdActor);
                $guardarActor->bindParam(":nom", $this->nombre);
                $guardarActor->bindParam(":fec", $this->fechaAlta);
                $guardarActor->bindParam(":cache", $this->cacheBase);
                $guardarActor->bindParam(":sexo", $this->sexo);
                $guardarActor->bindParam(":supervisor", $this->cdSupervisa);
                $guardarActor->bindParam(":grupo", $this->cdGrupo);
                $guardarActor->bindParam(":codigoBuscar", $this->cdActor);
                $guardarActor->execute();
                $conexion->getConexion()->commit();
                $guardado = true;
            } catch (Exception $exc) {
                $conexion->getConexion()->rollBack();
                $guardado = false;
            }
        } else {
            try {
                $conexion = new Conexion("espectaculos", "localhost", "root");
                $conexion->getConexion()->beginTransaction();
                $guardarActor = $conexion->getConexion()->prepare("INSERT INTO ACTOR "
                        . "VALUES(:codigoActor, :nom, :fec, :cache, :sexo, :supervisor, :grupo)");
                $guardarActor->bindParam(":codigoActor", $this->cdActor);
                $guardarActor->bindParam(":nom", $this->nombre);
                $guardarActor->bindParam(":fec", $this->fechaAlta);
                $guardarActor->bindParam(":cache", $this->cacheBase);
                $guardarActor->bindParam(":sexo", $this->sexo);
                $guardarActor->bindParam(":supervisor", $this->cdSupervisa);
                $guardarActor->bindParam(":grupo", $this->cdGrupo);
                $guardarActor->execute();
                $conexion->getConexion()->commit();
                $guardado = true;
            } catch (Exception $exc) {
                $conexion->getConexion()->rollBack();
                $guardado = false;
            }
        }
        return $guardado;
    }
}
