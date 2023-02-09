<?php include 'cabecalho.php'; ?>
<?php 
//print_r($_POST);
$mensagem = '';
$tipomensagem = 'OK';

if(isset($_POST['nomelista'])){
		
	$telefone = preg_replace('/(\digit+)/i', '', $_POST['telefone']);
	$telefone = str_replace('-', '', $telefone);
	$telefone = str_replace('/', '', $telefone);
	$telefone = str_replace(' ', '', $telefone);
	//echo "\nTelefone:$telefone\n";
	$ddd = $_POST['ddd'];
	$operadora = $_POST['operadora'];
	$nomelista = $_POST['nomelista'];
	
	if(!empty($_COOKIE) &&!empty($telefone) &&!empty($ddd) &&!empty($operadora) &&!empty($nomelista) && strlen($telefone)>=8){
		$IP = $_SERVER['REMOTE_ADDR'];
		$tel = $ddd.$telefone;
		$insere = "insert into sms_listas (id, nome_lista, nome_pessoa, telefone, operadora, ddd, login_responsavel, dt_registro, ip_registro) values (uuid(),'{$_POST['nomelista']}', '{$_POST['nomepessoa']}', '{$_POST['telefone']}', '{$_POST['operadora']}', '{$_POST['ddd']}', '{$_COOKIE['login']}', now(), '$IP');";
		if(mysql_query($insere)){
			$mensagem = "Informação incluída com sucesso!";
		}else{
			$mensagem = "Problemas ao incluir a informação!";
			$tipomensagem = 'ERRO';
		}
	
	}else{
			$mensagem = "Informação incompleta!";
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
	
?>>
</div>
<?php echo $mensagem; ?>
</div>
		
	<script>setTimeout(function() {HideContent('mensagens');}, 9000);</script>

	<form class="jotform-form" action="cadlista.php" method="post" name="form_32894453168666" id="32894453168666" accept-charset="utf-8">   
	<input type="hidden" name="formID" value="32894453168666" />   
	<div class="form-all">     
		<ul class="form-section">       
			<li class="form-line" id="id_1">         
			<div id="cid_1" class="form-input-wide">           
				<div id="text_1" class="form-html">             
					<div id="form_header">
					CADASTRA LISTA&nbsp;&nbsp;&nbsp;<a href="sms.php" title="SMS"><image src="isms.png" width="25px" heigth="25px"></a>&nbsp;&nbsp;<a href="list.php"  title="Lista telefones"><image src="ilist.png" width="25px" heigth="25px"></a>
             
					</div>           
				</div>         
			</div>       
			</li>       
			<li class="form-line" id="id_3">         
				<label class="form-label-left" id="label_3" for="input_3">Nome da Lista<span class="form-required">*</span></label>
				<div id="cid_3" class="form-input">           
					<input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="nomelista" name="nomelista" size="35" value="" />         
				</div>       
			</li>       
			<li class="form-line" id="id_5">         
				<label class="form-label-left" id="label_5" for="input_5">Nome Pessoa<span class="form-required">*</span></label>         
				<div id="cid_5" class="form-input">           
					<input type="text" class=" form-textbox validate[required]" maxlength="120"  data-type="input-textbox" id="nomepessoa" name="nomepessoa" size="35" value="" />         
				</div>       
			</li>       
			<li class="form-line" id="id_5">         
				<label class="form-label-left" id="label_5" for="input_5">Telefone<span class="form-required">*</span></label>         
				<div id="cid_5" class="form-input">           
					<input type="text" class=" form-textbox validate[required]" maxlength="12"  data-type="input-textbox" id="telefone" name="telefone" size="35" value="" />         
				</div>       
			</li>       
			<li class="form-line" id="id_10">         
				<label class="form-label-left" id="label_10" for="input_10"> Operadora </label>         
				<div id="cid_10" class="form-input">           
					<select class="form-dropdown" style="width:150px" id="operadora" name="operadora">
						<option value="CLARO">CLARO</option>
						<option value="OI">OI</option>
						<option value="TIM">TIM</option>
						<option value="VIVO">VIVO</option>
					</select>         
				</div>       
			</li>       
			<li class="form-line" id="id_11">         
				<label class="form-label-left" id="label_11" for="input_11">DDD<span class="form-required">*</label>         
				<div id="cid_11" class="form-input">           
					<input type="text"  class=" form-textbox validate[required]" data-type="input-textbox" maxlength="3"  minlength="3"  id="ddd" name="ddd" size="20" value="092" />         
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

