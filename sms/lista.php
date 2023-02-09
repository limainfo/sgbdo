<?php

//		header('Content-type: application/x-json');
	require('conn.inc');


switch($_POST['espec']){
	case 'BCO': $sql= "select * from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			inner join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id='e2fc86ca-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2fca588-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2e303d0-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e30d6e0e-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2e3c2de-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e30be660-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2fcd80a-c0a8-11e1-bd62-001b2454cfb0'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
	case 'BCT': $sql= "select * from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			inner join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id='e2c7bb8e-c0a8-11e1-bd62-001b2454cfb0'
			or	Militar.especialidade_id='e2f58758-c0a8-11e1-bd62-001b2454cfb0'
			or	Militar.especialidade_id='e30d7de0-c0a8-11e1-bd62-001b2454cfb0'
			or	Militar.especialidade_id='e30a7b0e-c0a8-11e1-bd62-001b2454cfb0'
			or	Militar.especialidade_id='e2dded6e-c0a8-11e1-bd62-001b2454cfb0'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
	case 'BMT': $sql= "select * from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			inner join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id='e2ea57de-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2f68054-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2c02a9a-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e30d79e4-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2ddfdc2-c0a8-11e1-bd62-001b2454cfb0'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
	case 'SAI': $sql= "select * from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			inner join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id='e305c014-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2e4aee2-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e30c4c0e-c0a8-11e1-bd62-001b2454cfb0'
			or Militar.especialidade_id='e2f70e2a-c0a8-11e1-bd62-001b2454cfb0'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
}
//echo $sql;

$consulta = mysql_query($sql);
$quantidade = mysql_num_rows($consulta);
$saida='<table class="normal"><tr><td colspan="7" style="background-color:#FFFD70;">Quantidade atual:<b>'.$quantidade.'</b>  Especialidade:<b>'.$_POST['espec'].'</b></td></tr><tr><th rowspan="2">NOME</th><th colspan="2">INSTRUTOR</th><th  rowspan="2">COORD.</th><th rowspan="2">COMISS.</th><th rowspan="2">UNIDADE.</th><tr><th>EEAR</th><th>ICEA</th></tr></tr>';

$i=0;
while($dados=mysql_fetch_array($consulta, MYSQL_BOTH)){
	$eear = '';
	$icea = '';
	$coord = '';
	$comis = '';
	$class = ' class="normal" ';
	$i++;
	if($i%2){
		$class = ' class="zebrado" ';
	}
	
	if($dados['instrutor_eear']){
		$eear = '<center><img src="/sgbdo/webroot/img/accept.png"></center>';
	}
	if($dados['instrutor_icea']){
		$icea = '<center><img src="/sgbdo/webroot/img/accept.png"></center>';
	}
	if($dados['coordenador']){
		$coord = '<center><img src="/sgbdo/webroot/img/accept.png"></center>';
	}
	if($dados['comissionamento']){
		$comis = '<center><img src="/sgbdo/webroot/img/accept.png"></center>';
	}
	$saida.='<tr '.$class.'><td ><b>'.$dados['sigla_posto'].'</b>&nbsp;<i>'.$dados['sigla_quadro'].'-'.$dados['nm_especialidade'].'</i>&nbsp;&nbsp;&nbsp;'.$dados['nm_completo'].' - <u><b>'.$dados['nm_guerra'].'</b></u></td><td>'.$eear.'&nbsp;</td><td>'.$icea.'&nbsp;</td><td>'.$coord.'&nbsp;</td><td>'.$comis.'&nbsp;</td><td>'.$dados['sigla_unidade'].'&nbsp;</td></tr>';
}
$saida.='</table>';

echo $saida;
exit();
?>
