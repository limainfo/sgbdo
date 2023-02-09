<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="controller/<cfoutput>#controllernome#</cfoutput>controller.cfm" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<p><h3>Regional:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.UnidadeID" id="<cfoutput>#controllernomecampo#</cfoutput>UnidadeID"  class="styled" onchange='atualiza();'>
					<cfquery datasource="lpna" name="unidade">
					select * from unidades where deletedat is null order by nome asc;
					</cfquery>
					<cfloop query="unidade">
					<cfoutput><option value="#unidadeID#">#nome#</option></cfoutput>
					</cfloop>
				</select>		
			</p>
			<p><h3>Unidade:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.RegionalID" id="<cfoutput>#controllernomecampo#</cfoutput>RegionalID"  class="styled">	<option></option></select>
			</p>
			<p><label>Órgão:</label><br><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome" class="text medium" style="text-transform: uppercase;" />
			</p>
			<p><label>Região:</label><br><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Regiao" id="<cfoutput>#controllernomecampo#</cfoutput>Regiao" class="text medium" style="text-transform: uppercase;" />
			</p>
			<p><label>TEP ATCO:</label><br><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Tepatco" id="<cfoutput>#controllernomecampo#</cfoutput>Tepatco" class="text medium" style="text-transform: uppercase;" value="0" />
			</p>
			<p><label>Telefone:</label><br><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Telefone" id="<cfoutput>#controllernomecampo#</cfoutput>Telefone" class="text medium" style="text-transform: uppercase;" /> 
			</p>
			<p><label>Descrição:</label><br><textarea class="wysiwyg" name="<cfoutput>#controllernomecampo#</cfoutput>.Descricao" id="<cfoutput>#controllernomecampo#</cfoutput>Descricao" ></textarea>
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
 
function atualiza() {
  var id = $("#SetoresUnidadeID").val();
  var parametros = {'controller':'unidadesregionais','action':'select', 'unidadeid':id  };
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
	  $('select#SetoresRegionalID').html(data);
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: parametros ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
  
 }



//]]>
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


