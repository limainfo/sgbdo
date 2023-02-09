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
									<th>Setor</th>
									<th>Região</th>
									<th>DT Cadastro</th>
									<th>MAN</th>
									<th>CM</th>
									<th>1&deg;TURNO (Consoles -Período)</th>
									<th>2&deg;TURNO (Consoles -Período)</th>
									<th>3&deg;TURNO (Consoles -Período)</th>
									<th>4&deg;TURNO (Consoles -Período)</th>
									<th>ENE</th>
									<th>Cálc. 100-25</th>
									<th colspan="3">
										<table width="60%" cellpadding="0" cellspacing="0" border="0" align="right">
											<tr><th width="10%">Ações</th>
												<td class="acoes" width="30%" colspan="3"><a href="javascript:cad();" title="Novo Registro"><img src="images/novo.png" alt="Cadastrar"></a></td>
											</tr>
										</table>
									</th>
								</tr>
							</thead>
							<tbody>
                            <cfquery dbtype="query" name="conteudoconsulta">
                            select * from conteudoconsulta order by nome
                            </cfquery>
							<cfif isquery(conteudoconsulta) >
								<cfset i=1>
								<cfoutput startrow=#comeco# maxrows=#maximoregistros# query="conteudoconsulta">
								<cfif i%2 eq 0>
								<tr>
								<cfelse>
								<tr class="even">
								</cfif>
								<cfset i=i+1>
									<td>#nome#</a></td>
									<td>#regional#</a></td>
									<td>#dateformat(created,'dd-mm-yyyy')#</a></td>
									<td>#movimentoanual#</a></td>
									<td>#cargamensal#</a></td>
									<td>#console01# -> #timeformat(inicio01,'HH:mm')#-#timeformat(fim01,'HH:mm')# <b><cfif pico01 gt 0>P</cfif></b></td>
									<td>#console02# -> #timeformat(inicio02,'HH:mm')#-#timeformat(fim02,'HH:mm')# <b><cfif pico02 gt 0>P</cfif></b></td>
									<td>#console03# -> #timeformat(inicio03,'HH:mm')#-#timeformat(fim03,'HH:mm')# <b><cfif pico03 gt 0>P</cfif></b></td>
									<td>#console04# -> #timeformat(inicio04,'HH:mm')#-#timeformat(fim04,'HH:mm')# <b><cfif pico04 gt 0>P</cfif></b></td>
									<td>#ene#</a></td>
									<td class="acoes"><a href="javascript:ver('#evaluate('##' & controllernomeid & '##')#');" title="Detalhes"><img src="images/lupa.png" alt="Visualizar"></a></td>
<td class="acoes"><a href="javascript:edita('#evaluate('##' & controllernomeid & '##')#');" title="Modificar"><img src="images/edit.png" alt="Editar"></a></td>
									<td class="acoes" colspan="2">
										<a href="javascript:exclui('#evaluate('##' & controllernomeid & '##')#', '#dateformat(created,'dd-mm-yyyy')#');" title="Excluir"><img src="images/lixo.png" alt="Excluir"></a>
										</td>
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
