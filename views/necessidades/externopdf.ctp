<?php
/*
		echo '<pre>';
		print_r($vetor);
		echo '</pre>';
exit();
*/
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->controle_rodape=0;
//$pdf->textoRodape("");

$chefeequipe = '';
$supervisor = '';
$escalados = '';

$ocorrenciaOperacional = '';
$ocorrenciaTecnica = '';
$ocorrenciaAdministrativa = '';

$unidadeResponsavel = $unidade;
$siat = $siat;
$chefe = $chefe;
$anoPaeat = $ano;
$divisaoSolicitante= $divisao;	
//var_dump($vetor);exit();		
$pdf->fichaPropostaPAEAT($anoPaeat, $unidadeResponsavel, $siat, $chefe,$divisaoSolicitante, $vetor);
  
//($pdf);
$pdf->fpdfOutput('fichas'.$anoPaeat.'.pdf', 'D');



?>
