<?php

	require_once ("modelo/catalogo.php");
	$catalogo= new Catalogo();

	$opcion = $_GET['opcion'];

	switch ($opcion) {
		
		case 'productoConformado':
			
			$cata = $_GET["cata"];	
			$id = $_GET["id"]; 	      
			
		    $datos=$catalogo->consultar($id);

			require_once("vista/operativo/clasificacion/producto/producto.php");
			break;
		
		case 'consultarProductos':
			
			require_once("modelo/clasificacion.php");

			$id=$_GET["id"];
			$cata = $_GET["cata"];	
			$id = $_GET["id"];
			
			if(!empty($_GET["operativo"])){
				$operativo = $_GET["operativo"];
			}

			
			$consulta = new Clasificacion();
			$datos1 = $consulta->consultar_productos_1($id);
			$datos = $consulta->consultar_productos($id);

			//CONSULTAR TITULO CLASIFICACION
			$datos2 = $consulta->consultar_title($id);

			require_once("vista/operativo/clasificacion/con_clasificacion.php");
			break;

	  case 'registrarCatalogo-operativo':
			
			if (isset($_GET['cata'])) {
				
				$cata = $_GET['cata'];
				$clasificacion = $_POST['id_clasificacion'];
				$nombre_catalogo = $_POST['nombre_catalogo'];
				$nombre_catalogo = mb_convert_case($nombre_catalogo, MB_CASE_TITLE, "UTF-8");

				$resul=$catalogo->buscar_catalogo_($nombre_catalogo);

				if ($resul['estatus'] && count($resul)==2) {

					header("Location:?url=catalogo&opcion=consultarPuro&id=$clasificacion&cata=$cata&registroCatalogo=false");

				}else{

					$catalogo->setnombre_catalogo($nombre_catalogo);
					$catalogo->setid_clasificacion($clasificacion);

					$resul=$catalogo->Registrar();

					require_once("modelo/clasificacion.php");
					$consulta = new Clasificacion();

					$nombre_clasificacion = $consulta->buscar($clasificacion);
					foreach ($nombre_clasificacion as $nombre_clas) {
						
						$nombre_c = $nombre_clas['nombre_clasificacion'];
					}

								   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_clasificacion = $nomb;
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Registró el catalogo '.$nombre_catalogo." en la clasificación ".$nombre_c;
									
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

					header("Location:?url=catalogo&opcion=consultarPuro&id=$clasificacion&cata=$cata&registroCatalogo=true");
				}

			}else{ 

				$clasificacion = $_POST['clasificacion'];
				$nombre_catalogo = $_POST['nombre_catalogo'];
				$nombre_catalogo = mb_convert_case($nombre_catalogo, MB_CASE_TITLE, "UTF-8");
				$tipo = $_GET['tipo'];
				$id_o = $_GET['id_o'];
				$nuevo_registro = $_GET['nuevo_registro'];
				$ope = $_GET['ope']; 

				$resul=$catalogo->buscar_catalogo_($nombre_catalogo);

				if ($resul['estatus'] && count($resul)==2) {
					
				header("Location:?url=operativo&opcion=carrito&matriz=$tipo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&registroCatalogo=false");

				}else{

				$catalogo->setnombre_catalogo($nombre_catalogo);
				$catalogo->setid_clasificacion($clasificacion);

				$resul=$catalogo->Registrar();

				header("Location:?url=operativo&opcion=carrito&matriz=$tipo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&registroCatalogo=true");
			    }
			}
			break;

	case 'modificarCatalogo':
			
			if (isset($_GET['cata'])) {
				
				$cata = $_GET['cata'];
				$clasificacion = $_POST['id_clasificacion'];
				$nombre_catalogo = $_POST['nombre_catalogo'];
				$nombre_catalogo_anterior = $_POST['nombre_catalogo2'];
				$nombre_catalogo_anterior = mb_convert_case($nombre_catalogo_anterior, MB_CASE_TITLE, "UTF-8");
				$nombre_catalogo = mb_convert_case($nombre_catalogo, MB_CASE_TITLE, "UTF-8");
				$id_catalogo = $_POST['id_catalogo'];

				$resul=$catalogo->buscar_catalogo_($nombre_catalogo);

				if ($resul['estatus'] && count($resul)==2) {

					header("Location:?url=catalogo&opcion=consultarPuro&id=$clasificacion&cata=$cata&registroCatalogo=false");

				}else{

					$catalogo->setnombre_catalogo($nombre_catalogo);
					$catalogo->setid_clasificacion($clasificacion);

					require_once("modelo/clasificacion.php");
					$consulta = new Clasificacion();

					$nombre_clasificacion = $consulta->buscar($clasificacion);
					foreach ($nombre_clasificacion as $nombre_clas) {
						
						$nombre_c = $nombre_clas['nombre_clasificacion'];
					}

					require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_clasificacion = $nomb;
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Modificó el catalogo '.$nombre_catalogo_anterior." a ".$nombre_catalogo." en la clasificación ".$nombre_c;
									
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

					$resul = $catalogo ->modificarCatalogo($id_catalogo);

					header("Location:?url=catalogo&opcion=consultarPuro&id=$clasificacion&cata=$cata&actCatalogo=true");
				}
			}else{

			$clasificacion = $_POST['clasificacion'];

			$nombre_catalogo = $_POST['nombre_catalogo'];
			$id_catalogo = $_POST['id_catalogo'];

			$nombre_catalogo = mb_convert_case($nombre_catalogo, MB_CASE_TITLE, "UTF-8");
			
			$tipo = $_GET['tipo'];
			$id_o = $_GET['id_o'];
			$nuevo_registro = $_GET['nuevo_registro'];
			$ope = $_GET['ope']; 

			$resul=$catalogo->buscar_catalogo_($nombre_catalogo);

			if ($resul['estatus'] && count($resul)==2) {
				
			header("Location:?url=operativo&opcion=carrito&matriz=$tipo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&registroCatalogo=false");

			}else{

		    $catalogo->setnombre_catalogo($nombre_catalogo);
			$catalogo->setid_clasificacion($clasificacion);

			$nombre_catalogo_anterior = $_POST['nombre_catalogo2'];
			$nombre_catalogo_anterior = mb_convert_case($nombre_catalogo_anterior, MB_CASE_TITLE, "UTF-8");

			require_once("modelo/clasificacion.php");
					$consulta = new Clasificacion();

					$nombre_clasificacion = $consulta->buscar($clasificacion);
					foreach ($nombre_clasificacion as $nombre_clas) {
						
						$nombre_c = $nombre_clas['nombre_clasificacion'];
					}

					require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_clasificacion = $nomb;
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Modificó el catalogo '.$nombre_catalogo_anterior." a ".$nombre_catalogo." en la clasificación ".$nombre_c;
									
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

			$resul = $catalogo ->modificarCatalogo($id_catalogo);
			
			header("Location:?url=operativo&opcion=carrito&matriz=$tipo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&actCatalogo=true");

		  }
		}
		break;

	case 'eliminarCatalogo':
			
			if (isset($_GET['cata'])) {
				
				$cata = $_GET['cata'];
				$id_catalogo = $_GET['idCatalogo'];
				$clasificacion = $_GET['clasificacion'];

				/** BITACORA CATALOGO **/
				$datos=$catalogo->buscarCatalogo($id_catalogo);
				
				foreach ($datos as $nombre_catalogo) {
					
					$name_catalogo = $nombre_catalogo['nombre_catalogo'];

				}

				/** BITACORA CLASIFICACION **/
				require_once("modelo/clasificacion.php");
				$consulta = new Clasificacion();

				$nombre_clasificacion = $consulta->buscar($clasificacion);

				foreach ($nombre_clasificacion as $nombre_clas) {
								
							$nombre_c = $nombre_clas['nombre_clasificacion'];
				}
			
								   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();
					
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Eliminó el cátalogo '.$name_catalogo." de la clasificación ".$nombre_c;
									
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

									if ($respuesta['estatus'] == true) {
										
										$catalogo->eliminar($id_catalogo);

										header("Location:?url=catalogo&opcion=consultarPuro&deleteCatalogo=true&cata=$cata&id=$clasificacion");

									}
		

			}else{

			$tipo = $_GET['tipo'];
			$id_o = $_GET['id_o'];
			$nuevo_registro = $_GET['nuevo_registro'];
			$ope = $_GET['ope']; 

			$id_catalogo = $_GET['idCatalogo'];
			$catalogo->eliminar($id_catalogo);

			header("Location:?url=operativo&opcion=carrito&matriz=$tipo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&deleteCatalogo=true");
			}

	case 'consultarPuro':
	
			$cata = $_GET["cata"];	
			$id = $_GET["id"]; 	      
		
			$datos=$catalogo->consultar($id);

			require_once("vista/operativo/clasificacion/producto/producto.php");
			break;

}
?>
