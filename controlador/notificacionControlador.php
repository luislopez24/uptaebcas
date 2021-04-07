<?php

require_once ("modelo/notificacion.php");
$notificacion= new Notificacion();

$opcion = $_GET['opcion'];

switch ($opcion) {

	case 'buzon':

	$idRecep = $_SESSION["id_ussuario"];

	$mensajesBuzon = $notificacion->consultarMensajes($idRecep);
	$cont = 0;

	foreach ($mensajesBuzon as $value) {

		$cont = $cont + 1;
	}

	require_once ("vista/notificacion/buzon/inicioBuzon.php");
	break;

	case 'redactar':

	require_once ("modelo/usuario.php");
	$usuario= new usuario();

	$datosU = $usuario->consultarusuario();

	$idRecep = $_SESSION["id_ussuario"];

	$mensajesBuzon = $notificacion->consultarMensajes($idRecep);
	$cont = 0;

	foreach ($mensajesBuzon as $value) {

		$cont = $cont + 1;
	}

	require_once ("vista/notificacion/buzon/redactarBuzon.php");
	break;

	case 'notificacionBuzon':

	$idRecep = $_SESSION["id_ussuario"];

	$hola = $notificacion->consultarNotificaciones($idRecep);

	require_once ("vista/notificacion/buzon/notificacionBuzon.php");
	break;

	case 'enviadosBuzon':

	$idEmisor = $_SESSION["id_ussuario"];

	$mensajesSend = $notificacion->consultarEnviados($idEmisor);

	require_once ("vista/notificacion/buzon/enviadosBuzon.php");
	break;

	case 'favoritosBuzon': 

			$id = $_SESSION["id_ussuario"];

			$mensajesFav = $notificacion->fav($id);

			require_once ("vista/notificacion/buzon/favoritosBuzon.php");
			break;

	case 'actualizarFavorito':

			$ruta = $_GET["ruta"];
			$setFavorito = $_GET["setFav"];
			$id = $_GET["idMensaje"];

			$notificacion->setFavorito($setFavorito);

			$mensajesBuzon = $notificacion->setFav($id);

			if ($ruta == "inicioBuzon.php") {

				$mensajesBuzon = $notificacion->consultarMensajes($_SESSION['id_ussuario']);
				$mensajesBuzonNotificacion = $notificacion->consultarNotificaciones($_SESSION['id_ussuario']);

				$contBuzonMsj = 0;
				$contBuzonNotificaciones = 0;

				foreach ($mensajesBuzon as $value) {

					if ($value['leido'] == 0) {

						$contBuzonMsj = $contBuzonMsj + 1;    
					}


				}

				foreach ($mensajesBuzonNotificacion as $value) {

					if ($value['leido'] == 0) {
						$contBuzonNotificaciones = $contBuzonNotificaciones + 1;

					}
				}
			}

			if ($ruta == "notificacionBuzon.php") {

				$idRecep = $_SESSION["id_ussuario"];

				$mensajesBuzon = $notificacion->consultarNotificaciones($idRecep);
			}

			if ($ruta == "archivadosBuzon.php") {
				
				$id = $_SESSION["id_ussuario"];

				$mensajesArchi = $notificacion->archivadosBuzon($id);
				$mensajesNoti = $notificacion->archivadosBuzonNoti($id);

			}


			require_once ("vista/notificacion/buzon/".$ruta."");
			break;

			case 'archivadosBuzon':

			$id = $_SESSION["id_ussuario"];

			$mensajesArchi = $notificacion->archivadosBuzon($id);
			$mensajesNoti = $notificacion->archivadosBuzonNoti($id);

			require_once ("vista/notificacion/buzon/archivadosBuzon.php");
			break;

	case 'actualizarArchivar':

			$ruta = $_GET["ruta"];
			$setTipo = "3";

			if (isset($_POST['id_delete'])) {
				
				$id = $_POST['id_delete'];
			}

			if (!isset($id)) {
				
				$archivarFalso = 'false';

			}else{

			$notificacion->setTipo($setTipo);

			foreach ($id as $idArchivar) {

				$mensajesBuzon = $notificacion->actTipo($idArchivar);

			}

			$actArchivar = "true";
			}

			if ($ruta == "inicioBuzon.php") {

				$mensajesBuzon = $notificacion->consultarMensajes($_SESSION['id_ussuario']);
				$mensajesBuzonNotificacion = $notificacion->consultarNotificaciones($_SESSION['id_ussuario']);

				$contBuzonMsj = 0;
				$contBuzonNotificaciones = 0;

				foreach ($mensajesBuzon as $value) {

					if ($value['leido'] == 0) {

						$contBuzonMsj = $contBuzonMsj + 1;    
					}


				}

				foreach ($mensajesBuzonNotificacion as $value) {

					if ($value['leido'] == 0) {
						$contBuzonNotificaciones = $contBuzonNotificaciones + 1;

					}
				}
			}

			if ($ruta == "notificacionBuzon.php") {

				$idRecep = $_SESSION["id_ussuario"];

				$mensajesBuzon = $notificacion->consultarNotificaciones($idRecep);
			}

			if ($ruta == "favoritosBuzon.php") {
				
				$id = $_SESSION["id_ussuario"];

				$mensajesBuzon = $notificacion->fav($id);
			}

			if ($ruta == "enviadosBuzon.php") {
				
				$id = $_SESSION["id_ussuario"];

				$mensajesBuzon = $notificacion->archivadosBuzon($id);
				$mensajesNoti = $notificacion->archivadosBuzonNoti($id);

			}
			
			require_once ("vista/notificacion/buzon/".$ruta."");
			break;

	case 'actualizarDesarchivar':

			$ruta = $_GET["ruta"];
			$setTipo = "2";

			if (isset($_POST['id_delete'])) {
				
				$id = $_POST['id_delete'];
			}

			if (!isset($id)) {
				
				$desarchivarFalso = 'false';

			}else{

			$notificacion->setTipo($setTipo);

			foreach ($id as $idArchivar) {

				$mensajesBuzon = $notificacion->actTipo($idArchivar);

			}

			$actDesarchivar = "true"; 

			}

			if ($ruta == "archivadosBuzon.php") {
				
				$id = $_SESSION["id_ussuario"];

				$mensajesArchi = $notificacion->archivadosBuzon($id);
				$mensajesNoti = $notificacion->archivadosBuzonNoti($id);

			}

			require_once ("vista/notificacion/buzon/".$ruta."");
			break;

	case 'eliminarMsj':

			$ruta = $_GET["ruta"];
			$accion = $_GET["accion"];

			if (isset($_POST['id_delete'])) {
				
				$idMsj = $_POST['id_delete'];
			}

			if (!isset($idMsj)) {
				
				$eliminarFalso = 'false';



			}else{

			foreach ($idMsj as $msj) {

				if ($accion == 'send') {

					$existenciaMensaje = $notificacion->vermensaje($msj);

					foreach ($existenciaMensaje as $comprobar) {

						if (empty($comprobar['idReceptor'])) {

							$eliminarAmbos = 'true';
							
						}else{

							$eliminarAmbos = 'false';

						}

					}

					if ($eliminarAmbos == 'true') {

						$notificacion ->eliminarMsjDefinitivoE($msj);
						$notificacion ->eliminarMsjDefinitivoR($msj);
						$deleteMessaje = "true";

					}

					if ($eliminarAmbos == 'false') {

						$notificacion ->eliminarE($msj);
						$deleteMessaje = "true";

					}

				}

				if ($accion == 'buzon') {

					$existenciaMensaje = $notificacion->chequeoMensaje($msj);

					if (empty($existenciaMensaje)) {

						$eliminarAmbos = 'true';

					}else{

						$eliminarAmbos = 'false';

					}


					if ($eliminarAmbos == 'true') {

						$notificacion ->eliminarR($msj);
						$deleteMessaje = "true";

					}

					if ($eliminarAmbos == 'false') {

						$idR = NULL;

						$notificacion->setIdReceptor($idR);
						$mensajesBuzon = $notificacion->eliminarMsj($msj);
						$deleteMessaje = "true";

					}

				}	


			}
			
			}

			if ($ruta == "inicioBuzon.php") {

				$mensajesBuzon = $notificacion->consultarMensajes($_SESSION['id_ussuario']);
				$mensajesBuzonNotificacion = $notificacion->consultarNotificaciones($_SESSION['id_ussuario']);

				$contBuzonMsj = 0;
				$contBuzonNotificaciones = 0;

				foreach ($mensajesBuzon as $value) {

					if ($value['leido'] == 0) {

						$contBuzonMsj = $contBuzonMsj + 1;    
					}


				}

				foreach ($mensajesBuzonNotificacion as $value) {

					if ($value['leido'] == 0) {
						$contBuzonNotificaciones = $contBuzonNotificaciones + 1;

					}
				}
			}

			if ($ruta == "notificacionBuzon.php") {

				$idRecep = $_SESSION["id_ussuario"];

				$hola = $notificacion->consultarNotificaciones($idRecep);
			}

			if ($ruta == "enviadosBuzon.php") {

				$idEmisor = $_SESSION["id_ussuario"];

				$mensajesSend = $notificacion->consultarEnviados($idEmisor);
			} 

			if ($ruta == "favoritosBuzon.php") {
				
				$id = $_SESSION["id_ussuario"];

				$mensajesFav = $notificacion->fav($id);
			} 

			if ($ruta == "archivadosBuzon.php") {
				
				$id = $_SESSION["id_ussuario"];

				$mensajesArchi = $notificacion->archivadosBuzon($id);
				$mensajesNoti = $notificacion->archivadosBuzonNoti($id);

			}

			if ($ruta == "inicioBuzon.php") {

				$mensajesBuzon = $notificacion->consultarMensajes($_SESSION['id_ussuario']);
				$mensajesBuzonNotificacion = $notificacion->consultarNotificaciones($_SESSION['id_ussuario']);

				$contBuzonMsj = 0;
				$contBuzonNotificaciones = 0;

				foreach ($mensajesBuzon as $value) {

					if ($value['leido'] == 0) {

						$contBuzonMsj = $contBuzonMsj + 1;    
					}


				}

				foreach ($mensajesBuzonNotificacion as $value) {

					if ($value['leido'] == 0) {
						$contBuzonNotificaciones = $contBuzonNotificaciones + 1;

					}
				}

				}


			require_once ("vista/notificacion/buzon/".$ruta."");


			break;

	case 'verMensajeBuzon':

			$idMsj = $_GET["idMensaje"];
			$direc = $_GET["direc"];
			$view = $_GET["view"];

			$notificacion->setLeido($view);
			$actMensaje = $notificacion->mensajeLeido($idMsj);

			$vermensaje =  $notificacion->vermensaje($idMsj);

			if (empty($vermensaje)) {

				$vermensaje =  $notificacion->vermensajeSystem($idMsj);
			}

			$mensajesBuzon = $notificacion->consultarMensajes($_SESSION['id_ussuario']);
			$mensajesBuzonNotificacion = $notificacion->consultarNotificaciones($_SESSION['id_ussuario']);

			$contBuzonMsj = 0;
			$contBuzonNotificaciones = 0;

			foreach ($mensajesBuzon as $value) {

				if ($value['leido'] == 0) {

					$contBuzonMsj = $contBuzonMsj + 1;    
				}


			}

			foreach ($mensajesBuzonNotificacion as $value) {

				if ($value['leido'] == 0) {
					$contBuzonNotificaciones = $contBuzonNotificaciones + 1;

				}
			}

			require_once ("vista/notificacion/buzon/verMensajeBuzon.php");
			break;

	case 'enviarCorreo':

	$fotoEmisor = $_SESSION["foto"];
	$idEmisor = $_SESSION["id_ussuario"];
	
	$idReceptor = $_POST['tipoo'];
	$asunt = $_POST["txtasuntico"]; 
	$msj = $_POST["txtmensaje"];
			$tipo = 2; //mensaje usuario 
			$fav = 0; //sin marcar aun favorito por el receptor
			$dateTime = date('Y-m-d H:i:s');

			foreach ($idReceptor as $key) {

				$notificacion->setfoto_icono($fotoEmisor);
				$notificacion->setIdUser($idEmisor);
				$notificacion->setIdReceptor($key);
				$notificacion->setAsunto($asunt);
				$notificacion->setMensaje($msj);
				$notificacion->setTipo($tipo);
				$notificacion->setFavorito($fav);
				$notificacion->setFecha($dateTime);

				$notificacion->RegistrarNotificacion();

				$idMsjRegistrado = $notificacion->ultimoMensaje();

				foreach ($idMsjRegistrado as $idm):
					$idMsj = $idm['id'];

					$notificacion->setIdMensaje($idMsj);
					$notificacion->setIdUser($idEmisor);
					$notificacion->setIdReceptor($key);

					$notificacion->RegistrarMsj();

				endforeach;

			}

			header("Location:?url=notificacion&opcion=enviadosBuzon&mensajeEnviado=true");
			
			break;

	case 'responderEmail':
		
			$fotoEmisor = $_SESSION["foto"];
			$idEmisor = $_SESSION["id_ussuario"];
			
			$idReceptor = $_POST['tipoo'];
			$asunt = $_POST["txtasuntico"]; 
			$msj = $_POST["txtmensaje"];
			$tipo = 2; //mensaje usuario 
			$fav = 0; //sin marcar aun favorito por el receptor
			$dateTime = date('Y-m-d H:i:s');

			foreach ($idReceptor as $key) {

				$notificacion->setfoto_icono($fotoEmisor);
				$notificacion->setIdUser($idEmisor);
				$notificacion->setIdReceptor($key);
				$notificacion->setAsunto($asunt);
				$notificacion->setMensaje($msj);
				$notificacion->setTipo($tipo);
				$notificacion->setFavorito($fav);
				$notificacion->setFecha($dateTime);

				$notificacion->RegistrarNotificacion();

				$idMsjRegistrado = $notificacion->ultimoMensaje();

				foreach ($idMsjRegistrado as $idm):
					$idMsj = $idm['id'];

					$notificacion->setIdMensaje($idMsj);
					$notificacion->setIdUser($idEmisor);
					$notificacion->setIdReceptor($key);

					$notificacion->RegistrarMsj();

				endforeach;

			}

			header("Location:?url=notificacion&opcion=enviadosBuzon&mensajeEnviado=true");

		break;

		case 'usuarios_morosos':
			
			require_once ("modelo/operativo.php");

			$operativo = new Operativo();
			
			$idOperativo=$_GET['operativo'];

			$notificarO = 'true';

			$operativo->setNot($notificarO);
			$operativo->notificarOperativo($idOperativo);

			$datosOperativo = $operativo->buscar($idOperativo);
 
			$beneficiarioDeudor = $notificacion->usuarios_por_pagar($idOperativo);

			$asunto = "Recordatorio CAS";

				foreach ($datosOperativo as $operativo):
					
					foreach ($beneficiarioDeudor as $Datosbeneficiario) {
					
		$mensaje= "*Muy buen dia beneficiario ".$Datosbeneficiario['nombre']." ".$Datosbeneficiario['apellido']."*<br><br>
					
					*¡Les recordamos que tiene un operativo por pagar, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>

					- Nombre del operativo: ".$operativo['nombre_operativo']."<br><br>
					- Su costo: ".$operativo['precio_operativo']."<br><br>
					- Fecha de inicio: ".$operativo['fecha_inicio_operativo']."<br><br>
					- Fecha de caducidad: ".$operativo['fecha_final_operativo']."<br><br>
					- Descripcion del operativo: ".$operativo['descripcion']."<br><br>
					- Banco admitido: ".$operativo['banco_admitido']."<br><br>

					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>";

					$para = $Datosbeneficiario['id_usuario'];

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

				header("Location:?url=inicio&opcion=index&recordatorio=true");	

			break;

		}
		?>
