<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<cfquery datasource="lpna" name="regionais">
				select * from unidades_regionais order by jurisdicao asc, nome asc;
			</cfquery>
			<p><h3>Regional:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.RegionalID" id="<cfoutput>#controllernomecampo#</cfoutput>RegionalID"  class="styled required">
			<cfoutput query="regionais">
			<cfset atributo = ''>
			<cfif regionalID eq conteudoconsulta.regionalID and conteudoconsulta.nomeunidade eq nome >
			<cfset atributo = ' selected="selected" ' >
			</cfif>
			<option value="#regionalID#" <cfoutput>#atributo#</cfoutput>>#jurisdicao#-#nome#</option>
			</cfoutput>
			</select>
			</p>			
			<p><h3>Nome:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome" class="text big" style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.nome#</cfoutput>" /> 
			</p>
			<p><label>CPF:</label><br><input type="text" class="text medium" name="<cfoutput>#controllernomecampo#</cfoutput>.Cpf" id="<cfoutput>#controllernomecampo#</cfoutput>Cpf"   style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.cpf#</cfoutput>">
			</p>
			<p><label>Identidade:</label><br><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Identidade" id="<cfoutput>#controllernomecampo#</cfoutput>Identidade"  class="text medium"  style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.identidade#</cfoutput>"/>
			</p>
			<p><label>Matrícula no Órgão:</label><br><input type="text" class="text medium" name="<cfoutput>#controllernomecampo#</cfoutput>.Matricula" id="<cfoutput>#controllernomecampo#</cfoutput>Matricula"   style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.matricula#</cfoutput>">
			</p>
			<p><label>Data da movimentação:</label><br /><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtmovimentacao" id="<cfoutput>#controllernomecampo#</cfoutput>Dtmovimentacao"   style="text-transform: uppercase;" value="<cfoutput>#dateformat(conteudoconsulta.dtmovimentacao, 'yyyy-mm-dd')#</cfoutput>">
			</p>
			
			<p><label>Data do desligamento:</label><br><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtdesligamento" id="<cfoutput>#controllernomecampo#</cfoutput>Dtdesligamento"  value="<cfoutput>#dateformat(conteudoconsulta.dtdesligamento, 'yyyy-mm-dd')#</cfoutput>">
			</p>
			<p><label>Data de apresentação:</label><br><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtapresentacao" id="<cfoutput>#controllernomecampo#</cfoutput>Dtapresentacao"   style="text-transform: uppercase;" value="<cfoutput>#dateformat(conteudoconsulta.dtapresentacao, 'yyyy-mm-dd')#</cfoutput>">
			</p>
			<p><label>Documento de movimentação:</label><br><input type="text" class="text big" name="<cfoutput>#controllernomecampo#</cfoutput>.Docmovimentacao" id="<cfoutput>#controllernomecampo#</cfoutput>Docmovimentacao"   value="<cfoutput>#conteudoconsulta.docmovimentacao#</cfoutput>">
			</p>
			<p><label>Documento do desligamento:</label><br><input type="text" class="text big" name="<cfoutput>#controllernomecampo#</cfoutput>.Docdesligamento" id="<cfoutput>#controllernomecampo#</cfoutput>Docdesligamento"   value="<cfoutput>#conteudoconsulta.docdesligamento#</cfoutput>">
			</p>
			<hr>
			<input type="hidden"  name="<cfoutput>#controllernomecampo#</cfoutput>.Sistema" id="<cfoutput>#controllernomecampo#</cfoutput>Sistema" value="<cfoutput>#conteudoconsulta.sistema#</cfoutput>" />
			<input type="hidden" name="<cfoutput>#controllernomecampo#</cfoutput>.DadossistemaID" id="<cfoutput>#controllernomecampo#</cfoutput>DadossistemaID" value="<cfoutput>#conteudoconsulta.dadossistemaID#</cfoutput>" />
			<input type="hidden" name="action" id="action" value="edit" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
			<input type="hidden" class="" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtmovimentacaotemp" id="<cfoutput>#controllernomecampo#</cfoutput>Dtmovimentacaotemp"   style="text-transform: uppercase;" value="<cfoutput>#dateformat(conteudoconsulta.dtmovimentacao, 'yyyy-mm-dd')#</cfoutput>">			
			<input type="hidden" class="" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtdesligamentotemp" id="<cfoutput>#controllernomecampo#</cfoutput>Dtdesligamentotemp"   style="text-transform: uppercase;" value="<cfoutput>#dateformat(conteudoconsulta.dtdesligamento, 'yyyy-mm-dd')#</cfoutput>">			
			<input type="hidden" class="" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtapresentacaotemp" id="<cfoutput>#controllernomecampo#</cfoutput>Dtapresentacaotemp"   style="text-transform: uppercase;" value="<cfoutput>#dateformat(conteudoconsulta.dtapresentacao, 'yyyy-mm-dd')#</cfoutput>">			
			
			<p><input type="submit" class="submit small"  value="Cadastrar" onClick="envia();"/>
			</p>
		</form>

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->
<cfinclude template="../view/ajaxacao.cfm">

<script language="javascript">
	$('#DadossistemasDtmovimentacao').val($('#DadossistemasDtmovimentacaotemp').val());
	$('#DadossistemasDtdesligamento').val($('#DadossistemasDtdesligamentotemp').val());
	$('#DadossistemasDtapresentacao').val($('#DadossistemasDtapresentacaotemp').val());
	<cfif isdefined(conteudoconsulta.dtapresentacao) >
		$('#DadossistemasDtapresentacao').datepicker({appendText: "yyyy-mm-dd", defaultDate: $("#DadossistemasDtapresentacao").val() });
	</cfif>
	<cfif isdefined(conteudoconsulta.dtmovimentacao) >
		$('#DadossistemasDtmovimentacao').datepicker({appendText: "yyyy-mm-dd", defaultDate: $("#DadossistemasDtmovimentacao").val() });
	</cfif>
	<cfif isdefined(conteudoconsulta.dtdesligamento) >
		$('#DadossistemasDtdesligamento').datepicker({appendText: "yyyy-mm-dd", defaultDate: $("#DadossistemasDtdesligamento").val() });
	</cfif>
</script>

