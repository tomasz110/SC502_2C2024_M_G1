<?php
require_once '../config/Conexion.php';

class campanaModel extends Conexion{


    protected static $cnx;
    private $id_campana_pk  = null;
    private $id_estado_fk = null;
    private $nombre_campana = null;
    private $descripcion_campana = null;
    private $fecha_campana = null;
    private $ruta_imagen_campana = null;
    private $ruta_mapa_campana = null;
    

    public function getIdCampanaPk() {
        return $this->id_campana_pk;
    }

    public function getIdEstadoFk() {
        return $this->id_estado_fk;
    }

    public function getNombreCampana() {
        return $this->nombre_campana;
    }

    public function getDescripcionCampana() {
        return $this->descripcion_campana;
    }

    public function getFechaCampana() {
        return $this->fecha_campana;
    }

    public function getRutaImagenCampana() {
        return $this->ruta_imagen_campana;
    }

    public function getRutaMapaCampana() {
        return $this->ruta_mapa_campana;
    }


    public function setIdCampanaPk($id_campana_pk) {
        $this->id_campana_pk = $id_campana_pk;
    }

    public function setIdEstadoFk($id_estado_fk) {
        $this->id_estado_fk = $id_estado_fk;
    }

    public function setNombreCampana($nombre_campana) {
        $this->nombre_campana = $nombre_campana;
    }

    public function setDescripcionCampana($descripcion_campana) {
        $this->descripcion_campana = $descripcion_campana;
    }

    public function setFechaCampana($fecha_campana) {
        $this->fecha_campana = $fecha_campana;
    }

    public function setRutaImagenCampana($ruta_imagen_campana) {
        $this->ruta_imagen_campana = $ruta_imagen_campana;
    }

    public function setRutaMapaCampana($ruta_mapa_campana) {
        $this->ruta_mapa_campana = $ruta_mapa_campana;
    }



    public static function getConexion(){
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }

    public function listarCampanas(){
        $query = "SELECT * FROM fide_campanas_tb";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            $campanas = $resultado->fetchAll();
            foreach ($campanas as $encontrado) {
                $campana = new campanaModel();
                $campana->setIdCampanaPk($encontrado['id_campana_pk']);
                $campana->setNombreCampana($encontrado['nombre_campana']);
                $campana->setDescripcionCampana($encontrado['descripcion_campana']);
                $campana->setFechaCampana($encontrado['fecha_campana']);
                $campana->setRutaImagenCampana($encontrado['ruta_imagen_campana']);
                $campana->setRutaMapaCampana($encontrado['ruta_mapa_campana']);
                $campana->setIdEstadoFk($encontrado['id_estado_fk']);
                $arr[] = $campana;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
    

    public function guardarEmprendedor() {
        $query = "INSERT INTO fide_campanas_tb (nombre_campana, descripcion_campana, fecha_campana, ruta_imagen_campana, ruta_mapa_campana, id_estado_fk) 
        VALUES (:nombre_campana, :descripcion_campana, :fecha_campana, :ruta_imagen_campana, :ruta_mapa_campana, :id_estado_fk)";
      try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            // Asignar valores a variables
            $nombre_campana = $this->getNombreCampana();
            $descripcion_campana = $this->getDescripcionCampana();
            $fecha_campana = $this->getFechaCampana();
            $ruta_imagen_campana = $this->getRutaImagenCampana();
            $ruta_mapa_campana = $this->getRutaMapaCampana();
            $id_estado_fk = $this->getIdEstadoFk();
            
            // Usar bindParam con variables
            $resultado->bindParam(":nombre_campana", $nombre_campana, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_campana", $descripcion_campana, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_campana", $fecha_campana, PDO::PARAM_STR);
            $resultado->bindParam(":ruta_imagen_campana", $ruta_imagen_campana, PDO::PARAM_STR);
            $resultado->bindParam(":ruta_mapa_campana", $ruta_mapa_campana, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            // Devuelve un mensaje de error detallado
            echo json_encode(array("error" => $Exception->getMessage()));
        }
    }

    public function actualizarCampana() {
        $query = "UPDATE fide_campanas_tb 
                  SET nombre_campana=:nombre_campana, 
                      descripcion_campana=:descripcion_campana, 
                      fecha_campana=:fecha_campana,  
                      ruta_imagen_campana=:ruta_imagen_campana, 
                      ruta_mapa_campana=:ruta_mapa_campana, 
                      id_estado_fk=:id_estado_fk 
                  WHERE id_campana_pk=:id_campana_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
            // Asignar valores a variables
            $id_campana_pk = $this->getIdCampanaPk();
            $nombre_campana = $this->getNombreCampana();
            $descripcion_campana = $this->getDescripcionCampana();
            $fecha_campana = $this->getFechaCampana();
            $ruta_imagen_campana = $this->getRutaImagenCampana();
            $ruta_mapa_campana = $this->getRutaMapaCampana();
            $id_estado_fk = $this->getIdEstadoFk();
    
            // Usar bindParam con variables
            $resultado->bindParam(":id_campana_pk", $id_campana_pk, PDO::PARAM_INT);
            $resultado->bindParam(":nombre_campana", $nombre_campana, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_campana", $descripcion_campana, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_campana", $fecha_campana, PDO::PARAM_STR);
            $resultado->bindParam(":ruta_imagen_campana", $ruta_imagen_campana, PDO::PARAM_STR);
            $resultado->bindParam(":ruta_mapa_campana", $ruta_mapa_campana, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
            return true; // Añadido para indicar éxito
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }

    public function verificarExistenciaDb() {
        $query = "SELECT * FROM fide_campanas_tb WHERE nombre_campana = :nombre_campana";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            // Obtener el nombre de la campaña desde la instancia de la clase
            $nombre_campana = $this->getNombreCampana();
            
            // Vincular el parámetro
            $resultado->bindParam(":nombre_campana", $nombre_campana, PDO::PARAM_STR);
            
            $resultado->execute();
            self::desconectar();
            
            $encontrado = false;
            // Verificar si se encontraron registros
            if ($resultado->rowCount() > 0) {
                $encontrado = true;
            }
            
            return $encontrado; // Devuelve true si existe, false si no
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
            return $error; // Retorna el mensaje de error en caso de excepción
        }
    }
    

    public function activar() {
        $id_campana_pk = $this->getIdCampanaPk();
        $query = "UPDATE fide_campanas_tb SET id_estado_fk = 1 WHERE id_campana_pk = :id_campana_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_campana_pk", $id_campana_pk, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
    public function desactivar() {
        $id_campana_pk = $this->getIdCampanaPk();
        $query = "UPDATE fide_campanas_tb SET id_estado_fk = 2 WHERE id_campana_pk = :id_campana_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_campana_pk", $id_campana_pk, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
}
?>