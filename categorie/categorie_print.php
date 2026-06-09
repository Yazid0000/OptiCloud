<?php
require("../fpdf/fpdf.php");
require("../connexion.php");

$res    = mysqli_query($con, "SELECT * FROM categorie ORDER BY idcategorie");
$nombre = mysqli_num_rows($res);

class PDF_Categorie extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(52,152,219);
        $this->SetTextColor(255,255,255);
        $this->Cell(0,10,utf8_decode('OPTI CLOUD - Liste des categories'),0,1,'C',true);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','',9);
        $this->Cell(0,6,'Date : '.date("d/m/Y"),0,1,'R');
        $this->Ln(2);
    }
    function Footer() {
        $this->SetY(-12);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,8,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF_Categorie('P','mm','A4');
$pdf->AliasNbPages();
$pdf->SetMargins(10,20,10);
$pdf->SetAutoPageBreak(true,12);
$pdf->AddPage();

// Portrait : ID=50 | Nom=140 = 190mm
$pdf->SetFont('Arial','B',11);
$pdf->SetFillColor(52,152,219);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(50,9,'ID',1,0,'C',true);
$pdf->Cell(140,9,utf8_decode('Nom Categorie'),1,1,'C',true);

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($d = mysqli_fetch_assoc($res)) {
    $pdf->SetFillColor(235,245,255);
    $pdf->Cell(50,8,utf8_decode($d['idcategorie']),1,0,'C',$fill);
    $pdf->Cell(140,8,utf8_decode($d['nomcategorie']),1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,utf8_decode('Nombre total de categories : ').$nombre,0,1,'L');

mysqli_close($con);
$pdf->Output('I','liste_categories.pdf');
exit;
