<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/switcher.js"></script>
	<script type="text/javascript" src="js/toggle.js"></script>
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript" src="js/ui.tabs.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
	<title>Acompanhamento de OS/PTA/DCTP</title>
</head>

<body>

<div id="main">

	<!-- Tray -->

	<hr class="noscreen" />

	<!-- Menu -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">


		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<div class="fix"></div>



                        <div id="resultados">
                            
<?php
ini_set('display_errors', 1);
ini_set('error_reporting', 1);


//cpa_int/cpa_relatorio.asp
$completa = " where 1=1 ";
if(($_POST['opcao']=="nome")){
	$completa .= " and servidor.nome_completo like '%".$_POST['busca']."%' ";
}
if(($_POST['opcao']=="cpf")){
	$completa .= " and servidor.cpf like '%".$_POST['busca']."%' ";
}
if(($_POST['opcao']=="identidade")){
	$completa .= " and servidor.id like '%".$_POST['busca']."%' ";
}
if(($_POST['opcao']=="saram")){
	$completa .= " and servidor.sdpp like '%".$_POST['busca']."%' ";
}
		   $qtdlimite = ($_POST['opqtd']+0)/2;

$sql =<<<INICIOSQL
select *, fase.display as statusos, servidor.nome_completo nomecompleto, cidade.cidade as nomecidade from os 
inner join pernoite on (pernoite.id_os=os.id_os)
inner join cidade on (cidade.id_cidade=pernoite.id_cidade)
inner join servidor on (servidor.id_servidor=pernoite.id_servidor)
inner join fase on (os.id_fase=fase.id_fase)
$completa
  group by pernoite.id_os
  order by os.saida_data desc, servidor.cpf asc
  limit 0,{$_POST['opqtd']}
INICIOSQL;

//echo $sql;

$anosql = 2013;
$fasesql = 52;
$dbname="onix";
$dbuser="onix";
$dbpasswd="xino#ccasj";
//$dbhost="127.0.0.1:1000";
$dbhost="10.112.30.28";
//$dbhost="localhost";

/*
$dbname="onix";
$dbuser="sgbdo";
$dbpasswd="naomexa";
$dbhost="127.0.0.1";
*/


    $conexao = mysql_connect($dbhost,$dbuser,$dbpasswd);
    if (!$conexao) {
        die('NÃ£o foi possÃ­Â­vel conectar: ' . mysql_error());
    }

    mysql_select_db($dbname,$conexao);
    $consulta = mysql_query($sql);
    
?>
<h1><p class="t-center">OS e PTA</p></h1>
			<p class="msg done">Referências mais recentes encontradas ->  <?php  echo mysql_num_rows($consulta).'(limite='.$_POST['opqtd'].')';  ?></p>
			<!-- Table (TABLE) -->
<p class="t-center">
			<table>
				<tr>
				    <th>NOME</th>
				    <th>OS</th>
				    <th>Saída/Regresso</th>
				    <th>PTA</th>
				</tr>

<?php
$i=0;
while($dados = mysql_fetch_array($consulta, MYSQL_BOTH)){
	if($i%2==0){
		$class = "";	
	}else{
		$class = " class='bg' ";	
	}
   $os=substr($dados['os'],0,strpos($dados['os'], '/'));
   $ano=substr($dados['os'],strpos($dados['os'], '/2')+1);
   $dadocpf[$i]=$dados['cpf'];
	$i++;
   //$os=$os+0;

	sleep(0.1);
    $contents = file_get_contents("http://10.32.63.109/cpa/webservice/consultavalor/obtemdados.asp?os=".$os."&ano=".$ano."");
   $objeto = json_decode($contents,TRUE);
   $passagemvalor = 0;
   $passagemsolicitacao = '';
   $trechos = '';
   $localizadores = '';
   if(!empty($objeto) ){
	       $passagemsolicitacao = $objeto[0]['NUMREQUISICAO'].'/'.$objeto[0]['SIGLA'].'/'.$objeto[0]['ANO'];
	       $ano = $objeto[0]['ANO'];
       foreach($objeto as $dado){
       	       if($dado['ANO']==$ano){
		       $passagemvalor += $dado['VALOR']+$dado['TARIFA']+$dado['SEGURO']+$dado['EXCESSO'];
		       $trechos  .=  "<ul><li>".$dado['LOCALINICIAL'].":".$dado['SITUACAO']."</li></ul>";
		       $localizadores .=  "<ul><li>".$dado['LOCALINICIAL'].":".$dado['LOCALIZADOR']."(".$dado['TIPODOC'].")</li></ul>";
	       }
       }

   }else{
   $passagemvalor = 0;
   $passagemsolicitacao = '';
   $trechos = '';
   $localizadores = '';
   
   }
   

?>
				<tr <?php echo $class; ?> >
				    <td><?php echo iconv( "ISO-8859-1","UTF-8",$dados['nomecompleto']); ?></td>
				    <td>
				    <?php echo "<ul>"; ?>
				    <?php echo "<li>OS<ul><li><strong>".$dados['os']."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Status<ul><li><strong>".iconv( "ISO-8859-1","UTF-8",$dados['statusos'])."</strong></li></ul></li>"; ?>
				    <?php echo "</ul>"; ?>
				    </td>
				    <td>
				    <?php echo "<ul>"; ?>
				    <?php echo "<li>Saída<ul><li>".$dados['saida_data'].":".$dados['saida_hora']."</li></ul></li>"; ?>
				    <?php echo "<li>Regresso<ul><li>".$dados['regresso_data'].":".$dados['regresso_hora']."</li></ul></li>"; ?>
				    <?php echo "<li>Servico<ul><li><strong>".iconv( "ISO-8859-1","UTF-8",$dados['resumo_servico'])."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Cidade<ul><li>".iconv( "ISO-8859-1","UTF-8",$dados['observacao'])."</li></ul></li>"; ?>
				    <?php echo "</ul>"; ?>
				    </td>
				    <td>
				    <?php echo "<ul>"; ?>
				    <?php echo "<li>Requisição<ul><li><strong>".$passagemsolicitacao."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Confirmação<strong>".$trechos."</strong></li>"; ?>
				    <?php echo "<li>Localizador<strong>".$localizadores."</strong></li>"; ?>
				    <?php echo "<li>Valor Passagem<ul><li>R$ ".$passagemvalor."</li></ul></li>"; ?>
				    <?php echo "</ul>"; ?>
				    </td>
				</tr>
 
 <?php   
}

?>

			</table>
</p>			
</table>
</p>
                            
                            
                        </div>
			
			
			


			


		</div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2013 <a href="#">OPG</a>, 02566472750 &reg;</p>

		<p class="f-right"><a href="http://www.adminizio.com/">limainfo@gmail.com</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
