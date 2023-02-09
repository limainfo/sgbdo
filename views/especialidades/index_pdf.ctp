<?php
	
	//Column titles
	$header=array('Id','Quadro','Especialidade','Descrição');
	//Data loading
	$pdf->SetFont('Arial','',14);
	$pdf->AddPage();
	//$pdf->Cell(40,10,'TESTES');
	$pdf->basicTable($header,$especialidades);
	
//    $colWidth = array(40,35,40,45);
  //  $pdf->fancyTable($header,$colWidth, $especialidades['Especialidade']);
	
   // print_r($especialidades);
	echo $pdf->fpdfOutput('teste.pdf', 'I');
?>
