<?php

ob_start();
require('../../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Image('../../assets/pdf/logo.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'LAPORAN DATA ATURAN (RULE) FUZZY MAMDANI',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 08xxxxxxxx',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Indonesia',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'source code by : aaaaaaaaa',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'Laporan Aturan (Rule)',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Cell(1.5, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Jenis Kulit', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Warna Kulit', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Jenis Tinta', 1, 0, 'C');
$pdf->ln();

$no=1;
include 'koneksi.php';

$query=mysqli_query($koneksi, "SELECT * FROM data_aturan");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1.5, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(8, 0.8, $lihat['jenis_kulit'],1, 0, 'C');
	$pdf->Cell(8, 0.8, $lihat['warna_kulit'], 1, 0,'C');
	$pdf->Cell(8, 0.8, $lihat['tinta_tato'], 1, 0,'C');		
	$pdf->ln();
	$no++;
}
$pdf->Output("laporan_aturan.pdf","I");

?>

