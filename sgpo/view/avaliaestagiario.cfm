		
			<div class="block">
					

<div class="message success" id="zeropane" ><p>O estagiário 1S BET EVALDO DE SOUSA LIMA  foi designado para a função ACC VGL</p></div>
					
				
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					
					<h2>Estagiários aguardando avaliações</h2>
					<div align="right" style="height:54px;"><img src="../sgpo/images/chegada_pessoal.png" alt="Há novos registros!" align="middle" style="padding:10px;" />			        </div>
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<p class="breadcrumb"><a href="#">RN002</a> &raquo; <a href="#">Seção de Instrução</a> &raquo; <strong>Listar estagiários que estão sendo avaliados</strong></p>
				

<!-- Todas as operações Ajax básicas -->
<div class="block">
			
				
				
				<div class="block_content">
				
					<form action="" method="post">
						<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
							<thead>
								<tr>
									<th>Num. processo</th>
									<th>Nome</th>
									<th>Origem</th>
									<th>Dt apres ATM</th>
									<th><b>SISTEMA</b></th>
									<th><b>Função</b></th>
									<th><b>Horas previstas</b></th>
									<th><b>Horas avaliadas</b></th>
									<th><b>Fichas</b></th>
									<th><b>Ação</b></th>
								</tr>
							</thead>
							<tbody>
<cfquery datasource="lpna" name="consulta" >
	select "1S BET EVALDO DE SOUSA LIMA" as nome, "Proveniente da EEAR" as descricao, "2012-10-04 11:50" as atualizacao, 'BCA' as sistema, "ACC VGL" as funcao ;
</cfquery>						
								<cfoutput query="consulta">
								<cfset data=dateformat(#atualizacao#,'dd-mm-yyyy ') & hour(#atualizacao#) & ':' & minute(#atualizacao#)>
								<tr>
									<td><a href="?i=pdf&nome=anexoa"  >0001/SDOP/2012</a></td>
									<td><a href="?i=pdf&nome=fichacadastral"  >#nome#</a></td>
									<td>CINDACTA IV</td>
									<td>#atualizacao#</td>
									<td>#sistema#</td>
									<td>#funcao#</td>
									<td>90</td>
									<td>70</td>
									<td><a href="##"  onclick="$('##idevaldo').toggle();"><img src="../sgpo/images/fichas.png" align="middle" style="padding:10px;"> </a></td>
									<td><a href="##" onclick='envia();'  >Avaliar</a></td>
								</tr>									
								<tr id="idevaldo" style="display:none">
									<td colspan="9">
										<table cellpadding="0" style="background-color:yellow;" cellspacing="0" width="100%" >
											<thead>
												<tr>
													<th><b>Dt avaliacao</b></th>
													<th><b>Tipo Anexo</b></th>
													<th><b>Ficha</b></th>
													<th><b>Assinatura Instrutor</b></th>
													<th><b>Assinatura Seção Instrução</b></th>
												</tr>
											</thead>
											<tbody>
												<tr>
												<td>10-10-2012</td>
												<td>C</td>
												<td><a href="?i=pdf&nome=anexoc"  ><img src="../sgpo/images/ficha.png" align="middle" style="padding:10px;"> </a></td>
												<td><a href="##"  ><img src="../sgpo/images/fichaassinada.png" align="middle" style="padding:10px;"> </a></td>
												<td></td>
												</tr>
												<tr>
												<td>09-10-2012</td>
												<td>C</td>
												<td><a href="?i=pdf&nome=anexoc"  ><img src="../sgpo/images/ficha.png" align="middle" style="padding:10px;"> </a></td>
												<td><a href="##"  ><img src="../sgpo/images/fichaassinada.png" align="middle" style="padding:10px;"> </a></td>
												<td><a href="##"  ><img src="../sgpo/images/fichaassinada.png" align="middle" style="padding:10px;"> </a></td>
												</tr>
											</tbody>
										</table>
										
									</td>
								</tr>									
								</cfoutput>
																

							</tbody>
						</table>
					</form>
					
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
  var parametros = {'controller':'fichas','action':'lista'};
  
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/habilitacaocontroller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#fichaavaliacaoestagiario").html(data);
		$('#fichaavaliacaoestagiario').show('slow', function() {
		// Animation complete.
		});       
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }


//]]&gt;
</script>

<div id="fichaavaliacaoestagiario" style="display:none;background: none repeat scroll 0 0 white;height: 100%;position: absolute;top: 142px;width: 90%; z-index:10;"><a href="#" onclick='$("#fichaavaliacaoestagiario").hide("slow");'>X</a></div>
