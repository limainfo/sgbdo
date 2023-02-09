<?php
/*
echo '<pre>';
print_r($militars);
echo '</pre>';
*/
//Column titles
//Data loading
//	header('charset=ISO-8859-1');
//print_r($militars);

$pdf->SetFont('Arial','',14);
$pdf->AliasNbPages('{total}');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 25);
//$pdf->Cell(40,10,'TESTES');


	$pdf->Habilitacao($habilitacaos);

	$pdf->fpdfOutput('habilitacao.pdf', 'I');
?>
