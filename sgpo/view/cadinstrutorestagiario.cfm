<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<p><h3>Estagiário:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.EstagiarioID" multiple="multiple" rows"10" id="<cfoutput>#controllernomecampo#</cfoutput>EstagiarioID"   class="multiple required">
			<cfoutput query="estagiarios">
			<option value="#estagiarioID#"  >#nome#-#cpf#-#habilitacao#</option>
			</cfoutput>
			</select>
			</p>
			<p><h3>Instrutor:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.UsuarioID" multiple="multiple" rows"10" id="<cfoutput>#controllernomecampo#</cfoutput>UsuarioID"   class="multiple required">
			<cfoutput query="instrutores">
			<option value="#usuarioID#"  >#nome#-#cpf#</option>
			</cfoutput>
			</select>
			</p>
			<p><h3>Documento|||Anexo:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.Documento" id="<cfoutput>#controllernomecampo#</cfoutput>Documento"   class="multiple required" >
			<cfoutput query="anexos">
			<option value="#documento#|||#anexo#"  >#documento#|||#anexo#</option>
			</cfoutput>
			<option value="" selected="selected" ></option>
			</select>
			</p>
			<p><label>Prazo:</label><br /><input type="text" class="Datepicker" name="<cfoutput>#controllernomecampo#</cfoutput>.Prazo" id="<cfoutput>#controllernomecampo#</cfoutput>Prazo"   style="text-transform: uppercase;" readonly="readonly" value="">
			</p>
			<hr>
			<input type="hidden" name="action" id="action" value="cad" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
			
			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>

			
			<p><input type="submit" class="submit small"  value="Cadastrar" onClick="envia();"/>
			</p>
		</form>

<script type="text/javascript">
//<![CDATA[
$('#erro').hide();
$('.mensagensform').hide();

function envia() {
  var dados = $("#habilitacoesform").serialize();
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
	  mensagem = registros['mensagemstatus'];
	  if(status=='ERRO'){
		  $("#txterroform").html(mensagem);
		  $('.mensagensform').show('bounce');       
		  $('#erro').show('bounce');       
		}else{
			conteudo = registros['conteudo'];
			$("#listagem").html(conteudo);
			$("#spinner").css({'display':'none'});
			$("#manipulacao").css({'display':'none'});
		}
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }
 
jQuery(document).ready(function($) {

	 $( ".Datepicker" ).datepicker();
	 $( ".Datepicker" ).datepicker( $.datepicker.regional[ "pt-BR" ] ); 
	 $( ".Datepicker" ).datepicker("option","dateFormat","yy-mm-dd"); 
	 $( ".Datepicker" ).datepicker({
		 showButtonPanel: true,
		 buttonImage: "../images/calendario.png",
		 buttonImageOnly: true
		}); 
  });	

//]]>
</script>

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->




