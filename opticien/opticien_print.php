<?php
require("../fpdf/fpdf.php");
require("../connexion.php");

$res    = mysqli_query($con, "SELECT * FROM opticien ORDER BY idopticien");
$nombre = mysqli_num_rows($res);

class PDF_Opticien extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',13);
        $this->SetFillColor(108,117,125);
        $this->SetTextColor(255,255,255);
        $this->Cell(0,10,utf8_decode('OPTI CLOUD - Liste des opticiens'),0,1,'C',true);
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

$pdf = new PDF_Opticien('L','mm','A4');
$pdf->AliasNbPages();
// Marges 5mm => 287mm disponibles
$pdf->SetMargins(5,18,5);
$pdf->SetAutoPageBreak(true,12);
$pdf->AddPage();

// Colonnes : ID=10 | Magasin=56 | Responsable=44 | Ville=28 | Tel=30 | Email=50 | Licence=32 | Inscr=22 | Statut=15 = 287
$cols = array('ID'=>10,'Magasin'=>56,'Responsable'=>44,'Ville'=>28,'Tel'=>30,'Email'=>50,'Licence'=>32,'Inscription'=>22,'Statut'=>15);
$total = array_sum(array_values($cols)); // = 287

// En-têtes
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(108,117,125);
$pdf->SetTextColor(255,255,255);
foreach($cols as $label=>$w)
    $pdf->Cell($w,9,utf8_decode($label),1,0,'C',true);
$pdf->Ln();

// Données
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($d = mysqli_fetch_assoc($res)) {
    $date_ins = ($d['dateinscription']) ? date('d/m/Y', strtotime($d['dateinscription'])) : '';
    $pdf->SetFillColor(240,240,242);
    $pdf->Cell(10,7,$d['idopticien'],1,0,'C',$fill);
    $pdf->Cell(56,7,utf8_decode($d['nommagasin']),1,0,'L',$fill);
    $pdf->Cell(44,7,utf8_decode($d['responsable']),1,0,'L',$fill);
    $pdf->Cell(28,7,utf8_decode($d['ville']),1,0,'L',$fill);
    $pdf->Cell(30,7,utf8_decode($d['telephone']),1,0,'C',$fill);
    $pdf->Cell(50,7,utf8_decode($d['email']),1,0,'L',$fill);
    $pdf->Cell(32,7,utf8_decode($d['license']),1,0,'C',$fill);
    $pdf->Cell(22,7,$date_ins,1,0,'C',$fill);
    $pdf->Cell(15,7,utf8_decode($d['statut']),1,1,'C',$fill);
    $fill = !$fill;
}

$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,utf8_decode('Nombre total d\'opticiens : ').$nombre,0,1,'L');

mysqli_close($con);
$pdf->Output('I','liste_opticiens.pdf');
exit;
