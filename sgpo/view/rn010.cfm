			<div class="block">
			
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					
					<h2>Cadastro de Pessoal</h2>
					
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<p class="breadcrumb"><a href="#">Página pai</a> &raquo; <a href="#">Sub página</a> &raquo; <strong>Página do Formulário</strong> (breadcrumb)</p>
				
					<div class="message errormsg" id="erro" style="display:none;"><p>Houve um erro aqui!</p></div>
					
					<div class="message success" id="sucesso" style="display:none;"><p>Os dados foram cadastrados com sucesso!</p></div>
					
					<div class="message info" id="informacao" style="display:none;"><p>Mensagem informativa</p></div>
					
					<div class="message warning" id="cuidado" style="display:none;"><p>Cuidado! Os campos não devem estar em branco.</p></div>
					
					
					<form accept-charset="utf-8" action="controller/habilitacaocontroller.cfm" method="post" enctype="multipart/form-data" id="habilitacoesform" onsubmit="return false;">
						<p>
							<label>Nome Usuário:</label><br />
							<input type="text" name="data[Usuario][nome]" id="HabilitacaoNome" class="text small" style="text-transform: uppercase;" /> 
							<span class="note">*Preencha em maiúsculas</span>
						</p>
						
						<p>
							<label>Localidade:</label><br />
							<input type="text" name="data[Usuario][localidade]" id="HabilitacaoLocalidade" class="text medium error" style="text-transform: uppercase;" /> 
							<span class="note error">Localidade incorreta!</span>
						</p>
						
						<p>
							<label>Jurisdição:</label><br />
							<input type="text" name="data[Usuario][jurisdicao]" id="HabilitacaoJurisdicao"  class="text big"  style="text-transform: uppercase;"/>
						</p>
						
						<p>
							<label>Observações:</label><br />
							<textarea class="wysiwyg" name="data[Usuario][obs]" id="HabilitacaoObs" ></textarea>
						</p>
							background: url(../images/sidebar.gif) 0 0 repeat-y;

						<p>
							<label>Inicio do Estágio:</label> 
							<input type="text" name="data[Usuario][inicioestagio]" id="HabilitacaoInicioestagio"  class="text date_picker" />
							&nbsp;&nbsp;
							<label>Término do Estágio:</label> 
							<input type="text" name="data[Usuario][terminoestagio]" id="HabilitacaoTerminoestagio"  class="text date_picker" />
						</p>
						
						
						<p><label>Tipo de Contrato:</label> <br />
<cfquery datasource="lpna" name="consulta" >
	select * from sgpo_tiposcontratos
</cfquery>						
							<select class="styled">
								<optgroup label="Group 1">
								<cfloop query="consulta">
									<cfoutput>
									<option value="#nome#">#nome#-#descricao#</option>
									</cfoutput>
								</cfloop>
								</optgroup>
							</select></p>
						
												
						<p class="fileupload">
							<label>File input label:</label><br />
							<input type="file" id="fileupload" />
							<span id="uploadmsg">Max size 3Mb</span>
						</p>
																		
						<p>
							<input type="checkbox" class="checkbox" checked="checked" id="cbdemo1" /> <label for="cbdemo1">Checkbox label</label> 
							<input type="checkbox" class="checkbox" id="cbdemo2" /> <label for="cbdemo2">Checkbox label</label>
						</p>
						
						<p><input type="radio" checked="checked" class="radio" /> <label>Radio button label</label></p>
												
						<hr />
						
						<p>
							<input type="submit" class="submit small" id="envioajax" value="Submit" onclick="envia();"/>
							<!--
							<input type="submit" class="submit mid" value="Long submit" />
							<input type="submit" class="submit long" value="Even longer submit" />
							-->
						</p>
					</form>

<script type="text/javascript">
//&lt;![CDATA[

function envia() {
  var dados = $("#habilitacoesform").serialize();
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/habilitacaocontroller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#cadastrados").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }



//]]&gt;
</script>
<!-- Todas as operações Ajax básicas -->
<div id="cadastrados">
			
</div>
				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
					
			</div>		<!-- .block ends -->
