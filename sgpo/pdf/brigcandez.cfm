<cfheader name="Content-Disposition" value= "inline; filename=RELATORIOCANDEZ.pdf" >
<cfdocument pagetype="a4" format="pdf" mimetype="image/jpeg" orientation="landscape" >

<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;"><div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
</cfdocumentitem>

<cfdocumentitem type="footer">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">SGPO - <b>Versão 1.0</b> - Desenvolvedor: <i>limainfo@gmail.com</i>  10/2012                                  Emitido em:#dateformat(now(),'dd-mm-yyyy')# #timeformat(now(),'HH:mm:ss')#</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</cfoutput>
</cfdocumentitem>

<cfoutput><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Efetivos ATC</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 6px;
	color: black;
	border: none;
}
body {
	margin-top: 0px;
}
.titulo {
	font-size: 10px;
	font-weight: bold;
	padding: 0 0 0 0;
	margin-top: 0px;
	margin-bottom: 0px;
 }
.titnum {
	font-size: 10px;
	margin: 0.1cm;
 }
.borda {
	border:1px ##000000;
}
.ctitulo {
	background-color:##A3F4F9;
}
.cene {
	color:##8B0D51;
}
.centro {
	text-align:center;
	font-weight:bold;
}
.bordamaior {
	border:2px ##000000;
}
.txthead {
	font-size: 6px;
	font-weight: bold;
}
.txtin {
	font-size: 5px;
}
.txtbd {

}
.even {
	background-color:##FBFBFB;
}
-->
</style>
</head>

<body>
<table width="100%"   cellpadding="1" cellspacing="0"  id="dadospessoais" style="margin-top:0px;">
  <tr>
    <td><div align="center" class="txthead">DEPARTAMENTO DE CONTROLE DO ESPAÇO AÉREO<br>SUBDEPARTAMENTO DE OPERAÇÕES<br>- EFETIVO ATC -</div></td>
  <tr>
    <td><b>LEGENDA: MAN</b>-Movimento anual (SETA-MILLENIUM); <b>CPT</b>-Consoles por turno; <b>QPO</b>-Quantidade de posições operacionais normalmente ativadas; <b>ENE</b>-Efetivo necessário (SDOP); <b>TEP</b>-Tabela Estratégica de Pessoal (SDAD); <b>TLP</b>-Efetivo aprovado (COMGEP); <b>AJS</b>-Efetivo afastado definitivamente por JES; <b>ACO</b>-Efetivo afastado por Conselho Operacional; <b>APO</b>-Efetivo afastado por outros motivos; e <b>ATR</b>-Atrito no efetivo operacional (acumulado no exercício)</td>
  </tr>
</table>
<table width="100%"   cellpadding="1" cellspacing="0"  id="dadospessoais" style="margin-top:0px;">
  <tr>
    <td rowspan="4" class="borda ctitulo centro">OM</td>
    <td rowspan="4" class="borda ctitulo centro">CMDO, DIV, COI OU DTCEA</td>
    <td rowspan="4" class="borda ctitulo centro">ÓRGÃO, CHF, DIV, SEÇÃO TÉC/ADM/OPR</td>
    <td rowspan="4" class="borda ctitulo centro">MAN</td>
    <td rowspan="4" class="borda ctitulo centro">CPT</td>
    <td colspan="13" class="borda ctitulo centro">ATCO</td>
    <td colspan="13" class="borda ctitulo centro">OFICIAIS CTA</td>
  </tr>
  <tr>
    <td rowspan="3" class="borda ctitulo centro" >QPO</td>
    <td rowspan="3" class="borda ctitulo centro">ENE</td>
    <td rowspan="3" class="borda ctitulo centro">TEP</td>
    <td rowspan="2" class="borda ctitulo centro" colspan="2">TLP</td>
    <td colspan="8" class="borda ctitulo centro">EFETIVO EXISTENTE</td>
    <td rowspan="3" class="borda ctitulo centro" >QPO</td>
    <td rowspan="3" class="borda ctitulo centro">ENE</td>
    <td rowspan="3" class="borda ctitulo centro">TEP</td>
    <td rowspan="2" class="borda ctitulo centro" colspan="2">TLP</td>
    <td colspan="8" class="borda ctitulo centro">EFETIVO EXISTENTE</td>
  </tr>
  <tr>
    <td class="borda ctitulo centro" colspan="2">Total</td>
    <td class="borda ctitulo centro" colspan="3">Efetivo fora das escalas</td>
    <td class="borda ctitulo centro" colspan="3">Efetivo Operacional</td>
    <td class="borda ctitulo centro" colspan="2">Total</td>
    <td class="borda ctitulo centro" colspan="3">Efetivo fora das escalas</td>
    <td class="borda ctitulo centro" colspan="3">Efetivo Operacional</td>
  </tr>
  <tr>
    <td class="borda ctitulo centro">Quant</td>
    <td class="borda ctitulo cene centro">%ENE</td>
    <td class="borda ctitulo centro">Quant</td>
    <td class="borda ctitulo cene centro">%ENE</td>
    <td class="borda ctitulo centro">Ajs</td>
    <td class="borda ctitulo centro">ACO</td>
    <td class="borda ctitulo centro">EAD</td>
    <td class="borda ctitulo centro">Quant</td>
    <td class="borda ctitulo cene centro">%ENE</td>
    <td class="borda ctitulo centro">%ATR</td>
    <td class="borda ctitulo centro">Quant</td>
    <td class="borda ctitulo cene centro">%ENE</td>
    <td class="borda ctitulo centro">Quant</td>
    <td class="borda ctitulo centro">%ENE</td>
    <td class="borda ctitulo centro">EAS</td>
    <td class="borda ctitulo centro">EAO</td>
    <td class="borda ctitulo centro">EAD</td>
    <td class="borda ctitulo centro">Quant</td>
    <td class="borda ctitulo cene centro">%ENE</td>
    <td class="borda ctitulo centro">%ATR</td>
  </tr>
  <tr>
	  <td class="borda centro" colspan="3">TOTAL DECEA</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
  </tr>
<cfquery datasource="#dsn#" name="org">
 select u.nome unidade, ur.nome regional, ss.nome setor, ss.regiao regiao, ss.setorID setorID, ss.tepatco tepatco  from sgpo_setores ss 
inner join unidades_regionais ur on (ur.regionalID=ss.regionalID and ss.unidadeID=ur.unidadeID)
inner join unidades u on (u.unidadeID=ss.unidadeID and u.unidadeID=ur.unidadeID)
 order by u.nome asc, ur.nome asc, ss.nome asc;
</cfquery>
<cfquery datasource="#dsn#" name="col1">
 select u.nome, count(*) total  from sgpo_setores ss 
inner join unidades_regionais ur on (ur.regionalID=ss.regionalID and ss.unidadeID=ur.unidadeID)
inner join unidades u on (u.unidadeID=ss.unidadeID and u.unidadeID=ur.unidadeID)
group by u.nome order by u.nome asc, ur.nome asc, ss.nome asc;
</cfquery>
<cfquery datasource="#dsn#" name="col2">
 select ur.nome nome, count(*) total  from sgpo_setores ss 
inner join unidades_regionais ur on (ur.regionalID=ss.regionalID and ss.unidadeID=ur.unidadeID)
inner join unidades u on (u.unidadeID=ss.unidadeID and u.unidadeID=ur.unidadeID)
group by u.nome, ur.nome order by u.nome asc, ur.nome asc, ss.nome asc;
</cfquery>
<cfscript>
col1rows=ArrayNew();
col1nome=ArrayNew();
col1tlp=ArrayNew();
col1tlpof=ArrayNew();
conta = 1;
indice = 1;
loop query="col1" {
	col1rows[conta] = querygetcell(col1, 'total', indice);
	col1nome[conta] = querygetcell(col1, 'nome', indice);
    qcol1 = new query(); 
    qcol1.setDatasource("#dsn#"); 
    qcol1.addParam(name="unidade",value="#querygetcell(col1, 'nome', indice)#",cfsqltype="cf_sql_varchar"); 
    qcol1.setSQL("select * from srhu_petefet where unidade=:unidade and espec='BCT' and quadro='QSS' group by unidade ");
    rcol1 = qcol1.execute(); 
    dcol1 = rcol1.getResult(); 
    qcol2 = new query(); 
    qcol2.setDatasource("#dsn#"); 
    qcol2.addParam(name="unidade",value="#querygetcell(col1, 'nome', indice)#",cfsqltype="cf_sql_varchar"); 
    qcol2.setSQL("select * from srhu_petefet where unidade=:unidade and ((espec='CTA' and quadro='QOEA') or (quadro='QOECTA')) group by unidade ");
    rcol2 = qcol2.execute(); 
    dcol2 = rcol2.getResult(); 
	col1tlp[conta] = querygetcell(dcol1, 'redim', 1);
	col1tlpof[conta] = querygetcell(dcol2, 'redim', 1);

	conta = conta + 1;
	for(i=1;i lt querygetcell(col1, 'total', indice);i= i+1){
		col1rows[conta]=0;
		col1tlp[conta] = '';
		col1tlpof[conta] = '';
		conta = conta + 1;
	}
	indice = indice +1;
}
col2rows=ArrayNew();
col2nome=ArrayNew();
col2tlp=ArrayNew();
col2tlpof=ArrayNew();
conta = 1;
indice = 1;
loop query="col2" {
	col2rows[conta] = querygetcell(col2, 'total', indice);
	col2nome[conta] = querygetcell(col2, 'nome', indice);
	conta = conta + 1;
	for(i=1;i lt querygetcell(col2, 'total', indice);i= i+1){
		col2rows[conta]=0;
		conta = conta + 1;
	}
	indice = indice +1;
}
</cfscript>
<cfset indice = 1>
<cfloop query="org">
	<cfif col1rows[indice] gt 0>
	<tr>
	  <td class="borda centro ctitulo" colspan="6">#col1nome[indice]#</td>
	  <td class="borda centro ctitulo" >&nbsp;TOTAL</td>
	  <td class="borda centro ctitulo">&nbsp;#col1tlp[indice]#</td>
	  <td class="borda centro ctitulo" colspan="11">&nbsp;</td>
	  <td class="borda centro ctitulo" >&nbsp;TOTAL</td>
	  <td class="borda centro ctitulo">&nbsp;#col1tlpof[indice]#</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	  <td class="borda centro ctitulo">&nbsp;</td>
	</tr>
	</cfif>		
	<tr>
	<cfif col1rows[indice] gt 0>
	  <td class="borda centro" rowspan="#col1rows[indice]#">#col1nome[indice]#</td>

	</cfif>
	<cfif col2rows[indice] gt 0>
	  <td class="borda centro" rowspan="#col2rows[indice]#">#col2nome[indice]#</td>
	</cfif>
	  <td class="borda centro">#setor#<cfif len(regiao) gt 0>-#regiao#</cfif></td>
	  <td class="borda centro">&nbsp;<cfquery datasource="#dsn#" name="man">select * from sgpo_cgna sc inner join sgpo_setores ss on (ss.setorID=sc.setorID and ss.setorID='#setorID#') inner join unidades_regionais ur on (ur.unidadeID=ss.unidadeID and ur.regionalID=ss.regionalID)</cfquery>#man.movimentoanual#</td>
	  <td class="borda centro">&nbsp;#man.console01#-#man.console02#-#man.console03#-#man.console04#</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;#man.ene#</td>
	  <td class="borda centro">&nbsp;#tepatco#</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	  <td class="borda centro">&nbsp;</td>
	</tr>		

<cfset indice = indice + 1>
</cfloop>
</table>

<p align="center" class="style2">&nbsp;</p>
</body>
</html>
<cfdocumentitem type="pagebreak">

</cfoutput>







</cfdocument>
