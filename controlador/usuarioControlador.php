<?php

require_once ("modelo/usuario.php");
$usuario= new usuario();

$opcion = $_GET['opcion'];

$permisosSuperu = array(
							     1 => "1", // registrar usuarios
							     2 => "2", // modificar usuarios
							     3 => "3", // eliminar usuarios
							     4 => "4", // registrar beneficiarios
							     5 => "5", // modificar beneficiarios
							     6 => "6", // eliminar beneficiarios
							     7 => "7", // registrar operativos
							     8 => "8", // modificar operativos
							     9 => "9", // eliminar operativos
							    10 => "10",// añadir productos al operativo
							    11 => "11",// publicar operativos
							    12 => "12",// distribuir operativos
							    13 => "13",// registrar pagos
							    14 => "14",// modificar pagos
							    15 => "15",// registrar clasificacion
							    16 => "16",// modificar clasificacion
							    17 => "17",// eliminar clasificacion 
							    18 => "18",// registrar catalogos
							    19 => "19",// modificar catalogos
							    20 => "20",// eliminar catalogos
							    21 => "21",// registrar diversidad
							    22 => "22",// modificar diversidad
							    23 => "23",// eliminar diversidad 
							    24 => "24",// exportar bitacoras
							    25 => "25",// eliminar bitacoras 
							    26 => "26",// seguridad avanzada 
							    27 => "27",// visualizar estadisticas
							    28 => "28",// generar reportes
							);

$permisosAdministrador = array(
							     1 => "1", // registrar usuarios
							     2 => "2", // modificar usuarios
							     3 => "3", // eliminar usuarios
							     4 => "4", // registrar beneficiarios
							     5 => "5", // modificar beneficiarios
							     6 => "6", // eliminar beneficiarios
							     7 => "7", // registrar operativos
							     8 => "8", // modificar operativos
							     9 => "9", // eliminar operativos
							    10 => "10",// añadir productos al operativo
							    11 => "11",// publicar operativos
							    12 => "12",// distribuir operativos
							    15 => "15",// registrar clasificacion
							    16 => "16",// modificar clasificacion
							    17 => "17",// eliminar clasificacion 
							    18 => "18",// registrar catalogos
							    19 => "19",// modificar catalogos
							    20 => "20",// eliminar catalogos
							    21 => "21",// registrar diversidad
							    22 => "22",// modificar diversidad
							    23 => "23",// eliminar diversidad 
							    24 => "24",// exportar bitacoras
							    25 => "25",// eliminar bitacoras 
							    26 => "26",// seguridad avanzada 
							    27 => "27",// visualizar estadisticas
							    28 => "28",// generar reportes
							);

$permisosOperador = array(
						         4 => "4", // registrar beneficiarios
							     5 => "5", // modificar beneficiarios
							     6 => "6", // eliminar beneficiarios
							    12 => "12",// distribuir operativos
							    28 => "28",// generar reportes
							);

$permisosBeneficiario = array(
							    13 => "13",// registrar pagos
							    14 => "14",// modificar pagos
							);

require_once ("modelo/notificacion.php");
$notificacion= new Notificacion();

switch ($opcion) {

	case 'registroNuevo':

	$ci=$_POST['ci'];

	$result = $usuario -> buscar_ci($ci);

	foreach ($result as $datos) {

		if (isset($datos['cedula'])) {

			$cono = 1;
			header("location: ?paso=usuario&opcion=newLogin&errorci=true");
		}
	}

	if (!isset($cono)) {

		$nom = mb_strtoupper($_POST['nom'], 'UTF-8'); 
		$nom = mb_convert_case($nom, MB_CASE_TITLE, "UTF-8");

		$ape = mb_strtoupper($_POST['ape'], 'UTF-8'); 
		$ape = mb_convert_case($ape, MB_CASE_TITLE, "UTF-8");

		$tci=strtoupper($_POST['tci']);

		$fechan=$_POST['fechan'];

		$correo=mb_strtoupper($_POST['correo'], 'UTF-8'); 
		$correo = mb_convert_case($correo, MB_CASE_TITLE, "UTF-8");

		$tcorreo = $_POST['tcorreo'];
		$tcel = $_POST['tcel'];
		$cel = $_POST['cel'];

		$are = mb_strtoupper($_POST['are'], 'UTF-8'); 
		$are = mb_convert_case($are, MB_CASE_TITLE, "UTF-8");

		$direc=mb_strtoupper($_POST['direc'], 'UTF-8'); 
		$direc = mb_convert_case($direc, MB_CASE_TITLE, "UTF-8");

		$area = $_POST['tipo'];

		if ($area == '4') {
								
			$area = 'Docente';
		}

		if ($area == '5') {
								
			$area = 'Administrativo';
		}

		if ($area == '6') {
								
			$area = 'Obrero';
		}
		
		$tipo = '4';

		$passw = $_POST['password'];
		
		$options = [
		    'cost' => 7,
		    'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

		$passw = password_hash($passw, PASSWORD_BCRYPT, $options);

		require_once ("modelo/seguridad.php");
		$seguridad = new Seguridad();

		$idRol = $tipo;
		$respuestaRol = $seguridad->Buscar_rol($idRol);

		foreach ($respuestaRol as $key) {

			$tatu = $key['statusRol'];

			$usuario->setNombre($nom);
			$usuario->setApellido($ape);
			$usuario->setTcedula($tci);
			$usuario->setCedula($ci);
			$usuario->setFecha_n($fechan);
			$usuario->setEmail($correo);
			$usuario->setTemail($tcorreo);
			$usuario->setTcelular($tcel);
			$usuario->setCelular($cel);
			$usuario->setDependencia($are);
			$usuario->setDireccion($direc);
			$usuario->setArea($area);
			$usuario->setRol($tipo);
			$usuario->setContrasena($passw);
			$usuario->setEstatus($tatu);
			
			$resultado = $usuario->Registrar();

			$idUsuario_registrado = $usuario->ultimo_idUsuario();

			foreach ($idUsuario_registrado as $ultimoID):

				$ultimoRegistro = $ultimoID['id'];

			endforeach;

			require_once ("modelo/seguridad.php");
			$seguridad = new Seguridad();

			foreach ($permisosBeneficiario as $permiso) {

				$seguridad->setIdUsuario($ultimoRegistro);
				$seguridad->setIdPermiso($permiso);
				$seguridad->actualizarPermisoUsuario();

			}

			

		}

		if ($resultado['estatus'] == true) {

			$asunto = "Sistema CAS"; 
				$mensaje= "*Muy buen dia ".$nom." ".$ape."*<br><br>
					
					*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>";

					$para = $ultimoRegistro;

			  		$fotoEmisor = 1;
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

			require_once 'modelo/bitacora.php';

			$bitacora = new Bitacora();


			$id_usuario = $ultimoRegistro;
			$fecha = $date;

			date_default_timezone_set('America/Caracas');

			$hora = date("H:i:s");
			$accion = 'Nuevo beneficiario registrado, con cedula: '.$ci;

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

            header("location: ?url=inicio&registroLogin=true");
            

					} 
				}

				break;

				case 'newLogin':

				require_once ("vista/login/nuevo_usuario/new_user.php");
				break;

	//Inicio de la pagina principal para gestionar los usuarios
				case 'inicio':

				require_once("vista/usuario/usuario.php");
				break;

	//Pagina para registrar el usuario
				case 'formulario_registro':

				require_once "vista/usuario/formularioU.php";
				break;

	//Opcion para registrar el usuario
				case 'registro_usuario':

				$ci=$_POST['ci'];

				$result = $usuario -> buscar_ci($ci);

				foreach ($result as $datos) {

					if (isset($datos['cedula'])) {

						$cono = 1;
						header("location: ?url=usuario&opcion=formulario_registro&errorci=true");
					}
				}

				if (!isset($cono)) {

					$nom = mb_strtoupper($_POST['nom'], 'UTF-8'); 
					$nom = mb_convert_case($nom, MB_CASE_TITLE, "UTF-8");

					$ape = mb_strtoupper($_POST['ape'], 'UTF-8'); 
					$ape = mb_convert_case($ape, MB_CASE_TITLE, "UTF-8");

					$tci=strtoupper($_POST['tci']);

					$fechan=$_POST['fechan'];

					$correo=mb_strtoupper($_POST['correo'], 'UTF-8'); 
					$correo = mb_convert_case($correo, MB_CASE_TITLE, "UTF-8");

					$tcorreo = $_POST['tcorreo'];
					$tcel = $_POST['tcel'];
					$cel = $_POST['cel'];

					$are = mb_strtoupper($_POST['are'], 'UTF-8'); 
					$are = mb_convert_case($are, MB_CASE_TITLE, "UTF-8");

					$direc=mb_strtoupper($_POST['direc'], 'UTF-8'); 
					$direc = mb_convert_case($direc, MB_CASE_TITLE, "UTF-8");

					$tipo = $_POST['tipo'];
					$passw = $_POST['ci'];

					$options = [
					    'cost' => 7,
					    'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

					$passw = password_hash($passw, PASSWORD_BCRYPT, $options);

					$area = 'System'; 

					require_once ("modelo/seguridad.php");
					$seguridad = new Seguridad();

					$idRol = $tipo;
					$respuestaRol = $seguridad->Buscar_rol($idRol);

					foreach ($respuestaRol as $key) {

						$tatu = $key['statusRol'];

						$usuario->setNombre($nom);
						$usuario->setApellido($ape);
						$usuario->setTcedula($tci);
						$usuario->setCedula($ci);
						$usuario->setFecha_n($fechan);
						$usuario->setEmail($correo);
						$usuario->setTemail($tcorreo);
						$usuario->setTcelular($tcel);
						$usuario->setCelular($cel);
						$usuario->setArea($area);
						$usuario->setDependencia($are);
						$usuario->setDireccion($direc);
						$usuario->setRol($tipo);
						$usuario->setContrasena($passw);
						$usuario->setEstatus($tatu);


						$resultado = $usuario->Registrar();
						$idUsuario_registrado = $usuario->ultimo_idUsuario();
						
					}

						foreach ($idUsuario_registrado as $ultimoID):
							
							$ultimoRegistro = $ultimoID['id'];

						endforeach;


						require_once ("modelo/seguridad.php");
						$seguridad = new Seguridad();

						if ($tipo == '2') {
							
							foreach ($permisosAdministrador as $permiso) {

								$seguridad->setIdUsuario($ultimoRegistro);
								$seguridad->setIdPermiso($permiso);
								$seguridad->actualizarPermisoUsuario();

							}
						}

						if ($tipo == '3') {
							
							foreach ($permisosOperador as $permiso) {

								$seguridad->setIdUsuario($ultimoRegistro);
								$seguridad->setIdPermiso($permiso);
								$seguridad->actualizarPermisoUsuario();

							}
						}

					if ($resultado['estatus'] == true) {

						$asunto = "Sistema CAS";
						$mensaje= "*Muy buen dia ".$nom." ".$ape."*<br><br>
						
						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>";

						$para = $ultimoRegistro;

				  		$fotoEmisor = 1;
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

						require_once 'modelo/bitacora.php';

						$bitacora = new Bitacora();

						$id_usuario = $_SESSION['id_ussuario'];
						$fecha = $date;

						date_default_timezone_set('America/Caracas');

						$hora = date("H:i:s");
						$accion = 'Registró al usuario '.$nom.' '.$ape.', con cédula: '.$ci;

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

					header("location: ?url=usuario&opcion=formulario_registro&registroUsuario=true");

				}

				break;

				case 'registro_personal':

				$ci=$_POST['ci'];

				$result = $usuario -> buscar_ci($ci);

				foreach ($result as $datos) {

					if (isset($datos['cedula'])) {

						$cono = 1;
						header("location: ?url=usuario&opcion=formularioPersonal&errorci=true");
					}
				}

				if (!isset($cono)) {

					$nom = mb_strtoupper($_POST['nom'], 'UTF-8'); 
					$nom = mb_convert_case($nom, MB_CASE_TITLE, "UTF-8");

					$ape = mb_strtoupper($_POST['ape'], 'UTF-8'); 
					$ape = mb_convert_case($ape, MB_CASE_TITLE, "UTF-8");

					$tci=strtoupper($_POST['tci']);

					$ci=$_POST['ci'];
					$fechan=$_POST['fechan'];

					$correo=mb_strtoupper($_POST['correo'], 'UTF-8'); 
					$correo = mb_convert_case($correo, MB_CASE_TITLE, "UTF-8");

					$tcorreo = $_POST['tcorreo'];
					$tcel = $_POST['tcel'];
					$cel = $_POST['cel'];

					$are = mb_strtoupper($_POST['are'], 'UTF-8'); 
					$are = mb_convert_case($are, MB_CASE_TITLE, "UTF-8");

					$direc=mb_strtoupper($_POST['direc'], 'UTF-8'); 
					$direc = mb_convert_case($direc, MB_CASE_TITLE, "UTF-8");

					$area = $_POST['tipo'];

					if ($area == '4') {

						$area = 'Docente';
					}

					if ($area == '5') {

						$area = 'Administrativo';
					}

					if ($area == '6') {

						$area = 'Obrero';
					}

					$tipo = '4';
					$tatu = 'Enabled';

					$passw = $_POST['ci'];
					$options = [
					    'cost' => 7,
					    'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

					$passw = password_hash($passw, PASSWORD_BCRYPT, $options);

					require_once ("modelo/seguridad.php");
					$seguridad = new Seguridad();

					$idRol = $tipo;
					$respuestaRol = $seguridad->Buscar_rol($idRol);

					foreach ($respuestaRol as $key) {

						$tatu = $key['statusRol'];

						$usuario->setNombre($nom);
						$usuario->setApellido($ape);
						$usuario->setTcedula($tci);
						$usuario->setCedula($ci);
						$usuario->setFecha_n($fechan);
						$usuario->setEmail($correo);
						$usuario->setTemail($tcorreo);
						$usuario->setTcelular($tcel);
						$usuario->setCelular($cel);
						$usuario->setArea($area);
						$usuario->setDependencia($are);
						$usuario->setDireccion($direc);
						$usuario->setRol($tipo);
						$usuario->setContrasena($passw);
						$usuario->setEstatus($tatu);

						
						$resultado = $usuario->Registrar();
					}

					if ($resultado['estatus'] == true) {

						$idUsuario_registrado = $usuario->ultimo_idUsuario();

						foreach ($idUsuario_registrado as $ultimoID):

							$ultimoRegistro = $ultimoID['id'];

						endforeach;

						require_once ("modelo/seguridad.php");
						$seguridad = new Seguridad();

						foreach ($permisosBeneficiario as $permiso) {

							$seguridad->setIdUsuario($ultimoRegistro);
							$seguridad->setIdPermiso($permiso);
							$seguridad->actualizarPermisoUsuario();

						}

						$asunto = "Sistema CAS";
						$mensaje= "*Muy buen dia ".$nom." ".$ape."*<br><br>
						
						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>";

						$para = $ultimoRegistro;

				  		$fotoEmisor = 1;
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

						require_once 'modelo/bitacora.php';

						$bitacora = new Bitacora();

						$id_usuario = $_SESSION['id_ussuario'];
						$fecha = $date;

						date_default_timezone_set('America/Caracas');

						$hora = date("H:i:s");
						$accion = 'Registró al beneficiario '.$nom.' '.$ape.', con cédula: '.$ci;

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

                                header("location: ?url=usuario&opcion=formularioPersonal&registroBeneficiario=true");
							}



							break;

	//Consultar los usuarios registrados
							case 'consultar-usuarios':

							$datos=$usuario->consultarusuario();
							require_once ("vista/usuario/consultar_users.php");
							break;

	//Pagina para modificar el usuario
							case 'modificar_usuario':

							$datos=$usuario->buscar($_GET["id"]);
							require_once("vista/usuario/act_users.php");
							break;

	//Opcion para modificar
							case 'modificar':

							$id = $_POST['id'];

							$nom = mb_strtoupper($_POST['nom'], 'UTF-8'); 
							$nom = mb_convert_case($nom, MB_CASE_TITLE, "UTF-8");

							$ape = mb_strtoupper($_POST['ape'], 'UTF-8'); 
							$ape = mb_convert_case($ape, MB_CASE_TITLE, "UTF-8");

							$tci=strtoupper($_POST['tci']);

							$ci=$_POST['ci'];
							$fechan=$_POST['fechan'];

							$correo=mb_strtoupper($_POST['correo'], 'UTF-8'); 
							$correo = mb_convert_case($correo, MB_CASE_TITLE, "UTF-8");

							$tcorreo = $_POST['tcorreo'];
							$tcel = $_POST['tcel'];
							$cel = $_POST['cel'];

							$are = mb_strtoupper($_POST['are'], 'UTF-8'); 
							$are = mb_convert_case($are, MB_CASE_TITLE, "UTF-8");

							$direc=mb_strtoupper($_POST['direc'], 'UTF-8'); 
							$direc = mb_convert_case($direc, MB_CASE_TITLE, "UTF-8");
							$tatu = $_POST['estatus']; 
							$tipo = $_POST['tipo'];
							$area = 'System';

							if ($tipo == '4') {

								$dependencia = $_POST['are'];

								if ($dependencia == 'Agroalimentación' ||
									$dependencia == 'Ciencias De La Información' ||
									$dependencia == 'Contaduria Pública' ||
									$dependencia == 'Deporte' ||
									$dependencia == 'Higiene Y Seguridad Laboral' ||
									$dependencia == 'Informática' ||
									$dependencia == 'Logística' ||
									$dependencia == 'Sistema de Calidad y Ambiente' ||
									$dependencia == 'Turismo'				        
								){

									$area = 'Docente';

							}

								if ($dependencia == 'Caja de ahorro' ||
									$dependencia == 'Mantenimiento de infraestructura y bienes' ||
									$dependencia == 'Sindicato Sintrosuptaeb' ||
									$dependencia == 'Siprodoiuetaeb' ||
									$dependencia == 'Sobutaeb' ||
									$dependencia == 'Personal de servicio'     
								){

									$area = 'Obrero';

								}

								if ($dependencia == 'Biblioteca' ||
									$dependencia == 'Caja' ||
									$dependencia == 'Compra' ||
									$dependencia == 'Consultorio' ||
									$dependencia == 'Control de actividades Academicas' ||
									$dependencia == 'Departamento de mantenimiento de infraestructura y bienes' ||
									$dependencia == 'Dirección de administracion y servicio' ||
									$dependencia == 'Dirección de despacho' ||
									$dependencia == 'Dirección de estudios avanzados' ||
									$dependencia == 'Dirección de servicio estudiantiles' ||
									$dependencia == 'Dirección de planificacion estrategica' ||
									$dependencia == 'Dirección de tecnologia' ||				        
									$dependencia == 'Rectorado' ||
									$dependencia == 'Sala territorial' ||
									$dependencia == 'Secretaria General' ||
									$dependencia == 'Sitrauptaeb' ||
									$dependencia == 'Talento humano' ||
									$dependencia == 'Secretaria General' ||
									$dependencia == 'Vice-rectorado Academico' 
							){

								$area = 'Administrativo';
								
							}

								$tipo = '4';

							}

							$passw = $_POST['pass'];

							$usuario->setNombre($nom);
							$usuario->setApellido($ape);
							$usuario->setTcedula($tci);
							$usuario->setCedula($ci);
							$usuario->setFecha_n($fechan);
							$usuario->setEmail($correo);
							$usuario->setTemail($tcorreo);
							$usuario->setTcelular($tcel);
							$usuario->setCelular($cel);
							$usuario->setArea($area);
							$usuario->setDependencia($are);
							$usuario->setDireccion($direc);
							$usuario->setRol($tipo);
							$usuario->setContrasena($passw);
							$usuario->setEstatus($tatu);

							$resultado = $usuario->modificar($id);

							require_once ("modelo/seguridad.php");	
							$seguridad = new Seguridad();

							$perUsuario = $seguridad->consultarPermisosUsers($id);

							if (!empty($perUsuario)) {

								foreach ($perUsuario as $delete) {

									$seguridad->eliminarAntiguosPermisos($delete['idRolUs']);
									$delete = 'true';

								}

								if ($delete == 'true') {

									if ($tipo == '1') {

										foreach ($permisosSuperu as $permiso) {

											$seguridad->setIdUsuario($id);
											$seguridad->setIdPermiso($permiso);
											$seguridad->actualizarPermisoUsuario();

										}
									}

									if ($tipo == '2') {

										foreach ($permisosAdministrador as $permiso) {

											$seguridad->setIdUsuario($id);
											$seguridad->setIdPermiso($permiso);
											$seguridad->actualizarPermisoUsuario();

										}
									}

									if ($tipo == '3') {

										foreach ($permisosOperador as $permiso) {

											$seguridad->setIdUsuario($id);
											$seguridad->setIdPermiso($permiso);
											$seguridad->actualizarPermisoUsuario();

										}
									}

									if ($tipo == '4') {

										foreach ($permisosBeneficiario as $permiso) {

											$seguridad->setIdUsuario($id);
											$seguridad->setIdPermiso($permiso);
											$seguridad->actualizarPermisoUsuario();

										}
									}
								}
							}else{

								if ($tipo == '1') {

									foreach ($permisosSuperu as $permiso) {

										$seguridad->setIdUsuario($id);
										$seguridad->setIdPermiso($permiso);
										$seguridad->actualizarPermisoUsuario();

									}
								}

								if ($tipo == '2') {

									foreach ($permisosAdministrador as $permiso) {

										$seguridad->setIdUsuario($id);
										$seguridad->setIdPermiso($permiso);
										$seguridad->actualizarPermisoUsuario();

									}
								}

								if ($tipo == '3') {

									foreach ($permisosOperador as $permiso) {

										$seguridad->setIdUsuario($id);
										$seguridad->setIdPermiso($permiso);
										$seguridad->actualizarPermisoUsuario();

									}
								}

								if ($tipo == '4') {

									foreach ($permisosBeneficiario as $permiso) {

										$seguridad->setIdUsuario($id);
										$seguridad->setIdPermiso($permiso);
										$seguridad->actualizarPermisoUsuario();

									}
								}

							}

							require_once 'modelo/bitacora.php';

							$bitacora = new Bitacora();

							$id_usuario = $_SESSION['id_ussuario'];
							$fecha = $date;

							date_default_timezone_set('America/Caracas');

							$hora = date("H:i:s");

							if (isset($_GET['direc'])) {

								$accion = 'Modificó al beneficiario '.$nom.' '.$ape.', con cédula: '.$ci;

							}else{

								$accion = 'Modificó al usuario '.$nom.' '.$ape.', con cédula: '.$ci;

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

							if (isset($_GET['direc'])) {

								header("Location: ?url=usuario&opcion=consultarpersonal&act=true");

							}else{

								header("Location: ?url=usuario&opcion=consultar-usuarios&act=true");

							}
								 
							break;

	//Buscar los perfiles de los usuarios y beneficiarios
							case 'buscar_perfil':

							if (isset($_GET['id'])) {

								$consultar_usuario = true;
								$id = $_GET['id'];

								if (isset($_GET['tipo'])) {
									$tipo = $_GET['tipo'];
								}

								if (isset($_GET['dis'])) {
									$tipo = 'distribucion';
									$con_u = $_GET['dis'];
									$id_o = $_GET['id_o'];
								}

								$datos=$usuario->Buscar($id);	
								require_once ("vista/perfil/perfil_usuario.php");

							}

							if (isset($_GET['id_header'])) {

								$datos=$usuario->Buscar($_SESSION['id_ussuario']);	
								$header = 'true';
								require_once ("vista/perfil/perfil_usuario.php");
							}

							break;

	//Opcion para eliminar registro
							case 'eliminar_usuario':

							$rol_usuario = $_GET['rol'];
							
							$datos = $usuario ->buscar($_GET["id"]);

							foreach ($datos as $datos_usuario) {

								require_once 'modelo/bitacora.php';

								$bitacora = new Bitacora();

								$nom = $datos_usuario['nombre'];
								$ape = $datos_usuario['apellido'];
								$ci = $datos_usuario['cedula'];

								$id_usuario = $_SESSION['id_ussuario'];
								$fecha = $date;

								date_default_timezone_set('America/Caracas');

								$hora = date("H:i:s");

								if ($rol_usuario == 'beneficiario') {

									$accion = 'Eliminó al beneficiario '.$nom.' '.$ape.', con cédula: '.$ci;

								}else{

									$accion = 'Eliminó al usuario '.$nom.' '.$ape.', con cédula: '.$ci;
									
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

								if ($respuesta['estatus'] == true) {

									$usuario->eliminar($_GET["id"]);

									if (isset($_GET['redirigir'])) {

										$idRe = $_GET['redirigir'];

										header("Location:?url=seguridad&opcion=consultarUsuarios&id=$idRe&deleteU=true");

									}

									if ($rol_usuario == '1' || $rol_usuario == '2' || $rol_usuario == '3') {

										header("Location:?url=usuario&opcion=consultar-usuarios&deleteU=true");
									}

									if ($rol_usuario == '4') {

										header("Location:?url=usuario&opcion=consultarpersonal&deleteU=true");
									}

								}

							}
							break;

							case 'personal':

							require_once("vista/personal/beneficiario.php");
							break;

							case 'formularioPersonal':

							$rol = $_SESSION['tipo_rol'];

							if($rol == '3'){ 

									$dependencia = $_SESSION['dependencia'];
									$identificacionOperador = '';

									if ($dependencia == 'Agroalimentación' ||
										$dependencia == 'Ciencias De La Información' ||
										$dependencia == 'Contaduria Pública' ||
										$dependencia == 'Deporte' ||
										$dependencia == 'Higiene Y Seguridad Laboral' ||
										$dependencia == 'Informática' ||
										$dependencia == 'Logística' ||
										$dependencia == 'Sistema de Calidad y Ambiente' ||
										$dependencia == 'Turismo'				        
									){

										$identificacionOperador = 'Docente';

								}

									if ($dependencia == 'Caja de ahorro' ||
										$dependencia == 'Mantenimiento de infraestructura y bienes' ||
										$dependencia == 'Sindicato Sintrosuptaeb' ||
										$dependencia == 'Siprodoiuetaeb' ||
										$dependencia == 'Sobutaeb' ||
										$dependencia == 'Personal de servicio'     
									){

									$identificacionOperador = 'Obrero';

							}

									if ($dependencia == 'Biblioteca' ||
										$dependencia == 'Caja' ||
										$dependencia == 'Compra' ||
										$dependencia == 'Consultorio' ||
										$dependencia == 'Control de actividades Academicas' ||
										$dependencia == 'Departamento de mantenimiento de infraestructura y bienes' ||
										$dependencia == 'Dirección de administracion y servicio' ||
										$dependencia == 'Dirección de despacho' ||
										$dependencia == 'Dirección de estudios avanzados' ||
										$dependencia == 'Dirección de servicio estudiantiles' ||
										$dependencia == 'Dirección de planificacion estrategica' ||
										$dependencia == 'Dirección de tecnologia' ||				        
										$dependencia == 'Rectorado' ||
										$dependencia == 'Sala territorial' ||
										$dependencia == 'Secretaria General' ||
										$dependencia == 'Sitrauptaeb' ||
										$dependencia == 'Talento humano' ||
										$dependencia == 'Secretaria General' ||
										$dependencia == 'Vice-rectorado Academico' 
								){

								$identificacionOperador = 'Administrativo';

						} } 

					require_once("vista/personal/formularioBenef.php");
					break;

					case 'consultarpersonal':

					$rol = $_SESSION['tipo_rol'];

					if($rol == '3'){ 

						$dependencia = $_SESSION['dependencia'];
						$identificacionOperador = '';

						if ($dependencia == 'Agroalimentación' ||
							$dependencia == 'Ciencias De La Información' ||
							$dependencia == 'Contaduria Pública' ||
							$dependencia == 'Deporte' ||
							$dependencia == 'Higiene Y Seguridad Laboral' ||
							$dependencia == 'Informática' ||
							$dependencia == 'Logística' ||
							$dependencia == 'Sistema de Calidad y Ambiente' ||
							$dependencia == 'Turismo'				        
						){

							$identificacionOperador = 'Docente';
						$datos=$usuario->ConsultarBeneficiarioPorSession($dependencia, $identificacionOperador);
						require_once 'vista/personal/conpersonal.php';	

					}

						if ($dependencia == 'Caja de ahorro' ||
							$dependencia == 'Mantenimiento de infraestructura y bienes' ||
							$dependencia == 'Sindicato Sintrosuptaeb' ||
							$dependencia == 'Siprodoiuetaeb' ||
							$dependencia == 'Sobutaeb' ||
							$dependencia == 'Personal de servicio'     
						){

						$identificacionOperador = 'Obrero';
					$datos=$usuario->ConsultarBeneficiarioPorSession($dependencia, $identificacionOperador);
					require_once 'vista/personal/conpersonal.php';

				}

						if ($dependencia == 'Biblioteca' ||
							$dependencia == 'Caja' ||
							$dependencia == 'Compra' ||
							$dependencia == 'Consultorio' ||
							$dependencia == 'Control de actividades Academicas' ||
							$dependencia == 'Departamento de mantenimiento de infraestructura y bienes' ||
							$dependencia == 'Dirección de administracion y servicio' ||
							$dependencia == 'Dirección de despacho' ||
							$dependencia == 'Dirección de estudios avanzados' ||
							$dependencia == 'Dirección de servicio estudiantiles' ||
							$dependencia == 'Dirección de planificacion estrategica' ||
							$dependencia == 'Dirección de tecnologia' ||				        
							$dependencia == 'Rectorado' ||
							$dependencia == 'Sala territorial' ||
							$dependencia == 'Secretaria General' ||
							$dependencia == 'Sitrauptaeb' ||
							$dependencia == 'Talento humano' ||
							$dependencia == 'Secretaria General' ||
							$dependencia == 'Vice-rectorado Academico' 
					){

					$identificacionOperador = 'Administrativo';
				$datos=$usuario->ConsultarBeneficiarioPorSession($dependencia, $identificacionOperador);
				require_once 'vista/personal/conpersonal.php';

			} }else{

				$datos=$usuario->consultarbenef();
				require_once 'vista/personal/conpersonal.php';

			}
			break;

			case 'modificar_personal':
			$rol = $_SESSION['tipo_rol'];

				if($rol == '3'){ 

						$dependencia = $_SESSION['dependencia'];
						$identificacionOperador = '';

						if ($dependencia == 'Agroalimentación' ||
							$dependencia == 'Ciencias De La Información' ||
							$dependencia == 'Contaduria Pública' ||
							$dependencia == 'Deporte' ||
							$dependencia == 'Higiene Y Seguridad Laboral' ||
							$dependencia == 'Informática' ||
							$dependencia == 'Logística' ||
							$dependencia == 'Sistema de Calidad y Ambiente' ||
							$dependencia == 'Turismo'				        
						){

							$identificacionOperador = 'Docente';

					}

						if ($dependencia == 'Caja de ahorro' ||
							$dependencia == 'Mantenimiento de infraestructura y bienes' ||
							$dependencia == 'Sindicato Sintrosuptaeb' ||
							$dependencia == 'Siprodoiuetaeb' ||
							$dependencia == 'Sobutaeb' ||
							$dependencia == 'Personal de servicio'     
						){

						$identificacionOperador = 'Obrero';

				}

						if ($dependencia == 'Biblioteca' ||
							$dependencia == 'Caja' ||
							$dependencia == 'Compra' ||
							$dependencia == 'Consultorio' ||
							$dependencia == 'Control de actividades Academicas' ||
							$dependencia == 'Departamento de mantenimiento de infraestructura y bienes' ||
							$dependencia == 'Dirección de administracion y servicio' ||
							$dependencia == 'Dirección de despacho' ||
							$dependencia == 'Dirección de estudios avanzados' ||
							$dependencia == 'Dirección de servicio estudiantiles' ||
							$dependencia == 'Dirección de planificacion estrategica' ||
							$dependencia == 'Dirección de tecnologia' ||				        
							$dependencia == 'Rectorado' ||
							$dependencia == 'Sala territorial' ||
							$dependencia == 'Secretaria General' ||
							$dependencia == 'Sitrauptaeb' ||
							$dependencia == 'Talento humano' ||
							$dependencia == 'Secretaria General' ||
							$dependencia == 'Vice-rectorado Academico' 
					){

					$identificacionOperador = 'Administrativo';

			} }

	$datos=$usuario->Buscar($_GET["id"]);
	require_once ("vista/personal/act_personal.php");

	break;

	case 'editarPerfil':
	require_once ("vista/perfil/editar_perfil.php");
	break;

	case 'actualizarFoto':

	if (isset($_POST["cas"])) {

		$cas = $_POST["cas"];

	}

	if (isset($_GET["pag"])) {

		$redirec = $_GET["pag"];

	}

	if (isset($_POST["cas"]) && $_POST["cas"] == 1) {

		$cas = 2;

	}

	if (isset($_POST["cas"]) && $_POST["cas"] == 2) {

		$cas = 4;

	}

	/*--------- FOTO DE PERFIL ---------*/
	$ruta = 'vista/config/img/users/'.$_SESSION['cedula'].'-'.$_FILES['foto_perfil']['name'];
	move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta);

	$id = $_SESSION["id_ussuario"];
	
	$usuario->setFoto($ruta);

	$resultado = $usuario->modificarFoto($id);

	$_SESSION["foto"] = $ruta;

	/*if (isset($cas) && $cas == 4){

		header("Location: ?url=inicio&opcion=index&mensaje=bienvenido");

	}else{

		header("Location: ?url=usuario&opcion=editarPerfil&fotoact=true&cas=$cas");

	}*/

	if ($_SESSION['numQuestions'] == 0 || $_SESSION["contrasena"] == $_SESSION["cedula"]) {
		
		$cas = 2;
	}

	if (isset($redirec)) {
		
		header("Location: ?url=usuario&opcion=editarPerfil&fotoact=true");

	}else {

	if ($_SESSION['numQuestions'] == 0 || $_SESSION["contrasena"] == $_SESSION["cedula"]) {		   								    	
		header("Location: ?url=usuario&opcion=editarPerfil&contra=$error&cas=$cas&fotoact=true");

	}else{  

		header("Location: ?url=inicio&opcion=index&mensaje=Bienvenido");

		}
	}

	break;

	case 'cambioContrasena':

	$passOne = $_SESSION["contrasena"];

	$passBefore = $_POST["con"]; 

	$options = [
    		    'cost' => 7,
			    'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

	$passBefore = password_hash($passBefore, PASSWORD_BCRYPT, $options);
	

	if (isset($_POST["cas"])) {

		$cas = $_POST["cas"];

	}

	if (isset($_GET["pag"])) {
 
		$redirec = $_GET["pag"];

	}

	if (isset($_POST["cas"]) && $_POST["cas"] == 1) {

		$cas = 2;

	}

	if (isset($_POST["cas"]) && $_POST["cas"] == 2) {

		$cas = 4;

	}

	if ($passOne !== $passBefore) {

		$error = 1;
		
	}else{

		$passNew = $_POST["contra_"];
		$passNew2 = $_POST["contra_2"];

		if ($passNew !== $passNew2) {
			
			$error = 2;
		}else{

			$passNew2 = password_hash($passNew2, PASSWORD_BCRYPT, $options);
			$ciu = password_hash($_SESSION["cedula"], PASSWORD_BCRYPT, $options);

			if ($passNew2 == $ciu) {

				$error = 3;
			}else{

				$id = $_SESSION["id_ussuario"];
				$usuario->setContrasena($passNew2);
				$actPass = $usuario->actPass($id);

				$_SESSION["contrasena"] = $passNew2;

				$error = 'bien'; 		

			}

		}
	}

	if (isset($redirec)) {
		
		header("Location: ?url=usuario&opcion=editarPerfil&contra=$error");

	}else {

			if ($_SESSION['numQuestions'] == 0 || empty($_SESSION["foto"])) {
				
				$cas = 2;
			}

			if (empty($_SESSION["foto"]) || $_SESSION['numQuestions'] == '0') {		   								    	
				header("Location: ?url=usuario&opcion=editarPerfil&contra=$error&cas=$cas");

			}else{  

				header("Location: ?url=inicio&opcion=index&mensaje=Bienvenido");

			}

	}

	break;

	case 'check_ci':

	sleep(1);

	if (isset($_POST)) {

	    $ci = (string)$_POST['ci'];
	 
	    $result = $usuario->buscar_ci($ci);

	    foreach ($result as $datos) {
	    	
	    	if (isset($datos['cedula'])) {
	    		
	    		$cono = '<div class="alert alert-danger" style="color: red;"><strong>Oh no!</strong> Esta cédula se encuentra registrada.</div>';
	    	}
	    }

	    if (!isset($cono)) {
	    	
	    	$cono = '<div class="alert alert-success" style="color: green;"><strong>Enhorabuena!</strong> Cédula no registrada.</div>';
	    }

	    echo $cono;
    }

	break;

	//Pagina de ayuda ya logeado
	case 'contacto_ayuda':

	require_once("vista/ayuda/contacto.php");
	
	break;		

		//ENVIAR CORREO////////////////////////////////
	case 'enviar_mail':

	
	$asuntico=$_POST['txtasuntico'];
	$para=$_POST['txtpara'];	
	$nombre=$_POST['txtnombre'];
	$apellido=$_POST['txtapellido'];
	$cedula=$_POST['txtcedula'];
	$rol=$_POST['txtrol'];
	$sucorreo=$_POST['txtsucorreo'];
	$celular=$_POST['txtcelular'];
	$loescrito=$_POST['txtmensaje'];


	$mensaje= "
			 *DATOS DEL REMITENTE*:

	-*Nombre* :  "."$nombre"." "."$apellido"."
	-*Cedula* :   "."$cedula"."
	-*Rol* :   "."$rol"."
	-*Correo de Contacto* : "."$sucorreo"."
	-*Celular* : "."$celular"."


	-*ASUNTO* : "."$asuntico"."
	-*MENSAJE* : "."$loescrito"."
	";

	$asunto = "Correo del Software CAS por "."$rol"." "."$nombre"." "."$apellido"."";


	if(mail($para, $asunto, $mensaje)) {

		require_once 'modelo/bitacora.php';

		$bitacora = new Bitacora();

		$id_usuario = $_SESSION['id_ussuario'];
		$fecha = $date;

		date_default_timezone_set('America/Caracas');

		$hora = date("H:i:s");
		$accion = 'Contactó a soporte técnico';

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

		header("location: ?url=usuario&opcion=contacto_ayuda&simail=true");					
	}

	else {
		header("location: ?url=usuario&opcion=contacto_ayuda&nomail=true");	
	}

	break;

		//Pagina de ayuda en pantalla login
	case 'logincontactoayuda':

	require_once("vista/login/botondeayuda/contactologin.php");

	break;	

		//ENVIAR CORREO PERO EN LOGIN////////////////////////////////
	case 'loginenviarmail':

	$lasuntico=$_POST['ltxtasuntico'];
	$lpara=$_POST['ltxtpara'];	
	$lnombre=$_POST['ltxtnombre'];
	$lapellido=$_POST['ltxtapellido'];
	$lcedula=$_POST['ltxtcedula'];
	$lrol=$_POST['ltxtrol'];
	$lsucorreo=$_POST['ltxtsucorreo'];
	$lcelular=$_POST['ltxtcelular'];
	$lloescrito=$_POST['ltxtmensaje'];


	$lmensaje= "
			 *DATOS DEL REMITENTE*:

	-*Nombre* :  "."$lnombre"." "."$lapellido"."
	-*Cedula* :   "."$lcedula"."
	-*Rol* :   "."$lrol"."
	-*Correo de Contacto* : "."$lsucorreo"."
	-*Celular* : "."$lcelular"."


	-*ASUNTO* : "."$lasuntico"."
	-*MENSAJE* : "."$lloescrito"."
	";

	$lasunto = "Correo del Software CAS por "."$lrol"." "."$lnombre"." "."$lapellido"."";


	if(mail($lpara, $lasunto, $lmensaje)) {
		header("location: ?paso=usuario&opcion=logincontactoayuda&simail=true");					
	}

	else {
		header("location: ?paso=usuario&opcion=logincontactoayuda&nomail=true");	
	}

	break;

	case 'recuperarContrasena':
		
		require_once("vista/login/recuperarPassword/recuperarPass.php");

		break;

}

?>

