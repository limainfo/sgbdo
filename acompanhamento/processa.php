<?php
header("Content-type: text/html; charset=utf-8\r\n");
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
$dadocpf=array_unique($dadocpf);
$dadocpf=array_values ($dadocpf);

?>

			</table>
</p>			
<?php


?>

<h1><p class="t-center">DCTP - CURSOS</p></h1>
			<p class="msg done">Referências mais recentes encontradas (limite=<?php echo $qtdlimite; ?> por pessoa).</p>

<p class="t-center">
 			<table>
				<tr>
				    <th>NOME</th>
				    <th>CURSO</th>
				    <th>Status</th>
				</tr>

<?php
			$consulta = mysql_query($sql);

			$conectadctp=mysql_connect('10.32.63.29','drhu','drhu');
			if (!$conectadctp) {
			    die('Not connected : ' . mysql_error());
			}
			$selecionadctp = mysql_select_db('dctp', $conectadctp);
			if (!$selecionadctp) {
			    die ('Não é possível acessar DCTP : ' . mysql_error());
			}


			for($k=0;$k<count($dadocpf);$k++){
			   $cpf=$dadocpf[$k];

				$cursos=mysql_query('select *, tabelao.observacoes as obscurso, indicacoes.observacoes as obsindicacao from indicacoes inner join tabelao on (indicacoes.codTabelao=tabelao.codTabelao) inner join petc on (petc.codcurso=tabelao.codcurso) where replace(replace(cpf,".",""),"-","")="'.$cpf.'" and cpf<>"" order by tabelao.inicio desc limit 0,'.$qtdlimite.'');

				while($recurso = mysql_fetch_array($cursos, MYSQL_BOTH)){	


					if($i%2==0){
						$class = "";	
					}else{
						$class = " class='bg' ";	
					}
					$i++;

?>
				<tr <?php echo $class; ?> >
				    <td>
				    <?php echo "<ul>"; ?>
				    <?php echo "<li>Nome<ul><li><strong>".iconv( "ISO-8859-1","UTF-8",$recurso['NOME'])."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Posto<ul><li>".iconv( "ISO-8859-1","UTF-8",$recurso['POSTO'])."</li></ul></li>"; ?>
				    <?php echo "<li>Quadro<ul><li>".iconv( "ISO-8859-1","UTF-8",$recurso['QUADRO'])."</li></ul></li>"; ?>
				    <?php echo "<li>Espec<ul><li>".iconv( "ISO-8859-1","UTF-8",$recurso['ESPEC'])."</li></ul></li>"; ?>
				    <?php echo "</ul>"; ?>
				    <td>
				    <?php echo "<ul>"; ?>
				    <?php echo "<li>Curso<ul><li><strong>".iconv( "ISO-8859-1","UTF-8",$recurso['codcurso'])."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Descrição<ul><li><strong>".iconv( "ISO-8859-1","UTF-8",$recurso['nomecurso'])."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Período<ul><li><strong>".$recurso['inicio'].":".$recurso['fim']."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Ativado<ul><li>".($recurso['ativado']?  'Sim': 'Não')."</li></ul></li>"; ?>
				    <?php echo "<li>Turma<ul><li>".$recurso['turma']."-".$recurso['local']."</li></ul></li>"; ?>
				    <?php echo "<li>OBS<ul><li>".iconv( "ISO-8859-1","UTF-8",$recurso['obscurso'])."</li></ul></li>"; ?>
				    <?php echo "</ul>"; ?>
				    </td>
				    <td>
				    <?php echo "<ul>"; ?>
				    <?php echo "<li>Matriculado<ul><li><strong>".iconv( "ISO-8859-1","UTF-8",($recurso['matriculado']? 'Sim': 'Não'))."</strong></li></ul></li>"; ?>
				    <?php echo "<li>Reserva<ul><li>".($recurso['reserva']? 'Sim': 'Não')."</li></ul></li>"; ?>
				    <?php echo "<li>OBS<ul><li>".iconv( "ISO-8859-1","UTF-8",$recurso['obsindicacao'])."</li></ul></li>"; ?>
				    <?php echo "</ul>"; ?>
				    </td>
				</tr>
 
 <?php
					 
    			}
			}

 ?>
 

</table>
</p>
