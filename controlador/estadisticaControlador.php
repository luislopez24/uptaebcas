<?php

//Obtenemos el año del select
$year = $_POST["year"];
$estadistica = $_POST["estadistica"];

//Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca
header('Content-Type: application/json');

require_once '../modelo/estadisticas.php';

$estadisticas = new Estadisticas();

switch ($estadistica) {
	case 'operativo':
		
		$total=array();

					for ($month = 1; $month <= 12; $month ++){
				
						$query=$estadisticas->consultarOperativoRealizados($month, $year);
						
						foreach ($query as $es) {
					 		
							$total[] = $es['total'];
						}
						
						
					}
		break;
	
	case 'beneficioE':
			
					$total=array();
					for ($month = 1; $month <= 12; $month ++){
				
						$query=$estadisticas->consultarBeneficioentregado($month, $year);
						
						foreach ($query as $es) {
							
							$total[] = $es['total'];
						}
						
						
					}
		break;

		case 'dineroI':
			
					$total=array();
						for ($month = 1; $month <= 12; $month ++){
					
							$query=$estadisticas->dineroIngresado($month, $year);
							
							foreach ($query as $es) {
								
								$total[] = $es['cash'];
							}
						
							
						}
		break;

		case 'benefL':
			
					$total=array();
						for ($month = 1; $month <= 12; $month ++){
					
							$query = $estadisticas->consultarBeneficioLogueados($month, $year);
							
							foreach ($query as $es) {
								
								$total[] = $es['total'];
							}
							
							
						}			 
			break;

}

	$tjan = $total[0];
	$tfeb = $total[1];
	$tmar = $total[2];
	$tapr = $total[3];
	$tmay = $total[4];
	$tjun = $total[5];
	$tjul = $total[6];
	$taug = $total[7];
	$tsep = $total[8];
	$toct = $total[9];
	$tnov = $total[10];
	$tdec = $total[11];

	//Guardamos los datos en un array
		$datos = array(
						'estado' => "ok",
						'enero' => $tjan,
						'febrero' => $tfeb, 
						'marzo' => $tmar,
						'abril' => $tapr, 
						'mayo' => $tmay,
						'junio' => $tjun, 
						'julio' => $tjul,
						'agosto' => $taug, 
						'septiembre' => $tsep,
						'octubre' => $toct, 
						'noviembre' => $tnov, 
						'diciembre' => $tdec,
						'year' => $year);

	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos, JSON_FORCE_OBJECT);

?>