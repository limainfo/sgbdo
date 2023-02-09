			<div class="block">
			
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					
					<h2>Cadastrar Anexos </h2>
					
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<p class="breadcrumb"><a href="#">RN011</a> &raquo; <a href="#">Gerente</a> &raquo; <strong>Cadastrar Anexos</strong></p>
				
					<div class="message errormsg" id="erro" style="display:none;"><p>Houve um erro aqui!</p>
					</div>
					
					<div class="message success" id="sucesso" style="display:none;"><p>Os dados foram cadastrados com sucesso!</p></div>
					
					<div class="message info" id="informacao" style="display:none;"><p>Mensagem informativa</p></div>
					
					<div class="message warning" id="cuidado" style="display:none;"><p>Cuidado! Os campos não devem estar em branco.</p></div>
					
					
					<form accept-charset="utf-8" action="controller/habilitacaocontroller.cfm" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
<h3>Anexos:</h3>
<div class="cmf-skinned-select" style="width: 243px; height: 16px; background-color: rgb(237, 236, 235); color: rgb(0, 0, 0); font-size: 12px; font-family: &quot;Ubuntu&quot;; font-style: normal; position: relative;">
<div class="cmf-skinned-text" style="height: 20px; width: 213px; opacity: 100; overflow: hidden; position: absolute; text-indent: 0px; z-index: 1; top: 0px; left: 0px;">A</div>
<p><select class="styled" name="AnexosAnexo" id="AnexosAnexo"  style="opacity: 0; position: relative; z-index: 100;">
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
							<option value="F">F</option>
</select></p></div>				
						<p>
							<label>Documento:</label>
							<br />
							<input type="text" name="AnexosDocumento" id="AnexosDocumento" class="text medium" style="text-transform: uppercase;" /> 
						</p>
						
						<p>
						<label>Área avaliada :</label>
						<br />
							<input type="text" name="AnexosAreaavaliada" id="AnexosAreaavaliada"  class="text big"  style="text-transform: uppercase;"/>
						</p>
						
						<p>
						  <label>Dica área avaliada:</label><br />
							<textarea class="wysiwyg" name="AnexosDicaareaavaliada" id="AnexosDicaareaavaliada" ></textarea>
						</p>
						<p>
						  <label>Item avaliado:</label><br />
							<textarea class="wysiwyg" name="AnexosItemavaliado" id="AnexosItemavaliado" ></textarea>
						</p>
						<p>
						  <label>Dica para Ótimo:</label><br />
							<textarea class="wysiwyg" name="AnexosDicaotimo" id="AnexosDicaotimo" ></textarea>
						</p>
						<p>
						  <label>Dica para Bom:</label><br />
							<textarea class="wysiwyg" name="AnexosDicabom" id="AnexosDicabom" ></textarea>
						</p>
						<p>
						  <label>Dica para Regular:</label><br />
							<textarea class="wysiwyg" name="AnexosDicaregular" id="AnexosDicaregular" ></textarea>
						</p>
						<p>
						  <label>Dica para Não Satisfatório:</label><br />
							<textarea class="wysiwyg" name="AnexosDicanaosatisfatorio" id="AnexosDicanaosatisfatorio" ></textarea>
						</p>
						<hr />
						<input type="hidden" name="action" id="action" value="anexos" />
						<p>
							<input type="submit" class="submit small" id="AnexosCadastrar" value="Cadastrar" onClick="envia();"/>
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
      $("#anexoscadastrados").html(data);
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
<!-- Todas as operações Ajax básicas          -->
<div id="anexoscadastrados">
			
</div>
				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
					
			</div>		<!-- .block ends -->
