<?php
//		header('Content-type: application/x-json');
$v1=$_POST['nome'];
$v2=$_POST['campo'];
$v3=$_POST['conteudo'];
$v4=$_POST['id'];
//ini_set('error_reporting',true);

if(empty($v1)||empty($v1)||empty($v1)||empty($v1)){
	echo 'ERRO';
}else{

	require('conn.inc');

	$sql= "update militars set $v2=$v3 where id='$v4' ";
	if(mysql_query($sql)){
		echo 'OK';
	}else{
		echo 'ERRO';	
	}
}
exit();

?>
