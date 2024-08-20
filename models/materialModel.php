<?php
require_once '../config/Conexion.php';

class materialModel extends Conexion
{

    protected static $cnx;
    private $id_materiales_pk = null;
    private $id_estado_fk = null;
    private $nombre_material = null;
    private $descripcion_material = null;
    private $precio_material = null;
    private $existencias_material = null;
    private $ruta_imagen_material = null;



   
    public function getIdMateriales()
    {
        return $this->id_materiales_pk;
    }

    public function setIdMateriales($id_materiales_pk)
    {
        $this->id_materiales_pk = $id_materiales_pk;
    }

    public function getIdEstado()
    {
        return $this->id_estado_fk;
    }

    public function setIdEstado($id_estado_fk)
    {
        $this->id_estado_fk = $id_estado_fk;
    }

    public function getNombreMaterial()
    {
        return $this->nombre_material;
    }

    public function setNombreMaterial($nombre_material)
    {
        $this->nombre_material = $nombre_material;
    }

    public function getDescripcionMaterial()
    {
        return $this->descripcion_material;
    }

    public function setDescripcionMaterial($descripcion_material)
    {
        $this->descripcion_material = $descripcion_material;
    }

    public function getPrecioMaterial()
    {
        return $this->precio_material;
    }

    public function setPrecioMaterial($precio_material)
    {
        $this->precio_material = $precio_material;
    }

    public function getExistenciasMaterial()
    {
        return $this->existencias_material;
    }

    public function setExistenciasMaterial($existencias_material)
    {
        $this->existencias_material = $existencias_material;
    }

    public function getRutaImagenMaterial()
    {
        return $this->ruta_imagen_material;
    }

    public function setRutaImagenMaterial($ruta_imagen_material)
    {
        $this->ruta_imagen_material = $ruta_imagen_material;
    }


  

    public static function getConexion(){
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }

    public function listarTodosMateriales(){
        $query = "SELECT * FROM FIDE_MATERIALES_TB";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            $materiales = $resultado->fetchAll();
            foreach ($materiales as $encontrado) {
                $material = new materialModel();
                $material->setIdMateriales($encontrado['id_materiales_pk']);
                $material->setNombreMaterial($encontrado['nombre_material']);
                $material->setDescripcionMaterial($encontrado['descripcion_material']);
                $material->setPrecioMaterial($encontrado['precio_material']);
                $material->setExistenciasMaterial($encontrado['existencias_material']);
                $material->setRutaImagenMaterial($encontrado['ruta_imagen_material']);
                $material->setIdEstado($encontrado['id_estado_fk']);
                $arr[] = $material;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    public function listarMaterialesActivos() {
        $query = "SELECT * FROM FIDE_MATERIALES_TB WHERE id_estado_fk = 1"; 
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            $materiales = $resultado->fetchAll();
            foreach ($materiales as $encontrado) {
                $material = new materialModel();
                $material->setIdMateriales($encontrado['id_materiales_pk']);
                $material->setNombreMaterial($encontrado['nombre_material']);
                $material->setDescripcionMaterial($encontrado['descripcion_material']);
                $material->setPrecioMaterial($encontrado['precio_material']);
                $material->setExistenciasMaterial($encontrado['existencias_material']);
                $material->setRutaImagenMaterial($encontrado['ruta_imagen_material']);
                $material->setIdEstado($encontrado['id_estado_fk']);
                $arr[] = $material; 
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    

    public function guardarMaterial() {
        $query = "INSERT INTO FIDE_MATERIALES_TB (nombre_material, descripcion_material, precio_material, existencias_material, ruta_imagen_material, id_estado_fk) VALUES (:nombre_material, :descripcion_material, :precio_material, :existencias_material, :ruta_imagen_material, :id_estado_fk)";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            
            $nombre_material = $this->getNombreMaterial();
            $descripcion_material = $this->getDescripcionMaterial();
            $precio_material = $this->getPrecioMaterial();
            $existencias_material = $this->getExistenciasMaterial();
            $ruta_imagen_material = $this->getRutaImagenMaterial();
            $id_estado_fk = $this->getIdEstado();
            
          
            $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_material", $descripcion_material, PDO::PARAM_STR);
            $resultado->bindParam(":precio_material", $precio_material, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_material", $existencias_material, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_material", $ruta_imagen_material, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            
            echo json_encode(array("error" => $Exception->getMessage()));
        }
    }

    public function actualizarMaterial() {
        $query = "UPDATE FIDE_MATERIALES_TB 
                  SET nombre_material=:nombre_material, 
                      descripcion_material=:descripcion_material, 
                      precio_material=:precio_material, 
                      existencias_material=:existencias_material, 
                      ruta_imagen_material=:ruta_imagen_material, 
                      id_estado_fk=:id_estado_fk 
                  WHERE id_materiales_pk=:id_materiales_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
           
            $id_materiales_pk = $this->getIdMateriales();
            $nombre_material = $this->getNombreMaterial();
            $descripcion_material = $this->getDescripcionMaterial();
            $precio_material = $this->getPrecioMaterial();
            $existencias_material = $this->getExistenciasMaterial();
            $ruta_imagen_material = $this->getRutaImagenMaterial();
            $id_estado_fk = $this->getIdEstado();
    
          
            $resultado->bindParam(":id_materiales_pk", $id_materiales_pk, PDO::PARAM_INT);
            $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_material", $descripcion_material, PDO::PARAM_STR);
            $resultado->bindParam(":precio_material", $precio_material, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_material", $existencias_material, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_material", $ruta_imagen_material, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
            return true; 
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }

    public function eliminarMaterial(){
        $query = "DELETE FROM FIDE_MATERIALES_TB WHERE id_materiales_pk=:id_materiales_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_materiales_pk", $this->getIdMateriales(), PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }

    public function verificarExistenciaDb() {
        $query = "SELECT * FROM FIDE_MATERIALES_TB WHERE nombre_material = :nombre_material";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
           
            $nombre_material = $this->getNombreMaterial();
            
            
            $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
            
            $resultado->execute();
            self::desconectar();
            
            $encontrado = false;
           
            return $resultado->rowCount() > 0; 
        } catch (PDOException $Exception) {
            self::desconectar();
            return false; // 
        }
    }
    

    public function activar() {
        $id_materiales_pk = $this->getIdMateriales();
        $query = "UPDATE FIDE_MATERIALES_TB SET id_estado_fk = 1 WHERE id_materiales_pk = :id_materiales_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_materiales_pk", $id_materiales_pk, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount(); 
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
    public function desactivar() {
        $id_materiales_pk = $this->getIdMateriales();
        $query = "UPDATE FIDE_MATERIALES_TB SET id_estado_fk = 2 WHERE id_materiales_pk = :id_materiales_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_materiales_pk", $id_materiales_pk, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount(); 
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
  
}
?>