<?php
require_once '../config/Conexion.php';

class productoModel extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
        protected static $cnx;
		private $id_materiales_pk = null;
		private $id_estado_fk = null;
		private $nombre_material = null;
		private $descripcion_material = null;
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
    public function getIdMaterialesPk()
    {
        return $this->id_materiales_pk;
    }

    public function setIdMaterialesPk($id_materiales_pk)
    {
        $this->id_materiales_pk = $id_materiales_pk;
    }

    public function getIdEstadoFk()
    {
        return $this->id_estado_fk;
    }

    public function setIdEstadoFk($id_estado_fk)
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
            $query = "SELECT * FROM fide_materiales_tb";
            $arr = array();
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $material = new materialModel();
                    $material->setIdMaterialesPk($encontrado['id_materiales_pk']);
                    $material->setIdEstadoFk($encontrado['id_estado_fk']);
                    $material->setNombreMaterial($encontrado['nombre_material']);
                    $material->setDescripcionMaterial($encontrado['descripcion_material']);
                    $material->setPrecioProducto($encontrado['precio_producto']);
                    $material->setExistenciasProducto($encontrado['existencias_producto']);
                    $material->setRutaImagenProducto($encontrado['ruta_imagen_producto']);
                    $arr[] = $material;
                }
                return $arr;
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return json_encode($error);
            }
        }

        public function guardarEnDb(){
            $query = "INSERT INTO `fide_materiales_tb`(`id_estado_fk`, `nombre_material`, `descripcion_material`, `precio_producto`, `existencias_producto`, `ruta_imagen_producto`)
             VALUES (:id_estado_fk, :nombre_material, :descripcion_material, :precio_producto, :existencias_producto, :ruta_imagen_producto)";
            try {
                self::getConexion();
                $id_estado_fk = strtoupper($this->getIdEstadoFk());
                $nombre_material = $this->getNombreMaterial();
                $descripcion_material = $this->getDescripcionMaterial();
                $precio_producto = $this->getPrecioProducto();
                $existencias_producto = $this->getExistenciasProducto();
                $ruta_imagen_producto = $this->getRutaImagenProducto();

                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
                $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
                $resultado->bindParam(":descripcion_material", $descripcion_material, PDO::PARAM_STR);
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

        public function actualizarMaterial(){
            $query = "UPDATE fide_materiales_tb SET id_estado_fk=:id_estado_fk, nombre_material=:nombre_material, descripcion_material=:descripcion_material, precio_producto=:precio_producto, existencias_producto=:existencias_producto, ruta_imagen_producto=:ruta_imagen_producto
            WHERE id_materiales_pk=:id_materiales_pk";
            try {
                self::getConexion();
                $id_materiales_pk = $this->getIdMaterialesPk();
                $id_estado_fk = $this->getIdEstadoFk();
                $nombre_material = $this->getNombreMaterial();
                $descripcion_material = $this->getDescripcionMaterial();
                $precio_producto = $this->getPrecioProducto();
                $existencias_producto = $this->getExistenciasProducto();
                $ruta_imagen_producto = $this->getRutaImagenProducto();
                

                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":id_materiales_pk", $id_materiales_pk, PDO::PARAM_INT);
                $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
                $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
                $resultado->bindParam(":descripcion_material", $descripcion_material, PDO::PARAM_STR);
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

        public function llenarCampos($id_materiales_pk){
            $query = "SELECT * FROM fide_materiales_tb where id_materiales_pk=:id_materiales_pk";
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":id_materiales_pk", $id_materiales_pk, PDO::PARAM_INT);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $this->setIdMaterialesPk($encontrado['id_materiales_pk']);
                    $this->setIdEstadoFk($encontrado['id_estado_fk']);
                    $this->setNombreMaterial($encontrado['nombre_material']);
                    $this->setDescripcionMaterial($encontrado['descripcion_material']);
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
            $query = "SELECT id_materiales_pk, id_estado_fk, nombre_material, descripcion_material, precio_producto, existencias_producto, ruta_imagen_producto 
                      FROM fide_materiales_tb 
                      WHERE nombre_material = :nombre_material AND id_estado_fk = 1";
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);		
                $nombre_material = $this->getNombreMaterial();		
                $resultado->bindParam(":nombre_material", $nombre_material, PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                $encontrado = false;
                $arr = array();
                foreach ($resultado->fetchAll() as $reg) {
                    $arr['id_materiales_pk'] = $reg['id_materiales_pk'];
                    $arr['id_estado_fk'] = $reg['id_estado_fk'];
                    $arr['nombre_material'] = $reg['nombre_material'];
                    $arr['descripcion_material'] = $reg['descripcion_material'];
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
