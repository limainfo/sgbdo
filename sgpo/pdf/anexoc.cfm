<cfheader name="Content-Disposition" value="inline; filename=anexoc.pdf">
<cfdocument pagetype="a4" format="pdf" >
<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Anexo C - CIRCEA 100-51/2010 - Página 15 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
</cfdocumentitem>
<cfoutput><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anexo C</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: black;
	border: none;
}
table {
	margin-top:0px;
}
body {
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
<cfquery datasource="#dsn#" name="fichas">
	select *, se.nome estagiario, hs.habilitacao habilidade from sgpo_fichas sf
	inner join root_usuarios ru on (ru.usuarioID=sf.assinaturainstrutor)
	inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID)
	inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID)
	where sf.fichaID=<cfqueryparam  value="#url.id#" cfsqltype="cf_sql_char"> 
	and sf.deleted is null
	order by sf.dtavaliacao asc
</cfquery>
<body>
<p align="center" class="titnum"><b><u>##orgaoregional##</u></b></p>
<p align="center" class="titnumb"><b>DIVISÃO DE OPERAÇÕES</b></p>
<p align="center" class="titnum">SUBDIVISÃO DE GERENCIAMENTO DE TRÁFEGO AÉREO</p>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" colspan="3" ><div align="center" ><b>FICHA DE AVALIAÇÃO PRÁTICA</b></div></th>
  </tr>
  <tr>
    <td scope="col" class="borda" width="15%" ><div align="left"><b>AVALIADOR (A):</b></div></td>
    <td scope="col" class="borda" width="50%" ><div align="left" class="txtbd">#fichas.nome#</div></td>
    <td scope="col" class="borda" width="35%" ><div align="left"><b>FINALIDADE:</b></div><div align="left" class="txtbd">#fichas.habilidade#</div></td>
  </tr>
  <tr>
    <td scope="col" class="borda" width="15%" ><div align="left" ><b>AVALIADO (A):</b></div></td>
    <td scope="col" class="borda" width="50%" ><div align="left" class="txtbd">#fichas.estagiario#</div></td>
    <td scope="col" class="borda" width="35%" ><div align="left" ><b>LICENÇA:</b></div><div align="left" class="txtbd">##nrlicenca##</div></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td scope="col" class="borda" width="50%" ><div style="float:left;margin:0px;"><b>ÓRGÃO/SETOR:</b>#fichas.setor#</div></td>
    <td scope="col" class="borda" width="50%" ><div style="float:left;margin:0px;"><b>LOCAL E DATA:</b>#dateformat(fichas.dtavaliacao,'dd-mm-yyyy')#</div></td>
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
<cfscript>
qtdotimo = 0;
qtdbom =0;
qtdregular = 0;
qtdnaosatisfatorio = 0;
qtdnaoavaliado = 0;
</cfscript>
<cfquery name="c" datasource="lpna">
select *, count(*) as qtd from sgpo_anexos sa
inner join sgpo_fichaanexos sf on (sf.anexoID=sa.anexoID and sf.fichaID=<cfqueryparam  value="#url.id#" cfsqltype="cf_sql_char"> )
 group by anexo,item,documento order by documento asc,anexo asc, item asc 
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
  <tr>
    <td width="5%" class="borda" rowspan="#c.qtd#"><div align="center">#r.item#</div></td>
    <td width="20%" class="borda" rowspan="#c.qtd#"><div align="center">#r.areaavaliada#</div></td>
    <td width="55%" class="borda"><div align="left">#r.itemavaliado#</div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.otimo eq 1 ><cfset qtdotimo=qtdotimo+1><img src="./images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.bom eq 1 ><cfset qtdbom=qtdbom+1><img src="./images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.regular eq 1 ><cfset qtdregular=qtdregular+1><img src="./images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.naosatisfatorio eq 1 ><cfset qtdnaosatisfatorio=qtdnaosatisfatorio+1><img src="./images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.naoatribuido eq 1 ><cfset qtdnaoavaliado=qtdnaoavaliado+1><img src="./images/marcado.gif"></cfif></div></td>
  </tr> 
  <cfset controle=-1>
  <cfelse>
  <tr>
    <td width="55%" class="borda"><div align="left">#r.itemavaliado#</div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.otimo eq 1 ><cfset qtdotimo=qtdotimo+1><img src="./images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.bom eq 1 ><cfset qtdbom=qtdbom+1><img src="./images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.regular eq 1 ><cfset qtdregular=qtdregular+1><img src="images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.naosatisfatorio eq 1 ><cfset qtdnaosatisfatorio=qtdnaosatisfatorio+1><img src="./images/marcado.gif"></cfif></div></td>
    <td width="4%" class="borda"><div align="center"><cfif c.naoatribuido eq 1 ><cfset qtdnaoavaliado=qtdnaoavaliado+1><img src="./images/marcado.gif"></cfif></div></td>
  </tr>
</cfif>  
</cfloop>
</table>
</cfoutput>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="50%" class="borda"><div align="left"><span style="font-size:8px;margin:0px;float:left;spacing:0px;">O = Ótimo / B = Bom / R = Regular / NS = Não Satisfatório / NA = Não Avaliado</span></td>
    <td width="30%" class="borda"><div style="float:right;margin:0px;font-weight:bold;">TOTAL DE ITENS AVALIADOS</div></td>
    <td width="4%" class="borda"><div align="center">#qtdotimo#</div></td>
    <td width="4%" class="borda"><div align="center">#qtdbom#</div></td>
    <td width="4%" class="borda"><div align="center">#qtdregular#</div></td>
    <td width="4%" class="borda"><div align="center">#qtdnaosatisfatorio#</div></td>
    <td width="4%" class="borda"><div align="center">#qtdnaoavaliado#</div></td>
  </tr> 
</table>


<p align="center" class="style2">&nbsp;</p>
<cfdocumentitem type="pagebreak">
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="borda" ><div align="center" ><b>COMENTÁRIOS</b></div></th>
  </tr>
<cfloop index="i" from="1" to="30" step="1">  
  <tr>
    <td scope="col" class="borda" ><div align="left">&nbsp;</div></td>
  </tr>
 </cfloop>
</table>
<br><br>
<cfquery datasource="#dsn#" name="avaliacao">
	select *, se.nome estagiario from sgpo_fichas sf
	inner join root_usuarios ru on (ru.usuarioID=sf.assinaturainstrucao)
	inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID)
	where sf.fichaID=<cfqueryparam  value="#url.id#" cfsqltype="cf_sql_char"> 
	and sf.deleted is null
	order by sf.dtavaliacao asc
</cfquery>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td scope="col"><div align="center" ><i><u>#fichas.estagiario#</u></i></div></td>
    <td scope="col"><div align="center" ><b></b></div></td>
    <td scope="col"><div align="center" ><i><u>#fichas.nome#</u></i></div></td>
  </tr>
  <tr>
    <td scope="col"><div align="center" ><b>AVALIADO(A)</b></div></td>
    <td scope="col"><div align="center" ><i><u>#avaliacao.nome#</u></i></div></td>
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







</cfdocument>
