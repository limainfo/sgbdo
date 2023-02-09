<cfheader name="Content-Disposition" value="inline; filename=estagiario.xls">
<cfcontent type="application/vnd.msexcel">
<cfoutput>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <td scope="col" class="bordamaior"><div align="center" class="txthead">PROCESSO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">HABILITAÇÃO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">FUNÇÃO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">REGIONAL</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">SETOR</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">NOME</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">CPF</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">INÍCIO</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">FIM</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">H.SIM.</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">H.NEC.</div></td>
    <td scope="col" class="bordamaior"><div align="center" class="txthead">H.REAL.</div></td>
  </tr>
	<cfset i=1>
<cfloop query="conteudoconsulta">
	<cfif i%2 eq 0>
	<tr>
	<cfelse>
	<tr class="even">
	</cfif>
	<cfset i=i+1>    <td scope="col" class="borda"><div align="center" class="txtin">#numeroprocesso#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#habilitacao#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#funcao#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#regional#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nomesetor#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#nome#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#cpf#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#dateformat(inicioestagio,'dd-mm-yyyy')#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#dateformat(fimestagio,'dd-mm-yyyy')#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#horassimulador#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#horasnecessarias#</div></td>
    <td scope="col" class="borda"><div align="center" class="txtin">#horasconcluidas#</div></td>
  </tr>
</cfloop>  
</table>
<p align="center" class="style2">&nbsp;</p>
</body>
</html>

</cfoutput>
</cfcontent>
<cfabort>
