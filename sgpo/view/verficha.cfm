<cfoutput>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<cfloop query="conteudoconsulta"></cfloop>
<body>
	<div id="accordion" >
	<h3>DADOS PESSOAIS</h3>
	<div>
		<p><div ><strong>&nbsp;&nbsp;&nbsp;a) Licença no. </strong></div><span >##licenca##</span>
		<strong><p  >&nbsp;&nbsp;&nbsp;b) Indicativo Operacional <span >##indicativo##</span></p></strong>
		<span >NOME COMPLETO: </span><span >##nomecompleto##</span>
		<span >NOME DE GUERRA: </span><span >##nomeguerra##</span>
		<span >POSTO / GRAD / NÍVEL </span><span >##posto##</span>		
		<span >DATA NASC: </span><span >##datanasc##</span>		
		<span >DATA DA ADMISSÃO:</span><span >##dataadmiss##</span>			
		<span >RG / ORG. EXP </span><span >##identidade##</span>
		<span >ÚLTIMA PROMOÇÃO:</span><span >##dtultimapromocao##</span>
		<span >UNIDADE / ÓRGÃO: </span><span >##unidade##</span>
		<span >DATA DA APRESENTAÇÃO: </span><span >##dtapresentacao##</span>
		<span >PROCEDÊNCIA:</span><span >##procedencia##</span>
		
		</p>
	</div>
	<h3>HABILITAÇÃO</h3>
	<div>
		<p>
		<span >CHT ANTERIOR: </span><span >##chtanterior##</span>
		<span >VALIDADE:</span><span >##vldchtanterior##</span>
		<span >CHT ATUAL: </span><span >##chtatual01##</span>
		<span >VALIDADE:</span><span >##vldchtatual01##</span>
		<span >CHT ATUAL: </span><span >##chtatual02##</span>
		<span >FUNÇÃO ATUAL / SETOR: </span><span >##funcao##-##setor##</span>
		<span >VALIDADE:</span><span >##vldchtatual02##</span>
		<span >CONDIÇÃO OPERACIONAL: </span><span >##condicaooperacional##</span>
		<span >AVALIAÇÃO TEÓRICA: </span><span >##avalteorica##</span>
		<span >CONCEITO OPERACIONAL: </span><span >##conceitooperacional##</span>
		<span >NÍVEL INGLÊS: </span><span >##nivelingles##</span>
		<span >AVALIAÇÃO PRÁTICA: </span><span >##avalpratica##</span>
		
		</p>
	</div>

</body>
</html>
</cfoutput>
	<script>
	$(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			activeHeader: "ui-icon-circle-arrow-s"
		};
		$( "#accordion" ).accordion({
			icons: icons,
			heightStyle: "content",
			collapsible: true
		});
		$( "#toggle" ).button().click(function() {
			if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
				$( "#accordion" ).accordion( "option", "icons", null );
			} else {
				$( "#accordion" ).accordion( "option", "icons", icons );
			}
		});
	});
</script>
<br><br><br><br>
