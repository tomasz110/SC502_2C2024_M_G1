<?php
require_once '../config/Conexion.php';

class emprendedorModel extends Conexion
{

    protected static $cnx;
    private $id_emprendedor_pk = null;
    private $id_estado_fk = null;
    private $nombre_emprendedor = null;
    private $telefono = null;
    private $correo = null;
    

    public function getIdEmprendedor()
    {
        return $this->id_emprendedor_pk;
    }
    
    public function setIdEmprendedor($id_emprendedor_pk)
    {
        $this->id_emprendedor_pk = $id_emprendedor_pk;
    }
    
    public function getIdEstado()
    {
        return $this->id_estado_fk;
    }
    
    public function setIdEstado($id_estado_fk)
    {
        $this->id_estado_fk = $id_estado_fk;
    }
    
    public function getNombreEmprendedor()
    {
        return $this->nombre_emprendedor;
    }
    
    public function setNombreEmprendedor($nombre_emprendedor)
    {
        $this->nombre_emprendedor = $nombre_emprendedor;
    }
    
    public function getTelefono()
    {
        return $this->telefono;
    }
    
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    
    public function getCorreo()
    {
        return $this->correo;
    }
    
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }


    public static function getConexion(){
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }

    public function listarTodosEmprendedores(){
        $query = "SELECT * FROM fide_emprendedor_tb";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            $emprendedores = $resultado->fetchAll();
            foreach ($emprendedores as $encontrado) {
                $emprendedor = new emprendedorModel();
                $emprendedor->setIdEmprendedor($encontrado['id_emprendedor_pk']);
                $emprendedor->setNombreEmprendedor($encontrado['nombre_emprendedor']);
                $emprendedor->setTelefono($encontrado['telefono']);
                $emprendedor->setCorreo($encontrado['correo']);
                $emprendedor->setIdEstado($encontrado['id_estado_fk']);
                $arr[] = $emprendedor;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error ".$Exception->getCode().": ".$Exception->getMessage();
        }
    }
    
    

    public function guardarEmprendedor() {
        $query = "INSERT INTO fide_emprendedor_tb (nombre_emprendedor, telefono, correo, id_estado_fk) VALUES (:nombre_emprendedor, :telefono, :correo, :id_estado_fk)";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            // Asignar valores a variables
            $nombre_emprendedor = $this->getNombreEmprendedor();
            $telefono = $this->getTelefono();
            $correo = $this->getCorreo();
            $id_estado_fk = $this->getIdEstado();
            
            // Usar bindParam con variables
            $resultado->bindParam(":nombre_emprendedor", $nombre_emprendedor, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
        } catch (PDOException $Exception) {
            self::desconectar();
            // Devuelve un mensaje de error detallado
            echo json_encode(array("error" => $Exception->getMessage()));
        }
    }

    public function actualizarEmprendedor() {
        $query = "UPDATE fide_emprendedor_tb 
                  SET nombre_emprendedor=:nombre_emprendedor, 
                      telefono=:telefono, 
                      correo=:correo,  
                      id_estado_fk=:id_estado_fk 
                  WHERE id_emprendedor_pk=:id_emprendedor_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
            // Asignar valores a variables
            $id_emprendedor_pk = $this->getIdEmprendedor();
            $nombre_emprendedor = $this->getNombreEmprendedor();
            $telefono = $this->getTelefono();
            $correo = $this->getCorreo();
            $id_estado_fk = $this->getIdEstado();
    
            // Usar bindParam con variables
            $resultado->bindParam(":id_emprendedor_pk", $id_emprendedor_pk, PDO::PARAM_INT);
            $resultado->bindParam(":nombre_emprendedor", $nombre_emprendedor, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
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
        $query = "SELECT * FROM fide_emprendedor_tb WHERE nombre_emprendedor = :nombre_emprendedor";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            
            // Obtener el nombre del material desde la instancia de la clase
            $nombre_emprendedor = $this->getNombreEmprendedor();
            
            // Vincular el parámetro
            $resultado->bindParam(":nombre_emprendedor", $nombre_emprendedor, PDO::PARAM_STR);
            
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
        $id_emprendedor_pk = $this->getIdEmprendedor();
        $query = "UPDATE fide_emprendedor_tb SET id_estado_fk = 1 WHERE id_emprendedor_pk = :id_emprendedor_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_emprendedor_pk", $id_emprendedor_pk, PDO::PARAM_INT);
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
        $id_emprendedor_pk = $this->getIdEmprendedor();
        $query = "UPDATE fide_emprendedor_tb SET id_estado_fk = 2 WHERE id_emprendedor_pk = :id_emprendedor_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_emprendedor_pk", $id_emprendedor_pk, PDO::PARAM_INT);
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