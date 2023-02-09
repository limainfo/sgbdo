<cfoutput><span style="align:left;float:left;size:10px;font-size:8px;">Anexo C - CIRCEA 100-51/2010 - Página 15 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;"></div></span><span style="float:right;margin:0px;background-color:red;color:white;" onclick="$('##fichaavaliacaoestagiario').hide('slow');">FECHAR</span><br></cfoutput>

<cfoutput><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anexo A</title>
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

<body class="corpo">
<p align="center" class="titnum"><b><u>##orgaoregional##</u></b></p>
<p align="center" class="titnumb"><b>DIVISÃO DE OPERAÇÕES</b></p>
<p align="center" class="titnum">SUBDIVISÃO DE GERENCIAMENTO DE TRÁFEGO AÉREO</p>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" colspan="6" ><div align="center" ><b>FICHA DE ACOMPANHAMENTO DIÁRIO</b></div></th>
  </tr>
  <tr>
    <td scope="col" class="borda" width="20%" ><div align="left"><b>POSIÇÃO OPERACIONAL:</b></div></td>
    <td scope="col" class="borda" width="20%" ><div align="left" class="txtbd"><select name="anexocposicao"><option value=""></option><option value="ASSISTENTE">ASSISTENTE</option><option value="CONTROLE">CONTROLE</option></select></div></td>
    <td scope="col" class="borda" width="15%" ><div align="left"><b>SETOR AVALIADO:</b></div></td>
    <td scope="col" class="borda" width="15%" ><div align="left" class="txtbd"><input type="text" name="anexocsetoravaliado" value=""></div></td>
    <td scope="col" class="borda" width="15%" ><div align="left"><b>TEMPO NA POSIÇÃO:</b></div></td>
    <td scope="col" class="borda" width="15%" ><div align="left" class="txtbd"><input type="text" name="anexocsetortempo" value=""></div></td>
  </tr>
</table><br>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" colspan="3" ><div align="center" ><b>FICHA DE AVALIAÇÃO PRÁTICA</b></div></th>
  </tr>
  <tr>
    <td scope="col" class="borda" width="15%" ><div align="left"><b>AVALIADOR (A):</b></div></td>
    <td scope="col" class="borda" width="50%" ><div align="left" class="txtbd">##avaliador##</div></td>
    <td scope="col" class="borda" width="35%" ><div align="left"><b>FINALIDADE:</b></div><div align="left" class="txtbd">##funcao##</div></td>
  </tr>
  <tr>
    <td scope="col" class="borda" width="15%" ><div align="left" ><b>AVALIADO (A):</b></div></td>
    <td scope="col" class="borda" width="50%" ><div align="left" class="txtbd">##avaliado##</div></td>
    <td scope="col" class="borda" width="35%" ><div align="left" ><b>LICENÇA:</b></div><div align="left" class="txtbd">##nrlicenca##</div></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td scope="col" class="borda" width="50%" ><div style="float:left;margin:0px;"><b>ÓRGÃO/SETOR:</b>##setor##</div></td>
    <td scope="col" class="borda" width="50%" ><div style="float:left;margin:0px;"><b>LOCAL E DATA:</b>##data##</div><div style="border:1px solid black;background:##BDF3EC;color:black;text-align:right;margin:0px;align:right;float:right; "><input type="checkbox" value="1" name="ativarDicas" checked="checked" id="ativarDicas" class="text small" >Ativar DICAS</div></td>
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
<cfquery name="c" datasource="lpna">
select anexo, item, documento,  count(*) qtd from sgpo_anexos group by anexo,item,documento order by documento asc,anexo asc, item asc 
</cfquery>
<cfoutput query="c">
<cfquery name="r" datasource="lpna">
select * from sgpo_anexos where documento='#c.documento#' and anexo='#c.anexo#' and item='#c.item#' order by sequenciaitem asc 
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
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="O" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicaotimo')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="B" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicabom')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="R" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicaregular')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="NS" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicanaosatisfatorio')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  checked="checked" name="i#r.anexoID#" value="NA" /></div></td>
  </tr> 
  <cfset controle=-1>
  <cfelse>
  <tr onmouseover="$(this).css({'background-color':'##AFECEB'});" onmouseout="$(this).css({'background-color':'##ffffff'});">
    <td width="55%" class="borda"><div align="left">#r.itemavaliado#</div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="O" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicaotimo')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="B" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicabom')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="R" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicaregular')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  name="i#r.anexoID#" value="NS" onmouseover="var obj=$(this);exibeDica(obj,'#r.anexoID#','dicanaosatisfatorio')" /></div></td>
    <td width="4%" class="borda"><div align="center"><input type="radio"  checked="checked" name="i#r.anexoID#" value="NA" /></div></td>
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


<p align="center" class="style2">&nbsp;</p>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" ><div align="center" ><b>COMENTÁRIOS</b></div></th>
  </tr>
  <tr>
    <td scope="col" class="borda" >	<textarea style="width:100%;height:20%;background-color:##E7F0B9;" name="AnexosDicaareaavaliada" id="AnexosDicaareaavaliada" ></textarea>
</td>
  </tr>
</table>
<br><br>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td scope="col"><div align="center" ><b></b></div></td>
    <td scope="col"><div align="center" ><b></b></div></td>
    <td scope="col"><div align="center" ><input type="button" value="Assinatura Avaliador" name="avaliador" ><i><u>##avaliador##</u></i></div></td>
  </tr>
  <tr>
    <td scope="col"><div align="center" ><b>AVALIADO(A)</b></div></td>
    <td scope="col"><div align="center" ><input type="button" value="Assinatura Instrução" name="instrucao" ><i><u>##instrucao##</u></i></div></td>
    <td scope="col"><div align="center" ><b>AVALIADOR(A)</b></div></td>
  </tr>
  <tr>
    <td scope="col"><div align="center" ></div></td>
    <td scope="col"><div align="center" ><b>CHEFE DO ÓRGÃO</b></div></td>
    <td scope="col"><div align="center" ></div></td>
  </tr>
</table>
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

<script>
	$(function() {
        $( "#dica" ).draggable();
       
    });

function exibeDica(obj, id, tipo){
  if($('#ativarDicas:checkbox:checked').val() == 1){
  posicao = obj.position();
  var parametros = {'controller':'fichas','action':'dica','id':id, 'tipo':tipo};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/habilitacaocontroller.cfm',
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
</script>




