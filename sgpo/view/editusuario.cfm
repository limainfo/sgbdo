<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<p><h3>Unidade:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.UnidadeID" id="<cfoutput>#controllernomecampo#</cfoutput>UnidadeID"   class="styled">
			<cfquery datasource="lpna" name="unidades">
				select * from unidades_regionais   order by nome asc;
			</cfquery>
			<cfoutput query="unidades">
			<option value="#regionalID#"  >#nome#</option>
			</cfoutput>
				<option value="<cfoutput>#conteudoconsulta.unidadeID#</cfoutput>" selected="selected" ><cfoutput>#conteudoconsulta.unidade#</cfoutput></option>
			</select>
			</p>
			<p><h3>Nome:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome"  class="styled required">
			<option value="<cfoutput>#ucase(conteudoconsulta.usuario)#</cfoutput>" selected="selected"><cfoutput>#ucase(conteudoconsulta.usuario)#</cfoutput></option>
			</select>
			</p>			
			<p><h3>E-mail:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Email" id="<cfoutput>#controllernomecampo#</cfoutput>Email" class="text big" style="text-transform: none;" value="<cfoutput>#conteudoconsulta.mail#</cfoutput>"  /> 
			</p>
			<p><h3>Senha:</h3><input type="password"  name="<cfoutput>#controllernomecampo#</cfoutput>.Senha" id="<cfoutput>#controllernomecampo#</cfoutput>Senha" class="text big" value="" /> 
			</p>
			<p><h3>CPF:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Cpf" id="<cfoutput>#controllernomecampo#</cfoutput>Cpf" readonly="readonly" class="text big" style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.cpf#</cfoutput>" /> 
			</p>
			<p><h3>Perfil LPNA:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.PerfilLPNA" id="<cfoutput>#controllernomecampo#</cfoutput>PerfilLPNA"   class="styled">
           	<cfset grupos = "DECEA,EPTA,DIRSA,Ensino,Jurisdição,ASOCEA,SDOP,API" >
                <cfloop list="#grupos#" index="i">
                <cfoutput>
                   <option value="#i#">#i#</option>
                </cfoutput>
                </cfloop>
				<option value="<cfoutput>#conteudoconsulta.perfillpna#</cfoutput>" selected="selected" ><cfoutput>#conteudoconsulta.perfillpna#</cfoutput></option>
 			</select></p>
			<p><h3>Perfil SGPO:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.PerfilID" id="<cfoutput>#controllernomecampo#</cfoutput>PerfilID"   class="styled">
			<cfquery datasource="#dsn#" name="perfis">
				select perfilID, tipo from sgpo_perfils where deleted is null order by perfilID asc;
			</cfquery>
			<cfoutput query="perfis">
			<cfif conteudoconsulta.perfilID eq perfis.perfilID >
			<option value="#perfis.perfilID#" selected="selected" >#perfilID#-#tipo#</option>
			<cfelse>
			<option value="#perfis.perfilID#"  >#perfilID#-#tipo#</option>
			</cfif>
			</cfoutput>
			</select>			</p>
			<cfif isdate(conteudoconsulta.deleted) >
			<cfset valorcheckbox =  '' >
			<cfelse>
			<cfset valorcheckbox =  ' checked="checked" ' >
			</cfif>
			<p><b>Ativo:</b><input type="checkbox" name="<cfoutput>#controllernomecampo#</cfoutput>.Ativo" id="<cfoutput>#controllernomecampo#</cfoutput>Ativo" readonly="readonly" class="styled"  value="1" <cfoutput>#valorcheckbox#</cfoutput>/> 
			</p>
			<hr>
			<input type="hidden" name="<cfoutput>#controllernomecampo#</cfoutput>.PassID" id="<cfoutput>#controllernomecampo#</cfoutput>PassID" value="<cfoutput>#conteudoconsulta.passID#</cfoutput>" />
			<input type="hidden" name="<cfoutput>#controllernomecampo#</cfoutput>.UsuarioID" id="<cfoutput>#controllernomecampo#</cfoutput>UsuarioID" value="<cfoutput>#conteudoconsulta.usuarioID#</cfoutput>" />
			<input type="hidden" name="action" id="action" value="edit" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
			<p><input type="submit" class="submit small"  value="Cadastrar" onClick="envia();"/>
			</p>
		</form>

<script type="text/javascript">
//<![CDATA[

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
      $("#listagem").html(data);
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




