<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> 
<meta name="HandheldFriendly" content="true" /> <title>Sistema para envio de SMS</title> <link href="formCss.css?3.1.98" rel="stylesheet" type="text/css" /> <link type="text/css" media="print" rel="stylesheet" href="printForm.css?3.1.98" />

<style type="text/css">     
.form-label{         
	width:150px !important;     
}     
.form-label-left{
         width:150px !important;     
}     
.form-line{
         padding-top:12px;         padding-bottom:12px;     
}     
.form-label-right{
         width:150px !important;     
}     
body, html{
         margin:0;         padding:0;         background:false;     
}      
.form-all{
         margin:0px auto;         padding-top:20px;         width:394px;         color:#555 !important;         font-family:'Verdana';         font-size:12px;     
}     
.form-radio-item label, .form-checkbox-item label, .form-grading-label, .form-header{
         color:#555;     
}      
/* Injected CSS Code */ /*--red border on error--*/ 
.form-validation-error {
 border: 1px solid #FFB0B0 !important; 
}
/*--form header style--*/ 
#form_header {
 margin-top: 8px; background: url('header_background.gif') repeat-x; width: 100%; height: 90px; font-size: 30px; font-weight: bolder; text-align: center; padding-top: 25px; color: white !important; text-shadow: 1px 3px #020202; border-top-right-radius: 3px; border-top-left-radius: 3px; 
}
/*--textbox textarea style--*/ 
.form-textbox, .form-textarea{
 padding:3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; border: 1px solid #CCC; -webkit-transition: .3s ease-in-out; -moz-transition: .3s ease-in-out; color: #424242; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 12px; -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .15) inset; -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .15) inset; width: 210px !important; max-width: 210px !important; 
}
/*--textbox focus--*/ 
.form-textbox:focus, .form-textarea:focus{
 outline:0; border-color:rgba(82, 168, 236, 0.8); -webkit-box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.1),0 0 8px rgba(82, 168, 236, 0.6); -moz-box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.1),0 0 8px rgba(82, 168, 236, 0.6); box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.1),0 0 8px rgba(82, 168, 236, 0.6); 
}
/*--remove form header and footer padding--*/ 
#id_1, #id_8, #id_9, .form-html{
 padding:0px !important; width:100% !important; 
}
/*--form background shadows--*/ 
.form-all {
 padding-top: 0px !important; font-family: 'Verdana'; font-size: 12px; background-color: #E4E4F1; box-shadow: 1px 1px 15px #444; -webkit-box-shadow: 1px 1px 15px #444; -moz-box-shadow: 1px 1px 15px #444; margin-top:0 !important; 
} 
/*--remove error message--*/ 
.form-error-message {
 display: none !important; 
} 
.form-line-error {
 background:none repeat scroll 0 0; 
}
/* -- EVALDO 

ul.form-section {list-style: none outside none; margin-left: -40px;
}
--*/
/*--form footer style--*/ 
#form_footer {
 background: url('footer.png') repeat-x; width: 100%; height:40px; 
} 
#form_footerwrap{
 background: url('footer-wrap.png'); width:100%; height:70px; margin-bottom: -2px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; 
}
/*--footer and footerwrap connect--*/ 
#id_9{
 margin-top: -2px !important; 
}
/*--submit button position--*/ 
#id_2 {
 position: relative; top: 55px; left: 10px; z-index: 111; padding: 0px; height: 10px; 
}
/*--submit button error message position--*/ 
.form-button-error {
 display:block; position: absolute; top: 25px; left: 90px; color: #FF7C7C; 
}
/*--add red border on error--*/ 
.form-validation-error {
 border: 1px solid red !important; 
}     
/* Injected CSS Code */ 

</style>  
<link type="text/css" rel="stylesheet" href="form-submit-button-book_blue2.css?3.1.98"/> 
<script src="jotform.js?3.1.98" type="text/javascript"></script> 
<script type="text/javascript">

function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
var jsTime = setInterval(function(){try{
JotForm.jsForm = true;
JotForm.init(function(){
JotForm.highlightInputs = false;
JotForm.alterTexts({"alphabetic":"Esse campo aceita somente letras","alphanumeric":"Esse campo aceita letras e numeros.","confirmClearForm":"Deseja limpar os campos","confirmEmail":"E-mail incorreto","email":"Entre com um e-mail ","incompleteFields":"Preencha os campos com (*).","lessThan":"A quantidade deve ser menor","numeric":"Esse campo aceita somente numeros","pleaseWait":"Aguarde...","required":"Esse campo é obrigatório.","uploadExtensions":"Para upload somente arquivos do tipo:","uploadFilesize":"Tamanho do arquivo maior que:"});
});
clearInterval(jsTime);
}catch(e){}}, 1000); 
</script> 
</head> 
<?php
include_once 'db.php'; 
// Report all PHP errors
//error_reporting(E_CORE_ERROR);
// Same as error_reporting(E_ALL);
//print_r($_SERVER);
//print_r($_COOKIE);
//echo $_SERVER['SCRIPT_FILENAME'];
//echo basename($_SERVER['SCRIPT_FILENAME']);
//ini_set('error_reporting', E_CORE_ERROR);
//if(empty($_COOKIE['login'])&&empty($_COOKIE['id'])&&basename($_SERVER['SCRIPT_FILENAME'])!='login.php'){
$cabecalho_carregado = 1;
$login_carregado = 0;
if(empty($_SESSION["id"])) {
	session_save_path('/var/www/sgbdo/sms/tmp');
	session_start(); 
	//session_cache_expire(30);
}		

if( (empty($_SESSION['id']) && empty($_COOKIE['id']))  && basename($_SERVER['SCRIPT_FILENAME'])!='login.php' ){
	$login_carregado = 1;
	include 'login.php';
	exit();
}
//exit();
$fullpath = basename($_SERVER['SCRIPT_FILENAME']);
if($fullpath!='login.php'){
?>
<div class="info"><center><b><u>SISTEMA PARA ENVIO E CONTROLE DE MENSAGENS SMS</u></b></center><div style="float:right;"><a href="login.php?xsession=1"><i><?php echo empty($_SESSION['login'])?$_COOKIE['login']:$_SESSION['login'];  ?></i></a></div></div> 

<?php
}
?>
