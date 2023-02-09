<style>
.reduzido {
	background: none repeat scroll 0 0 #FEFEFE;
    border: 1px solid #BBBBBB;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-family: "Lucida Grande",Verdana,sans-serif;
    font-size: 14px;
    outline: medium none;
    padding: 7px;
    vertical-align: middle;
    width: 50px;
}
.menor {
	background: none repeat scroll 0 0 #FEFEFE;
    border: 1px solid #BBBBBB;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-family: "Lucida Grande",Verdana,sans-serif;
    font-size: 14px;
    outline: medium none;
    padding: 7px;
    vertical-align: middle;
    width: 50px;
}
</style>
<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="controller/<cfoutput>#controllernome#</cfoutput>controller.cfm" method="post" enctype="multipart/form-data" id="habilitacoesform" onSubmit="return false;">
			<cfquery datasource="#dsn#" name="setores">select *, ur.nome as regional, ss.nome as setor from unidades_regionais ur
				inner join unidades u on (u.unidadeID=ur.unidadeID #sqlRegionalID# #sqlUnidadeID#)
				inner join sgpo_setores ss on (ss.unidadeID=ur.unidadeID and ss.regionalID=ur.regionalID #sqlSetorID#)
				  where ur.deletedat is null order by ur.jurisdicao asc, ur.nome asc, ss.regiao asc;</cfquery>
			
			<p><h3>Setor/Região:</h3>
			<select name="<cfoutput>#controllernomecampo#</cfoutput>.SetorID" id="<cfoutput>#controllernomecampo#</cfoutput>SetorID"  class="styled required">				
			<cfloop query="setores">
			<cfif conteudoconsulta.setorID eq setorID>
			<option value="<cfoutput>#setorID#</cfoutput>" selected="selected"><cfoutput>#jurisdicao#-#regional#-#setor# #regiao#</cfoutput></option>
			<cfelse>
			<option value="<cfoutput>#setorID#</cfoutput>"><cfoutput>#jurisdicao#-#regional#-#setor# #regiao#</cfoutput></option>
			</cfif>
			</cfloop>
			</select>
			</p>			
			<cfset options=''>
			<cfloop from="0" to="20" index="i">
				<cfset options = options & '<option value="'& i & '">' & i &'</option>' >
			</cfloop>			
			

			<p><label>MOVIMENTO ANUAL</label><input type="text"  class="menor" name="<cfoutput>#controllernomecampo#</cfoutput>.Movimentoanual" id="<cfoutput>#controllernomecampo#</cfoutput>Movimentoanual"   value="<cfoutput>#conteudoconsulta.movimentoanual#</cfoutput>">
			</p>			
			<p><label>CARGA MENSAL (CM)</label><input type="text"  class="menor" name="<cfoutput>#controllernomecampo#</cfoutput>.Cargamensal" id="<cfoutput>#controllernomecampo#</cfoutput>Cargamensal"   value="<cfoutput>#conteudoconsulta.cargamensal#</cfoutput>">
			</p>			
			<p><label><b><u>1&deg;TURNO:</u></b></label>Consoles:<select name="<cfoutput>#controllernomecampo#</cfoutput>.Console01" id="<cfoutput>#controllernomecampo#</cfoutput>Console01" ><cfoutput>#options#</cfoutput><option value="<cfoutput>#conteudoconsulta.console01#</cfoutput>" selected="selected"><cfoutput>#conteudoconsulta.console01#</cfoutput></option></select> &nbsp;&nbsp;&nbsp;&nbsp;início:<input type="text"  class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Inicio01" id="<cfoutput>#controllernomecampo#</cfoutput>Inicio01"   value="<cfoutput>#timeformat(conteudoconsulta.inicio01,'HH:mm')#</cfoutput>">  término:<input type="text" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Fim01" id="<cfoutput>#controllernomecampo#</cfoutput>Fim01" value="<cfoutput>#timeformat(conteudoconsulta.fim01,'HH:mm')#</cfoutput>">  pico:<input type="checkbox" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Pico01" id="<cfoutput>#controllernomecampo#</cfoutput>Pico01" value="1" <cfif conteudoconsulta.pico01 eq 1 ><cfoutput> checked="checked"</cfoutput></cfif> >
			</p>
			<p><label><b><u>2&deg;TURNO:</u></b></label>Consoles:<select name="<cfoutput>#controllernomecampo#</cfoutput>.Console02" id="<cfoutput>#controllernomecampo#</cfoutput>Console02" ><cfoutput>#options#</cfoutput><option value="<cfoutput>#conteudoconsulta.console02#</cfoutput>" selected="selected"><cfoutput>#conteudoconsulta.console02#</cfoutput></option></select> &nbsp;&nbsp;&nbsp;&nbsp;início:<input type="text"  class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Inicio02" id="<cfoutput>#controllernomecampo#</cfoutput>Inicio02"   value="<cfoutput>#timeformat(conteudoconsulta.inicio02,'HH:mm')#</cfoutput>">  término:<input type="text" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Fim02" id="<cfoutput>#controllernomecampo#</cfoutput>Fim02" value="<cfoutput>#timeformat(conteudoconsulta.fim02,'HH:mm')#</cfoutput>">  pico:<input type="checkbox" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Pico02" id="<cfoutput>#controllernomecampo#</cfoutput>Pico02" value="1" <cfif conteudoconsulta.pico02 eq 1 ><cfoutput> checked="checked"</cfoutput></cfif> >
			</p>
			<p><label><b><u>3&deg;TURNO:</u></b></label>Consoles:<select name="<cfoutput>#controllernomecampo#</cfoutput>.Console03" id="<cfoutput>#controllernomecampo#</cfoutput>Console03" ><cfoutput>#options#</cfoutput><option value="<cfoutput>#conteudoconsulta.console03#</cfoutput>" selected="selected"><cfoutput>#conteudoconsulta.console03#</cfoutput></option></select> &nbsp;&nbsp;&nbsp;&nbsp;início:<input type="text"  class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Inicio03" id="<cfoutput>#controllernomecampo#</cfoutput>Inicio03"   value="<cfoutput>#timeformat(conteudoconsulta.inicio03,'HH:mm')#</cfoutput>">  término:<input type="text" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Fim03" id="<cfoutput>#controllernomecampo#</cfoutput>Fim03" value="<cfoutput>#timeformat(conteudoconsulta.fim03,'HH:mm')#</cfoutput>">  pico:<input type="checkbox" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Pico03" id="<cfoutput>#controllernomecampo#</cfoutput>Pico03" value="1" <cfif conteudoconsulta.pico03 eq 1 ><cfoutput> checked="checked"</cfoutput></cfif> >
			</p>
			<p><label><b><u>4&deg;TURNO:</u></b></label>Consoles:<select name="<cfoutput>#controllernomecampo#</cfoutput>.Console04" id="<cfoutput>#controllernomecampo#</cfoutput>Console04" ><cfoutput>#options#</cfoutput><option value="<cfoutput>#conteudoconsulta.console04#</cfoutput>" selected="selected"><cfoutput>#conteudoconsulta.console04#</cfoutput></option></select> &nbsp;&nbsp;&nbsp;&nbsp;início:<input type="text"  class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Inicio04" id="<cfoutput>#controllernomecampo#</cfoutput>Inicio04"   value="<cfoutput>#timeformat(conteudoconsulta.inicio04,'HH:mm')#</cfoutput>">  término:<input type="text" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Fim04" id="<cfoutput>#controllernomecampo#</cfoutput>Fim04" value="<cfoutput>#timeformat(conteudoconsulta.fim04,'HH:mm')#</cfoutput>">  pico:<input type="checkbox" class="reduzido" name="<cfoutput>#controllernomecampo#</cfoutput>.Pico04" id="<cfoutput>#controllernomecampo#</cfoutput>Pico04" value="1" <cfif conteudoconsulta.pico04 eq 1 ><cfoutput> checked="checked"</cfoutput></cfif> >
			</p>
			<hr>
			<input type="hidden" name="<cfoutput>#controllernomecampo#</cfoutput>.CgnaID" id="<cfoutput>#controllernomecampo#</cfoutput>CgnaID" value="<cfoutput>#conteudoconsulta.CgnaID#</cfoutput>" />
			<input type="hidden" name="action" id="action" value="edit" />
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
    .redborder { border: 1px solid red; }
    </style>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

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
 

var goodNumber = /^(\+|-)?((\d+(\.\d+)?)|(\.\d+))$/
var goodPrefix = /^(\+|-)?((\d*(\.?\d*)?)|(\.\d*))$/
    
$('input')
    .data("oldValue",'')
    .bind('input propertychange', function() {
        var $this = $(this);
        var newValue = $this.val();
        
        if ( !goodPrefix.test(newValue) )
            return $this.val($this.data('oldValue'));
        if ( goodNumber.test(newValue) )
            $this.removeClass("redborder");
        else
            $this.addClass("redborder");
        
        return $this.data('oldValue',newValue)
    });
    
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
		
           $(".reduzido").mask("29:59");
           $("#CgnaCargamensal").mask("999");
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


