<?php
require_once "../modelo/ejecutarSQL.php";
$producto = new ejecutarSQL();

$id = isset($_POST['id']) ? limpiarCadena($_POST['id']) : "";
$codigo = isset($_POST['codigo']) ? limpiarCadena($_POST['codigo']) : "";
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";
$cantidad = isset($_POST['cantidad']) ? limpiarCadena($_POST['cantidad']) : "";
$precio = isset($_POST['precio']) ? limpiarCadena($_POST['precio']) : "";
$impuesto_id = isset($_POST['impuesto_id']) ? limpiarCadena($_POST['impuesto_id']) : "";

switch ($_GET['opc']) {

    case 'listar':
        $resp = $producto->listar("select * from producto where condicion='1'");
        $data = Array();

        while ($fila = $resp->fetch_object()) {
            $data[] = array(
                "0" =>
                    '<button type="button" onclick="mostrar(' . $fila->codigo . ', ' . $fila->precio . ', \'' . $fila->descripcion . '\', ' . $fila->cantidad . ');" class="btn btn-secondary">Añadir <i class="fas fa-plus fa-sm" data-toggle="modal" data-target="#exampleModal"></i></button>',
                "1" => $fila->codigo,
                "2" => $fila->descripcion,
                "3" => $fila->cantidad
            );
        }
        $results = array(
            "sEcho" => 1, // Información para el datatables
            "iTotalRecords" => count($data), // enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), // enviamos el total registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);

        break;

    case 'mostrar':
        $idProducto = $_POST['idProducto'];
        $cantidadVendida = $_POST['cantidadVendida'];
		$precio = $_POST['precio'];

        // Realizar la lógica para restar la cantidad vendida de la base de datos
        if (restarCantidadBaseDeDatos($idProducto, $cantidadVendida)) {
            $respx = $producto->listar("select * from producto");
            $datax = Array();

            while ($fila = $respx->fetch_object()) {
                $datax[] = array(
                    "0" =>
                        '<button type="button" onclick="eliminarFila(this);" class="btn btn-primary"><i class="fas fa-trash" data-toggle="modal" data-target="#exampleModal"></i></button>',
                    "1" => $fila->codigo,
                    "2" => $fila->cantidad,
                    "3" => $fila->precio,
                    
                );
            }
            $results = array(
                "sEcho" => 1, // Información para el datatables
                "iTotalRecords" => count($datax), // enviamos el total registros al datatable
                "iTotalDisplayRecords" => count($datax), // enviamos el total registros a visualizar
                "aaData" => $datax
            );
            echo json_encode($results);
        } else {
            echo "Error al restar la cantidad en la base de datos";
        }

        break;


		
			case 'restar':
    $ventaDataJSON = isset($_POST['ventaData']) ? $_POST['ventaData'] : "";
    
    // Verificar si se recibió ventaData
    if (!empty($ventaDataJSON)) {
        // Decodificar el JSON en un arreglo PHP
        $ventaData = json_decode($ventaDataJSON, true);

        // Iterar a través de los datos de la venta
        foreach ($ventaData as $ventaItem) {
            $idProducto = $ventaItem['idProducto'];
            $cantidadVendida = $ventaItem['cantidadVendida'];

            // Realizar la actualización en la tabla productos
            $sql = "UPDATE producto SET cantidad = cantidad - $cantidadVendida WHERE codigo = $idProducto";
            $resp = $producto->insertar($sql);

            // Verificar si la actualización fue exitosa y responder apropiadamente
            if ($resp) {
                echo "La cantidad de producto con ID $idProducto se actualizó correctamente.";
            } else {
                echo "Error al actualizar la cantidad de producto con ID $idProducto.";
            }
        }
    } else {
        echo "No se recibieron datos de venta válidos.";
    }
    break;


 



        case 'obtenerCantidad':
            $idProducto = $_POST['idProducto'];
            // Realiza una consulta SQL para obtener la cantidad disponible para el producto con $idProducto
            $consulta = "SELECT cantidad FROM productos WHERE codigo = $idProducto";
            // Ejecuta la consulta y obtén el resultado
            // Aquí debes usar la función adecuada según la biblioteca que estás utilizando para conectarte a la base de datos (PDO, mysqli, etc.)
            $resultado = $conexion->query($consulta);
            
            if ($resultado) {
                $fila = $resultado->fetch(PDO::FETCH_ASSOC);
                if ($fila) {
                    $cantidadDisponible = $fila['cantidad'];
                    echo $cantidadDisponible;
                } else {
                    echo "0"; // Si no se encuentra el producto, puedes devolver 0 o algún valor predeterminado.
                }
            } else {
                echo "Error en la consulta"; // Manejo de errores
            }
            break;
        
       


    default:
        // code...
        break;
}


?>
