<?php


$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->textoRodape("Confere com original conforme NPA 261/DO/09 de 01/04/09. Desenvolvido por 1S BET EVALDO");

$chefeequipe = '';
$supervisor = '';
$escalados = '';

$ocorrenciaOperacional = '';
$ocorrenciaTecnica = '';
$ocorrenciaAdministrativa = '';

$pdf->LivroEletronico($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql,$podeexibirrascunho);
$pdf->fpdfOutput('escala.pdf', 'I');



?>
