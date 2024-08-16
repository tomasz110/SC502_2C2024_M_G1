<?php
require_once '../models/usuarioModel.php';

switch ($_POST["op"]) {
    case 'autenticar':
        $correo = isset($_POST['correo']) ? trim($_POST['correo']) : "";
        $password = isset($_POST['password']) ? trim($_POST['password']) : "";
        
   
        error_log("Correo recibido: $correo");
        error_log("Contraseña recibida: $password");
    
        $usuario = new usuarioModel();
        $usuarioData = $usuario->obtenerUsuarioPorEmailYPassword($correo, $password);
    
       
        if ($usuarioData) {
            error_log("Usuario encontrado: " . print_r($usuarioData, true));
            $_SESSION['rol'] = $usuarioData['id_rol_fk'];
            $_SESSION['usuario'] = $usuarioData['nombre_usuario'];
            echo json_encode([
                'success' => true,
                'rol' => $usuarioData['id_rol_fk'] 
            ]);
        } else {
            error_log("No se encontró usuario con el correo: $correo");
            echo json_encode([
                'success' => false,
                'message' => 'Credenciales incorrectas'
            ]);
        }
        break;
}
?>
