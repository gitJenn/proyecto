<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();



//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
$pdf->Image('logo.jpg',6,19,0);
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos e0l tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(232,232,232); 
$pdf->Cell(100,6,'FASHION',1,0,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(27,6,'RTN: 00102004076',1,0,'C',1);
$pdf->Cell(27,6,'2453757',1,0,'C',1);
$pdf->Cell(27,6,'La Ceiba, Atlantida',1,0,'C',1);
$pdf->Image('logo.jpg',6,19,0);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE PRODUCTOS',1,0,'C');
 
$pdf->Ln(10);

 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(27,6,'Codigo',1,0,'C',1);
$pdf->Cell(48,6,'Producto',1,0,'C',1);
$pdf->Cell(20,6,'Costo',1,0,'C',1);
$pdf->Cell(20,6,'Venta',1,0,'C',1);
$pdf->Cell(20,6,'U.',1,0,'C',1);
$pdf->Cell(20,6,'ISV',1,0,'C',1);
$pdf->Cell(27,6,'Total inv.',1,0,'C',1); 
$pdf->Ln(6);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modulo/ejecutarSQL.php";

$categoria=new ejecutarSQL();


if (isset($_GET["id"]))
{
    $idd=$_GET["id"];
    $rspta = $categoria->listar("SELECT * FROM `producto` where idproducto=".$idd." and condicion=1");
}
else
$rspta = $categoria->listar("SELECT * FROM `producto`  where condicion=1");

//Table with 20 rows and 4 columns
//195
// codigo, producto, costo, precioventa, unidades,impuesto, tootalinventario
$pdf->SetWidths(array(27,48,20,20,20,20,27));

$ti=0;
$tit=0;
while($reg= $rspta->fetch_object())
{  
    $nombre = $reg->DESCRIPCIOn;
    $ti=$reg->COSTO*$reg->UNIDADes;
    $tit+=$ti;
 	$pdf->SetFont('Arial','',7); 
    $pdf->Row(array($reg->CODIGO1,utf8_decode($nombre),$reg->COSTO,$reg->PrecioVENTA,$reg->UNIDADes,$reg->IMPUESTO, $ti            ));
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(133,6,'TOTAL GENERAL',1,0,'R',1);
$pdf->Cell(49,6,$tit,1,0,'R',1);
$pdf->Ln(4);

//Mostramos el documento pdf
$pdf->Output();

?>
<?php



ob_end_flush();
?>