<?php include 'cabecalho.php'; ?>
<?php 
$mensagem = '';
$tipomensagem = 'OK';
//print_r($_POST);

if(isset($_POST['mensagem'])){
	$_POST['mensagem'] = $_POST['mensagem'].' '.$_COOKIE['login'];
	//$mensagem = preg_replace("[^a-zA-Z0-9_ .,-()]", "", strtr($_POST['mensagem'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ' \"\n'\r{}[]", "aaaaeeiooouucAAAAEEIOOOUUC _    ----"));
		$mensagem = preg_replace("[^a-zA-Z0-9_ ]", "", strtr($_POST['mensagem'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC"));
		$mensagem = str_replace("'", '-',  $mensagem);
		$mensagem = str_replace("\n", '',  $mensagem);
		$mensagem = str_replace("\r", '',  $mensagem);
		$mensagem = str_replace("\"", '',  $mensagem);
		$mensagem = str_replace("\"", '',  $mensagem);
		//echo $mensagem.'<br>';
	//$mensagem = urlencode($mensagem);
		//$nomelista = $_POST['lista'];
		$listas = $_POST['lista'];
		
	if(strlen($_COOKIE['login'])>3 && count($listas)>0 && strlen($mensagem)>8){
		$IP = $_SERVER['REMOTE_ADDR'];
		
		$pedacos = ceil(strlen($mensagem)/150);
		
		//echo 'Pedacos:'.$pedacos.'<br>';
		
		foreach($listas as $lista){
		
		for($inicio=0;$inicio<$pedacos;$inicio++){
		$start = $inicio * 150;
		$mensagem = preg_replace("[^a-zA-Z0-9_ ]", "", strtr($_POST['mensagem'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC"));
		$mensagem = str_replace("'", '-',  $mensagem);
		$mensagem = str_replace("\n", '',  $mensagem);
		$mensagem = str_replace("\r", '',  $mensagem);
		$mensagem = str_replace("\"", '',  $mensagem);
		$mensagem = str_replace("\"", '',  $mensagem);
		
		$mensagemquebrada = substr($mensagem, $start,150);
		//echo $mensagemquebrada.'<br>'.$start;
		$intervalo = $inicio + 1;
		$mensagemquebrada .= ' msg:'.($intervalo).'-'.$pedacos;
		$uuid = md5(uniqid(''));
		$insere = "insert into sms_registrados (id, nome_lista, login_responsavel, dt_registro, ip_registro, mensagem, chip) values ('$uuid','{$lista}',  '{$_COOKIE['login']}', now(), '$IP','{$mensagemquebrada}',{$_POST['chip']});";
		//print_r($listas);
		//echo $insere.'<br>';
		//exit();
		if(mysql_query($insere)){
				//$buscalistagem = "select * from sms_listas where login_responsavel='{$_COOKIE['login']}' and nome_lista='$nomelista' ";
				$buscalistagem = "select * from sms_listas where nome_lista='$lista' ";
				$resultadobusca = mysql_query($buscalistagem);
				$protocolos .= '';
				$rastreamento .= '';
				while($dado=mysql_fetch_array($resultadobusca)){
					$celular = $dado['telefone'];
					$chip = $_POST['chip'];
					$ddd = $dado['ddd'];
					$operadora = $dado['operadora'];
					$mensagemsms = urlencode($mensagemquebrada);
					$urlsms = "http://10.112.24.24/webservice.php?user=sgbdo&chave=c7943a8c-423d-11e3-8c1c-0019b9d3ed2b&ddd=$ddd&operadora=$operadora&celular=$celular&mensagem=$mensagemsms&id=$uuid&chip=$chip";
					//echo $urlsms.'<br>';
					 try {
					 	$contentsmet = file_get_contents($urlsms);
					 	$vetor=json_decode($contentsmet,true);
						$atualiza = "update sms_registrados set protocolos='{$vetor['protocolo']}' where id='$uuid' ";
						$protocolos .= $dado['nome_pessoa'].'->('.$dado['ddd'].') '.$dado['telefone'].' - '.$dado['operadora'].' '.$vetor['mensagem']."\n<br>";
						$rastreamento .= $vetor['protocolo'].',';
					} catch (Exception $e) {
						$protocolos .= '<u>Problema=><'.$dado['nome_pessoa'].'->('.$dado['ddd'].') '.$dado['telefone'].' - '.$dado['operadora'].' '."></u>\n";
					
					}
				}
				$atualiza = "update sms_registrados set protocolos='{$rastreamento}' where id='$uuid' ";
				mysql_query($atualiza);
				$mensagem .= "Informação incluída com sucesso!\n<br>".$protocolos;
			}else{
				$mensagem .= "Problemas ao incluir a informação!";
				$tipomensagem = 'ERRO';
			}
		
		}
		}
	
	}else{
			$mensagem .= "Informação incompleta!";
			$tipomensagem = 'ERRO';
	}

}

?>
<body> 
<div id="mensagens" 
<?php 
	if($tipomensagem=='ERRO'){echo ' class="erro" ';}
	if($tipomensagem=='OK'){echo ' class="sucesso" ';}
	if(strlen($mensagem)<2){echo ' style="display:none;" ';}
	
?>
>
<?php echo $mensagem; ?>
</div>
	<script>setTimeout(function() {HideContent('mensagens');}, 9000);</script>

	<form class="jotform-form" action="sms.php" method="post" name="form_32894453168666" id="32894453168666" accept-charset="utf-8">   
	<input type="hidden" name="user" value="evaldoesl" />   
	<input type="hidden" name="chave" value="6842f4145d52571512c593ddaf4f1f6e" />
	<div class="form-all">     
		<ul class="form-section">       
			<li class="form-line" id="id_1">         
			<div id="cid_1" class="form-input-wide">           
				<div id="text_1" class="form-html">             
					<div id="form_header">
					ENVIO DE SMS&nbsp;&nbsp;&nbsp;<a href="cadlista.php" title="Cadastra Lista"><image src="iadd.png" width="25px" heigth="25px"></a>&nbsp;&nbsp;<a href="list.php"  title="Lista telefones"><image src="ilist.png" width="25px" heigth="25px"></a>             
					</div>           
				</div>         
			</div>       
			</li>  
			<li class="form-line" id="id_10">         
				<label class="form-label-left" id="label_10" for="input_10"> Lista de Telefones </label>         
				<div id="cid_10" class="form-input">           
					<select class="form-dropdown" style="width:210px" id="lista" name="lista[]" multiple>
<?php 

//$listas = "select * from sms_listas where login_responsavel='{$_COOKIE['login']}' group by nome_lista order by nome_lista asc ";
$listas = "select * from sms_listas  group by nome_lista order by nome_lista asc ";
$dados =  mysql_query($listas);
$quantidade = mysql_num_rows($dados);


$i=0;
 while($dado=mysql_fetch_array($dados)){

?>
						<option value="<?php echo $dado['nome_lista']; ?>"><?php echo $dado['nome_lista']; ?></option>
<?php 
 }
?>					
					</select>         
				</div>       
			</li>       
			<li class="form-line" id="id_7">         
				<label class="form-label-left" id="label_7" for="input_7">Mensagem<span class="form-required">*</span></label>         
				<div id="cid_7" class="form-input">           
					<textarea id="mensagem" class="form-textarea validate[required]" name="mensagem" cols="38" rows="7"></textarea>         
				</div>       
			</li>       
			<li class="form-line" id="id_11">         
				<label class="form-label-left" id="label_10" for="input_11"> Chip</label>         
				<div id="cid_11" class="form-input">           
					<select class="form-dropdown" style="width:210px" id="chip" name="chip">
						<option value="0">Ambos</option>
						<option value="1" selected="selected">Chip01</option>
						<option value="2">Chip02</option>
					</select>         
				</div>       
			</li>       
			<li class="form-line" id="id_2">         
				<div id="cid_2" class="form-input-wide">           
					<div style="margin-left:156px" class="form-buttons-wrapper">             
						<button id="input_2" type="submit" class="form-submit-button form-submit-button-book_blue2">Enviar</button>           
					</div>         
				</div>       
			</li>       
			<li class="form-line" id="id_8">         
				<div id="cid_8" class="form-input-wide">           
					<div id="text_8" class="form-html">             
						<div id="form_footer">             
						</div>           
					</div>         
				</div>       
			</li>       
			<li class="form-line" id="id_9">         
				<div id="cid_9" class="form-input-wide">           
					<div id="text_9" class="form-html">             
						<div id="form_footerwrap">             
						</div>           
					</div>         
				</div>       
			</li>       
			<li style="display:none">Should be Empty:         
				<input type="text" name="website" value="" />       
			</li>     
		</ul>   
	</div>   
	</form>

</body>
</html> 

