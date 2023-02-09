
					
<script src="js/jquery.form.js" type="text/javascript"></script>
<cfparam name="form.ddd" default="sigpes">
<cfparam name="form.supersql" default="show tables">
<cfset thisPath=ExpandPath("/lpna/gerencial/_inc/habilitacoes/sgpo")>
<cfset thisDirectory=GetDirectoryFromPath(thisPath)>

<cfparam name="url.full" default=#thisDirectory# >
<cfparam name="caminhocompleto" default='#url.full#'>
<cfset pasta = #url.full# >


<cfdirectory name="arquivos" directory="#pasta#" sort="type ASC, name ASC">	
 				
 	
		
			<div class="block">
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					<h2>Inserir SQL </h2>
					
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<p class="breadcrumb"><a href="#">RN013</a> &raquo; <a href="#">Gerente</a> &raquo; <strong>Necessidade desenvolvimento </strong></p>
				
					<form accept-charset="utf-8" action="?i=SQL" method="post" enctype="multipart/form-data" id="habilitacoesform">
			<p><h3>DSN:</h3>
			<select name="ddd" id="ddd"  class="styled required">
				<option value="atualiza">atualiza</option>
				<option value="dctp">dctp</option>
				<option value="drhu">drhu</option>
				<option value="lpna">lpna</option>
				<option value="passaporte">passaporte</option>
				<option value="sas">sas</option>
				<option value="sigpes">sigpes</option>
				<option value="<cfoutput>#form.ddd#</cfoutput>" selected="selected"><cfoutput>#form.ddd#</cfoutput></option>
			</select>
						
						<p>
						<h3>SQL:</h3>
												<br />
							<textarea name="supersql" id="supersql" ><cfoutput>#form.supersql#</cfoutput></textarea>
						</p>
						
						<hr />
						<input type="hidden" name="action" id="action" value="add" />
						<input type="hidden" name="controller" id="controller" value="setores" />
						<p>
							<input type="submit" class="submit small" id="ExecutarSQL" value="Executar" />
							<!--
							<input type="submit" class="submit mid" value="Long submit" />
							<input type="submit" class="submit long" value="Even longer submit" />
							-->
						</p>
					</form>



<!-- Todas as operações Ajax básicas          -->
<div class="text">
			<cftry>	
				<cfquery datasource="#form.ddd#" name="executasql">
				#form.supersql#
				</cfquery>
				<cfscript>
					a=obtemSql(#executasql#);
				</cfscript>
				<cfoutput>#a#</cfoutput>
				<cfdump var=#executasql#>
				<cfcatch type="any">
				<cfoutput>#cfcatch.Detail#</cfoutput>
				</cfcatch>
			</cftry>
			
</div>
				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
					
			</div>		<!-- .block ends -->
			

			
<div id='listagem'>
	<div class="block">
			<div class="block_head">
				<div class="bheadl"></div>
					<div class="bheadr"></div>
						<h2><cfoutput>#GetDirectoryFromPath(#caminhocompleto#)#</cfoutput></h2>  
					</div>		<!-- .block_head ends -->
					<div class="block_content">
						<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
							<thead>
								<tr>
									<th>Tipo</th>
									<th>Nome</th>
									<th>Tamanho</th>
									<th>DT Modificação</th>
								</tr>
							</thead>
							<tbody>
					<tr>
                  <td>
                      <a href="?i=SQL&full=<cfoutput>#url.full#</cfoutput>/.."><img src="images/folder.png" ></a>
						</td>
                <td>..</td>
                  <td></td>
                  <td></td>
              </tr>							
                            
								<cfset i=1>
<cfoutput query="arquivos">
					<cfif i%2 eq 0>
					<tr>
					<cfelse>
					<tr class="even">
					</cfif>
					<cfset i=i+1>
                  <td>
                  <cfif arquivos.type IS "Dir">
                      <a href="?i=SQL&full=#arquivos.directory#/#arquivos.name#"><img src="images/folder.png" ></a>
                  <cfelse>
                      <a href="javascript:return false;" onmouseover="$('##arquivosubstituido').html('Susbstituir arquivo -> #arquivos.name#');" onclick="$('##caminho').val('#arquivos.directory#/#arquivos.name#');$('##dialogoenvia').show();"><img src="images/file.png" ></a>
                  </cfif></td>
                <td>#arquivos.name#</td>
                  <td>
                  <cfif arquivos.type IS "Dir">
                             -
                  <cfelse>
                             #NumberFormat(((arquivos.size)/1024),".__")# Kb
                  </cfif></td>
                  <td>#dateformat(arquivos.dateLastModified,'dd-mm-yyyy')# #timeformat(arquivos.dateLastModified,'HH:mm:ss')#</td>
              </tr>

  </cfoutput>									

									
							</tbody>
						</table>


		<cfparam name='Form.action' default=''>							
									
	</div>		<!-- .block_content ends -->

	<div class="bendl"></div>
	<div class="bendr"></div>
	</div>		<!-- .block ends -->

<cfparam name="status" default="">
<cfparam name="url.pagina" default="1">




</div>



<div class="block" style="width:50%;position:absolute;overflow:auto;z-index:1000;" id="dialogoenvia">
			<div class="block_head">
				<div class="bheadl"></div>
				<div class="bheadr"></div><a onclick="$('#dialogoenvia').css({'display':'none'});return false;" href="#"><img style="float:right;padding-top:7px;" src="images/excluir.png" ></a>

						<h2 id="arquivosubstituido"></h2></div>
	<div class="block_content">
		<form accept-charset="utf-8" method="post" enctype="multipart/form-data" id="postoculto">
			<p><label>ARQUIVO ORIGINAL OU NOVO</label>
			<input type="text" name="caminho" id="caminho" value="" class="text medium" />
			<p><label>ARQUIVO SUBSTITUTO</label>
				<input type="file" name="arquivosubstituto" id="substituto"  ><span id="uploadmsg">Max size 3Mb</span>
			</p>
			
			<div id='orientacao'><img src="images/loading.gif" height="20px">&nbsp;&nbsp;Processando os dados. Aguarde chegar em 100%.</div>
			<hr>

			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>



				<div class="progress">
					<div class="bar" style="width: 100%;"></div>
					<div class="percent">0%</div>
				</div>				
				<div id="status"></div>				

			<p><input type="submit" class="submit small"  value="Enviar" />
			</p>
		</form>
 </div></div>
<style>
.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
#orientacao { background-color: #yellow; width:100%; height:20px; padding:3px; border-radius: 3px; vertical-align: text-top; text-align: center; font-weight: bolder; position:relative; display:inline-block; border-radius: 3px;}
</style> 		
<script>
$('#erro').hide();
$('.mensagensform').hide();

(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
$("#orientacao").css({'display':'none'});
$("#status").css({'display':'none'});
$("#progress").css({'display':'none'});
$(".bar").css({'display':'none'});
$(".percent").css({'display':'none'});

$('#postoculto').ajaxForm({
    url:        '?i=SQL', 
    type:        'POST', 
	beforeSend: function() {
		$('#orientacao').show();
		$('#status').show();
		$('#progress').show();
		$('.bar').show();
		$('.percent').show();
        //status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(data) {
	  registros = data;
	  status = registros['status'];
	  mensagem = registros['mensagemstatus'];
	  if(status=='ERRO'){
	  		$('#erro').removeClass('message success').addClass('message errormsg');
		  $("#txterroform").html(mensagem);
		  $('.mensagensform').show('bounce');       
		  $('#erro').show('bounce');       
		}else{
	  		$('#erro').removeClass('message errormsg').addClass('message success');
		  $("#txterroform").html(mensagem);
		  $('.mensagensform').show('bounce');       
		  $('#erro').show('bounce');       
		}
      $("#orientacao").css({'display':'none'});
      $("#status").css({'display':'none'});
      $("#progress").css({'display':'none'});
      $(".bar").css({'display':'none'});
      $(".percent").css({'display':'none'});
		
      $("#spinner").css({'display':'none'});
    },	
    complete: function(xhr) {
	 // $("#listagem").html(xhr.responseText);
      //$("#spinner").css({'display':'none'});
	}
}); 

})();   

$("#dialogoenvia").css({'display':'none'});
 
 $(function() {
$( "#dialogoenvia" ).draggable();
});

$(document).bind('mousemove',function(e){ 
	var p = $("#dialogoenvia");
	var position = p.position();

	if($("#dialogoenvia").css('display')=='none'){
		$('#dialogoenvia').css('left', e.pageX);
		$('#dialogoenvia').css('top', e.pageY);
	}

});			   
</script> 


