<?php

require_once ("modelo/bitacora.php");
$bitacora = new Bitacora();

require_once ("modelo/seguridad.php");
$seguridad = new Seguridad();

$opcion = $_GET['opcion'];

if (isset($_POST['opcion'])) {
	
	$opcion = $_POST['opcion'];
}

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

switch ($opcion) {

	case 'inicioBitacora':

	require_once 'vista/seguridad/bitacora/inicioBitacora.php';

	break;

	case 'consultarFechasBitacoras':
	
	if(!empty($_POST['fechaI'])) {
		
		$fechaI = $_POST['fechaI'];
	}

	if(!empty($_POST['fechaF'])) {
		
		$fechaF = $_POST['fechaF'];
	}

	if(!empty($_GET['fechaI'])) {
		
		$fechaI = $_GET['fechaI'];
	}

	if(!empty($_GET['fechaF'])) {
		
		$fechaF = $_GET['fechaF'];
	}


	$datos = $bitacora->consultarBitacoraPorFecha($fechaI, $fechaF);
	require_once 'vista/seguridad/bitacora/bitacora.php';

	break;

	case 'eliminarBi':

	$id_registro = $_POST['id_delete'];
	$fechai = $_POST['fechaI'];
	$fechaf = $_POST['fechaF'];

	if (!isset($id_registro)) {
		
		header("Location:?url=seguridad&opcion=consultarFechasBitacoras&deletefalseBitacora=false&fechaI=$fechai&fechaF=$fechaf");		

	} else{

		foreach ($id_registro as $idBitacora) {

		$bitacora->eliminarRegistro($idBitacora);

		}
	
		header("Location:?url=seguridad&opcion=consultarFechasBitacoras&deleteBitacora=true&fechaI=$fechai&fechaF=$fechaf");	

	}

	break;

	case 'inicioSeguridadAvanzada':

	require_once 'vista/seguridad/seguridadAvanzada/inicioAvanzada.php';

	break;

	case 'inicioRoles':

	$datos = $seguridad->consultarRol();

	require_once 'vista/seguridad/seguridadAvanzada/inicioRoles.php';

	break;

	case 'modificarRol':

	$idU = $_POST['idUsuario'];
	$tatu = $_POST['estatus'];
	$idRedirigir = $_GET['id'];

	$seguridad->setEstatus($tatu);

	$tipo = $_POST["tipo"];
	$tipo_USUARIO = $_POST['tipo_rol'];


	if ($tipo == $tipo_USUARIO) {



		$resul = $seguridad->modStatus($idU);

		header("Location:?url=seguridad&opcion=consultarUsuarios&id=$idRedirigir&act=true");


	}else{

		$perUsuario = $seguridad->consultarPermisosUsers($idU);

		if (!empty($perUsuario)) {

			foreach ($perUsuario as $delete) {
				
				$seguridad->eliminarAntiguosPermisos($delete['idRolUs']);
				$delete = 'true';

			}

			if ($delete == 'true') {
				
				if ($tipo == '1') {

					foreach ($permisosSuperu as $permiso) {

						$seguridad->setIdUsuario($idU);
						$seguridad->setIdPermiso($permiso);
						$seguridad->actualizarPermisoUsuario();

						$seguridad->setRol($tipo);
						$seguridad->modRol($idU);

					}
				}

				if ($tipo == '2') {

					foreach ($permisosAdministrador as $permiso) {

						$seguridad->setIdUsuario($idU);
						$seguridad->setIdPermiso($permiso);
						$seguridad->actualizarPermisoUsuario();

						$seguridad->setRol($tipo);
						$seguridad->modRol($idU);

					}
				}

				if ($tipo == '3') {

					foreach ($permisosOperador as $permiso) {

						$seguridad->setIdUsuario($idU);
						$seguridad->setIdPermiso($permiso);
						$seguridad->actualizarPermisoUsuario();

						$seguridad->setRol($tipo);
						$seguridad->modRol($idU);

					}
				}

				if ($tipo == '4') {

					foreach ($permisosBeneficiario as $permiso) {

						$seguridad->setIdUsuario($idU);
						$seguridad->setIdPermiso($permiso);
						$seguridad->actualizarPermisoUsuario();

						$seguridad->setRol($tipo);
						$seguridad->modRol($idU);

					}
				}

				$seguridad->setEstatus($tatu);

				$resul = $seguridad->modStatus($idU);

				header("Location:?url=seguridad&opcion=consultarUsuarios&id=$idRedirigir&act=true");
			}

		}else{

			if ($tipo == '1') {

				foreach ($permisosSuperu as $permiso) {

					$seguridad->setIdUsuario($idU);
					$seguridad->setIdPermiso($permiso);
					$seguridad->actualizarPermisoUsuario();

					$seguridad->setRol($tipo);
					$seguridad->modRol($idU);

				}
			}

			if ($tipo == '2') {

				foreach ($permisosAdministrador as $permiso) {

					$seguridad->setIdUsuario($idU);
					$seguridad->setIdPermiso($permiso);
					$seguridad->actualizarPermisoUsuario();

					$seguridad->setRol($tipo);
					$seguridad->modRol($idU);

				}
			}

			if ($tipo == '3') {

				foreach ($permisosOperador as $permiso) {

					$seguridad->setIdUsuario($idU);
					$seguridad->setIdPermiso($permiso);
					$seguridad->actualizarPermisoUsuario();

					$seguridad->setRol($tipo);
					$seguridad->modRol($idU);

				}
			}

			if ($tipo == '4') {

				foreach ($permisosBeneficiario as $permiso) {

					$seguridad->setIdUsuario($idU);
					$seguridad->setIdPermiso($permiso);
					$seguridad->actualizarPermisoUsuario();

					$seguridad->setRol($tipo);
					$seguridad->modRol($idU);

				}
			}

			$seguridad->setEstatus($tatu);

			$resul = $seguridad->modStatus($idU);

			header("Location:?url=seguridad&opcion=consultarUsuarios&id=$idRedirigir&act=true");
		}

	}

	break;

	case 'eliminarRol':

	$idRol = $_GET['id'];
	$seguridad->eliminar($idRol);

	header("Location:?url=seguridad&opcion=inicioRoles&deleteRol=true");
	break;

	case 'consultarPermisos':

	$idRol = $_GET['id_rol'];
	$idUser = $_GET['idUser'];

	$datos = $seguridad->Buscar_rol($idRol);
	$modulos = $seguridad->consultarModulos();
	$permisos = $seguridad->consultarPermisos();
	$perUsuario = $seguridad->consultarPermisosUsers($idUser);

	require_once ("modelo/usuario.php");
	$usuario= new usuario(); 

	$datosUsuario = $usuario->buscar($idUser);

	require_once 'vista/seguridad/seguridadAvanzada/inicioPermisos.php';

	break;

	case 'inicioAdminUsuarios':

	require_once 'vista/seguridad/seguridadAvanzada/permisosUsuarios.php';

	break;

	case 'consultarUsuarios':

	$idRol = $_GET['id'];

	$datos = $seguridad->Buscar_rolUsuarios($idRol);

	require_once 'vista/seguridad/seguridadAvanzada/consultarUsuarios.php';

	break;

	case 'actualizarPermisoUsuario':

	$idUsuario = $_POST['idUser'];
	$id_Permiso = $_POST['idPermisos'];
	$idUsuario = $_POST['idUser'];
	$idRol = $_POST['idRol'];

	$perUsuario = $seguridad->consultarPermisosUsers($idUsuario);

	if (!empty($perUsuario)) {

		foreach ($perUsuario as $delete) {

			$seguridad->eliminarAntiguosPermisos($delete['idRolUs']);
			$delete = 'true';

		}

		if ($delete == 'true') {

			foreach ($id_Permiso as $idPermisos) {

				$seguridad->setIdUsuario($idUsuario);
				$seguridad->setIdPermiso($idPermisos);
				$seguridad->actualizarPermisoUsuario();

			}
			
			header("Location:?url=seguridad&opcion=consultarPermisos&id_rol=$idRol&idUser=$idUsuario&actPermisos=true");

		}

	}else{

		foreach ($id_Permiso as $idPermisos) {

			$seguridad->setIdUsuario($idUsuario);
			$seguridad->setIdPermiso($idPermisos);
			$seguridad->actualizarPermisoUsuario();
			
		}

		header("Location:?url=seguridad&opcion=consultarPermisos&id_rol=$idRol&idUser=$idUsuario&actPermisos=true");
	}

	break;

	case 'modificarTodoRol':

	$idRol = $_POST['id_rol'];
	$estatus = $_POST['estatus'];

	$seguridad->setEstatus($estatus);
	$result = $seguridad->modificarTodoRol($idRol);

	$result2 = $seguridad->modificarTatuRol($idRol);

	header("Location:?url=seguridad&opcion=inicioRoles&actRol=true");
	break;

	case 'addQuestion':

	$idUsuario = $_POST['idUsuario'];
	$questOne = $_POST['quest_one'];
	$questTwo = $_POST['quest_two'];

	$respuestOne = $_POST['respuesta_one'];
	$respuestTwo = $_POST['respuesta_two'];

	$seguridad->setIdUsuario($idUsuario);
	$seguridad->setQuest($questOne);
	$seguridad->setRespuest($respuestOne);

	$result = $seguridad->registrarQuestions();

	$seguridad->setIdUsuario($idUsuario);
	$seguridad->setQuest($questTwo);
	$seguridad->setRespuest($respuestTwo);

	$result2 = $seguridad->registrarQuestions();

	require_once ("modelo/usuario.php");
	$us= new usuario();

	$preguntas = $us->segurityQuestions($idUsuario);


	$num = 0;
	foreach ($preguntas as $quest) {

		$num++;

	}

	$_SESSION["numQuestions"] = $num;

	if ($_SESSION['cedula'] == $_SESSION['contrasena'] || empty($_SESSION["foto"])) {
		
		$cas = 2;
	}


	if ($_SESSION["contrasena"] == $_SESSION["cedula"] || empty($_SESSION["foto"])) {		   								    	
		header("Location: ?url=usuario&opcion=editarPerfil&question=true&cas=$cas");

	}else{  

		header("Location: ?url=inicio&opcion=index&mensaje=Bienvenido");

	}

	break;

	case 'FormContrasena':

	 	if (isset($_GET["ciVuelta"])) {

	 		$CiUser = $_GET["ciVuelta"];
	 	
	 	}else{
			
			$CiUser = $_POST["ciUser"];
		}

		 

		if (empty($CiUser)) {
			
			header("Location: ?paso=usuario&opcion=recuperarContrasena&ciUser=false");
		}
		else{

			require_once ("modelo/usuario.php");
			$us= new usuario();

			$consulta_cedula = $us->buscar_ci($CiUser);

			$id = NULL;

			foreach ($consulta_cedula as $ci) {
				
				if (!empty($ci['cedula'])) {

					$id = $ci['id_usuario'];

						}

				}


			if ($id == NULL) {
					
					header("Location: ?paso=usuario&opcion=recuperarContrasena&ciUserNo=false&cedulaExiste=false");
			}

			if (isset($id)) {
				
				$datos = $us->buscar($id);
				$questAndRespuest = $seguridad->buscar_quest($id);

				//indique si la fecha a continuacion es su fecha de nacimiento
				// introduzca uno de sus numeros de telefono registrado en el sistema UPTAEB-CAS
				

				// PARA HACER PREGUNTAS RANDOM
				$preguntadas = array(); // declaramos una variable que usaremos de contenedor para las preguntas ya realizadas
				$array=array('1986-08-18', '1994-06-01', '1984-06-23', '1978-02-12', '1972-09-14', '1970-08-15');

				$preguntasNum = array();
				$arrayNum=array('***6651', '***3357', '***4487', '***3288', '***9964', '***7762');
				
				

				foreach ($datos as $datosUsuario) {

				$resultado = substr($datosUsuario['celular'], -4);
				
				$array[].= $datosUsuario['fecha_n'];
				$arrayNum[].= "***".$resultado;

				$items=count($array)-1;
				
				$seronoser = count($questAndRespuest);

				if ($seronoser <2) {
					
					header("Location: ?paso=usuario&opcion=recuperarContrasena&userSinQuest=false");

				}else{ 

						if (!empty($_GET['b']) && $_GET['b'] == 1) {
							
							$cedulaExiste = true;
						}

						require_once 'vista/login/recuperarPassword/formDatos.php';
				}

				}
			}

		}

		break;

		case 'comContrasena':
			
			$fecha = $_POST["fechaSelec"];
			$numCelular = $_POST["numSeleccionado"];
			$idUsuario = $_POST["idUsuario"];
			$respuestas = $_POST["respuesta"];

			$groupFecha = $_POST["fechaGroup"];
			$groupCelular = $_POST["celularGroup"];
			$preguntas = $_POST["preguntas"];

			$paso = 4;


			// numero de celular purgado 
			$celularS = substr($numCelular, -4);

			require_once ("modelo/usuario.php");
			$us= new usuario();

			$respuestaOne = $seguridad->buscar_questUS($idUsuario, $preguntas[0]);

			foreach ($respuestaOne as $respuesta) {
				
				$respuestaONE = $respuesta['respuesta'];
			}

			$respuestaTwo = $seguridad->buscar_questUS($idUsuario, $preguntas[1]);

			foreach ($respuestaTwo as $respuesta) {
				
				$respuestaTWO = $respuesta['respuesta'];
			}
			
			$datosUs = $us->buscar($idUsuario);

			foreach ($datosUs as $validarUs) {

			$ci = $validarUs['cedula'];
			$nombre = $validarUs['nombre'];

			//purgar celular original
			$numCelularUs = substr($validarUs['celular'], -4);
				
				if ($groupFecha == "si") {
					
					if ($fecha == $validarUs["fecha_n"]) {
						
						$paso = $paso;

					}else{

						$paso= $paso-1;
					}

				}else{

					if ($fecha == $validarUs["fecha_n"]) {
						
						$paso= $paso-1;

					}else{

						$paso = $paso;
					}
				}

				if ($groupCelular == "si") {
					
					if ($numCelular == $numCelularUs) {
						
						$paso = $paso;

					}else{

						$paso= $paso-1;
					}

				}else{

					if ($numCelular == $numCelularUs) {
						
						$paso= $paso-1;

					}else{

						$paso = $paso;
					}
				}

				if ($respuestas[0] == $respuestaONE) {
						
						$paso = $paso;

				}else{

					$paso= $paso-1;

				}

				if ($respuestas[1] == $respuestaTWO) {
						
						$paso = $paso;

				}else{

					$paso= $paso-1;

				}

			}

			if ($paso < 4) {
				
				header("Location: ?paso=seguridad&opcion=FormContrasena&datosComprobar=false&ciVuelta=$ci");
			
			}else{

				$pasoFinal = true;
				require_once 'vista/login/recuperarPassword/formNewContrasena.php';
			}

			break;

			case 'comContrasenaLogin':
				
				$idUsuario = $_POST["idUsuario"];
				$contrasena = $_POST["contra_2"];

				$options = [
				    'cost' => 7,
				    'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

				$contrasena = password_hash($contrasena, PASSWORD_BCRYPT, $options);
 
				require_once ("modelo/usuario.php");
				$us= new usuario();

				$us->setContrasena($contrasena);
				$actPass = $us->actPass($idUsuario);

				header("Location: ?url=inicio&actPass=true");

			break;

			case 'resetQuest':
				
				$idUsuario = $_GET['idU'];
				$id = $_GET['id'];

				require_once ("modelo/usuario.php");
				$us= new usuario();

				$ciUser = $us->buscar($idUsuario);

				foreach ($ciUser as $ci) {
				 	
				 	$tipoRol = $ci['tipo_rol'];	 	

				 } 	

				$resultado = $seguridad->eliminarQuest($idUsuario);

				header("Location: ?url=seguridad&opcion=consultarUsuarios&id=$tipoRol&preguntasRest=true");

				break;

			case 'resetContrasena':

				$idUsuario = $_GET['idU'];
				$id = $_GET['id'];
				
				require_once ("modelo/usuario.php"); 
				$us= new usuario();

				$ciUser = $us->buscar($idUsuario);

				foreach ($ciUser as $ci) {
				 	
				 	$ciUsuario = $ci['cedula'];

				 	$tipoRol = $ci['tipo_rol'];
				 	

				 }

				$options = [
				    'cost' => 7,
				    'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

				$ciUsuario = password_hash($ciUsuario, PASSWORD_BCRYPT, $options); 		

				$us->setContrasena($ciUsuario);
					$actPass = $us->actPass($idUsuario);

				header("Location: ?url=seguridad&opcion=consultarUsuarios&id=$tipoRol&contraRest=true");
		
				break;



}

?>