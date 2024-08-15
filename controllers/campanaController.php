<?php
require_once '../models/campanaModel.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $campana_model = new campanaModel();
        $campanas = $campana_model->listarCampanas();
        $data = array();
        foreach ($campanas as $campana) {
            $data[] = array(
                "0" => $campana->getIdCampanaPk(),
                "1" => $campana->getNombreCampana(),
                "2" => $campana->getDescripcionCampana(),
                "3" => $campana->getFechaCampana(),
                "4" => $campana->getRutaImagenCampana(),
                "5" => $campana->getRutaMapaCampana(),
                "6" => ($campana->getIdEstadoFk() == 1) ? '<span class="label bg-success"> Activado </span>' : '<span class="label bg-danger"> Desactivado </span>',
                "7" => '<button class="btn btn-warning" id="modificarCampana">Modificar</button> ' .
                    ($campana->getIdEstadoFk() == 1 ? '<button class="btn btn-danger" onclick="desactivar('.$campana->getIdCampanaPk().')">Desactivar</button>' : '<button class="btn btn-success" onclick="activar('.$campana->getIdCampanaPk().')">Activar</button>')
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
        $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : "";
        $ruta_imagen = isset($_POST["ruta_imagen"]) ? trim($_POST["ruta_imagen"]) : "";
        $ruta_mapa = isset($_POST["ruta_mapa"]) ? trim($_POST["ruta_mapa"]) : "";
        $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

        $campana = new campanaModel();
        $campana->setNombreCampana($nombre);
        $campana->setDescripcionCampana($descripcion);
        $campana->setFechaCampana($fecha);
        $campana->setRutaImagenCampana($ruta_imagen);
        $campana->setRutaMapaCampana($ruta_mapa);
        $campana->setIdEstadoFk($activo);
        $campana->guardarEmprendedor(); 

        if ($campana->verificarExistenciaDb()) {
            echo 1; 
        } else {
            echo 3; 
        }
        break;

    case 'activar':
        $campana = new campanaModel();
        $campana->setIdCampanaPk(trim($_POST['idCampana']));
        $rspta = $campana->activar();
        echo ($rspta > 0) ? 1 : 2; // 1 para éxito, 0 para fallo
        break;

    case 'desactivar':
        $campana = new campanaModel();
        $campana->setIdCampanaPk(trim($_POST['idCampana']));
        $rspta = $campana->desactivar();
        echo ($rspta > 0) ? 1 : 2; // 1 para éxito, 0 para fallo
        break;

    case 'mostrar':
        $id_campana = isset($_POST["idCampana"]) ? $_POST["idCampana"] : "";
        $campana = new campanaModel();
        $campana->setIdCampanaPk($id_campana);
        $encontrado = $campana->listarCampanas(); 

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
        $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : "";
        $ruta_imagen = isset($_POST["ruta_imagen"]) ? trim($_POST["ruta_imagen"]) : "";
        $ruta_mapa = isset($_POST["ruta_mapa"]) ? trim($_POST["ruta_mapa"]) : "";
        $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

        $campana = new campanaModel();
        $campana->setIdCampanaPk($id);
        $campana->setNombreCampana($nombre);
        $campana->setDescripcionCampana($descripcion);
        $campana->setFechaCampana($fecha);
        $campana->setRutaImagenCampana($ruta_imagen);
        $campana->setRutaMapaCampana($ruta_mapa);
        $campana->setIdEstadoFk($activo);

        $resultado = $campana->actualizarCampana();

        if ($resultado) {
            echo 1; // Indica éxito
        } else {
            echo 0; // Indica fallo
        }
        break;
}
?>