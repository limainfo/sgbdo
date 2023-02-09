<cfinclude template="mensagens.cfm">
<cfif isquery(conteudoinstrutores) >
<cfset url.total=conteudoinstrutores.recordcount>
</cfif>					
					
	<cfinclude template="mensagens.cfm">

	<div class="block">

					<div class="block_head">

						<div class="bheadl"></div>

						<div class="bheadr"></div>

						

						<h2>Instrutores Cadastrados -> Total: <cfoutput>#url.total#</cfoutput> Página: <cfoutput>#url.pagina#</cfoutput></h2>  

						<form action="" method="post">

							<input type="text" class="text" value="Search" />

						</form>

					</div>		<!-- .block_head ends -->

					

					

					

					<div class="block_content">

					

						<form action="" method="post">

						

							<table cellpadding="0" cellspacing="0" width="100%" class="sortable">

							

								<thead>

									<tr>

										<th>Nome</th>

										<th>Função</th>

										<th>Descrição</th>


										<td colspan="2">&nbsp;Ações</td>

									</tr>

								</thead>

								

								<tbody>
<cfif isquery(conteudoinstrutores) >
	<cfoutput startrow=#comeco# maxrows=5 query="conteudoinstrutores">
									<tr>
										<td>#nome#</a></td>
										<td>#funcao#</td>
										<td>#descricao#</td>
										<td class="delete"><a href=""  onclick="return false;">Edit</a></td>
										<td class="delete"><a href=""  onclick="return false;">Delete</a></td>
									</tr>									
	</cfoutput>
</cfif>

										



								</tbody>

							</table>



							

							

<cfparam name='Form.action' default=''>							
<cfif Form.action neq 'add'>
	<cfoutput>
							<div class="pagination right">
								<a href="##">&laquo;</a>
<cfscript>
	paginas = int(url.total / 5 );
	if (url.total neq paginas*5 ){
		paginas = paginas + 1; 
	}
for(i=1;i<=paginas;i++){
	if (i eq url.pagina){
	 writeoutput("<a href='?i=#url.i#&acao=#url.acao#&pagina=#i#'  class='active'>#i#</a>");
	}else{
	 writeoutput("<a href='?i=#url.i#&acao=#url.acao#&pagina=#i#'>#i#</a>");
	}
	
}

</cfscript>

								<a href="##">&raquo;</a>

							</div>		<!-- .pagination ends -->
	</cfoutput>							
</cfif>
							

						</form>

						

					</div>		<!-- .block_content ends -->

					

					<div class="bendl"></div>

					<div class="bendr"></div>

	</div>		<!-- .block ends -->
<cfparam name="status" default="">
<script language="javascript">
<cfscript>
	switch (status){
	case 'OK':	WriteOutput("$('##sucesso').css({'display':'block'});");break;
	case 'ERRO':	WriteOutput("$('##erro').html= 'Os dados não foram gravados !';$('##erro').css({'display':'block'});");break;
		
	}
</cfscript>
</script>

	<cfscript>

	 //dump("#FORM#");

	</cfscript>
