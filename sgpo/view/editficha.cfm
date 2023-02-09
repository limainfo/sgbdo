    <script src="js/jquery.form.js" type="text/javascript"></script>
<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" method="post" enctype="multipart/form-data"  action="controller/#controllernome#controller.cfm" >
			<p><h3>Estagiário:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.EstagiarioID" id="<cfoutput>#controllernomecampo#</cfoutput>EstagiarioID"   class="multiple required">
			<option value="<cfoutput>#conteudoconsulta.estagiarioID#</cfoutput>" selected="selected" ><cfoutput>#conteudoconsulta.unidade#-#conteudoconsulta.nomesetor#-#conteudoconsulta.nome#</cfoutput></option>
			</select>
			</p>
			<p><h3>Anexo existente:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Documento" id="<cfoutput>#controllernomecampo#</cfoutput>Documento"   class="styled required" readonly="readonly">
			<option value="<cfoutput>#conteudoconsulta.documento#</cfoutput>" selected="selected" ></option>
			</select>
			</p>
			<p><label>Documento Comprobatório na ausência de anexo:</label> <br />
			<cfif len(conteudoconsulta.documentocomprobatorio) gt 6 >
				<img src="documentos/<cfoutput>#left(conteudoconsulta.documentocomprobatorio,len(conteudoconsulta.documentocomprobatorio)-4)#</cfoutput>_page_1.jpg" title="Comprovante">
				<cfelse>
				<input type="file" name="<cfoutput>#controllernomecampo#</cfoutput>.Documentocomprobatorio" id="<cfoutput>#controllernomecampo#</cfoutput>Documentocomprobatorio" onchange="if(this.value != ''){$('#alternativo').show();}else{$('#alternativo').hide();}" value="" />
			</cfif>
				
				<span id="uploadmsg">Max size 3Mb</span>
			</p>
			<p><label>Tipo de Avaliação:</label> <br />
			<cfset tipoavaliacao='COMUM, FINAL' >
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Tipoavaliacao" id="<cfoutput>#controllernomecampo#</cfoutput>Tipoavaliacao"    class="styled">
			<option value="<cfoutput>#conteudoconsulta.tipoavaliacao#</cfoutput>" selected="selected"><cfoutput>#conteudoconsulta.tipoavaliacao#</cfoutput></option>
			</select>
			</p>
			<p><label>Data da Avaliação:</label><br /><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtavaliacao" id="<cfoutput>#controllernomecampo#</cfoutput>Dtavaliacao"   style="text-transform: uppercase;" readonly="readonly" value="<cfoutput>#dateformat(conteudoconsulta.dtavaliacao,'yyyy-mm-dd')#</cfoutput>">
			<input type="hidden" class="" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtavaliacaotemp" id="<cfoutput>#controllernomecampo#</cfoutput>Dtavaliacaotemp"   style="text-transform: uppercase;" value="<cfoutput>#dateformat(conteudoconsulta.dtavaliacao, 'yyyy-mm-dd')#</cfoutput>">			
			</p>
			<div id='alternativo'>
			<p><label>Tempo total em horas:</label><br><input type="text" value="<cfoutput>#conteudoconsulta.tempototal#</cfoutput>"  name="<cfoutput>#controllernomecampo#</cfoutput>.Tempototal" id="<cfoutput>#controllernomecampo#</cfoutput>Tempototal"  class="text small" />
			</p>
			</div>
			<p><label>Observações:</label><br><textarea  class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.obs" id="<cfoutput>#controllernomecampo#</cfoutput>obs"  ><cfoutput>#conteudoconsulta.obs#</cfoutput></textarea>
			</p>
			<div id='orientacao'><img src="images/loading.gif" height="20px">&nbsp;&nbsp;Processando os dados. Aguarde chegar em 100%.</div>

			<input type="hidden" name="action" id="action" value="cad" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />

			<hr>
				<div class="progress">
					<div class="bar" style="width: 100%;"></div>
					<div class="percent">0%</div>
				</div>				
				<div id="status"></div>				

			<p><input type="submit" class="submit small"  value="Cadastrar" />
			</p>

 		</form>
<style>
.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
#orientacao { background-color: #yellow; width:100%; height:20px; padding:3px; border-radius: 3px; vertical-align: text-top; text-align: center; font-weight: bolder; position:relative; display:inline-block; border-radius: 3px;}
</style> 		
<script>
$('#alternativo').hide();

(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');

      $("#orientacao").css({'display':'none'});
      $("#status").css({'display':'none'});
      $("#progress").css({'display':'none'});
      $(".bar").css({'display':'none'});
      $(".percent").css({'display':'none'});
   
$('form').ajaxForm({
    url:        'controller/fichacontroller.cfm', 
    type:        'POST', 
	beforeSend: function() {
		$('#orientacao').show();
		$('#status').show();
		$('#progress').show();
		$('.bar').show();
		$('.percent').show();
      status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
	complete: function(xhr) {
	  $("#listagem").html(xhr.responseText);
      $("#spinner").css({'display':'none'});
	}
}); 

})();       
</script>
			
</head>
<body>

 

 
<cfinclude template="../view/ajaxacao.cfm">
	
<script language="javascript">
	$('#FichasDtavaliacao').val($('#FichasDtavaliacaotemp').val());
	<cfif isdefined(conteudoconsulta.dtavaliacao) >
		$('#FichasDtavaliacao').datepicker({appendText: "yyyy-mm-dd", defaultDate: $("#FichasDtavaliacao").val() });
	</cfif>
</script>


	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->



