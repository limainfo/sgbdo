<?php
//error_reporting(E_ALL);




function autentica($usuario, $senha) {

	// Le os dados do formulario
	$username = $usuario;
	$password = $senha;
	$ldap_server01 = "ldaps://10.112.30.22/";
	$ldap_server02 = "ldaps://10.112.24.22/";

	// Valida os dados do formulario
	$valido = 0;
	$mensagem = '';
	
	// Conecta-se ao servidor usando LDAP v3 e faz bind anonimo
	if (($connect = @ldap_connect($ldap_server01))){
		$ldap_server = $ldap_server01;
	}else{
		$ldap_server = $ldap_server02;
	}
	
	
	if (!($connect = @ldap_connect($ldap_server))) $mensagem .= "Falha: Não conectou ao LDAP: " . ldap_error ($connect);
	
	if (!($connect = @ldap_connect($ldap_server))) {
		$mensagem .= 'Servidor Indisponível!';
	}else{
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		if (!($bind = @ldap_bind($connect))) {
			$mensagem .= 'Conectou ao servidor LDAP, mas bloqueou na porta';
		}else{
			// Procura o usuário no LDAP
			if (!($res_id = @ldap_search($connect, "dc=cindacta4,dc=intraer", "uid=$username"))){
				$mensagem .= 'Conectou ao servidor LDAP. Autorizou a porta, mas não foi encontrado o usuário.';
			}else{
				// Cancela o processo se o usuario nao foi encontrado ou se estah duplicado
				if (ldap_count_entries($connect, $res_id) == 0) {
					$mensagem = "Falha: Nome de usu&aacute;rio $username n&atilde;o encontrado.";
				} else if (ldap_count_entries ($connect, $res_id) > 1) {
					$mensagem .= "Falha: Nome de usu&aacute;rio $username encontrado mais de uma vez.";
				}
				
			} 
		}
		
	}



	// Obtem o DN do usuario
	if (!($entry_id = @ldap_first_entry($connect, $res_id))) $mensagem .= "Falha: resultado da busca n&atilde;o p&ocirc;de ser acessado.";
	if (!($user_dn = @ldap_get_dn($connect, $entry_id))) $mensagem .= "Falha: DN do usu&aacute;rio n&atilde;o p&ocirc;de ser acessado.";

	// Autentica o usuario
	if (!($link_id = @ldap_bind($connect, $user_dn, $password))) $mensagem .= "Erro: senha incorreta.";

	if(strlen($mensagem)<2){
		$mensagem = 'OK';
		//session_cache_expire(30);
		//$_SESSION['login']=$usuario;
		//$_SESSION['id']=md5($usuario);
		// Configura a data de expiração para uma hora atrás
		if(empty($_SESSION['id'])){
			$_SESSION['login']=$usuario;
			$_SESSION['id']=md5($usuario);
		}
		
		if(empty($_COOKIE['id'])){
			setcookie("id", md5($usuario), time()+3600);  /* expire in 1 hour */
			setcookie("login", $usuario, time()+3600);  /* expire in 1 hour */
		}
	}
	//echo $mensagem;print_r($_SESSION);

	return $mensagem;


}


?>

