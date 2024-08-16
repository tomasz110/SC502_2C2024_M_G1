<?php
require_once '../config/Conexion.php';

class usuarioModel extends Conexion {

    protected static $cnx;
    private $id_usuario_pk = null;
    private $id_estado_fk = null;
    private $id_rol_fk = null;
    private $nombre_usuario = null;
    private $password_usuario = null;
    private $correo_usuario = null;
    private $db;

    public function __construct() {
        $this->db = $this->getConexion(); // Inicializa la conexión
    }

    public function getIdUsuarioPk() {
        return $this->id_usuario_pk;
    }

    public function getIdEstadoFk() {
        return $this->id_estado_fk;
    }

    public function getIdRolFk() {
        return $this->id_rol_fk;
    }

    public function getNombreUsuario() {
        return $this->nombre_usuario;
    }

    public function getPasswordUsuario() {
        return $this->password_usuario;
    }

    public function getCorreoUsuario() {
        return $this->correo_usuario;
    }

    public function setIdUsuarioPk($id_usuario_pk) {
        $this->id_usuario_pk = $id_usuario_pk;
    }

    public function setIdEstadoFk($id_estado_fk) {
        $this->id_estado_fk = $id_estado_fk;
    }

    public function setIdRolFk($id_rol_fk) {
        $this->id_rol_fk = $id_rol_fk;
    }

    public function setNombreUsuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setPasswordUsuario($password_usuario) {
        $this->password_usuario = $password_usuario;
    }

    public function setCorreoUsuario($correo_usuario) {
        $this->correo_usuario = $correo_usuario;
    }

    public static function getConexion() {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar() {
        self::$cnx = null;
    }

    public function listarUsuarios() {
        $query = "SELECT * FROM FIDE_USUARIOS_TB";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            $usuarios = $resultado->fetchAll();
            foreach ($usuarios as $encontrado) {
                $usuario = new usuarioModel();
                $usuario->setIdUsuarioPk($encontrado['id_usuario_pk']);
                $usuario->setNombreUsuario($encontrado['nombre_usuario']);
                $usuario->setPasswordUsuario($encontrado['password_usuario']);
                $usuario->setCorreoUsuario($encontrado['correo_usuario']);
                $usuario->setIdEstadoFk($encontrado['id_estado_fk']);
                $usuario->setIdRolFk($encontrado['id_rol_fk']);
                $arr[] = $usuario;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
        }
    }

    public function guardarUsuario() {
        $query = "INSERT INTO FIDE_USUARIOS_TB (nombre_usuario, password_usuario, correo_usuario, id_estado_fk, id_rol_fk) 
        VALUES (:nombre_usuario, :password_usuario, :correo_usuario, :id_estado_fk, :id_rol_fk)";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
            // Asignar valores a variables
            $nombre_usuario = $this->getNombreUsuario();
            $password_usuario = $this->getPasswordUsuario();
            $correo_usuario = $this->getCorreoUsuario();
            $id_estado_fk = $this->getIdEstadoFk();
            $id_rol_fk = $this->getIdRolFk();
    
            // Usar bindParam con variables
            $resultado->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $resultado->bindParam(":password_usuario", $password_usuario, PDO::PARAM_STR);
            $resultado->bindParam(":correo_usuario", $correo_usuario, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
            $resultado->bindParam(":id_rol_fk", $id_rol_fk, PDO::PARAM_INT);
    
            $resultado->execute();
            self::desconectar();
            return true; // Añadido para indicar éxito
        } catch (PDOException $Exception) {
            self::desconectar();
            // Devuelve un mensaje de error detallado
            return false; // Cambiado para indicar fracaso
        }
    }
    

    public function actualizarUsuario() {
        $query = "UPDATE FIDE_USUARIOS_TB 
                  SET nombre_usuario = :nombre_usuario, 
                      password_usuario = :password_usuario, 
                      correo_usuario = :correo_usuario, 
                      id_estado_fk = :id_estado_fk, 
                      id_rol_fk = :id_rol_fk 
                  WHERE id_usuario_pk = :id_usuario_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);

            // Asignar valores a variables
            $id_usuario_pk = $this->getIdUsuarioPk();
            $nombre_usuario = $this->getNombreUsuario();
            $password_usuario = $this->getPasswordUsuario();
            $correo_usuario = $this->getCorreoUsuario();
            $id_estado_fk = $this->getIdEstadoFk();
            $id_rol_fk = $this->getIdRolFk();

            // Usar bindParam con variables
            $resultado->bindParam(":id_usuario_pk", $id_usuario_pk, PDO::PARAM_INT);
            $resultado->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
            $resultado->bindParam(":password_usuario", $password_usuario, PDO::PARAM_STR);
            $resultado->bindParam(":correo_usuario", $correo_usuario, PDO::PARAM_STR);
            $resultado->bindParam(":id_estado_fk", $id_estado_fk, PDO::PARAM_INT);
            $resultado->bindParam(":id_rol_fk", $id_rol_fk, PDO::PARAM_INT);

            $resultado->execute();
            self::desconectar();
            return true; // Añadido para indicar éxito
        } catch (PDOException $Exception) {
            self::desconectar();
            return "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
        }
    }

    public function verificarExistenciaDb() {
        $query = "SELECT * FROM FIDE_USUARIOS_TB WHERE correo_usuario = :correo_usuario";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
    
            // Obtener el nombre del usuario desde la instancia de la clase
            $correo_usuario = $this->getCorreoUsuario();
    
            // Vincular el parámetro
            $resultado->bindParam(":correo_usuario", $correo_usuario, PDO::PARAM_STR);
    
            $resultado->execute();
            self::desconectar();
    
            // Verificar si se encontraron registros
            return $resultado->rowCount() > 0; // Devuelve true si existe, false si no
        } catch (PDOException $Exception) {
            self::desconectar();
            return false; // O maneja el error de acuerdo a tus necesidades
        }
    }
    
    public function activar() {
        $id_usuario_pk = $this->getIdUsuarioPk();
        $query = "UPDATE FIDE_USUARIOS_TB SET id_estado_fk = 1 WHERE id_usuario_pk = :id_usuario_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_usuario_pk", $id_usuario_pk, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            return "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
        }
    }

    public function obtenerUsuarioPorEmailYPassword($correo, $password) {
        $query = "SELECT * FROM FIDE_USUARIOS_TB WHERE correo_usuario = :email AND password_usuario = :password";
        
        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->execute(['email' => $correo, 'password' => $password]);
            self::desconectar();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Manejar errores de consulta
            echo 'Error al obtener usuario: ' . $e->getMessage();
            return false;
        }
    }
    

    public function desactivar() {
        $id_usuario_pk = $this->getIdUsuarioPk();
        $query = "UPDATE FIDE_USUARIOS_TB SET id_estado_fk = 2 WHERE id_usuario_pk = :id_usuario_pk";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_usuario_pk", $id_usuario_pk, PDO::PARAM_INT);
            self::$cnx->beginTransaction();
            $resultado->execute();
            self::$cnx->commit();
            self::desconectar();
            return $resultado->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            return "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
        }
    }

}
?>