<?php
require_once '../config/conexion.php';

class facturaModel extends Conexion
{
    private static $cnx;

    public static function getConexion() {
        if (self::$cnx === null) {
            self::$cnx = parent::conectar();
        }
        return self::$cnx;
    }

    public static function desconectar() {
        self::$cnx = null;
    }

    public function agregarItem($idUsuario, $idProducto, $idMaterial, $cantidad, $subtotal) {
        $cnx = self::getConexion(); 
        $sql = "INSERT INTO FIDE_FACTURA_TB (id_usuario_fk, id_producto_fk, id_materiales_fk, cantidad, total) VALUES (:idUsuario, :idProducto, :idMaterial, :cantidad, :subtotal)";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindValue(':idProducto', $idProducto === '' ? null : $idProducto, PDO::PARAM_INT);
        $stmt->bindValue(':idMaterial', $idMaterial === '' ? null : $idMaterial, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':subtotal', $subtotal);
    
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en agregarItem: " . $e->getMessage());
            throw $e; 
        }
    }
    
}
?>
