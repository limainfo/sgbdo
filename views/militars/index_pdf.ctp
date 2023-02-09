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

if (!empty($um)){

	$url = $this->Html->url($militars['Foto']['id'], array('controller'=> 'fotos', 'action'=>'externodownload'));
	$parte_url = 'fotos/externodownload/'.$militars['Foto']['id'];
	//echo str_replace('militars/indexPdf',$parte_url,$url);

	$pdf->HeaderFichaCadastral($militars,$url);
	$pdf->DadosPessoais($militars);


}
else{

	foreach($militars as $milico){

		$t1 = strtoupper($milico['Setor']['sigla_setor']);
		$t2 = strtoupper($milico['Especialidade']['nm_especialidade']);
		$t3 = strtoupper($milico['Militar']['nm_completo']);
		$t4 = strtoupper($milico['Posto']['sigla_posto']);
		
		//$p = '/'.$consulta.'/';
		
	//	if((preg_match($p, $t1))||(preg_match($p, $t2))||(preg_match($p, $t3))||(preg_match($p, $t4))){
		$url = $this->Html->url($milico['Foto']['id'], array('controller'=> 'fotos', 'action'=>'externodownload'));
		$parte_url = 'fotos/externodownload/'.$milico['Foto']['id'];
		//echo str_replace('militars/indexPdf',$parte_url,$url);
		$pdf->HeaderFichaCadastral($milico,$url);
		$pdf->DadosPessoais($milico);
		
		//}
		$pdf->AddPage();
	}
}
$pdf->fpdfOutput('teste.pdf', 'I');
?>
