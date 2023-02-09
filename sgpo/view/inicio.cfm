
<div class="block">
<div class="block_head">
<div class="bheadl"></div>
<div class="bheadr"></div>
<h2>Início > Painel de Controle</h2>
<ul class="tabs">
<li><a href="#d">Status Operacional</a></li>
<li><a href="#m">Detalhamento de Condição</a></li>
</ul>
<form action="?i=Efetivo" method="post">
<input type="text" class="text" name="q" value="Busca" />
</form>
</div>
<!-- .block_head ends -->
<div class="block_content tab_content" id="d">
<h3>Central de Alertas</h3>
<div id="message" class="message success" >
<p>Nenhum alerta é necessário no momento.</p>
</div>
<hr>
<cfset unidadelista = "" >
<cfset habilitacaolista = "" >
<cfset saudelista = "" >
<cfset afastamentolista = "" >
<cfset efetivolista = "" >
<cfquery datasource="lpna" name="lpna">
SELECT
unidades.nome, unidades.decea, unidades.nome_sigpes
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
WHERE
cadastros.tipoID = '1'
GROUP BY
unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfset venc = #lsdateformat(DateAdd("D",45,now()),"yyyy-mm-dd")# >
<cfoutput query="lpna">
<cfquery datasource="lpna" name="h_apto">
SELECT
Count(unidades.nome) AS TT,
unidades.nome,
habilitacoes.dt_emissao,
habilitacoes.dt_validade
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN habilitacoes ON cadastros.cadastroID = habilitacoes.cadastroID
WHERE cadastros.licenca <> '' and cadastros.bug = '0' AND habilitacoes.funcao = 'Operador (OPE)' AND dt_validade > now() and unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfquery datasource="lpna" name="h_venc">
SELECT
Count(unidades.nome) AS TT,
unidades.nome,
habilitacoes.dt_emissao,
habilitacoes.dt_validade
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN habilitacoes ON cadastros.cadastroID = habilitacoes.cadastroID
WHERE cadastros.licenca <> '' and cadastros.bug = '0' AND habilitacoes.funcao = 'Operador (OPE)' AND dt_validade > now() AND dt_validade < '#venc#' and unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfquery datasource="lpna" name="s_apto">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN saude ON cadastros.cadastroID = saude.cadastroID
WHERE cadastros.licenca <> '' and cadastros.bug = '0' AND validade_dt > now() AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfquery datasource="lpna" name="s_venc">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN saude ON cadastros.cadastroID = saude.cadastroID
WHERE cadastros.licenca <> '' and cadastros.bug = '0' AND validade_dt > now() AND validade_dt < '#venc#' AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfquery datasource="lpna" name="a_apto">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN afastamentos ON cadastros.cadastroID = afastamentos.cadastroID
WHERE
cadastros.licenca <> '' and cadastros.bug = '0' and afastamentos.dt_i < now() and afastamentos.dt_f > now() AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfquery datasource="lpna" name="a_venc">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN afastamentos ON cadastros.cadastroID = afastamentos.cadastroID
WHERE
cadastros.licenca <> '' and cadastros.bug = '0' and afastamentos.dt_i < #venc# and afastamentos.dt_f > #venc# AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfquery datasource="lpna" name="apto_geral">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN habilitacoes ON habilitacoes.cadastroID = cadastros.cadastroID
INNER JOIN saude ON saude.cadastroID = cadastros.cadastroID
WHERE
cadastros.licenca <> '' AND
saude.validade_dt > now() AND
habilitacoes.dt_validade > now()
AND habilitacoes.funcao = 'Operador (OPE)'
AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfquery datasource="lpna" name="apto_geral_futuro">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN habilitacoes ON habilitacoes.cadastroID = cadastros.cadastroID
INNER JOIN saude ON saude.cadastroID = cadastros.cadastroID
WHERE
cadastros.licenca <> '' AND
saude.validade_dt > '#venc#' AND
habilitacoes.dt_validade > '#venc#'
AND habilitacoes.funcao = 'Operador (OPE)'
AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery>
<cfscript>
if ( len(h_apto.tt) eq 0 )
h_apto = 0 ;
else
h_apto = h_apto.tt ;
if ( len(h_venc.tt) eq 0 )
h_venc = 0 ;
else
h_venc = h_venc.tt ;
if ( len(s_apto.tt) eq 0 )
s_apto = 0 ;
else
s_apto = s_apto.tt ;
if ( len(s_venc.tt) eq 0 )
s_venc = 0 ;
else
s_venc = s_venc.tt
if ( len(a_apto.tt) eq 0 )
a_apto = 0 ;
else
a_apto = a_apto.tt ;
if ( len(a_venc.tt) eq 0 )
a_venc = 0 ;
else
a_venc = a_venc.tt ;
if ( len(apto_geral.tt ) eq 0 )
apto_geral = 0 ;
else
apto_geral = apto_geral.tt ;
if ( len(apto_geral_futuro.tt ) eq 0 )
apto_geral_futuro = 0 ;
else
apto_geral_futuro = apto_geral_futuro.tt ;
total_apto = apto_geral - a_apto ;
total_venc = apto_geral_futuro - a_venc ;
unidadelista = unidadelista & '"' & #nome# & '"';
habilitacaolista = habilitacaolista & h_venc;
saudelista = saudelista & s_venc;
afastamentolista = afastamentolista & a_venc;
efetivolista = efetivolista & total_venc;
if (currentrow neq lpna.recordcount) {
unidadelista = unidadelista & ',' ;
habilitacaolista = habilitacaolista & ',';
saudelista = saudelista & ',';
afastamentolista = afastamentolista & ',';
efetivolista = efetivolista & ',';
}
</cfscript>
</cfoutput>
<script src="./js/highcharts.js"></script>
<script src="./js/modules/exporting.js"></script>
<script>
$(function () {
$('#container').highcharts({
chart: {
type: 'bar'
},
title: {
text: 'Status Operacional do Efetivo'
},
colors: ['#238C00','#B20000'],
xAxis: {
categories: [<cfoutput>#unidadelista#</cfoutput>]
},
yAxis: {
min: 0,
title: {
text: 'Quantidade total do Efetivo Operacional'
}
},
legend: {
backgroundColor: '#FFFFFF',
reversed: true
},
plotOptions: {
series: {
pointWidth: 20,
stacking: 'normal'
}
},
series: [{
name: 'Operacionais',
data: [ <cfoutput query="lpna"> <cfquery datasource="lpna" name="apto">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN habilitacoes ON habilitacoes.cadastroID = cadastros.cadastroID
INNER JOIN saude ON saude.cadastroID = cadastros.cadastroID
WHERE
cadastros.licenca <> '' AND
saude.validade_dt > now() AND
habilitacoes.dt_validade > now()
AND habilitacoes.funcao = 'Operador (OPE)'
AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery><cfif len(apto.tt) eq 0 ><cfset apt = 0 ><cfelse><cfset apt = apto.tt ></cfif>#apt#<cfif currentrow neq lpna.recordcount>,</cfif></cfoutput>]
}, {
name: 'Não Operacional',
data: [ <cfoutput query="lpna"> <cfquery datasource="lpna" name="apto">
SELECT
Count(unidades.nome) AS TT,
unidades.nome
FROM
cadastros
INNER JOIN unidades_regionais ON cadastros.unidadeID = unidades_regionais.regionalID
INNER JOIN unidades ON unidades_regionais.unidadeID = unidades.unidadeID
INNER JOIN habilitacoes ON habilitacoes.cadastroID = cadastros.cadastroID
INNER JOIN saude ON saude.cadastroID = cadastros.cadastroID
WHERE
(cadastros.licenca = '' OR
saude.validade_dt < now() OR
habilitacoes.dt_validade < now() )
AND habilitacoes.funcao = 'Operador (OPE)'
AND unidades.nome = '#nome#'
GROUP BY unidades.nome
ORDER BY unidades.decea DESC, unidades.nome ASC
</cfquery><cfif len(apto.tt) eq 0 ><cfset tt = 0 ><cfelse><cfset tt = apto.tt ></cfif>#tt#<cfif currentrow neq lpna.recordcount>,</cfif></cfoutput>]
}
]
});
});
</script>
<div id="container" style="min-width: 30%;max-width: 70%; min-height:50%; margin: 10px auto"></div>
</div>
<div class="block_content tab_content" id="m">
<h3>Central de Alertas</h3>
<div id="message" class="message success" >
<p>Nenhum alerta é necessário no momento.</p>
</div>
<hr>
<script>
$(function () {
$('#previsoes').highcharts({
chart: {
style: {
fontFamily: '"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif', fontSize: '16px', fontColor: '#00000'
},
color:'#00000',
type: 'bar'
},
title: {
text: 'Detalhamento de Condição'
},
subtitle: {
text: 'Fonte: SGPO x LPNA'
},
xAxis: {
categories: [<cfoutput>#unidadelista#</cfoutput>],
title: {
text: null
}
},
yAxis: {
min: 0,
title: {
text: 'Efetivo (pessoas)',
align: 'high'
},
labels: {
overflow: 'justify'
}
},
tooltip: {
valueSuffix: ' pessoas'
},
plotOptions: {
bar: {
dataLabels: {
enabled: true
}
}
},
legend: {
layout: 'vertical',
align: 'right',
verticalAlign: 'top',
x: -100,
y: 100,
floating: true,
borderWidth: 1,
backgroundColor: '#FFFFFF',
shadow: true
},
credits: {
enabled: false
},
series: [{
name: 'Habilitação a vencer',
data: [<cfoutput>#habilitacaolista#</cfoutput>]
}, {
name: 'Inspeção Saúde a vencer',
data: [<cfoutput>#saudelista#</cfoutput>]
}, {
name: 'Afastamentos',
data: [<cfoutput>#afastamentolista#</cfoutput>]
}, {
name: 'Efetivo Apto',
data: [<cfoutput>#efetivolista#</cfoutput>]
}]
});
});
</script>
<div id="previsoes" style="width:100%; min-width: 400px; height: 600px; margin: 0 auto"></div>
<script language="javascript">
function designarestagiario() {
$( "#manipulacao" ).dialog({
autoOpen: false,
title:'RN003 -> Gerente-> Designar Estagiário',
position: { my: "center", at: "center", of: window },
height: window.innerHeight * 10/10,
width: window.innerWidth * 6/10,
buttons: {},
modal: true,
close: function() {
}
});
var parametros = {'controller':'estagiarios','action':'vercad', 'pagina':'<cfoutput>#url.pagina#</cfoutput>'};
var dados = parametros;
$.ajax({
type: 'POST',
processData: true,
url: 'controller/estagiariocontroller.cfm',
beforeSend: function(){
$("#spinner").css({'display':'block'});
},
success: function(data) {
$("#manipulacao").html(data);
//$("#cadastrados").html('Testando');
$("#spinner").css({'display':'none'});
$( "#manipulacao" ).dialog( "open" );
},
error: function() {},
data: dados ,
datatype: 'html',
contentType: 'application/x-www-form-urlencoded'
});
}
</script>
</div>
<!-- .block_content ends -->
<div class="bendl"></div>
<div class="bendr"></div>
</div>
<script type="text/javascript" >

function designarestagiario() {
$( "#manipulacao" ).dialog({
autoOpen: false,
title:'Designar',
position: { my: "center", at: "center", of: window },
height: window.innerHeight * 10/10,
width: window.innerWidth * 6/10,
buttons: {},
modal: true,
close: function() {
}
});
var parametros = {'controller':'estagiarios','action':'vercad', 'pagina':'<cfoutput>#url.pagina#</cfoutput>'};
var dados = parametros;
$.ajax({
type: 'POST',
processData: true,
url: 'controller/estagiariocontroller.cfm',
beforeSend: function(){
$("#spinner").css({'display':'block'});
},
success: function(data) {
$("#manipulacao").html(data);
//$("#cadastrados").html('Testando');
$("#spinner").css({'display':'none'});
$( "#manipulacao" ).dialog( "open" );
},
error: function() {},
data: dados ,
datatype: 'html',
contentType: 'application/x-www-form-urlencoded'
});
}
</script>
