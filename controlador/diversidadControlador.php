<?php

require_once("modelo/diversidad.php");
$diversidad = new Diversidad;

$opcion = $_GET['opcion'];

switch ($opcion) {
	
	case 'diversidadesCarrito':
	
		$tipo = $_GET['tipo'];
		$ope = $_GET['ope'];

		$array_para_recibir_via_url = stripslashes($tipo);
		$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
		$tipo = unserialize($array_para_recibir_via_url);
		
		$array_para_enviar_via_url = serialize($tipo);
		$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

		$id_o = $_GET["id_o"];
		$nuevo_registro = $_GET["nuevo_registro"];
		
		$identificacionCatalogo = $_GET['identificacionCatalogo'];
		
		$datos=$diversidad->consultar_carrito($identificacionCatalogo, $id_o);

		require_once("modelo/catalogo.php");
		$con2 = new Catalogo();

		$datos2=$con2->buscar_modificar($identificacionCatalogo);

		$boton=$diversidad->buscar_diversidad_carrito($id_o);

		require_once ("modelo/operativo.php");
		$operativo = new Operativo();
		$info = $operativo->buscar($id_o);
		
		require_once "vista/operativo/carrito/diversidad.php";
		break;

	case 'registrar':

		$nom=mb_strtoupper($_POST['descrip'], 'UTF-8'); 
		$nom = mb_convert_case($nom, MB_CASE_TITLE, "UTF-8");

		$marc=mb_strtoupper($_POST['marca'], 'UTF-8'); 
		$marc = mb_convert_case($marc, MB_CASE_TITLE, "UTF-8");

		$cont=mb_strtoupper($_POST['contenido'], 'UTF-8'); 
		$cont = mb_convert_case($cont, MB_CASE_TITLE, "UTF-8");

		$descrip=mb_strtoupper($_POST['descripcion'], 'UTF-8'); 
		$descrip = mb_convert_case($descrip, MB_CASE_TITLE, "UTF-8");

		if (isset($_POST['nuevo_registro'])) {
		
			$nuevo_registro = $_POST['nuevo_registro'];
			$tipo=$_POST['tipo'];
			$id_o=$_POST["id_o"];
			$ope = $_GET['ope'];
			$idCatalogo=$_POST['idCatalogo'];
		
		}else{

			$cata = $_GET['cata'];
			$idCatalogo = $_GET['idCatalogo'];
			$clasificacion = $_GET['clasificacion'];
		}		

		$diversidad->setnombre_diversidad($nom);
		$diversidad->setmarca($marc);
		$diversidad->setcontenido($cont);
		$diversidad->setdescripcion($descrip);
		$diversidad->setid_catalogo($idCatalogo);

		$resul = $diversidad->Registrar();

		require_once("modelo/catalogo.php");
		$consulta = new Catalogo();

		$nombre_catalogo = $consulta->buscarCatalogo($idCatalogo);

		foreach ($nombre_catalogo as $nombre_cat) {
			
			$nom_catalogo = $nombre_cat['nombre_catalogo'];
			$idClas = $nombre_cat['id_clasificacion'];

		}

		require_once("modelo/clasificacion.php");
		$consulta = new Clasificacion();

		$nombre_clasificacion = $consulta->buscar($idClas);
			
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

								   $accion = 'Registró el producto '.$nom." en el catalogo ".$nom_catalogo.", ubicado en la clasificación ".$nombre_c;
									
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

		if (isset($_GET['cata'])){

			header("Location:?url=diversidad&opcion=conDiversidad&idCatalogo=$idCatalogo&cata=$cata&clasificacion=$clasificacion&registroDiversidad=true");

		}else{

			if ($resul['estatus'] == true) {
				
				header("Location:?url=diversidad&opcion=diversidadesCarrito&tipo=$tipo&identificacionCatalogo=$idCatalogo&id_o=$id_o&nuevo_registro=$nuevo_registro&registroDiversidad=true&ope=$ope");
			}
		}
		break;
	
	case 'addProducto-carrito':
		
		$ope=$_GET['ope'];
		$nuevo_registro= $_GET['nuevo_registro']; 		
		$tipo=$_GET['tipo'];

		$array_para_recibir_via_url = stripslashes($tipo);
		$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
		$tipo = unserialize($array_para_recibir_via_url);


		$array_para_enviar_via_url = serialize($tipo);
		$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
	

		$id_o=$_GET['id_o'];
		$idCatalogo=$_GET['idCatalogo'];

		$producto=$_GET['producto'];
		
		$diversidad->setid_operativo_nuevo($id_o);
		$diversidad->setid_diversidad_operativo($producto);

		$datos=$diversidad->addDiversidad_carro();
		
		header("Location:?url=diversidad&opcion=diversidadesCarrito&tipo=$array_para_enviar_via_url&identificacionCatalogo=$idCatalogo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&on=true");

		break;

	case 'deleteProducto':
		
		$ope=$_GET['ope'];
		$nuevo_registro= $_GET['nuevo_registro']; 		
		$tipo=$_GET['tipo'];

		$array_para_recibir_via_url = stripslashes($tipo);
		$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
		$tipo = unserialize($array_para_recibir_via_url);

		$array_para_enviar_via_url = serialize($tipo);
		$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

		$id_o=$_GET['id_o'];
		$idCatalogo=$_GET['idCatalogo'];

		$producto=$_GET["producto"];

		$diversidad->deleteProducto_carro($producto, $id_o);
		
		header("Location:?url=diversidad&opcion=diversidadesCarrito&tipo=$array_para_enviar_via_url&identificacionCatalogo=$idCatalogo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&delete=true");

		break;

	case 'addCantidad':
		
		//Variables para redirigir de nuevo al lleno del operativo de diversidades
		$ope=$_GET['ope'];
		$nuevo_registro= $_GET['nuevo_registro']; 		
		$tipo=$_GET['tipo'];
		$id_o=$_GET['id_o'];

		$array_para_recibir_via_url = stripslashes($tipo);
		$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
		$tipo = unserialize($array_para_recibir_via_url);

		$array_para_enviar_via_url = serialize($tipo);
		$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

		$idCatalogo=$_GET['idCatalogo'];

		//Variables para registrar en la tabla puente
		$cantidad=$_POST['cant'];
   		$id_Odiversidad=$_POST["id_Odiversidad"];

 	    $diversidad->setcantidad_por_persona($cantidad);
		$datos=$diversidad->modificarCantidad($id_Odiversidad);
		
		header("Location:?url=diversidad&opcion=diversidadesCarrito&tipo=$array_para_enviar_via_url&identificacionCatalogo=$idCatalogo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&cant=true");

		break;

	case 'actualizarDiversidad':
		

		$nom=mb_strtoupper($_POST['descrip'], 'UTF-8'); 
		$nom = mb_convert_case($nom, MB_CASE_TITLE, "UTF-8");

		$marc=mb_strtoupper($_POST['marca'], 'UTF-8'); 
		$marc = mb_convert_case($marc, MB_CASE_TITLE, "UTF-8");

		$cont=mb_strtoupper($_POST['contenido'], 'UTF-8'); 
		$cont = mb_convert_case($cont, MB_CASE_TITLE, "UTF-8");

		$descrip=mb_strtoupper($_POST['descripcion'], 'UTF-8'); 
		$descrip = mb_convert_case($descrip, MB_CASE_TITLE, "UTF-8");

		$id_diversidad =$_POST['id_diversidad'];

		if (isset($_POST['nuevo_registro'])) {
		
			//Variables para redirigir de nuevo al lleno del operativo de diversidades
			$ope=$_POST['ope'];
			$nuevo_registro= $_POST['nuevo_registro']; 		
			$tipo=$_POST['tipo'];
			$id_o=$_POST['id_o'];
			$idCatalogo =$_POST['idCatalogo'];

			$array_para_recibir_via_url = stripslashes($tipo);
			$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
			$tipo = unserialize($array_para_recibir_via_url);

			$array_para_enviar_via_url = serialize($tipo);
			$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

		}else{

			$cata = $_GET['cata'];
			$idCatalogo = $_GET['idCatalogo'];
			$clasificacion = $_GET['clasificacion'];
		}

		$diversidad->setnombre_diversidad($nom);
		$diversidad->setmarca($marc);
		$diversidad->setcontenido($cont);
		$diversidad->setdescripcion($descrip);
		$diversidad->setid_catalogo($idCatalogo);

		if (isset($_POST['cant'])) {

			$cantidad = $_POST['cant'];
			$id_Odiversidad =$_POST['id_Odiversidad'];
			
			$diversidad->setcantidad_por_persona($cantidad);
			$diversidad->modificarCantidad($id_Odiversidad);
		}

		/** BITACORA CATALOGO **/ 
		require_once("modelo/catalogo.php");
		$consulta = new Catalogo();

		$nombre_catalogo = $consulta->buscarCatalogo($idCatalogo);

		foreach ($nombre_catalogo as $nombre_cat) {
			
			$nom_catalogo = $nombre_cat['nombre_catalogo'];
			$idClas = $nombre_cat['id_clasificacion'];

		}

		/** BITACORA CLASIFICACION **/
		require_once("modelo/clasificacion.php");
		$consulta = new Clasificacion();

		$nombre_clasificacion = $consulta->buscar($idClas);

		foreach ($nombre_clasificacion as $nombre_clas) {
						
					$nombre_c = $nombre_clas['nombre_clasificacion'];
		}

								   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();
					
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Modificó el producto '.$nom." del catalogo de ".$nom_catalogo.", ubicado en la clasificación ".$nombre_c;
									
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

					$resulRegistrar=$diversidad->modificarDiversidad($id_diversidad);

		if (isset($_GET['cata'])){

			header("Location:?url=diversidad&opcion=conDiversidad&idCatalogo=$idCatalogo&cata=$cata&clasificacion=$clasificacion&act_producto=true");

		}else{

			header("Location:?url=diversidad&opcion=diversidadesCarrito&tipo=$array_para_enviar_via_url&identificacionCatalogo=$idCatalogo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&act_producto=true");
		}

		break;

	case 'eliminarDiversidad':
		
		$producto = $_GET["producto"];

		if (!empty($_POST['nuevo_registro'])) {
		
			//Variables para redirigir de nuevo al lleno del operativo de diversidades
			$ope=$_GET['ope'];
			$nuevo_registro= $_GET['nuevo_registro']; 		
			$tipo=$_GET['tipo'];
			$id_o=$_GET['id_o'];
			$idCatalogo =$_GET['idCatalogo'];

			$array_para_recibir_via_url = stripslashes($tipo);
			$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
			$tipo = unserialize($array_para_recibir_via_url);

			$array_para_enviar_via_url = serialize($tipo);
			$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

		}else{

			$cata = $_GET['cata'];
			$idCatalogo = $_GET['idCatalogo'];
			$clasificacion = $_GET['clasificacion'];

		}
		

		/** BITACORA CATALOGO **/ 
		require_once("modelo/catalogo.php");
		$consulta = new Catalogo();

		$nombre_catalogo = $consulta->buscarCatalogo($idCatalogo);

		foreach ($nombre_catalogo as $nombre_cat) {
			
			$nom_catalogo = $nombre_cat['nombre_catalogo'];
			$idClas = $nombre_cat['id_clasificacion'];

		}

		/** BITACORA CLASIFICACION **/
		require_once("modelo/clasificacion.php");
		$consulta = new Clasificacion();

		$nombre_clasificacion = $consulta->buscar($idClas);

		foreach ($nombre_clasificacion as $nombre_clas) {
						
					$nombre_c = $nombre_clas['nombre_clasificacion'];
		}

		/** BITACORA PRODUCTO **/
		$producto_nombre = $diversidad->consultar_solo($producto);
		foreach ($producto_nombre as $nombre_p) {
			
			$name_producto = $nombre_p['nombre_diversidad'];
		}
			
								   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();
					
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Eliminó el producto '.$name_producto." del catalogo de ".$nom_catalogo.", ubicado en la clasificación ".$nombre_c;
									
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
										
										$diversidad->eliminar($producto);

										$cata = $_GET['cata'];
										$idCatalogo = $_GET['idCatalogo'];
										$clasificacion = $_GET['clasificacion'];

										if (isset($_GET['cata'])){

											header("Location:?url=diversidad&opcion=conDiversidad&idCatalogo=$idCatalogo&cata=$cata&clasificacion=$clasificacion&delete=true");

										}else{

											$ope=$_GET['ope'];
											$nuevo_registro= $_GET['nuevo_registro']; 		
											$tipo=$_GET['tipo'];
											$id_o=$_GET['id_o'];
											$idCatalogo =$_GET['idCatalogo'];

											$array_para_recibir_via_url = stripslashes($tipo);
											$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
											$tipo = unserialize($array_para_recibir_via_url);

											$array_para_enviar_via_url = serialize($tipo);
											$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

											header("Location:?url=diversidad&opcion=diversidadesCarrito&tipo=$array_para_enviar_via_url&identificacionCatalogo=$idCatalogo&id_o=$id_o&nuevo_registro=$nuevo_registro&ope=$ope&delete=true");

											
										}

									}		
		
		break;

	case 'conDiversidad':
		
		$cata = $_GET["cata"];	
		$idCatalogo = $_GET["idCatalogo"];
		$clasificacion = $_GET["clasificacion"]; 	
   		
   		require_once ("modelo/catalogo.php");

		$catalogo= new Catalogo();
    	$datos = $diversidad->buscarDiversidades($idCatalogo);
    	$datosCatalogo = $catalogo->buscarCatalogo($idCatalogo);

		require_once "vista/operativo/clasificacion/producto/producto_2/producto_2.php";

		break;
}

?>