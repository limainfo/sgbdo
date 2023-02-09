<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
#fundolegendas {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	background-color: #FFF;
	text-align: justify;
	display: block;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}
#barratitulo {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14px;
	color: #FFF;
	background-color: #003;
	font-weight: bold;
	display: block;
}
.par {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000;
	background-color: #FFC;
	text-align: justify;
	display: block;
	border: thin solid #000;
	padding: 3px;
}
.impar {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000;
	background-color: #FFCDD;
	text-align: justify;
	display: block;
	border: thin solid #000;
	padding: 3px;
}
.destaque {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000;
	background-color: yellow;
	text-align: justify;
	display: block;
	border: thin solid #000;
	padding: 3px;
}
#mensagem {
 width: 40%;
}

-->
</style>
<script>
	$('mensagem').setStyle({width:"auto"});
</script>
</head>

<body>
<div id="fundolegendas">
  <div id="barratitulo">LEGENDAS</div>
<?php
  	$i=0;
  	if(empty($consulta)){
		echo '<div class="par">NÃO EXISTEM LEGENDAS CADASTRADAS PARA A ESCALA INFORMADA</div>';
  	}
    foreach($consulta as $dado){
	if($i%2==0){
		$classe = 'par';
	}else{
		$classe = 'impar';
	}
	if($militarid==$dado['Militar']['id'] ){
		$classe = 'destaque';
	}
	 $i++;
	 if($dado['MilitarsEscala']['prevista']==0){
	 	$dado['MilitarsEscala']['legenda_prevista']='';
	 }
	 if($dado['MilitarsEscala']['cumprida']==0){
	 	$dado['MilitarsEscala']['legenda_cumprida']='';
	 }
	 $tmp = str_replace($dado['Militar']['nm_guerra'],'<b>'.$dado['Militar']['nm_guerra'].'</b>',$dado[0]['nome']);
	 //$dado[0]['nome']
	echo '<div class="'.$classe.'"><b>P-></b>'.$dado['MilitarsEscala']['legenda_prevista'].' &nbsp;&nbsp;&nbsp;&nbsp;<b>C-></b>'.$dado['MilitarsEscala']['legenda_cumprida'].' &nbsp;&nbsp;&nbsp;&nbsp;'.$tmp.'</div>';
	}
?>
</div>
</body>
</html>