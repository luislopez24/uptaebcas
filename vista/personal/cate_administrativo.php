<?php
$html = "";

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

echo $html;	
?>