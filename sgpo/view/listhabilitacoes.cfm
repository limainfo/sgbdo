	<cfif isquery(conteudoconsulta) >
		<cfset url.total=conteudoconsulta.recordcount>
	<cfelse>
		<cfset url.total=1>
	</cfif>	
	<cfset paginas=int(url.total/maximoregistros) >
	<cfif url.total neq paginas*maximoregistros >
		<cfset paginas=paginas+1 >
	</cfif>
	<cfinclude template="mensagens.cfm">
	<cfquery datasource="#dsn#" name="tipos">
	select * from sgpo_tiposcontratos;
	</cfquery>
	<cfset contratos=StructNew() >
	<cfloop query="tipos">
		<cfset contratos[nome]=descricao >
	</cfloop>
<div id='listagem'>
	<div class="block">
			<div class="block_head">
				<div class="bheadl"></div>
					<div class="bheadr"></div>
						<h2><cfoutput>#controllernomeplural#</cfoutput> Cadastrados -> Total: <cfoutput>#url.total#</cfoutput> Página: <cfoutput>#url.pagina#/#paginas#</cfoutput></h2>  
						<form accept-charset="utf-8"  method="post" enctype="multipart/form-data" id="pesquisa" onSubmit="return false;">
							<input type="text" class="text" value="<cfoutput>#url.pesquisa#</cfoutput>" name="busca" id="busca"/>
							<input type="submit" class="submit small" id="pesquisa" value="Buscar" onClick="buscar($('#busca').val());"/>
						</form>
					</div>		<!-- .block_head ends -->
					<div class="block_content">
						<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
							<thead>
								<tr>
									<th>Posto</th>
									<th>Contrato</th>
									<th>Nome</th>
									<th>Localidade</th>
									<th>Função</th>
									<th>Habilitação</th>
									<th>Região</th>
									<th>Dt Validade</th>
									<th>Dt Emissão</th>
									<th >
										<table width="60%" cellpadding="0" cellspacing="0" border="0" align="right">
											<tr><th width="10%">Ações</th>
												<td class="acoes" width="30%"><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=xls&nome=<cfoutput>#controllernome#</cfoutput>&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>" title="Gerar XLS"><img src="images/xls.png" alt="Excel"></a></td>
											</tr>
										</table>
									</th>
								</tr>
							</thead>
							<tbody>
							<cfif isquery(conteudoconsulta) >
								<cfset i=1>
								<cfoutput startrow=#comeco# maxrows=#maximoregistros# query="conteudoconsulta">
								<cfif i%2 eq 0>
								<tr>
								<cfelse>
								<tr class="even">
								</cfif>
								<cfset i=i+1>
									<td>#posto#</td>
									<td>#contratos[contrato]#</td>
									<cfif len(conteudoconsulta.dadossistemaID) gt 10 >
									<td><a href="?d=#evaluate('##' & controllernomeid & '##')#&i=pdf&nome=fichacadastral"  >#nome#</a></td>
									<cfelse>
									<td>#nome#</td>
									</cfif>
									<td>#localidade#</td>
									<td>#funcao#</td>
									<td>#habilitacao#</td>
									<td>#regiao#</td>
									<td>#dateformat(dt_validade,'dd-mm-YYYY')#</td>
									<td>#dateformat(dt_emissao,'dd-mm-YYYY')#</td>
									<cfif datediff('d',dt_validade,now()) gte 1>
										<cfset luz = '<img src="images/vermelho.gif" alt="Vencida" title="Vencida">' >
									</cfif>
									<cfif datediff('d',dt_validade,now()) lte 0 and datediff('d',dt_validade,now()) gte -30 >
										<cfset luz = '<img src="images/laranja.gif" alt="A vencer em 30 dias" title="A vencer em 30 dias">' >
									</cfif>
									<cfif datediff('d',dt_validade,now()) lt -30>
										<cfset luz = '<img src="images/verde.gif" alt="Válida" title="Válida">' >
									</cfif>
									<td class="acoes">#luz#</td>
								</tr>									
									</cfoutput>
								</cfif>
							</tbody>
						</table>


		<cfparam name='Form.action' default=''>							
		<cfoutput>
			
		<div class="pagination right">
			<form class="pagination right" action="index.cfm" method="GET">
			<cfscript>
			if (url.pagina gt 1){
				antes = url.pagina -1;
				WriteOutput('<a href="?i=' & url.i & '&acao=' & url.acao & '&pagina=' & antes & ' &pesquisa=' & urlencode(url.pesquisa) & '">&laquo;</a>');
				atributo = '';
				if (url.pagina eq 1){
					atributo = "class='active'";
				}
				 writeoutput("<a href='?i=#url.i#&acao=#url.acao#&pagina=#1#&pesquisa=#urlencode(url.pesquisa)#' "&atributo&"  >#1#</a>");
				 
				if (url.pagina gte 5){
					writeoutput("<a href='##'>...</a>");
				}
				 
			}
			s = 0;
			for(i=0;i<paginas;i++){
				s=i+url.pagina;
				atributo = '';
				if (s eq url.pagina){
					atributo = 'class="active"';
				}
				if (url.pagina lte paginas){
				 writeoutput("<a href='?i=#url.i#&acao=#url.acao#&pagina=#s#&pesquisa=#urlencode(url.pesquisa)#'" & atributo & "  >#s#</a>");
				}
				if (i eq 5){
				 writeoutput("<a href='##'>...</a>");
				 writeoutput("<a href='?i=#url.i#&acao=#url.acao#&pagina=#paginas#&pesquisa=#urlencode(url.pesquisa)#'>#paginas#</a>");
				 i=paginas;
				}
				if (url.pagina eq paginas){
				 i=paginas;
				}
			}
			if (url.pagina lt paginas){
				depois = url.pagina +1;
				WriteOutput('<a href="?i=' & url.i & '&acao=' & url.acao & '&pagina=' & depois & ' &pesquisa=' & urlencode(url.pesquisa) & '">&raquo;</a>');
			}
			</cfscript>
			<input type="text" name="pagina" size="3"><input type="hidden" name="i" value="<cfoutput>#url.i#</cfoutput>"><input type="hidden" name="acao" value="<cfoutput>#url.acao#</cfoutput>"><input type="hidden" name="pesquisa" value="<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"></form>
		</div>		<!-- .pagination ends -->
		</cfoutput>							
	</div>		<!-- .block_content ends -->

	<div class="bendl"></div>
	<div class="bendr"></div>
	</div>		<!-- .block ends -->

<cfparam name="status" default="">
<cfparam name="url.pagina" default="1">

	<cfinclude template="../view/ajax.cfm">


</div>
