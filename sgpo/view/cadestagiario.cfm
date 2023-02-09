<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<p><h3>Nome:</h3><input type="text"  name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome" class="text big" style="text-transform: uppercase;" value="" /> 
			</p>
			<p><label>Destino:</label> <br />
			<cfquery datasource="lpna" name="consulta" >
				select *, ur.nome as regional, ss.nome as setor from unidades_regionais ur
				inner join unidades u on (u.unidadeID=ur.unidadeID #sqlRegionalID# #sqlUnidadeID#)
				inner join sgpo_setores ss on (ss.unidadeID=ur.unidadeID and ss.regionalID=ur.regionalID #sqlSetorID#)
				  where ur.deletedat is null order by ur.jurisdicao asc, ur.nome asc;
			</cfquery>						
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.SetorID" id="<cfoutput>#controllernomecampo#</cfoutput>SetorID"    class="styled" onchange="alert('Não esqueça de solicitar a movimentação para a nova unidade. Fins atualizar TLP.');">
			<cfoutput  query="consulta">
			<cfset atributo='' >
			<option value="#setorID#" #atributo# >#jurisdicao#-#regional#-#setor# #regiao#</option>
			</cfoutput></select>
			</p>
			<p><label>Tipo de Contrato:</label> <br />
			<cfquery datasource="lpna" name="consulta" >
				select * from sgpo_tiposcontratos where deleted is null order by nome asc
			</cfquery>						
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Tipocontrato" id="<cfoutput>#controllernomecampo#</cfoutput>Tipocontrato"    class="styled">
			<cfoutput  query="consulta">
			<cfset atributo='' >
			<option value="#nome#" #atributo#>#nome#-#descricao#</option>
			</cfoutput></select>
			</p>
						
			<p><label>Habilitação:</label><br>
			<cfquery datasource="lpna" name="consulta" >
				select * from habilitacoes_select order by habilitacao asc
			</cfquery>						
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.HabilitacaoID" id="<cfoutput>#controllernomecampo#</cfoutput>HabilitacaoID"    class="styled"><cfoutput  query="consulta"><option value="#habID#">#habilitacao#</option></cfoutput></select>
			</p>					
			<p><label>Função:</label><br>
			<cfscript>
				funcoes =  "INSTRUTOR, OPERADOR , SUPERVISOR";			
			</cfscript>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Funcao" id="<cfoutput>#controllernomecampo#</cfoutput>Funcao"    class="styled">
			<cfloop list="#funcoes#" index="valor"  >
			<cfoutput><option value="#valor#">#valor#</option></cfoutput>
			</cfloop>
			</select>
			</p>					
			<p><h3>CPF:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Cpf" id="<cfoutput>#controllernomecampo#</cfoutput>Cpf" readonly="readonly" class="text big" style="text-transform: uppercase;" value="" /> 
			</p>
			<input type="hidden"  name="<cfoutput>#controllernomecampo#</cfoutput>.DadossistemaID" id="<cfoutput>#controllernomecampo#</cfoutput>DadossistemaID" value="<cfoutput>##conteudoconsulta.dadossistemaID##</cfoutput>" />
			<p><label>Horas de simulador:</label><br><input type="text" value="0"  name="<cfoutput>#controllernomecampo#</cfoutput>.Horassimulador" id="<cfoutput>#controllernomecampo#</cfoutput>Horassimulador"   class="text small" />
			</p>
			<p><label>Horas necessárias:</label><br><input type="text" value="120"  name="<cfoutput>#controllernomecampo#</cfoutput>.Horasnecessarias" id="<cfoutput>#controllernomecampo#</cfoutput>Horasnecessarias"  class="text small" />
			</p>
			<p><label>Observações:</label><br><textarea  class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.obs" id="<cfoutput>#controllernomecampo#</cfoutput>obs"   value=""></textarea>
			</p>
			<hr>
			<input type="hidden" name="action" id="action" value="cad" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />

			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>



			<p><input type="submit" class="submit small"  value="Cadastrar" onClick="envia();"/>
			</p>
		</form>
    <style>
    .ui-autocomplete-loading {
        background: white url('./images/loading.gif') right center no-repeat;
    }
    </style>


 
<script>
$('#erro').hide();
$('.mensagensform').hide();

function envia() {
  var dados = $("#habilitacoesform").serialize();
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
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
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
 
	
    $(function() {
        $( "#<cfoutput>#controllernomecampo#</cfoutput>Nome" ).autocomplete({
            source: "index.cfm?i=Estagi%C3%A1rio&acao=autocomplete",
            minLength: 5,
            select: function( event, ui ) {
				$( "#<cfoutput>#controllernomecampo#</cfoutput>Nome" ).val(ui.item.value);
				$( "#<cfoutput>#controllernomecampo#</cfoutput>DadossistemaID" ).val(ui.item.id);
				$( "#<cfoutput>#controllernomecampo#</cfoutput>SetorID" ).val(ui.item.setorID);
				$( "#<cfoutput>#controllernomecampo#</cfoutput>Tipocontrato" ).val(ui.item.tipocontrato);
				$( "#<cfoutput>#controllernomecampo#</cfoutput>Cpf" ).val(ui.item.cpf);
            }
        });
		
    });
    

	</script>

 

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->



