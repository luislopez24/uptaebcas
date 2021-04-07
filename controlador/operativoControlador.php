<?php

require_once ("modelo/operativo.php");

$operativo = new Operativo();
$opcion = $_GET['opcion'];

switch ($opcion) {

	case 'inicioOperativo':
		
		require_once("vista/operativo/operativo.php");
		break;

	case 'operativo':
		
		require_once("vista/operativo/r_operativo.php");
		break;

	case 'formularioOperativo':
		
		require_once ("modelo/clasificacion.php");

		$con= new Clasificacion();
	    $datos=$con->consultar();
		
		require_once("vista/operativo/operativo_regis.php");
		break;

	case 'consulta_operativo_index':

			$id = $_GET['id'];
			//Datos del operativo registrado
   			$datosOperativo=$operativo->buscar($id);
		    
		    //PARA NO HACER REPETIR LO DE ARRIBA DEPENDIENDO DE CUANTOS PRODUCTOS HAYAN
		    $diversidadesRegistradas=$operativo->buscarDiversidades_operativo($id);
			$clasificacionDelOperativo = $operativo->clasificacionDelOperativo($id);
	
		require_once("vista/operativo/con_operativo_inicio.php");
		break;

	case 'fecha_limite':
	
		$id=$_POST['id'];
		$clausura='clau';

		$operativo->setestado($clausura);
		$modificarResultado=$operativo->publicar($id);		

		header("Location: ?url=index");
		break;

	case 'registrar':
		
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

		$nomb = mb_strtoupper($_POST['nombre'], 'UTF-8');
		$nomb = mb_convert_case($nomb, MB_CASE_TITLE, "UTF-8");

		$result = $operativo -> buscar_operativo($nomb);

		    foreach ($result as $datos) {
		    	
		    	if (isset($datos['nombre_operativo'])) {
		    		
		    		$cono = 1;
		    		header("location: ?url=operativo&opcion=formularioOperativo&errornom=true");
		    	}
		    }

		    if (!isset($cono)) {

				//Eliminamos las cookies 
				setcookie("nombre", "eliminar",time() - 86400);
				setcookie("nombre", "eliminar", time() - 86400);
				setcookie("fechaf", "eliminar", time() - 86400);
				setcookie("fechai", "eliminar", time() - 86400);
				setcookie("precio", "eliminar", time() - 86400);
				setcookie("descrip", "eliminar", time() - 86400);

				/*--------- FOTO DE PERFIL ---------*/
				$ruta = 'vista/config/img/operativo/'.$nomb.'-'.$_FILES['foto_perfil']['name'];
				move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta);

				$precio = $_POST['precio'];
				$fechai = $_POST['fechai'];
				$fechaf = $_POST['fechaf'];
				$tipoo = $_POST['tipoo'];
				$estado = 'off';

				$array_para_enviar_via_url = serialize($tipoo);
				$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
			
				$descrip = mb_strtoupper($_POST['descrip'], 'UTF-8');
				$descrip = mb_convert_case($descrip, MB_CASE_TITLE, "UTF-8");
				$banco=$_POST['banco'];

				$operativo->setnombre_operativo($nomb);
				$operativo->setprecio_operativo($precio);
				$operativo->setfecha_inicio_operativo($fechai);
				$operativo->setfecha_final_operativo($fechaf);
				$operativo->setDescripcion($descrip);
				$operativo->setBanco_admitido($banco);
				$operativo->setestado($estado);
				$operativo->setFoto($ruta);

				$resul=$operativo->Registrar();

					if ($resul['estatus']==false) {
							
							require_once('vista/publico/Head-login2.php');	
							echo "<script>jQuery(function(){
				        				swal({
				        					type: 'error',
				        					title: '¡Oppss..!',
				        					text: 'Hubo un error al registrar'
				        				})
				        			})
							  </script>";

							 header("Location:?url=operativo&opcion=formularioOperativo");
				        
						}else{
							
								$consultar_id = $operativo->ultimo_id();

								foreach ($consultar_id as $key):
									$ultimo_id = $key['id'];

									header("Location: ?url=operativo&opcion=carrito&id_o=$ultimo_id&ope=false&paso_1=true&matriz=$array_para_enviar_via_url&nuevo_registro=true");
								
								endforeach;

								}
		}

		break;

		case 'carrito':
			
			require_once ("modelo/catalogo.php");
				
				$array = $_GET['matriz'];
				$ope = $_GET['ope'];
				
				$array_para_recibir_via_url = stripslashes($array);
				$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
				$tipo = unserialize($array_para_recibir_via_url);
				
				$array_para_enviar_via_url = serialize($tipo);
				$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

				$id_o=$_GET['id_o'];

				if (!empty($_GET['nuevo_registro'])) {

					$nuevo_registro=  $_GET['nuevo_registro'];
				}
				
				//Para mostrar el catalogo de todas las clasificaciones seleccionadas en el formulario del operativo
				$catalogo = new Catalogo();
			    $datos = $catalogo->catalogoGeneral();
			
				require_once ("modelo/diversidad.php");

				$diversidad = new Diversidad();
			    //Para obligar al usuario a registrar al menos un producto en el operativo
			    $contador=$diversidad->contador_seleccionado($id_o);
				$boton=$diversidad->buscar_diversidad_carrito($id_o);
			    
			    //Para registrara un nuevo catalogo dentro del operativo nuevo
				require_once ("modelo/clasificacion.php");
				$clasificacion = new Clasificacion();

				$datosClasificacion = $clasificacion->consultar();

				$info = $operativo->buscar($id_o);

				require_once("vista/operativo/carrito/carrito.php");
			    
			break;

		case 'eliminarUltimoRegistro':
			
				$id_o=$_GET["id"];
				$operativo->eliminar($id_o);
	
				header("Location:?url=operativo&opcion=operativo&delete=true");		
			break;

		case 'registroFinal':
			
			$ope=$_GET['ope'];
			$id = $_GET['id'];

			$array = $_GET['matriz'];
			
			$array_para_recibir_via_url = stripslashes($array);
			$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
			$tipo = unserialize($array_para_recibir_via_url);

			$array_para_enviar_via_url = serialize($tipo);
			$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
			//Datos del operativo registrado
   			$datosOperativo=$operativo->buscar($id);
		    
		    //PARA NO HACER REPETIR LO DE ARRIBA DEPENDIENDO DE CUANTOS PRODUCTOS HAYAN
		    $diversidadesRegistradas=$operativo->buscarDiversidades_operativo($id);
			$clasificacionDelOperativo = $operativo->clasificacionDelOperativo($id);

			foreach ($datosOperativo as $operativoDatos) {

								   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_operativo = $operativoDatos['nombre_operativo'];
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Registró exitosamente el operativo '.$nombre_operativo;
									
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

							}

			require_once("vista/operativo/con_operativo.php");
			break;

	  	case 'modificar':

	  		if (isset($_GET['fechaFinal'])) {
	  			
	  			$banco =  $_POST['banco'];
		  		$id_o=$_POST['id_o'];
		  	
				$nomb=mb_strtoupper($_POST['nombre'], 'UTF-8');
				$nomb = mb_convert_case($nomb, MB_CASE_TITLE, "UTF-8");
				$precio=$_POST['precio'];
				$fechai=$_POST['fechai'];
				$fechaf= $_POST['fechaf'];
				$descrip=mb_strtoupper($_POST['descrip'], 'UTF-8');
				$descrip = mb_convert_case($descrip, MB_CASE_TITLE, "UTF-8");
				$ruta = $_POST['foto_ruta'];
				
				$operativo->setnombre_operativo($nomb);
				$operativo->setprecio_operativo($precio);
				$operativo->setfecha_inicio_operativo($fechai);
				$operativo->setfecha_final_operativo($fechaf);
				$operativo->setDescripcion($descrip);
				$operativo->setBanco_admitido($banco);
				$operativo->setFoto($ruta);

				$estatud=$_POST['estado'];

				$operativo->setestado($estatud);
				$datos=$operativo->publicar($id_o);

				$modificarResultado=$operativo->Modificar($id_o);

				require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_operativo = $nomb;
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Modificó la fecha del operativo caducado '.$nombre_operativo;
									
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

				header("Location: ?url=operativo&opcion=inicioPublicar&renova=true");

		  		break;

	  		}else{

	  		$banco =  $_POST['banco'];
	  		$id_o=$_POST['id_o'];
	  		$array = $_GET['tipo'];
	  		$ope = $_GET['ope'];

	  		$array_para_recibir_via_url = stripslashes($array);
			$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
			$tipo = unserialize($array_para_recibir_via_url);

			$array_para_enviar_via_url = serialize($tipo);
			$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);
		
			$nomb=mb_strtoupper($_POST['nombre'], 'UTF-8');
			$nomb = mb_convert_case($nomb, MB_CASE_TITLE, "UTF-8");

			/*--------- FOTO DE PERFIL ---------*/

			$asd = $_FILES['foto_perfil']['name']; 
		
			if (!empty($asd)) {
				
				$ruta = 'vista/config/img/operativo/'.$nomb.'-'.$_FILES['foto_perfil']['name'];
				move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta);

			}else{

				$ruta = $_POST['foto_ruta'];
			}	

			$precio=$_POST['precio'];
		
			$fechai=$_POST['fechai'];
			$fechaf= $_POST['fechaf'];
			$descrip=mb_strtoupper($_POST['descrip'], 'UTF-8');
			$descrip = mb_convert_case($descrip, MB_CASE_TITLE, "UTF-8");
			
			$operativo->setnombre_operativo($nomb);
			$operativo->setprecio_operativo($precio);
			$operativo->setfecha_inicio_operativo($fechai);
			$operativo->setfecha_final_operativo($fechaf);
			$operativo->setDescripcion($descrip);
			$operativo->setBanco_admitido($banco);
			$operativo->setFoto($ruta);

			$modificarResultado=$operativo->Modificar($id_o);

			   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_operativo = $nomb;
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Modificó el operativo '.$nombre_operativo;
									
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

			if ($ope == 'consultar') {
				
				header("Location: ?url=operativo&opcion=consultarOperativos&actOperativo=true");

			}else{

		    if ($modificarResultado['estatus']==true) {
					
				header("Location:?url=operativo&opcion=registroFinal&matriz=$array_para_enviar_via_url&ope=$ope&id=$id_o&actOperativo=true");
				}
			}
			
	  		break;
	  		}

	  	case 'eliminar':
	  		
	  		$array = $_GET['tipo'];

	  		$array_para_recibir_via_url = stripslashes($array);
			$array_para_recibir_via_url = urldecode($array_para_recibir_via_url );
			$tipo = unserialize($array_para_recibir_via_url);

			$array_para_enviar_via_url = serialize($tipo);
			$array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

			$ope=$_GET['ope'];
			$id_o=$_GET["id"];

			$datosOperativo=$operativo->buscar($id_o);
					
					foreach ($datosOperativo as $operativoDatos) {
								   require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_operativo = $operativoDatos['nombre_operativo'];
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   $accion = 'Eliminó el operativo '.$nombre_operativo;

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
										
										$operativo->eliminar($id_o);


										if ($ope == 'consultar') {

												header("Location: ?url=operativo&opcion=consultarOperativos&deleteOperativo=true");
										
											}else{
												
												header("Location: ?url=operativo&opcion=operativo&deleteOperativo=true");
											}

									}

							}

	  		break;

	  	case 'inicioPublicar':
	  		
     		$datosOperativo = $operativo->consultar_productos_en_el_operativo();
            require_once("vista/operativo/publicar.php");
	  		break;
 
	  	case 'consultarOperativos':
	  		
		    $datosOperativo = $operativo->consultarRegistros();
		    $datosClasificacion = $operativo->consultarClasificacion();

		    require_once ("modelo/clasificacion.php");
			$clasificacion = new Clasificacion();

			$clasificaciones = $clasificacion->consultar();

			require_once("vista/operativo/consultar_operativo.php");
	  		break;

	  	case 'publicar':

	  		$id=$_GET['id'];
			$estatud=$_GET['estado'];

			$datosO=$operativo->buscar($id);

			$email ='';

			$datosOperativo = $operativo->buscar($id);
 
			require_once ("modelo/usuario.php");
			$usuario = new usuario();

			$beneficiario = $usuario->consultarPuroBeneficiario();

			$asunto = "Nuevo evento CAS";

			if ($estatud == 'on') {

				foreach ($datosOperativo as $operativo):
					
					foreach ($beneficiario as $Datosbeneficiario) {
					
		$mensaje= "*Muy buen dia beneficiario ".$Datosbeneficiario['nombre']." ".$Datosbeneficiario['apellido']."*<br><br>
					
					*¡El Software CAS le notifica que hay un nuevo operativo disponible, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>

					- Nombre del operativo: ".$operativo['nombre_operativo']."<br><br>
					- Su costo: ".$operativo['precio_operativo']."<br><br>
					- Fecha de inicio: ".$operativo['fecha_inicio_operativo']."<br><br>
					- Fecha de caducidad: ".$operativo['fecha_final_operativo']."<br><br>
					- Descripcion del operativo: ".$operativo['descripcion']."<br><br>
					- Banco admitido: ".$operativo['banco_admitido']."<br><br>

					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>";

					$para = $Datosbeneficiario['id_usuario'];

					require_once ("modelo/notificacion.php");
					$notificacion= new Notificacion();
			  		
			  		$fotoEmisor = 2;
					$idEmisor = 0;
					
					$idReceptor = $para;
					$asunt = $asunto; 
					$msj = $mensaje;
					$tipo = 1; //mensaje CAS 
					$fav = 0; //sin marcar aun favorito por el receptor
					$dateTime = date('Y-m-d H:i:s');

						$notificacion->setfoto_icono($fotoEmisor);
						$notificacion->setIdUser($idEmisor);
						$notificacion->setIdReceptor($idReceptor);
						$notificacion->setAsunto($asunt);
						$notificacion->setMensaje($msj);
						$notificacion->setTipo($tipo);
						$notificacion->setFavorito($fav);
						$notificacion->setFecha($dateTime);

						$notificacion->RegistrarNotificacion();
				}

				endforeach;
				
				require_once ("modelo/operativo.php");

				$operativo = new Operativo();

				$email = 'true';
				$operativo->setestado($estatud);
				$datos=$operativo->publicar($id);

			}

			if ($estatud == 'off') {

				foreach ($datosOperativo as $operativo):
					
					foreach ($beneficiario as $Datosbeneficiario) {
					
		$mensaje= "*Muy buen dia beneficiario ".$Datosbeneficiario['nombre']." ".$Datosbeneficiario['apellido']."*<br><br>
					
					*El Software CAS le notifica que el operativo ".$operativo['nombre_operativo']." a sido pausado por los momentos. 

					<br><br>¡Les invitamos a mantenerse atentos en la activación del mismo!<br><br>";

					$para = $Datosbeneficiario['id_usuario'];

					require_once ("modelo/notificacion.php");
					$notificacion= new Notificacion();
			  		
			  		$fotoEmisor = 2;
					$idEmisor = 0;
					
					$idReceptor = $para;
					$asunt = "Evento CAS pausado"; 
					$msj = $mensaje;
					$tipo = 1; //mensaje CAS 
					$fav = 0; //sin marcar aun favorito por el receptor
					$dateTime = date('Y-m-d H:i:s');

						$notificacion->setfoto_icono($fotoEmisor);
						$notificacion->setIdUser($idEmisor);
						$notificacion->setIdReceptor($idReceptor);
						$notificacion->setAsunto($asunt);
						$notificacion->setMensaje($msj);
						$notificacion->setTipo($tipo);
						$notificacion->setFavorito($fav);
						$notificacion->setFecha($dateTime);

						$notificacion->RegistrarNotificacion();

				}

				endforeach;
				
				require_once ("modelo/operativo.php");

				$operativo = new Operativo();

				$email = 'true';
				$operativo->setestado($estatud);
				$datos=$operativo->publicar($id);

			}
				
		
			if($email == 'true'){

				 foreach ($datosO as $nombre) {
				
				require_once 'modelo/bitacora.php';

			  				  	   $bitacora = new Bitacora();

			  				  	   $nombre_operativo = $nombre['nombre_operativo'];
												
								   $id_usuario = $_SESSION['id_ussuario'];
								   $fecha = $date;

								   date_default_timezone_set('America/Caracas');
														
								   $hora = date("H:i:s");

								   if ($estatud == 'on') {
				
										 $accion = 'Publicó el operativo '.$nombre_operativo;	

									}else{

										 $accion = 'Ocultó el operativo '.$nombre_operativo;

									}

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

									if ($estatud == 'on') {
				
										header("Location:?url=operativo&opcion=inicioPublicar&actpubli=true");	

									}else{

										header("Location:?url=operativo&opcion=inicioPublicar&ocul=true");

									}	
			}

		} else {
				
				if ($estatud == 'off') {
					
					header("Location:?url=operativo&opcion=inicioPublicar&errorConexion=true");	

				}else{

					header("Location:?url=operativo&opcion=inicioPublicar&errorConex=true");	
				}
				
			}
				
	  		break;
			

	  	case 'inicioDistribucion':
	      	
	      	//Consulta los operativos activos
			$operativosOn=$operativo->consultar_publicacion();

			require_once("vista/generar_dis/generar_dis.php");
	  		break;

	  	case 'check_operativo':

				sleep(1);

					if (isset($_POST)) {

					    $nombre = (string)$_POST['nombre'];
					 
					    $result = $operativo->buscar_operativo($nombre);

					    foreach ($result as $datos) {
					    	
					    	if (isset($datos['nombre_operativo'])) {
					    		
					    		$cono = '<div class="alert alert-danger" style="color: red;"><strong>Oh no!</strong> Este operativo se encuentra registrado.</div>';
					    	}
					    }

					    if (!isset($cono)) {
					    	
					    	$cono = '<div class="alert alert-success" style="color: green;"><strong>Enhorabuena!</strong> Operativo no registrado.</div>';
					    }

					    echo $cono;
					  }
		break;

}
?>
