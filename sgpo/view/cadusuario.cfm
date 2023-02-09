<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<p><h3>Unidade:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.UnidadeID" id="<cfoutput>#controllernomecampo#</cfoutput>UnidadeID"   class="styled">
			<cfquery datasource="lpna" name="unidades">
				select * from unidades_regionais   order by nome asc;
			</cfquery>
			<cfoutput query="unidades">
			<option value="#regionalID#"  >#nome#</option>
			</cfoutput>
			</select>
			</p>
			<p><h3>Nome:</h3><input type="text"  name="<cfoutput>#controllernomecampo#</cfoutput>.Nome" id="<cfoutput>#controllernomecampo#</cfoutput>Nome" class="text big" style="text-transform: uppercase;" value="" /> 
			</p>
			<p><h3>E-mail:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Email" id="<cfoutput>#controllernomecampo#</cfoutput>Email" class="text big" value="" /> (Será usado para login)
			</p>
			<p><h3>Senha:</h3><input type="password"  name="<cfoutput>#controllernomecampo#</cfoutput>.Senha" id="<cfoutput>#controllernomecampo#</cfoutput>Senha" class="text big" value="" /> 
			</p>
			<p><h3>CPF:</h3><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Cpf" id="<cfoutput>#controllernomecampo#</cfoutput>Cpf" class="text big" style="text-transform: uppercase;" value="" /> 
			</p>
			<p><h3>Perfil LPNA:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.PerfilLPNA" id="<cfoutput>#controllernomecampo#</cfoutput>PerfilLPNA"   class="styled">
           	<cfset grupos = "DECEA,EPTA,DIRSA,Ensino,Jurisdição,ASOCEA,SDOP,API" >
                <cfloop list="#grupos#" index="i">
                <cfoutput>
                   <option value="#i#">#i#</option>
                </cfoutput>
                </cfloop>
 			</select></p>
			
			<p><h3>Perfil SGPO:</h3><select name="<cfoutput>#controllernomecampo#</cfoutput>.PerfilSGPO" id="<cfoutput>#controllernomecampo#</cfoutput>PerfilSGPO"   class="styled">
			<cfquery datasource="#dsn#" name="perfis">
				select perfilID, tipo from sgpo_perfils where deleted is null order by perfilID asc;
			</cfquery>
			<cfoutput query="perfis">
			<option value="#perfis.perfilID#"  >#perfilID#-#tipo#</option>
			</cfoutput>
			</select></p>

			<hr>
			<input type="hidden" name="action" id="action" value="cad" />
			<input type="hidden" name="controller" id="controller" value="<cfoutput>#controllernomeplural#</cfoutput>" />
			<input type="hidden" name="pagina" id="pagina" value="1" />
			
			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>

	
			<p><input type="submit" class="submit small"  value="Cadastrar"  onClick="envia();"/>
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

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->




