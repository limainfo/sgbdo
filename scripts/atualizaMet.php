<?php
ini_set('display_errors', 1);
ini_set('error_reporting', 1);

$dbname="aim";
$dbuser="sgbdo";
$dbpasswd="naomexa";
$dbhost="127.0.0.1";
$dominio = "aer.mil.br";
$dominio = "intraer";

$dbhost="10.112.30.128";


if($dbhost=="127.0.0.1"){
	$dbname="aim";
}else{
	$dbname="SGBDO";	
	$dbpasswd="sgbdo";
}


//$dbhost="127.0.0.1:1000";$dbname="SGBDO";$dbpasswd="sgbdo";


$conexao = mysql_connect($dbhost,$dbuser,$dbpasswd);
if (!$conexao) {
	die('NÃ£o foi possÃ­Â­vel conectar: ' . mysql_error());
}
mysql_select_db($dbname,$conexao);

$sqllimpa = "delete from met ";
$limpeza = mysql_query($sqllimpa);

echo 'Início:'.date('Y-m-d h:i:s').'<br>';

//http://www.redemet.aer.mil.br/aux/consulta_msg_aut.php?local=sbbr,sbgl,sbsp&msg=metar&data_ini=2012012418&data_fim=2012012418
//$sql = "select * from localidades where localidadeId='SBMN' order by localidadeID asc";


$sql = "select * from localidades where substring(localidadeID,1,2)='SB'  order by localidadeID asc";
//$sql = "select * from localidades where localidadeID='SBMN'  order by localidadeID asc";
$localidades = mysql_query($sql);


//    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';


date_default_timezone_set('UTC');

$inicio=date('YmdH');
$iniciofmt=date('Y-m-d H:i ');

$iniciomenosum = strtotime("$iniciofmt -1 hour ");
$inicio1menos = date('YmdH',$iniciomenosum);

$dtinicio=$inicio1menos;
$dtfim=$inicio;

$fim='';

$tipo='metar';
date_default_timezone_set('America/Boa_Vista');

while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
	$sqllimpa = "delete from met where localidadeID='{$loc['localidadeID']}' ";
	$limpeza = mysql_query($sqllimpa);
	$urlmet = "http://www.redemet.$dominio/aux/consulta_msg_aut.php?local={$loc['localidadeID']}&msg={$tipo}&data_ini={$dtinicio}&data_fim={$dtfim} ";
	echo $urlmet.'<br>';
	try {
		$contentsmet = file_get_contents($urlmet);
		$partes = explode("=", $contentsmet);
		$atualizado = date('Y-m-d H:i:s');
		for($i=0;$i<count($partes);$i++){
			if((strpos($partes[$i], "localizada na base de dados")==false)&&(strlen(trim($partes[$i]))>0)){
				//echo $partes[$i]."<br>";
				$insercao ='insert ignore into met (tipo, mensagem, localidadeID, atualizado) values ("METAR", "'.$partes[$i].'", "'.$loc['localidadeID'].'",  "'.$atualizado.'") ';
				//echo $insercao."<br>";
				$insere = mysql_query($insercao);
			}
		}
	} catch (Exception $e) {
		
	}
}

$tipo='aviso_aerodromo';
while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
	$urlmet = "http://www.redemet.$dominio/aux/consulta_msg_aut.php?local={$loc['localidadeID']}&msg={$tipo}&data_ini={$dtinicio}&data_fim={$dtfim} ";
	echo $urlmet.'<br>';
	try {
		$contentsmet = file_get_contents($urlmet);
		$partes = explode("=", $contentsmet);
		$atualizado = date('Y-m-d H:i:s');
		for($i=0;$i<count($partes);$i++){
			if((strpos($partes[$i], "localizada na base de dados")==false)&&(strlen(trim($partes[$i]))>0)){
				$insercao ='insert ignore into met (tipo, mensagem, localidadeID,atualizado) values ("AVISO AERÓDROMO", "'.$partes[$i].'", "'.$loc['localidadeID'].'",  "'.$atualizado.'") ';
				$insere = mysql_query($insercao);
			}
		}
	} catch (Exception $e) {
		
	}
}
$tipo='aviso_aerodromo';
while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
	$urlmet = "http://www.redemet.$dominio/aux/consulta_msg_aut.php?local={$loc['localidadeID']}&msg={$tipo}&data_ini={$dtinicio}&data_fim={$dtfim} ";
	echo $urlmet.'<br>';
	try {
		$contentsmet = file_get_contents($urlmet);
		$partes = explode("=", $contentsmet);
		$atualizado = date('Y-m-d H:i:s');
		for($i=0;$i<count($partes);$i++){
			if((strpos($partes[$i], "localizada na base de dados")==false)&&(strlen(trim($partes[$i]))>0)){
				$insercao ='insert ignore into met (tipo, mensagem, localidadeID,atualizado) values ("AVISO AERÓDROMO", "'.$partes[$i].'", "'.$loc['localidadeID'].'",  "'.$atualizado.'") ';
				$insere = mysql_query($insercao);
			}
		}
	} catch (Exception $e) {
		
	}
}

$tipo='airep';
while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
	$urlmet = "http://www.redemet.$dominio/aux/consulta_msg_aut.php?local={$loc['localidadeID']}&msg={$tipo}&data_ini={$dtinicio}&data_fim={$dtfim} ";
	echo $urlmet.'<br>';
	try {
		$contentsmet = file_get_contents($urlmet);
		$partes = explode("=", $contentsmet);
		$atualizado = date('Y-m-d H:i:s');
		for($i=0;$i<count($partes);$i++){
			if((strpos($partes[$i], "localizada na base de dados")==false)&&(strlen(trim($partes[$i]))>0)){
				$insercao ='insert ignore into met (tipo, mensagem, localidadeID,atualizado) values ("AIREP", "'.$partes[$i].'", "'.$loc['localidadeID'].'",  "'.$atualizado.'") ';
				$insere = mysql_query($insercao);
			}
		}
	} catch (Exception $e) {
		
	}
}

$tipo='airmet';
while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
	$urlmet = "http://www.redemet.$dominio/aux/consulta_msg_aut.php?local={$loc['localidadeID']}&msg={$tipo}&data_ini={$dtinicio}&data_fim={$dtfim} ";
	echo $urlmet.'<br>';
	try {
		$contentsmet = file_get_contents($urlmet);
		$partes = explode("=", $contentsmet);
		$atualizado = date('Y-m-d H:i:s');
		for($i=0;$i<count($partes);$i++){
			if((strpos($partes[$i], "localizada na base de dados")==false)&&(strlen(trim($partes[$i]))>0)){
				$insercao ='insert ignore into met (tipo, mensagem, localidadeID,atualizado) values ("AIRMET", "'.$partes[$i].'", "'.$loc['localidadeID'].'",  "'.$atualizado.'") ';
				$insere = mysql_query($insercao);
			}
		}
	} catch (Exception $e) {
		
	}
}

$tipo='gamet';
while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
	$urlmet = "http://www.redemet.$dominio/aux/consulta_msg_aut.php?local={$loc['localidadeID']}&msg={$tipo}&data_ini={$dtinicio}&data_fim={$dtfim} ";
	echo $urlmet.'<br>';
	try {
		$contentsmet = file_get_contents($urlmet);
		$partes = explode("=", $contentsmet);
		$atualizado = date('Y-m-d H:i:s');
		for($i=0;$i<count($partes);$i++){
			if((strpos($partes[$i], "localizada na base de dados")==false)&&(strlen(trim($partes[$i]))>0)){
				$insercao ='insert ignore into met (tipo, mensagem, localidadeID,atualizado) values ("GAMET", "'.$partes[$i].'", "'.$loc['localidadeID'].'",  "'.$atualizado.'") ';
				$insere = mysql_query($insercao);
			}
		}
	} catch (Exception $e) {
		
	}
}

    	
 date_default_timezone_set('America/Boa_Vista');
    	
 echo '<br>Fim:'.date('Y-m-d h:i:s');
 
?>
