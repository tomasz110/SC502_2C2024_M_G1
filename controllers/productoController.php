<?php
require_once '../models/productoModel.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $productoModel = new productoModel();
        $productos = $productoModel->listarTodosDb();
        $data = array();
        foreach ($productos as $reg) {
            if ($reg->getImagen() != '' && $reg->getImagen() != null) {
                $imagen = './assets/images/products/' . $reg->getImagen();
            } else {
                $imagen = './assets/images/products/' . 'default-product.jpg';
            }
            $data[] = array(
                "0" => $reg->getIdProducto(),
                "1" => $reg->getNombre(),
                "2" => $reg->getDescripcion(),
                "3" => $reg->getPrecio(),
                "4" => '<img src="' . $imagen . '" width="50px" height="50px"/>',
                "5" => $reg->getCategoria(),
                "6" => $reg->getMaterial(),
                "7" => ($reg->getEstado() == 1) ? '<span class="label bg-success"> Activado </span>' : '<span class="label bg-danger"> Desactivado </span>',
                "8" => ($reg->getEstado()) ? 
                        '<button class="btn btn-warning" onclick="modificarProducto(' . $reg->getIdProducto() . ')">Modificar</button> ' .
                        '<button class="btn btn-danger" onclick="desactivar(' . $reg->getIdProducto() . ')">Desactivar</button>' :
                        '<button class="btn btn-warning" onclick="modificarProducto(' . $reg->getIdProducto() . ')">Modificar</button> ' .
                        '<button class="btn btn-success" onclick="activar(' . $reg->getIdProducto() . ')">Activar</button>'
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
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
        $imagen = isset($_POST["imagen"]) ? trim($_POST["imagen"]) : "";
        $categoria = isset($_POST["categoria"]) ? trim($_POST["categoria"]) : "";
        $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : 1;
        $material = isset($_POST["material"]) ? trim($_POST["material"]) : "";

        $producto = new productoModel();
        $producto->setNombre($nombre);
        $encontrado = $producto->verificarExistenciaDb();
        
        if (!$encontrado) {
            $producto->setDescripcion($descripcion);
            $producto->setPrecio($precio);
            $producto->setImagen($imagen);
            $producto->setCategoria($categoria);
            $producto->setEstado($estado);
            $producto->setMaterial($material);
            $producto->guardarEnDb();

            if ($producto->verificarExistenciaDb()) {
                echo 1; // Producto registrado con éxito
            } else {
                echo 3; // Fallo al realizar el registro
            }
        } else {
            echo 2; // El producto ya existe
        }
        break;

    case 'activar':
        $producto = new productoModel();
        $producto->setIdProducto(trim($_POST['idProducto']));
        $rspta = $producto->activar();
        echo $rspta;
        break;

    case 'desactivar':
        $producto = new productoModel();
        $producto->setIdProducto(trim($_POST['idProducto']));
        $rspta = $producto->desactivar();
        echo $rspta;
        break;

    case 'mostrar':
        $idProducto = isset($_POST["idProducto"]) ? $_POST["idProducto"] : "";
        $producto = new productoModel();
        $producto->setIdProducto($idProducto);
        $encontrado = $producto->llenarCampos($idProducto);
        
        if ($encontrado != null) {
            $arr = array(
                "idProducto" => $encontrado->getIdProducto(),
                "nombre" => $encontrado->getNombre(),
                "descripcion" => $encontrado->getDescripcion(),
                "precio" => $encontrado->getPrecio(),
                "imagen" => $encontrado->getImagen(),
                "categoria" => $encontrado->getCategoria(),
                "estado" => $encontrado->getEstado(),
                "material" => $encontrado->getMaterial()
            );
            echo json_encode($arr);
        } else {
            echo 0;
        }
        break;

    case 'editar':
        $idProducto = isset($_POST["idProducto"]) ? trim($_POST["idProducto"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
        $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";
        $imagen = isset($_POST["imagen"]) ? trim($_POST["imagen"]) : "";
        $categoria = isset($_POST["categoria"]) ? trim($_POST["categoria"]) : "";
        $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : 1;
        $material = isset($_POST["material"]) ? trim($_POST["material"]) : "";

        $producto = new productoModel();
        $producto->setIdProducto($idProducto);
        $producto->llenarCampos($idProducto);

        $producto->setNombre($nombre);
        $producto->setDescripcion($descripcion);
        $producto->setPrecio($precio);
        $producto->setImagen($imagen);
        $producto->setCategoria($categoria);
        $producto->setEstado($estado);
        $producto->setMaterial($material);

        $modificados = $producto->actualizarProducto();
        
        if ($modificados > 0) {
            echo 1;
        } else {
            echo 0;
        }
        break;
}
?>
