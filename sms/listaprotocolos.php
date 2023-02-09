<?php include 'cabecalho.php'; ?>
<link href="table.css" rel="stylesheet" type="text/css" />
<center>

<?php 

	$i = 0;
	if(isset($_GET['d'])){
		//$lista = "select * from sms_registrados inner join sms_listas on (sms_listas.id='{$_GET['d']}' and sms_registrados.login_responsavel=sms_listas.login_responsavel and sms_listas.nome_lista=sms_registrados.nome_lista) ";
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
//and sms_registrados.login_responsavel=sms_listas.login_responsavel		
		$lista = "select group_concat(distinct protocolos separator '') as protocolo,sms_listas.*, sms_registrados.* from sms_registrados inner join sms_listas on (sms_listas.id='{$_GET['d']}'  and sms_listas.nome_lista=sms_registrados.nome_lista) group by sms_listas.id;   ";
		
		//echo $lista;
		$mensagem = '';
		$registros=mysql_query($lista);
		//$registrosvetores = mysql_fetch_array($registros);
		//print_r($registrosvetores);
		$telefone = '';
		//$mensagem .= '<table><caption>Detalhes para o celular</caption><thead><tr><th scope="col">ID</th><th scope="col">MENSAGEM</th><th scope="col">CRIADO</th><th scope="col">ENVIADO</th><th scope="col">ENVIADOSMS</th><th scope="col">IP</th><th scope="col">LOGIN</th></tr></thead><tbody>';
		while($registrosvetores = mysql_fetch_array($registros)){
			//$registrosvetores = mysql_fetch_array($registros);
			$protocolos = split(',', substr($registrosvetores['protocolo'], 0, -1));
			rsort($protocolos);
			
			$asterisk = '10.112.24.24';
			$dbasterisk = 'sgbdo';
			$usuarioasterisk = 'root';
			$senhaasterisk = 'r3d301';
			
			//print_r($registrosvetores);
			//$mensagem .= print_r($registrosvetores,true);
			
			
			//$mensagem .= print_r($protocolos, true);

			
			$conexaoasterisk = mysql_connect($asterisk, $usuarioasterisk, $senhaasterisk);
			if (!$conexaoasterisk) {
				$mensagem .= 'Não foi possível conectar: ' . mysql_error();
			}
			
			mysql_select_db($dbasterisk, $conexaoasterisk);
			
			//print_r($protocolos);
			foreach($protocolos as $chave=>$valor){
				$sqldetalhe = "select * from sms_mensagens where identificador=$valor ";
				//echo $sqldetalhe;
				$consultadetalhe = mysql_query($sqldetalhe, $conexaoasterisk);
				$detalhes=mysql_fetch_array($consultadetalhe);
				//print_r($detalhes);
				if($detalhes['celular']==$registrosvetores['telefone']){
					$telefone = $registrosvetores['telefone'];
				   $zebrado = '';
				   if($i%2){
					$zebrado = ' class="odd" ';   
				   }
				   if(strlen($detalhes['enviado'])<2){
				   	$zebrado = ' class="erro" ';
				   }
				   $i++;
					$mensagem .= '<tr '.$zebrado.'><td>'.$detalhes['identificador'].'</td><td>'.$detalhes['mensagem'].'</td><td>'.$detalhes['created'].'</td><td>'.$detalhes['enviado'].'</td><td>'.$detalhes['enviadosms'].'</td><td>'.$detalhes['ip'].'</td><td>'.$registrosvetores['login_responsavel'].'</td></tr>';
				}
			}
			
		}
			
		echo '<table><caption>Detalhes para o celular '.$telefone.'</caption><thead><tr><th scope="col">PROTOCOLO</th><th scope="col">MENSAGEM</th><th scope="col">CRIADO</th><th scope="col">ENVIADO</th><th scope="col">ENVIADOSMS</th><th scope="col">IP</th><th scope="col">LOGIN</th></tr></thead><tbody>';
		echo $mensagem;
		//echo "<script>setTimeout(function() {HideContent('idlist');}, 9000);</script>";
	}
	
	
	

?>
<tfoot><tr><th scope="row">Total</th><td colspan="8"><?php echo $i; ?> registros</td></tr></tfoot>



</tbody></table><br><br><br>
