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
									<th>Regional</th>
									<th>Unidade</th>
									<th>Órgão</th>
									<th>Região</th>
									<th>TEP ATCO</th>
									<th>Telefone</th>
									<th colspan="3">
										<table width="60%" cellpadding="0" cellspacing="0" border="0" align="right">
											<tr><th width="10%">Ações</th>
												<td class="acoes" width="30%"><a href="javascript:cad();" title="Novo Registro"><img src="images/novo.png" alt="Cadastrar"></a></td>
												<td class="acoes" width="30%"><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=<cfoutput>#controllernome#</cfoutput>&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>" title="Gerar PDF"><img src="images/pdf.png" alt="Pdf"></a></td>
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
									<td>#nomeU#</a></td>
									<td>#nomeUR#</td>
									<td>#nomeSetor#</td>
									<td>#regiao#</td>
									<td>#tepatco#</td>
									<td>#telefone#</td>
									<td class="acoes"><a href="javascript:edita('#evaluate('##' & controllernomeid & '##')#');" title="Modificar"><img src="images/edit.png" alt="Editar"></a></td>
									<td class="acoes"><a href="javascript:exclui('#evaluate('##' & controllernomeid & '##')#', '#nomeU#-#nomeUR#-#nomeSetor#');" title="Excluir"><img src="images/lixo.png" alt="Excluir"></a></td>
									<td class="acoes"><a href="javascript:ver('#evaluate('##' & controllernomeid & '##')#');" title="Detalhes"><img src="images/lupa.png" alt="Visualizar"></a></td>
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
