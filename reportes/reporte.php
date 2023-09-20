<?php
	include 'plantilla.php';
	require '../config/Conexion.php';
	
	$query = "SELECT * FROM categoria where condicion=1";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,'ID',1,0,'C',1);
	$pdf->Cell(20,6,'NOMBRE',1,0,'C',1);
	$pdf->Cell(70,6,'DESCRIPCION',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(70,6,utf8_decode($row['idcategoria']),1,0,'C');
		$pdf->Cell(20,6,$row['categoria'],1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row['descripcion']),1,1,'C');
	}
	$pdf->Output();
?>