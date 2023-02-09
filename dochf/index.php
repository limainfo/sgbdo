<?php 

session_unset();

?>
<html><head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">    
<title>:: Área Restrita da Divisão de Operações</title>
<link href="/sgbdo/img/favicon.ico" rel="shortcut icon">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script src="/sgbdo/js/prototype.js" type="text/javascript"></script>
	<script src="/sgbdo/js/scriptaculous.js?load=effects,dragdrop,controls" type="text/javascript"></script>
	<script src="http://localhost/sgbdo/js/effects.js" type="text/javascript"></script>
	<link href="/sgbdo/css/admin.css" type="text/css" rel="stylesheet">


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
<div id="login" style="z-index: 2; position: fixed; float:center; margin: auto;  top: 30%;  left: 50%; margin: -120px -170px;  padding: 0px;border-color:#000;border: 1px 1px 1px 1px solid #000;float:center;">
<form accept-charset="utf-8" action="/sgbdo/dochf/conteudo.php" method="post" id="LoginForm">	
<table cellspacing="0" cellpadding="0" id="login">
	<tbody><tr>
		<td align="center" valign="center">
		<table cellspacing="0" cellpadding="0" border="0" id="login" border-color="#FFFFFF">
		
			<tbody><tr>
				<td style="background-color:#26a4e5;" colspan="2"><img src="/sgbdo/webroot/img/cadeadofechado.gif" style="float:left;" alt=""><center><b>LOG IN DE REDE</b></center></td>
			</tr>
			<tr>
				<td><div style="display:none;"><input type="hidden" value="POST" name="_method"></div><b>LOGIN:</b></form></td>
				<td><input type="text" name="data[login]" value="" class="formulario" id="login"></td>
			</tr>
			<tr>
				<td><b>SENHA:</b></td>
				<td><input type="password" name="data[senha]" value="" class="formulario" id="senha"></td>
			</tr>
			<tr>
				<td></td>
				<td><div class="submit"><input type="submit" value="Acessar" class="botoes"></div></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<th colspan="3"><center>Mensagem</center></th>
			</tr>
			<tr>
				<td style="text-align: justify;width:300px;overflow:hidden;" colspan="3"><center>
 				<b>23</b>&nbsp; E tudo quanto fizerdes, fazei-o de todo o coração, como ao Senhor, e não aos homens,
<br><b>24</b>&nbsp; Sabendo que recebereis do Senhor o galardão da herança, porque a Cristo, o Senhor, servis.
<br><b>(Cl 3.23-24)</b>&nbsp; </center></td>
			</tr>
		</tbody></table>
		</td>
	</tr>
</tbody></table>
</form>
</div>


<script type="text/javascript">
//<![CDATA[
//new Form.Element.EventObserver('UsuarioIdentidade', function(element, value) {new Ajax.Updater('UsuarioPrivilegioId','/sgbdo/usuarios/update', {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize('UsuarioIdentidade'), requestHeaders:['X-Update', 'UsuarioPrivilegioId']})})
//]]&gt;
</script></div>

</body></html>
