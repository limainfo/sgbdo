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
			<div class="mensagensremoveficha"  style="margin:0px;padding:0px;diplay:none;"></div>
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
									<th>Nro.</th>
									<th>Nome</th>
									<th>Habilitação</th>
									<th>Função</th>
									<th>Documento</th>
									<th>DtEst</th>
									<th>DtFicha</th>
									<th>Horas</th>
									<th>Rendimento</th>
									<th>Assinaturas</th>
									<th colspan="3">
										<table width="60%" cellpadding="0" cellspacing="0" border="0" align="right">
											<tr><th width="10%">Ações</th>
												<td class="acoes" width="100%" colspan="3"><a href="javascript:cad();" title="Novo Registro"><img src="images/novo.png" alt="Cadastrar"></a></td>
												<!--
												<td class="acoes" width="30%"><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=<cfoutput>#controllernome#</cfoutput>&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>" title="Gerar PDF"><img src="images/pdf.png" alt="Pdf"></a></td>
												<td class="acoes" width="30%"><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=xls&nome=<cfoutput>#controllernome#</cfoutput>&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>" title="Gerar XLS"><img src="images/xls.png" alt="Excel"></a></td>
												-->
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
									<td><a href="?d=#estagiarioID#&i=pdf&nome=anexoa"  >#numeroprocesso#</a></td>
									<td><a href="?d=#estagiarioID#&i=pdf&nome=fichacadastral"  >#nome#</a></td>
									<td>#habilitacao#</td>
									<td>#funcao#</td>
									<cfif len(conteudoconsulta.documentocomprobatorio) gt 5 >
									<td style="font-size:xx-small;text-align:center;"><a href="documentos/#documentocomprobatorio#"  >COMPROVANTE<img src="documentos/#left(documentocomprobatorio,len(documentocomprobatorio)-4)#_page_1.jpg" title="Comprovante" style="vertical-align:middle;padding:10px;" width="32" height="32" ></a></td>
									<cfelse>
									<td style="font-size:xx-small;">#documento#</td>
									</cfif>
									<td>#dateformat(inicioestagio, 'dd-mm-yyyy')#</td>
									<td>#dateformat(dtavaliacao, 'dd-mm-yyyy')#</td>
									<cfif conteudoconsulta.horasconcluidas eq ''>
									<cfset conteudoconsulta.horasconcluidas=0 >
									</cfif>
									<cfparam name="conteudoconsulta.horasnecessarias" default=0 >
									<cfparam name="percentagem" default=0 >
									<cfset percentagem = conteudoconsulta.horasconcluidas * 100 / conteudoconsulta.horasnecessarias >
									<td>#tempototal#</td>
									<td>#rendimento#-#rendimentoletra#</td><td>
									<cfif len(assinaturainstrucao) gt 5 >
										<img src="images/assinaturasim.png" title="Assinado pelo perfil Instrução.">
									<cfelse>
										<img src="images/assinaturanao.png" title="Aguarda assinatura do perfil Instrução.">
									</cfif>
									<cfif len(assinaturainstrutor) gt 5 >
										<img src="images/assinaturasim.png" title="Assinado pelo perfil Instrutor.">
									<cfelse>
										<img src="images/assinaturanao.png" title="Aguarda assinatura do perfil Instrutor.">
									</cfif>
									</td>
									<td class="acoes"><a href="javascript:removeassinatura('#evaluate('##' & controllernomeid & '##')#','#numeroprocesso#-#nome#-#dateformat(inicioestagio, 'dd-mm-yyyy')#');" title="Remover assinatura"><img src="images/assinaturaremove.png" alt="Gerar"></a></td>
									<td class="acoes"><a href="javascript:avaliaficha('#evaluate('##' & controllernomeid & '##')#');" title="Avaliar"><img src="images/processo.png" alt="Gerar"></a></td>
									<td class="acoes"><a href="javascript:exclui('#evaluate('##' & controllernomeid & '##')#', '#nome#-#cpf#');" title="Excluir"><img src="images/lixo.png" alt="Excluir"></a></td>
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
<script language="javascript">
$('#erroremove').hide();
$('.mensagensremoveficha').hide();

function valida(dados){
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
		  $('.mensagensremoveficha').html('<div class=\'message errormsg\' id=\'erroremove\' ><p id=\'txterroform\'></p><span title=\'Dismiss\' class=\'close\' onclick="$(\'.mensagensform\').hide(\'slow\');"></span></div>');
		  mensagem = registros['mensagemstatus'];
		  if(status=='ERRO'){
				$("#txterroform").html(mensagem);
				$('.mensagensform').show('bounce');       
				$('#erro').show('bounce');       
			}else{
				location.reload();
			}
		  $("#spinner").css({'display':'none'});
			$( '#manipulacao' ).dialog( "close" );
		},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
		debugger;
	},
	data: dados ,
	datatype: 'json',
	contentType: 'application/x-www-form-urlencoded'
  });	
}
function removeassinatura(id, nome) {
		var parametros = {'controller':'<cfoutput>#controllernomeplural#</cfoutput>','action':'removeassinatura', 'id':id, 'pagina': '<cfoutput>#url.pagina#</cfoutput>', 'nome':nome  };
		var dados = parametros;
	
		$( "#manipulacao" ).dialog({title:'RN012 -> Remover Assinatura <cfoutput>#controllernome#</cfoutput>'});
		$( "#manipulacao" ).html('Tem certeza que deseja remover as assinaturas da ficha atual do processo/nome/data: ->'+nome+' ?');
		$( "#manipulacao" ).dialog({
			resizable: false,
			widht: window.innerWidth * 5/10,
			position: { my: "center", at: "center", of: window },
			height:200,
			modal: true,
			buttons: {
				"Remover": function() {
					valida(dados);
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			}
		});
      $( "#manipulacao" ).dialog( "open" );
  
  
 }
</script>
	<cfinclude template="../view/ajax.cfm">


</div>
