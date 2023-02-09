<?php
			//print_r($licencas);exit();

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

 $pdf->barcode("CODE128");
 $barnumber=$licencas['Licenca']['codigo_barra'];//"PQ-RSCt 0072011.070000001"
 $pdf->setSymblogy("CODE128");
 $pdf->setHeight(40);
 //$pdf->setScale(.0);
 //$pdf->setHexColor("#a0a0dd","#FFFFFF");
 $pdf->setHexColor("#000000","#FFFFFF");
 $caminho = str_replace("index.php","tmpfotos/codigobarra",$_SERVER["SCRIPT_FILENAME"]);
 $dados = $pdf->genBarCode($barnumber,"jpg",$caminho);

 $pdf->Licenca($licencas);


}
else{

	foreach($licencas as $milico){

		$t1 = strtoupper($milico['Setor']['sigla_setor']);
		$t2 = strtoupper($milico['Especialidade']['nm_especialidade']);
		$t3 = strtoupper($milico['Militar']['nm_completo']);
		$t4 = strtoupper($milico['Posto']['sigla_posto']);
		
		//$p = '/'.$consulta.'/';
		
	//	if((preg_match($p, $t1))||(preg_match($p, $t2))||(preg_match($p, $t3))||(preg_match($p, $t4))){
		$url = $this->Html->url($milico['Foto']['id'], array('controller'=> 'fotos', 'action'=>'externodownload'));
		$parte_url = 'fotos/externodownload/'.$milico['Foto']['id'];
		//echo str_replace('militars/indexPdf',$parte_url,$url);
		$pdf->Licenca($milico,$url);
		
		//}
		$pdf->AddPage();
	}
}
$pdf->fpdfOutput('licenca.pdf', 'I');
?>
