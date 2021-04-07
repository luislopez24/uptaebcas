<?php 
	
require_once ("modelo/clasificacion.php");
$clasificacion = new Clasificacion();

$opcion = $_GET['opcion'];

switch ($opcion) {

	case 'cookiesClasificacion':
		
		$nombre = $_POST["nombre"];
		$fechaf = $_POST["fechaf"];
		$fechai = $_POST["fechai"];
		$precio = $_POST["precio"];
		$descrip = $_POST["descrip"];

		//cookie por un dia
		setcookie("nombre", $nombre, time() + 86400);
		setcookie("fechaf", $fechaf, time() + 86400);
		setcookie("fechai", $fechai, time() + 86400);
		setcookie("precio", $precio, time() + 86400);
		setcookie("descrip", $descrip, time() + 86400);

	 	header("Location: ?url=clasificacion&opcion=administrarClasificacion&operativo=true");
		break;

	case 'administrarClasificacion':
		
		$error = isset($_GET['error']);
		$act = isset($_GET['act']);
		$delete = isset($_GET['delete']);

		if(!empty($_GET['operativo'])){			
				
	    		$operativo = $_GET['operativo'];
	    		$cata = 'operativo';
	    
	    		$datos=$clasificacion->consultar();	
				require_once("vista/operativo/clasificacion/clasificacion.php");
		 }

	    else{

	    $cata = $_GET['cata'];

		if ($cata =='false') {
				
			$datos=$clasificacion->consultar();	
			require_once("vista/operativo/clasificacion/clasificacion.php");	      

		}else{

			if(isset($_GET['id_tipo_o'])){

				$id_tipo = $_GET['id_tipo_o'];	
			}
	
			$datos = $clasificacion->buscar_clasificacion($id_tipo);
			require_once 'vista/operativo/clasificacion/clasificacion_individual.php';
		}
	 }
	break;

	case 'registrar':

		$nomb=mb_strtoupper($_POST['nom'], 'UTF-8');
		$nomb = mb_convert_case($nomb, MB_CASE_TITLE, "UTF-8");
		
		if (isset($_GET['cata'])) {
			
			$cata = $_GET['cata'];
		}

		$resul=$clasificacion->Buscar_clasificacion_($nomb);

		if ($resul['estatus'] && count($resul)==2) {

			if ($cata == 'false') {
				
				header("Location:?url=clasificacion&opcion=administrarClasificacion&error_clasificacion=si&cata=$cata");

			}else{

				header("Location:?url=clasificacion&opcion=administrarClasificacion&operativo=true&error_clasificacion=si");
			}

		}else{

		if (empty($nomb)) {

			header("Location:?url=clasificacion&opcion=administrarClasificacion&operativo=true&clasnull=true");

		} else {

		$clasificacion->setnombre_clasificacion($nomb);
		$resul=$clasificacion->Registrar();

								   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_clasificacion = $nomb;
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Registró la clasificación '.$nombre_clasificacion;
									
								   // Funcion para captar el ip
								   function getUserIP() {
									
									$ipaddress = '';
									
										if (isset($_SERVER['HTTP_CLIENT_IP']))
								    	    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
								    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
								  	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
								    else if(isset($_SERVER['HTTP_X_FORWARDED']))
									        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
								    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
									        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
								    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
									        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
								    else if(isset($_SERVER['HTTP_FORWARDED']))
								            $ipaddress = $_SERVER['HTTP_FORWARDED'];
									else if(isset($_SERVER['REMOTE_ADDR']))
									        $ipaddress = $_SERVER['REMOTE_ADDR'];
									    else
									        $ipaddress = 'UNKNOWN';
								     return $ipaddress;
								
									}

									$ip = getUserIP();

									$bitacora->setId_usuario($id_usuario);
									$bitacora->setHora($hora);
									$bitacora->setFecha($fecha);
									$bitacora->setAccion($accion);
			    					$bitacora->setIp($ip);
												
									$respuesta = $bitacora->Add();
			
			if ($resul['estatus']=true) {

				if ($cata == 'false') {
					
				header("Location:?url=clasificacion&opcion=administrarClasificacion&error_clasificacion=no&cata=$cata");

				}else{

					header("Location:?url=clasificacion&opcion=administrarClasificacion&operativo=true&error_clasificacion=no");
				}
				
			}
		} }
		break;

	case 'modificar':
		
		$nomb=strtoupper($_POST['nom']);
		$nomb_anterior=strtoupper($_POST['nom2']);
		$nomb_anterior = mb_convert_case($nomb_anterior, MB_CASE_TITLE, "UTF-8");
		$nomb = mb_convert_case($nomb, MB_CASE_TITLE, "UTF-8");
		$id = $_POST["id_cla"];

		if (isset($_GET['cata'])) {
			
			$cata = $_GET['cata'];
		}

		$resul=$clasificacion->Buscar_clasificacion_($nomb);

		if ($resul['estatus'] && count($resul)==2) {

			if ($cata == 'false') {
				
				header("Location:?url=clasificacion&opcion=administrarClasificacion&error_clasificacion=si&cata=$cata");

			}else{

				header("Location:?url=clasificacion&opcion=administrarClasificacion&operativo=true&error_clasificacion=si");
			}
		}else{

			if (empty($nomb)) {
				
				header("Location:?url=clasificacion&opcion=administrarClasificacion&operativo=true&clasnull=true");

			}else{

			$clasificacion->setnombre_clasificacion($nomb);

			require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_clasificacion = $nomb_anterior;
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Modificó la clasificación '.$nombre_clasificacion." a ".$nomb;
									
								   // Funcion para captar el ip
								   function getUserIP() {
									
									$ipaddress = '';
									
										if (isset($_SERVER['HTTP_CLIENT_IP']))
								    	    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
								    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
								  	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
								    else if(isset($_SERVER['HTTP_X_FORWARDED']))
									        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
								    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
									        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
								    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
									        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
								    else if(isset($_SERVER['HTTP_FORWARDED']))
								            $ipaddress = $_SERVER['HTTP_FORWARDED'];
									else if(isset($_SERVER['REMOTE_ADDR']))
									        $ipaddress = $_SERVER['REMOTE_ADDR'];
									    else
									        $ipaddress = 'UNKNOWN';
								     return $ipaddress;
								
									}

									$ip = getUserIP();

									$bitacora->setId_usuario($id_usuario);
									$bitacora->setHora($hora);
									$bitacora->setFecha($fecha);
									$bitacora->setAccion($accion);
			    					$bitacora->setIp($ip);
												
									$respuesta = $bitacora->Add();

			$datos=$clasificacion->modificar($id);

			if ($cata == 'false') {
				
				header("Location:?url=clasificacion&opcion=administrarClasificacion&act_clasificacion=true&cata=$cata");

			}else{
		
				header("Location:?url=clasificacion&opcion=administrarClasificacion&operativo=true&act_clasificacion=true");
			}
		} }
		break;

	case 'eliminarClasificacion':
		
		$id= $_GET["id"];

		$resul=$clasificacion->consultar_title($id);

		foreach ($resul as $clas) {
			
			$nombre_clasificacion = $clas['nombre_clasificacion'];

		}

		require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();
				
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Eliminó la clasificación '.$nombre_clasificacion;
									
								   // Funcion para captar el ip
								   function getUserIP() {
									
									$ipaddress = '';
									
										if (isset($_SERVER['HTTP_CLIENT_IP']))
								    	    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
								    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
								  	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
								    else if(isset($_SERVER['HTTP_X_FORWARDED']))
									        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
								    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
									        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
								    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
									        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
								    else if(isset($_SERVER['HTTP_FORWARDED']))
								            $ipaddress = $_SERVER['HTTP_FORWARDED'];
									else if(isset($_SERVER['REMOTE_ADDR']))
									        $ipaddress = $_SERVER['REMOTE_ADDR'];
									    else
									        $ipaddress = 'UNKNOWN';
								     return $ipaddress;
								
									}

									$ip = getUserIP();

									$bitacora->setId_usuario($id_usuario);
									$bitacora->setHora($hora);
									$bitacora->setFecha($fecha);
									$bitacora->setAccion($accion);
			    					$bitacora->setIp($ip);
												
									$respuesta = $bitacora->Add();

		$clasificacion->eliminar($id);

		if (isset($_GET['cata'])) {
			
			$cata = $_GET['cata'];
		}

		if ($cata == 'false') {

			header("Location:?url=clasificacion&opcion=administrarClasificacion&delete_clasificacion=true&cata=$cata");
		
		}else{

			header("Location:?url=clasificacion&opcion=administrarClasificacion&operativo=true&delete_clasificacion=true");
		}

		
	    break;
}

?>