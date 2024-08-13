<?php
require_once '../config/Conexion.php';

class materialModel extends Conexion
{
    /*=============================================
    =            Atributos de la Clase            =
    =============================================*/
    protected static $cnx;
    private $id_materiales_pk = null;
    private $id_estado_fk = null;
    private $nombre_material = null;
    private $descripcion_material = null;
    private $precio_material = null;
    private $existencias_material = null;
    private $ruta_imagen_materia = null;

    /*=====  End of Atributos de la Clase  ======*/

    /*=============================================
    =            Encapsuladores de la Clase       =
    =============================================*/
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

    public function getRutaImagenMateria()
    {
        return $this->ruta_imagen_materia;
    }

    public function setRutaImagenMateria($ruta_imagen_materia)
    {
        $this->ruta_imagen_materia = $ruta_imagen_materia;
    }
    /*=====  End of Encapsuladores de la Clase  ======*/

    /*=============================================
    =            Metodos de la Clase              =
    =============================================*/

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
                $material->setRutaImagenMateria($encontrado['ruta_imagen_materia']);
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
        $query = "INSERT INTO FIDE_MATERIALES_TB (nombre_material, descripcion_material, precio_material, existencias_material, ruta_imagen_materia, id_estado_fk) VALUES (:nombre_material, :descripcion_material, :precio_material, :existencias_material, :ruta_imagen_materia, :id_estado_fk)";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            // Asignar valores a variables
            $nombre_material = $this->getNombreMaterial();
            $descripcion_material = $this->getDescripcionMaterial();
            $precio_material = $this->getPrecioMaterial();
            $existencias_material = $this->getExistenciasMaterial();
            $ruta_imagen_materia = $this->getRutaImagenMateria();
            $id_estado_fk = $this->getIdEstado();
            
            // Usar bindParam con variables
            $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_material", $descripcion_material, PDO::PARAM_STR);
            $resultado->bindParam(":precio_material", $precio_material, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_material", $existencias_material, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_materia", $ruta_imagen_materia, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            // Devuelve un mensaje de error detallado
            echo json_encode(array("error" => $Exception->getMessage()));
        }
    }

    public function actualizarMaterial() {
        $query = "UPDATE FIDE_MATERIALES_TB 
                  SET nombre_material=:nombre_material, 
                      descripcion_material=:descripcion_material, 
                      precio_material=:precio_material, 
                      existencias_material=:existencias_material, 
                      ruta_imagen_materia=:ruta_imagen_materia, 
                      id_estado_fk=:id_estado_fk 
                  WHERE id_materiales_pk=:id_materiales_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
            // Asignar valores a variables
            $id_materiales_pk = $this->getIdMateriales();
            $nombre_material = $this->getNombreMaterial();
            $descripcion_material = $this->getDescripcionMaterial();
            $precio_material = $this->getPrecioMaterial();
            $existencias_material = $this->getExistenciasMaterial();
            $ruta_imagen_materia = $this->getRutaImagenMateria();
            $id_estado_fk = $this->getIdEstado();
    
            // Usar bindParam con variables
            $resultado->bindParam(":id_materiales_pk", $id_materiales_pk, PDO::PARAM_INT);
            $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_material", $descripcion_material, PDO::PARAM_STR);
            $resultado->bindParam(":precio_material", $precio_material, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_material", $existencias_material, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_materia", $ruta_imagen_materia, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
            return true; // Añadido para indicar éxito
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
            
            // Obtener el nombre del material desde la instancia de la clase
            $nombre_material = $this->getNombreMaterial();
            
            // Vincular el parámetro
            $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
            
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
            return $resultado->rowCount(); // Devuelve el número de filas afectadas
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
            return $resultado->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
    /*=====  End of Metodos de la Clase  ======*/  
}
?>