    <script src="js/jquery.form.js" type="text/javascript"></script>
<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" method="post" enctype="multipart/form-data"  action="controller/<cfoutput>#controllernome#</cfoutput>controller.cfm" >
			<cfquery datasource="lpna" name="estagiarios">
				select se.*, ur.jurisdicao as regional, ds.*,
				u.nome as unidade, ss.nome as nomesetor from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)

				inner join sgpo_dadossistemas ds on (ds.dadossistemaID=se.dadossistemaID)
				where se.deleted is null and se.fimestagio is null and se.ata is null order by jurisdicao asc, se.nome asc;
			</cfquery>
			<p><h3>Estagiário: (Para selecionar vários estagiários, mantenha pressionada a tecla [CTRL] enquanto clica.)</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.EstagiarioID" multiple="multiple" rows"10" id="<cfoutput>#controllernomecampo#</cfoutput>EstagiarioID"   class="multiple required">
			<cfoutput query="estagiarios">
			<option value="#estagiarioID#"  >#unidade#-#nomesetor#-#nome# .......................#dateformat(#inicioestagio#,'dd-mm-yyyy')#</option>
			</cfoutput>
			</select>
			</p>
			<p><h3>Anexo existente:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Documento" id="<cfoutput>#controllernomecampo#</cfoutput>Documento"   class="styled required">
			<cfquery datasource="lpna" name="estagiarios">
				select concat(documento,' - anexo ', anexo) as documento from sgpo_anexos sa
				where sa.deleted is null  group by sa.documento, sa.anexo order by documento;
			</cfquery>
			<cfoutput query="estagiarios">
			<option value="#documento#"  >#documento#</option>
			</cfoutput>
			<option value="" selected="selected" ></option>
			</select>
			</p>
			<p><label>Documento Comprobatório na ausência de anexo:</label> <br />
				<input type="file" name="<cfoutput>#controllernomecampo#</cfoutput>.Documentocomprobatorio" id="<cfoutput>#controllernomecampo#</cfoutput>Documentocomprobatorio" onchange="if(this.value != ''){$('#alternativo').show();}else{$('#alternativo').hide();}" value="" />
				
				<span id="uploadmsg">Max size 3Mb</span>
			</p>
			<p><label>Tipo de Avaliação:</label> <br />
			<cfset tipoavaliacao='COMUM,FINAL' >
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Tipoavaliacao" id="<cfoutput>#controllernomecampo#</cfoutput>Tipoavaliacao"    class="styled">
			<cfloop  list="#tipoavaliacao#" index="nome">
			<option value="<cfoutput>#nome#</cfoutput>"><cfoutput>#nome#</cfoutput></option>
			</cfloop></select>
			</p>
			<p><label>Data da Avaliação:</label><br /><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtavaliacao" id="<cfoutput>#controllernomecampo#</cfoutput>Dtavaliacao"   style="text-transform: uppercase;" readonly="readonly" value="">
			</p>
						
			<div id='alternativo'>
			<p><label>Tempo total em horas:</label><br><input type="text" value="0"  name="<cfoutput>#controllernomecampo#</cfoutput>.Tempototal" id="<cfoutput>#controllernomecampo#</cfoutput>Tempototal"  class="text small" />
			</p>
			</div>
			<p><label>Observações:</label><br><textarea  class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.obs" id="<cfoutput>#controllernomecampo#</cfoutput>obs"   value=""></textarea>
			</p>
			<div id='orientacao'><img src="images/loading.gif" height="20px">&nbsp;&nbsp;Processando os dados. Aguarde chegar em 100%.</div>

			<input type="hidden" name="action" id="action" value="cad" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
			
			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>

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
$('#erro').hide();
$('.mensagensform').hide();

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
		if($('#<cfoutput>#controllernomecampo#</cfoutput>Documentocomprobatorio').val().length>0){
			$('#orientacao').show();
			$('#status').show();
			$('#progress').show();
			$('.bar').show();
			$('.percent').show();
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal)
			percent.html(percentVal);
		}
    },
     success: function(data) {
	  registros = data;
	  status = registros['status'];
	  mensagem = registros['mensagemstatus'];
	  if(status=='ERRO'){
		  $("#txterroform").html(mensagem);
		  $('.mensagensform').show('bounce');       
		  $('#erro').show('bounce');       
		}else{
			if(!$.isEmptyObject(registros['conteudo'])){
				conteudo = registros['conteudo'];
				$("#listagem").html(conteudo);
			}
			$("#spinner").css({'display':'none'});
			$("#manipulacao").css({'display':'none'});
		}
      $("#spinner").css({'display':'none'});
    },
   uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
	complete: function(xhr) {
	  //$("#listagem").html(xhr.responseText);
      $("#spinner").css({'display':'none'});
	}
}); 

})();       
</script>
			


 
 
<cfinclude template="../view/ajaxacao.cfm">


	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->



