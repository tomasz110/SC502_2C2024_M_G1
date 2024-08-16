<?php
require_once '../models/productoModel.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $producto_model = new productoModel();
        $productos = $producto_model->listarTodosProductos();
        $data = array();
        foreach ($productos as $producto) {
           
            $data[] = array(
                "0" => $producto->getIdProducto(),
                "1" => $producto->getNombreProducto(),
                "2" => $producto->getDescripcionProducto(),
                "3" => number_format($producto->getPrecioProducto(), 2),
                "4" => $producto->getExistenciasProducto(),
                "5" => $producto->getRutaImagenProducto(),
                "6" => $producto->getIdEmprendedor(),
                "7" => ($producto->getIdEstado() == 1) ? '<span class="label bg-success"> Activado </span>' : '<span class="label bg-danger"> Desactivado </span>',
                "8" => '<button class="btn btn-warning" id="modificarProducto">Modificar</button> ' .
                    ($producto->getIdEstado() == 1 ? '<button class="btn btn-danger" onclick="desactivar('.$producto->getIdProducto().')">Desactivar</button>' : '<button class="btn btn-success" onclick="activar('.$producto->getIdProducto().')">Activar</button>')
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

        case 'listar_activos':
            $producto_model = new productoModel();
            $productos = $producto_model->listarProductosActivos(); // Cambiado a listarProductosActivos
            $data = array();
            foreach ($productos as $producto) {
                $data[] = array(
                    "0" => $producto->getIdProducto(),
                    "1" => $producto->getNombreProducto(),
                    "2" => $producto->getDescripcionProducto(),
                    "3" => number_format($producto->getPrecioProducto(), 2),
                    "4" => $producto->getExistenciasProducto(),
                    "5" => $producto->getRutaImagenProducto(),
                    "6" => $producto->getIdEmprendedor(),
                    "7" => '<span class="label bg-success"> Activado </span>',
                    "8" => '<button class="btn btn-warning" id="modificarProducto">Modificar</button> ' .
                        '<button class="btn btn-danger" onclick="desactivar('.$producto->getIdProducto().')">Desactivar</button>'
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
        $id_emprendedor_fk = isset($_POST["id_emprendedor_fk"]) ? trim($_POST["id_emprendedor_fk"]) : 0;
        $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

        $producto = new productoModel();
        $producto->setNombreProducto($nombre);
        $producto->setDescripcionProducto($descripcion);
        $producto->setPrecioProducto($precio);
        $producto->setExistenciasProducto($existencias);
        $producto->setRutaImagenProducto($ruta_imagen);
        $producto->setIdEmprendedor($id_emprendedor_fk);
        $producto->setIdEstado($activo);
        

        if ($producto->verificarExistenciaDb()) {
            echo 3; // Usuario ya existe
        } else {
            $producto->guardarProducto(); 
            echo 1; // Usuario registrado exitosamente
        }
        break;

        case 'activar':
            $producto = new productoModel();
            $producto->setIdProducto(trim($_POST['idProducto']));
            $rspta = $producto->activar();
            echo ($rspta > 0) ? 1 : 2; // 1 para éxito, 0 para fallo
            break;
        
        case 'desactivar':
            $producto = new productoModel();
            $producto->setIdProducto(trim($_POST['idProducto']));
            $rspta = $producto->desactivar();
            echo ($rspta > 0) ? 1 : 2; // 1 para éxito, 0 para fallo
            break;
        

    case 'mostrar':
        $id_producto = isset($_POST["idProducto"]) ? $_POST["idProducto"] : "";
        $producto = new productoModel();
        $producto->setId($id_producto);
        $encontrado = $producto->mostrar();

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
    $id_emprendedor_fk = isset($_POST["id_emprendedor_fk"]) ? trim($_POST["id_emprendedor_fk"]) : 0;
    $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1;

    $producto = new productoModel();
    $producto->setIdProducto($id);
    $producto->setNombreProducto($nombre);
    $producto->setDescripcionProducto($descripcion);
    $producto->setPrecioProducto($precio);
    $producto->setExistenciasProducto($existencias);
    $producto->setRutaImagenProducto($ruta_imagen);
    $producto->setIdEmprendedor($id_emprendedor_fk);
    $producto->setIdEstado($activo);

    $resultado = $producto->actualizarProducto();

    if ($producto->actualizarProducto()) {
        echo 1; // Indica éxito
    } else {
        echo 0; // Indica fallo
    }

}
?>