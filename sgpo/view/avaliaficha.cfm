<cfoutput><span style="align:left;float:left;size:10px;font-size:8px;">Anexo C - CIRCEA 100-51/2010 - Página 15 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;"></div></span><span style="float:right;margin:0px;background-color:red;color:white;" ></span><br></cfoutput>
<cfif len(conteudoconsulta.assinaturainstrutor) gt 6>
	<cfset instrutorOK = 1 >
	<cfset leitura=' readonly="readonly"' >
	<cfset chkbox=' disabled="disabled"' >
	<cfelse>
	<cfset instrutorOK = 0 >
	<cfset leitura='' >
	<cfset chkbox='' >
</cfif>
<cfif len(conteudoconsulta.assinaturainstrucao) gt 6>
	<cfset instrucaoOK = 1 >
	<cfelse>
	<cfset instrucaoOK = 0 >
</cfif>
<cfoutput>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
.corpo {
	border: none;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: black;
	background: none repeat scroll 0 0 white;
	width:100%;
	height: 100%;
}
.corpo td, th, tr {
	border: none;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: black;
	background-color:white;
}

.corpo tr:hover td {
	background: none repeat scroll 0 0 yellow;
}
.corpo table {
	margin-top:0px;
}
.corpo body {
	margin-top: 0px;
}
.cabecalho {
	font-size: 16px;
	font-weight: bold;
	padding: 0 0 0 0;
	margin-top: 0px;
	margin-bottom: 0px;
	border:1px ##000000;
 }
.titulo {
	font-size: 16px;
	font-weight: bold;
	padding: 0 0 0 0;
	margin-top: 0px;
	margin-bottom: 0px;
 }
.titnumb {
	font-size: 12px;
	font-weight: bold;
	margin: 0px;
 }
.titnum {
	font-size: 12px;
	margin: 0px;
 }
.borda {
	border:1px ##000000;
	border-style:solid;
}
.bordamaior {
	border:2px ##000000;
}
.txthead {
	font-size: 12px;
	font-weight: bold;
}
.txtin {
	font-size: 10px;
}
.txtbd {

}
-->
</style>
</head>

<body >
<form accept-charset="utf-8" method="post" id="formaltura" enctype="multipart/form-data"  action="controller/<cfoutput>#controllernome#</cfoutput>controller.cfm" onsubmit="return false;" >
<p align="right" class="titnum"><b><u><a href="?d=<cfoutput>#form.id#</cfoutput>&i=pdf&nome=fichaanexoc"><img src="images/printer.png"></a> </u></b></p>
<p align="center" class="titnum"><b><u><cfoutput>#conteudoconsulta.jurisdicao#</cfoutput></u></b></p>
<p align="center" class="titnumb"><b>DIVISÃO DE OPERAÇÕES</b></p>
<p align="center" class="titnum">SUBDIVISÃO DE GERENCIAMENTO DE TRÁFEGO AÉREO</p>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" colspan="8" ><div align="center" ><b>FICHA DE ACOMPANHAMENTO DIÁRIO</b></div></th>
  </tr>
  <tr>
    <td scope="col" class="borda" width="20%" ><div align="left"><b>POSIÇÃO OPERACIONAL:</b></div></td>
    <td scope="col" class="borda" width="20%" ><div align="left" class="txtbd"><select name="<cfoutput>#controllernomecampo#</cfoutput>.Posicao" id="<cfoutput>#controllernomecampo#</cfoutput>Posicao" >
    <cfif leitura eq ''>
    <option value=""></option><option value="ASSISTENTE">ASSISTENTE</option>
    <option value="CONTROLE">CONTROLE</option>
    <option value="INSTRUTOR">INSTRUTOR</option>
    <option value="SUPERVISOR">SUPERVISOR</option>
    </cfif>
    <option value="#conteudoconsulta.posicao#" selected="selected">#conteudoconsulta.posicao#</option>
    </select></div></td>
    <td scope="col" class="borda" width="15%" ><div align="left"><b>SETOR AVALIADO:</b></div></td>
    <td scope="col" class="borda" width="15%" ><div align="left" class="txtbd"><input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Setor" id="<cfoutput>#controllernomecampo#</cfoutput>Setor" value="#conteudoconsulta.setor#" #leitura# ></div></td>
	<cfif not len(conteudoconsulta.documento) gt 6 ><cfset largura="8%" ><cfelse><cfset largura="15%" ></cfif>
    <td scope="col" class="borda" width="#largura#" ><div align="left"><b>TEMPO NA POSIÇÃO:</b></div></td>
    <td scope="col" class="borda" width="#largura#" ><div align="left" class="txtbd">
		<input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Tempototal" id="<cfoutput>#controllernomecampo#</cfoutput>Tempototal" value="#conteudoconsulta.tempototal#" size="5" #leitura#>
	(horas)</div></td>
<cfif not len(conteudoconsulta.documento) gt 6 >
    <td scope="col" class="borda" width="#largura#" ><div align="left"><b>RENDIMENTO:</b></div></td>
    <td scope="col" class="borda" width="#largura#" ><div align="left" class="txtbd">
		<input type="text" name="<cfoutput>#controllernomecampo#</cfoutput>.Rendimento" id="<cfoutput>#controllernomecampo#</cfoutput>Rendimento" value="#conteudoconsulta.rendimento#" size="5"  #leitura#>
</cfif>
	</td>
  </tr>
</table><br>
<cfif len(conteudoconsulta.documento) gt 6 >

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" colspan="3" ><div align="center" ><b>FICHA DE AVALIAÇÃO PRÁTICA</b></div></th>
  </tr>
  <tr>
    <td scope="col" class="borda" width="15%" ><div align="left"><b>AVALIADOR (A):</b></div></td>
    <td scope="col" class="borda" width="50%" ><div align="left" class="txtbd"><cfoutput>#ucase(u.nome)#</cfoutput></div></td>
    <td scope="col" class="borda" width="35%" ><div align="left"><b>FINALIDADE:</b></div><div align="left" class="txtbd"><cfoutput>#conteudoconsulta.habilitacao#</cfoutput></div></td>
  </tr>
  <tr>
    <td scope="col" class="borda" width="15%" ><div align="left" ><b>AVALIADO (A):</b></div></td>
    <td scope="col" class="borda" width="50%" ><div align="left" class="txtbd"><cfoutput>#conteudoconsulta.nome#</cfoutput></div></td>
    <td scope="col" class="borda" width="35%" ><div align="left" ><b>LICENÇA:</b></div><div align="left" class="txtbd"><cfoutput>#conteudoconsulta.licenca#</cfoutput></div></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td scope="col" class="borda" width="50%" ><div style="float:left;margin:0px;"><b>ÓRGÃO/SETOR:</b><cfoutput>#conteudoconsulta.nomesetor#</cfoutput></div></td>
    <td scope="col" class="borda" width="50%" ><div style="float:left;margin:0px;"><b>LOCAL E DATA:</b><cfoutput>#dateformat(conteudoconsulta.dtavaliacao,'dd-mm-yyyy')#</cfoutput></div><div style="border:1px solid black;background:##BDF3EC;color:black;text-align:right;margin:0px;align:right;float:right; "><input type="checkbox" value="1" name="ativarDicas" id="ativarDicas" class="text small" #chkbox#>Ativar DICAS</div></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="5%" class="borda"><div align="center"><b>ITEM</b></div></td>
    <td width="20%" class="borda"><div align="center"><b>ÁREA AVALIADA</b></div></td>
    <td width="55%" class="borda"><div align="center"><b>ITENS A SEREM AVALIADOS</b></div></td>
    <td width="4%" class="borda"><div align="center"><b>O</b></div></td>
    <td width="4%" class="borda"><div align="center"><b>B</b></div></td>
    <td width="4%" class="borda"><div align="center"><b>R</b></div></td>
    <td width="4%" class="borda"><div align="center"><b>NS</b></div></td>
    <td width="4%" class="borda"><div align="center"><b>NA</b></div></td>
  </tr>
</table>
<cfquery name="c" datasource="#dsn#">
select sa.anexo, sa.item, sa.documento,  count(*) qtd from sgpo_anexos sa
inner join sgpo_fichaanexos sfa on (sfa.anexoID=sa.anexoID and sfa.fichaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">)
inner join sgpo_fichas sf on (sf.fichaID=sfa.fichaID)
group by sa.anexo,sa.item,sa.documento order by sa.documento asc,sa.anexo asc, sa.item asc 
</cfquery>
<cfoutput query="c">
<cfquery name="r" datasource="#dsn#">
select sa.*, sa.documento as documento, sf.*, sfa.* from sgpo_anexos sa
inner join sgpo_fichaanexos sfa on (sfa.anexoID=sa.anexoID and sfa.fichaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">)
inner join sgpo_fichas sf on (sf.fichaID=sfa.fichaID)
 where sa.documento='#c.documento#' and sa.anexo='#c.anexo#' and sa.item='#c.item#' 
order by sa.sequenciaitem asc  
</cfquery>
<cfset controle=1 >
<cfset c.qtd=c.qtd+1 >
<cfloop query="r">
<cfif controle eq 1>
	
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr onmouseover="$(this).css({'background-color':'##AFECEB'});" onmouseout="$(this).css({'background-color':'##ffffff'});">
    <td width="5%" class="borda" rowspan="#c.qtd#"><div align="center">#r.item#</div></td>
    <td width="20%" class="borda" rowspan="#c.qtd#"><div align="center">#r.areaavaliada#</div></td>
    <td width="55%" class="borda"><div align="left">#r.itemavaliado#</div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"  id="oo#r.anexoID#" name="n#r.anexoID#" value="#r.fichaID#" <cfscript>if (r.otimo gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"   id="bb#r.anexoID#"    name="n#r.anexoID#" value="#r.fichaID#" <cfscript>if (r.bom gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"    id="rr#r.anexoID#"    name="n#r.anexoID#" value="#r.fichaID#"   <cfscript>if (r.regular gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"    id="ns#r.anexoID#"   name="n#r.anexoID#" value="#r.fichaID#"  <cfscript>if (r.naosatisfatorio gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"   id="na#r.anexoID#"    name="n#r.anexoID#" value="#r.fichaID#"   <cfscript>if (r.naoatribuido gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox# /></div></td>
  </tr> 
  <cfset controle=-1>
  <cfelse>
  <tr onmouseover="$(this).css({'background-color':'##AFECEB'});" onmouseout="$(this).css({'background-color':'##ffffff'});">
    <td width="55%" class="borda"><div align="left">#r.itemavaliado#</div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"   id="oo#r.anexoID#"   name="n#r.anexoID#" value="#r.fichaID#" <cfscript>if (r.otimo gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"   id="bb#r.anexoID#"   name="n#r.anexoID#" value="#r.fichaID#"<cfscript>if (r.bom gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"   id="rr#r.anexoID#"    name="n#r.anexoID#" value="#r.fichaID#"  <cfscript>if (r.regular gt 0){WriteOutput(' checked="checked"');}</cfscript> #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"   id="ns#r.anexoID#"   name="n#r.anexoID#" value="#r.fichaID#"  <cfscript>if (r.naosatisfatorio gt 0){WriteOutput(' checked="checked"');}</cfscript>  #chkbox#/></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio" class="personalizado"   id="na#r.anexoID#"   name="n#r.anexoID#" value="#r.fichaID#"  <cfscript>if (r.naoatribuido gt 0){WriteOutput(' checked="checked"');}</cfscript> name="i#r.anexoID#" value="1"  #chkbox#/></div></td>
  </tr>
</cfif>  
</cfloop>
</table>
</cfoutput>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="50%" class="borda"><div align="left"><span style="font-size:8px;margin:0px;float:left;spacing:0px;">O = Ótimo / B = Bom / R = Regular / NS = Não Satisfatório / NA = Não Avaliado</span></td>
    <td width="30%" class="borda"><div style="float:right;margin:0px;font-weight:bold;">TOTAL DE ITENS AVALIADOS</div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
  </tr> 
</table>

</cfif>
<p align="center" class="style2">&nbsp;</p>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" ><div align="center" ><b>COMENTÁRIOS</b></div></th>
  </tr>
  <tr>
    <td scope="col" class="borda" >	<textarea style="width:100%;height:20%;background-color:##E7F0B9;" name="<cfoutput>#controllernomecampo#</cfoutput>.Obs" id="<cfoutput>#controllernomecampo#</cfoutput>Obs" #leitura#><cfoutput>#conteudoconsulta.obs#</cfoutput></textarea>
</td>
  </tr>
</table>
<br><br>
			<input type="hidden" name="<cfoutput>#controllernomecampo#</cfoutput>.FichaID" id="<cfoutput>#controllernomecampo#</cfoutput>FichaID" value="#conteudoconsulta.fichaID#" />
	<div class="block">
			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;"></div>
	</div>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td scope="col"><div align="center" ><b><cfoutput>#conteudoconsulta.nome#</cfoutput></b></div></td>
    <td scope="col"><div align="center" ><b></b></div></td>
    <td scope="col"><div align="center" ><div id='referencia' style="position:relative;"></div>
	  <cfquery datasource="#dsn#" name="nomeinstrutor">
		  select * from root_usuarios  where usuarioID='#conteudoconsulta.assinaturainstrutor#'
	  </cfquery>
	<cfif instrutorOK eq 0>
		<cfif u.tipo eq 'ADMINISTRADOR' or u.tipo eq 'INSTRUÇÃO' or u.tipo eq 'INSTRUTOR' >
		<div id='localassinaturainstrutor'>
			<input type="button" value="<cfoutput>#ucase(u.nome)#</cfoutput>" id="<cfoutput>#controllernomecampo#</cfoutput>Assinaturainstrutor" name="Assinaturainstrutor" >
		</div>
		</cfif>
		<cfelse>
		<cfoutput>#nomeinstrutor.nome#-#nomeinstrutor.cpf#</cfoutput>
	</cfif>    
    </div></td>
  </tr>
  <tr>
    <td scope="col"><div align="center" ><b>AVALIADO(A)</b></div></td>
    <td scope="col"><div align="center" >
	  <cfquery datasource="#dsn#" name="nomeinstrucao">
		  select * from root_usuarios where usuarioID='#conteudoconsulta.assinaturainstrucao#'
	  </cfquery>
	<cfif instrucaoOK eq 0>
		<cfif u.tipo eq 'ADMINISTRADOR' or u.tipo eq 'INSTRUÇÃO' or u.tipo eq 'INSTRUTOR' >
		<div id='localassinaturainstrucao'>
			<input type="button" value="<cfoutput>#ucase(u.nome)#</cfoutput>" name="Assinaturainstrucao"  id="<cfoutput>#controllernomecampo#</cfoutput>Assinaturainstrucao"  >
		</div>
		</cfif>
		<cfelse>
		<cfoutput>#nomeinstrucao.nome#-#nomeinstrucao.cpf#</cfoutput>
	</cfif>    
		
		</div></td>
    <td scope="col"><div align="center" ><b>AVALIADOR(A)</b></div></td>
  </tr>
  <tr>
    <td scope="col"><div align="center" ></div></td>
    <td scope="col"><div align="center" ><b>CHEFE DO ÓRGÃO</b></div></td>
    <td scope="col"><div align="center" ></div></td>
  </tr>
</table>
</form>

</body>
</html>
</cfoutput>
<style>
#dica {width:35%;height:auto;background-color:#ffffff;margin:0px;display:none;position:absolute;z-index:10;}
#dicatitulo {width:100%;background-color:#008080;border:1px solid black; margin:0px; color:white; text-align:center; font-weight:strong; word-wrap:break-word;}
#dicaconteudo {width:100%;background-color: white;border:1px solid black;margin:0px;color:black;text-align:center;  word-wrap:break-word;}
</style>
<div id="dica" >
	<div id="dicatitulo">
	Este é o título de teste<span style="float:right;margin:0px;" onclick="$('#dica').hide('slow');">X</span>
	</div>
	<div id="dicaconteudo">
	Este é  o conteúdo da div.
	
	</div>
</div>
<cfif instrucaoOK eq 0>
<script>
$('#erro').hide();
$('.mensagensform').hide();
$(function() {
	$( "#dica" ).draggable();
});

function exibeDica(obj, id, tipo){
  if(($('#ativarDicas:checkbox:checked').val() == 1)&&(tipo!='dicanaoatribuido')){
  posicao = obj.position();
  var parametros = {'controller':'fichas','action':'dicaficha','id':id, 'tipo':tipo};
  var dados = parametros;
  
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(dados) {
	  registros = eval('('+dados+')');
	  titulo = registros.DATA['areaavaliada'][0];
	  conteudo = registros.DATA['dicaareaavaliada'][0];
      conteudo = $("#dicaconteudo").html(conteudo).text();
	  
	  //alert(conteudo);
	  conteudo = conteudo + registros.DATA[tipo][0];
	  $("#dicatitulo").attr('style','background-color:#008080;border:1px solid black;color: white;margin:0;text-align:center;width:100%;word-wrap:break-word;');
      $("#dicatitulo").html(titulo+'<span style="float:right;margin:0px;" onclick="$(\'#dica\').hide(\'slow\');">X</span>');
      $("#dicaconteudo").html(conteudo);
	  $('#dica').css({'left':posicao.left-($('#dica').width()+5),'top':posicao.top});
      $('#dica').show('slow');       
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'json',
    contentType: 'application/x-www-form-urlencoded'
  });
}
}
function marca(idanexo, idficha, obj, tipo){
  var parametros = {'controller':'fichas','action':'marcaficha','fichaID':idficha, 'anexoID':idanexo, 'tipo':tipo};
  var dados = parametros;
  posicao = obj.position();
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(dados) {
	  registros = eval('('+dados+')');
	  status = registros['status'];
	  mensagem = registros['mensagem'];
      conteudo = $("#dicaconteudo").html(mensagem).text();
	  if(status!='OK'){
		  $("#dicatitulo").attr('style','background-color:#800000;border:1px solid black;color: white;margin:0;text-align:center;width:100%;word-wrap:break-word;');
		  $("#dicatitulo").html(status+'<span style="float:right;margin:0px;" onclick="$(\'#dica\').hide(\'slow\');">X</span>');
		  $("#dicaconteudo").html(conteudo);
		  $('#dica').css({'left':posicao.left-($('#dica').width()+5),'top':posicao.top});
			  
		  $('#dica').show('slow');       
		  obj.attr('style','background-color:green;');       
		}
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'json',
    contentType: 'application/x-www-form-urlencoded'
  });

}
  
$("form input:radio").change(function() {
	var tipo=this.id.substring(0,2);
	var coluna ='';
	var campo='';
	switch(tipo){
		case 'oo':	campo='dicaotimo';coluna='otimo';break;
		case 'bb':	campo='dicabom';coluna='bom';break;
		case 'rr':	campo='dicaregular';coluna='regular';break;
		case 'ns':	campo='dicanaosatisfatorio';coluna='naosatisfatorio';break;
		case 'na':	campo='dicanaoatribuido';coluna='naoatribuido';break;
	}
	var obj=$(this);
	<cfif leitura eq '' >
	exibeDica(obj,this.id.substring(2),campo);
	marca(this.id.substring(2),this.value, obj, coluna); 
	</cfif>
	
});

</script>
<cfparam name="complemento" default="">
<cfif not len(conteudoconsulta.documento) gt 6 ><cfset complemento = ", 'rendimento':$('##"&controllernomecampo&"Rendimento').val()"></cfif>
<script type="text/javascript">
//<![CDATA[



function envia(objeto, controle, setor, obs, fichaID, usuarioID, tempototal) {
  var parametros = {'controller':'fichas', 'action':'assinaficha', 'tipo':objeto.attr('name'), 'ficha':fichaID, 'assinatura':usuarioID, 'tempototal':tempototal, 'posicao':controle,'setor':setor, 'obs':obs <cfoutput>#complemento#</cfoutput> };
  posicao = objeto.offset();
  var dados = parametros;
 $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/<cfoutput>#controllernome#</cfoutput>controller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(dados) {
	  registros = dados;
	  status = registros['status'];
	  mensagem = registros['mensagemstatus'];
      
	  $('.mensagensform').html('<div class=\'message errormsg\' id=\'erro\' ><p id=\'txterroform\'></p><span title=\'Dismiss\' class=\'close\' onclick="$(\'.mensagensform\').hide(\'slow\');"></span></div>');
		  if(status=='ERRO'){
				$("#txterroform").html(mensagem);
				$('.mensagensform').show('bounce');       
				$('#erro').show('bounce');       
			}else{
				alert('Ficha assinada com sucesso!');
				location.reload();
			}
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'json',
    contentType: 'application/x-www-form-urlencoded'
  });  
 
 }
 $("form input:button").click(function() {
 	var obj=$(this);
 	var controle = $('#<cfoutput>#controllernomecampo#</cfoutput>Posicao').val();
 	var setor = $('#<cfoutput>#controllernomecampo#</cfoutput>Setor').val();
 	var obs = $('#<cfoutput>#controllernomecampo#</cfoutput>Obs').val();
 	var fichaID = $('#<cfoutput>#controllernomecampo#</cfoutput>FichaID').val();
 	var usuarioID = '<cfoutput>#u.usuarioID#</cfoutput>';
 	var tempototal = $('#<cfoutput>#controllernomecampo#</cfoutput>Tempototal').val();
 	envia(obj, controle, setor, obs, fichaID, usuarioID, tempototal);
});

//]]>
</script>
</cfif>
