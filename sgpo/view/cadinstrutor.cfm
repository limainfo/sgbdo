			<div class="block">
			
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					
					<h2>Cadastrar Instrutores </h2>
					
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<p class="breadcrumb"><a href="#">RN012</a> &raquo; <a href="#">Gerente</a> &raquo; <strong>Cadastrar Instrutores </strong><a href="?i=Instrução&acao=list" style="float:right;"><img src="images/voltar.png"></a></p>
				
					<form accept-charset="utf-8" action="controller/habilitacaocontroller.cfm" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
						
						<p>
						<h3>Aeronavegante:</h3>
						<select name="Setores.Unidade" id="Setores.Unidade"  class="styled required" >
						<cfoutput><option value="SO BCT JOTA">SO BCT JOTA LUIS</option></cfoutput>
						</select>		
						</p>
						<p><label>Função:</label> <br />
						<cfquery datasource="lpna" name="consulta" >
							select * from habilitacoes_select
						</cfquery>						
							<select  class="styled">
								<optgroup label="Group 1">
									<cfoutput  query="consulta">
									<option value="#habID#">#habilitacao#</option>
									</cfoutput>
									<option value="ACC VGL" selected="selected">ACC VGL</option>
								</optgroup>
							</select></p>
						<input type="hidden" name="action" id="action" value="add" />
						<input type="hidden" name="controller" id="controller" value="estagiarios" />
						
						<p>
						<label>Comentários:</label>
						<br />
							<textarea class="wysiwyg" name="Setores.Descricao" id="Setores.Descricao" ></textarea>
						</p>
						
						<hr />
						<input type="hidden" name="action" id="action" value="add" />
						<input type="hidden" name="controller" id="controller" value="setores" />
						<input type="hidden" name="pagina" id="pagina" value="<cfoutput>#url.pagina#</cfoutput>" />
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
