
<cfoutput><span style="align:right;float:right;size:10px;font-size:8px;">Anexo D - CIRCEA 100-52/2010 - Página 17 </span></cfoutput>

<cfoutput><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anexo A</title>
<style type="text/css">
<!--

table {
	margin-top:0px;
}
body {
	margin-top: 0px;
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

-->
</style>
</head>
<cfquery datasource="#dsn#" name="fichas">
	select *, se.nome estagiario from sgpo_fichas sf
	inner join root_usuarios ru on (ru.usuarioID=sf.assinaturainstrutor)
	inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID)
	where sf.estagiarioID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> 
	and sf.deleted is null
	order by sf.dtavaliacao asc
</cfquery>

<body>
<p align="center"><BR><b><u>##orgaoregional##</u></b></p>
<p align="center"><b>DIVISÃO DE OPERAÇÕES</b></p>
<p align="center">SUBDIVISÃO DE GERENCIAMENTO DE TRÁFEGO AÉREO</p>
<table width="100%" cellpadding="0px" cellspacing="0px"  class="borda">
  <tr>
    <th scope="col" colspan="11"  class="borda"><div align="center" >FICHA DE ACOMPANHAMENTO DIÁRIO DE INSTRUÇÃO</div></th>
  </tr>
  <tr>
    <td scope="col"  class="borda" colspan="7" >NOME: #fichas.estagiario#</td>
    <td scope="col"  class="borda" colspan="4" ><div style="white-space:pre-wrap;" >ÓRGÃO ATC: ##orgaoatc##</div></td>
  </tr>
  <tr>
    <td scope="col"  class="borda" colspan="11" >CONCEITOS:   (O) ÓTIMO     (B) BOM    (R) REGULAR    (NS) NÃO SATISFATÓRIO</td>
  </tr>  
  <tr>
    <td scope="col"  class="borda"  rowspan="2"><div align="center" >DATA<br>(dd/mm/aaaa)</div></td>
    <td scope="col"  class="borda" colspan="4" ><div align="center" >POSIÇÃO OPERACIONAL</div></td>
    <td scope="col"  class="borda"  rowspan="2"><div align="center" >CONCEITO</div></td>
    <td scope="col"  class="borda"  rowspan="2"><div align="center" >AVALIADOR</div></td>
    <td scope="col"  class="borda" colspan="2" ><div align="center" >RUBRICA</div></td>
    <td scope="col"  class="borda"  rowspan="2"><div align="center" >OBS</div></td>
    <td scope="col"  class="borda"  rowspan="2"><div align="center" >TEMPO ACUMULADO (horas)</div></td>
  </tr>  
  <tr>
    <td scope="col"  class="borda" colspan="2" ><div align="center" >POSIÇÃO</div></td>
    <td scope="col"  class="borda" ><div align="center" >SETOR</div></td>
    <td scope="col"  class="borda" ><div align="center" >TEMPO(horas)</div></td>
    <td scope="col"  class="borda" ><div align="center" >AVALIADOR</div></td>
    <td scope="col"  class="borda" ><div align="center" >AVALIADO</div></td>
  </tr>  
<cfset horasposicaoassistente=0>
<cfset horasposicaocontrole=0>
<cfset totalhoras=0>
<cfloop query="fichas">
  <tr>
    <td scope="col"  class="borda" ><div align="center" >#dateformat(dtavaliacao,'dd-mm-yyyy')#</div></td>
    <td scope="col"  class="borda" colspan="2" ><div align="center" >#posicao#</div></td>
    <cfif posicao eq 'ASSISTENTE' >
		<cfset totalhoras = totalhoras + tempototal >
		<cfset horasposicaoassistente = horasposicaoassistente + tempototal >
    </cfif>
    <cfif posicao eq 'CONTROLE' >
		<cfset totalhoras = totalhoras + tempototal >
		<cfset horasposicaocontrole = horasposicaocontrole + tempototal >
    </cfif>
    <td scope="col"  class="borda" ><div align="center" >#setor#</div></td>
    <td scope="col"  class="borda" ><div align="center" >#tempototal#</div></td>
    <td scope="col"  class="borda" ><div align="center" >#rendimentoletra#</div></td>
    <td scope="col"  class="borda" ><div align="center" >#nome#</div></td>
    <td scope="col"  class="borda" ><div align="center" ></div></td>
    <td scope="col"  class="borda" ><div align="center" ></div></td>
    <td scope="col"  class="borda" ><div align="center" >#obs#<a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=anexoc&id=<cfoutput>#fichaID#</cfoutput>"><img src="images/fichas.png"></a></div></td>
    <td scope="col"  class="borda" ><div align="center" >#tempototal#</div></td>
  </tr> 
</cfloop>  
 <tr>
    <td scope="col"  class="borda" colspan="11" ><b>N&deg; DE HORAS ATÉ O DIA:<u>#dateformat(fichas.fimestagio,'dd/mm/yyyy')#</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;POSIÇÃO CONTROLE: <u>#horasposicaocontrole#</u>H&nbsp;&nbsp;&nbsp;&nbsp;POSIÇÃO ASSISTENTE: <u>#horasposicaoassistente#</u>H  </b></td>
  </tr>  
  
</table>
</body>
</html>






<script>
		$( "##manipulacao" ).dialog({
			title:'RN012 -> Gerente -> Excluir <cfoutput>#controllernome#</cfoutput>',
			resizable: false,
			widht: window.innerWidth * 10/10,
			position: { my: "center", at: "center", of: window },
			modal: true,
			buttons: {
				"Imprimir": function() {
					window.open('index.cfm?d=#appID#&i=pdf&nome=anexod&id=#fichas.estagiarioID#');
					
				}
			}
		});
		
      $( "##manipulacao" ).dialog( "open" );
		
</script>


</cfoutput>




