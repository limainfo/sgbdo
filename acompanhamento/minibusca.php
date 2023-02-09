<?php
//header("Content-type: text/html; charset=utf-8\r\n");
header('Content-type: application/x-json');
ini_set('display_errors', 1);
ini_set('error_reporting', 1);

$militar_id = $_GET['militarID'];
$paeat_id = $_GET['paeatID'];

$dbSGBDO = 'SGBDO';
$hostSGBDO = '10.112.30.28';
$nomeSGBDO = 'sgbdo';
$senhaSGBDO = 'sgbdo';
/*
$hostSGBDO = '127.0.0.1';
$dbSGBDO = 'sgbdodacta4';
$senhaSGBDO = 'naomexa';
*/


$dbONIX = 'onix';
$hostONIX = '10.112.30.28';
$nomeONIX = 'onix';
$senhaONIX = 'xino#ccasj';
//$hostONIX = '127.0.0.1:1000';


$fasesql = 52;
$debug=0;

$conexao = mysql_pconnect($hostSGBDO,$nomeSGBDO,$senhaSGBDO);


	//Busca existencia do registro ------------------------------------------------
	$cpf = '';
	if (!$conexao) {
		die('Não foi possível conectar: ' . mysql_error());
	}
	$sqltemp = "select * from paeatsindicadostemp where militar_id='$militar_id' and paeat_id=$paeat_id ";
	mysql_select_db($dbSGBDO,$conexao);
	$consulta = mysql_query($sqltemp);
	$ostemp= '';
	$matriculadotemp= '';
	$passagemtemp= '';
	while($dadostemp = mysql_fetch_array($consulta, MYSQL_BOTH)){
	    $ostemp= $dadostemp['os'];
	    $matriculadotemp= $dadostemp['matriculado'];
	    $passagemtemp= $dadostemp['passagem'];
	}
	
	$insere = 0;
//	if(empty($ostemp)&&empty($matriculadotemp)&&empty($passagemtemp)){
	if(empty($ostemp)&&empty($passagemtemp)){
		$insere = 1;
	}
	if(strlen($ostemp)==strlen($passagemtemp)){
		$insere = 0;
	}
	
	
	
	//Busca cpf do militar ------------------------------------------------
	$sqlmilitars = "select * from militars where id='$militar_id' ";
	mysql_select_db($dbSGBDO,$conexao);
	$consulta = mysql_query($sqlmilitars);
	while($dadosmilitar = mysql_fetch_array($consulta, MYSQL_BOTH)){
	    $cpf= $dadosmilitar['cpf'];
	    $saram= $dadosmilitar['saram'];
	}
	$completa = " where 1=1 ";
	$completa .= " and replace(replace(servidor.sdpp,'.',''),'-','') =replace(replace('$saram','.',''),'-','') ";
	//Busca cpf do militar ------------------------------------------------

	//Busca dados do Paeat e indicação ------------------------------------------------
	$sqlpaeats = "select * from paeats Paeat inner join paeatsindicados PaeatInd
	on (Paeat.id=PaeatInd.paeat_id and PaeatInd.militar_id='$militar_id' and Paeat.id=$paeat_id)";
	$consulta = mysql_query($sqlpaeats);
	$inicio = '';
	$fim = '';
	$codcurso = '';
	$ano = '';
	while($dados = mysql_fetch_array($consulta, MYSQL_BOTH)){
	    $ano= $dados['ano'];
	    $codcurso= $dados['codcurso'];
	    $inicio= $dados['inicio'];
	    $fim= $dados['fim'];
	}
	
	$completa .= " and datediff('$inicio',os.saida_data)<=3 and datediff('$fim',os.regresso_data)>=-2  ";
	
	
	//Busca dados do Paeat e indicação ------------------------------------------------

	
$contents = '';
$localizadores = '';
$os = '';
if(empty($ostemp)||(strlen($ostemp)<5)){
	
	//Busca dados OS no Onix ------------------------------------------------
$sqlonix =<<<INICIOSQL
select *, fase.display as statusos, servidor.nome_completo nomecompleto, cidade.cidade as nomecidade from os 
inner join pernoite on (pernoite.id_os=os.id_os)
inner join cidade on (cidade.id_cidade=pernoite.id_cidade)
inner join servidor on (servidor.id_servidor=pernoite.id_servidor)
inner join fase on (os.id_fase=fase.id_fase)
$completa
  group by pernoite.id_os
  order by os.saida_data desc, servidor.cpf asc
  limit 0,1
INICIOSQL;
	
//echo $sqlonix;

if(empty($ostemp)){
	$conectaonix=mysql_pconnect($hostONIX,$nomeONIX,$senhaONIX);
	if (!$conectaonix) {
	    die('Not connected : ' . mysql_error());
	}
	$selecionanix = mysql_select_db($dbONIX, $conectaonix);
	if (!$selecionanix) {
	    die ('Não é possível acessar ONIX : ' . mysql_error());
	}
	$consulta = mysql_query($sqlonix);
	while($dados = mysql_fetch_array($consulta, MYSQL_BOTH)){
	   $osbd = $dados['os'];
	   $os=substr($dados['os'],0,strpos($dados['os'], '/'));
	   $ano=substr($dados['os'],strpos($dados['os'], '/2')+1);
	   /*
	   if(strlen($passagemtemp)<=4){
		   $contents = file_get_contents("http://10.32.63.109/cpa/webservice/consultavalor/obtemdados.asp?os=".$os."&ano=".$ano."");
		   $objeto = json_decode($contents,TRUE);
		   $localizadores = '';
		   if(!empty($objeto) ){
		       $passagemsolicitacao = $objeto[0]['NUMREQUISICAO'].'/'.$objeto[0]['SIGLA'].'/'.$objeto[0]['ANO'];
		       $ano = $objeto[0]['ANO'];
		       foreach($objeto as $dado){
			       if($dado['ANO']==$ano){
				       $localizadores .= $dado['LOCALINICIAL']."->".$dado['LOCALIZADOR'].' ';
			       }
		       }
		
		   }else{
			   $localizadores = '';
		   }
		if($insere==0){
			$conexao = mysql_pconnect($hostSGBDO,$nomeSGBDO,$senhaSGBDO);
		   	mysql_select_db($dbSGBDO,$conexao);
		   	$atualiza = "update paeatsindicadostemp set passagem='$localizadores' where paeat_id=$paeat_id and militar_id='$militar_id' ";
		   	mysql_query($atualiza);
	   	}
		   
	   }
	   */
	}
}else{
		$osbd = $ostemp;
		
}
		if($insere==0){
			$conexao = mysql_pconnect($hostSGBDO,$nomeSGBDO,$senhaSGBDO);
		   	mysql_select_db($dbSGBDO,$conexao);
		   	$atualiza = "update paeatsindicadostemp set os='$osbd' where paeat_id=$paeat_id and militar_id='$militar_id' ";
		   	mysql_query($atualiza);
	   	}
	//Busca dados OS no Onix ------------------------------------------------
}

	//Busca dados na DCTP ------------------------------------------------

/*
$matriculado = '';

if($matriculadotemp !='S'){

$conectadctp=mysql_pconnect('10.32.63.29','drhu','drhu');
	if (!$conectadctp) {
	    die('Not connected : ' . mysql_error());
	}
	$selecionadctp = mysql_select_db('dctp', $conectadctp);
	if (!$selecionadctp) {
	    die ('Não é possível acessar DCTP : ' . mysql_error());
	}
	$cursos=mysql_query('select *, tabelao.observacoes as obscurso, indicacoes.observacoes as obsindicacao from indicacoes inner join tabelao on (indicacoes.codTabelao=tabelao.codTabelao) inner join petc on (petc.codcurso=tabelao.codcurso) where replace(replace(indicacoes.cpf,".",""),"-","")=replace(replace("'.$cpf.'",".",""),"-","") and tabelao.ano='.$ano.' and tabelao.codcurso="'.$codcurso.'" and datediff("'.$inicio.'",tabelao.inicio)<=2 and datediff("'.$fim.'",tabelao.fim)<=2 order by tabelao.inicio desc limit 0,1');
	$recurso = mysql_fetch_array($cursos, MYSQL_BOTH);
	$matriculado = $recurso['matriculado'];
	if(strtoupper($matriculado) == 'TRUE'){
		$matriculado = 'S';
	}else{
		$matriculado = 'N';
	}
	if($insere==0){
$conexao = mysql_pconnect($hostSGBDO,$nomeSGBDO,$senhaSGBDO);
	   	mysql_select_db($dbSGBDO,$conexao);
	$atualiza = "update paeatsindicadostemp set matriculado='$matriculado' where paeat_id=$paeat_id and militar_id='$militar_id' ";
	echo $atualiza;
	mysql_query($atualiza);
	}
}
*/
	//Busca dados na DCTP ------------------------------------------------
	$conexao = mysql_pconnect($hostSGBDO,$nomeSGBDO,$senhaSGBDO);
	   	mysql_select_db($dbSGBDO,$conexao);
	if($insere){
		$sqltempinsere = "insert into paeatsindicadostemp (militar_id,paeat_id,os, matriculado,passagem) values('$militar_id',$paeat_id,'$osbd','$matriculado','$localizadores') ";
		mysql_query($sqltempinsere);
	}
	$sqltemp = "select * from paeatsindicadostemp where militar_id='$militar_id' and paeat_id=$paeat_id ";
	$consulta = mysql_query($sqltemp);
	while($dadostemp = mysql_fetch_array($consulta, MYSQL_BOTH)){
	    $ostemp= $dadostemp['os'];
	   // $matriculadotemp= $dadostemp['matriculado'];
	    $matriculadotemp= '';
	    $passagemtemp= $dadostemp['passagem'];
	}

	if($debug){
		echo 'SQL CONSULTA<br>'.$sqltemp.'<br>';
		echo 'SQL INSERT<br>'.$sqltempinsere.'<br>';
		echo 'SQL MILITAR<br>'.$sqlmilitars.'<br>';
		print_r($dadosmilitar);
		echo 'SQL PAEAT<br>'.$sqlpaeats.'<br>';
		echo 'SQL ONIX<br>'.$sqlonix.'<br>';
		echo 'SQL DCTP<br>'.'select *, tabelao.observacoes as obscurso, indicacoes.observacoes as obsindicacao from indicacoes inner join tabelao on (indicacoes.codTabelao=tabelao.codTabelao) inner join petc on (petc.codcurso=tabelao.codcurso) where replace(replace(indicacoes.cpf,".",""),"-","")=replace(replace("'.$cpf.'",".",""),"-","") and tabelao.ano='.$ano.' and tabelao.codcurso="'.$codcurso.'" and datediff("'.$inicio.'",tabelao.inicio)<=2 and datediff("'.$fim.'",tabelao.fim)<=2 order by tabelao.inicio desc limit 0,1'.'<br>';
	}

	echo "<td>&nbsp;$ostemp</td><td>&nbsp;$matriculadotemp</td><td>&nbsp;$passagemtemp</td>";
	exit();
 ?>
 

