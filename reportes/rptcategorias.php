<?php

//Activamos el almacenamiento en el buffer
ob_start();
session_start();

require_once "../modelo/ejecutarSQL.php";
$categoria=new ejecutarSQL();
$sql= "select * from producto where condicion=1";

if (!isset($_SESSION["nousuario"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{

if (1==1)
{

//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',12);
$pdf->SetFont('Arial','B',12);
$pdf->Image('superlogo.png',6,0,37);


$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'SUPER FACIL',1,0,'C');

$pdf->Ln(10);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE PRODUCTOS',1,0,'C');

 
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27,6,'Codigo',1,0,'C',1);
$pdf->Cell(58,6,'Producto',1,0,'C',1);
$pdf->Cell(30,6,'Existencias',1,0,'C',1);
$pdf->Cell(20,6,'ISV',1,0,'C',1);
$pdf->Cell(20,6,'Venta (L)',1,0,'C',1);
$pdf->Cell(27,6,'Total inv. (L)',1,0,'C',1); 
$pdf->Ln(6);

 
$pdf->Ln(5);
//Comenzamos a crear las filas de los registros según la consulta mysql
//require_once "../modelos/Categoria.php";

//$sql="select * from producto";


//Table with 20 rows and 4 columns
$pdf->SetWidths(array(27,58,30,20,20,27));
$resp = $categoria->listar($sql);
while($reg= $resp->fetch_object())
{  
  
 	$pdf->SetFont('Arial','',10); 
  //$pdf->Row( array (( $reg-> codigo,0,0,0,0,0));
 $pdf->Row( array( $reg-> codigo,(utf8_decode($reg->descripcion)),$reg->cantidad, $reg->impuesto_id, $reg->precio, $reg->cantidad*$reg->precio+($reg->impuesto_id/100)*$reg->cantidad*$reg->precio));
}
 
//Mostramos el documento pdf
$pdf->Output();

?>
<?php
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>