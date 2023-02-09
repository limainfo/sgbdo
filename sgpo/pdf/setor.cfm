<cfdocument pagetype="a4" format="pdf" mimetype="image/jpeg" >

<cfdocumentitem type="header">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Listagem de <cfoutput>#controllernomecampo#</cfoutput> - Total de #conteudoconsulta.recordcount# registro(s)<div style="float:right;margin:0px;vertical-align:top;font-weight:bold;font-size:8px;">#cfdocument.currentpagenumber#/#cfdocument.totalpagecount#</div></span></cfoutput>
</cfdocumentitem>

<cfdocumentitem type="footer">
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">SGPO - <b>Versão 1.0</b> - Desenvolvedor: <i>limainfo@gmail.com</i>  10/2012</span></cfoutput>
</cfdocumentitem>

<cfoutput><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listagem de Setores</title>
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
.even {
	background-color:##FBFBFB;
}
-->
</style>
</head>

<body>

<table width="100%"   cellpadding="1" cellspacing="0"  id="dadospessoais" style="margin-top:0px;">
  <tr>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">UNIDADE</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">REGIONAL</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">SETOR</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">TEP ATCO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">TELEFONE</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">DESCRIÇÃO</div></td>
  </tr>
	<cfset i=1>
<cfloop query="conteudoconsulta">
	<cfif i%2 eq 0>
	<tr>
	<cfelse>
	<tr class="even">
	</cfif>
	<cfset i=i+1>    <td scope="col" class="borda"><div align="center" class="txtin">#nomeU#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nomeUR#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nomeSetor#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#tepatco#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#telefone#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#descricao#</div></td>
  </tr>
</cfloop>  
</table>
<p align="center" class="style2">&nbsp;</p>
</body>
</html>
<cfdocumentitem type="pagebreak">

</cfoutput>







</cfdocument>
