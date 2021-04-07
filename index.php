<?php
session_start();

$date = date("Y").'-'.date("m").'-'.date("d");
$dateA = date("Y");
                  
$url = "inicio";

if(isset($_GET["paso"])){

    $url = $_GET["paso"];

     if (is_file("controlador/" . $url . "Controlador.php")) {
        require_once ("controlador/" . $url . "Controlador.php");
    } 

}else{

    $url = "inicio";
}

if (isset($_SESSION["id_ussuario"])) {

    $idRol = $_SESSION["tipo_rol"];
    $id_ussuario = $_SESSION["id_ussuario"];

    require_once 'modelo/seguridad.php';

    $seguridadA = new Seguridad();

    $p = $seguridadA->consultarPermisos_usuarios($idRol, $id_ussuario);
    $permisos = $seguridadA->consultarPermisos_usuarios($idRol, $id_ussuario);
     
    if (!empty($_GET["url"])) {
        $url = $_GET["url"];
    } 

 if (is_file("controlador/" . $url . "Controlador.php")) {
        require_once ("controlador/" . $url . "Controlador.php");
    } else 
    {
    	$errorHttp = 'true';
        require_once ("controlador/inicioControlador.php");
    }

} 

    else {
	
        $http = 'nada';
        require_once ("controlador/". $url . "Controlador.php");    
    }
    
?>