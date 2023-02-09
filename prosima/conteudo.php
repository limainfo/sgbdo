<?php 

error_reporting(E_ALL);
//print_r($_COOKIE);

$libera = 0;
require('./ldap.php');
if(!empty($_POST['data']['login']) && !empty($_POST['data']['login'])){
	if(!(isset($_SESSION['id'])&&(isset($_SESSION['login'])))){
		$texto = autentica($_POST['data']['login'], $_POST['data']['senha']);
		if($texto=='OK'){$libera=1;}
	}
}
//echo $texto;
if(!$libera){
?>
<html><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">    
<title>:: Área Restrita da Divisão de Operações</title>
<link href="/sgbdo/img/favicon.ico" rel="shortcut icon">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script src="/sgbdo/js/prototype.js" type="text/javascript"></script>
	<script src="/sgbdo/js/scriptaculous.js?load=effects" type="text/javascript"></script>
        <script src="/sgbdo/js/effects.js" type="text/javascript"></script>
</head>
<body>
<div id="alertaSistemaTitulo"><p style="background-color: #800000; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;text-align:center;">MENSAGEM DO SISTEMA</p></div>
<div id="alertaSistema"><p style="margin: 0px; background-color: #ffff00;text-align:center; border: 1px solid #000;">
<?php echo $texto; ?>
<a href="index.php">Tentar novamente</a>
</p></div>
</div>	

</body>
</html>
<?php

}else{
//
//$_POST[oldPassword]
?>
<html><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">    
<title>:: Área Restrita da Divisão de Operações</title>
<link href="/sgbdo/img/favicon.ico" rel="shortcut icon">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script src="/sgbdo/js/prototype.js" type="text/javascript"></script>
	<script src="/sgbdo/js/scriptaculous.js?load=effects" type="text/javascript"></script>
        <script src="/sgbdo/js/effects.js" type="text/javascript"></script>
	


<script language="JavaScript" type="text/javascript">
var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	h=self.clientHeight;
	w=self.clientWidth;
	}
else if(document.documentElement && document.documentElement.scrollTop) {
	rX = document.documentElement.scrollLeft;
	rY = document.documentElement.scrollTop;
	h=document.documentElement.clientHeight;
	w=document.documentElement.clientWidth;
	}
else if(document.body) {
	rX = document.body.scrollLeft;
	rY = document.body.scrollTop;
	h = document.body.clientHeight;
	w = document.body.clientWidth;
	}
if(document.all) {
	cX += rX; 
	cY += rY;
	}
d.style.left = parseInt(w / 2) - parseInt(d.offsetWidth / 2)+"px";
d.style.top = (cY+10) + "px";
}
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.display == "none") { dd.style.display = "block"; }
else { dd.style.display = "none"; }
}
//--&gt;
</script>
</head>
<body onload="//new Effect.Fade('flashMsg',{delay: 50});">
<script language="javascript">
var x=screen.height;
var y=screen.width;
</script>
<style>

body {
    background: url("/sgbdo/webroot/img/papel.jpg") repeat scroll 0 0 transparent;
    color: #000000;
    font-family: Verdana,sans-serif;
    font-size: 11px;
    margin: 0;
    padding: 0;
    text-align: center;
}
#tudo {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #000000;
    margin: auto;
    padding: 0;
    text-align: left;
    width: 750px;
}
#cabecalho {
    background: none repeat scroll 0 0 #CCCCCC;
    font-size: 20px;
    padding: 20px;
    text-align: center;
}
#menu {
    background: none repeat scroll 0 0 #000000;
    height: 27px;
    margin: 0;
    padding: 0;
}
#menu ul {
    margin: 0 0 0 6px;
    padding: 0;
}
#menu ul li {
    display: inline;
}
#menu ul li a {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: none repeat scroll 0 0 #444444;
    border-color: #FFFFFF #FFFFFF #000000;
    border-style: solid;
    border-width: 1px;
    color: #FFFFFF;
    float: left;
    margin: 2px;
    padding: 5px 7px;
    text-decoration: none;
}
#menu ul li a:hover {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: none repeat scroll 0 0 #FFFFFF;
    border-color: #FF0000 #FF0000 -moz-use-text-color;
    border-style: solid solid none;
    border-width: 1px 1px medium;
    color: #FF0000;
    text-decoration: none;
}
#formulario {
    clear: both;
    font-size: 12px;
    padding: 5px;
    text-align: center;
}
#conteudo {
    clear: both;
    font-size: 12px;
    padding: 5px;
    text-align: center;
}
#rodape {
    background: none repeat scroll 0 0 #000000;
    clear: both;
    color: #FFFFFF;
    padding: 5px;
    text-align: center;
}
table {
	border-collapse: separate;
	border-spacing: 0;
	border: 1px solid #000000;
    font-size: 10px;
}

caption,th {
	text-align: center;
	font-weight: bold;
    font-size: 11px;
    background-color: #eeeeee;
	border: 1px solid #000000;
}
.normal tr:hover td{
    background: #FFFC00;
    color: #0000FF;
    text-decoration: none;
}
.normal td{
	text-align: left;
	font-weight: normal;
    font-size: 10px;
	border: 1px solid #000000;
    background-color: #fff;
}
.zebrado tr:hover td{
    background: #FFFC00;
    color: #0000FF;
    text-decoration: none;
}
.zebrado td{
	text-align: left;
	font-weight: normal;
    font-size: 10px;
	border: 1px solid #000000;
    background-color: #f8f8f8;
}
.checkboxAtivado{
	background-color:#5EFF43;
	color: #5EFF43;
}


blockquote:before,blockquote:after,q:before,q:after {
	content: "";
}
.ui-fieldset, .ui-fieldset .ui-fieldset-legend {
    padding: 0.5em 1em;
}
.ui-fieldset-toggleable .ui-fieldset-legend {
    cursor: pointer;
    padding-left: 2em;
    position: relative;
}
.ui-fieldset .ui-fieldset-toggler {
    left: 0.5em;
    position: absolute;
    top: 0.5em;
}
.ui-inputfield {
    margin: 0;
    outline: medium none;
    padding: 4px;
}
.ui-inputtextarea-resizable {
    display: block;
    overflow: auto;
}
.ui-inputfield, .ui-widget-content .ui-inputfield, .ui-widget-header .ui-inputfield {
    background: none repeat scroll 0 0 #FFFFFF;
    border-color: #999999;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 1px 1px #A9A9A9 inset;
    padding: 4px 2px;
}
.ui-inputfield.ui-state-focus, .ui-widget-content .ui-inputfield.ui-state-focus, .ui-widget-header .ui-inputfield.ui-state-focus {
}
table.formulario tbody tr td {
    padding: 8px 8px 8px 8px;
    vertical-align: middle;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: url("themes/sigadaer/images/ui-bg_glass_85_dfeffc_1x400.png") repeat-x scroll 50% 50% #eeeeee;
    border: 1px solid #0C1F6E;
    color: #333333;
    font-weight: normal;
}
</style>
        


<div style="background-color: #FFFFFF; display: none; z-index: 1030; position: fixed; top: 30%; left: 30%; float: center; border-top-width: thin; border-right-width: thin; border-bottom-width: thin; border-left-width: thin; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: #000000; border-right-color: #000000; border-bottom-color: #000000; border-left-color: #000000;" id="spinner"><img width="15" height="15" alt="" src="/sgbdo/img/spinner.gif"> Carregando ...</div>

<br>
<br>
<br>
<div id="mensagem" style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0); z-index: 1000">
<div id="alertaSistemaTitulo"><p style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">MENSAGEM DO SISTEMA<a onclick="HideContent('mensagem');$('mensagem').fire('mensagem:fechada', {mensagemId:0});" style="float: right; margin: 0px;"><img width="15" height="15" border="0" src="/sgbdo/img/lixo.gif" alt="Excluir" title="Excluir"> </a></p></div>

<div id="alertaSistema"><p style="margin: 0px; background-color: #ffff00; border: 1px solid #000;"></p></div>
</div>

<script type="text/javascript">
$('mensagem').hide();
$('mensagem').fire('mensagem:fechada', {mensagemId:1});
HideContent('mensagem');
</script>
<div style="float: center;" id="wrapper">
	

<div id="tudo">


	<div id="cabecalho">

	   <b>ACOMPANHAMENTO DO PROSIMA</b>

	</div>
<?php
	switch(strtolower($_SESSION['login'])){
		case 'evaldoesl':           $privilegio = array(1,1,1,1,1,1,1,1);break;//OPG
		case 'satoass':             $privilegio = array(1,1,1,1,1,1,1,1);break;//OPG
		case 'dinizjcdc':           $privilegio = array(1,1,1,1,1,1,1,1);break;//OPG
		case 'rafaelreas':          $privilegio = array(1,1,1,1,0,0,0,0);break;//DO
		case 'dewetfmsd':           $privilegio = array(1,1,1,1,1,1,1,1);break;//DO
		case 'martinsmms':          $privilegio = array(0,0,0,0,1,0,0,0);break;//BCO
		case 'luizantoniolas':      $privilegio = array(0,0,0,0,0,1,0,0);break;//BCT
		case 'limaolo':             $privilegio = array(0,0,0,0,0,0,1,0);break;//BMT
		case 'mirandajomm':         $privilegio = array(0,0,0,0,0,0,0,1);break;//SAI
		case 'marcosmaml':          $privilegio = array(0,0,0,0,0,0,0,1);break;//SAI
	}
	
 
?>

	<div id="menu">

	  <ul>
<?php 
if($privilegio[0]){
?>	    
      <li><a href="#" onclick="lista('cadastraevento','e');" >CADASTRA EVENTOS</a></li>
<?php
}
if($privilegio[1]){
?>	    
      <li><a href="#" onclick="lista('cadastraeventoequipe','e');">CADASTRA EVENTO-EQUIPE</a></li>
<?php
}
if($privilegio[2]){
?>	    
	    
      <li><a href="#" onclick="lista('acompanhamento','c');">ACOMPANHAMENTO</a></li>
<?php
}
if($privilegio[3]){
?>	    
	    
      <li><a href="#" onclick="lista('dadoscomandante','c');">DADOS PARA COMANDANTE</a></li>

<?php
}
?>	    
	    

<a href="excel.php" title="Baixar Dados no formato LibreOffice" ><img src="../webroot/img/broffice.png"  title="Baixar Dados no formato LibreOffice"></a><font color="white" style="float:right;">Usuário logado:<b><font color="yellow" style="float:right;"><?php echo $_SESSION['login']; ?></font></b></font>
	  </ul>

	</div>

        <p id="atencao" class="message" style="display: none;"><b>Formulário pronto para adição.</b></p>

	<div id="formulario">
	</div>
	
        <div id="listagem">
	</div>




	<div id="rodape">

	   Desenvolvido em 25/01/2013 por 1S BET EVALDO

	</div>

</div>






<script type="text/javascript">
//<![CDATA[
function lista(destino, tipo){
	if(tipo=='c'){}
		new Ajax.Updater('formulario','/sgbdo/prosima/'+destino+'.php', {
                    asynchronous:true,
                    evalScripts:true,
                    parameters:{espec:destino},
                    onCreate:function(request, xhr) {
                        $("formulario").innerHTML=$("spinner").innerHTML;
                    },
                    onComplete:function(request) {
                        HideContent('carregando');
                        $('conteudo').innerHTML='';
                        new Effect.Blind('formulario',{delay: 15});
                    },
                    requestHeaders:['X-Update', 'formulario']});
	}

function processa(id, nome){
		
	var valor = 0;
	var nomeid = nome+'.'+id;
	if($(nomeid).checked){
		valor = 1;
	}
	new Ajax.Request( '/sgbdo/dochf/processa.php' , 
    {
        method:'POST', 
		parameters: {nome:nomeid,campo:nome,id:id, conteudo:valor},
		onCreate:function(){$(nomeid).enable();},
        onSuccess:function(request) {
			var cor = '';
            var req = request.responseText; 
            if(req=='OK'){
				if(valor>0){
				  $(nomeid).addClassName('checkboxAtivado'); 
				  $(nomeid).setStyle({backgroundColor:'#5EFF43'}); 
				  cor = '#5EFF43';
				}else{
				  $(nomeid).removeClassName('checkboxAtivado'); 
				  $(nomeid).setStyle({backgroundColor:'#FFFFFF'}); 
				  cor = '#FFFFFF';
				}
					elements.each(function(item) {
					  if(item.type == 'checkbox' && item.name == nomeid) {
						  item.setStyle({backgroundColor:cor}); 
					  } 
					});					
			}else{
					elements.each(function(item) {
					  if(item.type == 'checkbox' && item.name == nomeid) {
						  item.checked = !item.checked;
					  } 
					});					
				  $(nomeid).setStyle({backgroundColor:'#FF0000'}); 
			}
            
        },
		   
        onFailure:function(){$('mensagem').innerHTML='FALHA';new Effect.Blind('mensagem',{delay: 15});}

    });
}
function registrar(){
		
	var valor = 0;

    new Ajax.Request( '/sgbdo/prosima/processa.php' , 
    {
        method:'POST', 
		parameters: {nome:'nomeid',campo:'nome',id:'id', conteudo:'valor'},
		onCreate:function(){$(nomeid).enable();},
        onSuccess:function(request) {
			var cor = '';
            var req = request.responseText; 
            if(req=='OK'){
			}else{
			}
            
        },
		   
        onFailure:function(){$('mensagem').innerHTML='FALHA';new Effect.Blind('mensagem',{delay: 15});}

    });
    return false;
}
function validaData (data) {
    var formatoValido = /^\d{4}-\d{2}-\d{2}$/; 
    var valido = false;
    if(!formatoValido.test(data))
      alert("A data está no formato errado.  Padrão YYYY-mm-dd.");
    else{
      var ano = data.split("-")[0];
      var mes = data.split("-")[1];
      var dia = data.split("-")[2];
      var MyData = new Date(ano, mes - 1, dia);
      if((MyData.getMonth() + 1 != mes)||
         (MyData.getDate() != dia)||
         (MyData.getFullYear() != ano))
       alert("Valores inválidos para o dia, mês ou ano. Padrão YYYY-mm-dd.");
      else{
        valido = true;
        $('AfastamentoDtTermino').value=$('AfastamentoDtInicio').value;
        }
    }

    return valido;
}
//]]>
</script>

</div>

</body></html>

<?php } ?>
