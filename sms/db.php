<?php

$host = '10.112.30.28';
$db = 'SGBDO';
$usuario = 'sgbdo';
$senha = 'sgbdo';


if($host=="127.0.0.1"){
	$db="sgbdodacta4";
}else{
	$db="SGBDO";	
	$senha="sgbdo";
}

$conexao = mysql_connect($host,$usuario,$senha);
if (!$conexao) {
	die('Não foi possível conectar: ' . mysql_error());
}

mysql_select_db($db,$conexao);

    


?>
