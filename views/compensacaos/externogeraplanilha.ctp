<?php 

$data = date('d-m-Y h:i:s');
$datai = date('Y-m-d');
$cabecalho=<<<CABE
LICENÇA,SARAM,POSTO,QUADRO,NMGUERRA,SETOR,INDICATIVO,JAN,FEV,MAR,ABR,MAI,JUN,JUL,AGO,SET,OUT,NOV,DEZ
CABE;

$cabecalho .= "\n";

$rodape = <<<RODA
,,,,,,,,,,,,,,,,,DATA DA ATUALIZAÇÃO:,{$datai},{$data}
RODA;
$rodape .= "\n";


foreach($resultado as $registro){
	
	$licenca = $registro['licenca'];
	$setor = $registro['setor'];
	$indicativo = $registro['indicativo'];
	$nome = $registro['nome'];
	$guerra = $registro['guerra'];
	$posto = $registro['posto'];
	$quadro = $registro['quadro'];
	$saram = $registro['saram'];
	$cpf = $registro['cpf'];
	$identidade = $registro['identidade'];
	
	
	if(!empty($registro[1])){
		$jan = '';
		$jant = 0;
		foreach($registro[1]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$jan .= $nomeescala.'='.$registro[1]['horas'][$chave];
			$jant += $registro[1]['horas'][$chave];
		}
	}else{
		$jan = '';	
		$jant = '';	
	}
	
	
	if(!empty($registro[2])){
		$fev = '';
		$fevt = 0;
		foreach($registro[2]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$fev .= $nomeescala.'='.$registro[2]['horas'][$chave];
			$fevt += $registro[2]['horas'][$chave];
		}
	}else{
		$fev = '';	
		$fevt = '';	
	}
	if(!empty($registro[3])){
		$mar = '';
		$mart = 0;
		foreach($registro[3]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$mar .= $nomeescala.'='.$registro[3]['horas'][$chave];
			$mart += $registro[3]['horas'][$chave];
		}
	}else{
		$mar = '';	
		$mart = '';	
	}
	if(!empty($registro[4])){
		$abr = '';
		$abrt = 0;
		foreach($registro[4]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$abr .= $nomeescala.'='.$registro[4]['horas'][$chave];
			$abrt += $registro[4]['horas'][$chave];
		}
	}else{
		$abr = '';	
		$abrt = '';	
	}
	if(!empty($registro[5])){
		$mai = '';
		$mait = 0;
		foreach($registro[5]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$mai .= $nomeescala.'='.$registro[5]['horas'][$chave];
			$mait += $registro[5]['horas'][$chave];
		}
	}else{
		$mai = '';	
		$mait = '';	
	}
	if(!empty($registro[6])){
		$jun = '';
		$junt = 0;
		foreach($registro[6]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$jun .= $nomeescala.'='.$registro[6]['horas'][$chave];
			$junt += $registro[6]['horas'][$chave];
		}
	}else{
		$jun = '';	
		$junt = '';	
	}
	if(!empty($registro[7])){
		$jul = '';
		$jult = 0;
		foreach($registro[7]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$jul .= $nomeescala.'='.$registro[7]['horas'][$chave];
			$jult += $registro[7]['horas'][$chave];
		}
	}else{
		$jul = '';	
		$jult = '';	
	}
	if(!empty($registro[8])){
		$ago = '';
		$agot = 0;
		foreach($registro[8]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$ago .= $nomeescala.'='.$registro[8]['horas'][$chave];
			$agot += $registro[8]['horas'][$chave];
		}
	}else{
		$ago = '';	
		$agot = '';	
	}
	if(!empty($registro[9])){
		$set = '';
		$sett = 0;
		foreach($registro[9]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$set .= $nomeescala.'='.$registro[9]['horas'][$chave];
			$set += $registro[9]['horas'][$chave];
		}
	}else{
		$set = '';	
		$sett = '';	
	}
	if(!empty($registro[10])){
		$out = '';
		$outt = 0;
		foreach($registro[10]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$out .= $nomeescala.'='.$registro[10]['horas'][$chave];
			$outt += $registro[10]['horas'][$chave];
		}
	}else{
		$out = '';	
		$outt = '';	
	}
	if(!empty($registro[11])){
		$nov = '';
		$novt = 0;
		foreach($registro[11]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$nov .= $nomeescala.'='.$registro[11]['horas'][$chave];
			$novt += $registro[11]['horas'][$chave];
		}
	}else{
		$nov = '';	
		$novt = '';	
	}
	if(!empty($registro[12])){
		$dez = '';
		$dezt = 0;
		foreach($registro[12]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$dez .= $nomeescala.'='.$registro[12]['horas'][$chave];
			$dezt += $registro[12]['horas'][$chave];
		}
	}else{
		$dez = '';	
		$dezt = '';	
	}

	
	
	
$corpo .= <<<CORPO
{$licenca},{$saram},{$posto},{$quadro},{$guerra},{$setor},{$indicativo},{$jan}-{$jant},{$fev}-{$fevt},{$mar}-{$mart},{$abr}-{$abrt},{$mai}-{$mait},{$jun}-{$junt},{$jul}-{$jult},{$ago}-{$agot},{$set}-{$sett},{$out}-{$outt},{$nov}-{$novt},{$dez}-{$dezt}
CORPO;

$corpo .= "\n";

}
$conteudo = $cabecalho.$corpo.$rodape;


header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Expires: 0');
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=compensacao.csv");



echo $conteudo;


?>
