<?php
require("../fpdf/fpdf.php");
require("../connexion.php");

$res    = mysqli_query($con, "SELECT * FROM fournisseur ORDER BY idfournisseur");
$nombre = mysqli_num_rows($res);

class PDF_Fournisseur extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',13);
        $this->SetFillColor(39,174,96);
        $this->SetTextColor(255,255,255);
        $this->Cell(0,10,utf8_decode('OPTI CLOUD - Liste des fournisseurs'),0,1,'C',true);
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

$pdf = new PDF_Fournisseur('L','mm','A4');
$pdf->AliasNbPages();
// Marges réduites à 5mm pour maximiser l'espace utile (287mm disponibles)
$pdf->SetMargins(5,15,5);
$pdf->SetAutoPageBreak(true,12);
$pdf->AddPage();

// Largeurs recalculées : total = 287mm exactement
// ID=12 | Nom=52 | Responsable=48 | Adresse=60 | Ville=38 | Tel=34 | Email=43
$cols = array('ID'=>12,'Nom'=>52,'Responsable'=>48,'Adresse'=>60,'Ville'=>38,'Tel'=>34,'Email'=>43);
$total = array_sum(array_values($cols)); // = 287

// En-têtes
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(39,174,96);
$pdf->SetTextColor(255,255,255);
foreach($cols as $label=>$w)
    $pdf->Cell($w,9,utf8_decode($label),1,0,'C',true);
$pdf->Ln();

// Données
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($d = mysqli_fetch_assoc($res)) {
    $pdf->SetFillColor(240,255,240);
    $pdf->Cell(12,7,$d['idfournisseur'],1,0,'C',$fill);
    $pdf->Cell(52,7,utf8_decode($d['nom']),1,0,'L',$fill);
    $pdf->Cell(48,7,utf8_decode($d['responsable']),1,0,'L',$fill);
    $pdf->Cell(60,7,utf8_decode($d['adresse']),1,0,'L',$fill);
    $pdf->Cell(38,7,utf8_decode($d['ville']),1,0,'L',$fill);
    $pdf->Cell(34,7,utf8_decode($d['telephone']),1,0,'C',$fill);
    $pdf->Cell(43,7,utf8_decode($d['email']),1,1,'L',$fill);
    $fill = !$fill;
}

// Total
$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,utf8_decode('Nombre total de fournisseurs : ').$nombre,0,1,'L');

mysqli_close($con);
$pdf->Output('I','liste_fournisseurs.pdf');
exit;
