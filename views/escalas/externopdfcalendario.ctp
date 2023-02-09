<?php

$pdf->SetFont('Arial','',14);
$pdf->AddPage('p');

$pdf->textoRodape("Desenvolvido por 1S BET EVALDO - CINDACTA IV");


$pdf->EscalaCalendario($nome, $unidade, $vetorCalendario, $contadias, $totaldias, $vetorTurnos);
$pdf->fpdfOutput('calendario.pdf', 'I');

?>
