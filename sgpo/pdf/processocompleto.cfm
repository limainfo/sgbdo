<cfheader name="Content-Disposition" value= "inline; filename=processocompleto#nrprocesso#.pdf" >
<cfdocument pagetype="a4" format="pdf" mimetype="image/jpeg" name="completao" >

<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Anexo A - CIRCEA 100-51/2010 - Página 13 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
</cfdocumentitem>
    <cfdocumentsection name="AnexoA">
<cfoutput><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anexo A</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: black;
	border: none;
}
table {
	margin-top:6px;
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
.titnum {
	font-size: 16px;
	font-weight: bold;
	margin: 0.1cm;
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
<cfquery datasource="#dsn#" name="anexoa">
	select se.*, ur.jurisdicao as regional,
	u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
	inner join unidades_regionais ur on (se.regionalID=ur.regionalID)
	inner join unidades u on (ur.unidadeID=u.unidadeID)
	left join sgpo_setores ss on (ss.setorID=se.setorID)
	inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID)
	where
	se.numeroprocesso=<cfqueryparam  value="#nrprocesso#" cfsqltype="cf_sql_char"> 
	and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;	
</cfquery>
<cfloop query="anexoa">

<body>
<p align="center" class="titulo"><b><u>#regional#</u></b></p>
<p align="center" class="titulo">DIVISÃO DE OPERAÇÕES</p>
<p align="center" class="titulo">SUBDIVISÃO DE GERENCIAMENTO DE TRÁFEGO AÉREO</p>
<p align="center" class="titulo">FICHA CADASTRAL DE CONTROLADOR DE TRÁFEGO AÉREO</p>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <th scope="col" class="bordamaior"><div align="center" class="titulo">FICHA SÍNTESE DO PROCESSO</div></th>
  </tr>
</table>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">1</div></td>
    <td width="92%" valign="top" class="borda"><span class="txtbd">&nbsp;PROCESSO N&deg; #numeroprocesso#, de #dateformat(inicioestagio, 'dd-mm-yyyy')#</span></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">2</div></td>
    <td width="34%" valign="top" class="borda"><span class="txtbd">&nbsp;UNIDADE:&nbsp;#unidade#</span></td>
    <td width="33%" valign="top" class="borda"><span class="txtbd">&nbsp;ÓRGÃO ATC:&nbsp;#habilitacao#</span></td>
    <td width="25%" valign="top" class="borda"><span class="txtbd">&nbsp;LOCAL:&nbsp;</span></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">3</div></td>
    <td width="92%" valign="top" class="borda"><span class="txtbd">&nbsp;NOME COMPLETO:&nbsp;#nome#</span></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">4</div></td>
    <td width="92%" valign="top" class="borda"><span class="txtbd">&nbsp;ESTÁGIO:&nbsp;#funcao#-#habilitacao#</span></td>
  </tr>
</table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">5</div></td>
    <td width="34%" valign="top" class="borda"><span class="txtbd">&nbsp;DURAÇÃO:&nbsp;#horasnecessarias#</span></td>
    <td width="33%" valign="top" class="borda"><span class="txtbd">&nbsp;INÍCIO:&nbsp;#dateformat(inicioestagio, 'dd-mm-yyyy')#</span></td>
    <td width="25%" valign="top" class="borda"><span class="txtbd">&nbsp;TÉRMINO:&nbsp;#dateformat(fimestagio, 'dd-mm-yyyy')#</span></td>
  </tr>
 </table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">6</div></td>
    <td width="34%" valign="top" class="borda"><span class="txtbd">&nbsp;CARGA HORÁRIA</span></td>
    <td width="33%" valign="top" class="borda"><span class="txtbd">&nbsp;TEÓRICA:&nbsp;#cargateorica#</span></td>
    <td width="25%" valign="top" class="borda"><span class="txtbd">&nbsp;PRÁTICA:&nbsp;#cargapratica#</span></td>
  </tr>
 </table>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">7</div></td>
    <td width="47%" valign="top" class="borda"><span class="txtbd">&nbsp;AVALIAÇÃO FINAL: __/__/____</span></td>
    <td width="45%" valign="top" class="borda"><span class="txtbd">&nbsp;RESULTADO:&nbsp;##resultado##</span></td>
  </tr>
 </table>
 <cfquery datasource="#dsn#" name="instrutores">
 select * from sgpo_instrutorestagiarios si 
 inner join sgpo_estagiarios se on (se.estagiarioID=si.estagiarioID and se.numeroprocesso=#nrprocesso#)
 inner join sgpo_usuarios su on (su.usuarioID=si.usuarioID )
 </cfquery>
 <cfset instrutor=ArrayNew();
 <cfloop from=1 to=6 index="i">
	<cfset instrutor[i]='' >
 </cfloop>
 <cfset k=1 >
 <cfloop query="instrutores>
	 <cfset instrutor[k]=instrutores.usuarioID >
	 <cfset k=k+1 >
 </cfloop>
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda" rowspan="2"><div align="center" class="titnum">8</div></td>
    <td width="23%" valign="top" rowspan="2" class="borda"><span class="txtbd">&nbsp;INSTRUTORES (AVALIAÇÃO FINAL)</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;1)&nbsp;#instrutor[1]#</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;2)&nbsp;#instrutor[2]#</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;3)&nbsp;#instrutor[3]#</span></td>
  </tr>
  <tr>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;4)&nbsp;#instrutor[4]#</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;5)&nbsp;#instrutor[5]#</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;6)&nbsp;#instrutor[6]#</span></td>
  </tr>
 </table>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda" rowspan="2"><div align="center" class="titnum">9</div></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;1&deg. DESPACHO</span></td>
    <td width="69%" valign="top" class="borda"rowspan="2"><span class="txtbd">&nbsp;##despachochefeorgao##</span></td>
  </tr>
  <tr>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;CHEFE DO ÓRGÃO</span></td>
  </tr>
 </table>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda" rowspan="2"><div align="center" class="titnum">10</div></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;2&deg. DESPACHO</span></td>
    <td width="69%" valign="top" class="borda"rowspan="2"><span class="txtbd">&nbsp;##despachoatm##</span></td>
  </tr>
  <tr>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;SUBDIVISÃO ATM</span></td>
  </tr>
 </table>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda" rowspan="2"><div align="center" class="titnum">11</div></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;3&deg. DESPACHO</span></td>
    <td width="69%" valign="top" class="borda"rowspan="2"><span class="txtbd">&nbsp;##itemboletim##</span></td>
  </tr>
  <tr>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;ITEM P/BOLETIM</span></td>
  </tr>
 </table>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda" rowspan="2"><div align="center" class="titnum">12</div></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;4&deg. DESPACHO</span></td>
    <td width="69%" valign="top" class="borda"rowspan="2"><span class="txtbd">&nbsp;##origemarquivo##</span></td>
  </tr>
  <tr>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;SUBDIVISÃO ATM ORIGEM E ARQUIVO</span></td>
  </tr>
 </table>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">13</div></td>
    <td width="92%" valign="top" class="borda"><span class="txtbd">&nbsp;PUBLICADO NO BOLETIM INTERNO N&deg;&nbsp;___ de ___/___/_____</span></td>
  </tr>
</table>

<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">14</div></td>
    <td width="46%" valign="top" class="borda"><span class="txtbd">&nbsp;CHT PARA:&nbsp;#funcao#-#habilitacao#</span></td>
    <td width="46%" valign="top" class="borda"><span class="txtbd">&nbsp;VÁLIDO ATÉ:&nbsp;##validadecht##</span></td>
  </tr>
</table>


<p align="center" class="style2">&nbsp;</p>
</body>
</cfloop>
</html>
<cfdocumentitem type="pagebreak">

</cfoutput>
    </cfdocumentsection>
    
    
<cfdocumentsection name="Anexo B">    
<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Anexo B - CIRCEA 100-51/2010 - Página 14 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
</cfdocumentitem>

<cfoutput>
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
	margin-top:0px;
	border:1px ##000000;
	border-style:solid;
	padding:0px;
	spacing:0px;
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

<body>
<p align="center" class="titnum"><b><u>##orgaoregional##</u></b></p>
<p align="center" class="titnumb"><b>DIVISÃO DE OPERAÇÕES</b></p>
<p align="center" class="titnum">SUBDIVISÃO DE GERENCIAMENTO DE TRÁFEGO AÉREO</p>
<table width="100%" cellpadding="0px" cellspacing="0px"  class="borda">
  <tr>
    <th scope="col" colspan="2"  class="borda"><div align="center" >FICHA DE INDICAÇÃO PARA A AVALIAÇÃO FINAL</div></th>
  </tr>
  <tr>
    <td scope="col"  class="borda" width="2%"><div align="center" >&nbsp;</div></td>
    <td scope="col"  class="borda" width="96%"><div style="white-space:pre-wrap;" >
		&nbsp;&nbsp;Data: ##data##<br>
		&nbsp;&nbsp;Do ##instrucao## (Coordenador da Instrução Operacional)<br>
		&nbsp;&nbsp;Ao Sr. Chefe do ##orgao## (Órgão)<br>
		<br>
		&nbsp;&nbsp;Assunto: Avaliação de estagiário<br>
		<br>
		&nbsp;&nbsp;Participo-vos que o estagiário <u>FULANO</u> encontra-se em condições de ser submetivo à avaliação final, para fins de processo de habilitaçao como controlador de tráfego aéreo do <u>ORGAO</u> (órgão).
		<br>
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;<u>##coordenador##</u>                        <u>##avaliado##</u><br>
		 &nbsp;&nbsp;&nbsp;&nbsp;  COORDENADOR                                 AVALIADO<br>
	</div></td>
  </tr>
  <tr>
    <td scope="col"  class="borda" width="2%"><div align="center" ><b>C<br>H<br>E<br>F<br>E<br><br>D<br>O<br><br>Ó<br>R<br>G<br>Ã<br>O<br></b></div></td>
    <td scope="col"  class="borda" width="98%">
		<b>&nbsp;DESIGNAÇÃO DOS AVALIADORES:</b><br>
		<br><br><br>
		&nbsp;Designo, em ##data## (data), os instrutores <u>INSTRUTORES</u> para avaliarem o estagiário citado e concluírem a avaliação final até <u>PRAZO</u> .<br>
		<br><br>
		<br><br>
		<div align="right">
		<u>##secaoinstrucao##</u><br>
		CHEFE DO ÓRGÃO<br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		
		</div>
	</td>
  </tr>  
  <tr>
    <td scope="col"  class="borda" width="2%"><div align="center" ><b>I<br>N<br>S<br>T<br>R<br>U<br>T<br>O<br>R<br>E<br>S<br></b></div></td>
    <td scope="col"  class="borda" width="98%">
		<b>&nbsp;RESULTADO DAS AVALIAÇÕES:</b>&nbsp;&nbsp;&nbsp;&nbsp;(1) APTO&nbsp;&nbsp;&nbsp;&nbsp;(2) RETORNA AO ESTÁGIO<br>
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;1&deg;. INSTRUTOR:  (1)     RUBRICA: _______________________________<br>
		&nbsp;&nbsp;&nbsp;&nbsp;2&deg;. INSTRUTOR:  (1)     RUBRICA: _______________________________<br>
		&nbsp;&nbsp;&nbsp;&nbsp;3&deg;. INSTRUTOR:  (1)     RUBRICA: _______________________________<br>
		&nbsp;&nbsp;&nbsp;&nbsp;4&deg;. INSTRUTOR:  (1)     RUBRICA: _______________________________<br>
		&nbsp;&nbsp;&nbsp;&nbsp;5&deg;. INSTRUTOR:  (1)     RUBRICA: _______________________________<br>
		&nbsp;&nbsp;&nbsp;&nbsp;6&deg;. INSTRUTOR:  (1)     RUBRICA: _______________________________<br>
		<br><br>
		<br><br>
		<br><br>
		<br><br>
		
		</div>
	</td>
  </tr>  
  <tr>
    <td scope="col"  class="borda" width="2%"><div align="center" ><b>C<br>H<br>E<br>F<br>E<br></b></div></td>
    <td scope="col"  class="borda" width="98%">
		<b>&nbsp;PARECER DO CHEFE DO ÓRGÃO:</b>&nbsp;&nbsp;&nbsp;&nbsp;<br>
		<br>
		&nbsp;&nbsp;Esta Chefia, após ouvir os instrutores do Órgão, é de parecer que __________________________<br>
		<br><br><br>
		&nbsp;&nbsp; _____ (cidade), ___/___/_____ <br>
		<br><br>
		
		<div align="right">____________________<br>
		CHEFE DO ÓRGÃO</div>
		<br><br>
		<br><br>
		<br><br>
		
		</div>
	</td>
  </tr>    
</table>
</body>
</html>
</cfoutput>

</cfdocumentsection>
    
<cfquery datasource="#dsn#" name="anexoc">
	select * from sgpo_fichas sf
	inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID)
	where sf.estagiarioID='#anexoa.estagiarioID#' and sf.deleted is null and documento is not null
	order by sf.dtavaliacao asc
</cfquery>   
<cfdocumentsection name="Anexo C">    
<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Anexo C - CIRCEA 100-51/2010 - Página 15 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
</cfdocumentitem>

<cfoutput><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anexo A</title>
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
    <td scope="col" class="borda" width="50%" ><div style="float:left;margin:0px;"><b>LOCAL E DATA:</b>##data##</div></td>
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
  <tr>
    <td width="5%" class="borda" rowspan="#c.qtd#"><div align="center">#r.item#</div></td>
    <td width="20%" class="borda" rowspan="#c.qtd#"><div align="center">#r.areaavaliada#</div></td>
    <td width="55%" class="borda"><div align="left">#r.itemavaliado#</div></td>
    <td width="4%" class="borda"><div align="center"><img src="images/marcado.gif"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
  </tr> 
  <cfset controle=-1>
  <cfelse>
  <tr>
    <td width="55%" class="borda"><div align="left">#r.itemavaliado#</div></td>
    <td width="4%" class="borda"><div align="center"><img src="images/marcado.gif"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
    <td width="4%" class="borda"><div align="center"></div></td>
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
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td scope="col"><div align="center" ><b></b></div></td>
    <td scope="col"><div align="center" ><b></b></div></td>
    <td scope="col"><div align="center" ><i><u>##avaliador##</u></i></div></td>
  </tr>
  <tr>
    <td scope="col"><div align="center" ><b>AVALIADO(A)</b></div></td>
    <td scope="col"><div align="center" ><i><u>##instrucao##</u></i></div></td>
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

    </cfdocumentsection>


<cfdocumentsection name="Ficha Cadastral">    
<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Anexo C - Ficha Cadastral de Controlador de Tráfego Aéreo- ICA 100-18/2011 - Página 47 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
</cfdocumentitem>

<cfoutput><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ficha Cadastral</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: black;
	border: none;
}
body {
	margin-top: 0px;
}
.titulo {
	font-size: 16px;
	font-weight: bold;
	padding: 0 0 0 0;
	margin-top: 0px;
	margin-bottom: 0px;
 }
.titnum {
	font-size: 16px;
	margin: 0.1cm;
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
<cfloop query="anexoa">

<body>
<table width="100%" cellpadding="0" cellspacing="0"  >
  <tr>
    <td width="64%" rowspan="2" valign="top" style="border:none;margin:0;" class="txthead">COMANDO DA AERONÁUTICA<br />
    DEPARTAMENTO DE CONTROLE DO ESPAÇO AÉREO<br />SUBDEPARTAMENTO DE OPERAÇÕES</td>
    <td width="6%" rowspan="2"  class="borda" ><div align="center" class="titnum" >01</div></td>
    <td width="30%" height="26" valign="top"  class="borda"><div class="txtin"><strong>&nbsp;&nbsp;&nbsp;a) Licença no. </strong></div><span class="txtbd">##licenca##</span></td>
  </tr>
  <tr>
    <td height="14" valign="top"   class="borda"><strong><p class="txtin" >&nbsp;&nbsp;&nbsp;b) Indicativo Operacional <span class="txtbd">##indicativo##</span></p></strong></td>
  </tr>
</table>
<p align="center" class="titulo">FICHA CADASTRAL DE CONTROLADOR DE TRÁFEGO AÉREO</p>
<table width="100%"   cellpadding="1" cellspacing="0"  id="dadospessoais" style="margin-top:0px;">
  <tr>
    <td colspan="10"   scope="col" class="bordamaior"><div align="left" class="txthead">DADOS PESSOAIS</div></td>
  </tr>
  <tr>
    <td width="8%"  class="borda"><div align="center" class="titnum" >02</div></td>
    <td colspan="9" width="82%" valign="top"    class="borda"><span class="txtin">NOME COMPLETO: </span><span class="txtbd">##nomecompleto##</span></td>
  </tr>
  <tr>
    <td   class="borda" width="8%" ><div align="center"  class="titnum">03</div></td>
    <td colspan="4" valign="top" width="60%"   class="borda"><span class="txtin">NOME DE GUERRA: </span><span class="txtbd">##nomeguerra##</span></td>
    <td width="9%"   class="borda" width="8%"  ><div align="center" class="titnum" >04</div></td>
    <td colspan="4" valign="top" width="26%"    class="borda"><span class="txtin">POSTO / GRAD / NÍVEL </span><span class="txtbd">##posto##</span></td>
  </tr>
  <tr>
    <td    class="borda" ><div align="center" class="titnum">05</div></td>
    <td width="20%" valign="top"    class="borda"><span class="txtin">DATA NASC: </span><span class="txtbd">##datanasc##</span></td>
    <td width="9%" valign="top"    class="borda"><div align="center" class="titnum" >06</div></td>
    <td colspan="3" valign="top"    class="borda"><span class="txtin">DATA DA ADMISSÃO:</span><span class="txtbd">##dataadmiss##</span></td>
    <td width="9%"   class="borda" ><div align="center" class="titnum">07</div></td>
    <td colspan="3" valign="top"    class="borda"><span class="txtin">RG / ORG. EXP </span><span class="txtbd">##identidade##</span></td>
  </tr>
  <tr>
    <td   class="borda"  ><div align="center" class="titnum">08</div></td>
    <td colspan="5" valign="top"    class="borda"><span class="txtin">ÚLTIMA PROMOÇÃO:</span><span class="txtbd">##dtultimapromocao##</span></td>
    <td   class="borda" ><div align="center" class="titnum">09</div></td>
    <td colspan="3" valign="top"    class="borda"><span class="txtin">UNIDADE / ÓRGÃO: </span><span class="txtbd">##unidade##</span></td>
  </tr>
  <tr>
    <td    class="borda" ><div align="center" class="titnum">10</div></td>
    <td colspan="4" valign="top"    class="borda"><span class="txtin">DATA DA APRESENTAÇÃO: </span><span class="txtbd">##dtapresentacao##</span></td>
    <td    class="borda" ><div align="center" class="titnum" >11</div></td>
    <td colspan="4" valign="top"  class="borda" ><span class="txtin">PROCEDÊNCIA:</span><span class="txtbd">##procedencia##</span></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <th colspan="7"  scope="col" class="bordamaior"><div align="left" class="txthead">HABILITAÇÃO</div></th>
  </tr>
  <tr>
    <td width="8%"  class="borda"><div align="center" class="titnum">12</div></td>
    <td colspan="3" valign="top" class="borda"><span class="txtin">CHT ANTERIOR: </span><span class="txtbd">##chtanterior##</span></td>
    <td width="7%"  class="borda"><div align="center" class="titnum" >13</div></td>
    <td colspan="2" valign="top" class="borda"><span class="txtin">VALIDADE:</span><span class="txtbd">##vldchtanterior##</span></td>
  </tr>
  <tr>
    <td rowspan="2"  class="borda"><div align="center" class="titnum">14</div></td>
    <td colspan="3" class="borda"><span class="txtin">CHT ATUAL: </span><span class="txtbd">##chtatual01##</span></td>
    <td rowspan="2" class="borda"><div align="center" class="titnum" >15</div></td>
    <td colspan="2" valign="top" class="borda"><span class="txtin">VALIDADE:</span><span class="txtbd">##vldchtatual01##</span></td>
  </tr>
  <tr>
    <td colspan="3" class="borda"><span class="txtin">CHT ATUAL: </span><span class="txtbd">##chtatual02##</span></td>
    <td colspan="2" valign="top" class="borda"><span class="txtin">VALIDADE:</span><span class="txtbd">##vldchtatual02##</span></td>
  </tr>
  <tr>
    <td  class="borda"><div align="center" class="titnum">16</div></td>
    <td colspan="3" valign="top" class="borda"><span class="txtin">FUNÇÃO ATUAL / SETOR: </span><span class="txtbd">##funcao##-##setor##</span></td>
    <td  class="borda"><div align="center" class="titnum" >17</div></td>
    <td colspan="2" valign="top" class="borda"><span class="txtin">CONDIÇÃO OPERACIONAL: </span><span class="txtbd">##condicaooperacional##</span></td>
  </tr>
  <tr>
    <td rowspan="2"  class="borda"><div align="center" class="titnum">18</div></td>
    <td width="32%" valign="top" class="borda"><span class="txtin">AVALIAÇÃO TEÓRICA: </span><span class="txtbd">##avalteorica##</span></td>
    <td width="8%" rowspan="2"  class="borda"><div align="center" class="titnum" >19</div></td>
    <td colspan="2" rowspan="2" valign="top" class="borda"><span class="txtin">CONCEITO OPERACIONAL: </span><span class="txtbd">##conceitooperacional##</span></td>
    <td width="7%" rowspan="2"  class="borda"><div align="center" class="titnum" >20</div></td>
    <td width="22%" rowspan="2" valign="top" class="borda"><span class="txtin">NÍVEL INGLÊS: </span><span class="txtbd">##nivelingles##</span></td>
  </tr>
  <tr>
    <td valign="top" class="borda"><span class="txtin">AVALIAÇÃO PRÁTICA: </span><span class="txtbd">##avalpratica##</span></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="8%" scope="col" class="borda"><div align="center" class="titnum">21</div></th>
    <th width="92%" class="bordamaior" scope="col"><div align="left" class="txthead">CURSOS (CÓDIGO / NOME / LOCAL / DATA) </div></th>
  </tr>
  <tr>
    <td colspan="2" class="borda"><span class="txtbd">##cursocodigo##/##cursonome##/##cursolocal##/##cursodata##</span>&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2" class="borda">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="8%" scope="col" class="borda"><div align="center" class="titnum">22</div></th>
    <th width="92%" scope="col" class="bordamaior"><div align="left" class="txthead">EXPERIÊNCIA FUNCIONAL (FUNÇÃO / ÓRGÃO / PERÍODO) </div></th>
  </tr>
  <tr>
    <td colspan="2" class="borda"><span class="txtbd">##funcao## / ##orgao## / ##periodo##</span>&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2" class="borda">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th colspan="6" scope="col" class="bordamaior"><div align="left" class="txthead">EXAME DE SAÚDE </div></th>
    </tr>
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">23</div></td>
    <td width="25%" valign="top" class="borda"><span class="txtin">JES/DATA:</span><span class="txtbd">##jesdata##</span></td>
    <td width="8%" class="borda"><div align="center" class="titnum">24</div></td>
    <td width="25%" valign="top" class="borda"><span class="txtin">PARECER:</span><span class="txtbd">##jesparecer##</span></td>
    <td width="8%" class="borda"><div align="center" class="titnum">25</div></td>
    <td width="26%" valign="top" class="borda"><span class="txtin">VALIDADE:</span><span class="txtbd">##jesvalidade##</span></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th colspan="2" scope="col" class="bordamaior"><div align="left" class="txthead">DADOS DO RESPONSÁVEL PELO PREENCHIMENTO </div></th>
    </tr>
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">26</div></td>
    <td width="92%" valign="top" class="borda"><span class="txtin">CIDADE E DATA:</span><span class="txtbd">&nbsp;&nbsp;SGPO</span></td>
  </tr>
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">27</div></td>
    <td width="92%" valign="top" class="borda"><span class="txtin">POSTO / GRAD , ESP, NOME COMPLETO E FUNÇÃO:</span><span class="txtbd">&nbsp;&nbsp;SGPO</span></td>
  </tr>
  <tr>
    <td width="8%" class="borda"><div align="center" class="titnum">28</div></td>
    <td width="92%" valign="top" class="borda"><span class="txtin">ASSINATURA:</span><span class="txtbd">&nbsp;&nbsp;SGPO</span></td>
  </tr>
  <tr>
    <td colspan="2" class="borda"><div align="center"><strong>OBS.: Se necessário poderá ser utilizado o verso desta Ficha para informações complementares, citando o n&deg;do campo. </strong></div></td>
  </tr>
</table>
<p align="center" class="style2">&nbsp;</p>

</body>
</cfloop>

</html>
<cfdocumentitem type="pagebreak">

</cfoutput>

   </cfdocumentsection>

</cfdocument>

<cfpdf action="merge" destination="../processos/#nrprocesso#.pdf" overwrite="yes" keepBookmark="yes">
    <cfpdfparam source="#completao#">
    <cfpdfparam source="../documentos/5e1fb802-dcbc-425b-abd42cc8aef3c7d4.pdf">
</cfpdf>
<cfcontent file="../processos/#nrprocesso#.pdf" type="application/pdf" />
