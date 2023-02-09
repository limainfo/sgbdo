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

if($existearquivo =  file_get_contents("./travanotam")){
    
}

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

//$sql = "select * from localidades where uf in ( 'AC', 'AM', 'AP', 'MA', 'PA', 'RO', 'RR', 'TO' ) order by localidadeID asc";
$sql = "select * from localidades  order by localidadeID asc";
$localidades = mysql_query($sql);
        while($loc=mysql_fetch_array($localidades, MYSQL_BOTH)){
        	$atualizado = date('Y-m-d H:i:s');
		$sqllimpa = 'delete from notam  where loc="'.$loc['localidadeID'].'" ';
		$limpeza = mysql_query($sqllimpa);
		$url = "http://www.aisweb.$dominio/api/?apiKey=1371723365&apiPass=e1b5c368-34d1-1031-95e7-72567f175e3a&area=notam&localidade=".$loc['localidadeID'];
		try {
			$contents = file_get_contents($url);
			$xml = new SimpleXMLElement($contents);
			for($i=0;$i<$xml->notam['total'];$i++){
				$insercao ="insert ignore into notam (notamid, updatedat, itemid, cod, dt, n, loc, b, c, e, d, nof, s, geo, aero, cidade, uf, atualizado) values ('{$xml->notam['id']}', '{$xml->notam['updatedat']}', {$xml->notam->item[$i]['id']}, '{$xml->notam->item[$i]->cod}','{$xml->notam->item[$i]->dt}', '{$xml->notam->item[$i]->n}', '{$xml->notam->item[$i]->loc}', '{$xml->notam->item[$i]->b}','{$xml->notam->item[$i]->c}', '{$xml->notam->item[$i]->e}', '{$xml->notam->item[$i]->d}', '{$xml->notam->item[$i]->nof}', '{$xml->notam->item[$i]->s}','{$xml->notam->item[$i]->geo}', '{$xml->notam->item[$i]->aero}', '{$xml->notam->item[$i]->cidade}', '{$xml->notam->item[$i]->uf}',  '{$atualizado}' ) ";
				$insere = mysql_query($insercao);
			}
			
		} catch (Exception $e) {
			
		}
    	}
    
 echo '<br>Fim:'.date('Y-m-d h:i:s');
 
?>
