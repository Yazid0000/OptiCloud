<?php
require("../fpdf/fpdf.php");
require("../connexion.php");

$res = mysqli_query($con,
    "SELECT mo.*, ma.nom AS nommarque, f.nom AS nomfournisseur, c.nomcategorie
     FROM monture mo
     LEFT JOIN marque ma ON mo.idmarque=ma.idmarque
     LEFT JOIN fournisseur f ON mo.idfournisseur=f.idfournisseur
     LEFT JOIN categorie c ON mo.idcategorie=c.idcategorie
     ORDER BY mo.idmonture");
$nombre = mysqli_num_rows($res);

class PDF_Monture extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',13);
        $this->SetFillColor(220,53,69);
        $this->SetTextColor(255,255,255);
        $this->Cell(0,10,utf8_decode('OPTI CLOUD - Liste des montures'),0,1,'C',true);
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

$pdf = new PDF_Monture('L','mm','A4');
$pdf->AliasNbPages();
// Marges 5mm => 287mm disponibles
$pdf->SetMargins(5,18,5);
$pdf->SetAutoPageBreak(true,12);
$pdf->AddPage();

// Colonnes ajustées : total = 287mm
// ID=10 | Ref=24 | Modele=36 | Genre=18 | Couleur=24 | Mat=22 | Prix=22 | Stock=12 | Marque=30 | Fourn=36 | Cat=53
$cols = array('ID'=>10,'Ref'=>24,'Modele'=>36,'Genre'=>18,'Couleur'=>24,'Mat.'=>22,'Prix MAD'=>22,'Stock'=>12,'Marque'=>30,'Fournisseur'=>36,'Categorie'=>53);
$total = array_sum(array_values($cols)); // = 287

// En-têtes
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(220,53,69);
$pdf->SetTextColor(255,255,255);
foreach($cols as $label=>$w)
    $pdf->Cell($w,9,utf8_decode($label),1,0,'C',true);
$pdf->Ln();

// Données
$pdf->SetFont('Arial','',7);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($d = mysqli_fetch_assoc($res)) {
    $nommarque      = isset($d['nommarque'])      ? $d['nommarque']      : '';
    $nomfournisseur = isset($d['nomfournisseur']) ? $d['nomfournisseur'] : '';
    $nomcategorie   = isset($d['nomcategorie'])   ? $d['nomcategorie']   : '';
    $pdf->SetFillColor(255,240,242);
    $pdf->Cell(10,7,$d['idmonture'],1,0,'C',$fill);
    $pdf->Cell(24,7,utf8_decode($d['reference']),1,0,'L',$fill);
    $pdf->Cell(36,7,utf8_decode($d['modele']),1,0,'L',$fill);
    $pdf->Cell(18,7,utf8_decode($d['genre']),1,0,'C',$fill);
    $pdf->Cell(24,7,utf8_decode($d['couleur']),1,0,'L',$fill);
    $pdf->Cell(22,7,utf8_decode($d['materiau']),1,0,'L',$fill);
    $pdf->Cell(22,7,number_format($d['prix'],0,',',' '),1,0,'R',$fill);
    $pdf->Cell(12,7,$d['stock'],1,0,'C',$fill);
    $pdf->Cell(30,7,utf8_decode($nommarque),1,0,'L',$fill);
    $pdf->Cell(36,7,utf8_decode($nomfournisseur),1,0,'L',$fill);
    $pdf->Cell(53,7,utf8_decode($nomcategorie),1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Ln(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,8,utf8_decode('Nombre total de montures : ').$nombre,0,1,'L');

mysqli_close($con);
$pdf->Output('I','liste_montures.pdf');
exit;
