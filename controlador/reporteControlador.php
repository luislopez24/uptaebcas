<?php
	
	$opcion = $_GET['opcion'];

	switch ($opcion) {

		case 'inicioReporte':
			
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

					}

						if ($dependencia == 'Caja de ahorro' ||
							$dependencia == 'Mantenimiento de infraestructura y bienes' ||
							$dependencia == 'Sindicato Sintrosuptaeb' ||
							$dependencia == 'Siprodoiuetaeb' ||
							$dependencia == 'Sobutaeb' ||
							$dependencia == 'Personal de servicio'     
						){

						$identificacionOperador = 'Obrero';

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

					$identificacionOperador = 'Administrativo';

			} 

				    require_once("vista/generar_rep/report.html");	
				    
			}else{

				$identificacionOperador = 'false';	
				require_once("vista/generar_rep/report.html");	
				}	    	 
			break;
		
		case 'generar':

			require_once 'modelo/pdf.php';
			$objOperativo = new Pdf_1();

			$opcion = $_POST["categoria"];
			$identificacionOperador = $_POST['identificacionOperador'];

			if ($identificacionOperador == 'false') {
				
				//Beneficiario con operativos entregados
				if($opcion =='11'){

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de operativos entregados';

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

					$r1 = $objOperativo->operativo_entregado();

					$mensaje = '';
					require_once 'vista/config/libreria/fpdf.php';
					
					class PDF extends FPDF
					{
					// Cabecera de página
					function Header()
					{
					    // Logo
					    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
					    // Arial bold 15
					    $this->SetFont('Arial','B',15);
					    // Salto de línea
					    $this->Ln(8);
					    // Movernos a la derecha
					    $this->Cell(65);
			 		    // Título
					    $this->Cell(65,10,'Operativos Entregados',1,0,'C');
					    // Salto de línea
					    $this->Ln(20);
					}

					// Pie de página
					function Footer()
					{
					    // Posición: a 1,5 cm del final
					    $this->SetY(-15);
					    // Arial italic 8
					    $this->SetFont('Arial','I',8);
					    // Número de página
					    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
					}
					}

					// Creación del objeto de la clase heredada
					$pdf = new PDF();
					$pdf->AliasNbPages();
					$pdf->AddPage();
					$pdf->SetFont('Times','',12);
					
					$pdf->Ln(6);
					//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
					$pdf->SetFillColor(232,232,232);

					$pdf->SetFont('Arial','B',10);
					//185 total para que entre en la pagina
					
					foreach ($r1 as $valor) {
						if (isset($valor["id_operativo_usuario"])) {
							//DATOS DEL OPERATIVO PAGADO
							$pdf->Cell(30,6,'Operativo',1,0,'C',1);
							$pdf->Cell(35,6,'Precio',1,0,'C',1);
							$pdf->Cell(70,6,'Referencia',1,0,'C',1);
							$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
							$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
							$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
							$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
							$pdf->Cell(185,6,'Banco',1,0,'C',1);
							$pdf->Ln(6);
							$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
							//DATOS USUARIO
							$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,'Cedula',1,0,'C',1);
							$pdf->Cell(30,6,'Nombre',1,0,'C',1);
							$pdf->Cell(30,6,'Apellido',1,0,'C',1);
							$pdf->Cell(30,6,'Celular',1,0,'C',1);
							$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
							$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
							$pdf->Ln(6);
						}
					}

					$pdf->Output();
			}

			if ($opcion =='9') {

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de Super Usuarios registrados';

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
							
							$usuario = '1';
							$r1 = $objOperativo->usuario($usuario);
							
								$mensaje = '';
								require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(75,10,'Super Usuarios registrados',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
							
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode($valor['nombreRol']),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }

								$pdf->Output();

						}

			//Beneficiario por entregar operativo 
			if ($opcion =='12') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de operativos no entregados';

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
		
					$r1 = $objOperativo->operativo_no_entregado();

						$mensaje = '';
						require_once 'vista/config/libreria/fpdf.php';
						
						class PDF extends FPDF
						{
						// Cabecera de página
						function Header()
						{
						    // Logo
						    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
						    // Arial bold 15
						    $this->SetFont('Arial','B',15);
						    // Salto de línea
						    $this->Ln(8);
						    // Movernos a la derecha
						    $this->Cell(65);
						    // Título
						    $this->Cell(65,10,'Operativos por Entregar',1,0,'C');
						    // Salto de línea
						    $this->Ln(20);
						}

						// Pie de página
						function Footer()
						{
						    // Posición: a 1,5 cm del final
						    $this->SetY(-15);
						    // Arial italic 8
						    $this->SetFont('Arial','I',8);
						    // Número de página
						    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
						}
						}

						// Creación del objeto de la clase heredada
						$pdf = new PDF();
						$pdf->AliasNbPages();
						$pdf->AddPage();
						$pdf->SetFont('Times','',12);
						
						$pdf->Ln(6);
						//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
						$pdf->SetFillColor(232,232,232);

						$pdf->SetFont('Arial','B',10);
						//185 total para que entre en la pagina
						
						foreach ($r1 as $valor) {
							if (isset($valor["id_operativo_usuario"])) {
								//DATOS DEL OPERATIVO PAGADO
								$pdf->Cell(30,6,'Operativo',1,0,'C',1);
								$pdf->Cell(35,6,'Precio',1,0,'C',1);
								$pdf->Cell(70,6,'Referencia',1,0,'C',1);
								$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
								$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
								$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
								$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
								$pdf->Cell(185,6,'Banco',1,0,'C',1);
								$pdf->Ln(6);
								$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
								//DATOS USUARIO
								$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,'Cedula',1,0,'C',1);
								$pdf->Cell(30,6,'Nombre',1,0,'C',1);
								$pdf->Cell(30,6,'Apellido',1,0,'C',1);
								$pdf->Cell(30,6,'Celular',1,0,'C',1);
								$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
								$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
								$pdf->Ln(6);
								
							}
						}
						$pdf->Output();
				}

				//Operativos registrados
				if ($opcion =='10') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de operativos registrados';

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
		
						$r1 = $objOperativo->consultarOperativo();
						
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(65);
							    // Título
							    $this->Cell(65,10,'Operativos Registrados',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							
								
							foreach ($r1 as $valor) {
								if (isset($valor["id_operativo"])) {
									
									$pdf->Cell(185,6,'Operativo',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
									
									$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
									$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
									
									$pdf->Ln(5.9);		
									$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

									$id_operativo = $valor['id_operativo'];
									$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
									
									$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
									foreach ($clasificacionDelOperativo as $clas) {
									$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
									}
									
									$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
									$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
								
									foreach ($diversidadesRegistradas as $valor2) {
									$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
									
									}

									$pdf->Ln(4);

								}
							}

							$pdf->Output();

					}

					//Beneficiario por Pagar
					if ($opcion=='13') {		

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de beneficiarios por pagar operativo';

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
		
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Operativos por pagar',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];

							$r5 = $objOperativo->consultarMoroso($id);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}

					//beneficiarios que pagaron
					if ($opcion=='30') {		

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de beneficiarios que pagaron operativos';

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
		
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Operativos pagados',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];
							

							$r5 = $objOperativo->usuarios_pagos($id);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiarios que pagaron operativos',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'" - costo: '.$key['precio_operativo'].' bsS'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}

				if ($opcion =='8') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de registros de personal obrero';

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
						
						$rol = 'Obrero';		
						$r1 = $objOperativo->personalRol($rol);
						
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Personal Obrero',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
						
							
							foreach ($r1 as $valor) {
								if (isset($valor["id_usuario"])) {
									
									$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);			
								 }
							 }

							$pdf->Output();

					}

					if ($opcion =='7') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de registros de personal docente';

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
							
							$rol = 'Docente';
							$r1 = $objOperativo->personalRol($rol);
							
								$mensaje = '';
								require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(65,10,'Personal Docente',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
							
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }

								$pdf->Output();

						}


						if ($opcion =='6') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de registros de personal administrativo';

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
								
								$rol = 'Administrativo';
								$r1 = $objOperativo->personalRol($rol); 
								
									$mensaje = '';
									require_once 'vista/config/libreria/fpdf.php';
									
									class PDF extends FPDF
									{
									// Cabecera de página
									function Header()
									{
									    // Logo
									    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
									    // Arial bold 15
									    $this->SetFont('Arial','B',15);
									    // Salto de línea
									    $this->Ln(8);
									    // Movernos a la derecha
									    $this->Cell(65);
									    // Título
									    $this->Cell(65,10,'Personal Administrativo',1,0,'C');
									    // Salto de línea
									    $this->Ln(20);
									}

									// Pie de página
									function Footer()
									{
									    // Posición: a 1,5 cm del final
									    $this->SetY(-15);
									    // Arial italic 8
									    $this->SetFont('Arial','I',8);
									    // Número de página
									    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
									}
									}

									// Creación del objeto de la clase heredada
									$pdf = new PDF();
									$pdf->AliasNbPages();
									$pdf->AddPage();
									$pdf->SetFont('Times','',12);
									
									$pdf->Ln(6);
									//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
									$pdf->SetFillColor(232,232,232);

									$pdf->SetFont('Arial','B',10);
									//185 total para que entre en la pagina
								
									
									foreach ($r1 as $valor) {
										if (isset($valor["id_usuario"])) {
											
											$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
											$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
											$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
											$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
											$pdf->Ln(5.9);
											$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
											$pdf->Cell(67,6,'Email',1,0,'C',1);
											$pdf->Cell(51,6,'Celular',1,0,'C',1);
											$pdf->Cell(67,6,'Rol',1,1,'C',1);
											$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
											$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
											$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
											
											$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
											
											$pdf->Cell(185,6,'Direccion',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
											$pdf->Ln(6);			
										 }
									 }

									$pdf->Output();

							}

						if ($opcion =='5') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de beneficiarios registrados';

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
		
								$r1 = $objOperativo->personal();
								
									$mensaje = '';
									require_once 'vista/config/libreria/fpdf.php';
									
									class PDF extends FPDF
									{
									// Cabecera de página
									function Header()
									{
									    // Logo
									    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
									    // Arial bold 15
									    $this->SetFont('Arial','B',15);
									    // Salto de línea
									    $this->Ln(8);
									    // Movernos a la derecha
									    $this->Cell(65);
									    // Título
									    $this->Cell(70,10,'Beneficiarios Registrados',1,0,'C'); 
									    // Salto de línea
									    $this->Ln(20);
									}

									// Pie de página
									function Footer()
									{
									    // Posición: a 1,5 cm del final
									    $this->SetY(-15);
									    // Arial italic 8
									    $this->SetFont('Arial','I',8);
									    // Número de página
									    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
									}
									}

									// Creación del objeto de la clase heredada
									$pdf = new PDF();
									$pdf->AliasNbPages();
									$pdf->AddPage();
									$pdf->SetFont('Times','',12);
									
									$pdf->Ln(6);
									//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
									$pdf->SetFillColor(232,232,232);

									$pdf->SetFont('Arial','B',10);
									//185 total para que entre en la pagina
								
									
									foreach ($r1 as $valor) {
										if (isset($valor["id_usuario"])) {
											
											$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
											$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
											$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
											$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
											$pdf->Ln(5.9);
											$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
											$pdf->Cell(67,6,'Email',1,0,'C',1);
											$pdf->Cell(51,6,'Celular',1,0,'C',1);
											$pdf->Cell(67,6,'Rol',1,1,'C',1);
											$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
											$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
											$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
											
											$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
											
											$pdf->Cell(185,6,'Direccion',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
											$pdf->Ln(6);			
										 }
									 }

									$pdf->Output();

							}

							if ($opcion =='3') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de administradores registrados';

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
								
								$usuario = '2';
								$r1 = $objOperativo->usuario($usuario);
								
									$mensaje = '';
									require_once 'vista/config/libreria/fpdf.php';
									
									class PDF extends FPDF
									{
									// Cabecera de página
									function Header()
									{
									    // Logo
									    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
									    // Arial bold 15
									    $this->SetFont('Arial','B',15);
									    // Salto de línea
									    $this->Ln(8);
									    // Movernos a la derecha
									    $this->Cell(55);
									    // Título
									    $this->Cell(80,10,'Administradores Registrados',1,0,'C');
									    // Salto de línea
									    $this->Ln(20);
									}

									// Pie de página
									function Footer()
									{
									    // Posición: a 1,5 cm del final
									    $this->SetY(-15);
									    // Arial italic 8
									    $this->SetFont('Arial','I',8);
									    // Número de página
									    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
									}
									}

									// Creación del objeto de la clase heredada
									$pdf = new PDF();
									$pdf->AliasNbPages();
									$pdf->AddPage();
									$pdf->SetFont('Times','',12);
									
									$pdf->Ln(6);
									//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
									$pdf->SetFillColor(232,232,232);

									$pdf->SetFont('Arial','B',10);
									//185 total para que entre en la pagina
								
									
									foreach ($r1 as $valor) {

										if (isset($valor["id_usuario"])) {
											
											$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
											$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
											$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
											$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
											$pdf->Ln(5.9);
											$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
											$pdf->Cell(67,6,'Email',1,0,'C',1);
											$pdf->Cell(51,6,'Celular',1,0,'C',1);
											$pdf->Cell(67,6,'Rol',1,1,'C',1);
											$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
											$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
											$pdf->Cell(67,6,utf8_decode($valor['nombreRol']),1,1,'C');
											
											$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
											
											$pdf->Cell(185,6,'Direccion',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
											$pdf->Ln(6);			
										 }
									 }

									$pdf->Output();

							}


						if ($opcion =='2') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de operadores registrados';

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
							
							$usuario = '3';
							$r1 = $objOperativo->usuario($usuario);
							
								$mensaje = '';
								require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(55);
								    // Título
								    $this->Cell(80,10,'Operadores Registrados',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
							
								
								foreach ($r1 as $valor) {

									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode($valor['nombreRol']),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }

								$pdf->Output();

						}

						if ($opcion =='20') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de usuarios registrados';

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
		
								$r1 = $objOperativo->usuariosMasSU();
								
									$mensaje = '';
									require_once 'vista/config/libreria/fpdf.php';
									
									class PDF extends FPDF
									{
									// Cabecera de página
									function Header()
									{
									    // Logo
									    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
									    // Arial bold 15
									    $this->SetFont('Arial','B',15);
									    // Salto de línea
									    $this->Ln(8);
									    // Movernos a la derecha
									    $this->Cell(65);
									    // Título
									    $this->Cell(65,10,'Usuarios Registrados',1,0,'C');
									    // Salto de línea
									    $this->Ln(20);
									}

									// Pie de página
									function Footer()
									{
									    // Posición: a 1,5 cm del final
									    $this->SetY(-15);
									    // Arial italic 8
									    $this->SetFont('Arial','I',8);
									    // Número de página
									    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
									}
									}

									// Creación del objeto de la clase heredada
									$pdf = new PDF();
									$pdf->AliasNbPages();
									$pdf->AddPage();
									$pdf->SetFont('Times','',12);
									
									$pdf->Ln(6);
									//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
									$pdf->SetFillColor(232,232,232);

									$pdf->SetFont('Arial','B',10);
									//185 total para que entre en la pagina
								
									
									foreach ($r1 as $valor) {
										
										if (isset($valor["id_usuario"])) {
											
											$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
											$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
											$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
											$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
											$pdf->Ln(5.9);
											$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
											$pdf->Cell(67,6,'Email',1,0,'C',1);
											$pdf->Cell(51,6,'Celular',1,0,'C',1);
											$pdf->Cell(67,6,'Rol',1,1,'C',1);
											$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
											$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
											$pdf->Cell(67,6,utf8_decode($valor['nombreRol']),1,1,'C');
											
											$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
											
											$pdf->Cell(185,6,'Direccion',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
											$pdf->Ln(6);			
										 }
									 }

									$pdf->Output();

							}

						if ($opcion =='1') {

										require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de usuarios registrados';

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
		
								$r1 = $objOperativo->usuarios();
								
									$mensaje = '';
									require_once 'vista/config/libreria/fpdf.php';
									
									class PDF extends FPDF
									{
									// Cabecera de página
									function Header()
									{
									    // Logo
									    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
									    // Arial bold 15
									    $this->SetFont('Arial','B',15);
									    // Salto de línea
									    $this->Ln(8);
									    // Movernos a la derecha
									    $this->Cell(65);
									    // Título
									    $this->Cell(65,10,'Usuarios Registrados',1,0,'C');
									    // Salto de línea
									    $this->Ln(20);
									}

									// Pie de página
									function Footer()
									{
									    // Posición: a 1,5 cm del final
									    $this->SetY(-15);
									    // Arial italic 8
									    $this->SetFont('Arial','I',8);
									    // Número de página
									    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
									}
									}

									// Creación del objeto de la clase heredada
									$pdf = new PDF();
									$pdf->AliasNbPages();
									$pdf->AddPage();
									$pdf->SetFont('Times','',12);
									
									$pdf->Ln(6);
									//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
									$pdf->SetFillColor(232,232,232);

									$pdf->SetFont('Arial','B',10);
									//185 total para que entre en la pagina
								
									
									foreach ($r1 as $valor) {
										
										if (isset($valor["id_usuario"])) {
											
											$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
											$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
											$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
											$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
											$pdf->Ln(5.9);
											$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
											$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
											$pdf->Cell(67,6,'Email',1,0,'C',1);
											$pdf->Cell(51,6,'Celular',1,0,'C',1);
											$pdf->Cell(67,6,'Rol',1,1,'C',1);
											$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
											$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
											$pdf->Cell(67,6,utf8_decode($valor['nombreRol']),1,1,'C');
											
											$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
											
											$pdf->Cell(185,6,'Direccion',1,1,'C',1);
											$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
											$pdf->Ln(6);			
										 }
									 }

									$pdf->Output();

							}


						//REPORTE DE TODO EL SISTEMA
						if ($opcion =='14') {

							require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte global';

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
							
							$mensaje = '';
								require_once 'vista/config/libreria/fpdf.php';
								
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(55);
								    // Título
								    $this->Cell(90,10,'Reporte del Sistema CAS',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								$r7 = $objOperativo->usuarios();
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina

								$pdf->Cell(-24);
								$pdf->Cell(90,10,'Usuarios Registrados',0,1,'C');

								foreach ($r7 as $valor) {

								if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,$valor['nombreRol'],1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }

								$pdf->AddPage();

								$r8 = $objOperativo->personal();
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
								
								$pdf->Cell(-24);
								$pdf->Cell(90,10,'Beneficiados Registrados',0,1,'C');

								foreach ($r8 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }
								$pdf->AddPage();

								$r1 = $objOperativo->consultarOperativo();
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
								
								$pdf->Cell(-24);
								$pdf->Cell(90,10,'Operativos Registrados',0,1,'C');

								// Creación del objeto de la clase heredada								
									
								foreach ($r1 as $valor) {
									if (isset($valor["id_operativo"])) {
										
										$pdf->Cell(185,6,'Operativo',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
										
										$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
										$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
										
										$pdf->Ln(5.9);		
										$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

										$id_operativo = $valor['id_operativo'];
										$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
										
										$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
										foreach ($clasificacionDelOperativo as $clas) {
										$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
										}
										
										$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
										$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
										$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
										$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
										$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
									
										foreach ($diversidadesRegistradas as $valor2) {
										$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
										
										}

										$pdf->Ln(4);

									}
								}
								$pdf->AddPage();

								$r3 = $objOperativo->operativo_entregado();
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
								
								$pdf->Cell(-24);
								$pdf->Cell(90,10,'Operativos Entregados',0,1,'C');

								foreach ($r3 as $valor) {
									if (isset($valor["id_operativo_usuario"])) {
										//DATOS DEL OPERATIVO PAGADO
										$pdf->Cell(30,6,'Operativo',1,0,'C',1);
										$pdf->Cell(35,6,'Precio',1,0,'C',1);
										$pdf->Cell(70,6,'Referencia',1,0,'C',1);
										$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
										$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
										$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
										$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
										$pdf->Cell(185,6,'Banco',1,0,'C',1);
										$pdf->Ln(6);
										$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
										//DATOS USUARIO
										$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(30,6,'Cedula',1,0,'C',1);
										$pdf->Cell(30,6,'Nombre',1,0,'C',1);
										$pdf->Cell(30,6,'Apellido',1,0,'C',1);
										$pdf->Cell(30,6,'Celular',1,0,'C',1);
										$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
										$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
										$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
										$pdf->Ln(6);
									}
								}

								$pdf->AddPage();
								$r4 = $objOperativo->operativo_no_entregado();
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
								
								$pdf->Cell(-24);
								$pdf->Cell(90,10,'Operativos por Entregar',0,1,'C');

								foreach ($r4 as $valor) {
									if (isset($valor["id_operativo_usuario"])) {
										//DATOS DEL OPERATIVO PAGADO
										$pdf->Cell(30,6,'Operativo',1,0,'C',1);
										$pdf->Cell(35,6,'Precio',1,0,'C',1);
										$pdf->Cell(70,6,'Referencia',1,0,'C',1);
										$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
										$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
										$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
										$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
										$pdf->Cell(185,6,'Banco',1,0,'C',1);
										$pdf->Ln(6);
										$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
										//DATOS USUARIO
										$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(30,6,'Cedula',1,0,'C',1);
										$pdf->Cell(30,6,'Nombre',1,0,'C',1);
										$pdf->Cell(30,6,'Apellido',1,0,'C',1);
										$pdf->Cell(30,6,'Celular',1,0,'C',1);
										$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
										$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
										$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
										$pdf->Ln(6);
									}
								}

								$pdf->AddPage();

								$datos=$objOperativo->consultarOperativo();

								foreach ($datos as $key) {

								$id = $key['id_operativo'];
								$nom = $key['nombre_operativo'];

								$r5 = $objOperativo->consultarMoroso($id);

								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
								
								$pdf->Cell(-17);
								$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

								foreach ($r5 as $valor):

									if (isset($valor["id_usuario"])) {
										$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
									    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode($valor['area']),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);
										
									}
								endforeach;

							}
								$pdf->Output();
								}


			}

			#<!-- ============================================================== -->
  			#<!--                  REPORTE PARA LOS DOCENTES                     -->
  			#<!-- ============================================================== -->
			if ($identificacionOperador == 'Docente') {

				$dependencia = $_SESSION['dependencia'];
				$operador = $identificacionOperador;
				
				if ($opcion =='7') {

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de personal docente';

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
							
							$rol = 'Docente';
							$r1 = $objOperativo->personal_individual($dependencia, $operador);
							
								$mensaje = '';
								require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(65,10,'Personal Docente',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
							
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode($valor['nombreRol']),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }

								$pdf->Output();

						}

				//Operativos registrados
				if ($opcion =='10') {

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de operativos registrados';

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
		
						$r1 = $objOperativo->consultarOperativo();
						
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(65);
							    // Título
							    $this->Cell(65,10,'Operativos Registrados',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							
								
							foreach ($r1 as $valor) {
								if (isset($valor["id_operativo"])) {
									
									$pdf->Cell(185,6,'Operativo',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
									
									$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
									$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
									
									$pdf->Ln(5.9);		
									$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

									$id_operativo = $valor['id_operativo'];
									$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
									
									$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
									foreach ($clasificacionDelOperativo as $clas) {
									$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
									}
									
									$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
									$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
								
									foreach ($diversidadesRegistradas as $valor2) {
									$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
									
									}

									$pdf->Ln(4);

								}
							}

							$pdf->Output();

					}

				//Docentes con operativos entregados
				if($opcion =='11'){

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de docentes con operativos entregados';

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

					$r1 = $objOperativo->operativo_entregado_individual($dependencia, $operador);

					$mensaje = '';
					require_once 'vista/config/libreria/fpdf.php';
					
					class PDF extends FPDF
					{
					// Cabecera de página
					function Header()
					{
					    // Logo
					    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
					    // Arial bold 15
					    $this->SetFont('Arial','B',15);
					    // Salto de línea
					    $this->Ln(8);
					    // Movernos a la derecha
					    $this->Cell(65);
					    // Título
					    $this->Cell(65,10,'Operativos Entregados',1,0,'C');
					    // Salto de línea
					    $this->Ln(20);
					}

					// Pie de página
					function Footer()
					{
					    // Posición: a 1,5 cm del final
					    $this->SetY(-15);
					    // Arial italic 8
					    $this->SetFont('Arial','I',8);
					    // Número de página
					    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
					}
					}

					// Creación del objeto de la clase heredada
					$pdf = new PDF();
					$pdf->AliasNbPages();
					$pdf->AddPage();
					$pdf->SetFont('Times','',12);
					
					$pdf->Ln(6);
					//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
					$pdf->SetFillColor(232,232,232);

					$pdf->SetFont('Arial','B',10);
					//185 total para que entre en la pagina
					
					foreach ($r1 as $valor) {
						if (isset($valor["id_operativo_usuario"])) {
							//DATOS DEL OPERATIVO PAGADO
							$pdf->Cell(30,6,'Operativo',1,0,'C',1);
							$pdf->Cell(35,6,'Precio',1,0,'C',1);
							$pdf->Cell(70,6,'Referencia',1,0,'C',1);
							$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
							$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
							$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
							$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
							$pdf->Cell(185,6,'Banco',1,0,'C',1);
							$pdf->Ln(6);
							$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
							//DATOS USUARIO
							$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,'Cedula',1,0,'C',1);
							$pdf->Cell(30,6,'Nombre',1,0,'C',1);
							$pdf->Cell(30,6,'Apellido',1,0,'C',1);
							$pdf->Cell(30,6,'Celular',1,0,'C',1);
							$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
							$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
							$pdf->Ln(6);
						}
					}

					$pdf->Output();
			}

			//Beneficiario por entregar operativo 
			if ($opcion =='12') {

				require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de docentes con operativos por entregar';

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
		
					$r1 = $objOperativo->operativo_no_entregado_individual($dependencia, $operador);

						$mensaje = '';
						require_once 'vista/config/libreria/fpdf.php';
						
						class PDF extends FPDF
						{
						// Cabecera de página
						function Header()
						{
						    // Logo
						    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
						    // Arial bold 15
						    $this->SetFont('Arial','B',15);
						    // Salto de línea
						    $this->Ln(8);
						    // Movernos a la derecha
						    $this->Cell(65);
						    // Título
						    $this->Cell(65,10,'Operativos por Entregar',1,0,'C');
						    // Salto de línea
						    $this->Ln(20);
						}

						// Pie de página
						function Footer()
						{
						    // Posición: a 1,5 cm del final
						    $this->SetY(-15);
						    // Arial italic 8
						    $this->SetFont('Arial','I',8);
						    // Número de página
						    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
						}
						}

						// Creación del objeto de la clase heredada
						$pdf = new PDF();
						$pdf->AliasNbPages();
						$pdf->AddPage();
						$pdf->SetFont('Times','',12);
						
						$pdf->Ln(6);
						//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
						$pdf->SetFillColor(232,232,232);

						$pdf->SetFont('Arial','B',10);
						//185 total para que entre en la pagina
						
						foreach ($r1 as $valor) {
							if (isset($valor["id_operativo_usuario"])) {
								//DATOS DEL OPERATIVO PAGADO
								$pdf->Cell(30,6,'Operativo',1,0,'C',1);
								$pdf->Cell(35,6,'Precio',1,0,'C',1);
								$pdf->Cell(70,6,'Referencia',1,0,'C',1);
								$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
								$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
								$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
								$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
								$pdf->Cell(185,6,'Banco',1,0,'C',1);
								$pdf->Ln(6);
								$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
								//DATOS USUARIO
								$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,'Cedula',1,0,'C',1);
								$pdf->Cell(30,6,'Nombre',1,0,'C',1);
								$pdf->Cell(30,6,'Apellido',1,0,'C',1);
								$pdf->Cell(30,6,'Celular',1,0,'C',1);
								$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
								$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
								$pdf->Ln(6);
								
							}
						}
						$pdf->Output();
				}

				//Docente por Pagar
				if ($opcion=='13') {		

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de docentes por pagar operativo';

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
		
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Operativos por pagar',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];

							$r5 = $objOperativo->consultarMoroso_individual($id, $operador, $dependencia);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['tipo_rol'], 'UTF-8')),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}
				
			//Reporte del todo el sistema
			if ($opcion =='14') {
							
							require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;
											
												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte global docente';

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

							$rol = 'Docente';
							$r1 = $objOperativo->personal_individual($dependencia, $operador);
												
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(65,10,'Personal Docente',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
						
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina	
								$pdf->Cell(-10);
								$pdf->Cell(90,10,'Beneficiarios registrados en su area',0,1,'C');
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode($valor['nombreRol']),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }
						
						$pdf->AddPage();
		
						$r2 = $objOperativo->consultarOperativo();

						$pdf->Cell(-17);
						$pdf->Cell(90,10,'Operativo registrados',0,1,'C');
						
							foreach ($r2 as $valor) {
								if (isset($valor["id_operativo"])) {
									
									$pdf->Cell(185,6,'Operativo',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
									
									$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
									$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
									
									$pdf->Ln(5.9);		
									$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

									$id_operativo = $valor['id_operativo'];
									$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
									
									$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
									foreach ($clasificacionDelOperativo as $clas) {
									$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
									}
									
									$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
									$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
								
									foreach ($diversidadesRegistradas as $valor2) {
									$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
									
									}

									$pdf->Ln(4);

								}
							}
					$pdf->AddPage();

					$r3 = $objOperativo->operativo_entregado_individual($dependencia, $operador);
					
					$pdf->Cell(-17);
					$pdf->Cell(90,10,'Operativos entregados',0,1,'C');
					
					foreach ($r3 as $valor) {
						if (isset($valor["id_operativo_usuario"])) {
							//DATOS DEL OPERATIVO PAGADO
							$pdf->Cell(30,6,'Operativo',1,0,'C',1);
							$pdf->Cell(35,6,'Precio',1,0,'C',1);
							$pdf->Cell(70,6,'Referencia',1,0,'C',1);
							$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
							$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
							$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
							$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
							$pdf->Cell(185,6,'Banco',1,0,'C',1);
							$pdf->Ln(6);
							$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
							//DATOS USUARIO
							$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,'Cedula',1,0,'C',1);
							$pdf->Cell(30,6,'Nombre',1,0,'C',1);
							$pdf->Cell(30,6,'Apellido',1,0,'C',1);
							$pdf->Cell(30,6,'Celular',1,0,'C',1);
							$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
							$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
							$pdf->Ln(6);
						}
					}

					$pdf->AddPage();
		
					$r4 = $objOperativo->operativo_no_entregado_individual($dependencia, $operador);

					$pdf->Cell(-17);
					$pdf->Cell(90,10,'Operativos no entregados',0,1,'C');
						
						foreach ($r4 as $valor) {
							if (isset($valor["id_operativo_usuario"])) {
								//DATOS DEL OPERATIVO PAGADO
								$pdf->Cell(30,6,'Operativo',1,0,'C',1);
								$pdf->Cell(35,6,'Precio',1,0,'C',1);
								$pdf->Cell(70,6,'Referencia',1,0,'C',1);
								$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
								$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
								$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
								$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
								$pdf->Cell(185,6,'Banco',1,0,'C',1);
								$pdf->Ln(6);
								$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
								//DATOS USUARIO
								$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,'Cedula',1,0,'C',1);
								$pdf->Cell(30,6,'Nombre',1,0,'C',1);
								$pdf->Cell(30,6,'Apellido',1,0,'C',1);
								$pdf->Cell(30,6,'Celular',1,0,'C',1);
								$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
								$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
								$pdf->Ln(6);
								
							}
						}

						$pdf->AddPage();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];

							$r5 = $objOperativo->consultarMoroso_individual($id, $operador, $dependencia);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}
				
			}

			#<!-- ============================================================== -->
  			#<!--                  REPORTE PARA LOS OBREROS                      -->
  			#<!-- ============================================================== -->
			if ($identificacionOperador == 'Obrero') {

				$dependencia = $_SESSION['dependencia'];
				$operador = $identificacionOperador;
				
				if ($opcion =='7') {

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de personal obrero';

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
							
							$rol = 'Obrero';
							$r1 = $objOperativo->personal_individual($dependencia, $operador);
							
								$mensaje = '';
								require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(65,10,'Personal Obrero',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
							
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }

								$pdf->Output();

						}

				//Operativos registrados
				if ($opcion =='10') {

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;
												
										date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte operativos registrados';

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
		
						$r1 = $objOperativo->consultarOperativo();
						
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(65);
							    // Título
							    $this->Cell(65,10,'Operativos Registrados',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina											
								
							foreach ($r1 as $valor) {
								if (isset($valor["id_operativo"])) {
									
									$pdf->Cell(185,6,'Operativo',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
									
									$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
									$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
									
									$pdf->Ln(5.9);		
									$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

									$id_operativo = $valor['id_operativo'];
									$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
									
									$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
									foreach ($clasificacionDelOperativo as $clas) {
									$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
									}
									
									$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
									$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
								
									foreach ($diversidadesRegistradas as $valor2) {
									$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
									
									}

									$pdf->Ln(4);

								}
							}

							$pdf->Output();

					}

				//Obreros con operativos entregados
				if($opcion =='11'){

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de operativos entregados';

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

					$r1 = $objOperativo->operativo_entregado_individual($dependencia, $operador);

					$mensaje = '';
					require_once 'vista/config/libreria/fpdf.php';
					
					class PDF extends FPDF
					{
					// Cabecera de página
					function Header()
					{
					    // Logo
					    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
					    // Arial bold 15
					    $this->SetFont('Arial','B',15);
					    // Salto de línea
					    $this->Ln(8);
					    // Movernos a la derecha
					    $this->Cell(65);
					    // Título
					    $this->Cell(65,10,'Operativos Entregados',1,0,'C');
					    // Salto de línea
					    $this->Ln(20);
					}

					// Pie de página
					function Footer()
					{
					    // Posición: a 1,5 cm del final
					    $this->SetY(-15);
					    // Arial italic 8
					    $this->SetFont('Arial','I',8);
					    // Número de página
					    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
					}
					}

					// Creación del objeto de la clase heredada
					$pdf = new PDF();
					$pdf->AliasNbPages();
					$pdf->AddPage();
					$pdf->SetFont('Times','',12);
					
					$pdf->Ln(6);
					//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
					$pdf->SetFillColor(232,232,232);

					$pdf->SetFont('Arial','B',10);
					//185 total para que entre en la pagina
					
					foreach ($r1 as $valor) {
						if (isset($valor["id_operativo_usuario"])) {
							//DATOS DEL OPERATIVO PAGADO
							$pdf->Cell(30,6,'Operativo',1,0,'C',1);
							$pdf->Cell(35,6,'Precio',1,0,'C',1);
							$pdf->Cell(70,6,'Referencia',1,0,'C',1);
							$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
							$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
							$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
							$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
							$pdf->Cell(185,6,'Banco',1,0,'C',1);
							$pdf->Ln(6);
							$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
							//DATOS USUARIO
							$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,'Cedula',1,0,'C',1);
							$pdf->Cell(30,6,'Nombre',1,0,'C',1);
							$pdf->Cell(30,6,'Apellido',1,0,'C',1);
							$pdf->Cell(30,6,'Celular',1,0,'C',1);
							$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
							$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
							$pdf->Ln(6);
						}
					}

					$pdf->Output();
			}

			//Beneficiario por entregar operativo 
			if ($opcion =='12') {

				require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de obreros con operativos por entregar';

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
		
					$r1 = $objOperativo->operativo_no_entregado_individual($dependencia, $operador);

						$mensaje = '';
						require_once 'vista/config/libreria/fpdf.php';
						
						class PDF extends FPDF
						{
						// Cabecera de página
						function Header()
						{
						    // Logo
						    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
						    // Arial bold 15
						    $this->SetFont('Arial','B',15);
						    // Salto de línea
						    $this->Ln(8);
						    // Movernos a la derecha
						    $this->Cell(65);
						    // Título
						    $this->Cell(65,10,'Operativos por Entregar',1,0,'C');
						    // Salto de línea
						    $this->Ln(20);
						}

						// Pie de página
						function Footer()
						{
						    // Posición: a 1,5 cm del final
						    $this->SetY(-15);
						    // Arial italic 8
						    $this->SetFont('Arial','I',8);
						    // Número de página
						    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
						}
						}

						// Creación del objeto de la clase heredada
						$pdf = new PDF();
						$pdf->AliasNbPages();
						$pdf->AddPage();
						$pdf->SetFont('Times','',12);
						
						$pdf->Ln(6);
						//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
						$pdf->SetFillColor(232,232,232);

						$pdf->SetFont('Arial','B',10);
						//185 total para que entre en la pagina
						
						foreach ($r1 as $valor) {
							if (isset($valor["id_operativo_usuario"])) {
								//DATOS DEL OPERATIVO PAGADO
								$pdf->Cell(30,6,'Operativo',1,0,'C',1);
								$pdf->Cell(35,6,'Precio',1,0,'C',1);
								$pdf->Cell(70,6,'Referencia',1,0,'C',1);
								$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
								$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
								$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
								$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
								$pdf->Cell(185,6,'Banco',1,0,'C',1);
								$pdf->Ln(6);
								$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
								//DATOS USUARIO
								$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,'Cedula',1,0,'C',1);
								$pdf->Cell(30,6,'Nombre',1,0,'C',1);
								$pdf->Cell(30,6,'Apellido',1,0,'C',1);
								$pdf->Cell(30,6,'Celular',1,0,'C',1);
								$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
								$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
								$pdf->Ln(6);
								
							}
						}
						$pdf->Output();
				}

				//Obreros por Pagar
				if ($opcion=='13') {		

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										$id_usuario = $_SESSION['id_ussuario'];
								   		$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de obreros con operativos por pagar';

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
		
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Operativos por pagar',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];

							$r5 = $objOperativo->consultarMoroso_individual($id, $operador, $dependencia);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}
				
			//Reporte del todo el sistema
			if ($opcion =='14') {

				require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

											$id_usuario = $_SESSION['id_ussuario'];
								  		 	$fecha = $date;
												
												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte global obrero';

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
							
							$rol = 'Obrero';
							$r1 = $objOperativo->personal_individual($dependencia, $operador);
												
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(65,10,'Personal Obrero',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
						
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina	
								$pdf->Cell(-10);
								$pdf->Cell(90,10,'Beneficiarios registrados en su area',0,1,'C');
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }
						
						$pdf->AddPage();
		
						$r2 = $objOperativo->consultarOperativo();

						$pdf->Cell(-17);
						$pdf->Cell(90,10,'Operativo registrados',0,1,'C');
						
							foreach ($r2 as $valor) {
								if (isset($valor["id_operativo"])) {
									
									$pdf->Cell(185,6,'Operativo',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
									
									$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
									$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
									
									$pdf->Ln(5.9);		
									$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

									$id_operativo = $valor['id_operativo'];
									$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
									
									$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
									foreach ($clasificacionDelOperativo as $clas) {
									$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
									}
									
									$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
									$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
								
									foreach ($diversidadesRegistradas as $valor2) {
									$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
									
									}

									$pdf->Ln(4);

								}
							}
					$pdf->AddPage();

					$r3 = $objOperativo->operativo_entregado_individual($dependencia, $operador);
					
					$pdf->Cell(-17);
					$pdf->Cell(90,10,'Operativos entregados',0,1,'C');
					
					foreach ($r3 as $valor) {
						if (isset($valor["id_operativo_usuario"])) {
							//DATOS DEL OPERATIVO PAGADO
							$pdf->Cell(30,6,'Operativo',1,0,'C',1);
							$pdf->Cell(35,6,'Precio',1,0,'C',1);
							$pdf->Cell(70,6,'Referencia',1,0,'C',1);
							$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
							$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
							$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
							$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
							$pdf->Cell(185,6,'Banco',1,0,'C',1);
							$pdf->Ln(6);
							$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
							//DATOS USUARIO
							$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,'Cedula',1,0,'C',1);
							$pdf->Cell(30,6,'Nombre',1,0,'C',1);
							$pdf->Cell(30,6,'Apellido',1,0,'C',1);
							$pdf->Cell(30,6,'Celular',1,0,'C',1);
							$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
							$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
							$pdf->Ln(6);
						}
					}

					$pdf->AddPage();
		
					$r4 = $objOperativo->operativo_no_entregado_individual($dependencia, $operador);

					$pdf->Cell(-17);
					$pdf->Cell(90,10,'Operativos no entregados',0,1,'C');
						
						foreach ($r4 as $valor) {
							if (isset($valor["id_operativo_usuario"])) {
								//DATOS DEL OPERATIVO PAGADO
								$pdf->Cell(30,6,'Operativo',1,0,'C',1);
								$pdf->Cell(35,6,'Precio',1,0,'C',1);
								$pdf->Cell(70,6,'Referencia',1,0,'C',1);
								$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
								$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
								$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
								$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
								$pdf->Cell(185,6,'Banco',1,0,'C',1);
								$pdf->Ln(6);
								$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
								//DATOS USUARIO
								$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,'Cedula',1,0,'C',1);
								$pdf->Cell(30,6,'Nombre',1,0,'C',1);
								$pdf->Cell(30,6,'Apellido',1,0,'C',1);
								$pdf->Cell(30,6,'Celular',1,0,'C',1);
								$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
								$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
								$pdf->Ln(6);
								
							}
						}

						$pdf->AddPage();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];

							$r5 = $objOperativo->consultarMoroso_individual($id, $operador, $dependencia);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}
				
			}

			#<!-- ============================================================== -->
  			#<!--              REPORTE PARA LOS ADMINISTRATIVOS                  -->
  			#<!-- ============================================================== -->
			if ($identificacionOperador == 'Administrativo') {

				$dependencia = $_SESSION['dependencia'];
				$operador = $identificacionOperador;
				
				if ($opcion =='122') {

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										  $id_usuario = $_SESSION['id_ussuario'];
								 		  $fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de personal administrativo';

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
							
							$rol = 'Administrativo';
							$dependencia = $_SESSION['dependencia'];
							$r1 = $objOperativo->personal_individual('Biblioteca', 'Administrativo');
							
								$mensaje = '';
								require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(65,10,'Personal Administrativo',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
								
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina
							
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['nombreRol'], 'UTF-8')),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }

								$pdf->Output();

						}

				//Operativos registrados
				if ($opcion =='10') {

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

										 $id_usuario = $_SESSION['id_ussuario'];
								  		 $fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de operativos registrados';

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
		
						$r1 = $objOperativo->consultarOperativo();
						
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(65);
							    // Título
							    $this->Cell(65,10,'Operativos Registrados',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina											
								
							foreach ($r1 as $valor) {
								if (isset($valor["id_operativo"])) {
									
									$pdf->Cell(185,6,'Operativo',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
									
									$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
									$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
									
									$pdf->Ln(5.9);		
									$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

									$id_operativo = $valor['id_operativo'];
									$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
									
									$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
									foreach ($clasificacionDelOperativo as $clas) {
									$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
									}
									
									$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
									$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
								
									foreach ($diversidadesRegistradas as $valor2) {
									$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
									
									}

									$pdf->Ln(4);

								}
							}

							$pdf->Output();

					}

				//Obreros con operativos entregados
				if($opcion =='11'){

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();
 
									  	   $id_usuario = $_SESSION['id_ussuario'];
										   $fecha = $date;;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de administativos con operativos entregados';

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

					$r1 = $objOperativo->operativo_entregado_individual($dependencia, $operador);

					$mensaje = '';
					require_once 'vista/config/libreria/fpdf.php';
					
					class PDF extends FPDF
					{
					// Cabecera de página
					function Header()
					{
					    // Logo
					    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
					    // Arial bold 15
					    $this->SetFont('Arial','B',15);
					    // Salto de línea
					    $this->Ln(8);
					    // Movernos a la derecha
					    $this->Cell(65);
					    // Título
					    $this->Cell(65,10,'Operativos Entregados',1,0,'C');
					    // Salto de línea
					    $this->Ln(20);
					}

					// Pie de página
					function Footer()
					{
					    // Posición: a 1,5 cm del final
					    $this->SetY(-15);
					    // Arial italic 8
					    $this->SetFont('Arial','I',8);
					    // Número de página
					    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
					}
					}

					// Creación del objeto de la clase heredada
					$pdf = new PDF();
					$pdf->AliasNbPages();
					$pdf->AddPage();
					$pdf->SetFont('Times','',12);
					
					$pdf->Ln(6);
					//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
					$pdf->SetFillColor(232,232,232);

					$pdf->SetFont('Arial','B',10);
					//185 total para que entre en la pagina
					
					foreach ($r1 as $valor) {
						if (isset($valor["id_operativo_usuario"])) {
							//DATOS DEL OPERATIVO PAGADO
							$pdf->Cell(30,6,'Operativo',1,0,'C',1);
							$pdf->Cell(35,6,'Precio',1,0,'C',1);
							$pdf->Cell(70,6,'Referencia',1,0,'C',1);
							$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
							$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
							$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
							$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
							$pdf->Cell(185,6,'Banco',1,0,'C',1);
							$pdf->Ln(6);
							$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
							//DATOS USUARIO
							$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,'Cedula',1,0,'C',1);
							$pdf->Cell(30,6,'Nombre',1,0,'C',1);
							$pdf->Cell(30,6,'Apellido',1,0,'C',1);
							$pdf->Cell(30,6,'Celular',1,0,'C',1);
							$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
							$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
							$pdf->Ln(6);
						}
					}

					$pdf->Output();
			}

			//Beneficiario por entregar operativo 
			if ($opcion =='12') {

				require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();
												
												$id_usuario = $_SESSION['id_ussuario'];
								   				$fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de administrativos con operativos por entregar';

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
		
					$r1 = $objOperativo->operativo_no_entregado_individual($dependencia, $operador);

						$mensaje = '';
						require_once 'vista/config/libreria/fpdf.php';
						
						class PDF extends FPDF
						{
						// Cabecera de página
						function Header()
						{
						    // Logo
						    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
						    // Arial bold 15
						    $this->SetFont('Arial','B',15);
						    // Salto de línea
						    $this->Ln(8);
						    // Movernos a la derecha
						    $this->Cell(65);
						    // Título
						    $this->Cell(65,10,'Operativos por Entregar',1,0,'C');
						    // Salto de línea
						    $this->Ln(20);
						}

						// Pie de página
						function Footer()
						{
						    // Posición: a 1,5 cm del final
						    $this->SetY(-15);
						    // Arial italic 8
						    $this->SetFont('Arial','I',8);
						    // Número de página
						    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
						}
						}

						// Creación del objeto de la clase heredada
						$pdf = new PDF();
						$pdf->AliasNbPages();
						$pdf->AddPage();
						$pdf->SetFont('Times','',12);
						
						$pdf->Ln(6);
						//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
						$pdf->SetFillColor(232,232,232);

						$pdf->SetFont('Arial','B',10);
						//185 total para que entre en la pagina
						
						foreach ($r1 as $valor) {
							if (isset($valor["id_operativo_usuario"])) {
								//DATOS DEL OPERATIVO PAGADO
								$pdf->Cell(30,6,'Operativo',1,0,'C',1);
								$pdf->Cell(35,6,'Precio',1,0,'C',1);
								$pdf->Cell(70,6,'Referencia',1,0,'C',1);
								$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
								$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
								$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
								$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
								$pdf->Cell(185,6,'Banco',1,0,'C',1);
								$pdf->Ln(6);
								$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
								//DATOS USUARIO
								$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,'Cedula',1,0,'C',1);
								$pdf->Cell(30,6,'Nombre',1,0,'C',1);
								$pdf->Cell(30,6,'Apellido',1,0,'C',1);
								$pdf->Cell(30,6,'Celular',1,0,'C',1);
								$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
								$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
								$pdf->Ln(6);
								
							}
						}
						$pdf->Output();
				}

				//Obreros por Pagar
				if ($opcion=='13') {		

					require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();

												$id_usuario = $_SESSION['id_ussuario'];
								 		  	    $fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte de administrativos con operativos por pagar';

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
		
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Operativos por pagar',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];

							$r5 = $objOperativo->consultarMoroso_individual($id, $operador, $dependencia);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}
				
			//Reporte del todo el sistema
			if ($opcion =='14') {

				require_once 'modelo/bitacora.php';

										$bitacora = new Bitacora();
		
												$id_usuario = $_SESSION['id_ussuario'];
											    $fecha = $date;

												date_default_timezone_set('America/Caracas');
												
												$hora = date("H:i:s");
												$accion = 'Generó reporte global administrativo';

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
							
							$rol = 'Administrativo';
							$r1 = $objOperativo->personal_individual($dependencia, $operador);
												
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
								
								class PDF extends FPDF
								{
								// Cabecera de página
								function Header()
								{
								    // Logo
								    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
								    // Arial bold 15
								    $this->SetFont('Arial','B',15);
								    // Salto de línea
								    $this->Ln(8);
								    // Movernos a la derecha
								    $this->Cell(65);
								    // Título
								    $this->Cell(65,10,'Personal Administrativo',1,0,'C');
								    // Salto de línea
								    $this->Ln(20);
								}

								// Pie de página
								function Footer()
								{
								    // Posición: a 1,5 cm del final
								    $this->SetY(-15);
								    // Arial italic 8
								    $this->SetFont('Arial','I',8);
								    // Número de página
								    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
								}
								}

								// Creación del objeto de la clase heredada
								$pdf = new PDF();
								$pdf->AliasNbPages();
								$pdf->AddPage();
								$pdf->SetFont('Times','',12);
						
								$pdf->Ln(6);
								//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
								$pdf->SetFillColor(232,232,232);

								$pdf->SetFont('Arial','B',10);
								//185 total para que entre en la pagina	
								$pdf->Cell(-10);
								$pdf->Cell(90,10,'Beneficiarios registrados en su area',0,1,'C');
								
								foreach ($r1 as $valor) {
									if (isset($valor["id_usuario"])) {
										
										$pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
										$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
										$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
										$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
										$pdf->Ln(5.9);
										$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
										$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
										$pdf->Cell(67,6,'Email',1,0,'C',1);
										$pdf->Cell(51,6,'Celular',1,0,'C',1);
										$pdf->Cell(67,6,'Rol',1,1,'C',1);
										$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
										$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
										$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
										
										$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
										
										$pdf->Cell(185,6,'Direccion',1,1,'C',1);
										$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
										$pdf->Ln(6);			
									 }
								 }
						
						$pdf->AddPage();
		
						$r2 = $objOperativo->consultarOperativo();

						$pdf->Cell(-17);
						$pdf->Cell(90,10,'Operativo registrados',0,1,'C');
						
							foreach ($r2 as $valor) {
								if (isset($valor["id_operativo"])) {
									
									$pdf->Cell(185,6,'Operativo',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['nombre_operativo']),1,1,'C');
									
									$pdf->Cell(46.25,6,'Precio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Inicio',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha Final',1,0,'C',1);
									$pdf->Cell(46.25,6,'Descripcion',1,0,'C',1);
									
									$pdf->Ln(5.9);		
									$pdf->Cell(46.25,6,utf8_decode($valor['precio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_inicio_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_final_operativo']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['descripcion']),1,1,'C');

									$id_operativo = $valor['id_operativo'];
									$clasificacionDelOperativo = $objOperativo->clasificacionDelOperativo($id_operativo);
									
									$pdf->Cell(185,6,utf8_decode('Clasificación'),1,1,'C',1);
									foreach ($clasificacionDelOperativo as $clas) {
									$pdf->Cell(185,6,utf8_decode($clas['nombre_clasificacion']),1,1,'C');
									}
									
									$diversidadesRegistradas=$objOperativo->buscarDiversidades_operativo($id_operativo);
									$pdf->Cell(46.25,6,utf8_decode('Producto'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Marca'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Contenido'),1,0,'C',1);
									$pdf->Cell(46.25,6,utf8_decode('Descripción'),1,1,'C',1);
								
									foreach ($diversidadesRegistradas as $valor2) {
									$pdf->Cell(46.25,6,utf8_decode($valor2['nombre_diversidad']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['marca']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['contenido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor2['descripcion']),1,1,'C');
									
									}

									$pdf->Ln(4);

								}
							}
					$pdf->AddPage();

					$r3 = $objOperativo->operativo_entregado_individual($dependencia, $operador);
					
					$pdf->Cell(-17);
					$pdf->Cell(90,10,'Operativos entregados',0,1,'C');
					
					foreach ($r3 as $valor) {
						if (isset($valor["id_operativo_usuario"])) {
							//DATOS DEL OPERATIVO PAGADO
							$pdf->Cell(30,6,'Operativo',1,0,'C',1);
							$pdf->Cell(35,6,'Precio',1,0,'C',1);
							$pdf->Cell(70,6,'Referencia',1,0,'C',1);
							$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
							$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
							$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
							$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
							$pdf->Cell(185,6,'Banco',1,0,'C',1);
							$pdf->Ln(6);
							$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
							//DATOS USUARIO
							$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,'Cedula',1,0,'C',1);
							$pdf->Cell(30,6,'Nombre',1,0,'C',1);
							$pdf->Cell(30,6,'Apellido',1,0,'C',1);
							$pdf->Cell(30,6,'Celular',1,0,'C',1);
							$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
							$pdf->Ln(5.9);
							$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
							$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
							$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
							$pdf->Ln(6);
						}
					}

					$pdf->AddPage();
		
					$r4 = $objOperativo->operativo_no_entregado_individual($dependencia, $operador);

					$pdf->Cell(-17);
					$pdf->Cell(90,10,'Operativos no entregados',0,1,'C');
						
						foreach ($r4 as $valor) {
							if (isset($valor["id_operativo_usuario"])) {
								//DATOS DEL OPERATIVO PAGADO
								$pdf->Cell(30,6,'Operativo',1,0,'C',1);
								$pdf->Cell(35,6,'Precio',1,0,'C',1);
								$pdf->Cell(70,6,'Referencia',1,0,'C',1);
								$pdf->Cell(50,6,'Fecha Pago',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['nombre_operativo']),1,0,'C');
								$pdf->Cell(35,6,utf8_decode($valor['precio_operativo']),1,0,'C');
								$pdf->Cell(70,6,utf8_decode($valor['referencia']),1,0,'C');
								$pdf->Cell(50,6,utf8_decode($valor['fecha_pago']),1,1,'C');
								$pdf->Cell(185,6,'Banco',1,0,'C',1);
								$pdf->Ln(6);
								$pdf->Cell(185,6,utf8_decode($valor['banco']),1,1,'C');
								//DATOS USUARIO
								$pdf->Cell(185,6,'Beneficiario',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,'Cedula',1,0,'C',1);
								$pdf->Cell(30,6,'Nombre',1,0,'C',1);
								$pdf->Cell(30,6,'Apellido',1,0,'C',1);
								$pdf->Cell(30,6,'Celular',1,0,'C',1);
								$pdf->Cell(65,6,'Dependencia',1,0,'C',1);
								$pdf->Ln(5.9);
								$pdf->Cell(30,6,utf8_decode($valor['tcedula']."-".$valor['cedula']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['nombre']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['apellido']),1,0,'C');
								$pdf->Cell(30,6,utf8_decode($valor['tcelular']."-".$valor['celular']),1,0,'C');
								$pdf->Cell(65,6,utf8_decode($valor['dependencia']),1,1,'C');
								$pdf->Ln(6);
								
							}
						}

						$pdf->AddPage();
							
							$datos=$objOperativo->consultarOperativo();

							foreach ($datos as $key) {

							$id = $key['id_operativo'];
							$nom = $key['nombre_operativo'];

							$r5 = $objOperativo->consultarMoroso_individual($id, $operador, $dependencia);

							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(90,10,'Beneficiados por pagar Operativo',0,1,'C');

							foreach ($r5 as $valor):

								if (isset($valor["id_usuario"])) {
									$pdf->Cell(185.25,6,utf8_decode('Operativo "'.$nom.'"'),1,1,'C');
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha de Nacimiento',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha_n']),1,1,'C');
									$pdf->Cell(67,6,'Email',1,0,'C',1);
									$pdf->Cell(51,6,'Celular',1,0,'C',1);
									$pdf->Cell(67,6,'Rol',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['email'].$valor['temail']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['tcelular'].'-'.$valor['celular']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode(mb_strtoupper($valor['rol'], 'UTF-8')),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,'Direccion',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['direccion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;

						}
							$pdf->Output();
					}
				
			}

			break;

			case 'generar_bitacoras':
			
				require_once 'modelo/bitacora.php';

				$bitacora = new Bitacora();

						if (isset($_POST['id_delete'])) {

							$id_registro = $_POST['id_delete'];
						}
		
						if (isset($id_registro)) {
							
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Registro de acciones',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							
							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(50,10,'Bitacoras',0,1,'C');

							foreach ($id_registro as $registros) {

								
							$datos = $bitacora->consultarBitacoraIndividual($registros);

							foreach ($datos as $valor):

								if (isset($valor["id_bitacora"])) {
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha']),1,1,'C');
									$pdf->Cell(67,6,'Hora',1,0,'C',1);
									$pdf->Cell(51,6,'Rol',1,0,'C',1);
									$pdf->Cell(67,6,'IP Address',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['hora']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['nombreRol']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode($valor['ip_address']),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,utf8_decode('Acción'),1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['accion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;	
							
								}	
								$pdf->Output();

							} else {
							
							$mensaje = '';
							require_once 'vista/config/libreria/fpdf.php';
							
							class PDF extends FPDF
							{
							// Cabecera de página
							function Header()
							{
							    // Logo
							    $this->Image('vista/config/img/uptaeb.jpg',10,8,33);
							    // Arial bold 15
							    $this->SetFont('Arial','B',15);
							    // Salto de línea
							    $this->Ln(8);
							    // Movernos a la derecha
							    $this->Cell(55);
							    // Título
							    $this->Cell(90,10,'Registro de acciones',1,0,'C');
							    // Salto de línea
							    $this->Ln(20);
							}

							// Pie de página
							function Footer()
							{
							    // Posición: a 1,5 cm del final
							    $this->SetY(-15);
							    // Arial italic 8
							    $this->SetFont('Arial','I',8);
							    // Número de página
							    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
							}
							}

							// Creación del objeto de la clase heredada
							$pdf = new PDF();
							$pdf->AliasNbPages();
							
							$pdf->AddPage();
							$pdf->SetFont('Times','',12);
							
							$pdf->Ln(6);
							//Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
							$pdf->SetFillColor(232,232,232);

							$pdf->SetFont('Arial','B',10);
							//185 total para que entre en la pagina
							
							$pdf->Cell(-17);
							$pdf->Cell(50,10,'Bitacoras',0,1,'C');


								
							$datos = $bitacora->consultarBitacora();

							foreach ($datos as $valor):

								if (isset($valor["id_bitacora"])) {
								    $pdf->Cell(46.25,6,'Nombre',1,0,'C',1);
									$pdf->Cell(46.25,6,'Apellido',1,0,'C',1);
									$pdf->Cell(46.25,6,'Cedula',1,0,'C',1);
									$pdf->Cell(46.25,6,'Fecha',1,0,'C',1);
									$pdf->Ln(5.9);
									$pdf->Cell(46.25,6,utf8_decode($valor['nombre']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['apellido']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['tcedula'].'-'.$valor['cedula']),1,0,'C');
									$pdf->Cell(46.25,6,utf8_decode($valor['fecha']),1,1,'C');
									$pdf->Cell(67,6,'Hora',1,0,'C',1);
									$pdf->Cell(51,6,'Rol',1,0,'C',1);
									$pdf->Cell(67,6,'IP Address',1,1,'C',1);
									$pdf->Cell(67,6,utf8_decode($valor['hora']),1,0,'C');
									$pdf->Cell(51,6,utf8_decode($valor['nombreRol']),1,0,'C');
									$pdf->Cell(67,6,utf8_decode($valor['ip_address']),1,1,'C');
									
									$pdf->Cell(185,6,'Dependencia',1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['dependencia']),1,1,'C');
									
									$pdf->Cell(185,6,utf8_decode('Acción'),1,1,'C',1);
									$pdf->Cell(185,6,utf8_decode($valor['accion']),1,1,'C');
									$pdf->Ln(6);
									
								}
							endforeach;	
							
							
								$pdf->Output();
							}

		
							

						
							
					
				break;

				case 'inicioEstadisticas':
					
					require_once 'vista/generar_rep/estadisticas/inicioEstadisticas.php';

				break;

				case 'inicioBeneficio':

					require_once 'vista/generar_rep/estadisticas/inicioBeneficioE.php';


				break;

				case 'inicioOperativos':
					
					require_once 'vista/generar_rep/estadisticas/inicioOperativos.php';

				break;

				case 'inicioDineroI':
					
					require_once 'vista/generar_rep/estadisticas/inicioDineroI.php';

				break;

				case 'inicioBeneficioLo':
						
					require_once 'vista/generar_rep/estadisticas/inicioBeneficioLo.php';

				break;


	}

?>