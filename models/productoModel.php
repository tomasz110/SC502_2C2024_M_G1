<?php
require_once '../config/Conexion.php';

class productoModel extends Conexion
{
    /*=============================================
	=            Atributos de la Clase            =
	=============================================*/
        protected static $cnx;
		private $idProducto = null;
		private $nombre = null;
		private $descripcion = null;
		private $precio = null;
        private $imagen = null;
		private $categoria = null;
		private $estado = null;
		private $material = null;
	/*=====  End of Atributos de la Clase  ======*/

    /*=============================================
	=            Contructores de la Clase         =
	=============================================*/
        public function __construct(){}
    /*=====  End of Contructores de la Clase  ======*/

    /*=============================================
	=            Encapsuladores de la Clase       =
	=============================================*/
        public function getIdProducto()
        {
            return $this->idProducto;
        }
        public function setIdProducto($idProducto)
        {
            $this->idProducto = $idProducto;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }
        public function getPrecio()
        {
            return $this->precio;
        }
        public function setPrecio($precio)
        {
            $this->precio = $precio;
        }
        public function getImagen()
        {
            return $this->imagen;
        }
        public function setImagen($imagen)
        {
            $this->imagen = $imagen;
        }
        public function getCategoria()
        {
            return $this->categoria;
        }
        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }
        public function getEstado()
        {
            return $this->estado;
        }
        public function setEstado($estado)
        {
            $this->estado = $estado;
        }
        public function getMaterial()
        {
            return $this->material;
        }
        public function setMaterial($material)
        {
            $this->material = $material;
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
            $query = "SELECT * FROM Producto";
            $arr = array();
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $producto = new productoModel();
                    $producto->setIdProducto($encontrado['idProducto']);
                    $producto->setNombre($encontrado['nombre']);
                    $producto->setDescripcion($encontrado['descripcion']);
                    $producto->setPrecio($encontrado['precio']);
                    $producto->setImagen($encontrado['imagen']);
                    $producto->setCategoria($encontrado['categoria']);
                    $producto->setEstado($encontrado['estado']);
                    $producto->setMaterial($encontrado['material']);
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
            $query = "INSERT INTO `Producto`(`nombre`, `descripcion`, `precio`, `imagen`, `categoria`, `estado`, `material`) VALUES (:nombre, :descripcion, :precio, :imagen, :categoria, :estado, :material)";
            try {
                self::getConexion();
                $nombre = strtoupper($this->getNombre());
                $descripcion = $this->getDescripcion();
                $precio = $this->getPrecio();
                $imagen = $this->getImagen();
                $categoria = $this->getCategoria();
                $estado = $this->getEstado();
                $material = $this->getMaterial();

                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
                $resultado->bindParam(":precio", $precio, PDO::PARAM_INT);
                $resultado->bindParam(":imagen", $imagen, PDO::PARAM_STR);
                $resultado->bindParam(":categoria", $categoria, PDO::PARAM_STR);
                $resultado->bindParam(":estado", $estado, PDO::PARAM_INT);
                $resultado->bindParam(":material", $material, PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return json_encode($error);
            }
        }

        public function actualizarProducto(){
            $query = "UPDATE Producto SET nombre=:nombre, descripcion=:descripcion, precio=:precio, imagen=:imagen, categoria=:categoria, estado=:estado, material=:material WHERE idProducto=:idProducto";
            try {
                self::getConexion();
                $idProducto = $this->getIdProducto();
                $nombre = $this->getNombre();
                $descripcion = $this->getDescripcion();
                $precio = $this->getPrecio();
                $imagen = $this->getImagen();
                $categoria = $this->getCategoria();
                $estado = $this->getEstado();
                $material = $this->getMaterial();

                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":idProducto", $idProducto, PDO::PARAM_INT);
                $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                $resultado->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
                $resultado->bindParam(":precio", $precio, PDO::PARAM_INT);
                $resultado->bindParam(":imagen", $imagen, PDO::PARAM_STR);
                $resultado->bindParam(":categoria", $categoria, PDO::PARAM_STR);
                $resultado->bindParam(":estado", $estado, PDO::PARAM_INT);
                $resultado->bindParam(":material", $material, PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                return $resultado->rowCount();
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return $error;
            }
        }

        public function llenarCampos($idProducto){
            $query = "SELECT * FROM Producto where idProducto=:idProducto";
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(":idProducto", $idProducto, PDO::PARAM_INT);
                $resultado->execute();
                self::desconectar();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $this->setIdProducto($encontrado['idProducto']);
                    $this->setNombre($encontrado['nombre']);
                    $this->setDescripcion($encontrado['descripcion']);
                    $this->setPrecio($encontrado['precio']);
                    $this->setImagen($encontrado['imagen']);
                    $this->setCategoria($encontrado['categoria']);
                    $this->setEstado($encontrado['estado']);
                    $this->setMaterial($encontrado['material']);
                }
            } catch (PDOException $Exception) {
                self::desconectar();
                $error = "Error ".$Exception->getCode().": ".$Exception->getMessage();
                return json_encode($error);
            }
        }
        public function verificarExistenciaDb() {
            $query = "SELECT idProducto, nombre, descripcion, precio, imagen, categoria, estado, material 
                      FROM Producto 
                      WHERE nombre = :nombre AND estado = 1";
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);		
                $nombre = $this->getNombre();		
                $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                $resultado->execute();
                self::desconectar();
                $encontrado = false;
                $arr = array();
                foreach ($resultado->fetchAll() as $reg) {
                    $arr['idProducto'] = $reg['idProducto'];
                    $arr['nombre'] = $reg['nombre'];
                    $arr['descripcion'] = $reg['descripcion'];
                    $arr['precio'] = $reg['precio'];
                    $arr['imagen'] = $reg['imagen'];
                    $arr['categoria'] = $reg['categoria'];
                    $arr['estado'] = $reg['estado'];
                    $arr['material'] = $reg['material'];
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
