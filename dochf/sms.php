<?php include 'cabecalho.php'; ?>
<body> 
	<form class="jotform-form" action="http://10.112.24.24/webservice.php" method="get" name="form_32894453168666" id="32894453168666" accept-charset="utf-8">   
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
			<!--
			<li class="form-line" id="id_3">         
				<label class="form-label-left" id="label_3" for="input_3">Login<span class="form-required">*</span></label>
				<div id="cid_3" class="form-input">           
					<input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="input_3" name="q3_login" size="35" value="" />         
				</div>       
			</li>       
			<li class="form-line" id="id_4">         
				<label class="form-label-left" id="label_4" for="input_4">E-mail<span class="form-required">*</span></label>         
				<div id="cid_4" class="form-input">           
					<input type="text" class=" form-textbox validate[required]" data-type="input-textbox" id="input_4" name="q4_email" size="35" value="" />         
				</div>       
			</li>
			
			<li class="form-line" id="id_10">         
				<label class="form-label-left" id="label_10" for="input_10"> Lista </label>         
				<div id="cid_10" class="form-input">           
					<select class="form-dropdown" style="width:150px" id="input_10" name="q10_operadora">
						<option value=""></option>
					</select>         
				</div> 
				<a href="cadlista.php" style="float:right;" title="Cadastrar lista para o login atual"><image src="add.png" width="25px" heigth="25px"></a>
			</li>
			-->
			<li class="form-line" id="id_10">         
				<label class="form-label-left" id="label_10" for="input_10"> Lista de Telefones </label>         
				<div id="cid_10" class="form-input">           
					<select class="form-dropdown" style="width:150px" id="lista" name="lista">
						<option value="CLARO">CLARO</option>
						<option value="OI">OI</option>
						<option value="TIM">TIM</option>
						<option value="VIVO">VIVO</option>
					</select>         
				</div>       
			</li>       
			<li class="form-line" id="id_7">         
				<label class="form-label-left" id="label_7" for="input_7">Mensagem (160)<span class="form-required">*</span></label>         
				<div id="cid_7" class="form-input">           
					<textarea id="mensagem" class="form-textarea validate[required]" maxlength="160" name="mensagem" cols="38" rows="7"></textarea>         
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

