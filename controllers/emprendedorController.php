<?php
require_once '../models/emprendedorModel.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $emprendedor_model = new emprendedorModel();
        $emprendedores = $emprendedor_model->listarTodosEmprendedores();
        $data = array();
        foreach ($emprendedores as $emprendedor) {
           
            $data[] = array(
                "0" => $emprendedor->getIdEmprendedor(),
                "1" => $emprendedor->getNombreEmprendedor(),
                "2" => $emprendedor->getTelefono(),
                "3" => $emprendedor->getCorreo(),
                "4" => ($emprendedor->getIdEstado() == 1) ? '<span class="label bg-success"> Activado </span>' : '<span class="label bg-danger"> Desactivado </span>',
                "5" => '<button class="btn btn-warning" id="modificarEmprendedor">Modificar</button> ' .
                    ($emprendedor->getIdEstado() == 1 ? '<button class="btn btn-danger" onclick="desactivar('.$emprendedor->getIdEmprendedor().')">Desactivar</button>' : '<button class="btn btn-success" onclick="activar('.$emprendedor->getIdEmprendedor().')">Activar</button>')
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
        $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
        $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

        $emprendedor = new emprendedorModel();
        $emprendedor->setNombreEmprendedor($nombre);
        $emprendedor->setTelefono($telefono);
        $emprendedor->setCorreo($correo);
        $emprendedor->setIdEstado($activo);
       

       
        if ($emprendedor->verificarExistenciaDb()) {
            echo 3; 
        } else {
            $emprendedor->guardarEmprendedor(); 
            echo 1;
        }
        break;
        case 'activar':
            $emprendedor = new emprendedorModel();
            $emprendedor->setIdEmprendedor(trim($_POST['idEmprendedor']));
            $rspta = $emprendedor->activar();
            echo ($rspta > 0) ? 1 : 2; 
            break;
        
        case 'desactivar':
            $emprendedor = new emprendedorModel();
            $emprendedor->setIdEmprendedor(trim($_POST['idEmprendedor']));
            $rspta = $emprendedor->desactivar();
            echo ($rspta > 0) ? 1 : 2; 
            break;
        

    case 'mostrar':
        $id_emprendedor = isset($_POST["idEmprendedor"]) ? $_POST["idEmprendedor"] : "";
        $emprendedor = new emprendedorModel();
        $emprendedor->setId($id_emprendedor);
        $encontrado = $emprendedor->mostrar();

        if ($encontrado != null) {
            echo json_encode($encontrado);
        } else {
            echo 0;
        }
        break;

    case 'editar':
    $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";
    $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : "";
    $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

    $emprendedor = new emprendedorModel();
    $emprendedor->setIdEmprendedor($id);
    $emprendedor->setNombreEmprendedor($nombre);
    $emprendedor->setTelefono($telefono);
    $emprendedor->setCorreo($correo);
    $emprendedor->setIdEstado($activo);

    $resultado = $emprendedor->actualizarEmprendedor();

    if ($emprendedor->actualizarEmprendedor()) {
        echo 1; 
    } else {
        echo 0; 
    }

}
?>