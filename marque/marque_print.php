<?php
require("../fpdf/fpdf.php");
require("../connexion.php");

$res    = mysqli_query($con, "SELECT * FROM marque ORDER BY nom");
$nombre = mysqli_num_rows($res);

class PDF_Marque extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(255,193,7);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,10,utf8_decode('OPTI CLOUD - Liste des marques'),0,1,'C',true);
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

$pdf = new PDF_Marque('P','mm','A4');
$pdf->AliasNbPages();
// Portrait : 210mm - 2*10mm marges = 190mm
$pdf->SetMargins(10,20,10);
$pdf->SetAutoPageBreak(true,12);
$pdf->AddPage();

// Colonnes portrait : ID=18 | Nom=52 | Pays=40 | Description=80 = 190
$cols = array('ID'=>18,'Nom'=>52,'Pays'=>40,'Description'=>80);

// En-têtes
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255,193,7);
$pdf->SetTextColor(0,0,0);
foreach($cols as $label=>$w)
    $pdf->Cell($w,9,utf8_decode($label),1,0,'C',true);
$pdf->Ln();

// Données
$pdf->SetFont('Arial','',9);
$fill = false;
while($d = mysqli_fetch_assoc($res)) {
    $pdf->SetFillColor(255,249,219);
    $pdf->Cell(18,7,$d['idmarque'],1,0,'C',$fill);
    $pdf->Cell(52,7,utf8_decode($d['nom']),1,0,'L',$fill);
    $pdf->Cell(40,7,utf8_decode($d['pays']),1,0,'L',$fill);
    $pdf->Cell(80,7,utf8_decode($d['description']),1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,utf8_decode('Nombre total de marques : ').$nombre,0,1,'L');

mysqli_close($con);
$pdf->Output('I','liste_marques.pdf');
exit;
