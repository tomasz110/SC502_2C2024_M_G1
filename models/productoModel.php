<?php
require_once '../config/Conexion.php';

class productoModel extends Conexion
{
 
    protected static $cnx;
    private $id_producto_pk = null;
    private $id_estado_fk = null;
    private $nombre_producto = null;
    private $descripcion_producto = null;
    private $precio_producto = null;
    private $id_emprendedor_fk  = null;
    private $existencias_producto = null;
    private $ruta_imagen_producto = null;



 
    public function getIdProducto()
    {
        return $this->id_producto_pk;
    }

    public function setIdProducto($id_producto_pk)
    {
        $this->id_producto_pk = $id_producto_pk;
    }

    public function getIdEmprendedor()
    {
        return $this->id_emprendedor_fk;
    }

    public function setIdEmprendedor($id_emprendedor_fk)
    {
        $this->id_emprendedor_fk = $id_emprendedor_fk;
    }

    public function getIdEstado()
    {
        return $this->id_estado_fk;
    }

    public function setIdEstado($id_estado_fk)
    {
        $this->id_estado_fk = $id_estado_fk;
    }

    public function getNombreProducto()
    {
        return $this->nombre_producto;
    }

    public function setNombreProducto($nombre_producto)
    {
        $this->nombre_producto = $nombre_producto;
    }

    public function getDescripcionProducto()
    {
        return $this->descripcion_producto;
    }

    public function setDescripcionProducto($descripcion_producto)
    {
        $this->descripcion_producto = $descripcion_producto;
    }

    public function getPrecioProducto()
    {
        return $this->precio_producto;
    }

    public function setPrecioProducto($precio_producto)
    {
        $this->precio_producto = $precio_producto;
    }

    public function getExistenciasProducto()
    {
        return $this->existencias_producto;
    }

    public function setExistenciasProducto($existencias_producto)
    {
        $this->existencias_producto = $existencias_producto;
    }

    public function getRutaImagenProducto()
    {
        return $this->ruta_imagen_producto;
    }

    public function setRutaImagenProducto($ruta_imagen_producto)
    {
        $this->ruta_imagen_producto = $ruta_imagen_producto;
    }


   


    public static function getConexion(){
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }

    public function listarTodosProductos(){
        $query = "SELECT * FROM FIDE_PRODUCTOS_TB";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            $productos = $resultado->fetchAll();
            foreach ($productos as $encontrado) {
                $producto = new productoModel();
                $producto->setIdProducto($encontrado['id_producto_pk']);
                $producto->setNombreProducto($encontrado['nombre_producto']);
                $producto->setDescripcionProducto($encontrado['descripcion_producto']);
                $producto->setPrecioProducto($encontrado['precio_producto']);
                $producto->setExistenciasProducto($encontrado['existencias_producto']);
                $producto->setRutaImagenProducto($encontrado['ruta_imagen_producto']);
                $producto->setIdEmprendedor($encontrado['id_emprendedor_fk']);
                $producto->setIdEstado($encontrado['id_estado_fk']);
                $arr[] = $producto;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }

    public function guardarProducto() {
        $query = "INSERT INTO FIDE_PRODUCTOS_TB (nombre_producto, descripcion_producto, precio_producto, existencias_producto, ruta_imagen_producto, id_emprendedor_fk, id_estado_fk) VALUES (:nombre_producto, :descripcion_producto, :precio_producto, :existencias_producto, :ruta_imagen_producto, :id_emprendedor_fk, :id_estado_fk)";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
           
            $nombre_producto = $this->getNombreProducto();
            $descripcion_producto = $this->getDescripcionProducto();
            $precio_producto = $this->getPrecioProducto();
            $existencias_producto = $this->getExistenciasProducto();
            $ruta_imagen_producto = $this->getRutaImagenProducto();
            $id_emprendedor_fk = $this->getIdEmprendedor();
            $id_estado_fk = $this->getIdEstado();
            
            
            $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
            $resultado->bindParam(":precio_producto", $precio_producto, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_producto", $existencias_producto, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_producto", $ruta_imagen_producto, PDO::PARAM_STR);
            $resultado->bindParam(":id_emprendedor_fk", $id_emprendedor_fk, PDO::PARAM_INT);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            
            echo json_encode(array("error" => $Exception->getMessage()));
        }
    }

    public function listarProductosActivos() {
        $query = "SELECT * FROM FIDE_PRODUCTOS_TB WHERE id_estado_fk = 1"; 
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            $productos = $resultado->fetchAll();
            foreach ($productos as $encontrado) {
                $producto = new productoModel();
                $producto->setIdProducto($encontrado['id_producto_pk']);
                $producto->setNombreProducto($encontrado['nombre_producto']);
                $producto->setDescripcionProducto($encontrado['descripcion_producto']);
                $producto->setPrecioProducto($encontrado['precio_producto']);
                $producto->setExistenciasProducto($encontrado['existencias_producto']);
                $producto->setRutaImagenProducto($encontrado['ruta_imagen_producto']);
                $producto->setIdEmprendedor($encontrado['id_emprendedor_fk']);
                $producto->setIdEstado($encontrado['id_estado_fk']);
                $arr[] = $producto;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
    
    public function actualizarProducto() {
        $query = "UPDATE FIDE_PRODUCTOS_TB 
                  SET nombre_producto=:nombre_producto, 
                      descripcion_producto=:descripcion_producto, 
                      precio_producto=:precio_producto, 
                      existencias_producto=:existencias_producto, 
                      ruta_imagen_producto=:ruta_imagen_producto,
                      id_emprendedor_fk=:id_emprendedor_fk,
                      id_estado_fk=:id_estado_fk 
                  WHERE id_producto_pk=:id_producto_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
            
            $id_producto_pk = $this->getIdProducto();
            $nombre_producto = $this->getNombreProducto();
            $descripcion_producto = $this->getDescripcionProducto();
            $precio_producto = $this->getPrecioProducto();
            $existencias_producto = $this->getExistenciasProducto();
            $ruta_imagen_producto = $this->getRutaImagenProducto();
            $id_emprendedor_fk = $this->getIdEmprendedor();
            $id_estado_fk = $this->getIdEstado();
    
          
            $resultado->bindParam(":id_producto_pk", $id_producto_pk, PDO::PARAM_INT);
            $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
            $resultado->bindParam(":precio_producto", $precio_producto, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_producto", $existencias_producto, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_producto", $ruta_imagen_producto, PDO::PARAM_STR);
            $resultado->bindParam(":id_emprendedor_fk", $id_emprendedor_fk, PDO::PARAM_INT);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
            return true; 
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    

    

    public function verificarExistenciaDb() {
        $query = "SELECT * FROM fide_productos_tb WHERE nombre_producto = :nombre_producto";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
           
            $nombre_producto = $this->getNombreProducto();
    
            
            $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
    
            $resultado->execute();
            self::desconectar();
    
          
            return $resultado->rowCount() > 0;
        } catch (PDOException $Exception) {
            self::desconectar();
            return false; 
        }
    }
    
    public function activar() {
        $id_producto_pk = $this->getIdProducto();
        $query = "UPDATE FIDE_PRODUCTOS_TB SET id_estado_fk = 1 WHERE id_producto_pk = :id_producto_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_producto_pk", $id_producto_pk, PDO::PARAM_INT);
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
        $id_producto_pk = $this->getIdProducto();
        $query = "UPDATE FIDE_PRODUCTOS_TB SET id_estado_fk = 2 WHERE id_producto_pk = :id_producto_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_producto_pk", $id_producto_pk, PDO::PARAM_INT);
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