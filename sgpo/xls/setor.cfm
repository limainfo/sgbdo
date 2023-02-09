<cfheader name="Content-Disposition" value="inline; filename=setor.xls">
<cfcontent type="application/vnd.msexcel">
<cfoutput>
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

<body>

<table width="100%"   cellpadding="1" cellspacing="0"  id="dadospessoais" style="margin-top:0px;">
  <tr>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">UNIDADE</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">REGIONAL</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">SETOR</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">REGIÃO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">TEP ATCO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">TELEFONE</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">DESCRIÇÃO</div></td>
  </tr>
<cfloop query="conteudosetores">
  <tr>
    <td scope="col" class="borda"><div align="center" class="txtin">#nomeU#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nomeUR#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nomeSetor#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#regiao#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#tepatco#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#telefone#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#descricao#</div></td>
  </tr>
</cfloop>  
</table>
</body>
</html>
</cfoutput>
</cfcontent>
<cfabort>
