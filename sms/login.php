
<?php 
// Report all PHP errors
/*
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
*/
include_once('ldap.php'); 

?>
<?php 

?>
<?php

$mensagem = '';
	if( $_GET['xsession']==1 ){
		$_SESSION['login']='';
		$_SESSION['id']='';
		setcookie('login','', time()-7200);
		setcookie('id', '', time()-7200);
	}
	

if((isset($_POST['usuario']))&&(isset($_POST['senha']))){
	$mensagem = autentica($_POST['usuario'], $_POST['senha']);
	
	//Forçar login
	/*
	$_SESSION['login']='evaldoesl';
	$_SESSION['id']=md5('evaldoesl');
	setcookie("id", md5('evaldoesl'), time()+3600); 
	setcookie("login", 'evaldoesl', time()+3600); 
	$mensagem = 'OK';
	*/
	if(!isset($cabecalho_carregado)){
		include_once 'cabecalho.php';
	}
	$_SERVER['SCRIPT_FILENAME'] = $_SERVER['SCRIPT_FILENAME'].'/sms.php?i=2394918349819321931849832198';
	//echo basename($_SERVER['SCRIPT_FILENAME']);exit();
	if( $mensagem == 'OK' ){
	//	$_SERVER['SCRIPT_FILENAME'] = str_replace('login.php','sms.php',$_SERVER['SCRIPT_FILENAME']);
		include('sms.php');
		//print_r($SESSION);
		exit();
	}
	if( strpos($mensagem,'Erro') !== false ){
		//unset($_POST['usuario']);
		//unset($_POST['senha']);
		include('form.php');
		exit();
	}
	




}
	if(!isset($cabecalho_carregado)){
		include_once 'cabecalho.php';
	}
		include('form.php');
		exit();


?>

</html> 

