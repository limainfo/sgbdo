    <script src="js/jquery.form.js" type="text/javascript"></script>
<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" method="post" enctype="multipart/form-data">
			<p><h3>Nome:</h3><input type="text" readonly="readonly" name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome" class="text big" style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.nome#</cfoutput>"  onchange="alert('Não esqueça de solicitar a movimentação para a nova unidade. Fins atualizar TLP.');" /> 
			</p>
<cfquery datasource="lpna" name="regionais">
				select * from unidades_regionais where deletedat is null and regionalID='#conteudoconsulta.regionalID#' order by jurisdicao asc, nome asc;
			</cfquery>
			<p><label>Destino:</label> <br />
			<cfquery datasource="lpna" name="consulta" >
				select *, ur.nome as regional, ss.nome as setor from unidades_regionais ur
				inner join unidades u on (u.unidadeID=ur.unidadeID #sqlRegionalID# #sqlUnidadeID#)
				inner join sgpo_setores ss on (ss.unidadeID=ur.unidadeID and ss.regionalID=ur.regionalID #sqlSetorID# and ss.setorID='#conteudoconsulta.setorID#')
				  where ur.deletedat is null order by ur.jurisdicao asc, ur.nome asc;
			</cfquery>						
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.SetorID" readonly="readonly"  id="<cfoutput>#controllernomecampo#</cfoutput>SetorID"    class="styled">
			<cfoutput  query="consulta">
			<cfset atributo = ''>
			<cfif setorID eq conteudoconsulta.setorID >
			<cfset atributo = ' selected="selected" ' >
			</cfif>
			<option value="#setorID#" #atributo# >#jurisdicao#-#regional#-#setor# #regiao#</option>
			</cfoutput></select>
			</p>
			<p><label>Tipo de Contrato:</label> <br />
			<cfquery datasource="lpna" name="consulta" >
				select * from sgpo_tiposcontratos where deleted is null and nome='#conteudoconsulta.tipocontrato#' order by nome asc
			</cfquery>						
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Tipocontrato" readonly="readonly"  id="<cfoutput>#controllernomecampo#</cfoutput>Tipocontrato"    class="styled">
			<cfoutput  query="consulta">
			<cfset atributo = ''>
			<cfif nome eq conteudoconsulta.tipocontrato >
			<cfset atributo = ' selected="selected" ' >
			</cfif>
			<option value="#nome#" #atributo#>#nome#-#descricao#</option>
			</cfoutput></select>
			</p>
						
			<p><label>Habilitação:</label><br>
			<cfquery datasource="lpna" name="consulta" >
				select * from habilitacoes_select where  habID='#conteudoconsulta.habilitacaoID#'order by habilitacao asc
			</cfquery>						
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.HabilitacaoID" readonly="readonly"  id="<cfoutput>#controllernomecampo#</cfoutput>HabilitacaoID"    class="styled error"><cfoutput  query="consulta"><option value="#habID#">#habilitacao#</option></cfoutput></select>
			</p>					
			<p><label>Função:</label><br>
			<cfscript>
				funcoes =  "INSTRUTOR, OPERADOR , SUPERVISOR";			
			</cfscript>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Funcao" readonly="readonly"  id="<cfoutput>#controllernomecampo#</cfoutput>Funcao"    class="styled">
			<cfloop list="#funcoes#" index="valor"  >
			<cfoutput>
				<cfset atributo = ''>
				<cfif valor eq conteudoconsulta.funcao >
				<cfset atributo = ' selected="selected" ' >
				</cfif>
				<option value="#valor#"  #atributo#>#valor#</option></cfoutput>
			</cfloop>
			</select>
			</p>					
			<p><h3>CPF:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Cpf" id="<cfoutput>#controllernomecampo#</cfoutput>Cpf" readonly="readonly" class="text big" style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.cpf#</cfoutput>" /> 
			</p>
			
			
			<p><label>Horas de simulador:</label><br><input type="text" value="<cfoutput>#conteudoconsulta.horassimulador#</cfoutput>"   name="<cfoutput>#controllernomecampo#</cfoutput>.Horassimulador" id="<cfoutput>#controllernomecampo#</cfoutput>Horassimulador"   class="text small error" />
			</p>
			<p><label>Horas necessárias:</label><br><input type="text" value="<cfoutput>#conteudoconsulta.horasnecessarias#</cfoutput>"  name="<cfoutput>#controllernomecampo#</cfoutput>.Horasnecessarias" id="<cfoutput>#controllernomecampo#</cfoutput>Horasnecessarias"  class="text small error" />
			</p>
			<p><label>Carga Teórica:</label><br><input type="text" value="<cfoutput>#conteudoconsulta.cargateorica#</cfoutput>"   name="<cfoutput>#controllernomecampo#</cfoutput>.Cargateorica" id="<cfoutput>#controllernomecampo#</cfoutput>Cargateorica"   class="text small error" />
			</p>
			<p><label>Carga Prática:</label><br><input type="text" value="<cfoutput>#conteudoconsulta.cargapratica#</cfoutput>"  name="<cfoutput>#controllernomecampo#</cfoutput>.Cargapratica" id="<cfoutput>#controllernomecampo#</cfoutput>Cargapratica"  class="text small error" />
			</p>
			<p><label>Aproveitamento no Teste Operacional:</label><br><input type="text" value="<cfoutput>#conteudoconsulta.aproveitamentotesteoperacional#</cfoutput>"  name="<cfoutput>#controllernomecampo#</cfoutput>.Aproveitamentotesteoperacional" id="<cfoutput>#controllernomecampo#</cfoutput>Cargapratica"  class="text small error" />
			</p>
			<p><label>ATA para finalizar processo:</label> <br />
				<input type="file" name="<cfoutput>#controllernomecampo#</cfoutput>.Ata" id="<cfoutput>#controllernomecampo#</cfoutput>Ata"  value="" />
				
				<span id="uploadmsg">Max size 3Mb</span>
			</p>
			<p><label>Observações:</label><br><textarea  class="wysiwyg error" name="<cfoutput>#controllernomecampo#</cfoutput>.obs" id="<cfoutput>#controllernomecampo#</cfoutput>obs"   value="<cfoutput>#conteudoconsulta.obs#</cfoutput>"></textarea>
			</p>
			<div id='orientacao'><img src="images/loading.gif" height="20px">&nbsp;&nbsp;Processando os dados. Aguarde chegar em 100%.</div>
			<hr>

			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>



				<div class="progress">
					<div class="bar" style="width: 100%;"></div>
					<div class="percent">0%</div>
				</div>				
				<div id="status"></div>				
			<input type="hidden"  name="<cfoutput>#controllernomecampo#</cfoutput>.DadossistemaID" id="<cfoutput>#controllernomecampo#</cfoutput>DadossistemaID" value="<cfoutput>#conteudoconsulta.dadossistemaID#</cfoutput>" />
			<input type="hidden"  name="<cfoutput>#controllernomecampo#</cfoutput>.EstagiarioID" id="<cfoutput>#controllernomecampo#</cfoutput>EstagiarioID" value="<cfoutput>#conteudoconsulta.estagiarioID#</cfoutput>" />
			<input type="hidden" name="action" id="action" value="edit" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
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
    url:        'controller/estagiariocontroller.cfm', 
    type:        'POST', 
	beforeSend: function() {
		$('#orientacao').show();
		$('#status').show();
		$('#progress').show();
		$('.bar').show();
		$('.percent').show();
        //status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
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
			conteudo = registros['conteudo'];
			$("#listagem").html(conteudo);
			$("#spinner").css({'display':'none'});
			$("#manipulacao").css({'display':'none'});
		}
      $("#orientacao").css({'display':'none'});
      $("#status").css({'display':'none'});
      $("#progress").css({'display':'none'});
      $(".bar").css({'display':'none'});
      $(".percent").css({'display':'none'});
		
      $("#spinner").css({'display':'none'});
    },	
    complete: function(xhr) {
	 // $("#listagem").html(xhr.responseText);
      //$("#spinner").css({'display':'none'});
	}
}); 

})();       
</script> 


	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->



