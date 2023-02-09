<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<p><h3>Tipo:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.Tipo" id="<cfoutput>#controllernomecampo#</cfoutput>Tipo"  class="styled required">
			<option value="<cfoutput>#conteudoconsulta.tipo#</cfoutput>" selected="selected"><cfoutput>#conteudoconsulta.tipo#</cfoutput></option>
			</select>
			</p>			
			<p><h3>Perfil:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.PerfilID" id="<cfoutput>#controllernomecampo#</cfoutput>PerfilID" class="text medium" readonly="readonly" style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.PerfilID#</cfoutput>" /> 
			</p>
			<p><h3>Responsável:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.UnidadeResponsavel"  id="<cfoutput>#controllernomecampo#</cfoutput>UnidadeResponsavel"   class="styled required">
			<cfquery datasource="lpna" name="unidades">
				select * from unidades ur where 1=1  #sqlUnidadeID# order by nome asc;
			</cfquery>
			<cfoutput query="unidades">
			<cfif unidadeID eq conteudoconsulta.unidadeResponsavel >
				<option value="#unidadeID#" selected="selected"  >#nome#</option>
			<cfelse>
				<option value="#unidadeID#"  >#nome#</option>
			</cfif>
			</cfoutput>
			</select>
			</p>
			
			<p><h3>Habilitacao:</h3>
			<cfquery datasource="lpna" name="consultahabilitacao">
				select * from habilitacoes_select hs where 1=1 #sqlHabilitacao#   order by habilitacao asc;
			</cfquery>

			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Habilitacao" multiple="multiple" rows"10" id="<cfoutput>#controllernomecampo#</cfoutput>Habilitacao"   class="multiple required">

			<cfoutput query="consultahabilitacao">
				<cfif listfind(habilitacaolst, habilitacao) gt 0 >
					<option value="#habilitacao#" selected="selected" >#habilitacao#</option>
					<cfelse>
					<option value="#habilitacao#"  >#habilitacao#</option>
				</cfif>
			</cfoutput>
			</select>
			</p>
			<p><h3>Unidade:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.UnidadeID" multiple="multiple" rows"10" id="<cfoutput>#controllernomecampo#</cfoutput>UnidadeID"   class="multiple required">
			<cfquery datasource="lpna" name="unidades">
				select * from unidades   order by nome asc;
			</cfquery>
			<cfoutput query="unidades">
				<cfif listfind(unidadelst, unidadeID) gt 0 >
					<option value="#unidadeID#" selected="selected" >#nome#</option>
					<cfelse>
					<option value="#unidadeID#"  >#nome#</option>
				</cfif>
			</cfoutput>
			</select>
			</p>
			<p><h3>Regional:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.RegionalID" multiple="multiple" rows"10" id="<cfoutput>#controllernomecampo#</cfoutput>RegionalID"   class="multiple required">
			<cfquery datasource="lpna" name="regionais">
				select * from unidades_regionais group by regionalID  order by jurisdicao;
			</cfquery>
			<cfoutput query="regionais">
				<cfif listfind(regionallst, regionalID) gt 0 >
					<option value="#regionalID#" selected="selected" >#nome#</option>
					<cfelse>
					<option value="#regionalID#"  >#nome#</option>
				</cfif>
			</cfoutput>
			</select>
			</p>
			<p><h3>Setor:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.SetorID" multiple="multiple" rows"10" id="<cfoutput>#controllernomecampo#</cfoutput>SetorID"   class="multiple required">
			<cfquery datasource="lpna" name="setores">
				select * from sgpo_setores order by nome asc;
			</cfquery>
			<cfoutput query="setores">
				<cfif listfind(setorlst, setorID) gt 0 >
					<option value="#setorID#" selected="selected" >#nome#</option>
					<cfelse>
					<option value="#setorID#"  >#nome#</option>
				</cfif>
			</cfoutput>
			</select>
			</p>
			<hr>
			<input type="hidden" name="action" id="action" value="edit" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />

			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>

			<p><input type="submit" class="submit small"  value="Cadastrar" onClick="envia();"/>
			</p>
		</form>

<script type="text/javascript">
//<![CDATA[
$('#erro').hide();
$('.mensagensform').hide();

function atualiza(idselect, contenha, campowhere, table, idtable, campotable){
  var parametros = {'controller':'perfils','action':'atualizaselect','contenha':contenha, 'campoWhere':campowhere, 'tabela':table, 'tabelaID':idtable, 'tabelacampo':campotable};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/perfilcontroller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(dados) {
	  var selectform = 'select'+idselect;
	  $(selectform).html(dados);
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'json',
    contentType: 'application/x-www-form-urlencoded'
  });

}
  
$("#PerfilsUnidadeID").change(function() {
	var obj=$(this);
	atualiza('#PerfilsRegionalID',obj.val(), 'unidadeID', 'unidades_regionais','regionalID','nome');
  $('#PerfilsSetorID').html('');
});

$("#PerfilsRegionalID").change(function() {
	var obj=$(this);
	atualiza('#PerfilsSetorID',obj.val(), 'regionalID', 'sgpo_setores','setorID','nome');
});

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
 
 


//]]>
</script>

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->




