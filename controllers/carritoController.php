<?php
require_once '../models/facturaModel.php';
require_once '../config/conexion.php'; 

session_start();

class CarritoController {
    public function agregar() {
        $idProducto = $_POST['id_producto'];
        $idMaterial = isset($_POST['id_material']) ? $_POST['id_material'] : null;
        $nombreProducto = $_POST['nombre_producto'];
        $precioProducto = $_POST['precio_producto'];
        $cantidad = $_POST['cantidad'];
    
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }
    
        $carrito = $_SESSION['carrito'];
    
        $key = $idProducto . '-' . $idMaterial;
    
        if (isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += $cantidad;
        } else {
            $carrito[$key] = array(
                'nombre' => $nombreProducto,
                'precio' => $precioProducto,
                'cantidad' => $cantidad,
                'id_material' => $idMaterial
            );
        }
    
        $_SESSION['carrito'] = $carrito;
    
        error_log("Carrito actualizado: " . print_r($_SESSION['carrito'], true)); 
    
        echo json_encode(['status' => 'success']);
    }
    

    public function mostrarCarrito() {
        if (isset($_SESSION['carrito'])) {
            echo json_encode($_SESSION['carrito']);
        } else {
            echo json_encode([]);
        }
    }

    public function eliminarDelCarrito() {
        $idProducto = $_POST['id_producto'];
        $idMaterial = isset($_POST['id_material']) ? $_POST['id_material'] : null;

        $key = $idProducto . '-' . $idMaterial;

        if (isset($_SESSION['carrito'][$key])) {
            unset($_SESSION['carrito'][$key]);
        }

        echo json_encode(['status' => 'success']);
    }

    public function vaciarCarrito() {
        $pdo = Conexion::conectar(); 

        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito']; 

          
            if (!empty($carrito)) {
                foreach ($carrito as $key => $detalle) {
                    $idProducto = intval(explode('-', $key)[0]);
                    $idMaterial = intval(explode('-', $key)[1]) ?: null;
                    $cantidad = intval($detalle['cantidad']);

               
                    if ($idProducto) {
                        $stmt = $pdo->prepare("UPDATE FIDE_PRODUCTOS_TB SET existencias_producto = existencias_producto - ? WHERE id_producto_pk = ?");
                        $stmt->execute([$cantidad, $idProducto]);
                    }

                
                    if ($idMaterial) {
                        $stmt = $pdo->prepare("UPDATE FIDE_MATERIALES_TB SET existencias_material = existencias_material - ? WHERE id_materiales_pk = ?");
                        $stmt->execute([$cantidad, $idMaterial]);
                    }
                }

             
                $_SESSION['carrito'] = array();

                echo json_encode(['status' => 'success']); 
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Carrito vacío']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Carrito no encontrado']);
        }
    }
}

$op = isset($_GET['op']) ? $_GET['op'] : '';

$controller = new CarritoController();

switch ($op) {
    case 'agregar':
        $controller->agregar();
        break;
    case 'mostrar':
        $controller->mostrarCarrito();
        break;
    case 'eliminar':
        $controller->eliminarDelCarrito();
        break;
    case 'vaciar':
        $controller->vaciarCarrito();
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Operación no válida']);
        break;
}
?>