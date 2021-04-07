<?php
$html = "";

if ($_POST["reporte"]==9) {

	$html = '
	<option value="20">Todos los usuarios</option>
	<option value="9">Super Usuario</option>
	<option value="3">Administrador</option>
	<option value="2">Operador</option>
	';	
}

if ($_POST["reporte"]==1) {

	$html = '
	<option value="1">Todos los usuarios</option>
	<option value="3">Administrador</option>
	<option value="2">Operador</option>
	';	
}

if ($_POST["reporte"]==2) {
	$html = '
	<option value="5">Todos los beneficiarios</option>
	<option value="6">Administrativo</option>
	<option value="7">Docente</option>
	<option value="8">Obrero</option>
	';	
}

if ($_POST["reporte"]==5) { 
	$html = '
	<option value="8">Obrero</option>
	';	
}

if ($_POST["reporte"]==6) {
	$html = '
	<option value="122">Administrativo</option>
	';	
}

if ($_POST["reporte"]==7) {
	$html = '
	<option value="7">Docente</option>
	';	
}

if ($_POST["reporte"]==3) {
	$html = '
	<option value="10">Registrados</option>
	<option value="11">Beneficiario entregado</option>
	<option value="12">Beneficiario por entregar</option>
	<option value="13">Beneficiario por pagar</option>
	';	
}

if ($_POST["reporte"]==4) {
	$html = '
	<option value="14">Todo el sistema</option>
	';	
}
echo $html;	
?>