<?php
require_once '../models/materialModel.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $materialModel = new materialModel();
        $materiales = $materialModel->listarTodosDb();
        $data = array();
        foreach ($materiales as $reg) {
            if ($reg->getRutaImagenProducto() != '' && $reg->getRutaImagenProducto() != null) {
                $imagen = './assets/images/materiales/' . $reg->getRutaImagenProducto();
            } else {
                $imagen = './assets/images/materiales/' . 'default-materiales.jpg';
            }
            $data[] = array(
                "0" => $reg->getIdMaterialesPk(),
                "1" => $reg->getNombreMaterial(),
                "2" => $reg->getDescripcionMaterial(),
                "3" => '<img src="' . $imagen . '" width="50px" height="50px"/>',
                "4" => $reg->getPrecioProducto(),
                "5" => $reg->getExistenciasProducto(),
                "6" => ($reg->getIdEstadoFk() == 1) ? '<span class="label bg-success"> Activado </span>' : '<span class="label bg-danger"> Desactivado </span>',
                "7" => ($reg->getIdEstadoFk()) ? 
                        '<button class="btn btn-warning" onclick="modificarProducto(' . $reg->getIdMaterialesPk() . ')">Modificar</button> ' .
                        '<button class="btn btn-danger" onclick="desactivar(' . $reg->getIdMaterialesPk() . ')">Desactivar</button>' :
                        '<button class="btn btn-warning" onclick="modificarProducto(' . $reg->getIdMaterialesPk() . ')">Modificar</button> ' .
                        '<button class="btn btn-success" onclick="activar(' . $reg->getIdMaterialesPk() . ')">Activar</button>'
            );
        }
        $resultados = array(
            "sEcho" => 1, // Información para datatables
            "iTotalRecords" => count($data), // Total de registros en el datatable
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;

    case 'insertar':
        $nombre_material = isset($_POST["nombre_material"]) ? trim($_POST["nombre_material"]) : "";
        $descripcion_material = isset($_POST["descripcion_material"]) ? trim($_POST["descripcion_material"]) : "";
        $precio_producto = isset($_POST["precio_producto"]) ? trim($_POST["precio_producto"]) : "";
        $ruta_imagen_producto = isset($_POST["ruta_imagen_producto"]) ? trim($_POST["ruta_imagen_producto"]) : "";
        $existencias_producto = isset($_POST["existencias_producto"]) ? trim($_POST["existencias_producto"]) : "";
        $id_estado_fk = isset($_POST["id_estado_fk"]) ? trim($_POST["id_estado_fk"]) : 1;

        $material = new materialModel();
        $material->setNombreMaterial($nombre_material);
        $encontrado = $material->verificarExistenciaDb();
        
        if (!$encontrado) {
            $material->setDescripcionMaterial($descripcion_material);
            $material->setPrecioProducto($precio_producto);
            $material->setRutaImagenProducto($ruta_imagen_producto);
            $material->setExistenciasProducto($existencias_producto);
            $material->setIdEstadoFk($id_estado_fk);
            $material->guardarEnDb();

            if ($material->verificarExistenciaDb()) {
                echo 1; // Producto registrado con éxito
            } else {
                echo 3; // Fallo al realizar el registro
            }
        } else {
            echo 2; // El producto ya existe
        }
        break;

    case 'activar':
        $material = new materialModel();
        $material->setIdMaterialesPk(trim($_POST['id_materiales_pk']));
        $rspta = $material->activar();
        echo $rspta;
        break;

    case 'desactivar':
        $material = new materialModel();
        $material->setIdMaterialesPk(trim($_POST['id_materiales_pk']));
        $rspta = $material->desactivar();
        echo $rspta;
        break;

    case 'mostrar':
        $id_materiales_pk = isset($_POST["id_materiales_pk"]) ? $_POST["id_materiales_pk"] : "";
        $material = new materialModel();
        $material->setIdMaterialesPk($id_materiales_pk);
        $encontrado = $material->llenarCampos($id_materiales_pk);
        
        if ($encontrado != null) {
            $arr = array(
                "id_materiales_pk" => $encontrado->getIdMaterialesPk(),
                "nombre_material" => $encontrado->getNombreMaterial(),
                "descripcion_material" => $encontrado->getDescripcionMaterial(),
                "precio_producto" => $encontrado->getPrecioProducto(),
                "ruta_imagen_producto" => $encontrado->getRutaImagenProducto(),
                "existencias_producto" => $encontrado->getExistenciasProducto(),
                "id_estado_fk" => $encontrado->getIdEstadoFk()
            );
            echo json_encode($arr);
        } else {
            echo 0;
        }
        break;

    case 'editar':
        $id_materiales_pk = isset($_POST["id_materiales_pk"]) ? trim($_POST["id_materiales_pk"]) : "";
        $nombre_material = isset($_POST["nombre_material"]) ? trim($_POST["nombre_material"]) : "";
        $descripcion_material = isset($_POST["descripcion_material"]) ? trim($_POST["descripcion_material"]) : "";
        $precio_producto = isset($_POST["precio_producto"]) ? trim($_POST["precio_producto"]) : "";
        $ruta_imagen_producto = isset($_POST["ruta_imagen_producto"]) ? trim($_POST["ruta_imagen_producto"]) : "";
        $existencias_producto = isset($_POST["existencias_producto"]) ? trim($_POST["existencias_producto"]) : "";
        $id_estado_fk = isset($_POST["id_estado_fk"]) ? trim($_POST["id_estado_fk"]) : 1;
        

        $material = new materialModel();
        $material->setIdMaterialesPk($id_materiales_pk);
        $material->llenarCampos($id_materiales_pk);

        $material->setNombreMaterial($nombre_material);
        $material->setDescripcionMaterial($descripcion_material);
        $material->setPrecioProducto($precio_producto);
        $material->setRutaImagenProducto($ruta_imagen_producto);
        $material->setExistenciasProducto($existencias_producto);
        $material->setIdEstadoFk($id_estado_fk);

        $modificados = $material->actualizarMaterial();
        
        if ($modificados > 0) {
            echo 1;
        } else {
            echo 0;
        }
        break;
}
?>
