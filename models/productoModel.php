<?php
require_once '../config/Conexion.php';

class productoModel extends Conexion
{
    /*=============================================
    =            Atributos de la Clase            =
    =============================================*/
    protected static $cnx;
    private $id_producto_pk = null;
    private $id_estado_fk = null;
    private $nombre_producto = null;
    private $descripcion_producto = null;
    private $precio_producto = null;
    private $existencias_producto = null;
    private $ruta_imagen_producto = null;

    /*=====  End of Atributos de la Clase  ======*/

    /*=============================================
    =            Encapsuladores de la Clase       =
    =============================================*/
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
        $query = "INSERT INTO FIDE_PRODUCTOS_TB (nombre_producto, descripcion_producto, precio_producto, existencias_producto, ruta_imagen_producto, id_estado_fk) VALUES (:nombre_producto, :descripcion_producto, :precio_producto, :existencias_producto, :ruta_imagen_producto, :id_estado_fk)";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            // Asignar valores a variables
            $nombre_producto = $this->getNombreProducto();
            $descripcion_producto = $this->getDescripcionProducto();
            $precio_producto = $this->getPrecioProducto();
            $existencias_producto = $this->getExistenciasProducto();
            $ruta_imagen_producto = $this->getRutaImagenProducto();
            $id_estado_fk = $this->getIdEstado();
            
            // Usar bindParam con variables
            $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
            $resultado->bindParam(":precio_producto", $precio_producto, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_producto", $existencias_producto, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_producto", $ruta_imagen_producto, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            // Devuelve un mensaje de error detallado
            echo json_encode(array("error" => $Exception->getMessage()));
        }
    }

    
    
    public function actualizarProducto() {
        $query = "UPDATE FIDE_PRODUCTOS_TB 
                  SET nombre_producto=:nombre_producto, 
                      descripcion_producto=:descripcion_producto, 
                      precio_producto=:precio_producto, 
                      existencias_producto=:existencias_producto, 
                      ruta_imagen_producto=:ruta_imagen_producto, 
                      id_estado_fk=:id_estado_fk 
                  WHERE id_producto_pk=:id_producto_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
            // Asignar valores a variables
            $id_producto_pk = $this->getIdProducto();
            $nombre_producto = $this->getNombreProducto();
            $descripcion_producto = $this->getDescripcionProducto();
            $precio_producto = $this->getPrecioProducto();
            $existencias_producto = $this->getExistenciasProducto();
            $ruta_imagen_producto = $this->getRutaImagenProducto();
            $id_estado_fk = $this->getIdEstado();
    
            // Usar bindParam con variables
            $resultado->bindParam(":id_producto_pk", $id_producto_pk, PDO::PARAM_INT);
            $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
            $resultado->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
            $resultado->bindParam(":precio_producto", $precio_producto, PDO::PARAM_STR);
            $resultado->bindParam(":existencias_producto", $existencias_producto, PDO::PARAM_INT);
            $resultado->bindParam(":ruta_imagen_producto", $ruta_imagen_producto, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
            return true; // Añadido para indicar éxito
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    

    public function eliminarProducto(){
        $query = "DELETE FROM FIDE_PRODUCTOS_TB WHERE id_producto_pk=:id_producto_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_producto_pk", $this->getIdProducto(), PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    public function verificarExistenciaDb() {
        $query = "SELECT * FROM FIDE_PRODUCTOS_TB WHERE id_producto_pk = :id_producto_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            // Obtener el ID del producto desde la instancia de la clase
            $id_producto = $this->getIdProducto();
            
            // Vincular el parámetro
            $resultado->bindParam(":id_producto_pk", $id_producto, PDO::PARAM_INT);
            
            $resultado->execute();
            self::desconectar();
            
            $encontrado = false;
            // Verificar si se encontraron registros
            foreach ($resultado->fetchAll() as $reg) {
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
            return $resultado->rowCount(); // Devuelve el número de filas afectadas
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
