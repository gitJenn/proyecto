<?PHP 
		require_once"../modelo/ejecutarSQL.php";
	$categoria=new ejecutarSQL();

	$idcategoria= isset( $_POST['idcategoria'] ) ? limpiarCadena($_POST['idcategoria']): "";
	$nombre= isset( $_POST['categoria'] ) ? limpiarCadena($_POST['categoria']): "";
	$descripcion= isset( $_POST['descripcion'] ) ? limpiarCadena($_POST['descripcion']): "";
	//$estante= isset( $_POST['estante'] ) ? limpiarCadena($_POST['estante']): "";


	switch ($_GET['opc']) {
		case 'listar':
			
			$resp=$categoria->listar("select * from cliente");
			$data=Array();

			while($fila=$resp->fetch_object()){
				$data[]=array("0"=>
($fila->estado) ?					
'<button type="button" onclick="mostrar('.$fila->idcliente .')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>'.
'<button type="button" onclick="anular('.$fila->idcliente .')" class="btn btn-success" ><i class="fas fa-eraser"></i></button>':
'<button type="button" onclick="mostrar('.$fila->idcliente .')" class="btn btn-primary" ><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>'.

'<button type="button" onclick="activar('.$fila->idcliente .')" class="btn btn-danger" ><i class="fas fa-calendar-check"></i></button>'
					,
						"1"=> $fila->nombre,
						"2"=> $fila->direccion,
						"3"=>($fila->estado) ? '<span class="label bg-green">Activado</span>'
						:'<span class="label bg-red">Desactivado</span>'
				);
			}
			$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

		break;
		case 'anular':
		$respx=$categoria->insertar("update categoria set condicion='0'  where idcategoria='$idcategoria'");
		
	echo $respx ?" La categoria se anulo correctante ": " No se puedo realizar";

		break;
				case 'activar':
		$respx=$categoria->insertar("update categoria set condicion='1'  where idcategoria='$idcategoria'");
		
	echo $respx ?" La categoria se activo correctante ": " No se puedo realizar";

		break;

		case 'guardaryeditar':
			
				if (empty($idcategoria)){
				$sql="insert into categoria(categoria,descripcion,condicion)
					values('$nombre','$descripcion','1')";
						$resp=$categoria->insertar($sql);

				echo $resp ?" La categoria se inserto correctante ": " No se puedo realizar";

				}else
				{
					$sql="update categoria set categoria='$nombre',descripcion='$descripcion' where idcategoria='$idcategoria'";
						$resp=$categoria->insertar($sql);
echo $resp ?" La categoria se edito correctante ": " No se puedo realizar la edición";

				}


			break;
		case 'mostrar':
		$respx=$categoria->mostrar("select * from categoria where idcategoria='$idcategoria'");
		echo json_encode($respx);

		break;
		default:
			// code...
			break;
	}



?>