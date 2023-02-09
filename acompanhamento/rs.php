
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script src="jquery-1.10.0.min.js" type="text/javascript"></script>
<title>Consulta de Passagem DECEA</title>
</head>
<style>
*{margin:0;padding:0;list-style:none;}
ul{overflow:auto;clear:both;}
ul li{float:left;}
li{padding-right:1em;}
#footer{clear:all;}
#itsthetable{
font-family:arial,sans-serif;
overflow:auto;
background:#fff;
}
#nav{position:absolute;top:1.6em;left:15em;}
h1{
font-size:180%;
color:#060;
}
h2{
font-size:120%;
font-family:calibri,helvetica,arial,sans-serif;
}
#header a,#meta a,#intro a{
color:#030;
text-decoration:underline;
}
#textcontent{
font-family:helvetica,arial,sans-serif;
padding:1em;
}
#ads{
background:#fff;
}
#textcontent h2,#textcontent h3{
font-family:calibri,helvetica,arial,sans-serif;
font-size:120%;
margin:1em 0;
}
#textcontent h3{
margin:0;
}
#textcontent a{
color:#030;
}
#textcontent p{
padding-bottom:.5em;
}
#ads{
text-align:center;
}
ul#tla{
font-size:.8em;
width:740px;
padding:1em;
font-family:arial,sans-serif;
display:block;
margin:0 auto;
}
#textcontent ul{
padding-bottom:.5em;
}
#textcontent li{
float:none;
padding:5px 0;
}
#ads{font-family:arial,sans-serif;margin:1em;color:#999;font-size:80%;
margin:2em 0;}
#dough{padding:1em 0;margin-top:8em;}
#ads li{padding-right:1em;}
#ads a{color:#999;}
#intro{
background:#ccc;
-moz-border-radius:5px;
-webkit-border-radius:5px;
border-radius:5px;
-moz-box-shadow:4px 4px 4px rgba(0,0,0,.3);
-webkit-box-shadow:4px 4px 4px rgba(0,0,0,.3);
box-shadow:4px 4px 4px rgba(0,0,0,.3);
position:absolute;
width:500px;
right:20px;top:5px;
}
#tla{overflow:auto;width:80%;padding:0;margin:0;}
#header,#footer,#intro{
padding:1em;
font-family:calibri,arial,sans-serif;
}
#header{
top:0;
margin-left:-2em;
background:#fff;
position:fixed;
width:72%;
z-index:200;
-moz-box-shadow:0px 0px 2em rgba(0,0,0,.4);
-webkit-box-shadow:0px 0px 2em rgba(0,0,0,.4);
box-shadow:0px 0px 2em rgba(0,0,0,.4);
height:7em;
}
#footer{
border-top:2px solid #333;
text-align:right;
}
html,body{
color:#000;
background:#fff;
}
#boundary{font-size:.9em;
margin:0 auto;width:70%;
min-width:700px;
position:relative;
}
#content,#textcontent{background:#fff;}
/*
Clean and crisp table styles
written by Mats Lindblad http://blogs.su.se/matlin/
*/
table {
font: normal 75%/150% Verdana, Arial, Helvetica, sans-serif;
border-collapse: collapse;
border: 3px solid #f0f8ff;
border-top: 5px double #87CEFA;
border-bottom: 5px double #87CEFA;
}
th {
font: bold 1.1em/120% Verdana, Arial, Helvetica, sans-serif;
padding: 5px 10px;
font-variant: small-caps;
color: #047;
font-weight: bold;
text-align: left;
letter-spacing: -1px;
}
thead th {
border: 1px solid #87CEFA;
white-space: nowrap;
background: #F0F8FF;
}
tbody td ,tbody th {
padding: 5px 10px;
background: #fff;
color: #000;
}
tbody th {
color: #047;
font-weight: normal;
font-variant: normal;
font-size: 1em;
}
tbody tr.odd {
border: 1px solid #87CEFA;
}
tbody tr.utilizar {
border: 1px solid #ABFA11;
}
tbody tr.utilizarp {
border: 1px solid #B5FA2A;
}
tbody tr.odd td, tbody tr.odd th {
background: #F0F8FF;
}
tbody tr.utilizar td, tbody tr.utilizar th {
background: #DEFFB8;
}
tbody tr.utilizarp td, tbody tr.utilizarp th {
background: #EBFFD4;
}
tfoot td, tfoot th {
border: none;
padding-top: 10px;
}
caption {
font-family: "Georgia", serif;
letter-spacing: 5px;
font-style: italic;
text-align: left;
text-indent: 2em;
text-transform: uppercase;
font-size: 150%;
padding: 10px 0;
color: #047;
}
table a:link {
color: #DC143C;
}
table th a:link {
color: #047;
text-decoration: none;
}
table a:visited{
color: #036;
text-decoration: line-through;
}
table a:hover{
color: #000;
text-decoration:none;
}
table a:active{
color: #000;
}
.info {
width: 90%; /* Só porque eu acho que fica bem */
margin: 10px auto; /* Só porque eu quero */
color:#C83931;
padding: 15px 10px 15px 50px; /* Para afastar o texto das bordas e da imagem à esquerda */
border-top: 1px solid #C83931; /* A espessura, tipo e cor da borda superior */
border-bottom: 1px solid #C83931; /* A espessura, tipo e cor da borda inferior */
background: #FFE6DF url('delete.png') 10px center no-repeat; /* Da esquerda para a direita: cor de fundo, imagem de fundo, posição horizontal, posição vertical e repetição da imagem de fundo */
}
</style>
<body>
<cfset dsn = "passagens" >
<cfset acesso = 0 >
<cfif StructKeyExists(form,"vef") and StructKeyExists(session,"rd") >
<cfif form.vef neq session.rd >
<cflocation statuscode="301" url="index.cfm?msg=captcha">
</cfif>
<cfelse>
<cflocation statuscode="301" url="index.cfm?msg=blank">
</cfif>
<cfset acesso = 1 >
<cfset ident = HTMLEditFormat(form.identidade) >
<cfset nome = '' >
<cfset orgao = "DACTA4" >
<cfset dsn = "passagens" >
<cfquery datasource="#dsn#" name="res1">
SELECT
T .cod_local_ini,
T .cod_local_fim,
T .dt_inicio_real AS DATA,
T .hr_inicio_real,
E .nome,
T .numero_bilhete_pta,
T .localizador,
T .id_trecho_real,
M .id_memorando,
o.tipo_doc,
o.numero,
r.sigla_orgao_setor_emis
FROM
cpa.CPA_PESSOAL_REQUISICAO P,
cpa.CPA_TRECHOS_PASSAGEM_REAL T,
cpa.CPA_EMPRESA_AEREA E,
cpa.CPA_MEMORANDO M,
cpa.CPA_ORDEM_REQUISICAO o,
cpa.CPA_REQUISICAO_PASSAGEM r
WHERE
r.id_requisicao = o.id_requisicao
AND o.id_ordem_req = P .id_ordem_req
AND P .id_pes_req = T .id_pes_req
AND T .id_empresa_aerea = E .id_empresa_aerea
AND T .id_pes_req = M .id_pes_req
AND P .identidade_servidor like '%#Trim(ident)#%'
AND TO_DATE(
TO_CHAR(
T .dt_inicio_real,
'dd/mm/yyyy'
),
'dd/mm/yyyy'
)>= TO_DATE(
TO_CHAR(SYSDATE-60, 'dd/mm/yyyy'),
'dd/mm/yyyy'
)
ORDER BY
T .id_trecho_real desc
</cfquery>
<cfset celular = replace(form.celular,'-','') >
<cfset celular = replace(celular,'(','') >
<cfset celular = replace(celular,')','') >
<cfset celular = '0'.concat(celular) >
<cfif isquery(res1) >
<cfset url.total=res1.recordcount>
<cfelse>
<cfset url.total=0>
</cfif>
<cfif total gt 0 >
<div id="boundary">
<div id="content">
<div id="itsthetable">
<table cellpadding="0" cellspacing="0" align="center">
<b><u><cfoutput></cfoutput></u></b><caption>Resultado dos últimos 60 dias</caption>
<thead>
<tr>
<th scope="col">Saída</th>
<th scope="col">Origem</th>
<th scope="col">Destino</th>
<th scope="col">Empresa</th>
<th scope="col">Bilhete</th>
<th scope="col">Localizador</th>
<th scope="col">OS</th>
<th scope="col">SMS</th>
<th scope="col">EMAIL</th>
</tr>
</thead>
<tbody>
<cfif isquery(res1) >
<cfset i=1>
<cfoutput query="res1">
<cfif i%2 eq 0>
<tr <cfif datecompare(DATA,now()) gt 0>class="utilizar"</cfif> >
<cfelse>
<tr <cfif datecompare(DATA,now()) gt 0>class="utilizarp"<cfelse>class="odd"</cfif> >
</cfif>
<cfset i=i+1>
<td scope="row">#lsdateformat(DATA,"dd/mm/yyyy")# #HR_INICIO_REAL#</a></td>
<td scope="row">#COD_LOCAL_INI#</td>
<td scope="row">#COD_LOCAL_FIM#</td>
<td scope="row">#NOME#</td>
<td scope="row">#NUMERO_BILHETE_PTA#</td>
<td scope="row">#LOCALIZADOR#</td>
<td scope="row">#TIPO_DOC#/#NUMERO#/#SIGLA_ORGAO_SETOR_EMIS#</td>
<td scope="row"><cfif len(celular) gte 10 ><a href="##" onclick="javascript:sms('#celular#','localizador:#LOCALIZADOR# data:#lsdateformat(DATA,"dd/mm/yyyy")# #HR_INICIO_REAL# origem:#COD_LOCAL_INI# destino:#COD_LOCAL_FIM# empresa:#NOME# os:#TIPO_DOC#/#NUMERO#/#SIGLA_ORGAO_SETOR_EMIS#','c#ID_TRECHO_REAL#');" title="Enviar SMS"><img src="sms.png" alt="Enviar SMS" id="c#ID_TRECHO_REAL#"></a></cfif></td>
<td scope="row"><cfif len(form.email) gte 10 ><a href="##" onclick="javascript:email('#form.email#','localizador:#LOCALIZADOR# data:#lsdateformat(DATA,"dd/mm/yyyy")# #HR_INICIO_REAL# origem:#COD_LOCAL_INI# destino:#COD_LOCAL_FIM# empresa:#NOME# os:#TIPO_DOC#/#NUMERO#/#SIGLA_ORGAO_SETOR_EMIS#','e#ID_TRECHO_REAL#');" title="Enviar e-mail"><img src="email.png" alt="Enviar e-mail" id="e#ID_TRECHO_REAL#"></a></cfif></td>
</tr>
</cfoutput>
</cfif>
<tfoot>
<tr><td colspan="8"><img src="c4.png" alt="" /></td></tr>
</tfoot>
</tbody>
</table>
</div></div></div>
<cfelse>
<div class="info">
Nenhuma informação encontrada para a identidade <b><u><cfoutput>#form.identidade#</cfoutput></u></b>. Clique <a href="index.cfm" >aqui</a> para tentar novamente.
</div>
</cfif>
</body>
</html>
<script>
function sms(numero, txt, id) {
var parametros = {'fone':numero,'txt':txt};
id = '#'+id;
var dados = parametros;
$.ajax({
type: 'POST',
processData: true,
url: 'sms.cfm',
beforeSend: function(){
$(id).attr("src","loading.gif");
},
success: function(data) {
var obj= jQuery.parseJSON(data);
if(obj.ok==1){
$(id).attr("src","concluido.png");
}else{
$(id).attr("src","sms.png");
}
},
error: function() {
$(id).attr("src","sms.png");
},
data: dados ,
datatype: 'html',
contentType: 'application/x-www-form-urlencoded'
});
}
function email(email, txt, id) {
var parametros = {'email':email,'txt':txt};
id = '#'+id;
var dados = parametros;
$.ajax({
type: 'POST',
processData: true,
url: './email.cfm',
beforeSend: function(){
$(id).attr("src","loading.gif");
},
success: function(data) {
var obj= jQuery.parseJSON(data);
if(obj.ok==1){
$(id).attr("src","concluido.png");
}else{
$(id).attr("src","email.png");
}
},
error: function() {
$(id).attr("src","email.png");
},
data: dados ,
datatype: 'html',
contentType: 'application/x-www-form-urlencoded'
});
}
</script>
