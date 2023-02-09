<?php

$pdf->SetFont('Arial','',14);
$pdf->AddPage('p');

$pdf->textoRodape("Desenvolvido por 1S BET EVALDO - CINDACTA IV");


//$pdf->EscalaConferencia($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev, $verso, $afastamento,$consultasql,$privilegios);
$pdf->EscalaConferencia($escala,$preenche, $turnos, $legendas,$unidade, $dtm, $dta, $selprev,$privilegios);
$pdf->fpdfOutput('escala.pdf', 'I');

?>
