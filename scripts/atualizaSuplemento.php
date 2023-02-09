<?php
ini_set('display_errors', 1);
ini_set('error_reporting', 1);
error_reporting (E_ALL);

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

echo 'Início:'.date('Y-m-d h:i:s').'<br>';

//$sql = "select * from localidades where localidadeId='SBMN' order by localidadeID asc";
$sql = "select * from localidades  order by localidadeID asc";
$localidades = mysql_query($sql);
        while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
        	$atualizado = date('Y-m-d H:i:s');
		$sqllimpa = 'delete from suplementoais  where localidadeID="'.$loc['localidadeID'].'" ';
		$limpeza = mysql_query($sqllimpa);

		$urlsup = "http://www.aisweb.$dominio/api/suplementos.cfm?apiKey=1371723365&apiPass=e1b5c368-34d1-1031-95e7-72567f175e3a&area=suplementos&localidade=".$loc['localidadeID'];
		echo $urlsup.'<br>';
		try {
			$contentssuplemento = file_get_contents($urlsup);
			$xml = new SimpleXMLElement($contentssuplemento);
			for($i=0;$i<(count($xml->suplementos->item));$i++){
				$insercao ="insert ignore into suplementoais (n, serie, local, dt, titulo, texto, duracao, anexo, localidadeID, atualizado) values ('{$xml->suplementos->item[$i]->n}', '{$xml->suplementos->item[$i]->serie}', '{$xml->suplementos->item[$i]->local}', '{$xml->suplementos->item[$i]->dt}','{$xml->suplementos->item[$i]->titulo}',	'{$xml->suplementos->item[$i]->texto}', '{$xml->suplementos->item[$i]->duracao}', '{$xml->suplementos->item[$i]->anexo}',  '{$loc['localidadeID']}',  '{$atualizado}') ";
				//echo $insercao.'<br>';
				$insere = mysql_query($insercao);
			}
			
		} catch (Exception $e) {
			
		}
    	}
    
 echo '<br>Fim:'.date('Y-m-d h:i:s');
 
?>
