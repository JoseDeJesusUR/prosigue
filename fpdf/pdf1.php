<?php 
 session_start();
 $id_usu=$_SESSION["ses_id"];
	include 'plantilla_pdf.php';
	require 'conexion2.php';

    //$idx = $_GET["idx"];
	//$query="SELECT * FROM alumnos_identificados WHERE alumnos_identificados.id='$idx'";
	//$resultado = $mysqli->query($query);

	$pdf = new PDF('P','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
/////////////////////////////////////////////
$idx = $_GET["idx"];
$query="SELECT * FROM alumnos_identificados WHERE alumnos_identificados.id='$idx'";
//$query="SELECT * FROM alumnos_identificados INNER JOIN usuario ON alumnos_identificados.id = usuario.id  WHERE alumnos_identificados.id='$idx'";
$resultado = $mysqli->query($query);
$pdf->SetFont ('Arial', '', 10);
$row = $resultado->fetch_assoc();
$pdf->Cell(179, 4.5, utf8_decode("Autoridad Educativa Federal en la Ciudad de México"), 0, 1, 'R', 0);
$pdf->Cell(185, 4.5, utf8_decode("Dirección General de Operación de Servicios Educativos"), 0, 1, 'R', 0);
$pdf->Cell(173, 4.5, utf8_decode("Coordinación Sectorial de Educación Secundaria"), 0, 1, 'R', 0);
$pdf->Cell(163, 4.5, utf8_decode("Inspeccíon de Zona Secundaria General " . $row["zona"]), 0, 1, 'R', 0);
/////////////////////////////////////////////
		$pdf->SetFont ('Arial', 'B', 12);
		$pdf->Cell(200, 12, 'REPORTE DEL ESTUDIANTE', 0, 1, 'C');
/////////////////////////////////////////////
$idx = $_GET["idx"];
$query="SELECT * FROM alumnos_identificados WHERE alumnos_identificados.id='$idx'";
$resultado = $mysqli->query($query);
	$pdf->SetFillColor(232, 232, 232);

		$pdf->SetFont ('Arial', 'B', 12);
		$pdf->Cell(1);
		$pdf->Cell(50, 12, 'DATOS GENERALES DEL ESTUDIANTE', 0, 1, 'L');
		$pdf->SetFont ('Arial', '', 11); 
		//echo  $idx; 
	$row = $resultado->fetch_assoc();
	$pdf->Cell (37, 6, 'Apellido Paterno:'.'       '. utf8_decode($row['apellidoP']), 0, 1, 'L', 1);				
	$pdf->Cell (37, 6, 'Apellido Materno:'.'      '. utf8_decode($row['apellidoM']), 0, 1, 'L', 1); 
	$pdf->Cell (37, 6, 'Nombre:'.'                    '. utf8_decode($row['nombre']), 0, 1, 'L', 1);
	$pdf->Cell (37, 6, 'CURP:'.'                       '. utf8_decode($row['curp']), 0, 1, 'L', 1);
	$pdf->Cell (37, 6, 'CCT de la Escuela:'.'   '. utf8_decode($row['cctEsc']), 0, 1, 'L', 1);
	$pdf->Cell (37, 6, 'Fecha de  Registro:'.'   '. utf8_decode($row['fechaReg']), 0, 1, 'L', 1);
	$pdf->Cell (37, 6, 'Grado:'.'                       '. utf8_decode($row['GradoReg']), 0, 1, 'L', 1);
/////////////////////////////////////////////
		$pdf->SetFont ('Arial', 'B', 12);
		$pdf->Cell(1);
		$pdf->Cell(65, 15, 'SITUACION INICIAL DEL ESTUDIANTE', 0, 1, 'L');
	$pdf->SetFont ('Arial', '', 11);
	$pdf->MultiCell(185, 5,''. utf8_decode($row['sit_del_est']), 0, 'L', 1);				
/////////////////////////////////////////////
		$pdf->SetFont ('Arial', 'B', 12);
		$pdf->Cell(1);
		$pdf->Cell(65, 15, 'CONDICION ACTUAL DEL ESTUDIANTE', 0, 1, 'L');
	$pdf->SetFont ('Arial', '', 11);
	$pdf->MultiCell(185, 5,''. utf8_decode($row['observaciones']), 0, 'L', 1);		
/////////////////////////////////////////////------------------------------------------
		$pdf->SetFont ('Arial', 'B', 12);
		$pdf->Cell(1);
		$pdf->Cell(65, 15, 'REGISTRO DEL SEGUIMIENTO', 0, 1, 'L');	//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		
		//$pdf->Cell (7, 6, 'No.', 1, 0, 'C', 1);
		$pdf->Cell (38, 6, 'Fecha de registro', 1, 0, 'C', 1);
		$pdf->Cell (45, 6, 'Estado de la Accion', 1, 0, 'C', 1); 
		$pdf->Cell (102, 6, 'Figuras Involucradas', 1, 1, 'C', 1);
/////////////////////////////////////////////---------------------------------------------------
$idx = $_GET["idx"];
$query="SELECT * FROM alumnos_identificados INNER JOIN registro_alumno ON alumnos_identificados.id = registro_alumno.id  WHERE alumnos_identificados.id='$idx'";
$resultado = $mysqli->query($query);
/////////////////////////////////////////////---------------------------------------------------
		$pdf->SetFont ('Arial', '', 11);
			while($row = $resultado->fetch_assoc()){
				//while ($row < 5) {
					//counter = counter + 1;
			 //for( $row=0; $row=$resultado->fetch_assoc() ; $row++){  
				//$pdf->Cell (7, 6,  utf8_decode($row['row']), 1, 0, 'C', 0);
				$pdf->Cell (38, 6,  utf8_decode($row['fechaAccion']), 1, 0, 'C', 0);
				$pdf->Cell (45, 6,  utf8_decode($row['estado_accion']), 1, 0, 'L', 0);
				$pdf->MultiCell (102, 6,  utf8_decode($row['figurasDocente'] . '  ' .
												$row['figurasDirectivo'] . '  ' .
												$row['figurasTutor'] . '  ' .
												$row['figurasOrientador'] . '  ' .
												$row['figurasTS'] . '  ' .
												$row['figurasPF'] . '  ' .
												$row['figurasUDEI'] . '  ' .
												$row['figurasOtro']), 1, 'L', 0);
			}
/////////////////////////////////////////////-------------------PAGINA 2-----------------------
$idx = $_GET["idx"];
$query="SELECT * FROM alumnos_identificados INNER JOIN registro_alumno ON alumnos_identificados.id = registro_alumno.id  WHERE alumnos_identificados.id='$idx'";
$resultado = $mysqli->query($query);
/////////////////////////////////////////////---------------------------------------------------
$pdf->AddPage ('P','A4','0');
		$pdf->SetFont ('Arial', 'B', 10);
		$pdf->Cell(1);
		//$pdf->Cell(65, 15, 'REGISTRO DEL SEGUIMIENTO', 0, 1, 'L');

	$pdf->Cell (183, 7, utf8_decode('Acciones de acompañamiento realizadas al cierre del ciclo escolar'), 1, 1, 'C', 1);
		while($row = $resultado->fetch_assoc()){	
			$pdf->MultiCell(183, 7, utf8_decode($row['accion']), 1, 'L', 0);
		}

	$pdf->Ln(10);
/////////////////////////////////////////////---------------------------------------------------
$idx = $_GET["idx"];
$query="SELECT * FROM alumnos_identificados INNER JOIN registro_alumno ON alumnos_identificados.id = registro_alumno.id  WHERE alumnos_identificados.id='$idx'";
$resultado = $mysqli->query($query);
/////////////////////////////////////////////---------------------------------------------------
	$pdf->Cell (183, 7, 'Logro, dificultad o avance presentado con las acciones realizadas', 1, 1, 'C', 1);
		while($row = $resultado->fetch_assoc()){
			$pdf->MultiCell (183, 7,  utf8_decode($row['logro_d_a']), 1, 'L', 0);
		}
/////////////////////////////////////////////
	$pdf->Output();
?>