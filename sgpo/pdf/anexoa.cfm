<cfheader name="Content-Disposition" value="inline; filename=anexoa.pdf">
<cfdocument pagetype="a4" format="pdf" mimetype="image/jpeg" >

<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Anexo A - CIRCEA 100-51/2010 - Página 13 <div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
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
<cfloop query="conteudoconsulta">

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
<table width="100%" cellpadding="0px" cellspacing="0px" >
  <tr>
    <td width="8%" class="borda" rowspan="2"><div align="center" class="titnum">8</div></td>
    <td width="23%" valign="top" rowspan="2" class="borda"><span class="txtbd">&nbsp;INSTRUTORES (AVALIAÇÃO FINAL)</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;1)&nbsp;##instrutor01##</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;2)&nbsp;##instrutor02##</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;3)&nbsp;##instrutor03##</span></td>
  </tr>
  <tr>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;4)&nbsp;##instrutor04##</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;5)&nbsp;##instrutor05##</span></td>
    <td width="23%" valign="top" class="borda"><span class="txtbd">&nbsp;6)&nbsp;##instrutor06##</span></td>
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







</cfdocument>
