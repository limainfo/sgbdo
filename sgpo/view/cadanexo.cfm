<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="controller/<cfoutput>#controllernome#</cfoutput>controller.cfm" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			
			<p><h3>Anexos:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.Anexo" id="<cfoutput>#controllernomecampo#</cfoutput>Anexo"  class="styled required"><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option><option value="F">F</option></select>
			</p>			
			<p><h3>Documento:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Documento" id="<cfoutput>#controllernomecampo#</cfoutput>Documento" class="text medium" style="text-transform: uppercase;" value="" /> 
			</p>
			<p><label>Item:</label><br><input type="text" class="text medium" name="<cfoutput>#controllernomecampo#</cfoutput>.Item" id="<cfoutput>#controllernomecampo#</cfoutput>Item"   style="text-transform: uppercase;" value="">
			</p>
			<p><label>Área avaliada :</label><br><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Areaavaliada" id="<cfoutput>#controllernomecampo#</cfoutput>Areaavaliada"  class="text medium"  style="text-transform: uppercase;" value=""/>
			</p>
			<p><label>Dica área avaliada:</label><br><textarea class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.Dicaareaavaliada" id="<cfoutput>#controllernomecampo#</cfoutput>Dicaareaavaliada" ></textarea>
			</p>
			<p><label>Item avaliado:</label><br /><input type="text" class="text medium" name="<cfoutput>#controllernomecampo#</cfoutput>.Itemavaliado" id="<cfoutput>#controllernomecampo#</cfoutput>Itemavaliado"   style="text-transform: uppercase;" value="">
			</p>
			<p><label>Sequencia Item:</label><br><input type="text" class="text medium" name="<cfoutput>#controllernomecampo#</cfoutput>.SequenciaItem" id="<cfoutput>#controllernomecampo#</cfoutput>SequenciaItem"  value="">
			</p>
			<p><label>Dica para Ótimo:</label><br><textarea class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.Dicaotimo" id="<cfoutput>#controllernomecampo#</cfoutput>Dicaotimo" ></textarea>
			</p>
			<p><label>Dica para Bom:</label><br><textarea class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.Dicabom" id="<cfoutput>#controllernomecampo#</cfoutput>Dicabom" ></textarea>
			</p>
			<p><label>Dica para Regular:</label><br><textarea class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.Dicaregular" id="<cfoutput>#controllernomecampo#</cfoutput>Dicaregular" ></textarea>
			</p>
			<p><label>Dica para Não Satisfatório:</label><br><textarea class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.Dicanaosatisfatorio" id="<cfoutput>#controllernomecampo#</cfoutput>Dicanaosatisfatorio" ></textarea>
			</p>
			<hr>
			<input type="hidden" name="action" id="action" value="cad" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />

			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>

			<p><input type="submit" class="submit small" value="Cadastrar" onClick="envia();"/>
			</p>
		</form>
    <style>
    .ui-autocomplete-loading {
        background: white url('./images/loading.gif') right center no-repeat;
    }
    </style>

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
 


//]]>
</script>
<script>
    $(function() {
        $( "#<cfoutput>#controllernomecampo#</cfoutput>Documento" ).autocomplete({
            source: "index.cfm?i=Anexo&acao=autocomplete",
            minLength: 1,
            select: function( event, ui ) {
				$( "#<cfoutput>#controllernomecampo#</cfoutput>Documento" ).val(ui.item.value);
            }
        });
		
    });
</script>


	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->

<script src="js/jquery.wysiwyg.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.wysiwyg').wysiwyg();
    });
</script>


