<?php
$html = "";

if ($_POST["elegido"]==obrero) {
	$html = '
	<option value="Caja de ahorro">Caja de ahorro</option>
    <option value="Mantenimiento de infraestructura y bienes">Mantenimiento de infraestructura y bienes</option>
    <option value="Sindicato Sintrosuptaeb">Sindicato Sintrosuptaeb</option>
    <option value="Siprodoiuetaeb">Siprodoiuetaeb</option>
    <option value="Sobutaeb">Sobutaeb</option>
    <option value="Personal de servicio">Personal de servicio</option>
	';	
}

echo $html;	
?>