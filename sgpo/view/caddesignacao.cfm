<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<cfquery datasource="lpna" name="regionais">
				select *, ur.nome as regional, ss.nome as setor from unidades_regionais ur
				inner join unidades u on (u.unidadeID=ur.unidadeID #sqlRegionalID# #sqlUnidadeID#)
				inner join sgpo_setores ss on (ss.unidadeID=ur.unidadeID and ss.regionalID=ur.regionalID #sqlSetorID#)
				  where ur.deletedat is null order by ur.jurisdicao asc, ur.nome asc;
			</cfquery>
			<p><h3>Destino:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.SetorID" id="<cfoutput>#controllernomecampo#</cfoutput>SetorID" onchange="alert('Não esqueça de solicitar a movimentação para a nova unidade. Fins atualizar TLP.');"  class="styled required" >
			<cfoutput query="regionais">
			<cfset atributo='' >
			<cfif regionalID eq conteudoconsulta.regionalID>
			<cfset atributo=' selected="selected" '>
			</cfif>
			<option value="#setorID#" #atributo# >#jurisdicao#-#regional#-#setor# #regiao#</option>
			</cfoutput>
			</select>
			</p>
			<p><label>Tipo de Contrato:</label> <br />
			<cfquery datasource="lpna" name="consulta" >
				select * from sgpo_tiposcontratos where deleted is null order by nome asc
			</cfquery>						
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Tipocontrato" id="<cfoutput>#controllernomecampo#</cfoutput>Tipocontrato"    class="styled">
			<cfoutput  query="consulta">
			<cfset atributo='' >
			<cfif nome eq conteudoconsulta.tipocontrato>
			<cfset atributo=' selected="selected" '>
			</cfif>
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
			<option value="OPERADOR" selected="selected">OPERADOR</option>
			</select>
			</p>					
			<p><h3>Nome:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome" readonly="readonly" class="text big" style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.nome#</cfoutput>" /> 
			</p>
			<p><h3>CPF:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Cpf" id="<cfoutput>#controllernomecampo#</cfoutput>Cpf" readonly="readonly" class="text big" style="text-transform: uppercase;" value="<cfoutput>#conteudoconsulta.cpf#</cfoutput>" /> 
			</p>
			<input type="hidden"  name="<cfoutput>#controllernomecampo#</cfoutput>.DadossistemaID" id="<cfoutput>#controllernomecampo#</cfoutput>DadossistemaID" value="<cfoutput>#conteudoconsulta.dadossistemaID#</cfoutput>" />
			<p><label>Horas de simulador:</label><br><input type="text" value="0"  name="<cfoutput>#controllernomecampo#</cfoutput>.Horassimulador" id="<cfoutput>#controllernomecampo#</cfoutput>Horassimulador"   class="text small" />
			</p>
			<p><label>Horas necessárias:</label><br><input type="text" value="120"  name="<cfoutput>#controllernomecampo#</cfoutput>.Horasnecessarias" id="<cfoutput>#controllernomecampo#</cfoutput>Horasnecessarias"  class="text small" />
			</p>
			<p><label>Observações:</label><br><textarea  class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.obs" id="<cfoutput>#controllernomecampo#</cfoutput>obs"   value=""></textarea>
			</p>
			<hr>
			<input type="hidden" name="action" id="action" value="caddesignacao" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
			<p><input type="submit" class="submit small"  value="Cadastrar" onClick="envia();"/>
			</p>
		</form>

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->
 
<cfinclude template="../view/ajaxacao.cfm">

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->



