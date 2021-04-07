<?php

require_once ("modelo/beneficiario.php");
$beneficiario= new beneficiario();

$opcion = $_GET['opcion'];

switch ($opcion) {

	case 'distribuirBeneficiado':

	$idOperativo = $_GET['idOperativo'];

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
		$datosOperativo_Usuario = $beneficiario->consultar_filtrado($idOperativo, $dependencia, $identificacionOperador);
		$usuarioMoroso = $beneficiario->consultar_filtrado5($idOperativo, $dependencia, $identificacionOperador);

		require_once("vista/generar_dis/beneficiados.php");
	}

	if ($dependencia == 'Caja de ahorro' ||
		$dependencia == 'Mantenimiento de infraestructura y bienes' ||
		$dependencia == 'Sindicato Sintrosuptaeb' ||
		$dependencia == 'Siprodoiuetaeb' ||
		$dependencia == 'Sobutaeb' ||
		$dependencia == 'Personal de servicio'     
		){

	$identificacionOperador = 'Obrero';
	$datosOperativo_Usuario=$beneficiario->consultar_ver($idOperativo, $identificacionOperador);
	$usuarioMoroso=$beneficiario->consultar_fil($idOperativo, $identificacionOperador);

	require_once("vista/generar_dis/beneficiados.php");

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

	$identificacionOperador = $dependencia;
	$datosOperativo_Usuario=$beneficiario->consultar_ver($idOperativo, $identificacionOperador);
	$usuarioMoroso=$beneficiario->consultar_fil($idOperativo, $identificacionOperador);

	require_once("vista/generar_dis/beneficiados.php");
}


}else{

	$datosOperativo_Usuario=$beneficiario->consultarOperativo_Usuario($idOperativo);
	$usuarioMoroso = $beneficiario->consultarMoroso($idOperativo);
	require_once("vista/generar_dis/beneficiados.php");


}

break;

case 'inicioPago':

$porPagar=$beneficiario->operativos_por_pagar();
foreach ($porPagar as $moroso) {

	if (isset($moroso['id_operativo'])) {

		$cod = $moroso['id_operativo'];
	}

}

if (!isset($cod)) {

	$cod = 'no';
}

require_once"vista/datos_bene/benef.php";
break;

case 'formularioPago':

			    //Consultar los operativos que faltan por pagar
$porPagar=$beneficiario->operativos_por_pagar();

require_once("vista/datos_bene/Registropago.php");
break;

case 'validarRef':

if (isset($_GET['banco'])) {

	$banco = $_GET['banco'];
}

if ($banco == 'si') {


	$porPagar=$beneficiario->operativos_por_pagar();

	$id = $_POST['operativo'];

	foreach ($porPagar as $key) {

		if ($key['id_operativo'] == $id) {

			$banco = $key["banco_admitido"];
			$banco = mb_convert_case($banco, MB_CASE_TITLE, "UTF-8");

			echo "<i class='icon-work prefix' style='margin-top: 15px'></i> 
			<label>Banco Admitido</label> 
			<input type='text' value='".$banco."' disabled> 
			";
		}
	}

}else{
	$ref=$_POST['ref'];

	$resul=$beneficiario->Buscar_ref($ref) ;


	if ($resul['estatus'] && count($resul)==2) {

		require_once 'vista/publico/Head.php';
		echo "<script>jQuery(function(){swal(\"¡Oppss..!\", \"Este número de movimiento, ya es usado por otro usuario\", \"error\");});</script>";

		header("Location: ?url=beneficiario&opcion=formularioPago&errorRef=true");

	}else{

		if (!empty($ref)) {
			$c = $ref;
		}

		header("Location: ?url=beneficiario&opcion=formularioPago&ref=$c");
	}	
}		 
break;

case 'registrarPago':

$ref=$_POST['ref'];
$fecha=$_POST['fecha'];
$id_usuario = $_POST['id_usuario'];
$id_operativo = $_POST['id_operativo'];
				//Para marcar el operativo por entregar
$estatud='no';

$resul=$beneficiario->Buscar_ref($ref) ;

				//Para validar las fechas de pago con las del operativo a pagar
require_once ("modelo/operativo.php");

$operativo= new Operativo();

			    //Consultar los operativos que faltan por pagar
$porPagar=$beneficiario->operativos_por_pagar();
$cod2=$operativo->buscar($id_operativo);

$vali = null; 

foreach ($cod2 as $codigoOperativo):

	if($codigoOperativo['fecha_inicio_operativo'] > $fecha ){
		$vali = 'menor';
		require_once ("vista/datos_bene/Registropago.php"); 
	}else if ($fecha > $codigoOperativo['fecha_final_operativo']) {
		$vali = 'mayor';
		require_once ("vista/datos_bene/Registropago.php");
	}

endforeach; 

if ($vali == null) {
	

	foreach ($porPagar as $key) {
								//Para atajar el banco admitido por el operativo publicado
		if($key['id_operativo'] == $id_operativo){
			$ban = $key['banco_admitido'];
			$nombre_operativo = $key['nombre_operativo'];
		}
	}

	$beneficiario->setreferencia($ref);
	$beneficiario->setfecha_pago($fecha);
	$beneficiario->setbanco($ban);
	$beneficiario->setid_usuario_($id_usuario);
	$beneficiario->setid_operativo_($id_operativo);
	$beneficiario->setestatud($estatud);

	require_once 'modelo/bitacora.php';

	$bitacora = new Bitacora();

	$id_usuario = $_SESSION['id_ussuario'];
	$fecha = $date;

	date_default_timezone_set('America/Caracas');

	$hora = date("H:i:s");

	$accion = 'Registró pago del operativo '.$nombre_operativo;

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

	$resulRegistrar=$beneficiario->Registrar();

							if ($resulRegistrar['estatus']== true) { ////verificamos si se ejecuto correctamente el metodo del modelo
								$mensaje = 'Registro Exitoso del Usuario';
							}else {//si hay un error al registrar
								$mensaje = 'Error al registrar el Usuario, contacte con el soporte';
							}

							header("Location:?url=beneficiario&opcion=formularioPago&registroPago=true");
						}
						break;

						case 'consultarPagos':

						$datos=$beneficiario->consultar_pagos();
						require_once("vista/datos_bene/conBenef.php");
						break;

						case 'modificarPago':

						$id_operativo_usuario = $_POST['id_operativo_usuario'];
						$idOperativo = $_POST['idOperativo'];
						$banco = $_POST['banco'];
						$referenciaComparativa = $_POST['referenciaComparativa'];

						$ref=$_POST['ref'];
						$fecha=$_POST['fecha'];
				//Para marcar el operativo por entregar
						$estatud='no';

						$resul=$beneficiario->Buscar_ref($ref) ;

				//Para validar las fechas de pago con las del operativo a pagar
						require_once ("modelo/operativo.php");

						$operativo= new Operativo();

			    //Consultar los operativos que faltan por pagar
						$porPagar=$beneficiario->operativos_por_pagar();
						$cod2=$operativo->buscar($idOperativo);

						$vali = null; 

						foreach ($cod2 as $codigoOperativo):

							if($codigoOperativo['fecha_inicio_operativo'] > $fecha ){
								$vali = 'menor';
								$datos=$beneficiario->consultar_pagos();
								require_once("vista/datos_bene/conBenef.php"); 
							}else if ($fecha > $codigoOperativo['fecha_final_operativo']) {
								$vali = 'mayor';
								$datos=$beneficiario->consultar_pagos();
								require_once("vista/datos_bene/conBenef.php");
							}

						endforeach; 

						if ($vali == null) {


							foreach ($porPagar as $key) {
								//Para atajar el banco admitido por el operativo publicado
								if($key['id_operativo'] == $id_operativo){
									$ban = $key['banco_admitido'];
								}
							}

							$datos_nombre = $operativo->buscar($idOperativo);

							foreach ($datos_nombre as $nombre_o) {

								$nombre_operativo = $nombre_o['nombre_operativo'];

							}

							if ($referenciaComparativa = $ref) {

								$beneficiario->setreferencia($ref);
								$beneficiario->setfecha_pago($fecha);
								$beneficiario->setbanco($banco);
								$beneficiario->setestatud($estatud);

								require_once 'modelo/bitacora.php';

								$bitacora = new Bitacora();

								$id_usuario = $_SESSION['id_ussuario'];
								$fecha = $date;

								date_default_timezone_set('America/Caracas');

								$hora = date("H:i:s");

								$accion = 'Modificó el pago del operativo '.$nombre_operativo;

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

								$datos=$beneficiario->modificar($id_operativo_usuario);

									if ($resulRegistrar['estatus']== true) { ////verificamos si se ejecuto correctamente el metodo del modelo
										$mensaje = 'Registro Exitoso del Usuario';
									}else {//si hay un error al registrar
										$mensaje = 'Error al registrar el Usuario, contacte con el soporte';
									}

									header("Location:?url=beneficiario&opcion=consultarPagos&actPago=true");
								}else{

									$resul=$beneficiario->Buscar_ref($ref) ;

									if ($resul['estatus'] && count($resul)==2) {

										require_once 'vista/publico/Head.php';
										echo "<script>jQuery(function(){swal(\"¡Oppss..!\", \"Este número de movimiento, ya es usado por otro usuario\", \"error\");});</script>";

										header("Location: ?url=beneficiario&opcion=consultarPagos&errorRef=true");

									}else{

										$beneficiario->setreferencia($ref);
										$beneficiario->setfecha_pago($fecha);
										$beneficiario->setbanco($banco);
										$beneficiario->setestatud($estatud);

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
										$fecha = $date;

										date_default_timezone_set('America/Caracas');

										$hora = date("H:i:s");

										$accion = 'Modificó el pago del operativo '.$nombre_operativo;

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


										$datos=$beneficiario->modificar($id_operativo_usuario);

									if ($resulRegistrar['estatus']== true) { ////verificamos si se ejecuto correctamente el metodo del modelo
										$mensaje = 'Registro Exitoso del Usuario';
									}else {//si hay un error al registrar
										$mensaje = 'Error al registrar el Usuario, contacte con el soporte';
									}

									header("Location:?url=beneficiario&opcion=consultarPagos&actPago=true");
								}	
							}


						}
						break;

						case 'entregarOperativo':

						$id_o=$_GET['id_o'];
						$idUsuario=$_GET['idUsuario'];
						$estatud=$_GET['tatu'];
						$id = $_GET['id'];
						
						if ($estatud == 'si') {
							
							$fecha = $date;

						$beneficiario->setFechaE($fecha);
						
						}
						
						$beneficiario->setestatud($estatud);

						require_once 'modelo/usuario.php';
						$usuario = new Usuario;

						$datos = $usuario->buscar($idUsuario);

						foreach ($datos as $usuario) {
							
							$tci = $usuario['tcedula'];
							$ci = $usuario['cedula'];

						

						require_once 'modelo/bitacora.php';

						$bitacora = new Bitacora();

						$id_usuario = $_SESSION['id_ussuario'];
						$fecha = $date;

						date_default_timezone_set('America/Caracas');

						$hora = date("H:i:s");

						if (isset($_GET['quitado'])) {

							$accion = 'Le quitó el operativo al beneficiario '.$tci."-".$ci;

						}else{

							$accion = 'Entregó el operativo al beneficiario '.$tci."-".$ci;
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

						$datos=$beneficiario->modificar_estatud($id);

						if (isset($_GET['quitado'])) {

							header("Location:?url=beneficiario&opcion=distribuirBeneficiado&idOperativo=$id_o&quitado=true");	

						}else{

							header("Location:?url=beneficiario&opcion=distribuirBeneficiado&idOperativo=$id_o&entregado=true");
						}
						}
						break;
						
		case 'check_numero':

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