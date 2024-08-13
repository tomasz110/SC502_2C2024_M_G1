<?php
require_once '../models/materialModel.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $material_model = new materialModel();
        $materiales = $material_model->listarTodosMateriales();
        $data = array();
        foreach ($materiales as $material) {
            $data[] = array(
                "0" => $material->getIdMateriales(),
                "1" => $material->getNombreMaterial(),
                "2" => $material->getDescripcionMaterial(),
                "3" => number_format($material->getPrecioMaterial(), 2),
                "4" => $material->getExistenciasMaterial(),
                "5" => $material->getRutaImagenMaterial(),
                "6" => ($material->getIdEstado() == 1) ? '<span class="label bg-success"> Activado </span>' : '<span class="label bg-danger"> Desactivado </span>',
                "7" => '<button class="btn btn-warning" id="modificarMaterial">Modificar</button> ' .
                    ($material->getIdEstado() == 1 ? '<button class="btn btn-danger" onclick="desactivar('.$material->getIdMateriales().')">Desactivar</button>' : '<button class="btn btn-success" onclick="activar('.$material->getIdMateriales().')">Activar</button>')
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
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : 0;
        $existencias = isset($_POST["existencias"]) ? trim($_POST["existencias"]) : 0;
        $ruta_imagen = isset($_POST["ruta_imagen"]) ? trim($_POST["ruta_imagen"]) : "";
        $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

        $material = new materialModel();
        $material->setNombreMaterial($nombre);
        $material->setDescripcionMaterial($descripcion);
        $material->setPrecioMaterial($precio);
        $material->setExistenciasMaterial($existencias);
        $material->setRutaImagenMaterial($ruta_imagen);
        $material->setIdEstado($activo);
        $material->guardarMaterial();

        if ($material->verificarExistenciaDb()) {
            echo 1; // Material registrado con éxito
        } else {
            echo 3; // Fallo al realizar el registro
        }
        break;

        

    case 'activar':
        $material = new materialModel();
        $material->setIdMateriales(trim($_POST['idMaterial']));
        $rspta = $material->activar();
        echo ($rspta > 0) ? 1 : 2; // 1 para éxito, 2 para fallo
        break;

    case 'desactivar':
        $material = new materialModel();
        $material->setIdMateriales(trim($_POST['idMaterial']));
        $rspta = $material->desactivar();
        echo ($rspta > 0) ? 1 : 2; // 1 para éxito, 2 para fallo
        break;

    case 'mostrar':
        $id_material = isset($_POST["idMaterial"]) ? $_POST["idMaterial"] : "";
        $material = new materialModel();
        $material->setIdMateriales($id_material);
        $encontrado = $material->listarTodosMateriales(); // Cambiar según tu método de búsqueda

        if ($encontrado != null) {
            echo json_encode($encontrado);
        } else {
            echo 0;
        }
        break;

    case 'editar':
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : 0;
        $existencias = isset($_POST["existencias"]) ? trim($_POST["existencias"]) : 0;
        $ruta_imagen = isset($_POST["ruta_imagen"]) ? trim($_POST["ruta_imagen"]) : "";
        $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

        $material = new materialModel();
        $material->setIdMateriales($id);
        $material->setNombreMaterial($nombre);
        $material->setDescripcionMaterial($descripcion);
        $material->setPrecioMaterial($precio);
        $material->setExistenciasMaterial($existencias);
        $material->setRutaImagenMaterial($ruta_imagen);
        $material->setIdEstado($activo);

        $resultado = $material->actualizarMaterial();

        if ($material->actualizarMaterial()) {
            echo 1; // Indica éxito
        } else {
            echo 0; // Indica fallo
        }
        break;
}
?>