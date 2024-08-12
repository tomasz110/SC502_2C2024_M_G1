<?php
require_once '../config/Conexion.php';

class materialModel extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
        protected static $cnx;
		private $id_producto_pk = null;
		private $id_emprendedor_fk = null;
		private $id_estado_fk = null;
		private $nombre_producto = null;
		private $descripcion_producto = null;
        private $precio_producto = null;
		private $existencias_producto = null;
		private $ruta_imagen_producto = null;
	/*=====  End of Atributos de la Clase  ======*/

    /*=============================================
	=            Contructores de la Clase         =
	=============================================*/
        public function __construct(){}
    /*=====  End of Contructores de la Clase  ======*/

    /*=============================================
	=            Encapsuladores de la Clase       =
	=============================================*/
    public function getIdProductoPk()
    {
        return $this->id_producto_pk;
    }

    public function setIdProductoPk($id_producto_pk)
    {
        $this->id_producto_pk = $id_producto_pk;
    }

    public function getIdEmprendedorFk()
    {
        return $this->id_emprendedor_fk;
    }

    public function setIdEmprendedorFk($id_emprendedor_fk)
    {
        $this->id_emprendedor_fk = $id_emprendedor_fk;
    }

    public function getIdEstadoFk()
    {
        return $this->id_estado_fk;
    }

    public function setIdEstadoFk($id_estado_fk)
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
	=            Métodos de la Clase              =
	=============================================*/
        public static function getConexion(){
            self::$cnx = Conexion::conectar();
        }

        public static function desconectar(){
            self::$cnx = null;
        }

        public function listarTodosDb(){
            $query = "SELECT * FROM fide_productos_tb";
            $arr = array();
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $producto = new materialModel();
                    $producto->setIdProductoPk($encontrado['id_producto_pk']);
                    $producto->setIdEmprendedorFk($encontrado['id_emprendedor_fk']);
                    $producto->setIdEstadoFk($encontrado['id_estado_fk']);
                    $producto->setNombreProducto($encontrado['nombre_producto']);
                    $producto->setDescripcionProducto($encontrado['descripcion_producto']);
                    $producto->setPrecioProducto($encontrado['precio_producto']);
                    $producto->setExistenciasProducto($encontrado['existencias_producto']);
                    $producto->setRutaImagenProducto($encontrado['ruta_imagen_producto']);
                    $arr[] = $producto;
                }
                return $arr;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return json_encode($error);
            }
        }

        public function guardarEnDb(){
            $query = "INSERT INTO fide_productos_tb(id_emprendedor_fk, id_estado_fk, nombre_producto, descripcion_producto, precio_producto, existencias_producto, ruta_imagen_producto)
             VALUES (:id_emprendedor_fk, :id_estado_fk, :nombre_producto, :descripcion_producto, :precio_producto, :existencias_producto, :ruta_imagen_producto)";
            try {
                self::getConexion();
                $id_emprendedor_fk = $this->getIdEmprendedorFk();
                $id_estado_fk = $this->getIdEstadoFk();
                $nombre_producto = $this->getNombreProducto();
                $descripcion_producto = $this->getDescripcionProducto();
                $precio_producto = $this->getPrecioProducto();
                $existencias_producto = $this->getExistenciasProducto();
                $ruta_imagen_producto = $this->getRutaImagenProducto();

                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":id_emprendedor_fk", $id_emprendedor_fk, PDO::PARAM_INT);
                $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
                $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
                $resultado->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
                $resultado->bindParam(":precio_producto", $precio_producto, PDO::PARAM_STR);
                $resultado->bindParam(":existencias_producto", $existencias_producto, PDO::PARAM_INT);
                $resultado->bindParam(":ruta_imagen_producto", $ruta_imagen_producto, PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return json_encode($error);
            }
        }

        public function actualizarProducto(){
            $query = "UPDATE fide_productos_tb SET id_emprendedor_fk=:id_emprendedor_fk, id_estado_fk=:id_estado_fk, nombre_producto=:nombre_producto, descripcion_producto=:descripcion_producto, precio_producto=:precio_producto, existencias_producto=:existencias_producto, ruta_imagen_producto=:ruta_imagen_producto
            WHERE id_producto_pk=:id_producto_pk";
            try {
                self::getConexion();
                $id_producto_pk = $this->getIdMaterialesPk();
                $id_emprendedor_fk = $this->getIdEmprendedorFk();
                $id_estado_fk = $this->getIdEstadoFk();
                $nombre_producto = $this->getNombreProducto();
                $descripcion_producto = $this->getDescripcionProducto();
                $precio_producto = $this->getPrecioProducto();
                $existencias_producto = $this->getExistenciasProducto();
                $ruta_imagen_producto = $this->getRutaImagenProducto();
                

                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":id_producto_pk", $id_producto_pk, PDO::PARAM_INT);
                $resultado->bindParam(":id_emprendedor_fk", $id_emprendedor_fk, PDO::PARAM_INT);
                $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
                $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
                $resultado->bindParam(":descripcion_producto", $descripcion_producto, PDO::PARAM_STR);
                $resultado->bindParam(":precio_producto", $precio_producto, PDO::PARAM_STR);
                $resultado->bindParam(":existencias_producto", $existencias_producto, PDO::PARAM_INT);
                $resultado->bindParam(":ruta_imagen_producto", $ruta_imagen_producto, PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                return $resultado->rowCount();
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
        }

        public function llenarCampos($id_producto_pk){
            $query = "SELECT * FROM fide_productos_tb WHERE id_producto_pk=:id_producto_pk";
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":id_producto_pk", $id_producto_pk, PDO::PARAM_INT);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $this->setIdProductoPk($encontrado['id_producto_pk']);
                    $this->setIdEmprendedorFk($encontrado['id_emprendedor_fk']);
                    $this->setIdEstadoFk($encontrado['id_estado_fk']);
                    $this->setNombreProducto($encontrado['nombre_producto']);
                    $this->setDescripcionProducto($encontrado['descripcion_producto']);
                    $this->setPrecioProducto($encontrado['precio_producto']);
                    $this->setExistenciasProducto($encontrado['existencias_producto']);
                    $this->setRutaImagenProducto($encontrado['ruta_imagen_producto']);
                }
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return json_encode($error);
            }
        }

        public function verificarExistenciaDb() {
            $query = "SELECT id_producto_pk, id_emprendedor_fk, id_estado_fk, nombre_producto, descripcion_producto, precio_producto, existencias_producto, ruta_imagen_producto 
                      FROM fide_productos_tb 
                      WHERE nombre_producto = :nombre_producto AND id_estado_fk = 1";
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);		
                $nombre_producto = $this->getNombreProducto();		
                $resultado->bindParam(":nombre_producto", $nombre_producto, PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                $encontrado = false;
                $arr = array();
                foreach ($resultado->fetchAll() as $reg) {
                    $arr['id_producto_pk'] = $reg['id_producto_pk'];
                    $arr['id_emprendedor_fk'] = $reg['id_emprendedor_fk'];
                    $arr['id_estado_fk'] = $reg['id_estado_fk'];
                    $arr['nombre_producto'] = $reg['nombre_producto'];
                    $arr['descripcion_producto'] = $reg['descripcion_producto'];
                    $arr['precio_producto'] = $reg['precio_producto'];
                    $arr['existencias_producto'] = $reg['existencias_producto'];
                    $arr['ruta_imagen_producto'] = $reg['ruta_imagen_producto'];
                    $encontrado = true;
                }
                return $encontrado ? $arr : null;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
        }
    /*=====  End of Métodos de la Clase  ======*/
}
?>
