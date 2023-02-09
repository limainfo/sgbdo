<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<cfquery datasource="lpna" name="regionais">
				select * from unidades_regionais order by jurisdicao asc, nome asc;
			</cfquery>
			<p><h3>Regional:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.RegionalID" id="<cfoutput>#controllernomecampo#</cfoutput>RegionalID"  class="styled required">
			<cfoutput query="regionais">
			<option value="#regionalID#">#jurisdicao#-#nome#</option>
			</cfoutput>
			</select>
			</p>			
			<p><h3>Nome:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome" class="text big" style="text-transform: uppercase;" value="" /> 
			</p>
			<p><label>CPF:</label><br><input type="text" class="text medium" name="<cfoutput>#controllernomecampo#</cfoutput>.Cpf" id="<cfoutput>#controllernomecampo#</cfoutput>Cpf"   style="text-transform: uppercase;" value="">
			</p>
			<p><label>Identidade:</label><br><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Identidade" id="<cfoutput>#controllernomecampo#</cfoutput>Identidade"  class="text medium"  style="text-transform: uppercase;" value=""/>
			</p>
			<p><label>Matrícula no Órgão:</label><br><input type="text" class="text medium" name="<cfoutput>#controllernomecampo#</cfoutput>.Matricula" id="<cfoutput>#controllernomecampo#</cfoutput>Matricula"   style="text-transform: uppercase;" value="">
			</p>
			<p><label>Data da movimentação:</label><br /><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtmovimentacao" id="<cfoutput>#controllernomecampo#</cfoutput>Dtmovimentacao"   style="text-transform: uppercase;" value="">
			</p>
			<p><label>Data do desligamento:</label><br><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtdesligamento" id="<cfoutput>#controllernomecampo#</cfoutput>Dtdesligamento"  value="">
			</p>
			<p><label>Data de apresentação:</label><br><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Dtapresentacao" id="<cfoutput>#controllernomecampo#</cfoutput>Dtapresentacao"   style="text-transform: uppercase;" value="">
			</p>
			<p><label>Documento de movimentação:</label><br><input type="text" class="text big" name="<cfoutput>#controllernomecampo#</cfoutput>.Docmovimentacao" id="<cfoutput>#controllernomecampo#</cfoutput>Docmovimentacao"   value="">
			</p>
			<p><label>Documento do desligamento:</label><br><input type="text" class="text big" name="<cfoutput>#controllernomecampo#</cfoutput>.Docdesligamento" id="<cfoutput>#controllernomecampo#</cfoutput>Docdesligamento"   value="">
			</p>
			<hr>
			<input type="hidden"  name="<cfoutput>#controllernomecampo#</cfoutput>.Sistema" id="<cfoutput>#controllernomecampo#</cfoutput>Sistema" value="sgpo" />
			<input type="hidden" name="action" id="action" value="cad" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
			<p><input type="submit" class="submit small"  value="Cadastrar" onClick="envia();"/>
			</p>
		</form>

<cfinclude template="../view/ajaxacao.cfm">


	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->




