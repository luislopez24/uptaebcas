<?php
$html = "";
if ($_POST["elegido"]==docente) {
	$html = '
	
    <option value="Agroalimentación">Agroalimentación</option>
    <option value="Ciencias de la información">Ciencias de la información</option>
    <option value="Contaduria Pública">Contaduria Pública</option>
    <option value="Deporte">Deporte</option>
    <option value="Higiene y Seguridad Laboral">Higiene y Seguridad Laboral</option>
    <option value="Informática">Informática</option>
    <option value="Logística">Logística</option> 
    <option value="Sistema de Calidad y Ambiente">Sistema de Calidad y Ambiente</option>
    <option value="Turismo">Turismo</option>
	';	
}

echo $html;	
?>