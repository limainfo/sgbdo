<?php include 'cabecalho.php'; ?>
<link href="table.css" rel="stylesheet" type="text/css" />
<center>
<table summary="Submitted table designs"><caption>Lista de telefones cadastrados&nbsp;&nbsp;&nbsp;&nbsp;<a href="cadlista.php" title="Cadastrar"><image src="iadd.png" width="25px" heigth="25px"></a>&nbsp;&nbsp;&nbsp;<a href="sms.php" title="SMS"><image src="isms.png" width="25px" heigth="25px"></a></caption>
<thead>
<tr><th scope="col">LISTA</th><th scope="col">OPERADORA</th><th scope="col">DDD</th><th scope="col">TELEFONE</th><th scope="col">DESTINO</th><th scope="col" colspan="3">Ações</th></tr></thead>
<tbody>

<?php 

	
	if(isset($_GET['x'])){
		$IP = $_SERVER['REMOTE_ADDR'];
		$insere = "update sms_listas set login_responsavel='{$_COOKIE['login']}', dt_exclusao=now(), ip_exclusao='$IP' where id='{$_GET['x']}';";
		if(mysql_query($insere)){
		  echo '<div id="idlist" class="sucesso">Registro excluído com sucesso!</div>';
		}else{
			echo '<div id="idlist" class="erro">Problemas para excluir o registro!</div>';
		}
		/*		
		$exclusao = "delete from sms_listas where id='{$_GET['x']}' ";
		if(mysql_query($exclusao)){
		  echo '<div id="idlist" class="sucesso">Registro excluído com sucesso!</div>';
		}else{
		  echo '<div id="idlist" class="erro">Problemas para excluir o registro!</div>';
		}
		*/
		echo "<script>setTimeout(function() {HideContent('idlist');}, 9000);</script>";
	}
	
	if(isset($_GET['d'])){
		//$lista = "select * from sms_registrados inner join sms_listas on (sms_listas.id='{$_GET['d']}' and sms_registrados.login_responsavel=sms_listas.login_responsavel and sms_listas.nome_lista=sms_registrados.nome_lista) ";
		$lista = "select * from sms_registrados inner join sms_listas on (sms_listas.id='{$_GET['d']}' and sms_registrados.login_responsavel=sms_listas.login_responsavel and sms_listas.nome_lista=sms_registrados.nome_lista) ";
		//echo $lista;
		$mensagem = '';
		if($registros=mysql_query($lista)){
			$registrosvetores = mysql_fetch_array($registros);
			$protocolos = split(',', substr($registrosvetores['protocolos'], 0, -1));
			
			$mensagem .= '<table><caption>Detalhes para o celular: ('.$registrosvetores['ddd'].')'.$registrosvetores['telefone'].'</caption><thead><tr><th scope="col">ID</th><th scope="col">MENSAGEM</th><th scope="col">CRIADO</th><th scope="col">ENVIADO</th><th scope="col">ENVIADOSMS</th><th scope="col">IP</th></tr></thead><tbody>';
			
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
			
			foreach($protocolos as $chave=>$valor){
				   $zebrado = '';
				   if($i%2){
					$zebrado = ' class="odd" ';   
				   }
				   $i++;
				$sqldetalhe = "select * from sms_mensagens where identificador=$valor ";
				$consultadetalhe = mysql_query($sqldetalhe, $conexaoasterisk);
				$detalhes=mysql_fetch_array($consultadetalhe);
				print_r($detalhes);
				if($detalhes['celular']==$registrosvetores['telefone']){
				$mensagem .= '<tr '.$zebrado.'><td>'.$detalhes['celular'].'</td><td>'.$detalhes['mensagem'].'</td><td>'.$detalhes['created'].'</td><td>'.$detalhes['enviado'].'</td><td>'.$detalhes['enviadosms'].'</td><td>'.$detalhes['ip'].'</td></tr>';
				}
			}
			
		}
			
		echo '<div id="idlist" class="sucesso">'.$mensagem.'</div>';
		//echo "<script>setTimeout(function() {HideContent('idlist');}, 9000);</script>";
	}
	
	
	
	//$listas = "select * from sms_listas where login_responsavel='{$_COOKIE['login']}' order by nome_lista asc, nome_pessoa asc ";
	$listas = "select * from sms_listas where dt_exclusao is null order by nome_lista asc, nome_pessoa asc ";
	$dados =  mysql_query($listas,$conexao);
	$quantidade = mysql_num_rows($dados);
	

?>
<tfoot><tr><th scope="row">Total</th><td colspan="7"><?php echo $quantidade; ?> registros</td></tr></tfoot>

<?php 

$i=0;
 while($dado=mysql_fetch_array($dados)){
   $zebrado = '';
   if($i%2){
   	$zebrado = ' class="odd" ';   
   }
   $i++;

?>
<!---  
<tr <?php echo $zebrado; ?>><th id="<?php echo $dado['id']; ?>" scope="row"><?php echo $dado['nome_lista']; ?></th><td><?php echo $dado['operadora']; ?></td><td><?php echo $dado['ddd']; ?></td><td><?php echo $dado['telefone']; ?></td><td><?php echo $dado['nome_pessoa']; ?></td><td><?php if($_COOKIE['login']==$dado['login_responsavel']){ ?><a href="list.php?x=<?php echo $dado['id']; ?>" title="Excluir"><image src="idelete.png" width="25px" heigth="25px"></a>&nbsp;&nbsp;<a href="editlista.php?d=<?php echo $dado['id']; ?>" title="Modificar"><image src="iedit.png" width="25px" heigth="25px"></a><?php } ?></td></tr>
-->
<tr <?php echo $zebrado; ?>><th id="<?php echo $dado['id']; ?>" scope="row"><?php echo $dado['nome_lista']; ?></th><td><?php echo $dado['operadora']; ?></td><td><?php echo $dado['ddd']; ?></td><td><?php echo $dado['telefone']; ?></td><td><?php echo $dado['nome_pessoa']; ?></td><td><?php if(!empty($_COOKIE['login'])){ ?><a href="list.php?x=<?php echo $dado['id']; ?>" title="Excluir"><image src="idelete.png" width="25px" heigth="25px"></a></td><td><a href="editlista.php?d=<?php echo $dado['id']; ?>" title="Modificar"><image src="iedit.png" width="25px" heigth="25px"></a><td><a target="_blank" href="listaprotocolos.php?d=<?php echo $dado['id']; ?>" title="Histórico de Mensagens"><image src="idetalhes.png" width="25px" heigth="25px"></a><?php } ?></td></tr>

<!--
&nbsp;&nbsp;<a href="list.php?d=<?php echo $dado['id']; ?>" title="Detalhes"><image src="idetalhes.png" width="25px" heigth="25px"></a>
-->
<?php
 }

?>


</tbody></table><br><br><br>
