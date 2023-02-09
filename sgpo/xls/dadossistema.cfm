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
    <td scope="col" class="bordamaior"><div align="center" class="txthead">NOME</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">CPF</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">IDENTIDADE</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">MATRÍCULA</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">TIPO CONTRATO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">DTMOV</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">DTDESL</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">DTAPRE</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">DESIGNADO</div></td>
  </tr>
	<cfset i=1>
<cfloop query="conteudoconsulta">
	<cfif i%2 eq 0>
	<tr>
	<cfelse>
	<tr class="even">
	</cfif>
	<cfset i=i+1>    <td scope="col" class="borda"><div align="center" class="txtin">#unidade#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#regional#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nomesetor#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nome#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#cpf#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#identidade#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#matricula#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#tipocontrato#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#dateformat(dtmovimentacao,'dd-mm-yy')#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#dateformat(dtdesligamento,'dd-mm-yy')#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#dateformat(dtapresentacao,'dd-mm-yy')#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#designado#</div></td>
  </tr>
</cfloop>  
</table>
</body>
</html>
</cfoutput>
</cfcontent>
<cfabort>
