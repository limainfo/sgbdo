<?php
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->relatorioEscala($escalas,$mes,$selprev);

$pdf->fpdfOutput('relatorio.pdf', 'I');

/*
$id1 = $dta.$dtm;
$pdf->barcode("CODE128");


$barnumber="{$id1}SistemaGerencimaentoDO{$id2}";
$pdf->setSymblogy("CODE128");
$pdf->setHeight(40);
$pdf->setScale(1);
$pdf->setHexColor("#a0a0dd","#FFFFFF");
$caminho = str_replace("index.php","tmpfotos/{$id1}{$id2}",$_SERVER["SCRIPT_FILENAME"]);
$dados = $pdf->genBarCode($barnumber,"jpg",$caminho);

$pdf->Escala($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql);

echo $pdf->fpdfOutput('escala.pdf', 's');
*/
/*
echo "<pre>";
print_r($escalas);
echo "</pre>";
*/
?>
