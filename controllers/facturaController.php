<?php
require_once '../models/facturaModel.php';
require_once '../config/conexion.php';

session_start(); 

$pdo = Conexion::conectar(); 
$factura = new facturaModel(); 

switch ($_GET['op']) {
    case 'generar':
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['carrito'])) {
            $idUsuario = $_SESSION['id_usuario']; 
            $carrito = $_SESSION['carrito']; 
    
           
            $queryUsuario = $pdo->prepare("SELECT nombre_usuario FROM FIDE_USUARIOS_TB WHERE id_usuario_pk = :idUsuario");
            $queryUsuario->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $queryUsuario->execute();
            $usuario = $queryUsuario->fetch(PDO::FETCH_ASSOC);
            $nombreUsuario = $usuario['nombre_usuario'];
    
            $total = 0;
            $detalle = '';
    
            try {
                foreach ($carrito as $idProducto => $item) {
                    $cantidad = $item['cantidad'];
                    $precio = $item['precio'];
                    $subtotal = $cantidad * $precio;
                    $idMaterial = isset($item['id_material']) ? $item['id_material'] : null; 
    
                   
                    $factura->agregarItem($idUsuario, $idProducto, $idMaterial, $cantidad, $subtotal);
    
                    $total += $subtotal;
                    $detalle .= "
                        <tr>
                            <td>{$item['nombre']}</td>
                            <td>{$precio}</td>
                            <td>{$cantidad}</td>
                            <td>{$subtotal}</td>
                        </tr>
                    ";
                }
    
                
                echo json_encode([
                    'success' => true,
                    'html' => $detalle,
                    'total' => $total,
                    'nombre_usuario' => $nombreUsuario
                ]);
            } catch (PDOException $e) {
                error_log("Error al agregar ítem a la factura: " . $e->getMessage());
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al agregar ítem a la factura: ' . $e->getMessage()
                ]);
                exit; 
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Datos de sesión no válidos'
            ]);
        }
        break;
    

    case 'confirmarPago':
        if (isset($_SESSION['carrito']) && isset($_SESSION['id_usuario'])) {
            $carrito = $_SESSION['carrito']; 
            $idUsuario = $_SESSION['id_usuario'];

          
            foreach ($carrito as $idProducto => $item) {
                $cantidad = $item['cantidad'];
                $idMaterial = isset($item['id_material']) ? $item['id_material'] : null;

               
                $factura->actualizarExistencias($idProducto, $cantidad);

               
                if ($idMaterial !== null) {
                    $factura->actualizarExistenciasMaterial($idMaterial, $cantidad);
                }
            }

         
            unset($_SESSION['carrito']);

       
            echo json_encode([
                'success' => true,
                'message' => 'Pago confirmado y carrito actualizado'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Carrito vacío o sesión no válida'
            ]);
        }
        break;

    default:
        echo json_encode([
            'success' => false,
            'message' => 'Operación no válida'
        ]);
        break;
}
?>