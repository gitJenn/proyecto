<?PHP 
		require_once"../modelo/ejecutarSQL.php";
	$tbl_proveedores=new ejecutarSQL();

	$idprov= isset( $_POST['idprov'] ) ? limpiarCadena($_POST['idprov']): "";
    $idproveedor= isset( $_POST['idproveedor'] ) ? limpiarCadena($_POST['idproveedor']): "";
	$nombre= isset( $_POST['nombre'] ) ? limpiarCadena($_POST['nombre']): "";
	$direccion= isset( $_POST['direccion'] ) ? limpiarCadena($_POST['direccion']): "";
    $telefono= isset( $_POST['telefono'] ) ? limpiarCadena($_POST['telefono']): "";
    $Ciudad= isset( $_POST['Ciudad'] ) ? limpiarCadena($_POST['Ciudad']): "";
    $contacto= isset( $_POST['contacto'] ) ? limpiarCadena($_POST['contacto']): "";
    $nota= isset( $_POST['nota'] ) ? limpiarCadena($_POST['nota']): "";
    $email_contacto= isset( $_POST['email_contacto'] ) ? limpiarCadena($_POST['email_contacto']): "";
	//$estante= isset( $_POST['estante'] ) ? limpiarCadena($_POST['estante']): "";


	switch ($_GET['opc']) {
		case 'listar':
			$sql="select * from tbl_proveedores where estado=1";
			$resp=$tbl_proveedores->listar("select * from tbl_proveedores");
			$data=Array();

			while($fila=$resp->fetch_object()){
				$data[]=array("0"=>
($fila->estado) ?					
'<button type="button" onclick="mostrar('.$fila->idprov .')" class="btn btn-primary" style="margin-bottom: 10px; display: block; margin-left: auto; margin-right: auto;"><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModalprov"></i></button>'.
'<button type="button" onclick="anular('.$fila->idprov .')" class="btn btn-success" style="display: block; margin-left: auto; margin-right: auto;"><i class="fas fa-eraser"></i></button>':
'<button type="button" onclick="mostrar('.$fila->idprov .')" class="btn btn-primary" style="margin-bottom: 10px; display: block; margin-left: auto; margin-right: auto;"><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModalprov"></i></button>'.

'<button type="button" onclick="activar('.$fila->idprov .')" class="btn btn-danger" style="display: block; margin-left: auto; margin-right: auto;"><i class="fas fa-calendar-check"></i></button>'
					,
						"1"=> $fila->idproveedor,
                        "2"=> $fila->nombre,
                        "3"=> $fila->direccion,
                        "4"=> $fila->telefono,
                        "5"=> $fila->Ciudad,
                        "6"=> $fila->contacto,
                        "7"=> $fila->nota,
						"8"=>($fila->estado) ? '<span class="label bg-green">Activado</span>'
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
		$respx=$tbl_proveedores->insertar("update tbl_proveedores set estado='0'  where idprov='$idprov'");
		
	echo $respx ?" El proveedor se anulo correctante ": " No se puedo realizar";

		break;
				case 'activar':
		$respx=$tbl_proveedores->insertar("update tbl_proveedores set estado='1'  where idprov='$idprov'");
		
	echo $respx ?" El proveedor se activo correctante ": " No se puedo realizar";

		break;

		case 'guardaryeditar':
			
				if (empty($idprov)){
				$sql="insert into tbl_proveedores(idproveedor,nombre,direccion,telefono,Ciudad,contacto,nota,email_contacto,estado)
					values('$idproveedor','$nombre','$direccion','$telefono','$Ciudad','$contacto','$nota','$email_contacto','1')";
						$resp=$tbl_proveedores->insertar($sql);

				echo $resp ?" El proveedor se inserto correctante ": " No se puedo realizar";

				}else
				{
					$sql="update tbl_proveedores set idproveedor='$idproveedor',nombre='$nombre',direccion='$direccion',telefono='$telefono',Ciudad='$Ciudad',contacto='$contacto',nota='$nota',email_contacto='$email_contacto' where idprov='$idprov'";
						$resp=$tbl_proveedores->insertar($sql);
echo $resp ?" El proveedor se edito correctante ": " No se puedo realizar la edición";

				}


			break;
		case 'mostrar':
		$respx=$tbl_proveedores->mostrar("select * from tbl_proveedores where idprov='$idprov'");
		echo json_encode($respx);

		break;
		default:
			// code...
			break;
	}



?>