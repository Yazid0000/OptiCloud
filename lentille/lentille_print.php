<?php
require("../fpdf/fpdf.php");
require("../connexion.php");

$res = mysqli_query($con,
    "SELECT l.*, m.nom AS nommarque, f.nom AS nomfournisseur
     FROM lentille l
     LEFT JOIN marque m ON l.idmarque=m.idmarque
     LEFT JOIN fournisseur f ON l.idfournisseur=f.idfournisseur
     ORDER BY l.idlentille");
$nombre = mysqli_num_rows($res);

class PDF_Lentille extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',13);
        $this->SetFillColor(111,66,193);
        $this->SetTextColor(255,255,255);
        $this->Cell(0,10,utf8_decode('OPTI CLOUD - Liste des lentilles de contact'),0,1,'C',true);
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

$pdf = new PDF_Lentille('L','mm','A4');
$pdf->AliasNbPages();
// Marges 5mm => 287mm disponibles
$pdf->SetMargins(5,18,5);
$pdf->SetAutoPageBreak(true,12);
$pdf->AddPage();

// Colonnes : ID=16 | Nom=52 | Type=26 | Correction=26 | Mat=32 | Couleur=20 | Prix=22 | Stock=12 | Marque=38 | Fourn=43 = 287
$cols = array('ID'=>16,'Nom'=>52,'Type'=>26,'Correction'=>26,'Materiau'=>32,'Couleur'=>20,'Prix MAD'=>22,'Stock'=>12,'Marque'=>38,'Fournisseur'=>43);
$total = array_sum(array_values($cols)); // = 287

// En-têtes
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(111,66,193);
$pdf->SetTextColor(255,255,255);
foreach($cols as $label=>$w)
    $pdf->Cell($w,9,utf8_decode($label),1,0,'C',true);
$pdf->Ln();

// Données
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($d = mysqli_fetch_assoc($res)) {
    $nommarque      = isset($d['nommarque'])      ? $d['nommarque']      : '';
    $nomfournisseur = isset($d['nomfournisseur']) ? $d['nomfournisseur'] : '';
    $pdf->SetFillColor(245,240,255);
    $pdf->Cell(16,7,$d['idlentille'],1,0,'C',$fill);
    $pdf->Cell(52,7,utf8_decode($d['nom']),1,0,'L',$fill);
    $pdf->Cell(26,7,utf8_decode($d['type']),1,0,'C',$fill);
    $pdf->Cell(26,7,utf8_decode($d['correction']),1,0,'C',$fill);
    $pdf->Cell(32,7,utf8_decode($d['materiau']),1,0,'L',$fill);
    $pdf->Cell(20,7,utf8_decode($d['couleur']),1,0,'L',$fill);
    $pdf->Cell(22,7,number_format($d['prix'],0,',',' '),1,0,'R',$fill);
    $pdf->Cell(12,7,$d['stock'],1,0,'C',$fill);
    $pdf->Cell(38,7,utf8_decode($nommarque),1,0,'L',$fill);
    $pdf->Cell(43,7,utf8_decode($nomfournisseur),1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,utf8_decode('Nombre total de lentilles : ').$nombre,0,1,'L');

mysqli_close($con);
$pdf->Output('I','liste_lentilles.pdf');
exit;
