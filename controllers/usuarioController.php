<?php
require_once '../models/usuarioModel.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $usuario_model = new usuarioModel();
        $usuarios = $usuario_model->listarUsuarios();
        $data = array();
        foreach ($usuarios as $usuario) {
            $data[] = array(
                "0" => $usuario->getIdUsuarioPk(),
                "1" => $usuario->getNombreUsuario(),
                "2" => $usuario->getCorreoUsuario(),
                "3" => $usuario->getIdRolFk(),
                "4" => ($usuario->getIdEstadoFk() == 1) ? '<span class="label bg-success"> Activado </span>' : '<span class="label bg-danger"> Desactivado </span>',
                "5" => '<button class="btn btn-warning" id="modificarUsuario">Modificar</button> ' .
                    ($usuario->getIdEstadoFk() == 1 ? '<button class="btn btn-danger" onclick="desactivar('.$usuario->getIdUsuarioPk().')">Desactivar</button>' : '<button class="btn btn-success" onclick="activar('.$usuario->getIdUsuarioPk().')">Activar</button>'),
                 "6" => $usuario->getPasswordUsuario()
            );
        }
        $resultados = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;

        case 'insertar':
            $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
            $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
            $id_estado = isset($_POST["id_estado"]) ? trim($_POST["id_estado"]) : 1;
            $id_rol = isset($_POST["id_rol"]) ? trim($_POST["id_rol"]) : 1;
        
            $usuario = new usuarioModel();
            $usuario->setNombreUsuario($nombre);
            $usuario->setPasswordUsuario($password);
            $usuario->setCorreoUsuario($correo);
            $usuario->setIdEstadoFk($id_estado);
            $usuario->setIdRolFk($id_rol);
        
            
            if ($usuario->verificarExistenciaDb()) {
                echo 3; 
            } else {
                $usuario->guardarUsuario(); 
                echo 1; 
            }
            break;
        

    case 'activar':
        $usuario = new usuarioModel();
        $usuario->setIdUsuarioPk(trim($_POST['idUsuario']));
        $rspta = $usuario->activar();
        echo ($rspta > 0) ? 1 : 2; 
        break;

    case 'desactivar':
        $usuario = new usuarioModel();
        $usuario->setIdUsuarioPk(trim($_POST['idUsuario']));
        $rspta = $usuario->desactivar();
        echo ($rspta > 0) ? 1 : 2; 
        break;

    case 'mostrar':
        $id_usuario = isset($_POST["idUsuario"]) ? $_POST["idUsuario"] : "";
        $usuario = new usuarioModel();
        $usuario->setIdUsuarioPk($id_usuario);
        $encontrado = $usuario->listarUsuarios(); 

      
        $usuarioEncontrado = null;
        foreach ($encontrado as $u) {
            if ($u->getIdUsuarioPk() == $id_usuario) {
                $usuarioEncontrado = $u;
                break;
            }
        }

        if ($usuarioEncontrado) {
            echo json_encode(array(
                "id_usuario_pk" => $usuarioEncontrado->getIdUsuarioPk(),
                "nombre_usuario" => $usuarioEncontrado->getNombreUsuario(),
                "correo_usuario" => $usuarioEncontrado->getCorreoUsuario(),
                "id_estado_fk" => $usuarioEncontrado->getIdEstadoFk(),
                "id_rol_fk" => $usuarioEncontrado->getIdRolFk()
            ));
        } else {
            echo 0;
        }
        break;

    case 'editar':
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $id_estado = isset($_POST["id_estado"]) ? trim($_POST["id_estado"]) : 1;
        $id_rol = isset($_POST["id_rol"]) ? trim($_POST["id_rol"]) : 1;

        $usuario = new usuarioModel();
        $usuario->setIdUsuarioPk($id);
        $usuario->setNombreUsuario($nombre);
        $usuario->setPasswordUsuario($password);
        $usuario->setCorreoUsuario($correo);
        $usuario->setIdEstadoFk($id_estado);
        $usuario->setIdRolFk($id_rol);

        $resultado = $usuario->actualizarUsuario();

        if ($resultado) {
            echo 1; 
        } else {
            echo 0;
        }
        break;

        case 'autenticar':
            $correo = isset($_GET['correo']) ? trim($_GET['correo']) : "";
            $password = isset($_GET['password']) ? trim($_GET['password']) : "";
            
            
            error_log("Correo recibido: $correo");
            error_log("Contraseña recibida: $password");
        
            $usuario = new usuarioModel();
            $usuarioData = $usuario->obtenerUsuarioPorEmailYPassword($correo, $password);
        
            if ($usuarioData) {
                error_log("Usuario encontrado: " . print_r($usuarioData, true));
                $_SESSION['rol'] = $usuarioData['id_rol_fk'];
                $_SESSION['usuario'] = $usuarioData['nombre_usuario'];
                echo json_encode(['success' => true]);
            } else {
                error_log("No se encontró usuario con el correo: $correo");
                echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
            }
            break;
        
        

        
}
?>
