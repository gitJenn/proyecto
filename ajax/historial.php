<?PHP 
		require_once"../modelo/ejecutarSQL.php";
	$historial=new ejecutarSQL();

	$idhistorial = isset( $_POST['idhistorial'] ) ? limpiarCadena($_POST['idhistorial']): "";
    $cliente= isset( $_POST['cliente'] ) ? limpiarCadena($_POST['cliente']): "";
	$comprobante= isset( $_POST['comprobante'] ) ? limpiarCadena($_POST['comprobante']): "";
	$serie= isset( $_POST['serie'] ) ? limpiarCadena($_POST['serie']): "";
    $tipo_pago= isset( $_POST['tipo_pago'] ) ? limpiarCadena($_POST['tipo_pago']): "";
    $fecha= isset( $_POST['fecha'] ) ? limpiarCadena($_POST['fecha']): "";
    $hora= isset( $_POST['hora'] ) ? limpiarCadena($_POST['hora']): "";
  


	switch ($_GET['opc']) {
		case 'listar':
			$sql="select * from historial where estado=1";
			$resp=$historial->listar("select * from historial");
			$data=Array();

			while($fila=$resp->fetch_object()){
				$data[]=array("0"=>
($fila->estado) ?					

'<button type="button" onclick="anular('.$fila->idhistorial .')" class="btn btn-success" style="display: block; margin-left: auto; margin-right: auto;">Anular <i class="fas fa-eraser"></i></button>':

'<button type="button" onclick="activar('.$fila->idhistorial .')" class="btn btn-danger" style="display: block; margin-left: auto; margin-right: auto;">Activar <i class="fas fa-calendar-check"></i></button>'
					,
						"1"=> $fila->cliente,
						"2"=> $fila->comprobante,
						"3"=> $fila->serie,
						"4"=> $fila->tipo_pago,
						"5"=> $fila->fecha,
						"6"=> $fila->hora,
						"7"=>($fila->estado) ? '<span class="label bg-green">Activado</span>'
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
		$respx=$historial->insertar("update historial set estado='0'  where idhistorial='$idhistorial'");
		
	echo $respx ?"La factura se anulo correctante ": " No se puedo realizar";

		break;

				case 'activar':
		$respx=$historial->insertar("update historial set estado='1'  where idhistorial='$idhistorial'");
		
	echo $respx ?" El proveedor se activo correctante ": " No se puedo realizar";

		break;

		case 'guardar':
				$sql="insert into historial(cliente,comprobante,serie,tipo_pago,fecha,hora,estado)
					values('$cliente','$comprobante','$serie','$tipo_pago','$fecha','$hora','1')";
					$resp=$historial->insertar($sql);

				echo $resp ?"Venta guardada correctamente a las $hora": " No se puedo realizar";


			break;


		
		default:
			// code...
			break;
	}



?>