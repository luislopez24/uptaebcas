<?php

require_once 'modelo/BD/conexion.php';

if (isset($_GET['opcion'])) {
	
	$opcion = $_GET['opcion'];

}else{

	$opcion = 'index';
}

if (isset($http)) {
	
	if(isset($_SESSION["id_ussuario"]))
	{
		header("Location:?url=index");
	}
			
			$pdo = new BD(); 
				
			if ($pdo->getrRepConexion()==false){
			
				echo "Error de Conexion en :".$pdo->getErrorConexion();
		
			} else {

				if (!empty($_POST['ingresar'])){

						if (!empty($_POST['captcha'])) {

							$capt = sha1($_POST['captcha']);

							  if ($capt == $_COOKIE['captcha']) {
						
							
									require_once 'modelo/usuario.php';

									$us= new Usuario();
									$cedula=$_POST['user'];
									$pass=$_POST['pass'];
									
									$options = [
									    'cost' => 7,
									    'salt' => 'UniversidadPolitecnicaTerritorialAEB',
									];

									$pass = password_hash($pass, PASSWORD_BCRYPT, $options);

									$us-> setCedula($cedula);
									$us-> setContrasena($pass);
									$reslogin = $us->entrar();

									if (isset($_SESSION['status']) && $_SESSION['status'] == 'Disabled') {
										
										session_destroy();
										
										$usuarioBloqueado = 'true';
										require_once("vista/login/login.php");

									} else {
 
									if ($reslogin['estatus']== false) {
										
										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$consulta_cedula = $us->buscar_ci($cedula);

										foreach ($consulta_cedula as $existe) {
											
											if (isset($existe['cedula'])) {
												
												$id_usuario = $existe['id_usuario'];
												$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Login error';

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
										}

										$login = 'false';
										require_once("vista/login/login.php");
										
										}else{

										require_once ("modelo/operativo.php");

										$operativo= new Operativo();
									    $datos=$operativo->consultar_publicacion_();

									    foreach ($datos as $operativo_fecha):

									    		if ($operativo_fecha['fecha_final_operativo'] <= $date) {
									    			
									    			$id = $operativo_fecha['id_operativo'];
													$estatud = 'clau';

													$operativo->setestado($estatud);
													$modificarResultado = $operativo->publicar($id);	
									    		}

									    endforeach;

									    require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$consulta_cedula = $us->buscar_ci($cedula);

										foreach ($consulta_cedula as $existe) {
											
											if (isset($existe['cedula'])) {
												
												$id_usuario = $existe['id_usuario'];
												$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Login success';

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
										}

										$preguntas = $us->segurityQuestions($id_usuario);
										

											$num = 0;
										foreach ($preguntas as $quest) {

											$num++;
											
										}
										
										$_SESSION["numQuestions"] = $num;	
										$options = [
										    'cost' => 7,
										    'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

										$ciu = $_SESSION["cedula"];
										$ciu = password_hash($ciu, PASSWORD_BCRYPT, $options);

									    if ($_SESSION["contrasena"] == $ciu || $_SESSION["foto"] == null || $_SESSION["numQuestions"]<2) {		    								    	
									    	header("Location: ?url=usuario&opcion=editarPerfil&mensaje=Bienvenido");
									    	
									    }else{  

									    setcookie("captcha", "eliminar", time()- 86400, "/");
										header("Location: ?url=inicio&opcion=index&mensaje=Bienvenido");

									 		}
										} 

									}
							
							}else{


								$captcha = 'incorrecto';
								require_once("vista/login/login.php");
								
							}

						}else{

							if (empty($cedula=$_POST['user'])) {
								
								$faltaDatos = 'true';
							
							}

							if (empty($pass=$_POST['pass'])) {
								
								$faltaDatos = 'true';
							
							}

							else{

								$captcha = 'vacio';
							}
							
							require_once("vista/login/login.php");


						}

					}else{

						require_once("vista/login/login.php");

					}
				}

}

else{

switch ($opcion) {

	case 'destroid':
		
		require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Login out';

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
		//Eliminamos las cookies 
		setcookie("nombre", "eliminar",time() - 86400);
		setcookie("fechaf", "eliminar", time() - 86400);
		setcookie("fechai", "eliminar", time() - 86400);
		setcookie("precio", "eliminar", time() - 86400);
		setcookie("descrip", "eliminar", time() - 86400);

		session_destroy();

		require_once("vista/login/login.php");
		break;

	case 'index':
		
		require_once ("modelo/operativo.php");

		$operativo= new Operativo();
	    $datos=$operativo->consultar_publicacion_();

	    foreach ($datos as $operativo_fecha):

	    		if ($operativo_fecha['fecha_final_operativo'] <= $date) {
	    			
	    			$id = $operativo_fecha['id_operativo'];
					$estatud = 'clau';

					$operativo->setestado($estatud);
					$modificarResultado = $operativo->publicar($id);	
	    		}

	    endforeach;

		require_once("vista/inicio/inicio.php");
		break;


}

}

if (isset($errorHttp)) {
	
	require_once "vista/error.php" ;
} 	
	
?>
