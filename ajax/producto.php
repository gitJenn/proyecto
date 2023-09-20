<?PHP 
		require_once"../modelo/ejecutarSQL.php";
	$producto=new ejecutarSQL();

	$id= isset( $_POST['id'] ) ? limpiarCadena($_POST['id']): "";
	$codigo= isset( $_POST['codigo'] ) ? limpiarCadena($_POST['codigo']): "";
	$descripcion= isset( $_POST['descripcion'] ) ? limpiarCadena($_POST['descripcion']): "";
	$cantidad= isset( $_POST['cantidad'] ) ? limpiarCadena($_POST['cantidad']): "";
	$precio= isset( $_POST['precio'] ) ? limpiarCadena($_POST['precio']): "";
	$impuesto_id= isset( $_POST['impuesto_id'] ) ? limpiarCadena($_POST['impuesto_id']): "";
	$producto_categoria_id= isset( $_POST['catesele'] ) ? limpiarCadena($_POST['catesele']): "";
	$proveedor_id= isset( $_POST['provsele'] ) ? limpiarCadena($_POST['provsele']): "";
	//$estante= isset( $_POST['estante'] ) ? limpiarCadena($_POST['estante']): "";


	switch ($_GET['opc']) {
        case 'seleprove':
            $resp=$producto->listar("select * from tbl_proveedores");
			echo '<option selected="selected">Seleccione Proveedor</option>  '; 
			while($fila=$resp->fetch_object()){
            echo '<option value="'.$fila->idprov.'">'.$fila->nombre.'</option>';
            
            }


        break;

        case 'selecate':
            $resp=$producto->listar("select * from categoria");
			echo '<option selected="selected">Seleccione Categoría</option>  '; 
			while($fila=$resp->fetch_object()){
            echo '<option value="'.$fila->idcategoria.'">'.$fila->categoria.'</option>';
            
            }
        break;


case 'listar':
$resp = $producto->listar("SELECT * FROM producto");
$data = Array();
$proveedores = Array(); // Array para almacenar los proveedores
$categorias = Array(); // Array para almacenar las categorias


// Consulta para obtener las categorias
$respCategoria = $producto->listar("SELECT * FROM categoria");
while ($filaCategoria = $respCategoria->fetch_object()) {
	$categorias[$filaCategoria->idcategoria] = $filaCategoria->categoria;
}

// Consulta para obtener los proveedores
$respProveedor = $producto->listar("SELECT * FROM tbl_proveedores");
while ($filaProveedor = $respProveedor->fetch_object()) {
    $proveedores[$filaProveedor->idprov] = $filaProveedor->nombre;
}


while ($fila = $resp->fetch_object()) {
	$nombreCategoria = "Desconocida"; // Valor predeterminado si no se encuentra la categoria en el array
    $nombreProveedor = "Desconocido"; // Valor predeterminado si no se encuentra el proveedor en el array

// Verifica si la categoria existe en el array y obtén su nombre correspondiente
if (isset($categorias[$fila->producto_categoria_id])) {
	$nombreCategoria = $categorias[$fila->producto_categoria_id];
}



    // Verifica si el proveedor existe en el array y obtén su nombre correspondiente
    if (isset($proveedores[$fila->proveedor_id])) {
        $nombreProveedor = $proveedores[$fila->proveedor_id];
    }

    $data[] = array(
        "0" => ($fila->condicion) ?      
						'<button type="button" onclick="mostrar(' . $fila->id . ')" class="btn btn-primary" style="width: 100px; margin-bottom: 5px">Editar <i class="fas fa-edit" data-toggle="modal" data-target="#exampleModalProd"></i></button>' .
						'<button type="button" onclick="anular(' . $fila->id . ')" class="btn btn-success" style="width: 100px;">Anular <i class="fas fa-eraser"></i></button>' :
						'<button type="button" onclick="mostrar(' . $fila->id . ')" class="btn btn-primary" style="width: 100px; margin-bottom: 5px">Editar <i class="fas fa-edit" data-toggle="modal" data-target="#exampleModalProd"></i></button>' .
						'<button type="button" onclick="activar(' . $fila->id . ')" class="btn btn-danger" style="width: 100px;">Activar <i class="fas fa-calendar-check"></i></button>',
					"1" => $fila->codigo,
					"2" => $fila->descripcion,
					"3" => $fila->cantidad,
					"4" => $fila->precio,
					"5" => $fila->impuesto_id,
					"6" => $nombreCategoria,
					"7" => $nombreProveedor,
					"8" => ($fila->condicion) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
    );
}

$results = array(
    "sEcho" => 1, // Información para el datatables
	"iTotalRecords" => count($data), // Enviamos el total registros al datatable
	"iTotalDisplayRecords" => count($data), // Enviamos el total registros a visualizar
	"aaData" => $data
);

echo json_encode($results);

break;


		case 'anular':
		$respx=$producto->insertar("update producto set condicion='0'  where id='$id'");
		
	echo $respx ?" El producto se anuló correctamente ": " No se pudo realizar";

		break;

		case 'activar':
		$respx=$producto->insertar("update producto set condicion='1'  where id='$id'");
		
	echo $respx ?" El producto se activó correctamente ": " No se pudo realizar";

		break;




		case 'guardaryeditar':

				if (empty($id)){
					$sql="insert into producto(codigo,descripcion,condicion,cantidad,precio,impuesto_id,producto_categoria_id,proveedor_id)
						values('$codigo','$descripcion','1','$cantidad','$precio','$impuesto_id','$producto_categoria_id','$proveedor_id')";
							$resp=$producto->insertar($sql);
	
					echo $resp ?" El producto '$descripcion' se insertó correctamente ": " No se puedo realizar";
	
					}else
					{
						
						$sql="update producto set descripcion='$descripcion',condicion='1',cantidad='$cantidad',precio='$precio',impuesto_id='$impuesto_id',producto_categoria_id='$producto_categoria_id',proveedor_id='$proveedor_id' where id='$id'";
							$resp=$producto->insertar($sql);
						echo $resp ?" El producto '$descripcion' se editó correctamente.": " No se pudo realizar la edición";
	
					}
	
			
				

			break;


		case 'mostrar':
		$respx=$producto->mostrar("select * from producto where id='$id'");
		echo json_encode($respx);

		break;



		default:
			// code...
			break;
	}



?>