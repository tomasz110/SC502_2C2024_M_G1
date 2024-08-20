<?php
require_once '../models/usuarioModel.php';
session_start();

switch ($_POST["op"]) {
    case 'autenticar':
        $correo = isset($_POST['correo']) ? trim($_POST['correo']) : "";
        $password = isset($_POST['password']) ? trim($_POST['password']) : "";
        
        $usuario = new usuarioModel();
        $usuarioData = $usuario->obtenerUsuarioPorEmailYPassword($correo, $password);
    
        if ($usuarioData) {
         
            $_SESSION['id_usuario'] = $usuarioData['id_usuario_pk']; 
            $_SESSION['rol'] = $usuarioData['id_rol_fk'];
            $_SESSION['usuario'] = $usuarioData['nombre_usuario'];
            echo json_encode([
                'success' => true,
                'rol' => $usuarioData['id_rol_fk'] 
            ]);
        } else {
            error_log("Contenido de la sesión: " . print_r($_SESSION, true));

            echo json_encode([
                'success' => false,
                'message' => 'Credenciales incorrectas'
            ]);
        }
        break;
}
?>
