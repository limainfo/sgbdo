<?php

    header('Cache-Control: no-cache, must-revalidate');    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');    header('Content-type: application/json');

//error_reporting(E_ALL);

//echo exec('whoami');

//phpinfo();

function obtemIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
	$ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
		$ip=$_SERVER['REMOTE_ADDR'];
        }
    return $ip;
}

$usuario = $_GET['user'];
$ddd = $_GET['ddd'];
$chip = $_GET['chip'];
$fone = $_GET['celular'];
if(strlen($ddd)!=3){
    $ddd = '';
}
if(strlen($fone)<8){
    $fone = '';
}
$key = $_GET['chave'];
$msg = preg_replace("[^a-zA-Z0-9_ ]", "", strtr($_GET['mensagem'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
$msg = iconv('UTF-8','ISO-8859-1',$msg);
$op = $_GET['operadora'];
$uuid = $_GET['id'];

if((!empty($usuario))&&(!empty($ddd))&&(!empty($fone))&&(!empty($key))&&(!empty($msg))&&(!empty($op))&&(!empty($uuid))){

    $conexao = mysql_connect('localhost','sgbdo','r3d301');
    if(!$conexao){
	echo '{"status":"erro","mensagem":"Problemas de conexão com o servidor. Faça contato com o administrador."}';
	mysql_close($conexao);
	exit();
    }
    $acessadb = mysql_select_db("sgbdo",$conexao);
    if(!$acessadb){
	echo '{"status":"erro","mensagem":"Problemas ao selecionar BD. Faça contato com o administrador."}';
	mysql_close($conexao);
	exit();
    }
    $verificaUsuario = mysql_query("select * from sms_usuariosapi where nomeusuario='$usuario' and chave='$key' and deleted is null",$conexao);
    $registros = mysql_num_rows($verificaUsuario);
    
    if($registros>0){
	$ip = obtemIP();
        $insereSMS = mysql_query("insert into sms_mensagens (nomeusuario, ddd, celular, operadora, mensagem, created,ip, smsregistrado_id, chip)  values ('$usuario','$ddd','$fone','$op','$msg',now(),'$ip', '$uuid',$chip) ",$conexao);
        $id = mysql_insert_id();
        $situacao = mysql_affected_rows();
        
        if($situacao==-1){
	    echo "{\"status\":\"erro\",\"mensagem\":\"Problemas ao registrar mensagem. Faça contato com o administrador.\"}";
	    mysql_close($conexao);
	    exit();
        }else{
	    echo "{\"status\":\"ok\",\"mensagem\":\"Mensagem agendada com sucesso. Identificador:$id.\",\"protocolo\":\"$id\"}";
	    mysql_close($conexao);
	    exit();
        }
    }else{
	echo "{\"status\":\"erro\",\"mensagem\":\"Usuário não cadastrado na API.\"}";
	mysql_close($conexao);
	exit();
    }

}else{

    echo "{\"status\":\"erro\",\"mensagem\":\"As informacoes user, ddd, celular, chave, mensagem, operadora devem ser válidas.\"}";

}

mysql_close($conexao);
exit();

?>