<?php

foreach($escala['Escalasmonth'] as $nomes){
	if($nomes['mes']==$dta.'/'.$dtm){
		$id2 = $nomes['id'];
		break;
	}
}


$pdf->SetFont('Arial','',14);
$pdf->AddPage('p');

$pdf->textoRodape("Desenvolvido por 1S BET EVALDO - CINDACTA IV");

//print_r($afastados);

$pdf->listaAfastados($afastados, $setor);
$pdf->fpdfOutput('afastados.pdf', 'I');



?>
