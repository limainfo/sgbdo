<?php
$dbSGBDO = 'SGBDO';
$hostSGBDO = '10.112.30.28';
$nomeSGBDO = 'sgbdo';
$senhaSGBDO = 'sgbdo';

$anosql = 2014;
$fasesql = 52;
$dbname="onix";
$dbuser="onix";
$dbpasswd="xino#ccasj";

$dbhost="127.0.0.1:1000";
$dbhost="10.112.30.28";

$sql =<<<INICIOSQL
select * from servidor left join pernoite on (pernoite.id_servidor=servidor.id_servidor) inner join os on (pernoite.id_os=os.id_os) inner join os_debito on (os_debito.id_os=os.id_os) inner join identificador on (identificador.id_identificador=os.id_identificador) inner join exercicio on (exercicio.id_exercicio=identificador.id_exercicio and exercicio.ano=$anosql) inner join posto on (posto.id_posto=servidor.id_posto) inner join especialidade on (especialidade.id_especialidade=servidor.id_especialidade) inner join fase on (os.id_fase=fase.id_fase) where fase.id_fase  not in (26,27,29,31,71)  order by os.saida_data desc, servidor.cpf asc
INICIOSQL;


    $conexao = mysql_connect($dbhost,$dbuser,$dbpasswd);
    if (!$conexao) {
        die('NÃ£o foi possÃ­Â­vel conectar: ' . mysql_error());
    }

    mysql_select_db($dbname,$conexao);
    $consulta = mysql_query($sql);

while($dados = mysql_fetch_array($consulta, MYSQL_BOTH)){

   $os=substr($dados['os'],0,strpos($dados['os'], '/'));
   $ano=substr($dados['os'],strpos($dados['os'], '/2')+1);
   $os=$os+0;
	echo "Executando $os\n";
	sleep(1);
    $contents = file_get_contents("http://10.32.63.109/cpa/webservice/consultavalor/webservice.asp?os=".$os."&ano=".$ano."");
   $objeto = json_decode($contents,TRUE);
   $passagemvalor = 0;
   $passagemsolicitacao = '';
   $localizadores = '';
   if(!empty($objeto) ){
       foreach($objeto as $dado){
       $passagemvalor += $dado['VALOR']+$dado['TARIFA']+$dado['SEGURO']+$dado['EXCESSO'];
       $passagemsolicitacao .= $dado['NUMREQUISICAO'].'/'.$dado['SIGLA'].'/'.$ano;
       $localizadores .= $dado['LOCALINICIAL']."->".$dado['LOCALIZADOR'].' ';
       }

   }

     $insere = mysql_query('update pernoite set passagem_valor='.$passagemvalor.', passagem_solicitacao_num="'.$passagemsolicitacao.'" where id_pernoite='.$dados['id_pernoite']); echo 'update pernoite set passagem_valor='.$passagemvalor.', passagem_solicitacao_num="'.$passagemsolicitacao.'" where id_pernoite='.$dados['id_pernoite'].'<br>';if($insere){echo 'OK';}
     
     $conexaosgbdo = mysql_pconnect($hostSGBDO,$nomeSGBDO,$senhaSGBDO);
     mysql_select_db($dbSGBDO,$conexaosgbdo);
     $atualiza = "update paeatsindicadostemp set passagem='$localizadores' where  os='{$dados['os']}'  ";
     echo $atualiza.'<br>';
     mysql_query($atualiza);
      
}

?>
