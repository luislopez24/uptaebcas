<?php
$html = "";
if ($_POST["elegido"]==docente) {
	$html = '
	
    <option value="Agroalimentación">Agroalimentación</option>
    <option value="Administración">Administración</option>
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
if ($_POST["elegido"]==administrativo) {
	$html = '
	<option value="Biblioteca">Biblioteca</option>
    <option value="Caja">Caja</option>
    <option value="Compra">Compra</option>
    <option value="Consultorio">Consultorio</option>
    <option value="Control de actividades Academicas">Control de actividades Academicas</option>
    <option value="Departamento de mantenimiento de infraestructura y bienes">Departamento de mantenimiento de infraestructura y bienes</option>
    <option value="Dirección de administracion y servicio">Dirección de administracion y servicio</option>
    <option value="Dirección de despacho">Dirección de despacho</option>
    <option value="Dirección de estudios avanzados">Dirección de estudios avanzados</option>
    <option value="Dirección de servicio estudiantiles">Dirección de servicio estudiantiles</option> 
    <option value="Dirección de planificacion estrategica">Dirección de planificacion estrategica</option>
    <option value="Dirección de tecnologia">Dirección de tecnologia</option>
    <option value="Rectorado">Rectorado</option>
    <option value="Sala territorial">Sala territorial</option>
    <option value="Secretaria General">Secretaria General</option>
    <option value="Sitrauptaeb">Sitrauptaeb (Sindicato)</option>                           
    <option value="Talento humano">Talento humano</option>
    <option value="Vice-rectorado Academico">Vice-rectorado Academico</option>  
	';	
}
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