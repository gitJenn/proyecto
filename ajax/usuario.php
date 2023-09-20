<?PHP 

if (strlen(session_id()) < 1) 
  session_start();

	require_once"../modelo/ejecutarSQL.php";
	$usuario=new ejecutarSQL();

	$idusuario= isset( $_POST['idusuario'] ) ? limpiarCadena($_POST['idusuario']): "";
	$nombre= isset( $_POST['nombre'] ) ? limpiarCadena($_POST['nombre']): "";
	$email= isset( $_POST['email'] ) ? limpiarCadena($_POST['email']): "";
	$cargo= isset( $_POST['cargo'] ) ? limpiarCadena($_POST['cargo']): "";
	$login= isset( $_POST['login'] ) ? limpiarCadena($_POST['login']): "";
	$clave= isset( $_POST['clave'] ) ? limpiarCadena($_POST['clave']): "";
	$imagen= isset( $_POST['imagen'] ) ? limpiarCadena($_POST['imagen']): "";

	switch ($_GET['opc']) {

		case 'salir':
			session_unset();
			session_destroy();
			
			header('Location: ../index.php');
		
			break;

		case 'verificar':
           
			$usu=$_REQUEST['usu'];
			$cla=$_REQUEST['clave'];
			
            //Mostramos la lista de permisos en la vista y si están o no marcados
            $resp=$usuario->listar("select * from usuario where login='".$usu."' and clave='".$cla."'");
			
			$salida="no";
            while ($reg =  $resp->fetch_object())
                    {
						$salida="si";  
						$_SESSION["nousuario"]=$reg->nombre;
						$_SESSION["cargousuario"]=$reg->cargo;
						$_SESSION["emailusuario"]=$reg->email;  
						$_SESSION['imagen']=$reg->imagen;

						$respd=$usuario->listar("select * from usuario_permiso where idusuario='".$reg->idusuario. "'");
						$valores=array();
						while ($regd =  $respd->fetch_object())
						{
							array_push($valores,$regd->idpermiso);
						}
						in_array(27,$valores)?$_SESSION['controlcate']=1:$_SESSION['controlcate']=0;
						in_array(28,$valores)?$_SESSION['controlprov']=1:$_SESSION['controlprov']=0;
						in_array(29,$valores)?$_SESSION['procrear']=1:$_SESSION['procrear']=0;
						in_array(30,$valores)?$_SESSION['proeditar']=1:$_SESSION['proeditar']=0;
						in_array(31,$valores)?$_SESSION['proanular']=1:$_SESSION['proanular']=0;
						in_array(32,$valores)?$_SESSION['controusu']=1:$_SESSION['controusu']=0;
						in_array(33,$valores)?$_SESSION['controventa']=1:$_SESSION['controventa']=0;

                    }


					echo $salida;

        break;

		
			
			

        case 'permisos':
           
            //Mostramos la lista de permisos en la vista y si están o no marcados
            $resp=$usuario->listar("select * from permiso");
			$id=0;
            while ($reg =  $resp->fetch_object())
                    {
						
                        $sw="";
                        //$sw=in_array($reg->idpermiso,$valores)?'checked':'';
                        //echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'"> '.$reg->nombre.'</li>';
						echo '<li>
						<div class="form-group clearfix">
						<div class="icheck-primary d-inline">
						<input type="checkbox" id="checkboxSuccess' .$id. '" name="permiso[]" value="'.$reg->idpermiso.'" '.$sw.'>
						<label for="checkboxSuccess' .$id. '" style="font-size: 14px; font-weight: bold">' .$reg->nombre. '</label>
						</div>
						</div>
						</li>';

						$id++;
						
                    }

        break;
		

		case 'listar':
			$sql="select * from usuario where condicion=1";
			$resp=$usuario->listar("select * from usuario");
			$data=Array();

			while($fila=$resp->fetch_object()){
				$data[]=array("0"=>
($fila->condicion) ?					
'<button type="button" onclick="mostrar('.$fila->idusuario .')" class="btn btn-primary" style="margin-right: 5px;"><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>'.
'<button type="button" onclick="anular('.$fila->idusuario .')" class="btn btn-success" ><i class="fas fa-eraser"></i></button>':
'<button type="button" onclick="mostrar('.$fila->idusuario .')" class="btn btn-primary" style="margin-right: 5px;"><i class="fas fa-edit" data-toggle="modal" data-target="#exampleModal"></i></button>'.

'<button type="button" onclick="activar('.$fila->idusuario .')" class="btn btn-danger" ><i class="fas fa-calendar-check"></i></button>'
					,
						"1"=> $fila->nombre,
						"2"=> $fila->login,
						"3"=> $fila->cargo,
						"4"=> $fila->email,
						"5"=>'<a href="../files/usuarios/'.$fila->imagen.'" target="_blank"><img src=
						"../files/usuarios/'.$fila->imagen.'" 
						class="profile-user-img img-fluid img-circle" width="60" height="60" 
						style="display: block; margin-left: auto; margin-right: auto"></a>',
						"6"=>($fila->condicion) ? '<span class="label bg-green">Activado</span>'
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
		$respx=$usuario->insertar("update usuario set condicion='0'  where idusuario='$idusuario'");
		
	echo $respx ?" El usuario se anulo correctante ": " No se puedo realizar";

		break;
				case 'activar':
		$respx=$usuario->insertar("update usuario set condicion='1'  where idusuario='$idusuario'");
		
	echo $respx ?" El usuario se activo correctante ": " No se puedo realizar";

		break;



		case 'guardaryeditar':

			if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
			{
				$imagen=$_POST["imagenactual"];
			}
			else 
			{
				$ext = explode(".", $_FILES["imagen"]["name"]);
				if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
				{
					$imagen = round(microtime(true)) . '.' . end($ext);
					move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
				}
			}

			
				if (empty($idusuario)){
				$sql="INSERT INTO `usuario`( `nombre`, `email`, `cargo`, `login`, `clave`,`imagen`, `condicion`) VALUES ('$nombre','$email','$cargo','$login','$clave','$imagen' ,1)";

				$resp=$usuario->insertar($sql);
				$permi=$_POST["permiso"];

					$i=0;
					while ($i < count($permi)){

				$sql="INSERT INTO `usuario_permiso`( `idusuario`, `idpermiso`) VALUES ( (select max(idusuario) from usuario ),'$permi[$i]')";

				$resp=$usuario->insertar($sql);
						$i++;
					}	
				

				echo $resp ?" El usuario ${nombre} se insertó correctamente ": " No se puedo realizar";

				}else
				{
					$sql="UPDATE `usuario` SET `nombre`='$nombre',`email`='$email',`cargo`='$cargo',`login`='$login',`clave`='$clave', `imagen`='$imagen' WHERE `idusuario`='$idusuario'";
					$resp=$usuario->insertar($sql);
			

				echo $resp ?" El usuario se edito correctamente ": " No se puedo realizar la edición";

				}


			break;
		case 'mostrar':
		$respx=$usuario->mostrar("select * from usuario where idusuario='$idusuario'");
		
		echo json_encode($respx);

		break;

		/*case 'insertarRegistro':
		$n=$_REQUEST['nombre'];
		$l=$_REQUEST['login'];
		$c=$_REQUEST['cargo'];
		$e=$_REQUEST['email'];

		$resp=$usuario->insertar("INSERT INTO `registro`( `nombre`, `login`, `cargo`, `email`) VALUES ('$n','$l','$c','$e')");
		echo $resp ?" El usuario se insertó correctamente ": " No se puedo realizar";
		break;*/

		default:
			// code...
			break;
	}



?>