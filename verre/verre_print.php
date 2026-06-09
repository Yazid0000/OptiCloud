<?php
require("../fpdf/fpdf.php");
require("../connexion.php");

$res = mysqli_query($con,
    "SELECT v.*, m.nom AS nommarque FROM verre v LEFT JOIN marque m ON v.idmarque=m.idmarque ORDER BY v.idverre");
$nombre = mysqli_num_rows($res);

class PDF_Verre extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',13);
        $this->SetFillColor(23,162,184);
        $this->SetTextColor(255,255,255);
        $this->Cell(0,10,utf8_decode('OPTI CLOUD - Liste des verres optiques'),0,1,'C',true);
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

$pdf = new PDF_Verre('L','mm','A4');
$pdf->AliasNbPages();
// Marges 5mm => 287mm disponibles
$pdf->SetMargins(5,15,5);
$pdf->SetAutoPageBreak(true,12);
$pdf->AddPage();

// Colonnes ajustées : ID=16 | Nom=58 | Type=28 | Indice=16 | Traitement=38 | Prix=24 | Marque=42 | Description=65 = 287
$cols = array('ID'=>16,'Nom'=>58,'Type'=>28,'Indice'=>16,'Traitement'=>38,'Prix MAD'=>24,'Marque'=>42,'Description'=>65);
$total = array_sum(array_values($cols)); // = 287

// En-têtes
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(23,162,184);
$pdf->SetTextColor(255,255,255);
foreach($cols as $label=>$w)
    $pdf->Cell($w,9,utf8_decode($label),1,0,'C',true);
$pdf->Ln();

// Données
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($d = mysqli_fetch_assoc($res)) {
    $nommarque = isset($d['nommarque']) ? $d['nommarque'] : $d['idmarque'];
    $pdf->SetFillColor(235,248,251);
    $pdf->Cell(16,7,$d['idverre'],1,0,'C',$fill);
    $pdf->Cell(58,7,utf8_decode($d['nom']),1,0,'L',$fill);
    $pdf->Cell(28,7,utf8_decode($d['type']),1,0,'C',$fill);
    $pdf->Cell(16,7,$d['indice'],1,0,'C',$fill);
    $pdf->Cell(38,7,utf8_decode($d['traitement']),1,0,'L',$fill);
    $pdf->Cell(24,7,number_format($d['prix'],2,',',' '),1,0,'R',$fill);
    $pdf->Cell(42,7,utf8_decode($nommarque),1,0,'L',$fill);
    $pdf->Cell(65,7,utf8_decode($d['description']),1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,utf8_decode('Nombre total de verres : ').$nombre,0,1,'L');

mysqli_close($con);
$pdf->Output('I','liste_verres.pdf');
exit;
