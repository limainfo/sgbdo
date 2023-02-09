<?php

//		header('Content-type: application/x-json');
	require('conn.inc');

switch($_POST['espec']){
	case 'BCO': $sql= "select 
	Militar.id, Militar.nm_completo, Militar.nm_guerra, Militar.instrutor_eear, Militar.instrutor_icea, Militar.coordenador, Militar.comissionamento, Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade, Unidade.sigla_unidade
			from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			left join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id like '%BCO%'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
	case 'BCT': $sql= "select 
	Militar.id, Militar.nm_completo, Militar.nm_guerra, Militar.instrutor_eear, Militar.instrutor_icea, Militar.coordenador, Militar.comissionamento, Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade, Unidade.sigla_unidade
			 from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			left join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id like '%BCT%'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
	case 'BMT': $sql= "select
	Militar.id, Militar.nm_completo, Militar.nm_guerra, Militar.instrutor_eear, Militar.instrutor_icea, Militar.coordenador, Militar.comissionamento, Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade, Unidade.sigla_unidade
			from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			left join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id like '%BMT%'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
	case 'SAI': $sql= "select
	Militar.id, Militar.nm_completo, Militar.nm_guerra, Militar.instrutor_eear, Militar.instrutor_icea, Militar.coordenador, Militar.comissionamento, Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade, Unidade.sigla_unidade
			from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			left join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.especialidade_id like '%SAI%'
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
				break;
}
//echo $sql;

$consulta = mysql_query($sql);
$quantidade = mysql_num_rows($consulta);
$saida='<table class="normal"><tr><td colspan="7" style="background-color:#FFFD70;">Quantidade atual:<b>'.$quantidade.'</b>  Especialidade:<b>'.$_POST['espec'].'</b></td></tr><tr><th rowspan="2">NOME</th><th colspan="2">INSTRUTOR</th><th  rowspan="2">COORD.</th><th rowspan="2">COMISS.</th><th rowspan="2">UNIDADE.</th><tr><th>EEAR</th><th>ICEA</th></tr></tr>';

$i=0;
while($dados=mysql_fetch_array($consulta, MYSQL_BOTH)){
	//print_r($dados);exit();
	$class = ' class="normal" ';
	$i++;
	if($i%2){
		$class = ' class="zebrado" ';
	}
	// instrutor_eear  instrutor_icea coordenador comissionamento
		$eear = '<input type="checkbox" class="'.($dados['instrutor_eear']>0?'checkboxAtivado':'').'" name="instrutor_eear.'.$dados['id'].'"  id="instrutor_eear.'.$dados['id'].'" value="'.($dados['instrutor_eear']>0?1:0).'" '.($dados['instrutor_eear']>0?'checked':'unchecked').' onclick="processa(\''.$dados['id'].'\',\'instrutor_eear\')" >';
		$icea = '<input type="checkbox" class="'.($dados['instrutor_icea']>0?'checkboxAtivado':'').'" name="instrutor_icea'.$dados['id'].'"  id="instrutor_icea.'.$dados['id'].'" value="'.($dados['instrutor_icea']>0?1:0).'" '.($dados['instrutor_icea']>0?'checked':'unchecked').' onclick="processa(\''.$dados['id'].'\',\'instrutor_icea\')" >';
		$coord = '<input type="checkbox" class="'.($dados['coordenador']>0?'checkboxAtivado':'').'" name="coordenador'.$dados['id'].'"  id="coordenador.'.$dados['id'].'" value="'.($dados['coordenador']>0?1:0).'" '.($dados['coordenador']>0?'checked':'unchecked').' onclick="processa(\''.$dados['id'].'\',\'coordenador\')" >';
		$comis = '<input type="checkbox" class="'.($dados['comissionamento']>0?'checkboxAtivado':'').'" name="comissionamento'.$dados['id'].'"  id="comissionamento.'.$dados['id'].'" value="'.($dados['comissionamento']>0?1:0).'" '.($dados['comissionamento']>0?'checked':'unchecked').' onclick="processa(\''.$dados['id'].'\',\'comissionamento\')" >';
		
//		$eear=$icea=$coord=$comis = '<center><img src="/sgbdo/webroot/img/accept.png"></center>';

	$saida.='<tr '.$class.'><td ><b>'.$dados['sigla_posto'].'</b>&nbsp;<i>'.$dados['sigla_quadro'].'-'.$dados['nm_especialidade'].'</i>&nbsp;&nbsp;&nbsp;'.$dados['nm_completo'].' - <u><b>'.$dados['nm_guerra'].'</b></u></td><td>'.$eear.'</td><td>'.$icea.'</td><td>'.$coord.'</td><td>'.$comis.'</td><td>'.$dados['sigla_unidade'].'</td></tr>';
}
$saida.='</table>';

echo $saida;
exit();
?>
