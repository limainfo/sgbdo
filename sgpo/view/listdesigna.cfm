	<cfinclude template="mensagens.cfm">
		
			<div class="block">
					
<cfif url.i eq 'Estágio'>
<cfoutput>
<div class="message success" id="zeropane" ><p>O estagiário 1S BET EVALDO DE SOUSA LIMA  foi designado para a função ACC VGL</p></div>
</cfoutput>			
</cfif>			
					
				
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					
					<h2>Pessoal proveniente dos Sistemas SISCEAB</h2>
					<cfif url.i neq 'Estágio'>
					<div align="right" style="height:54px;"><img src="../sgpo/images/chegada_pessoal.png" alt="Há novos registros!" align="middle" style="padding:10px;" />			        </div>
					</cfif>
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<p class="breadcrumb"><a href="#">RN002</a> &raquo; <a href="#">Gerente</a> &raquo; <strong>Obter atualizações dos diversos sistemas</strong></p>
				

<!-- Todas as operações Ajax básicas -->
<div class="block">
			
				
				
				<div class="block_content">
					<cfif url.i neq 'Estágio'>
				
					<form action="" method="post">
						<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Origem</th>
									<th>Descrição</th>
									<th>Dt da movimentação</th>
									<th>Dt desligamento</th>
									<th>Dt apres ATM</th>
									<th><b>SISTEMA</b></th>
									<th><b>Ação</b></th>
								</tr>
							</thead>
							<tbody>
<cfquery datasource="lpna" name="consulta" >
	select "1S BET EVALDO DE SOUSA LIMA" as nome, "Proveniente da EEAR" as descricao, "2012-10-04 11:50" as atualizacao, 'BCA' as sistema ;
</cfquery>						
								<cfoutput query="consulta">
								<cfset data=dateformat(#atualizacao#,'dd-mm-yyyy ') & hour(#atualizacao#) & ':' & minute(#atualizacao#)>
								<tr>
									<td><a href="" onclick="return false;" >#nome#</a></td>
									<td>CINDACTA IV</td>
									<td>#descricao#</td>
									<td>#atualizacao#</td>
									<td>#atualizacao#</td>
									<td>#atualizacao#</td>
									<td>#sistema#</td>
									<td class="insert"><a href="?i=Designar&id=123456" >Designar</a></td>
								</tr>									
								</cfoutput>
								<tr>
									<td><a href="" onclick="return false;" >2S BCT FULANO</a></td>
									<td>CINDACTA II</td>
									<td>Movimentado</td>
									<td>10-10-2012</td>
									<td>10-10-2012</td>
									<td>10-10-2012</td>
									<td>SIGPES</td>
									<td class="insert"><a href="?i=Designar&id=123456" >Designar</a></td>
								</tr>									

							</tbody>
						</table>
					</form>
					<cfelse>
					<form action="" method="post">
						<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Origem</th>
									<th>Descrição</th>
									<th>Dt da movimentação</th>
									<th>Dt desligamento</th>
									<th>Dt apres ATM</th>
									<th><b>SISTEMA</b></th>
									<th><b>Ação</b></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="" onclick="return false;" >2S BCT FULANO</a></td>
									<td>CINDACTA II</td>
									<td>Movimentado</td>
									<td>10-10-2012</td>
									<td>10-10-2012</td>
									<td>10-10-2012</td>
									<td>SIGPES</td>
									<td class="insert"><a href="?i=Designar&id=123456" >Designar</a></td>
								</tr>									
							</tbody>
						</table>
					</form>
					</cfif>
					
				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
</div>		<!-- .block ends -->
<script language="javascript">
$("#erro").html("Erro de projeto .............");
//$("#erro").css({'display':'block'});
</script>
		
				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
					
			</div>		<!-- .block ends -->
			
			
			

			
			
			
			
			
			
			
			
<script type="text/javascript">
//&lt;![CDATA[

function envia() {
  var dados = $("#habilitacoesform").serialize();
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/habilitacaocontroller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#cadastrados").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
function obtemticotico() {
  $.ajax({
	type: 'GET',
	 processData: true,
    url: 'https://ximenesjx:decea@4152@10.32.59.14:8080/www.sigpes.intraer/sarh/sigpes.sig.sarh.login.php?encaminhar=https://www.sigpes.intraer/ticotico/sigpes.ssp.ticotico.BuscaPadrao.php',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#cadastrados").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }

//obtemticotico();	


//]]&gt;
</script>

