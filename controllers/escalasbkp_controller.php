<?php
class EscalasController extends AppController {

	var $name = 'Escalas';
	//	var $helpers = array('Html', 'Form');
	var $paginate = array('limit'=>15);

	function update($cid = null,$meid = null, $pc = null, $motivo=null){
		// cumprimento_id, militarsescala_id, previstacumprida
          	//Configure::write('debug',2);
		$ok = 1;
		$mensagem = '';
		$insere = 1;
		$ausente = 0;

		$this->Escala->MilitarsEscala->recursive = 0;

		//$mescala = $this->Escala->MilitarsEscala->findById($meid);

		$sql = "select Escalasmonth.id, Escalasmonth.escala_id, Escalasmonth.hora_instrucao, Cumprimentoescala.dia,Cumprimentoescala.cumprido, SUBSTRING(Escalasmonth.mes,5,2) as mes, SUBSTRING(Escalasmonth.mes,1,4) as ano, Escala.setor_id, Escala.tipo from cumprimentoescalas Cumprimentoescala
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Cumprimentoescala.escalasmonth_id and Cumprimentoescala.id='{$cid}')
		inner join escalas Escala on (Escalasmonth.escala_id=Escala.id)
		";
                
//                echo $sql;exit();
		$data = $this->Escala->query($sql);
		$tipo =  $data[0]['Escala']['tipo'];
		$eid =  $data[0]['Escalasmonth']['escala_id'];
		$seid =  $data[0]['Escala']['setor_id'];
		$emid =  $data[0]['Escalasmonth']['id'];
		$dia = $data[0]['Cumprimentoescala']['dia'];
		$mes = $data[0][0]['mes'];
		$ano = $data[0][0]['ano'];
                $militarEscalaId=$meid;

                if($tipo=='RISAER'){
			$diasMilitar="select * from cumprimentoescalas Cumprimentoescala where escalasmonth_id='$emid' and cumprido='$militarEscalaId' and cumprido is not null";
			$marcacoes = $this->Escala->query($diasMilitar);
			foreach($marcacoes as $diasescalados){
				$teste=$dia - $diasescalados['Cumprimentoescala']['dia'];
				if(abs($teste)<=2){
					$ok = 2;
					$insere = 1;
					$mensagem = "Motivo: RCA 34-1/2005 Art. 16 - Deverá ser observado entre dois serviços de igual natureza ou não,<br> quando da confecção da escala, para o mesmo militar, uma folga mínima de 48 horas.<br> Parágrafo único. O Comandante, Chefe ou Diretor da OM poderá,<br> caso a situação o exija, reduzir o intervalo previsto no caput do artigo. ";
					break;
						
				}
			}
		}
		//---------------------------------------------------------------------------------------

                        $outrasescals="select Unidade.nm_unidade, Setor.sigla_setor, Cumprimentoescala.dia, SUBSTRING(Escalasmonth.mes,5,2) as mes, SUBSTRING(Escalasmonth.mes,1,4) as ano  from cumprimentoescalas Cumprimentoescala 
                            inner join escalasmonths Escalasmonth on (Escalasmonth.id=Cumprimentoescala.escalasmonth_id)
                            inner join escalas Escala on (Escala.id=Escalasmonth.escala_id)
                            inner join setors Setor on (Setor.id=Escala.setor_id)
                            inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
                            where Cumprimentoescala.id<>'$cid' and Cumprimentoescala.previsto='$militarEscalaId' and Escalasmonth.mes={$ano}{$mes} order by Setor.sigla_setor";
			$todasescalasmes = $this->Escala->query($outrasescalas);
                        foreach($todasescalasmes as $todas){
                            $nomeunidade = $todas['Unidade']['nm_unidade'];
                            $nomesetor = $todas['Setor']['sigla_setor'];
                            $nomedia = $todas['Cumprimentoescala']['dia'];
                            $diaantes = $dia -1;
                            $diadepois = $dia +1;
                            $diaatual = $dia + 0;
                            if(($nomedia==$diaatual)||($nomedia==$diaantes)||($nomedia==$diadepois)){
                                $ok = 2;
                                $insere = 1;
                                $mensagem .= "Escalado no {$nomeunidade}-{$nomesetor} no dia:{$nomedia}\n";
                            }
                            
                            
                            
                        }
				
                //----------------------------------------------------------------------------

        if(($tipo=='RISAER')||($tipo=='TECNICA')){
            $escala24h = 24;
        }else{
            $escala24h = 0;
        }
		
		$horaInstrucao = $data[0]['Escalasmonth']['hora_instrucao'];

		$dtIni = "$ano/$mes/$dia";
		$qtd_dias = date('t',strtotime($dtIni));

		$constante = 0;

		//------------------------------------------------------------------------------------------------

		$escalasmonth = $emid;

		$dtIni = "$dta/$dtm/1";
		$qtd_dias = date('t',strtotime($dtIni));

		$constante = 0;



		//------------------------------------------------------------------------------------------------

		if($pc=='p'){
			$sql = "update escalasmonths set media_hora_prevista=$media where id='$emid'";
		}else{
			$sql = "update escalasmonths set media_hora=$media where id='$emid'";
		}
		$this->Escala->query($sql);

		$dataTemp = $ano.'-'.$mes.'-'.$dia;

		$sql = "select * from afastamentos Afastamento where militar_id='{$meid}'
		and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')  ";
		$afastamento = $this->Escala->query($sql);

		if(!empty($afastamento[0]['Afastamento']['militar_id'])){
			$ok = 0;
			$insere = 0;
			$mensagem = 'Motivo:'.$afastamento[0]['Afastamento']['motivo']."  Obs.:".$afastamento[0]['Afastamento']['obs'];
			$ausente = 1;
		}

		if($pc=='p'){
			$sqlleg = "select * from militars_escalas MilitarsEscala where escala_id='$eid'  and militar_id='$meid' and prevista=1";
		}else{
			$sqlleg = "select * from militars_escalas MilitarsEscala where escala_id='$eid'  and militar_id='$meid' and cumprida=1";
		}
		$leg = $this->Escala->query($sqlleg);
		$complemento = '';
		if($insere){
			if($pc=='p'){
				if($ausente){
					$complemento = ", afastamentos = concat(afastamentos,' ','{$leg[0]['MilitarsEscala']['legenda_prevista']}') ";
				}
                               if(!$meid){
				$sql = "update cumprimentoescalas set previsto=null, cumprido=null, legenda_previsto=null, legenda_cumprido=null $complemento where id='$cid'";
                                }else{
				$sql = "update cumprimentoescalas set previsto='$meid', cumprido='$meid', legenda_previsto='{$leg[0]['MilitarsEscala']['legenda_prevista']}', legenda_cumprido='{$leg[0]['MilitarsEscala']['legenda_cumprida']}' $complemento where id='$cid'";
                                    
                                }

				$this->Escala->query($sql);
				$sqlduplo = "select * from cumprimentoescalas where escalasmonth_id='$emid' and previsto='$meid' and dia=$dia";

				if(count($this->Escala->query($sqlduplo))>1){
					if(!empty($meid)){
						$mensagem = 'Porém, o militar já foi escalado em outro turno neste mesmo dia:'.$dia.'/'.$mes.'/'.$ano;
						$ok = 2;
					}
				}

				/* Modificação a ser realizada
				 */
				//$data_atual = mktime($hora,$minuto,0,$mes,$dia,$ano);

				$dia_seguinte = $dia + 1;

				$dobrando_servico = "select * from cumprimentoescalas where escalasmonth_id='$emid' and previsto='$meid' and dia=$dia_seguinte";

				if(count($this->Escala->query($dobrando_servico))>1){
					if(!empty($meid)){
						$mensagem .= 'Porém, o militar já foi escalado em outro turno no dia:'.$dia_seguinte;
						$ok = 2;
					}
				}
				//*/
				$dia_anterior = $dia - 1;

				$dobrando_servico = "select * from cumprimentoescalas where escalasmonth_id='$emid' and previsto='$meid' and dia=$dia_anterior";

				if(count($this->Escala->query($dobrando_servico))>1){
					if(!empty($meid)){
						$mensagem .= 'Porém, o militar já foi escalado em outro turno no dia:'.$dia_anterior;
						$ok = 2;
					}
				}
			}else{
				$sqllegenda = "update cumprimentoescalas, militars_escalas
				set cumprimentoescalas.legenda_previsto=militars_escalas.legenda_prevista
				where cumprimentoescalas.escalasmonth_id='$emid' and cumprimentoescalas.previsto=militars_escalas.militar_id and militars_escalas.militar_id='$meid'  and militars_escalas.escala_id='$eid'";
				$diferencalegenda = $this->Escala->query($sqllegenda);

				$sqldiferenca = "select * from cumprimentoescalas where id='$cid' ";
				$diferenca = $this->Escala->query($sqldiferenca);


				$previsao =  $diferenca[0]['cumprimentoescalas']['legenda_previsto'];
				$dia = $diferenca[0]['cumprimentoescalas']['dia'];

				if($motivo==''){
					$ok = 5;
					$mensagem = "Informe o motivo da substituição de $previsao :";

				}else{
					$sqlt = "select * from versoescalas where escalasmonth_id='$emid' ";
					$naoconformidade = $this->Escala->query($sqlt);
					$motivos = $naoconformidade[0]['versoescalas']['naoconformidades']."\r| ".$previsao.' por '.$leg[0]['MilitarsEscala']['legenda_prevista'].' no dia '.$dia.' Motivo:'.$motivo.' |';

						
						
					//if($previsao!=$meid){
					$sqlt = "update versoescalas set naoconformidades='".addslashes($motivos)."' where escalasmonth_id='$emid' ";
					$this->Escala->query($sqlt);

					$alteracoes = $motivos;

					if($ausente){
						if($pc=='p'){
							$complemento = ", afastamentos = concat(afastamentos,' ','{$leg[0]['MilitarsEscala']['legenda_prevista']}') ";
						}else{
							$complemento = ", afastamentos = concat(afastamentos,' ','{$leg[0]['MilitarsEscala']['legenda_cumprida']}') ";
						}
					}
                                        if(!$meid){
					$sql = "update cumprimentoescalas set cumprido=null , legenda_cumprido=null $complemento where id='$cid'";
                                        }else{
					$sql = "update cumprimentoescalas set cumprido='$meid' , legenda_cumprido='{$leg[0]['MilitarsEscala']['legenda_cumprida']}' $complemento where id='$cid'";
                                        }
                                        
					$this->Escala->query($sql);
					$mensagem = "Substituição realizada!";
					//}else{$mensagem = "Nenhuma ação realizada!";}
				}

			}

		}
                
					//----------------------------------------------------------------
					$ip = $_SERVER['REMOTE_ADDR'];
					$u = $this->Session->read('Usuario');
					$usuario = $u[0][0]['nome'];

					$consultaescala = 'select * from escalas Escala
		inner join turnos Turno on (Turno.escala_id="'.$eid.'" )
		inner join setors Setor on (Setor.id=Escala.setor_id)
		inner join militars_escalas MilitarsEscala on (MilitarsEscala.escala_id="'.$eid.'" )
		where Escala.id="'.$eid.'"
		';
					//echo $consultaescala;
					//
					$resultsetor=$this->Escala->query($consultaescala);
					//print_r($resultsetor);
					$rsetor=$resultsetor[0]['Setor']['sigla_setor'].' '.$ano.'-'.$mes;
					$mudanca = '<u><b>Legenda atribuída:</b></u>'.$leg[0]['MilitarsEscala']['legenda_cumprida'].'->Dia:'.$dia;
					$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Legenda: '.$rsetor.'",now(),"ESCALA", "Insere Legenda","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
					//		echo $monitora;
					//		exit();
					$this->Escala->query($monitora);
					//------------------------------------------------------------------------------------------------------------
                


		$turnos = $this->Escala->query("select * from turnos Turno where Turno.escala_id='$eid' order by Turno.id asc");
		//print_r($turnos);
		foreach($turnos as $turno){
			$inicio = strtotime($turno['Turno']['hora_inicio']);
			$termino = strtotime($turno['Turno']['hora_termino']);
			$qtd = $turno['Turno']['qtd'];

			$v1h1 = date('G', $inicio);
			$v1h2 = date('G', $termino);
			$v1m1 = date('i', $inicio);
			$v1m2 = date('i', $termino);

			$v1 = $v1h1 + ($v1m1/60);
			$v2 = $v1h2 + ($v1m2/60);


			if($v2<=$v1){
				$qtd_horas = (24-$v1) + $v2;
			}else{
				$qtd_horas = (abs($v1 - $v2));
			}

			
			$qtd_horas = abs($qtd_horas+$escala24h);
			if($escala24h>29){
			   $qtd_horas -= 24;
			}

			$turn[$turno['Turno']['id']]['horas'] = $qtd_horas;
			$turn[$turno['Turno']['id']]['qtd'] = $qtd;

		}

		if($selprev=='p'){
			$sql = "select count(*) total from militars_escalas where escala_id='$eid' and prevista=1";
		}else{
			$sql = "select count(*) total from militars_escalas where escala_id='$eid' and cumprida=1";
		}

		$todos = $this->Escala->query($sql);
		$todos = $todos[0][0]['total'];

		$sql = "update escalas set efetivo_total=$todos where id='$eid'";
		$this->Escala->query($sql);


		if($selprev=='p'){
			$sql = "select count(distinct(previsto)) total from cumprimentoescalas where escalasmonth_id='$escalasmonth' and previsto is not null";
		}else{
			$sql = "select count(distinct(cumprido)) total from cumprimentoescalas where escalasmonth_id='$escalasmonth' andcumprido is not null";
		}
		//$sql = "select count(*) total from militars_escalas where escala_id=$eid";
		//echo $sql;
		$todosefetivo = $this->Escala->query($sql);
			
		$todosefetivo = $todosefetivo[0][0]['total'];

		$sql = "update escalasmonths set efetivo_total=$todosefetivo where id= '$escalasmonth'";
		$this->Escala->query($sql);


		$media = 0.0;
		$mediaalternativa = 0.0;
		
		for($c=1;$c<=$qtd_dias;$c++){
			$dataTemp = $dta.'-'.$dtm.'-'.$c;
			//$sql = "select count(*) fora from afastamentos where militar_id in (select militar_id from militars_escalas where escala_id=$id) and (((YEAR(dt_inicio)={$dta} and MONTH(dt_inicio)={$dtm})) OR ((YEAR(dt_termino)={$dta} and MONTH(dt_termino)={$dtm}))) and  (DATEDIFF('{$dataTemp}',dt_inicio)>=0) and (DATEDIFF('{$dataTemp}',dt_termino)<=0 ) and (escala_id=0 or escala_id={$id}) ";
			if($selprev=='p'){
				$sql = "select count(*) fora from afastamentos Afastamento where militar_id in (select militar_id from militars_escalas where escala_id='$eid' and prevista=1 and ignoraafastamento='N' ) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}') ";
			}else{
				$sql = "select count(*) fora from afastamentos Afastamento where militar_id in (select militar_id from militars_escalas where escala_id='$eid' and cumprida=1 and ignoraafastamento='N' ) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}') ";
			}
			//echo $sql.'<br>';
			$fora = $this->Escala->query($sql);
			$fora = $fora[0][0]['fora'];

			if($selprev=='p'){$sq = 'previsto';$lq = 'legenda_previsto';}else{$sq = 'cumprido';$lq = 'legenda_cumprido';}

			$sql = "select $sq escalado, $lq legenda, id_turno from cumprimentoescalas where dia=$c and escalasmonth_id='$escalasmonth' group by id order by dia asc";
			$calculo = $this->Escala->query($sql);
			//print_r($calculo);

			$dividendo = 0;
			//print_r($calculo);
			foreach($calculo as $calc){
				if(!empty($calc['cumprimentoescalas']['escalado'])){
					$dividendo += $turn[$calc['cumprimentoescalas']['id_turno']]['horas'];
				}
			}
			//echo 'div='.$dividendo.'/todos('.$todos.')-fora('.$fora.')<br>';
			$media += $dividendo / ($todos - $fora) + 0.0;
			$mediaalternativa += $dividendo / ($todos ) + 0.0;
			//echo $media.'<br>';
		}
		$media = round($media,0);
		$mediaalternativa = round($mediaalternativa,0);
		
		$media = $media.'/'.$mediaalternativa;
		
		//	$media = 142;
		//$media += 0;
		header('Content-type: application/x-json');
		$teste = '';

		echo '{ "mediaHoras":"'.$media.'","mensagem":"'.addslashes($mensagem.$teste).'","alteracao":"'.urlencode(($alteracoes)).'", "ok":"'.$ok.'" }';
			
		exit();
	}

	function indexPdf($id = null, $dtm = null, $dta = null, $selprev = null)
	{
		$this->layout = 'pdf'; //this will use the pdf.thtml layout
		//$this->layout = null; //this will use the pdf.thtml layout

		$escala = $this->Escala->findById($id);

		$tipo = $escala['Escala']['tipo'];
		if(($tipo=='RISAER')||($tipo=='TECNICA')){
			$escala24h = 24;
		}else{
			$escala24h = 0;
		}
		$seid = $escala['Escala']['setor_id'];

		$sqlc = 'select Escalasmonth.id,Escalasmonth.hora_instrucao,Escalasmonth.mes, Escalasmonth.ok_chefep, Escalasmonth.ok_chefec, Escalasmonth.ok_chefeorgaop, Escalasmonth.ok_chefeorgaoc, Escalasmonth.ok_escalantep, Escalasmonth.ok_escalantec, Escalasmonth.ok_comandantep, Escalasmonth.ok_comandantec, Escalasmonth.destrava_prevista, Escalasmonth.destrava_cumprida from escalasmonths Escalasmonth where Escalasmonth.escala_id="'.$id.'" and Escalasmonth.mes='.$dta.$dtm;
                //echo $sqlc;
		$escalasmonths = $this->Escala->query($sqlc);
		$id_escalas_month = $escalasmonths[0]['Escalasmonth']['id'];
		$escalasmonthmes = $escalasmonths[0]['Escalasmonth']['mes'];
		$horaInstrucao = $escalasmonths[0]['Escalasmonth']['hora_instrucao'];
		$escalasmonth = $id_escalas_month;

		$dtIni = "$dta/$dtm/1";
		$qtd_dias = date('t',strtotime($dtIni));

		$constante = 0;
		$turnos = $this->Escala->query("select * from turnos Turno where Turno.escala_id='$id' order by Turno.id  asc");
		//print_r($turnos);
		foreach($turnos as $turno){
			$inicio = strtotime($turno['Turno']['hora_inicio']);
			$termino = strtotime($turno['Turno']['hora_termino']);
			$qtd = $turno['Turno']['qtd'];

			$v1h1 = date('G', $inicio);
			$v1h2 = date('G', $termino);
			$v1m1 = date('i', $inicio);
			$v1m2 = date('i', $termino);

			$v1 = $v1h1 + ($v1m1/60);
			$v2 = $v1h2 + ($v1m2/60);


			if($v2<=$v1){
				$qtd_horas = (24-$v1) + $v2;
			}else{
				$qtd_horas = (abs($v1 - $v2));
			}

			$qtd_horas = abs($qtd_horas+$escala24h);
			if($qtd_horas>29){
			   $qtd_horas -= 24;
			}

			$turn[$turno['Turno']['id']]['horas'] = $qtd_horas;
			$turn[$turno['Turno']['id']]['qtd'] = $qtd;

		}

		if($selprev=='p'){
			$sql = "select count(*) total from militars_escalas where escala_id='$id' and prevista=1 ";
		}else{
			$sql = "select count(*) total from militars_escalas where escala_id='$id' and cumprida=1 ";
		}
		$todos = $this->Escala->query($sql);
		$todos = $todos[0][0]['total'];

		$sql = "update escalas set efetivo_total=$todos where id='$id'";
		$this->Escala->query($sql);


		if($selprev=='p'){
			$sql = "select count(distinct(previsto)) total from cumprimentoescalas where escalasmonth_id='$escalasmonth' and previsto is not null";
		}else{
			$sql = "select count(distinct(cumprido)) total from cumprimentoescalas where escalasmonth_id='$escalasmonth' and cumprido is not null ";
		}
		//$sql = "select count(*) total from militars_escalas where escala_id=$eid";
		$todosefetivo = $this->Escala->query($sql);
			
		$todosefetivo = $todosefetivo[0][0]['total'];


		$sql = "update escalasmonths set efetivo_total=$todosefetivo where id='$escalasmonth'";
		$this->Escala->query($sql);


		$media = 0.0;
		$mediaalternativa = 0.0;

//				$sql = "select count(*) fora from afastamentos Afastamento where militar_id in (select militar_id from militars_escalas where escala_id='$id' and prevista=1 and ignoraafastamento='N' ) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')  and (Afastamento.motivo not like '%SERVI%RISAER%')  and (Afastamento.motivo not like '%OFICIAL%')  and (Afastamento.motivo not like '%SARGENTO%')  and (Afastamento.motivo not like '%COMANDANTE%')  ";
//			}else{
//				$sql = "select count(*) fora from afastamentos Afastamento where militar_id in (select militar_id from militars_escalas where escala_id='$id' and cumprida=1 and ignoraafastamento='N' ) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')  and (Afastamento.motivo not like '%SERVI%RISAER%')  and (Afastamento.motivo not like '%OFICIAL%')  and (Afastamento.motivo not like '%SARGENTO%')  and (Afastamento.motivo not like '%COMANDANTE%') ";
                
                
		for($c=1;$c<=$qtd_dias;$c++){
			$dataTemp = $dta.'-'.$dtm.'-'.$c;
			//$sql = "select count(*) fora from afastamentos where militar_id in (select militar_id from militars_escalas where escala_id=$id) and (((YEAR(dt_inicio)={$dta} and MONTH(dt_inicio)={$dtm})) OR ((YEAR(dt_termino)={$dta} and MONTH(dt_termino)={$dtm}))) and  (DATEDIFF('{$dataTemp}',dt_inicio)>=0) and (DATEDIFF('{$dataTemp}',dt_termino)<=0 ) and (escala_id=0 or escala_id={$id}) ";
			if($selprev=='p'){
				$sql = "select count(*) fora from afastamentos Afastamento where militar_id in (select militar_id from militars_escalas where escala_id='$id' and prevista=1 and ignoraafastamento='N' ) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')  ";
			}else{
				$sql = "select count(*) fora from afastamentos Afastamento where militar_id in (select militar_id from militars_escalas where escala_id='$id' and cumprida=1 and ignoraafastamento='N' ) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')  ";
			}
			//echo $sql.'<br>';
			$fora = $this->Escala->query($sql);
			$fora = $fora[0][0]['fora'];

			if($selprev=='p'){$sq = 'previsto';$lq = 'legenda_previsto';}else{$sq = 'cumprido';$lq = 'legenda_cumprido';}

			$sql = "select $sq escalado, $lq legenda, id_turno from cumprimentoescalas where dia=$c and escalasmonth_id='$escalasmonth' group by id order by dia, id_turno asc";
			$calculo = $this->Escala->query($sql);

			$dividendo = 0;
			//print_r($calculo);
			foreach($calculo as $calc){
				if(!empty($calc['cumprimentoescalas']['escalado'])){
					$dividendo += $turn[$calc['cumprimentoescalas']['id_turno']]['horas'];
				}
			}
			$media += $dividendo / ($todos - $fora) + 0.0;
			$mediaalternativa += $dividendo / ($todos) + 0.0 ;
		}
		$media = round($media,0);
		$mediaalternativa = round($mediaalternativa,0);
		$media = $media.'/'.$mediaalternativa;
		//$media += $horaInstrucao;
		//	echo $media;exit();
		
		
		
		if($selprev=='p'){
			$sql = "update escalasmonths set media_hora_prevista='$media' where id='$escalasmonth'";
		}else{
			$sql = "update escalasmonths set media_hora='$media' where id='$escalasmonth'";
		}
		$this->Escala->query($sql);
//			group by CumprimentoEscala.dia, Turno.id, escalado

		if($selprev=='p'){
			$sql = "
			select EscalasMonth.nm_escalantep nm_escalante, EscalasMonth.nm_chefe_orgaop nm_chefe_orgao, EscalasMonth.nm_comandantep nm_comandante, EscalasMonth.id,  Turno.id, CumprimentoEscala.id,MilitarsEscala.legenda_prevista codigo, CumprimentoEscala.previsto escalado, EscalasMonth.efetivo_total, EscalasMonth.media_hora_prevista media_hora, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao, CumprimentoEscala.dia, GROUP_CONCAT(DISTINCT CumprimentoEscala.afastamentos SEPARATOR ' ') as obs, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo FROM cumprimentoescalas CumprimentoEscala
			INNER JOIN escalasmonths as EscalasMonth on ( CumprimentoEscala.escalasmonth_id = EscalasMonth.id and EscalasMonth.id='{$id_escalas_month}' )
                        left join militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=EscalasMonth.escala_id and MilitarsEscala.militar_id=CumprimentoEscala.previsto)
			INNER JOIN turnos as Turno ON ( Turno.escala_id = EscalasMonth.escala_id and Turno.id=CumprimentoEscala.id_turno )
			group by CumprimentoEscala.id, CumprimentoEscala.id_turno
			order by CumprimentoEscala.dia,CumprimentoEscala.id, Turno.id  asc
		 ";
		}else{
			//select EscalasMonth.nm_escalantec nm_escalante, EscalasMonth.nm_chefe_orgaoc nm_chefe_orgao, EscalasMonth.nm_comandantec nm_comandante, EscalasMonth.id, CumprimentoEscala.legenda_cumprido,Turno.id, CumprimentoEscala.id, CumprimentoEscala.cumprido, EscalasMonth.efetivo_total, EscalasMonth.media_hora, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao, CumprimentoEscala.dia, GROUP_CONCAT(DISTINCT CumprimentoEscala.afastamentos SEPARATOR ' ') as obs FROM cumprimentoescalas CumprimentoEscala
			$sql = "
			select EscalasMonth.nm_escalantec nm_escalante, EscalasMonth.nm_chefe_orgaoc nm_chefe_orgao, EscalasMonth.nm_comandantec nm_comandante, EscalasMonth.id, Turno.id, CumprimentoEscala.id,MilitarsEscala.legenda_cumprida codigo, CumprimentoEscala.cumprido escalado,CumprimentoEscala.cumprido escalado, EscalasMonth.efetivo_total, EscalasMonth.media_hora media_hora, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao, CumprimentoEscala.dia, GROUP_CONCAT(DISTINCT CumprimentoEscala.afastamentos SEPARATOR ' ') as obs,  Turno.hora_inicio, Turno.hora_termino, Turno.rotulo FROM cumprimentoescalas CumprimentoEscala
			INNER JOIN escalasmonths as EscalasMonth on ( CumprimentoEscala.escalasmonth_id = EscalasMonth.id and EscalasMonth.id='{$id_escalas_month}' )
                        left join militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=EscalasMonth.escala_id and MilitarsEscala.militar_id=CumprimentoEscala.cumprido)
			INNER JOIN turnos as Turno ON ( Turno.escala_id = EscalasMonth.escala_id and Turno.id=CumprimentoEscala.id_turno )
			group by CumprimentoEscala.id, CumprimentoEscala.id_turno
			order by CumprimentoEscala.dia,CumprimentoEscala.id, CumprimentoEscala.id_turno  asc		 ";
                }
                //echo $sql;exit();
		$preenchimentos = $this->Escala->query($sql);
                $preenche[0]['EscalasMonth']['efetivo_total']=$preenchimentos[0]['EscalasMonth']['efetivo_total'];
                $preenche[0]['EscalasMonth']['media_hora']=$preenchimentos[0]['EscalasMonth']['media_hora'];
                $preenche[0]['EscalasMonth']['nm_escalante']=$preenchimentos[0]['EscalasMonth']['nm_escalante'];
                $preenche[0]['EscalasMonth']['nm_chefe_orgao']=$preenchimentos[0]['EscalasMonth']['nm_chefe_orgao'];
                $preenche[0]['EscalasMonth']['nm_comandante']=$preenchimentos[0]['EscalasMonth']['nm_comandante'];
                $preenche[0]['EscalasMonth']['id']=$preenchimentos[0]['EscalasMonth']['id'];
                $preenche[0]['EscalasMonth']['obs_hora_instrucao']=$preenchimentos[0]['EscalasMonth']['obs_hora_instrucao'];
                $preenche[0]['EscalasMonth']['efetivo_total']=$preenchimentos[0]['EscalasMonth']['efetivo_total'];
                $preenche[0]['EscalasMonth']['mes']=$preenchimentos[0]['EscalasMonth']['mes'];
                $preenche[0]['EscalasMonth']['hora_instrucao']=$preenchimentos[0]['EscalasMonth']['hora_instrucao'];
    
                $contagem = 0;
                $dias = $preenchimentos[0]['CumprimentoEscala']['dia'];
                for($i=1;$i<32;$i++){
                    foreach($turnos as $turno){
                      $preenche[$i][0][$turno['Turno']['id']]['legenda']='';
                    }
                }
                foreach($preenchimentos as $preenchimento){
                    if($dias==$preenchimento['CumprimentoEscala']['dia']){
                      $preenche[$dias][$contagem]=$preenchimento['CumprimentoEscala']['id'];
                  }else{
                      $contagem=0;
                      $dias=$preenchimento['CumprimentoEscala']['dia'];
                      $preenche[$dias][$contagem]=$preenchimento['CumprimentoEscala']['id'];
                  }
                      $contagem++;
                  $preenche[$preenchimento['CumprimentoEscala']['dia']][$preenchimento['CumprimentoEscala']['id']][$preenchimento['Turno']['id']]['legenda']=$preenchimento['MilitarsEscala']['codigo'];
                  $preenche[$preenchimento['CumprimentoEscala']['dia']][$preenchimento['CumprimentoEscala']['id']][$preenchimento['Turno']['id']]['escalado']=$preenchimento['CumprimentoEscala']['escalado'];
                  $preenche[$preenchimento['CumprimentoEscala']['dia']][$preenchimento['CumprimentoEscala']['id']][$preenchimento['Turno']['id']]['obs']=$preenchimento[0]['obs'];
                  $preenche[$preenchimento['CumprimentoEscala']['dia']][$preenchimento['CumprimentoEscala']['id']][$preenchimento['Turno']['id']]['rotulo']=$preenchimento['Turno']['rotulo'];
                  
                }
                
                //echo '<pre>';
               // print_r($preenche);echo '</pre>'; exit();
                  
                  
		if($selprev=='p'){
			$campo = 'previsto';
		}else{
			$campo = 'cumprido';
		}
		//or (Militar.id in (select distinct($campo) from cumprimentoescalas where escalasmonth_id={$preenche[0]['EscalasMonth']['id']}))
		if($selprev=='p'){
			$sql1 = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nomecompleto,  concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.nm_completo, Militar.nm_guerra, Militar.saram, Militar.indicativo, MilitarsEscala.legenda_prevista codigo, MilitarsEscala.id, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, Militar.ativa   FROM militars as Militar
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
			LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id)
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.escala_id='$id' and MilitarsEscala.prevista=1 )
			order by  length(MilitarsEscala.legenda_prevista),MilitarsEscala.legenda_prevista asc";
		}else{
			$sql1 = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nomecompleto,  concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.nm_completo, Militar.nm_guerra,  Militar.saram, Militar.indicativo, MilitarsEscala.legenda_cumprida codigo, MilitarsEscala.id, Militar.id, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, Militar.ativa    FROM militars as Militar
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
			LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id)
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.escala_id='$id'  and MilitarsEscala.cumprida=1 )
			order by  length(MilitarsEscala.legenda_cumprida),MilitarsEscala.legenda_cumprida asc";
		}
		
		//echo $sql1;

		$legendas = $this->Escala->query($sql1);

		foreach($legendas as $quadrinho){
			$quadrinhos[$quadrinho['Militar']['id']]=$this->externoquadrinho($quadrinho['Militar']['id'],$seid, $escalasmonthmes);
		}
		//	echo $sql1;

		//print_r($quadrinhos);exit();

		if($selprev=='p'){
			$assinatura = "select Assinatura.militar_id, Assinatura.size, Assinatura.data   FROM assinaturas as Assinatura
			INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.ok_escalantep = Assinatura.militar_id or Escalasmonth.ok_chefep = Assinatura.militar_id)
            ";
		}else{
			$assinatura = "select Assinatura.militar_id, Assinatura.size, Assinatura.data   FROM assinaturas as Assinatura
			INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.ok_escalantec = Assinatura.militar_id or Escalasmonth.ok_chefec = Assinatura.militar_id)
            ";
		}
		$assinaturas = $this->Escala->query($assinatura);
		// echo $assinatura;



		//		INNER JOIN militars as Militar ON (Militar.id in (select distinct($campo) from cumprimentoescalas where escalasmonth_id={$preenche[0]['EscalasMonth']['id']}) and Militar.id=Afastamento.militar_id  and ((YEAR(Afastamento.dt_inicio)={$dta} and MONTH(Afastamento.dt_inicio)={$dtm}) or (YEAR(Afastamento.dt_termino)={$dta} and MONTH(Afastamento.dt_termino)={$dtm}) and Afastamento.motivo not like '%EXPEDIENTE%'))
		//and Afastamento.motivo not like '%EXPEDIENTE%'

		$dtIni = "$dta-$dtm-1";
		$dtFim = "$dta-$dtm-".date('t',strtotime($dtIni));

		if($selprev=='p'){
			$sqlafastamento = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, Militar.indicativo,  Militar.id, Afastamento.* from afastamentos Afastamento
			INNER JOIN militars as Militar ON (Militar.id in (select militar_id from militars_escalas where escala_id='{$id}' and prevista=1 and ignoraafastamento='N' ) and Militar.id=Afastamento.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')
			order by nome asc, Afastamento.motivo,  Afastamento.dt_inicio asc ";

			$sqlafastamentoignorado = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, Militar.indicativo,  Militar.id, Afastamento.* from afastamentos Afastamento
			INNER JOIN militars as Militar ON (Militar.id in (select militar_id from militars_escalas where escala_id='{$id}' and prevista=1 and ignoraafastamento='S' ) and Militar.id=Afastamento.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')
			order by nome asc, Afastamento.motivo,  Afastamento.dt_inicio asc ";
		}else{
			$sqlafastamento = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, Militar.indicativo,  Militar.id, Afastamento.* from afastamentos Afastamento
			INNER JOIN militars as Militar ON (Militar.id in (select militar_id from militars_escalas where escala_id='{$id}' and cumprida=1 and ignoraafastamento='N' ) and Militar.id=Afastamento.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')
			order by nome asc, Afastamento.motivo, Afastamento.dt_inicio asc ";

			$sqlafastamentoignorado = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, Militar.indicativo,  Militar.id, Afastamento.* from afastamentos Afastamento
			INNER JOIN militars as Militar ON (Militar.id in (select militar_id from militars_escalas where escala_id='{$id}' and cumprida=1 and ignoraafastamento='S' ) and Militar.id=Afastamento.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')
			order by nome asc, Afastamento.motivo, Afastamento.dt_inicio asc ";
		}


		//	where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (escala_id=0 or escala_id={$seid})
		//where ((YEAR(Afastamento.dt_inicio)={$dta} and MONTH(Afastamento.dt_inicio)={$dtm}) or (YEAR(Afastamento.dt_termino)={$dta} and MONTH(Afastamento.dt_termino)={$dtm}) ) and (escala_id=0 or escala_id={$id})
		//echo $sqlafastamento;

		$afastamento = $this->Escala->query($sqlafastamento);
		
		//print_r($afastamento);exit();

		$afastamentoignorado = $this->Escala->query($sqlafastamentoignorado);




		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.qtd, Turno.rotulo from turnos as Turno
		where Turno.escala_id = '{$id}' order by Turno.id asc";
		$turnos = $this->Escala->query($sql);
                //echo '<pre>'; print_r($turnos);echo '</pre>'; exit();

		$sql = "select Unidade.sigla_unidade,  Escala.id, Cidade.nome, Setor.sigla_setor from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
		INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.id='{$id}')";
		$unidade = $this->Escala->query($sql);

		$sql = "select * from versoescalas Versoescala where escalasmonth_id='{$preenche[0]['EscalasMonth']['id']}'";
		$verso = $this->Escala->query($sql);

		$this->set('consultasql',$sqlafastamento);
		$this->set(compact('quadrinhos','assinaturas','escala', 'preenche', 'turnos','legendas','dtm','dta','selprev','unidade','verso', 'afastamento','escalasmonths', 'afastamentoignorado'));
		//print_r($assinaturas);

		$u=$this->Session->read('Usuario');
                

		/*
		 echo "<pre>";
		 print_r($preenche);
                 print_r($escala);
		 echo "</pre>";
		 exit(1);
                 * 
                 */
		$this->render();
	}


	function externoPdf($ano = null, $mes = null)
	{
		$this->layout = 'pdf';
		//$this->layout = 'admin';
                

                
		if($mes<10){
			$mes = '0'.$mes;
		}
		$dta = $ano;
		$dtm = $mes;
		$u=$this->Session->read('Usuario');
                
		if($u[0]['Usuario']['privilegio_id']==1){
			$setores = " and 1=1 ";
		}else{
			$setores = " and Setor.id in (".$u[0][0]['setores'].") ";
		}
		$sql = "select Escala.tipo, Escalasmonth.id,Escalasmonth.hora_instrucao, Escalasmonth.ok_chefep, Escalasmonth.ok_chefec, Escalasmonth.ok_chefeorgaop, Escalasmonth.ok_chefeorgaoc, Escalasmonth.ok_escalantep, Escalasmonth.ok_escalantec, Escalasmonth.ok_comandantep, Escalasmonth.ok_comandantec, Escalasmonth.destrava_prevista, Escalasmonth.destrava_cumprida, Escalasmonth.escala_id
		from escalasmonths Escalasmonth 
		inner join escalas Escala on (Escala.id=Escalasmonth.escala_id)
		inner join setors Setor on (Setor.id=Escala.setor_id $setores)
		where Escalasmonth.mes=".$ano.$mes;
		$escalasDoMes = $this->Escala->query($sql);
		//print_r($escalasDoMes);
		$indice=0;

		foreach($escalasDoMes  as $dados){
			$id=$dados['Escalasmonth']['escala_id'];

           $tipo = $dados['Escala']['tipo'];
           if(($tipo=='RISAER')||($tipo=='TECNICA')){
               $escala24h = 24;
           }else{
               $escala24h = 0;
           }
   			
			$sqlc = 'select Escalasmonth.id,Escalasmonth.hora_instrucao, Escalasmonth.ok_chefep, Escalasmonth.ok_chefec, Escalasmonth.ok_chefeorgaop, Escalasmonth.ok_chefeorgaoc, Escalasmonth.ok_escalantep, Escalasmonth.ok_escalantec, Escalasmonth.ok_comandantep, Escalasmonth.ok_comandantec, Escalasmonth.destrava_prevista, Escalasmonth.destrava_cumprida from escalasmonths Escalasmonth where Escalasmonth.escala_id="'.$id.'" and Escalasmonth.mes='.$ano.$mes;
			$escalasmonths[$indice] = $this->Escala->query($sqlc);
			$id_escalas_month = $escalasmonths[$indice][0]['Escalasmonth']['id'];
			$horaInstrucao = $escalasmonths[$indice][0]['Escalasmonth']['hora_instrucao'];
			$escalasmonth = $id_escalas_month;
			$dtIni = "$dta/$dtm/1";
			$qtd_dias = date('t',strtotime($dtIni));
			$constante = 0;
			$turnosA = $this->Escala->query("select * from turnos Turno where Turno.escala_id='$id' order by Turno.id asc");
			foreach($turnosA as $turno){
				$inicio = strtotime($turno['Turno']['hora_inicio']);
				$termino = strtotime($turno['Turno']['hora_termino']);
				$qtd = $turno['Turno']['qtd'];
				$v1h1 = date('G', $inicio);
				$v1h2 = date('G', $termino);
				$v1m1 = date('i', $inicio);
				$v1m2 = date('i', $termino);
				$v1 = $v1h1 + ($v1m1/60);
				$v2 = $v1h2 + ($v1m2/60);
				if($v2<=$v1){
					$qtd_horas = (24-$v1) + $v2;
				}else{
					$qtd_horas = (abs($v1 - $v2));
				}
				$qtd_horas = abs($qtd_horas+$escala24h);
				if($qtd_horas>29){
				   $qtd_horas -= 24;
				}
				
				
				$turn[$indice][$turno['Turno']['id']]['horas'] = $qtd_horas;
				$turn[$indice][$turno['Turno']['id']]['qtd'] = $qtd;
			}
			$sql = "select count(*) total from militars_escalas where escala_id='$id' and prevista=1";
			$todos = $this->Escala->query($sql);
			$todos[$indice] = $todos[0][0]['total'];
			$sql = "select count(distinct(previsto)) total from cumprimentoescalas where escalasmonth_id='$escalasmonth' and previsto<>'0'";
			$todosefetivo = $this->Escala->query($sql);
			$todosefetivo[$indice] = $todosefetivo[0][0]['total'];
			$sql = "
					select EscalasMonth.nm_escalantep nm_escalante, EscalasMonth.nm_chefe_orgaop nm_chefe_orgao, EscalasMonth.nm_comandantep nm_comandante, EscalasMonth.id, CumprimentoEscala.legenda_previsto, Turno.id, CumprimentoEscala.id, CumprimentoEscala.previsto, EscalasMonth.efetivo_total, EscalasMonth.media_hora_prevista, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao, CumprimentoEscala.dia, GROUP_CONCAT(DISTINCT CumprimentoEscala.afastamentos SEPARATOR ' ') as obs FROM cumprimentoescalas CumprimentoEscala
					INNER JOIN escalasmonths as EscalasMonth on ( CumprimentoEscala.escalasmonth_id = EscalasMonth.id and EscalasMonth.mes={$dta}{$dtm} )
					INNER JOIN escalas as Escala ON (Escala.id = '{$id}' and EscalasMonth.escala_id = Escala.id  )
					INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id )
					group by CumprimentoEscala.id, CumprimentoEscala.dia
					order by CumprimentoEscala.dia, CumprimentoEscala.id  asc
				 ";
			$preenche[$indice] = $this->Escala->query($sql);
			//print_r($preenche[$indice]);exit();
			$campo = 'previsto';
			$sql1 = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nomecompleto,  concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.nm_completo, Militar.nm_guerra, Militar.saram, Militar.indicativo, MilitarsEscala.legenda_prevista codigo, MilitarsEscala.id, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade   FROM militars as Militar
					INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
					LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
					LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
					LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id)
					INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.escala_id='$id' and MilitarsEscala.prevista=1 )
					order by  length(MilitarsEscala.legenda_prevista),MilitarsEscala.legenda_prevista asc";
			$legendas[$indice] = $this->Escala->query($sql1);
			$dtIni = "$dta-$dtm-1";
			$dtFim = "$dta-$dtm-".date('t',strtotime($dtIni));
			$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.qtd, Turno.rotulo from turnos as Turno
				where Turno.escala_id = '{$id}' order by Turno.id asc";
			$turnos[$indice] = $this->Escala->query($sql);

			$sql = "select Unidade.sigla_unidade,  Escala.id, Cidade.nome, Setor.sigla_setor from setors Setor
				LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
				LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
				INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.id='{$id}')";
			$unidade[$indice] = $this->Escala->query($sql);

			$sql1 = "
select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade,' ') as posto, concat( Militar.nm_completo,' ', 
Posto.sigla_posto,' ',Quadro.sigla_quadro,' ', Especialidade.nm_especialidade) as nomecompleto, concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ', 
Especialidade.nm_especialidade) as postograd, Militar.nm_completo, Militar.identidade, Militar.nm_guerra, Militar.saram, Militar.indicativo, 
 Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, Privilegio.descricao FROM militars as Militar 
INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) 
INNER JOIN escalas as Escala on (Escala.id ='$id')
INNER JOIN setors as Setor on (Escala.setor_id=Setor.id) 
LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id) 
LEFT JOIN usuarios Usuario on (Usuario.militar_id=Militar.id) 
INNER JOIN privilegios Privilegio on (Privilegio.id=Usuario.privilegio_id) 
INNER JOIN setors_usuarios SetorsUsuario on (SetorsUsuario.usuario_id=Usuario.id and SetorsUsuario.setor_id=Setor.id) 
					order by  Privilegio.descricao asc, Militar.nm_guerra asc";
			//	where Usuario.privilegio_id=6 or Usuario.privilegio_id=5
			//	echo $sql1;exit();
			$privilegios[$indice] = $this->Escala->query($sql1);
			$indice++;
		}

		//print_r($privilegios);exit();
		//$turnos = $turn;
		$this->set(compact('escala','preenche', 'turnos','legendas','dtm','dta','selprev','unidade','escalasmonths','privilegios'));

		$u=$this->Session->read('Usuario');
                
		//exit();
		$this->render();
	}

	function geraescala($id = null)
	{
	   $conta = 0;
	   foreach($this->data['Escala']['ids'] as $duplicaid){

	    $this->Escala->recursive = 0;
		$escalas = $this->Escala->find('all', array(
		 'conditions' => "Escala.mes={$this->data['Escala']['mes']} AND Escala.ano={$this->data['Escala']['ano']} and Escala.id='".$duplicaid."'",
		 'fields' => '',
		 'recursive'=>0,
		 'order'=>''				
		 ));



		 $ano = $this->data['Escala']['ano'];
		 $mes = $this->data['Escala']['mes'];


	 	foreach($escalas as $escala){
		 	$idescala = $escala['Escala']['id'];
		 	unset($escala['Escala']['id']);
		 	unset($escala['Escala']['created']);
		 	unset($id_insere_escala);// = null;
		 	$escala['Escala']['mes'] = $this->data['Escala']['mesdestino'];
		 	$escala['Escala']['ano'] = $this->data['Escala']['anodestino'];

		 	$verificaEscala = "select * from escalas where setor_id='{$escala['Escala']['setor_id']}'  and mes={$escala['Escala']['mes']} and ano={$escala['Escala']['ano']}";
		 	$quantidade = count($this->Escala->query($verificaEscala));
		 		
		 	if($quantidade==0){
		 		$insereEscala="insert into escalas (id, tipo, setor_id, nm_escalante, nm_chefe_orgao, nm_comandante, efetivo_total, dt_limite_cumprida, dt_limite_previsao, ativa, mes, ano) values (uuid(), '{$escala['Escala']['tipo']}','{$escala['Escala']['setor_id']}', '{$escala['Escala']['nm_escalante']}', '{$escala['Escala']['nm_chefe_orgao']}', '{$escala['Escala']['nm_comandante']}', {$escala['Escala']['efetivo_total']}, {$escala['Escala']['dt_limite_cumprida']}, {$escala['Escala']['dt_limite_previsao']}, {$escala['Escala']['ativa']}, {$escala['Escala']['mes']}, {$escala['Escala']['ano']})";
		 		$this->Escala->query($insereEscala);
		 		$verificaEscala = "select id from escalas Escala where setor_id='{$escala['Escala']['setor_id']}'  and mes={$escala['Escala']['mes']} and ano={$escala['Escala']['ano']}";
		 		$idResult = $this->Escala->query($verificaEscala);
		 		$id_insere_escala = $idResult[0]['Escala']['id'];

		 		if(!empty($id_insere_escala)){

		 			$this->Escala->Turno->recursive = 0;

		 			$turnos = $this->Escala->Turno->query("select * from turnos Turno where Turno.escala_id='{$idescala}' order by Turno.id asc");

				 	foreach($turnos as $turno){
				 		$idturno = $turno['Turno']['id'];
				 		unset($turno['Turno']['id']);
				 		unset($turno['Turno']['dt_escala']);
				 		$turno['Turno']['escala_id'] = $id_insere_escala;
				 		$this->Escala->Turno->query("insert into turnos (id, escala_id, hora_inicio, hora_termino, qtd, rotulo, dt_escala) values (uuid(),'{$turno['Turno']['escala_id']}', '{$turno['Turno']['hora_inicio']}', '{$turno['Turno']['hora_termino']}', {$turno['Turno']['qtd']}, '{$turno['Turno']['rotulo']}',now()) ");

				 	}

				 	$this->Escala->MilitarsEscala->recursive = 0;

				 	$militars = $this->Escala->MilitarsEscala->find('all', array(
					 'conditions' => "MilitarsEscala.escala_id='{$idescala}' ",
					 'fields' => '',
					 'recursive'=>0,
					 'order'=>'MilitarsEscala.id asc'				
					 ));

					 $lista = "select * from militars_escalas MilitarsEscala where MilitarsEscala.escala_id='{$idescala}' ";
					 $militars = $this->Escala->query($lista);

					 foreach($militars as $militar){
					 	unset($militar['MilitarsEscala']['id']);
					 	unset($militar['MilitarsEscala']['escala_id']);
					 	$idmilitar = $militar['MilitarsEscala']['militar_id'];
					 	$militar['MilitarsEscala']['escala_id'] = $id_insere_escala;
					 	$sqlativa = 'select ativa from militars  where id="'.$idmilitar.'" and ativa>0';
					 	$consultaativa = $this->Escala->query($sqlativa);
					 	if(count($consultaativa)>0){
					 		$insere = "insert into militars_escalas (id, escala_id, militar_id, legenda_prevista, legenda_cumprida, prevista, cumprida, ignoraafastamento)		values (uuid(),'{$id_insere_escala}','{$idmilitar}','{$militar['MilitarsEscala']['legenda_prevista']}','{$militar['MilitarsEscala']['legenda_cumprida']}', {$militar['MilitarsEscala']['prevista']}, {$militar['MilitarsEscala']['cumprida']}, '{$militar['MilitarsEscala']['ignoraafastamento']}');";
					 		$this->Escala->MilitarsEscala->query($insere);
					 	}
					 }
					 $conta++;

		 		}
		 	}
	 	}
	 	
	   }
	    header('Content-type: application/x-json');
        echo '{ "ok":"1", "mensagem":"'.$conta.' duplicações efetuadas'.'"}';
        exit();

	}

	function zera()
	{
		//print_r($this->data);
		$opcao = $this->data['Escala']['opcao'];
		$dtm = $this->data['Escala']['mes'];
		$dta = $this->data['Escala']['ano'];
		$selprev = $this->data['Escala']['prevista'];
		$id = $this->data['Escala']['id'];
		if($opcao=='ATUAL'){
			$escala = $this->Escala->findById($id);
			$seid = $escala['Escala']['setor_id'];



			$sql = "delete cumprimentoescalas from cumprimentoescalas, escalasmonths where escalasmonths.escala_id='{$id}' and escalasmonths.mes={$dta}{$dtm} and cumprimentoescalas.escalasmonth_id=escalasmonths.id";
			$apaga = $this->Escala->query($sql);

			if($selprev=='p'){
				$sql = "select Militar.id, Militar.dt_ultima_promocao, Posto.antiguidade, MilitarsEscala.id, MilitarsEscala.legenda_prevista codigo, Militar.indicativo FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN militars_escalas as MilitarsEscala on (MilitarsEscala.escala_id='{$id}' and MilitarsEscala.militar_id=Militar.id and MilitarsEscala.prevista=1)
				group by MilitarsEscala.id order by Posto.antiguidade desc,	Militar.dt_ultima_promocao asc	";
			}else{
				$sql = "select Militar.id, Militar.dt_ultima_promocao, Posto.antiguidade, MilitarsEscala.id, MilitarsEscala.legenda_cumprida codigo, Militar.indicativo FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN militars_escalas as MilitarsEscala on (MilitarsEscala.escala_id='{$id}' and MilitarsEscala.militar_id=Militar.id and MilitarsEscala.cumprida=1)
				group by MilitarsEscala.id order by Posto.antiguidade desc,	Militar.dt_ultima_promocao asc	";
			}

			$antiguidade = $this->Escala->query($sql);
			$max = count($antiguidade);

			$sqlc = 'select Escalasmonth.id,Escalasmonth.hora_instrucao from escalasmonths Escalasmonth where Escalasmonth.escala_id="'.$id.'" and Escalasmonth.mes='.$dta.$dtm;
			$idescalasmonth = $this->Escala->query($sqlc);
			$id_escalas_month = $idescalasmonth[0]['Escalasmonth']['id'];
			$horaInstrucao = $idescalasmonth[0]['Escalasmonth']['hora_instrucao'];

			$dtIni = "$dta/$dtm/1";
			$vetor = 0;
			$evita_loop = 0;

			$qtd_dias = date('t',strtotime($dtIni));

			for ($d=1;$d<=$qtd_dias;$d++){
				$dataTemp = "{$dta}-{$dtm}-{$d}";
				$afastados = '';
				if($selprev=='p'){
					$consulta_afastamento = "select MilitarsEscala.legenda_prevista codigo from militars_escalas MilitarsEscala
					INNER JOIN afastamentos Afastamento on (Afastamento.militar_id=MilitarsEscala.militar_id and MilitarsEscala.escala_id='{$id}'
					and MilitarsEscala.prevista=1 and
					(DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}'))   and MilitarsEscala.ignoraafastamento='N'	";
				}else{

					$consulta_afastamento = "select MilitarsEscala.legenda_cumprida codigo from militars_escalas MilitarsEscala
					INNER JOIN afastamentos Afastamento on (Afastamento.militar_id=MilitarsEscala.militar_id and MilitarsEscala.escala_id='{$id}'
					and MilitarsEscala.cumprida=1 and
					(DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')  )	  and MilitarsEscala.ignoraafastamento='N'";
				}
				//(((YEAR(dt_inicio)={$dta} and MONTH(dt_inicio)={$dtm})) OR ((YEAR(dt_termino)={$dta} and MONTH(dt_termino)={$dtm}))) and  (DATEDIFF('{$dataTemp}',dt_inicio)>=0) and (DATEDIFF('{$dataTemp}',dt_termino)<=0 )) ";
				$afastamento = $this->Escala->query($consulta_afastamento);
				//echo $consulta_afastamento.'<br>';


				foreach($afastamento as $afastado){
					$afastados .= $afastado['MilitarsEscala']['codigo'].' ';
				}
				//print_r($escala['Turno']);

				foreach ($escala['Turno'] as $turno){
					$qtd_militares = $turno['qtd'];
					for($c=1;$c<=$qtd_militares;$c++){
						$consulta_afastamento = "select * from afastamentos Afastamento where militar_id={$antiguidade[$vetor]['Militar']['id']} and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}') ";
						//$sql = "select count(*) fora from afastamentos where militar_id in (select militar_id from militars_escalas where escala_id=$eid) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (escala_id=0 or escala_id={$id}) ";
						$afastamento = $this->Escala->query($consulta_afastamento);

						while(!empty($afastamento[0]['Afastamento']['militar_id'])){
							//	$afastados .= $antiguidade[$vetor]['MilitarsEscala']['codigo'].' ';
							$vetor++;
							if($vetor>=$max){
								$vetor = 0;
								$evita_loop++;
							}
							if($evita_loop==1000){
								$evita_loop = 0;
								break;
							}
							$consulta_afastamento = "select * from afastamentos Afastamento where militar_id='{$antiguidade[$vetor]['Militar']['id']}' and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')  ";
							$afastamento = $this->Escala->query($consulta_afastamento);
						}
						$dados['militars_escala_id'] = $antiguidade[$vetor]['Militar']['id'];
						$dados['escalas_turno_id'] = $turno['id'];
						$dados['legenda'] = $antiguidade[$vetor]['MilitarsEscala']['codigo'];
						$sql = "insert into cumprimentoescalas (id, escalasmonth_id, id_turno,  dia, previsto, cumprido, afastamentos, legenda_previsto, legenda_cumprido) values(uuid(),'{$id_escalas_month}', '{$dados['escalas_turno_id']}',{$d},'{$dados['militars_escala_id']}','{$dados['militars_escala_id']}','{$afastados}','{$dados['legenda']}','{$dados['legenda']}')";
						//echo $sql.'<br>';

						$this->Escala->query($sql);
						$afastados = '';
						$vetor++;
						if($vetor>=$max){
							$vetor = 0;
							$evita_loop++;
						}
						if($evita_loop==1000){
							$evita_loop = 0;
							break;
						}
					}
				}
			}

			// -------------------------------------------------------------------------

			$this->Escala->MilitarsEscala->recursive = 0;
			$mescala = $this->Escala->MilitarsEscala->findById($meid);

			$sql = "select Escalasmonth.id, Escalasmonth.escala_id, Cumprimentoescala.dia, SUBSTRING(Escalasmonth.mes,5,2) as mes, SUBSTRING(Escalasmonth.mes,1,4) as ano from cumprimentoescalas Cumprimentoescala
			inner join escalasmonths Escalasmonth on (Escalasmonth.id=Cumprimentoescala.escalasmonth_id and Cumprimentoescala.id='{$cid}')";
			$data = $this->Escala->query($sql);
			$eid =  $id;
			$emid =  $id_escalas_month;

			$mes = $dtm;
			$ano = $dta;

			$dtIni = "$ano/$mes/$dia";
			$qtd_dias = date('t',strtotime($dtIni));

			$turnosmedia = $this->Escala->query("select * from turnos Turno where Turno.escala_id='$eid' order by Turno.id asc");
			//print_r($turnos);
			foreach($turnosmedia as $turno){
				$inicio = strtotime($turno['Turno']['hora_inicio']);
				$termino = strtotime($turno['Turno']['hora_termino']);
				$qtd = $turno['Turno']['qtd'];

				$v1h1 = date('G', $inicio);
				$v1h2 = date('G', $termino);
				$v1m1 = date('i', $inicio);
				$v1m2 = date('i', $termino);

				$v1 = $v1h1 + ($v1m1/60);
				$v2 = $v1h2 + ($v1m2/60);

				$v3 = $turno['Turno']['qtd'];

				if($v2<=$v1){
					$qtd_horas = (24-$v1) + $v2;
				}else{
					$qtd_horas = (abs($v1 - $v2));
				}
				$turn[$turno['Turno']['id']]['horas'] = $qtd_horas;
				$turn[$turno['Turno']['id']]['qtd'] = $qtd;


			}

			if($selprev=='p'){
				$sql = "select count(*) total from militars_escalas where escala_id='$eid' and prevista=1  ";
			}else{
				$sql = "select count(*) total from militars_escalas where escala_id='$eid' and cumprida=1  ";
			}
			$todos = $this->Escala->query($sql);
			$todos = $todos[0][0]['total'];

			$sql = "update escalas set efetivo_total=$todos where id='$eid'";
			$this->Escala->query($sql);

			if($selprev=='p'){
				$sql = "select count(distinct(previsto)) total from cumprimentoescalas where escalasmonth_id='$emid' and previsto is not null";
			}else{
				$sql = "select count(distinct(cumprido)) total from cumprimentoescalas where escalasmonth_id='$emid' andcumprido is not null";
			}
			$todosefetivo = $this->Escala->query($sql);

			$todosefetivo = $todosefetivo[0][0]['total'];

			$sql = "update escalasmonths set efetivo_total=$todosefetivo where id='$emid'";
			$this->Escala->query($sql);



			$media = 0.0;
			$mediaalternativa = 0.0;
			
			for($c=1;$c<=$qtd_dias;$c++){
				$dataTemp = $ano.'-'.$mes.'-'.$c;
				//$sql = "select count(*) fora from afastamentos where militar_id in (select militar_id from militars_escalas where escala_id=$eid) and (((YEAR(dt_inicio)={$ano} and MONTH(dt_inicio)={$mes})) OR ((YEAR(dt_termino)={$ano} and MONTH(dt_termino)={$mes}))) and  (DATEDIFF('{$dataTemp}',dt_inicio)>=0) and (DATEDIFF('{$dataTemp}',dt_termino)<=0 )  and (escala_id=0 or escala_id={$eid})";
				if($selprev=='p'){
					$sql = "select count(*) fora from afastamentos Afastamento where militar_id in (select militar_id from militars_escalas where escala_id='$eid' and prevista=1 and ignoraafastamento='N' ) and  (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')    ";
				}else{
					$sql = "select count(*) fora from afastamentos Afastamento. where militar_id in (select militar_id from militars_escalas where escala_id='$eid' and cumprida=1 and ignoraafastamento='N' ) and (DATEDIFF('{$dataTemp}',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')   ";
				}
				//echo $sql.'<br>';

				$fora = $this->Escala->query($sql);
				$fora = $fora[0][0]['fora'];

				if($pc=='p'){$sq = 'previsto';}else{$sq = 'cumprido';}

				$sql = "select $sq escalado, id_turno from cumprimentoescalas where dia=$c and escalasmonth_id='$emid' order by dia, id_turno asc";
				$calculo = $this->Escala->query($sql);

				$dividendo = 0;
				//print_r($calculo);
				foreach($calculo as $calc){
					if(!empty($calc['cumprimentoescalas']['escalado'])){
						$dividendo += $turn[$calc['cumprimentoescalas']['id_turno']]['horas']*1;
					}
				}


				$media += $dividendo / ($todos - $fora);
				$mediaalternativa += $dividendo / ($todos);
				
			}
			$media = round($media,0);
		$mediaalternativa = round($mediaalternativa,0);
		$media = $media.'/'.$mediaalternativa;
						
			
			//$media += 0;
			//$media += $horaInstrucao;

			$sql = "update escalasmonths set media_hora_prevista=$media, media_hora=$media  where id='$emid'";
			$this->Escala->query($sql);


			// -------------------------------------------------------------------------


		}
		if($opcao=='ANTERIOR'){}

		if($opcao=='ZERAR'){

			//----------------------------------------------------------------
			$ip = $_SERVER['REMOTE_ADDR'];
			$u = $this->Session->read('Usuario');
			$usuario = $u[0][0]['nome'];

			$consultaescala = 'select * from escalas Escala
		inner join turnos Turno on (Turno.escala_id="'.$id.'" )
		inner join setors Setor on (Setor.id=Escala.setor_id)
		inner join militars_escalas MilitarsEscala on (MilitarsEscala.escala_id="'.$id.'" )
		where Escala.id="'.$id.'"
		';
			//echo $consultaescala;
			//
			$resultsetor=$this->Escala->query($consultaescala);
			//print_r($resultsetor);
			$rsetor=$resultsetor[0]['Setor']['sigla_setor'];
			$mudanca = '<u><b>Escala limpa</b></u>';
			$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação na Escala '.$rsetor.'",now(),"ESCALA", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
			//		echo $monitora;
			//		exit();
			$this->Escala->query($monitora);
			//------------------------------------------------------------------------------------------------------------
			$sql = "delete cumprimentoescalas from cumprimentoescalas, escalasmonths where escalasmonths.escala_id='{$id}' and escalasmonths.mes={$dta}{$dtm} and cumprimentoescalas.escalasmonth_id=escalasmonths.id";
			//echo $sql;
			//exit();
			$apaga = $this->Escala->query($sql);
		}

		$diaInicial = $this->data['Escala']['diaInicial'];
		$diaFinal = $this->data['Escala']['diaFinal'];
		//exit(1);
		$this->redirect(array('action'=>'escala'.'/'.$id.'/'.$dtm.'/'.$dta.'/'.$selprev.'/'.$diaInicial.'/'.$diaFinal));


	}

	function ajax($idescalaorigem = null, $idsetordestino = null)
	{

		/*
		 $horas = '';
		 for($i=0;$i<=23;$i++){
			if($i>9){
			$horas.='<option value="'.$i.'">'.$i.'</option>';
			}else{
			$horas.='<option value="'.$i.'">'.'0'.$i.'</option>';
			}
			}
			$militares = '';
			for($i=1;$i<=20;$i++){
			if($i>9){
			$militares.='<option value="'.$i.'">'.$i.'</option>';
			}else{
			$militares.='<option value="'.$i.'">'.'0'.$i.'</option>';
			}
			}
			$minutos = '';
			for($i=0;$i<=59;$i++){
			if($i>9){
			$minutos.='<option value="'.$i.'">'.$i.'</option>';
			}else{
			$minutos.='<option value="'.$i.'">'.'0'.$i.'</option>';
			}
			}

			$script=<<<HARD
			var horas=new Array();
			var minutos=new Array();
			var quantidade=new Array();
			var form=$('EscalaAddForm');
			var h =form.getInputs('select','data[Escala][turno_inicio][hour][]');
			var m =form.getInputs('select','data[Escala][turno_inicio][min][]');
			var q =form.getInputs('text','data[Escala][turno_qtd][]');

			h.each(function(x){horas.push(Number(x.value));});
			m.each(function(y){minutos.push(Number(y.value));});
			q.each(function(z){quantidade.push(Number(z.value));});

			var id=$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].value;
			var nome=$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].text;

			var c1=0;
			if (militares.indexOf(Number(id))==-1){c1=0;}else{c1=1;}

			var c2=0;
			var ind=$('indicativo').value;
			if (legendas.indexOf(ind)==-1){c2=0;}else{c2=1;}

			if (($('indicativo').value!='')&&(c1==0)&&(c2==0)){
			}else{
			alert('Observe atentamente se não há repetição de militare(s) e/ou legenda(s) !!');
			}



			HARD;

			for($i=1;$i<=$n;$i++){

			//	$script="\$('EscalaTotMilitares').value = 0;for(i=1;i<={$n};i++){\$('EscalaTotMilitares').value = Number(\$('EscalaTotMilitares').value) + Number(\$('Escala'+i+'TurnoQtd').options[\$('Escala'+i+'TurnoQtd').options.selectedIndex].text);}";

			$teste_turnos.= '
			<div style="" id="turnos" class="input time"><label for="EscalaTurnoInicioHour">'.$i.'-> Turno Inicio</label>
			<select id="EscalaTurnoInicioHour" name="data[Escala][turno_inicio][hour][]">
			<option selected="selected" value=""></option>
			'.$horas.'
			</select>:<select id="EscalaTurnoInicioMin" name="data[Escala][turno_inicio][min][]">
			<option selected="selected" value=""></option>
			'.$minutos.'
			</select><label>
			Qtd: </label><select id="EscalaTurnoQtd" size="1" name="data[Escala][turno_qtd][]">
			<option value="empty"/>
			'.$militares.'
			</select></div>
			';
			}

			$teste_turnos=$teste_turnos;
			*/
		#Consulta
		if(!empty($idescalaorigem)&&!empty($idsetordestino)){

			$this->Escala->recursive = 0;
			$consulta = $this->Escala->findBySetorId($idsetordestino);

			if(!empty($consulta['Escala']['id'])){
				$ok = 0;
				$mensagem = "Não foi cadastrado! Setor informado já possui escala cadastrada!";

			}else{
					
				$sql1 = "insert into escalas(id, setor_id, nm_escalante,nm_chefe_orgao, nm_comandante, efetivo_total, dt_limite_cumprida, dt_limite_previsao, created, ativa)
				select uuid(),'$idsetordestino', nm_escalante, nm_chefe_orgao, nm_comandante, efetivo_total, dt_limite_cumprida, dt_limite_previsao, created, ativa from escalas where id='$idescalaorigem'";
				$this->Escala->query($sql1);

				$sql2="insert into turnos(id, escala_id, hora_inicio, hora_termino, qtd, dt_escala )
				select  uuid(), (select id from escalas where setor_id='$idsetordestino') , hora_inicio, hora_termino, qtd, dt_escala from turnos where escala_id='$idescalaorigem' order by id asc";
				$this->Escala->query($sql2);

				$sql3="insert into militars_escalas(id, escala_id, militar_id, codigo) select uuid(),(select id from escalas where setor_id='$idsetordestino'), militar_id, codigo from militars_escalas where escala_id='$idescalaorigem'";
				$this->Escala->query($sql3);
					
					
				$ok = 1;
				$mensagem = "Escala duplicada !";
			}

		}else{
			$ok = 0;
			$mensagem = "Não foi cadastrado! Informe um setor válido!";
		}
		echo '{ "mensagem":"'.$mensagem.'", "ok":"'.$ok.'" }';
			
		exit();
		/*
		 $this->layout = 'ajax_embutido'; //this will use the pdf.thtml layout
		 $this->set('teste_turnos',$teste_turnos);
		 $this->render();
		 */
	}

	function ajaxdelete($id = null)
	{
		$this->layout = 'ajax_embutido'; //this will use the pdf.thtml layout
		if (!$id) {
			$mensagem='0';
		}
		if (!empty($id)) {
			$turno = $this->Escala->Turno->read(null, $id);
			$escala_id = $turno['Turno']['escala_id'];

			//----------------------------------------------------------------
			$ip = $_SERVER['REMOTE_ADDR'];
			$u = $this->Session->read('Usuario');
			$usuario = $u[0][0]['nome'];

			$consultaescala = 'select Setor.sigla_setor, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo, Escala.mes, Escala.ano
		 from escalas Escala
		inner join setors Setor on (Setor.id=Escala.setor_id and Escala.id="'.$escala_id.'" )
		inner join turnos Turno on (Turno.id="'.$id.'" and Turno.escala_id="'.$escala_id.'" )
		';
			//
			$resultsetor=$this->Escala->MilitarsEscala->query($consultaescala);
			$mudanca = 'Excluído o Turno->'.$resultsetor[0]['Turno']['rotulo'].' -> '.$resultsetor[0]['Turno']['hora_inicio'].'-'.$resultsetor[0]['Turno']['hora_termino'].' da Escala:'.$resultsetor[0]['Setor']['sigla_setor'].' '.$resultsetor[0]['Escala']['mes'].'/'.$resultsetor[0]['Escala']['ano'].' no dia:'.date('d-m-Y h:i');
			$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Excluir militars_escalas",now(),"TURNOS", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
			//		echo $monitora;
			//		exit();
			$this->Escala->query($monitora);
			//------------------------------------------------------------------------------------------------------------
				
				
			$apagar = "delete escalasmonths, cumprimentoescalas from escalasmonths, cumprimentoescalas where escalasmonths.escala_id='".$escala_id."' and escalasmonths.id=cumprimentoescalas.escalasmonth_id";
			$apaga = $this->Escala->Turno->query($apagar);
			if($this->Escala->Turno->delete($id)){
				$mensagem='1';

			}else{
				$mensagem='0';

			}

			$mensagem='1';
		}else{
			$mensagem='0';
		}
		$this->set('mensagem',$mensagem);
		$this->render();
	}

	function ajaxdelmil($id = null)
	{
		//$this->layout = 'ajax_embutido'; //this will use the pdf.thtml layout
		if (!$id) {
			$ok='0';
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
		$consultamilitar = 'select Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade,
		Militar.nm_completo from militars Militar
		left join postos Posto on (Posto.id=Militar.posto_id)
		left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		inner join militars_escalas MilitarEscala on (MilitarEscala.militar_id=Militar.id and MilitarEscala.id="'.$id.'")';
		$result=$this->Escala->MilitarsEscala->query($consultamilitar);
		$militar = $result[0]['Posto']['sigla_posto'].' '.$result[0]['Quadro']['sigla_quadro'].' '.$result[0]['Especialidade']['nm_especialidade'].' '.$result[0]['Militar']['nm_completo'];

		$consultaescala = 'select Setor.sigla_setor, Escala.mes, Escala.ano
		 from militars_escalas MilitarEscala
		inner join escalas Escala on (Escala.id=MilitarEscala.escala_id and MilitarEscala.id="'.$id.'")
		inner join setors Setor on (Setor.id=Escala.setor_id)';
		$resultsetor=$this->Escala->MilitarsEscala->query($consultaescala);
		$escala = $resultsetor[0]['Setor']['sigla_setor'];
		$mudanca = 'Excluído o Militar->'.$militar.' da Escala:'.$escala.' '.$resultsetor[0]['Escala']['mes'].'/'.$resultsetor[0]['Escala']['ano'].' no dia:'.date('d-m-Y h:i');
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Excluir militars_escalas",now(),"MILITARS_ESCALAS", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		//		echo $monitora;
		//		exit();
		$this->Escala->query($monitora);

		if ($this->Escala->MilitarsEscala->delete($id)) {
			$ok='1';
		}else{
			$ok='0';
		}
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();
	}

	function index($mes = null,$ano = null) {
		//$id=57;
	 	$this->redirect(array('action'=>'view'));
		
	}

	function indexa_() {
		//$id=57;
		$u=$this->Session->read('Usuario');
                
		$insere = 0;
		if(empty($this->data['Escala']['ano'])){
			$this->data['Escala']['ano'] = date('Y');
			$this->data['Escala']['mes'] = date('m');
		}

		if(!empty($this->data)){
			if($this->data['Escala']['mes']=='TODOS'){
				/*
				 $sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				 where CONCAT(Escala.id,'{$this->data['Escala']['ano']}') not in (select CONCAT(escala_id,SUBSTRING(mes,1,4)) from escalasmonths group by escala_id)
				 ";
				 */

				$sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				where Escala.ano={$this->data['Escala']['ano']} and Escala.ano not in (select SUBSTRING(mes,1,4) from escalasmonths group by escala_id)
			";
				//echo $sqlc;

			}
			else{
				/*
				 $sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				 where CONCAT(Escala.id,'{$this->data['Escala']['ano']}{$this->data['Escala']['mes']}') not in (select CONCAT(escala_id,mes) from escalasmonths group by escala_id)
				 ";
				 */
				$sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				where Escala.ano={$this->data['Escala']['ano']} and Escala.mes={$this->data['Escala']['mes']} and CONCAT(Escala.ano, Escala.mes) not in (select mes from escalasmonths group by escala_id)
			";
				//echo $sqlc;
				$insere = 1;
				//$sqlc = "select Escalasmonth.id from escalasmonths Escalasmonth INNER JOIN escalas Escala on (Escalasmonth.escala_id=Escala.id) INNER JOIN setors Setor on (Setor.id=Escala.setor_id and  Setor.id in ({$u[0][0]['setores']})) where  Escalasmonth.mes=".$this->data['Escala']['ano'].$this->data['Escala']['mes'];
			}
			$idescalasmonth = $this->Escala->query($sqlc);
			$conta = count($idescalasmonth);

			$compara = $u[0]['Usuario']['privilegio_id'];

			if(($compara==1)||($compara==4)||($compara==5)||($compara==6)){
					
				if (($conta>0)&&($insere)){
					foreach($idescalasmonth as $id){
						$sql = "select Escala.nm_escalante, Escala.nm_comandante, Escala.nm_chefe_orgao FROM escalas Escala WHERE Escala.id='{$id['Escala']['id']}' \n	";
						$dadosEscala = $this->Escala->query($sql);

						$escalante = $dadosEscala[0]['Escala']['nm_escalante'];
						$chefe = $dadosEscala[0]['Escala']['nm_chefe_orgao'];
						$comandante = $dadosEscala[0]['Escala']['nm_comandante'];

						$sql = "select Militar.id, Militar.dt_ultima_promocao, Posto.antiguidade, MilitarsEscala.id, MilitarsEscala.legenda_prevista, MilitarsEscala.legenda_cumprida ,MilitarsEscala.prevista, MilitarsEscala.cumprida, Militar.indicativo FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
						INNER JOIN militars_escalas as MilitarsEscala on (MilitarsEscala.escala_id='{$id['Escala']['id']}' and MilitarsEscala.militar_id=Militar.id) order by Posto.antiguidade desc,
						Militar.dt_ultima_promocao asc	";

						$antiguidade = $this->Escala->query($sql);

						$max = count($antiguidade);
						if(!($this->data['Escala']['mes']=='TODOS')){
							/*
							 $em['Escalasmonth']['escala_id'] = $id['Escala']['id'];
							 $em['Escalasmonth']['mes'] = $this->data['Escala']['ano'].$this->data['Escala']['mes'];
							 $em['Escalasmonth']['efetivo_total'] = $max;
							 $em['Escalasmonth']['nm_escalante'] = $escalante;
							 $em['Escalasmonth']['nm_chefe_orgao'] = $chefe;
							 $em['Escalasmonth']['nm_comandante'] = $comandante;

							 $this->Escala->Escalasmonth->save($em);
							 $ide = $this->Escala->Escalasmonth->id;
							 	
							 */
							$compara = $u[0]['Usuario']['privilegio_id'];
							$sqlc = 'insert ignore into escalasmonths (id, escala_id, mes, efetivo_total, nm_escalantep, nm_chefe_orgaop, nm_comandantep, nm_escalantec, nm_chefe_orgaoc, nm_comandantec) values(uuid(), "'.$id['Escala']['id'].'",'.$this->data['Escala']['ano'].$this->data['Escala']['mes'].','.$max.', \''.$escalante.'\',\''.$chefe.'\',\''.$comandante.'\', \''.$escalante.'\',\''.$chefe.'\',\''.$comandante.'\')';
							//echo $sqlc;
							$idescalasmonth = $this->Escala->query($sqlc);

							$sqlc = 'select * from escalasmonths where escala_id="'.$id['Escala']['id'].'"  and mes='.$this->data['Escala']['ano'].$this->data['Escala']['mes'].'';
							$ide = $this->Escala->query($sqlc);

							$sqlc = 'insert ignore into versoescalas (id, escalasmonth_id) values (uuid(), "'.$ide[0]['escalasmonths']['id'].'")';
							//echo $sqlc;
							$this->Escala->query($sqlc);
						}

					}
				}

			}
		}

		$this->layout = 'admin';
		if(empty($this->data['Escala']['ano'])){
			$this->data['Escala']['ano'] = date('Y');
		}


		if($this->data['Escala']['mes']=='TODOS'){
			$sql = "
			select Escala.id,Escala.efetivo_total, Cidade.nome, Escala.setor_id, Unidade.sigla_unidade, Setor.sigla_setor, Escala.nm_escalante, Escala.nm_chefe_orgao, SUBSTRING(EscalasMonth.mes,5,2) as mes, SUBSTRING(EscalasMonth.mes,1,4) as ano,  EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, EscalasMonth.destrava_prevista, EscalasMonth.destrava_cumprida, EscalasMonth.id FROM escalas as Escala
			INNER JOIN escalasmonths as EscalasMonth on ( Escala.id = EscalasMonth.escala_id and Escala.ano={$this->data['Escala']['ano']}  )
			INNER JOIN setors as Setor ON (Escala.setor_id = Setor.id and Setor.id in ({$u[0][0]['setores']}) )
			LEFT JOIN unidades as Unidade ON ( Setor.unidade_id = Unidade.id )
			LEFT JOIN cidades as Cidade on (Cidade.id=Unidade.cidade_id)
			order by  Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, ano, mes asc
		 ";
		}else{
			$sql = "
			select Escala.id,Escala.efetivo_total, Cidade.nome, Escala.setor_id, Unidade.sigla_unidade, Setor.sigla_setor, Escala.nm_escalante, Escala.nm_chefe_orgao, SUBSTRING(EscalasMonth.mes,5,2) as mes, SUBSTRING(EscalasMonth.mes,1,4) as ano, EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, EscalasMonth.destrava_prevista, EscalasMonth.destrava_cumprida, EscalasMonth.id FROM escalas as Escala
			INNER JOIN escalasmonths as EscalasMonth on ( Escala.id = EscalasMonth.escala_id and EscalasMonth.mes={$this->data['Escala']['ano']}{$this->data['Escala']['mes']} )
			INNER JOIN setors as Setor ON (Escala.setor_id = Setor.id and Setor.id in ({$u[0][0]['setores']}) )
			LEFT JOIN unidades as Unidade ON ( Setor.unidade_id = Unidade.id )
			LEFT JOIN cidades as Cidade on (Cidade.id=Unidade.cidade_id)
			order by  Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, ano, mes asc
		 ";

		}
		$escalas = $this->Escala->query($sql);
			
		/*
		 $sql = "select Setor.id, concat(Cidade.nome,'-',Unidade.sigla_unidade,'-',Setor.sigla_setor) setor  FROM setors as Setor INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 left JOIN cidade as Cidade on (Unidade.cidade_id=Cidade.id) where  Setor.id in ({$u[0][0]['setores']}) order by Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor ASC";

		 $setor = $this->Escala->query($sql);

		 foreach($setor as $set){
			$vetor[]=$set['Setor']['id'];
			$vetor2[]=$set[0]['setor'];
			}
			$setors = array_combine($vetor,$vetor2);
			*/


		$mes = array('01'=>'JAN','02'=>'FEV','03'=>'MAR','04'=>'ABR','05'=>'MAI','06'=>'JUN','07'=>'JUL','08'=>'AGO','09'=>'SET','10'=>'OUT','11'=>'NOV','12'=>'DEZ','TODOS'=>'TODOS');



		//	$this->set('escalas', $this->paginate());

		$this->set(compact('escalas','mes'));


		/*
		 if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Escala.', true));
			$this->redirect(array('action'=>'add'));
			}
			*/

		//$this->set('escala', $this->Escala->read(null, $id));


	}


	function view($mes = null,$ano = null) {
		//$id=57;
	   
        
		$u=$this->Session->read('Usuario');
                
		$insere = 0;
		if(empty($this->data['Escala']['ano'])){
			$this->data['Escala']['ano'] = date('Y');
			$this->data['Escala']['mes'] = date('m');
		}
		if(!empty($mes)&&!empty($ano)){
			$this->data['Escala']['ano'] = $ano;
			$this->data['Escala']['mes'] = $mes;
		}

		$compara = $u[0]['Usuario']['privilegio_id'];

		if(!empty($this->data)){
			if($this->data['Escala']['mes']=='TODOS'){
				/*
				 $sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				 where CONCAT(Escala.id,'{$this->data['Escala']['ano']}') not in (select CONCAT(escala_id,SUBSTRING(mes,1,4)) from escalasmonths group by escala_id)
				 ";
				 */

				if(($compara==1)||($compara==4)){
					$sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id )
				where Escala.ativa>0 AND Escala.ano={$this->data['Escala']['ano']} and Escala.ano not in (select SUBSTRING(mes,1,4) from escalasmonths group by escala_id)";
				}else{
					$sqlc = "select Escala.id from escalas Escala
				INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				where Escala.ativa>0 AND Escala.ano={$this->data['Escala']['ano']} and Escala.ano not in (select SUBSTRING(mes,1,4) from escalasmonths group by escala_id)";
				}

				//echo $sqlc;

			}else{
				/*
				 $sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				 where CONCAT(Escala.id,'{$this->data['Escala']['ano']}{$this->data['Escala']['mes']}') not in (select CONCAT(escala_id,mes) from escalasmonths group by escala_id)
				 ";
				 */
				if(($compara==1)||($compara==4)){
					$sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id) where Escala.ano={$this->data['Escala']['ano']} and Escala.mes={$this->data['Escala']['mes']} and Escala.ativa>0 and Escala.id not in (select escala_id from escalasmonths)	 group by Escala.id	";
				}else{
					$sqlc = "select Escala.id from escalas Escala INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']})) where Escala.ano={$this->data['Escala']['ano']} and Escala.mes={$this->data['Escala']['mes']} and Escala.ativa>0 and Escala.id not in (select escala_id from escalasmonths)	 group by Escala.id	";
				}

				//				where Escala.ativa>0 AND Escala.ano={$this->data['Escala']['ano']} and Escala.mes={$this->data['Escala']['mes']} and CONCAT(Escala.ano, Escala.mes) not in (select mes from escalasmonths group by escala_id)
				//echo $sqlc.'<br>';
				$insere = 1;
				//$sqlc = "select Escalasmonth.id from escalasmonths Escalasmonth INNER JOIN escalas Escala on (Escalasmonth.escala_id=Escala.id) INNER JOIN setors Setor on (Setor.id=Escala.setor_id and  Setor.id in ({$u[0][0]['setores']})) where  Escalasmonth.mes=".$this->data['Escala']['ano'].$this->data['Escala']['mes'];
			}
                        
			$idescalasmonth = $this->Escala->query($sqlc);
                        //echo $sqlc;
                        //print_r($idescalasmonth);
			$conta = count($idescalasmonth);

			if(($compara==1)||($compara==4)||($compara==5)||($compara==6)){
					
				if (($conta>0)&&($insere)){
					foreach($idescalasmonth as $id){
						$sql = "select Escala.nm_escalante, Escala.nm_comandante, Escala.nm_chefe_orgao FROM escalas Escala WHERE Escala.id='{$id['Escala']['id']}' \n	";
						$dadosEscala = $this->Escala->query($sql);

						$escalante = $dadosEscala[0]['Escala']['nm_escalante'];
						$chefe = $dadosEscala[0]['Escala']['nm_chefe_orgao'];
						$comandante = $dadosEscala[0]['Escala']['nm_comandante'];

						$sql = "select Militar.id, Militar.dt_ultima_promocao, Posto.antiguidade, MilitarsEscala.id, MilitarsEscala.legenda_prevista, MilitarsEscala.legenda_cumprida ,MilitarsEscala.prevista, MilitarsEscala.cumprida, Militar.indicativo FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)	INNER JOIN militars_escalas as MilitarsEscala on (MilitarsEscala.escala_id='{$id['Escala']['id']}' and MilitarsEscala.militar_id=Militar.id) order by Posto.antiguidade desc,	Militar.dt_ultima_promocao asc	";
                                                

						$antiguidade = $this->Escala->query($sql);

						$max = count($antiguidade);
						if(!($this->data['Escala']['mes']=='TODOS')){
							$compara = $u[0]['Usuario']['privilegio_id'];
							$sqlc = 'insert ignore into escalasmonths (id, escala_id, mes, efetivo_total, nm_escalantep, nm_chefe_orgaop, nm_comandantep, nm_escalantec, nm_chefe_orgaoc, nm_comandantec) values(uuid(), "'.$id['Escala']['id'].'",'.$this->data['Escala']['ano'].$this->data['Escala']['mes'].','.$max.', "'.$escalante.'","'.$chefe.'","'.$comandante.'", "'.$escalante.'","'.$chefe.'","'.$comandante.'")';
							//echo $sqlc;
							$idescalasmonth = $this->Escala->query($sqlc);

							$sqlc = 'select * from escalasmonths where escala_id="'.$id['Escala']['id'].'"  and mes='.$this->data['Escala']['ano'].$this->data['Escala']['mes'].'';
							$ide = $this->Escala->query($sqlc);

							$sqlc = 'insert ignore into versoescalas (id, escalasmonth_id) values (uuid(), "'.$ide[0]['escalasmonths']['id'].'")';
							//echo $sqlc;
							$this->Escala->query($sqlc);
						}

					}
				}

			}
		}

		$this->layout = 'admin';
		if(empty($this->data['Escala']['ano'])){
			$this->data['Escala']['ano'] = date('Y');
		}


		if($this->data['Escala']['mes']=='TODOS'){
				
			if(($compara==1)){
				$sql = "
			select Escala.tipo,Escala.id,Escala.efetivo_total, Cidade.nome, Escala.setor_id, Unidade.sigla_unidade, Setor.sigla_setor, Escala.nm_escalante, Escala.nm_chefe_orgao, SUBSTRING(EscalasMonth.mes,5,2) as mes, SUBSTRING(EscalasMonth.mes,1,4) as ano,  EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_comandantep, EscalasMonth.ok_comandantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, EscalasMonth.destrava_prevista, EscalasMonth.destrava_cumprida, EscalasMonth.id, EscalasMonth.ok_chefeorgaop, EscalasMonth.ok_chefeorgaoc FROM escalas as Escala
			INNER JOIN escalasmonths as EscalasMonth on (Escala.ativa>0 AND  Escala.id = EscalasMonth.escala_id and Escala.ano={$this->data['Escala']['ano']}  )
			INNER JOIN setors as Setor ON (Escala.setor_id = Setor.id )
			LEFT JOIN unidades as Unidade ON ( Setor.unidade_id = Unidade.id )
			LEFT JOIN cidades as Cidade on (Cidade.id=Unidade.cidade_id)
			order by  Escala.tipo, Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, ano, mes asc
			 ";
			}else{
				$sql = "
			select Escala.tipo,Escala.id,Escala.efetivo_total, Cidade.nome, Escala.setor_id, Unidade.sigla_unidade, Setor.sigla_setor, Escala.nm_escalante, Escala.nm_chefe_orgao, SUBSTRING(EscalasMonth.mes,5,2) as mes, SUBSTRING(EscalasMonth.mes,1,4) as ano,  EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_comandantep, EscalasMonth.ok_comandantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, EscalasMonth.destrava_prevista, EscalasMonth.destrava_cumprida, EscalasMonth.id, EscalasMonth.ok_chefeorgaop, EscalasMonth.ok_chefeorgaoc FROM escalas as Escala
			INNER JOIN escalasmonths as EscalasMonth on (Escala.ativa>0 AND  Escala.id = EscalasMonth.escala_id and Escala.ano={$this->data['Escala']['ano']}  )
			INNER JOIN setors as Setor ON (Escala.setor_id = Setor.id and Setor.id in ({$u[0][0]['setores']}) )
			LEFT JOIN unidades as Unidade ON ( Setor.unidade_id = Unidade.id )
			LEFT JOIN cidades as Cidade on (Cidade.id=Unidade.cidade_id)
			order by  Escala.tipo, Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, ano, mes asc
			 ";
			}
				
		}else{
			if(($compara==1)){
				$sql = "
			select Escala.tipo,Escala.id,Escala.efetivo_total, Cidade.nome, Escala.setor_id, Unidade.sigla_unidade, Setor.sigla_setor, Escala.nm_escalante, Escala.nm_chefe_orgao, SUBSTRING(EscalasMonth.mes,5,2) as mes, SUBSTRING(EscalasMonth.mes,1,4) as ano, EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_comandantep, EscalasMonth.ok_comandantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, EscalasMonth.destrava_prevista, EscalasMonth.destrava_cumprida, EscalasMonth.id, EscalasMonth.ok_chefeorgaop, EscalasMonth.ok_chefeorgaoc FROM escalas as Escala
			INNER JOIN escalasmonths as EscalasMonth on (Escala.ativa>0 AND  Escala.id = EscalasMonth.escala_id and EscalasMonth.mes={$this->data['Escala']['ano']}{$this->data['Escala']['mes']} )
			INNER JOIN setors as Setor ON (Escala.setor_id = Setor.id  )
			LEFT JOIN unidades as Unidade ON ( Setor.unidade_id = Unidade.id )
			LEFT JOIN cidades as Cidade on (Cidade.id=Unidade.cidade_id)
			order by  Escala.tipo, Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, ano, mes asc
		 	";
			}else{
				$sql = "
			select Escala.tipo,Escala.id,Escala.efetivo_total, Cidade.nome, Escala.setor_id, Unidade.sigla_unidade, Setor.sigla_setor, Escala.nm_escalante, Escala.nm_chefe_orgao, SUBSTRING(EscalasMonth.mes,5,2) as mes, SUBSTRING(EscalasMonth.mes,1,4) as ano, EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_comandantep, EscalasMonth.ok_comandantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, EscalasMonth.destrava_prevista, EscalasMonth.destrava_cumprida, EscalasMonth.id, EscalasMonth.ok_chefeorgaop, EscalasMonth.ok_chefeorgaoc FROM escalas as Escala
			INNER JOIN escalasmonths as EscalasMonth on (Escala.ativa>0 AND  Escala.id = EscalasMonth.escala_id and EscalasMonth.mes={$this->data['Escala']['ano']}{$this->data['Escala']['mes']} )
			INNER JOIN setors as Setor ON (Escala.setor_id = Setor.id and Setor.id in ({$u[0][0]['setores']}) )
			LEFT JOIN unidades as Unidade ON ( Setor.unidade_id = Unidade.id )
			LEFT JOIN cidades as Cidade on (Cidade.id=Unidade.cidade_id)
			order by  Escala.tipo, Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, ano, mes asc
		 	";
			}

		}
		//echo $sql.'<br>';
                
		$escalas = $this->Escala->query($sql);
			
		/*
		 $sql = "select Setor.id, concat(Cidade.nome,'-',Unidade.sigla_unidade,'-',Setor.sigla_setor) setor  FROM setors as Setor INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 left JOIN cidade as Cidade on (Unidade.cidade_id=Cidade.id) where  Setor.id in ({$u[0][0]['setores']}) order by Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor ASC";

		 $setor = $this->Escala->query($sql);

		 foreach($setor as $set){
			$vetor[]=$set['Setor']['id'];
			$vetor2[]=$set[0]['setor'];
			}
			$setors = array_combine($vetor,$vetor2);
			*/


		$mes = array('01'=>'JAN','02'=>'FEV','03'=>'MAR','04'=>'ABR','05'=>'MAI','06'=>'JUN','07'=>'JUL','08'=>'AGO','09'=>'SET','10'=>'OUT','11'=>'NOV','12'=>'DEZ','TODOS'=>'TODOS');



		//	$this->set('escalas', $this->paginate());

		$this->set(compact('escalas','mes'));


		/*
		 if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Escala.', true));
			$this->redirect(array('action'=>'add'));
			}
			*/

		//$this->set('escala', $this->Escala->read(null, $id));
	}


	function assinar($idescalasmonth = null, $idmilitar = null, $chefeouescalante = null, $hora_instrucao = null, $selprev = null, $acao = null, $obs = null, $dia, $mes, $ano, $mesescala=null, $anoescala=null) {
		$mensagem = '';
		$conflitos = '';
		$ok = 0;
		$destrava = '';
		if(($acao=='cmte')||($acao=='imp')){
			$this->layout = 'admin';
			//echo '<pre>'.print_r($this->data).'</pre>';
			if($selprev=='p'){

				//foreach($this->data['Escalasmonth']['ok_comandantep'] as $id){
				foreach($this->data['Escalasmonth']['ok_chefeorgaop'] as $id){
                                        unset($v);
					$v['Escalasmonth']['id'] = $id;
					$v['Escalasmonth']['ok_chefeorgaop'] = $idmilitar;
					$v['Escalasmonth']['ok_comandantep'] = $idmilitar;
					$v['Escalasmonth']['destrava_prevista'] = '';
                                        
                                        $dadosescala = $this->Escala->Escalasmonth->findById($id);
                                        if(empty($dadosescala['Escalasmonth']['ok_escalantep'])){
                                            $v['Escalasmonth']['ok_escalantep'] = $idmilitar;
                                        }
                                        if(empty($dadosescala['Escalasmonth']['ok_chefep'])){
                                            $v['Escalasmonth']['ok_chefep'] = $idmilitar;
                                        }
                                        
                                        
					if($this->Escala->Escalasmonth->save($v)){
						$completa = '';
						$auxilio = '';
						$tamanho = strlen($v['Escalasmonth']['id']);
						if($tamanho<6){
							$diferenca = 6-$tamanho;
							for($i=0;$i<$diferenca;$i++){
								$completa .= '0';
							}
						}
						$auxilio = $completa.$v['Escalasmonth']['id'];

						$absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
						$absoluto = str_replace('controllers','',$absoluto);
						if(strlen($mes)<2){
							$mes = '0'.$mes;
						}
						$absolutoC = $absoluto.'webroot/pdf/'.$anoescala.$mesescala.$auxilio.$selprev.'.pdf';
//                                                echo $absolutoC;
                                                chmod($absolutoC, "u+rwx,go+rwx");
						$resultado=unlink($absolutoC);
						if(file_exists($absolutoC)){
							$resultado=unlink($absolutoC);
						}

					}

				}
			}else{

				//foreach($this->data['Escalasmonth']['ok_comandantec'] as $id){
				foreach($this->data['Escalasmonth']['ok_chefeorgaoc'] as $id){
                                        unset($v);
					$v['Escalasmonth']['id'] = $id;
					$v['Escalasmonth']['ok_chefeorgaoc'] = $idmilitar;
					$v['Escalasmonth']['ok_comandantec'] = $idmilitar;
					$v['Escalasmonth']['destrava_prevista'] = '';
                                        
                                        $dadosescala = $this->Escala->Escalasmonth->findById($id);
                                        if(empty($dadosescala['Escalasmonth']['ok_escalantec'])){
                                            $v['Escalasmonth']['ok_escalantec'] = $idmilitar;
                                        }
                                        if(empty($dadosescala['Escalasmonth']['ok_chefec'])){
                                            $v['Escalasmonth']['ok_chefec'] = $idmilitar;
                                        }
                                        
                                        
                                        
					if($this->Escala->Escalasmonth->save($v)){
						//echo 'ok<br>';
						$completa = '';
						$auxilio = '';
						$tamanho = strlen($v['Escalasmonth']['id']);
						if($tamanho<6){
							$diferenca = 6-$tamanho;
							for($i=0;$i<$diferenca;$i++){
								$completa .= '0';
							}
						}
						$auxilio = $completa.$v['Escalasmonth']['id'];

						$absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
						$absoluto = str_replace('controllers','',$absoluto);
						if(strlen($mes)<2){
							$mes = '0'.$mes;
						}
						$absolutoC = $absoluto.'webroot/pdf/'.$anoescala.$mesescala.$auxilio.$selprev.'.pdf';
                                                chmod($absolutoC, "u+rwx,go+rwx");
                                                //echo $absolutoC;
						$resultado=unlink($absolutoC);
						if(file_exists($absolutoC)){
                                                        chmod($absolutoC, "u+rwx,go+rwx");
							$resultado=unlink($absolutoC);
						}
					}
						
				}

			}
			$this->redirect(array('action'=>'view'));

		}
		/*
		 if($acao=='imp'){
			$this->layout = 'admin';
			//echo '<pre>'.print_r($this->data).'</pre>';
			if($selprev=='p'){
			foreach($this->data['Escalasmonth']['ok_chefeorgaop'] as $id){
			$v['Escalasmonth']['id'] = $id;
			$v['Escalasmonth']['ok_chefeorgaop'] = $idmilitar;
			if($this->Escala->Escalasmonth->save($v)){
			//echo 'ok<br>';
			}

			}
			}else{

			foreach($this->data['Escalasmonth']['ok_chefeorgaoc'] as $id){
			$v['Escalasmonth']['id'] = $id;
			$v['Escalasmonth']['ok_chefeorgaoc'] = $idmilitar;
			if($this->Escala->Escalasmonth->save($v)){
			//echo 'ok<br>';
			}

			}

			}
			$this->redirect(array('action'=>'view'));

			}
			*/
		if($acao=='desfazer'){
			$sqlc1 = 'update cumprimentoescalas set cumprido=previsto where escalasmonth_id="'.$idescalasmonth.'"';
			$this->Escala->query($sqlc1);
			$sqlc1 = 'update versoescalas set item5="", item6="", naoconformidades="" where escalasmonth_id="'.$idescalasmonth.'"';
			$this->Escala->query($sqlc1);
			$ok = 10;
		}

        //-----------------------------------------------------------
        if ($acao == 'assinar') {
            $valida = 0;
            if ($selprev == 'p') {
                $campo = 'previsto';
                if ($chefeouescalante == 'chefe') {
                    $destrava = ' ,destrava_prevista=null ';
                    $valida = ' and previsto is not null ';
                }
            } else {
                $campo = 'cumprido';
                if ($chefeouescalante == 'chefe') {
                    $destrava = ' ,destrava_cumprida=null ';
                    $valida = ' and cumprido is not null';
                }
            }
            $sql = "select * from cumprimentoescalas
			inner join turnos on (turnos.id=cumprimentoescalas.id_turno)  
			where escalasmonth_id='$idescalasmonth' group by id_turno	";
            $resultadoTurno = $this->Escala->query($sql);

            foreach ($resultadoTurno as $vturno) {
                $vetorTurno[$vturno['turnos']['id']]['rotulo'] = $vturno['turnos']['rotulo'];
                $vetorTurno[$vturno['turnos']['id']]['menor'] = 100000000;
                $vetorTurno[$vturno['turnos']['id']]['maior'] = 0;
                $vetorTurno[$vturno['turnos']['id']]['dia'][] = 0;
            }

            $dadosescala = $this->Escala->Escalasmonth->findById($idescalasmonth);
            $mes = substr($dadosescala['Escalasmonth']['mes'], -2);
            $ano = substr($dadosescala['Escalasmonth']['mes'], 0, 4);
            $escala_id = $dadosescala['Escalasmonth']['escala_id'];
            $sql = "select * from cumprimentoescalas Cumprimentoescala where escalasmonth_id='$idescalasmonth' order by Cumprimentoescala.dia	";
            $cumprimentoEscalas = $this->Escala->query($sql);
            $ok = 1;

            foreach ($cumprimentoEscalas as $cumprimento) {
                $dia = $cumprimento['Cumprimentoescala']['dia'];
                if ($selprev == 'p') {
                    $militar = $cumprimento['Cumprimentoescala']['previsto'];
                    $legenda = $cumprimento['Cumprimentoescala']['legenda_previsto'];
                } else {
                    $militar = $cumprimento['Cumprimentoescala']['cumprido'];
                    $legenda = $cumprimento['Cumprimentoescala']['legenda_cumprido'];
                }
                $datacompara = $ano . '-' . $mes . '-' . $dia;
                if (!empty($militar)) {
                    $vetorTurno[$cumprimento['Cumprimentoescala']['id_turno']]['dia'][$cumprimento['Cumprimentoescala']['dia']] += 1;
                }
                $sql = "select * from afastamentos Afastamento where militar_id='$militar'  and ( dt_inicio<='$datacompara'  and dt_termino>='$datacompara') and ( escala_id='$escala_id' or escala_id='0' )";
                $afastamentos = $this->Escala->query($sql);
                if (count($afastamentos) > 0) {
                    foreach ($afastamentos as $afastado) {
                        $conflitos .= 'Legenda:' . $legenda . ' para o dia:' . $dia . ' afastado por:' . $afastado['Afastamento']['motivo'] . ' Período:' . $afastado['Afastamento']['dt_inicio'] . '/' . $afastado['Afastamento']['dt_termino'] . "\n";
                    }
                }
            }

            if (strlen($conflitos) > 0) {
                $ok = 0;
            }
            foreach ($vetorTurno as $chave => $valor) {
                foreach ($valor['dia'] as $dia => $qtd) {
                    if ($dia > 0) {
                        if ($qtd > $valor['maior']) {
                            $vetorTurno[$chave]['maior'] = $qtd;
                            $valor['maior'] = $qtd;
                        }
                        if ($qtd < $valor['menor']) {
                            $vetorTurno[$chave]['menor'] = $qtd;
                            $valor['menor'] = $qtd;
                        }
                    }
                }
            }
            $resposta = 'Declaro&nbsp;estar&nbsp;ciente&nbsp;das&nbsp;informações&nbsp;abaixo&nbsp;quanto&nbsp;a&nbsp;alocação&nbsp;de&nbsp;pessoal&nbsp;nos&nbsp;turnos:<br>';
            foreach ($vetorTurno as $chave => $valor) {
                $resposta .= '<b>' . $vetorTurno[$chave]['rotulo'] . '</b> =>&nbsp;Maior:<b>' . $vetorTurno[$chave]['maior'] . '</b>&nbsp;Menor:<b>' . $vetorTurno[$chave]['menor'] . '</b><br>';
            }
            if ($ok == 1) {
                $sqlc1 = 'update escalasmonths set ok_' . $chefeouescalante . $selprev . '="' . $idmilitar . $destrava . '" where id="' . $idescalasmonth . '"';
                if ($chefeouescalante == 'chefe') {
                    $valor = $this->Escala->Escalasmonth->findById($idescalasmonth);
                    if (empty($valor['Escalasmonth']['ok_escalante' . $selprev])) {
                        $sqlc1 = 'update escalasmonths set ok_' . $chefeouescalante . $selprev . '="' . $idmilitar . '", ok_escalante' . $selprev . '="' . $idmilitar.'"'. $destrava . ' where id="' . $idescalasmonth . '"';
                    }else{
                        $sqlc1 = 'update escalasmonths set ok_' . $chefeouescalante . $selprev . '="' . $idmilitar . '" ' . $destrava . ' where id="' . $idescalasmonth . '"';
                        
                    }
                }
//echo $sqlc1;
                $this->Escala->query($sqlc1);
            }
        }
        
        //-----------------------------------------------------------
        if($acao=='limpar'){
			if($chefeouescalante=='escalante'){
				$sqlc1 = 'update escalasmonths set ok_escalante'.$selprev.'=null  where id="'.$idescalasmonth.'"';
			}else{
				$sqlc1 = 'update escalasmonths set ok_chefe'.$selprev.'=null, ok_escalante'.$selprev.'=null, ok_chefeorgao'.$selprev.'=null  where id="'.$idescalasmonth.'"';
			}
			$this->Escala->query($sqlc1);

			$completa = '';
			$auxilio = '';
			$tamanho = strlen($idescalasmonth);
			if($tamanho<6){
				$diferenca = 6-$tamanho;
				for($i=0;$i<$diferenca;$i++){
					$completa .= '0';
				}
			}
			$auxilio = $completa.$idescalasmonth;

			$absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
			$absoluto = str_replace('controllers','',$absoluto);
			if(strlen($mes)<2){
				$mes = '0'.$mes;
			}
			$absolutoC = $absoluto.'webroot/pdf/'.$anoescala.$mesescala.$auxilio.$selprev.'.pdf';
                        chmod($absolutoC, "u+rwx,go+rwx");
                        
			$resultado=unlink($absolutoC);
			if(file_exists($absolutoC)){
                                chmod($absolutoC, "u+rwx,go+rwx");
				$resultado=unlink($absolutoC);
			}

			$ok = 1;
		}

		if($acao=='instrucao'){
			$sqlc1 = 'update escalasmonths set hora_instrucao='.$hora_instrucao.', obs_hora_instrucao="'.stripslashes($obs).'"  where id="'.$idescalasmonth.'"';
			$mensagem = 'Motivo Informado:'.stripslashes($obs);

			$this->Escala->query($sqlc1);
			$ok = 1;
		}
		if($acao=='desbloquear'){
			$valorData = $ano.'-'.$mes.'-'.$dia.' 23:59:00 ';
			if($selprev=='p'){
				$destrava = ' destrava_prevista="'.$valorData.'", ok_chefeorgaop=null, ok_comandantep=null, ok_escalantep=null, ok_chefep=null ';
			}else{
				$destrava = ' destrava_cumprida="'.$valorData.'", ok_chefeorgaoc=null, ok_comandantec=null, ok_escalantec=null, ok_chefec=null ';
			}
			$sqlc1 = 'update escalasmonths set  '.$destrava.' where id="'.$idescalasmonth.'"';

			//echo $sqlc1;
				
			$this->Escala->query($sqlc1);
			$ok = 1;
			$mensagem = 'Escala desbloqueada !';

			$completa = '';
			$auxilio = '';
			$tamanho = strlen($idescalasmonth);
			if($tamanho<6){
				$diferenca = 6-$tamanho;
				for($i=0;$i<$diferenca;$i++){
					$completa .= '0';
				}
			}
			$auxilio = $completa.$idescalasmonth;

			$absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
			$absoluto = str_replace('controllers','',$absoluto);
			if(strlen($mes)<2){
				$mes = '0'.$mes;
			}
			$absolutoC = $absoluto.'webroot/pdf/'.$anoescala.$mesescala.$auxilio.$selprev.'.pdf';
                        chmod($absolutoC, "u+rwx,go+rwx");
                        
			$resultado=unlink($absolutoC);
			if(file_exists($absolutoC)){
                                chmod($absolutoC, "u+rwx,go+rwx");
				$resultado=unlink($absolutoC);
			}
				//echo $absolutoC.'<br>';exit();
				
		}

		if($acao=='mudarcmt'){
			if($selprev=='p'){
				$sql = "update escalasmonths set nm_comandantep='$obs', nm_comandantec='$obs' where id='$idescalasmonth' ";
			}else{
				$sql = "update escalasmonths set nm_comandantec='$obs' where id='$idescalasmonth' ";
			}
			$this->Escala->query($sql);
			$ok = 1;
			$mensagem = 'Pressione F5 para atualizar a exibição !';
		}

		if($acao=='mudarescalante'){
			if($selprev=='p'){
				$sql = "update escalasmonths set nm_escalantep='$obs', nm_escalantec='$obs' where id='$idescalasmonth' ";
			}else{
				$sql = "update escalasmonths set nm_escalantec='$obs' where id='$idescalasmonth' ";
			}

			$this->Escala->query($sql);
			$ok = 1;
			$mensagem = 'Pressione F5 para atualizar a exibição !';
		}

		if($acao=='mudarchefe'){
			if($selprev=='p'){
				$nm_chefe_orgao='nm_chefe_orgaop';
				$sql = "update escalasmonths set nm_chefe_orgaop='$obs', nm_chefe_orgaoc='$obs' where id='$idescalasmonth' ";
			}else{
				$sql = "update escalasmonths set nm_chefe_orgaoc='$obs' where id='$idescalasmonth' ";
			}

			$this->Escala->query($sql);
			$ok = 1;
			$mensagem = 'Pressione F5 para atualizar a exibição !';
		}


		header('Content-type: application/x-json');

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "conflitos":"'.urlencode($conflitos).'", "turnos":"'.urlencode($resposta).'" }';

		exit();


	}

	function verso($id = null, $dtm = null, $dta = null, $selprev = null, $opcao = null) {
		$escala = $this->Escala->findById($id);
		if($dtm<10){
			$dtm = '0'.$dtm;
		}

		//$dados = addslashes($dados);
		$sqlc = 'select * from escalasmonths where escala_id="'.$id.'"  and mes='.$dta.$dtm.'';
		$ide = $this->Escala->query($sqlc);
		$idescalasmonth = $ide[0]['escalasmonths']['id'];

		$dado1 = addslashes($this->data['Verso']['obs']);
		$dado2 = addslashes($this->data['Verso']['alteracoes']);
		$dado3 = addslashes($this->data['Verso']['obscmt']);
		$dado3 = addslashes($this->data['Verso']['obscmt']);

		$dado4 = addslashes($this->data['Verso']['adjunto']);
		$dado5 = addslashes($this->data['Verso']['adjunto_obs']);
		$dado6 = addslashes($this->data['Verso']['naoconformidades']);

		if($selprev=='p'){

			$v1 = "item1";
			$v2 = "item2";
			$v3 = "item3";

		}else{

			$v1 = "item4";
			$v2 = "item5";
			$v3 = "item6";


		}

		if($opcao!='verso'){
			$sqlc1 = 'update versoescalas set '.$v1.'="'.$dado1.'", '.$v2.'="'.$dado2.'", '.$v3.'="'.$dado3.'", adjunto="'.$dado4.'", adjunto_obs="'.$dado5.'", naoconformidades="'.$dado6.'" where escalasmonth_id="'.$idescalasmonth.'"';
			$this->Escala->query($sqlc1);
		}

		$sqlc2 = 'select * from versoescalas  where escalasmonth_id="'.$idescalasmonth.'"';
		$retorno = $this->Escala->query($sqlc2);

		//$this->layout = 'popup';
		//$this->set(compact('dtm','dta','selprev','id'));
		header('Content-type: application/x-json');

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"1", "mensagem":"" }';

		exit();


	}


	function escala($id = null, $dtm = null, $dta = null, $selprev = null, $diaInicial=null, $diaFinal=null) {

		$this->layout = 'popup';
		$this->data['Escala']['diaInicial']=$diaInicial;
		$this->data['Escala']['diaFinal']=$diaFinal;

		//$id=57;
		//	echo "id=$id, mes=$dtm, ano=$dta, selprev=$selprev<br>";
		$efetivo = "select count(*) todos from militars_escalas where escala_id='$id' ";
		$efetivototal = $this->Escala->query($efetivo);
		$todosMilitares = $efetivototal[0][0]['todos'];
		$registraEfetivo = "update escalas set efetivo_total={$todosMilitares} where id='{$id}' ";
		$this->Escala->query($registraEfetivo);
		$registraEfetivo = "update escalasmonths set efetivo_total={$todosMilitares} where escala_id='{$id}' ";
		$this->Escala->query($registraEfetivo);

		if(empty($this->data['Escala']['prevista'])){
			if(empty($selprev)){
				$this->data['Escala']['prevista'] = 'p';
				$selprev = 'p';
			}else{
				$this->data['Escala']['prevista'] = $selprev;
			}
		}

		$escala = $this->Escala->findById($id);
                
                //print_r($escala);
		$seid = $escala['Escala']['setor_id'];
		$tipo = $escala['Escala']['tipo'];

		$sql = "select Militar.id, Militar.dt_ultima_promocao, Posto.antiguidade, MilitarsEscala.id, MilitarsEscala.legenda_prevista, MilitarsEscala.legenda_cumprida, MilitarsEscala.prevista, MilitarsEscala.cumprida, Militar.indicativo FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		INNER JOIN militars_escalas as MilitarsEscala on (MilitarsEscala.escala_id='{$id}' and MilitarsEscala.militar_id=Militar.id)
		order by Posto.antiguidade desc,
		Militar.dt_ultima_promocao asc	";



		$antiguidade = $this->Escala->query($sql);
		//print_r($antiguidade);
			
		$max = count($antiguidade);
		//$condEscala = array('Escala.id'=>$id);


		// Gera escala automaticamente, pelo fato de não existirem dados

		//$sqlc = 'select Escalasmonth.id from escalasmonths Escalasmonth where Escalasmonth.escala_id='.$id.' and Escalasmonth.mes='.$dta.$dtm;

		$sqlc = 'select Escalasmonth.id, Escalasmonth.mes from escalasmonths Escalasmonth where Escalasmonth.escala_id="'.$id.'" ';
		$idescalasmonth = $this->Escala->query($sqlc);
		$id_escalas_month = $idescalasmonth[0]['Escalasmonth']['id'];
		$escalasmonthmes = $idescalasmonth[0]['Escalasmonth']['mes'];
		$escalasmonth = $id_escalas_month;


                $sql = "select * from turnos Turno where escala_id='{$id}' order by Turno.id asc ";
                $turnos = $this->Escala->query($sql);
                //print_r($turnos);

                foreach ($turnos as $turno){
                    $sql = 'select Cumprimentoescala.id, Cumprimentoescala.escalasmonth_id, Cumprimentoescala.id_turno, Cumprimentoescala.dia, Cumprimentoescala.previsto, Cumprimentoescala.cumprido from cumprimentoescalas Cumprimentoescala,turnos Turno where Cumprimentoescala.escalasmonth_id="'.$id_escalas_month.'" and Turno.id=Cumprimentoescala.id_turno and Turno.id="'.$turno['Turno']['id'].'" order by Cumprimentoescala.dia,Cumprimentoescala.id, Turno.id asc';
                    //echo $sql;
                    $preenchido = $this->Escala->query($sql);
                    $verifica = count($preenchido);
                    if(($verifica<=0)){
                            $vetor = 0;
                            $dtIni = "$dta/$dtm/1";

                            $qtd_dias = date('t',strtotime($dtIni));
                            for ($d=1;$d<=$qtd_dias;$d++){
                                            $qtd_militares = $turno['Turno']['qtd'];
                                            for($c=1;$c<=$qtd_militares;$c++){
                                                    $dados['escalas_turno_id'] = $turno['Turno']['id'];
                                                    $sql = "insert into cumprimentoescalas (id, escalasmonth_id, id_turno,  dia, previsto, cumprido, afastamentos) values(uuid(),'{$id_escalas_month}', '{$dados['escalas_turno_id']}',{$d},null,null,'')";
                                                    $this->Escala->query($sql);
                                                }
                                        }
                                }

                    }

		//	if($selprev=='p'){

		$sql_escalantep = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' ',Militar.nm_completo) as nome  FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		LEFT JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		INNER JOIN  escalasmonths as EscalasMonth on (EscalasMonth.mes={$dta}{$dtm} and EscalasMonth.escala_id='{$id}' and EscalasMonth.ok_escalantep=Militar.id)
		 ";
		$escalante_prevista = $this->Escala->query($sql_escalantep);
		$escalanteprevista= $escalante_prevista[0][0]['nome'];

		$sql_escalantec = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' ',Militar.nm_completo) as nome  FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		LEFT JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		INNER JOIN  escalasmonths as EscalasMonth on (EscalasMonth.mes={$dta}{$dtm} and EscalasMonth.escala_id='{$id}' and EscalasMonth.ok_escalantec=Militar.id)
		 ";
		$escalante_cumprida = $this->Escala->query($sql_escalantec);
		$escalantecumprida= $escalante_cumprida[0][0]['nome'];

		$sql_chefep = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' ',Militar.nm_completo) as nome  FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		LEFT JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		INNER JOIN  escalasmonths as EscalasMonth on (EscalasMonth.mes={$dta}{$dtm} and EscalasMonth.escala_id='{$id}' and EscalasMonth.ok_chefep=Militar.id)
		 ";
		$chefe_prevista = $this->Escala->query($sql_chefep);
		$chefeprevista= $chefe_prevista[0][0]['nome'];

		$sql_chefec = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' ',Militar.nm_completo) as nome  FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		LEFT JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		INNER JOIN  escalasmonths as EscalasMonth on (EscalasMonth.mes={$dta}{$dtm} and EscalasMonth.escala_id='{$id}' and EscalasMonth.ok_chefec=Militar.id)
		 ";
		$chefe_cumprida = $this->Escala->query($sql_chefec);
		$chefecumprida= $chefe_cumprida[0][0]['nome'];
		//-------------LIMITAÇÃO DE DIAS ------------------------------------------------
		if((empty($this->data['Escala']['diaInicial'])||$this->data['Escala']['diaInicial']<=0)){
			$this->data['Escala']['diaInicial'] = -1;
			$this->data['Escala']['diaFinal'] = 0;
			/*
			 $diaInicial=1;
			 $dtIni = "$dta/$dtm/1";
			 if((empty($diaFinal)||$diaFinal<=0)){
				$diaFinal = date('t',$dtIni);
				}
				*/
		}
		//		$diaInicial = 2;
		//		$diaFinal = 8;

		for($c=$this->data['Escala']['diaInicial'];$c<=$this->data['Escala']['diaFinal'];$c++){
			$complemento.=','.$c;
		}
		$somentediaInicial = ' where CumprimentoEscala.dia in (0'.$diaInicial.$complemento.') ';
		//-------------LIMITAÇÃO DE DIAS ------------------------------------------------

		$sql = "
		select CumprimentoEscala.legenda_previsto, CumprimentoEscala.legenda_cumprido, CumprimentoEscala.id, CumprimentoEscala.previsto, CumprimentoEscala.cumprido, EscalasMonth.efetivo_total, EscalasMonth.media_hora_prevista,  EscalasMonth.media_hora, EscalasMonth.mes,EscalasMonth.hora_instrucao, CumprimentoEscala.dia, GROUP_CONCAT(DISTINCT CumprimentoEscala.afastamentos SEPARATOR ' ') as obs,  EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, Turno.id
		FROM cumprimentoescalas CumprimentoEscala
		INNER JOIN escalasmonths as EscalasMonth on ( CumprimentoEscala.escalasmonth_id = EscalasMonth.id and EscalasMonth.mes={$dta}{$dtm} )
		INNER JOIN escalas as Escala ON (Escala.id = '{$id}' and EscalasMonth.escala_id = Escala.id  )
		INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id )
		$somentediaInicial
		group by CumprimentoEscala.id, CumprimentoEscala.dia
		order by CumprimentoEscala.dia, CumprimentoEscala.id, Turno.id  asc
					 ";
		//		echo $sql;
		/*
		}else{
		$sql = "
		select CumprimentoEscala.legenda_previsto, CumprimentoEscala.legenda_cumprido,CumprimentoEscala.id, CumprimentoEscala.cumprido, EscalasMonth.efetivo_total, EscalasMonth.media_hora, EscalasMonth.mes,EscalasMonth.hora_instrucao, CumprimentoEscala.dia, GROUP_CONCAT(DISTINCT CumprimentoEscala.afastamentos SEPARATOR ' ') as obs,  EscalasMonth.ok_escalantep, EscalasMonth.ok_chefep,EscalasMonth.ok_escalantec, EscalasMonth.ok_chefec, Escala.dt_limite_cumprida, Escala.dt_limite_previsao FROM cumprimentoescalas CumprimentoEscala
		INNER JOIN escalasmonths as EscalasMonth on ( CumprimentoEscala.escalasmonth_id = EscalasMonth.id and EscalasMonth.mes={$dta}{$dtm} )
		INNER JOIN escalas as Escala ON (Escala.id = {$id} and EscalasMonth.escala_id = Escala.id  )
		INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id )
		group by CumprimentoEscala.id, CumprimentoEscala.dia
		order by CumprimentoEscala.dia, CumprimentoEscala.id  asc
		";

		}
		*/
		$preenche = $this->Escala->query($sql);

		/*
		 echo '<pre>';
		 print_r($preenche);
		 echo '</pre>';
		 */
		//echo $sql;

		if($selprev=='p'){
			$sql1 = "select concat( Militar.nm_guerra,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome, concat( Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nomecompleto, Militar.indicativo, MilitarsEscala.legenda_prevista as codigo, MilitarsEscala.id, Militar.id
			FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.escala_id='$id' and MilitarsEscala.prevista=1)
			order by  length(MilitarsEscala.legenda_prevista),MilitarsEscala.legenda_prevista asc";
		}else{
			$sql1 = "select concat( Militar.nm_guerra,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome, concat( Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nomecompleto, Militar.indicativo, MilitarsEscala.legenda_cumprida as codigo, MilitarsEscala.id, Militar.id
			FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.escala_id='$id' and MilitarsEscala.cumprida=1 )
			order by  length(MilitarsEscala.legenda_cumprida),MilitarsEscala.legenda_cumprida asc";

		}
		//echo $sql1."<br>";
		$legendas = $this->Escala->query($sql1);

		if($tipo=='RISAER'){
			foreach($legendas as $quadrinho){
				$quadrinhos[$quadrinho['Militar']['id']]=$this->externoquadrinho($quadrinho['Militar']['id'], $seid, $escalasmonthmes);
			}
		}

		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.qtd, Turno.rotulo from turnos as Turno
		where Turno.escala_id = '{$id}' order by Turno.id asc";
		$turnos = $this->Escala->query($sql);

		$sql = "select Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
		INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.id='{$id}')";
		$unidade = $this->Escala->query($sql);

		$sql = "select * from versoescalas Versoescala where escalasmonth_id='$id_escalas_month'";

		$verso = $this->Escala->query($sql);

		$sql1 = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ',Militar.nm_completo) as nome  FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		where Posto.antiguidade>=119 and Posto.antiguidade<=122  and Militar.ativa>0
		order by  Posto.antiguidade asc, Militar.nm_completo asc";


		//		INNER JOIN militars_escalas MilitarsEscala ON (MilitarsEscala.militar_id=Militar.id and MilitarsEscala.escala_id=$id)

		$chefes = $this->Escala->query($sql1);

		//echo $sql1;

		$cont = 0;
			
		foreach ($chefes as $chf){
			$adjunto[$cont] = iconv('UTF-8','UTF-8',$chf[0]['nome']);
			$cont++;
		}


		$sql2 = "select concat(Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)  INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)   order by Militar.nm_completo asc";
		//WHERE Posto.antiguidade<126

		$chefesID = $this->Escala->query($sql2);

		$cont = 0;


		foreach ($chefesID as $chf){
			$chefeID[$cont] = iconv('UTF-8','UTF-8',$chf[0]['nome']);
			$cont++;
		}


		if($selprev=='p'){
			$campo = 'previsto';
		}else{
			$campo = 'cumprido';
		}

		$dtIni = "$dta-$dtm-1";
		$dtFim = "$dta-$dtm-".date('t',strtotime($dtIni));
		//			INNER JOIN militars as Militar ON (Militar.id in (select distinct(militar_id) from militars_escalas where escala_id={$seid}) and Militar.id=Afastamento.militar_id and prevista=1)

		if($selprev=='p'){
			$sqlafastamento = "select concat( Militar.nm_guerra,' ', Posto.sigla_posto,' ',Especialidade.nm_especialidade) as nome, Militar.indicativo,  Militar.id, Afastamento.obs, Afastamento.dt_inicio, Afastamento.dt_termino, Afastamento.motivo from afastamentos Afastamento
			INNER JOIN militars as Militar ON (Militar.id in (select distinct(militar_id) from militars_escalas where escala_id='{$id}') and Militar.id=Afastamento.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')
		";
			//			INNER JOIN militars as Militar ON (Militar.id in (select distinct(militar_id) from militars_escalas where escala_id={$id}) and Militar.id=Afastamento.militar_id and cumprida=1)
		}else{
			$sqlafastamento = "select concat( Militar.nm_guerra,' ', Posto.sigla_posto,' ',Especialidade.nm_especialidade) as nome, Militar.indicativo,  Militar.id, Afastamento.obs, Afastamento.dt_inicio, Afastamento.dt_termino, Afastamento.motivo from afastamentos Afastamento
			INNER JOIN militars as Militar ON (Militar.id in (select distinct(militar_id) from militars_escalas where escala_id='{$id}') and Militar.id=Afastamento.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$seid}')
		";

		}

		//where ((YEAR(Afastamento.dt_inicio)={$dta} and MONTH(Afastamento.dt_inicio)={$dtm}) or (YEAR(Afastamento.dt_termino)={$dta} and MONTH(Afastamento.dt_termino)={$dtm}) ) and (escala_id=0 or escala_id={$id})
		//echo $sqlafastamento;

		$afastamento = $this->Escala->query($sqlafastamento);
		/*

		$sqlafastamento = "select concat( Militar.nm_guerra,' - ', Posto.sigla_posto,' ',Especialidade.nm_especialidade) as nome, Militar.indicativo,  Militar.id, Afastamento.obs, Afastamento.dt_inicio, Afastamento.dt_termino, Afastamento.motivo from afastamentos Afastamento
		INNER JOIN militars as Militar ON (Militar.id in (select distinct($campo) from cumprimentoescalas where escalasmonth_id={$escalasmonth}) and Militar.id=Afastamento.militar_id  and ((YEAR(Afastamento.dt_inicio)={$dta} and MONTH(Afastamento.dt_inicio)={$dtm}) or (YEAR(Afastamento.dt_termino)={$dta} and MONTH(Afastamento.dt_termino)={$dtm}) and Afastamento.motivo not like '%EXPEDIENTE%'))
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		";

		$afastamento = $this->Escala->query($sqlafastamento);
		*/

		//$escalasmonths = $this->Escala->query($sql);


		//print_r($legendas);
		//exit(1);
		$this->set(compact('quadrinhos','escala', 'antiguidade', 'preenche', 'turnos','legendas','dtm','dta','selprev','unidade', 'verso','escalasmonth', 'adjunto','chefeID','afastamento','chefeprevista','chefecumprida','escalanteprevista','escalantecumprida'));
		/*
		 if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Escala.', true));
			$this->redirect(array('action'=>'add'));
			}
			*/
		//$this->set('escala', $this->Escala->read(null, $id));
	}

	function add($id = null, $ordena = null) {
		$u=$this->Session->read('Usuario');
                

		$mes = array('1'=>'JAN','2'=>'FEV','3'=>'MAR','4'=>'ABR','5'=>'MAI','6'=>'JUN','7'=>'JUL','8'=>'AGO','9'=>'SET','10'=>'OUT','11'=>'NOV','12'=>'DEZ');
                if($ordena=='limpalegendas'){
                    unset($ordena);
                    if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
                    $removelengendas = "delete from militars_escalas where escala_id='$id';";
                    $this->Escala->query($removelengendas);
                    }
                    
                }

                if (empty($ordena)){
                    $classifica = ' order by length(MilitarsEscala.legenda_prevista) asc, MilitarsEscala.legenda_prevista asc';
                }else{
                    $classifica = ' order by nome asc ';
                }


		if (!empty($id)){
			$sql01 = "select * from turnos as Turno where escala_id='".$id."' order by Turno.id asc";
			$sql02 = "select concat(Militar.nm_completo,' ', Posto.sigla_posto) as nome, MilitarsEscala.id, Militar.id, MilitarsEscala.legenda_prevista, MilitarsEscala.ignoraafastamento, MilitarsEscala.legenda_cumprida, MilitarsEscala.prevista,MilitarsEscala.cumprida  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and MilitarsEscala.escala_id='$id')
			$classifica ";
                        
                        //echo $sql01.'<br>'.$sql02;

			$turnos = $this->Escala->query($sql01);
			$milescalas = $this->Escala->query($sql02);
		}else{
			$turnos=null;
			$milescalas=null;
		}

		if(!empty($id)){
			$mesEscala = $this->Escala->findById($id);
			$temID = $id;
			$this->set(compact('temID'));
		}
		
		
                //print_r($turnos);
                
		$this->Escala->unbindModel(array('hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Afastamento','Atividade','Exame','Habilitacao')));
		$this->Escala->recursive = 0;
		//print_r($mesEscala);
		if(empty($this->data['Escala']['mes'])){
			if(!empty($mesEscala)){
				$this->data['Escala']['mes'] = $mesEscala['Escala']['mes'];
				$this->data['Escala']['ano'] = $mesEscala['Escala']['ano'];

			}else{
				$this->data['Escala']['mes'] = date('n');
				$this->data['Escala']['ano'] = date('Y');
			}
		}


		$sql1 = "
select  concat( Militar.nm_completo,' ',Posto.sigla_posto,' ',Quadro.sigla_quadro,' ', Especialidade.nm_especialidade) as nome, Militar.id 
FROM militars as Militar 
INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) 
LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id) 
LEFT JOIN usuarios Usuario on (Usuario.militar_id=Militar.id) 
INNER JOIN privilegios Privilegio on (Privilegio.id=Usuario.privilegio_id) 
where  Privilegio.id=6 order by Militar.nm_completo asc";
//echo $sql1;
		//		$sql1 = "select concat( Militar.nm_completo,' - ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome, Militar.id  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) order by  Militar.nm_completo asc";
		//WHERE Posto.antiguidade<=122
		$chefes = $this->Escala->query($sql1);

		$cont = 0;
			
		foreach ($chefes as $chf){
			$chefe[$cont] = iconv('UTF-8','UTF-8',$chf[0]['nome']);
			$cont++;
		}


		//$sql2 = "select concat(Militar.nm_completo,' - ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome, Militar.id  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)  INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) order by Militar.nm_completo asc";

		$sql2 = "
select  concat( Militar.nm_completo,' ',Posto.sigla_posto,' ',Quadro.sigla_quadro,' ', Especialidade.nm_especialidade) as nome, Militar.id 
FROM militars as Militar 
INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) 
LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id) 
LEFT JOIN usuarios Usuario on (Usuario.militar_id=Militar.id) 
INNER JOIN privilegios Privilegio on (Privilegio.id=Usuario.privilegio_id) 
where  Privilegio.id=5 order by Militar.nm_completo asc";
		//WHERE Posto.antiguidade<126


		$chefesID = $this->Escala->query($sql2);

		//print_r($chefesID);

		foreach($chefesID as $montachefes){
			$assinantes[$montachefes['Militar']['id']] = $montachefes[0]['nome'];
		}

		//asort($assinantes);

		$this->set('assinantes',$assinantes);



		$cont = 0;


		foreach ($chefesID as $chf){
			$chefeID[$cont] = iconv('UTF-8','UTF-8',$chf[0]['nome']);
			$cont++;
		}


		$militaresid = '';

		if($u[0]['Privilegio']['acesso']==0){
			$sql = "select Setor.id, concat(Unidade.sigla_unidade,'-',Setor.sigla_setor) setor  FROM setors as Setor INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id) order by Unidade.sigla_unidade, Setor.sigla_setor ASC";
		}else{
			$sql = "select Setor.id, concat(Unidade.sigla_unidade,'-',Setor.sigla_setor) setor  FROM setors as Setor INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id) order by Unidade.sigla_unidade, Setor.sigla_setor ASC";
		}

//		echo $sql;
		$setors = $this->Escala->query($sql);

		$militars = $this->Escala->Militar->find('list');
		$postos = $this->Escala->Militar->Posto->find('list');

		//print_r($postos);


		$raiz = $this->webroot;

	
			
		if (!empty($this->data['Escala']['setor_id'])) {
			//echo '<br>DEPOIS -> ESCALA(SETOR_ID)';

			$this->Escala->recursive = 0;
			if(empty($this->data['Escala']['id'])){$this->Escala->create();}
				
				
			// Inserir no log
			//----------------------------------------------------------------
			/*
			 if(($this->data['Escala']['id'])>0){
			 $ip = $_SERVER['REMOTE_ADDR'];
			 $u = $this->Session->read('Usuario');
			 $usuario = $u[0][0]['nome'];

			 $consultaescala = 'select * from escalas Escala
			 inner join turnos Turno on (Turno.escala_id='.$this->data['Escala']['id'].' )
			 inner join setors Setor on (Setor.id=Escala.setor_id)
			 inner join militars_escalas MilitarsEscala on (MilitarsEscala.escala_id='.$this->data['Escala']['id'].' )
			 where Escala.id='.$this->data['Escala']['id'].'
			 ';
			 //echo $consultaescala;
			 //
			 $resultsetor=$this->Escala->query($consultaescala);
			 //print_r($resultsetor);
			 $rsetor=$resultsetor[0]['Setor']['sigla_setor'];
			 $mudanca = '<u><b>Antes:</b></u>'.print_r($resultsetor,true)."\n\r<u><b>Depois</u></b>:".print_r($this->data['Escala'],true);
			 $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação na Escala '.$rsetor.'",now(),"ESCALA", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
			 //		echo $monitora;
			 //		exit();
			 $this->Escala->query($monitora);
			 }
			 */
			//------------------------------------------------------------------------------------------------------------

				
			if ($this->Escala->save($this->data)) {
	
				$contaTurnos = $this->data['Escala']['contaTurnos'];
				//$conta--;
				$idEscalaGravada=$this->Escala->id;
				$escala = $this->Escala->read(null, $idEscalaGravada);
					
				$participaChefeC = 'select * from escalasmonths where (ok_comandantec is null or ok_comandantec=0)  and escala_id="'.$escala['Escala']['id'].'" ';
				$participaChefeC_Resultado = $this->Escala->query($participaChefeC);
				if(!empty($participaChefeC_Resultado)){
					foreach($participaChefeC_Resultado as $r){
						$this->Escala->query('update escalasmonths set nm_chefe_orgaoc="'.$escala['Escala']['nm_chefe_orgao'].'", nm_comandantec="'.$escala['Escala']['nm_comandante'].'"  where  escala_id="'.$escala['Escala']['id'].'"');
					}
				}
				$participaChefeP = 'select * from escalasmonths where (ok_comandantep is null or ok_comandantep=0)  and escala_id="'.$escala['Escala']['id'].'" ';
				$participaChefeP_Resultado = $this->Escala->query($participaChefeP);
				if(!empty($participaChefeP_Resultado)){
					foreach($participaChefeP_Resultado as $r){
						$this->Escala->query('update escalasmonths set nm_chefe_orgaop="'.$escala['Escala']['nm_chefe_orgao'].'", nm_comandantep="'.$escala['Escala']['nm_comandante'].'"  where  escala_id="'.$escala['Escala']['id'].'"');
					}
				}
				$participaEscalanteC = 'select * from escalasmonths where (ok_comandantec is null or ok_comandantec=0)  and escala_id="'.$escala['Escala']['id'].'" ';
				$participaEscalanteC_Resultado = $this->Escala->query($participaEscalanteC);
				if(!empty($participaEscalanteC_Resultado)){
					foreach($participaEscalanteC_Resultado as $r){
						$this->Escala->query('update escalasmonths set nm_escalantec="'.$escala['Escala']['nm_escalante'].'", nm_comandantec="'.$escala['Escala']['nm_comandante'].'"  where  escala_id="'.$escala['Escala']['id'].'"');
					}
				}
				$participaEscalanteP = 'select * from escalasmonths where (ok_comandantep is null or ok_comandantep=0)  and escala_id="'.$escala['Escala']['id'].'" ';
				$participaEscalanteP_Resultado = $this->Escala->query($participaEscalanteP);
				if(!empty($participaEscalanteP_Resultado)){
					foreach($participaEscalanteP_Resultado as $r){
						$this->Escala->query('update escalasmonths set nm_escalantep="'.$escala['Escala']['nm_escalante'].'", nm_comandantep="'.$escala['Escala']['nm_comandante'].'"  where  escala_id="'.$escala['Escala']['id'].'"');
					}
				}
					
				for ($x=0;$x<$contaTurnos;$x++){
					if(empty($this->data['Escala']['turno_id'][$x])){
						$sql = 'insert into turnos (id, escala_id, hora_inicio, hora_termino, qtd, dt_escala, rotulo) values (uuid(),"'.$escala['Escala']['id'].'","'.$this->data['Escala']['turno_inicio'][$x].'","'.$this->data['Escala']['turno_termino'][$x].'",'.$this->data['Escala']['turno_qtd'][$x].',"'.date('Y-m-d h:i:s').'","'.$this->data['Escala']['turno_rotulo'][$x].'")  ';
						//echo $sql."<br>";
					}else{
						$verifica = "select * from turnos Turno where id='".$this->data['Escala']['turno_id'][$x]."'";
						$turnos = $this->Escala->query($verifica);
						if($turnos[0]['Turno']['qtd']!=$this->data['Escala']['turno_qtd'][$x]){
							$apagar = "delete escalasmonths, cumprimentoescalas from escalasmonths, cumprimentoescalas where escalasmonths.escala_id='".$this->Escala->id."' and escalasmonths.id=cumprimentoescalas.escalasmonth_id";
							$apaga = $this->Escala->query($apagar);
						}
						$sql = 'update turnos set hora_inicio="'.$this->data['Escala']['turno_inicio'][$x].'", hora_termino="'.$this->data['Escala']['turno_termino'][$x].'", qtd='.$this->data['Escala']['turno_qtd'][$x].', rotulo="'.$this->data['Escala']['turno_rotulo'][$x].'" where id="'.$this->data['Escala']['turno_id'][$x].'" ';

					}
					//echo $sql.'<br>';
					$this->Escala->query($sql);
				}


				$contaMilescala = $this->data['Escala']['contaMilitares'];
				//$conta--;
				for ($x=0;$x<$contaMilescala;$x++){
					if(empty($this->data['Escala']['militarsescala_id'][$x])){
						$sql = 'insert ignore into militars_escalas (id, escala_id, militar_id, legenda_prevista, legenda_cumprida, prevista, cumprida, ignoraafastamento) values (uuid(),"'.$escala['Escala']['id'].'","'.$this->data['Escala']['militares_id'][$x].'","'.$this->data['Escala']['legendasp'][$x].'","'.$this->data['Escala']['legendasc'][$x].'",'.$this->data['Escala']['legendap'][$x].','.$this->data['Escala']['legendac'][$x].',"'.$this->data['Escala']['ignoraafastamento'][$x].'") ';
					}else{
						$sql = 'update militars_escalas set escala_id="'.$escala['Escala']['id'].'", militar_id="'.$this->data['Escala']['militares_id'][$x].'", legenda_prevista="'.$this->data['Escala']['legendasp'][$x].'", legenda_cumprida="'.$this->data['Escala']['legendasc'][$x].'", prevista='.$this->data['Escala']['legendap'][$x].', cumprida='.$this->data['Escala']['legendac'][$x].', ignoraafastamento="'.$this->data['Escala']['ignoraafastamento'][$x].'" where id="'.$this->data['Escala']['militarsescala_id'][$x].'"';
					}
					//						echo $sql;
					//echo $sql;
					//exit();
					$this->Escala->query($sql);
				}
				//echo $sql.'<br>';


				$this->Session->setFlash(__('Os dados da Escala foram gravados.', true));
				//exit();

				//$this->set('escalas', $this->paginate());
				//$this->set(compact('militars', 'setors', 'chefe','chefeID','raiz','escalas'));
				//$this->render('add');
			} else {
				$this->Session->setFlash(__('Os dados de Escala não foram gravados. Por favor, tente novamente.', true));
				$this->redirect(array('action'=>'add'));
			}
		}
		if (empty($this->data['Escala']['setor_id'])&&(!empty($id))) {
			$this->Escala->recursive = 0;
			$data = $this->Escala->read(null, $id);

			$this->set(compact('data'));
			//$this->render('add');
		}
		//$this->data = null;

		if($u[0]['Privilegio']['acesso']==0){
			$sql = "select Escala.id, Escala.ativa, Escala.setor_id, Escala.nm_escalante, Escala.nm_comandante, Escala.nm_chefe_orgao, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, Escala.ano, Escala.mes, Escala.supervisor_geral, Escala.supervisor_regional,
		 Setor.sigla_setor, Setor.id, Unidade.sigla_unidade, Unidade.id, Cidade.nome, Cidade.id  FROM escalas as Escala INNER JOIN setors as Setor ON(Escala.setor_id = Setor.id) INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 left JOIN cidades as Cidade on (Unidade.cidade_id=Cidade.id) where  Escala.mes={$this->data['Escala']['mes']} AND Escala.ano={$this->data['Escala']['ano']}  order by Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor asc";
		}else{
			$sql = "select Escala.id, Escala.ativa, Escala.setor_id, Escala.nm_escalante, Escala.nm_comandante, Escala.nm_chefe_orgao, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, Escala.ano, Escala.mes, Escala.supervisor_geral, Escala.supervisor_regional,
		 Setor.sigla_setor, Setor.id, Unidade.sigla_unidade, Unidade.id, Cidade.nome, Cidade.id  FROM escalas as Escala INNER JOIN setors as Setor ON(Escala.setor_id = Setor.id) INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 left JOIN cidades as Cidade on (Unidade.cidade_id=Cidade.id) where  Escala.mes={$this->data['Escala']['mes']} AND Escala.ano={$this->data['Escala']['ano']} AND Setor.id in ({$u[0][0]['setores']}) order by Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor asc";
		}
		$escalas = $this->Escala->query($sql);

			
		$this->set(compact('escalas','postos','mes','militars', 'setors', 'chefe','chefeID','raiz','escalas','militaresid','turnos','milescalas', 'supervisor', 'id'));
		$this->render('add');

	}

	//}
	/*
	function edit($id = null) {
	if (!$id && empty($this->data)) {
	$this->Session->setFlash(__('Escala Inválida!', true));
	$this->redirect(array('action'=>'index'));
	}
	if (!empty($this->data)) {
	if ($this->Escala->save($this->data)) {
	$this->Session->setFlash(__('Os dados de Escala foram gravados.', true));
	$this->redirect(array('action'=>'index'));
	} else {
	$this->Session->setFlash(__('Os dados de Escala não foram gravados. Por favor, tente novamente.', true));
	}
	}
	if (empty($this->data)) {
	$this->data = $this->Escala->read(null, $id);
	}
	$militars = $this->Escala->Militar->find('list');
	$setors = $this->Escala->Setor->find('list');
	$this->set(compact('militars','setors'));
	}
	*/

	function delete($id = null) {
	   
        if ((!$id)&&(empty($this->data['Escala']['ids']))) {
            $this->Session->setFlash(__('ID inválido para Escala', true));
          //  $this->Session->setFlash(__(print_r($this->data,true), true));
        //  $this->redirect(array('action'=>'add'));
        }
        if ((!$id)&&(!empty($this->data['Escala']['ids']))) {
        //  $this->redirect(array('action'=>'add'));
             $mensagem = 'Escalas excluídas:<br><ul>';
            foreach($this->data['Escala']['ids'] as $deleteid){
                 $ip = $_SERVER['REMOTE_ADDR'];
                 $u = $this->Session->read('Usuario');
                 $usuario = $u[0][0]['nome'];
                 $consultaescala = 'select Setor.sigla_setor, Escala.mes, Escala.ano
                  from escalas Escala
                  inner join setors Setor on (Setor.id=Escala.setor_id and Escala.id="'.$deleteid.'" ) ';
                 $resultsetor=$this->Escala->MilitarsEscala->query($consultaescala);
                 $mudanca = 'Excluída a Escala->'.$resultsetor[0]['Setor']['sigla_setor'].' -> '.$resultsetor[0]['Escala']['mes'].'/'.$resultsetor[0]['Escala']['ano'].' no dia:'.date('d-m-Y h:i');
                 $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Excluir militars_escalas",now(),"ESCALAS", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
                 $this->Escala->query($monitora);
                 if ($this->Escala->delete($deleteid)) {
                     $mensagem .= '<li>Escala->'.$resultsetor[0]['Setor']['sigla_setor'].' -> '.$resultsetor[0]['Escala']['mes'].'/'.$resultsetor[0]['Escala']['ano'].'</li><br>';
                 }
                 
                        
            }
            $mensagem .= '</ul>';
        }
		
        header('Content-type: application/x-json');
        echo '{ "ok":"1", "mensagem":"'.$mensagem.'"}';
        exit();
        
         
		/*
		 }
		 */
		//$this->redirect(array('action'=>'add'));
	}

	function relatorioPdf($dtm , $dta , $selprev , $escalante , $chefe, $tipoescala)
	{
		//$this->layout = 'pdf'; //this will use the pdf.thtml layout
		$this->layout = 'pdf'; //this will use the pdf.thtml layout
		if($selprev=='PREVISTA'){
			$okescalante = 'ok_escalantep';
			$okchefe = 'ok_chefep';
			$campochefe = 'ok_chefep';
			$campoescalante = 'ok_escalantep';
		}else{
			$okescalante = 'ok_escalantec';
			$okchefe = 'ok_chefec';
			$campochefe = 'ok_chefec';
			$campoescalante = 'ok_escalantec';
		}
		$this->Escala->recursive = 2;
		if($escalante=='NAO'){
			$condescalante = $okescalante.' is null ';
		}else{
			$condescalante = $okescalante.' is not null ';
		}

		if($chefe=='NAO'){
			$condchefe = $okchefe.' is null ';
		}else{
			$condchefe = $okchefe.' is not null ';
		}

		if($selprev=='PREVISTA'){
			$condicao = $condescalante.' and '.$condchefe.' ';
		}else{
			$condicao = $condescalante.' and '.$condchefe.' ';
		}

		$condicao .= ' and Escala.tipo="'.$tipoescala.'" ';
			
		if(($escalante=='TODOS')||($chefe=='TODOS')){
			$condicao = ' 1=1'.' and Escala.tipo="'.$tipoescala.'" ';
		}


		$mes = $dta.$dtm;
		/*
		 echo "Escalasmonth.mes={$dta}{$dtm}  and {$condicao} ";

		 $escalas = $this->Escala->Escalasmonth->find('all', array(
		 'conditions' => "Escalasmonth.mes={$dta}{$dtm}  and {$condicao} ",
		 'fields' => '',
		 'recursive'=>1
		 ));



		 $escalas = $this->Escala->find('all', array(
		 'link' => array('Setor' => array('Unidade' => 'Estado')),
		 'conditions' => '',
		 'fields' => '',
		 'recursive'=>0    				));

		 */

		if($selprev=='PREVISTA'){
			$nm_escalante = 'nm_escalantep';
			$nm_chefe_orgao = 'nm_chefe_orgaop';
			$nm_comandante = 'nm_comandantep';
		}else{
			$nm_escalante = 'nm_escalantec';
			$nm_chefe_orgao = 'nm_chefe_orgaoc';
			$nm_comandante = 'nm_comandantec';
		}

		$sql = "select Escala.id, Escala.setor_id, Escalasmonth.$nm_escalante nm_escalante, Escalasmonth.$nm_comandante nm_comandante, Escalasmonth.$nm_chefe_orgao nm_chefe_orgao, Escala.dt_limite_cumprida, Escala.dt_limite_previsao, Escalasmonth.{$campoescalante} as escalante,  Escalasmonth.{$campochefe} as chefe,
		Setor.sigla_setor, Setor.id, Unidade.sigla_unidade, Unidade.id, Cidade.nome, Cidade.id  FROM escalas as Escala INNER JOIN setors as Setor ON(Escala.setor_id = Setor.id) INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		left JOIN cidades as Cidade on (Unidade.cidade_id=Cidade.id)
		INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.escala_id=Escala.id and Escalasmonth.mes={$dta}{$dtm}  and {$condicao})
		where Escala.ativa=1 order by Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor asc";

		$escalas = $this->Escala->query($sql);

		//,	'order'=>'Cidade.nome,Unidade.sigla_unidade,Setor.sigla_setor'


		$this->set(compact('escalas','mes','selprev'));

		$this->render();
	}

	function edit($id = null, $status = null) {
		$mensagem="";
		$ok='0';
		$escala['Escala']['ativa'] = $status;
		$escala['Escala']['id'] = $id;

		if ($this->Escala->save($escala)) {
			$ok='1';
		}
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();

	}
	function indexExcel($ano = null, $mes=null)
	{

		$this->layout = 'openoffice' ;
		$titulo = 'Relação de Escalas';
		$nome = 'lista_escalas';
		$this->Escala->recursive = null;

		$sql = "select Escala.ano, Escala.mes,Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, Escala.nm_escalante, Escala.nm_chefe_orgao, Escala.nm_comandante,   Escala.dt_limite_previsao, Escala.dt_limite_cumprida FROM escalas as Escala INNER JOIN setors as Setor ON(Escala.setor_id = Setor.id) INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 left JOIN cidades as Cidade on (Unidade.cidade_id=Cidade.id)
		 where Escala.ano=$ano and Escala.mes=$mes 
		 order by Escala.ano, Escala.mes,Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor asc";
		$alicerce = $this->Escala->query($sql);
		$conta=0;
		foreach($alicerce as $base){
			$dados[$conta]['ANO']=$base['Escala']['ano'];
			$dados[$conta]['MES']=$base['Escala']['mes'];
			$dados[$conta]['Cidade']=$base['Cidade']['nome'];
			$dados[$conta]['UNIDADE']=$base['Unidade']['sigla_unidade'];
			$dados[$conta]['SETOR']=$base['Setor']['sigla_setor'];
			$dados[$conta]['ESCALANTE']=$base['Escala']['nm_escalante'];
			$dados[$conta]['CHEFE']=$base['Escala']['nm_chefe_orgao'];
			$dados[$conta]['COMANDANTE']=$base['Escala']['nm_comandante'];
			$dados[$conta]['DT_PREVISTA']=$base['Escala']['dt_limite_previsao'];
			$dados[$conta]['CUMPRIDA']=$base['Escala']['dt_limite_cumprida'];
			$conta++;
		}
		//echo $sql;


		$campos = array("ANO","MES","Cidade","UNIDADE","SETOR","ESCALANTE","CHEFE","COMANDANTE","DT_PREVISTA","DT CUMPRIDA");


		$this->set(compact('dados','nome','titulo','campos'));


		$this->render();
	}
	function externoposto($setorid = null,$posto = null) {
		$u=$this->Session->read('Usuario');
                
		//print_r($u);

		$this->layout = 'ajax';
		//$setorid= ' and Militar.setor_id='.$setorid;
		$setorid = '';

		if(!empty($posto)){
			if($posto=='GRADUADOS'){
				$antiguidade = ' and Posto.antiguidade>111 ';
			}
			if($posto=='OFICIAIS'){
				$antiguidade = ' and Posto.antiguidade<=111 ';
				$setorid = '';
			}
			$sql1 = "select concat(Militar.nm_completo,' ',Militar.nm_guerra,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome, Militar.id  FROM militars as Militar
		 INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id $antiguidade)		
		 LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)  
		 INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		 where Militar.ativa>0 $setorid order by Militar.nm_completo asc";

				
			//echo $sql1;
				
			$consulta = $this->Escala->query($sql1);

			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['Militar']['id']]=$dados[0]['nome'];
			}

			if(!empty($lista)) {
				foreach($lista as $k => $v) {
					echo "<option value='$k'>$v</option>";
				}
			}

		}


		exit();
	}
        
     
	function externocsv($id = null,$sigpes=null)
	{

		$this->layout = '';
		$this->set('dataToExport', $this->Escala->Escalasmonth->findById($id));

		$titulo = 'Relação de Escalas';
		$nome = 'lista_escalas';

		$escalasmonth_id=$id;

		$escalasmonths = $this->Escala->Escalasmonth->findById($escalasmonth_id);
		$escala_id = $escalasmonths['Escalasmonth']['escala_id'];

		$escala = $this->Escala->findById($escala_id);
		$mes = $escala['Escala']['mes'];
		if($mes<10){$mes = '0'.$mes;}
		$ano = $escala['Escala']['ano'];
		$setor_id = $escala['Escala']['setor_id'];

		$dtIni = "$ano/$mes/1";
		$qtd_dias = date('t',strtotime($dtIni));

		$constante = 0;
		$turnos = $this->Escala->query("select * from turnos Turno where Turno.escala_id='$escala_id' order by Turno.id asc");

		$sql1 = "select concat( Militar.nm_guerra,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome,
		concat( Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nomecompleto,
		 Militar.indicativo, MilitarsEscala.id, Militar.id   , Militar.saram
		FROM militars as Militar INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
		INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id 
		and MilitarsEscala.escala_id='$escala_id' and MilitarsEscala.cumprida=1 )
		order by  Militar.id asc";

		$legendas = $this->Escala->query($sql1);

		foreach ($legendas as $militar){
			$milico[$militar['Militar']['id']]['nome'] = $militar[0]['nome'];
			$milico[$militar['Militar']['id']]['horas'] = 0;
			$milico[$militar['Militar']['id']]['dias'] = 0;
			$milico[$militar['Militar']['id']]['maior8'] = '';
			$milico[$militar['Militar']['id']]['maior24'] = '';
			$milico[$militar['Militar']['id']]['saram'] = $militar['Militar']['saram'];
		}

		foreach($turnos as $turno){
			$inicio = strtotime($turno['Turno']['hora_inicio']);
			$termino = strtotime($turno['Turno']['hora_termino']);
			$qtd = $turno['Turno']['qtd'];
			$v1h1 = date('G', $inicio);
			$v1h2 = date('G', $termino);
			$v1m1 = date('i', $inicio);
			$v1m2 = date('i', $termino);
			$v1 = $v1h1 + ($v1m1/60);
			$v2 = $v1h2 + ($v1m2/60);
			if($v2<=$v1){
				$qtd_horas = (24-$v1) + $v2;
			}else{
				$qtd_horas = (abs($v1 - $v2));
			}

			$qtd_horas = abs($qtd_horas);

			$turn[$turno['Turno']['id']]['horas'] = $qtd_horas;
				
			if($qtd_horas>=8 && $qtd_horas<24){
				foreach ($legendas as $militar){
					$milico[$militar['Militar']['id']][$turno['Turno']['id']]['maior8'] = '';
				}
			}
			if($qtd_horas>=24){
				foreach ($legendas as $militar){
					$milico[$militar['Militar']['id']][$turno['Turno']['id']]['maior24'] = '';
				}
			}
				
		}

		//print_r($milico);

		$sql = "select CumprimentoEscala.id, CumprimentoEscala.dia, CumprimentoEscala.cumprido,
		EscalasMonth.mes,  Turno.id
		FROM cumprimentoescalas CumprimentoEscala
		INNER JOIN escalasmonths as EscalasMonth on ( CumprimentoEscala.escalasmonth_id = EscalasMonth.id and EscalasMonth.mes={$ano}{$mes} )
		INNER JOIN escalas as Escala ON (Escala.id = '{$escala_id}' and EscalasMonth.escala_id = Escala.id  )
		INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id )
		order by CumprimentoEscala.dia, CumprimentoEscala.id, CumprimentoEscala.id_turno  asc ";
			
		$preenche = $this->Escala->query($sql);

		//print_r($preenche);
		//print_r($turn);
		$numeros = 0;

		foreach ($preenche as $cumpridos){
			//	echo $turn[$cumpridos['Turno']['id']]['horas'];
			if($turn[$cumpridos['Turno']['id']]['horas']>=8 && $turn[$cumpridos['Turno']['id']]['horas']<24){
				$milico[$cumpridos['CumprimentoEscala']['cumprido']]['maior8'] .= $cumpridos['CumprimentoEscala']['dia'].' ,';
			}
			if($turn[$turno['Turno']['id']]['horas']>=24){
				$milico[$cumpridos['CumprimentoEscala']['cumprido']]['maior24'] .= $cumpridos['CumprimentoEscala']['dia'].' ,';
			}
		}
		//NR_ORDEM;LEGISLA��O QUE AMPARA O DESCONTO DO AUX�LIO-ALIMENTA��O;MOTIVO DO DESCONTO;QUANTIDADE DE DIAS PARA DESCONTO;PER�ODO
		//2088444;Art. 75 do Decreto n� 4.307, de 18 Jul 2002;De ter cumprido servi�o de Escala T�cnico Operacional com turno de trabalho superior a 8h e inferior a 24h;9;01 a 31 mar 2010
		$numera = 0;
		$ultimoDiaMes = date('t',strtotime($ano.'/'.$mes.'/1'));
		$meses = array('01'=>'jan','02'=>'fev','03'=>'mar','04'=>'abr','05'=>'mai','06'=>'jun','07'=>'jul','08'=>'ago','09'=>'set','10'=>'out','11'=>'nov','12'=>'dez');
		$periodo = '01 a '.$ultimoDiaMes.' '.$meses[$mes].' '.$ano;
		$periodo9272 = $meses[$mes].' '.$ano;
		//----------SIGPES 7613
		if($sigpes==7613){
			foreach ($legendas as $militar){
				$vetor[$numera]['Saram']='**'.$militar['Militar']['saram'].'**';
				$vetor[$numera]['Lei']=iconv("UTF-8","ISO-8859-1",'Art. 75 do Decreto nº 4.307, de 18 Jul 2002');
				$vetor[$numera]['Motivo']=iconv("UTF-8","ISO-8859-1",'De ter cumprido serviço de Escala Técnico Operacional com turno de trabalho superior a 8h e inferior a 24h');
				$vetor[$numera]['Quantidade']=count(array_unique(explode(' ,',($milico[$militar['Militar']['id']]['maior8']))));
				$vetor[$numera]['Periodo']=$periodo;
				$numera++;
			}
		}
		//----------SIGPES 9272
		//NR_ORDEM;LEGISLA��O DE AUX�LIO ALIMENTA��O;DATA DA ETAPA
		//2088444;Item II do Art. 67 do Decreto nﾺ 4.307, de 18 Jul 2002;"07,11,15,18,19,23,24,25,30 e 31 mar 2010; Total: 10 (DO-ACC)"
		if($sigpes==9272){
			foreach ($legendas as $militar){
				$vetor[$numera]['Saram']='**'.$militar['Militar']['saram'].'**';
				$vetorD = array_unique(explode(' ,',($milico[$militar['Militar']['id']]['maior8'])));
				$conta=0;
				foreach($vetorD as $chave=>$valor){
					if(!empty($valor)){
						$vetorDias[$conta] = $valor;
						$conta++;
					}
				}
					
				$sequencia = '';
				if(count($vetorDias)>2){
					$contagem = count($vetorDias)-2;
					for($i=1;$i<($contagem);$i++){
						$sequencia .= $vetorDias[$i].',';
					}
					$sequencia .= $vetorDias[$contagem].' e '.$vetorDias[count($vetorDias)-1];
				}
				if(count($vetorDias)==1){
					$sequencia .= $vetorDias[0];
				}
				if(count($vetorDias)==2){
					$sequencia .= $vetorDias[0].' e '.$vetorDias[1];
				}
				$meses = array(1=>'jan',2=>'fev',3=>'mar',4=>'abr',5=>'mai',6=>'jun',7=>'jul',8=>'ago',9=>'set',10=>'out',11=>'nov',12=>'dez');
				$vetor[$numera]['Complemento']='"'.$sequencia.' '.$periodo9272.'; Total: '.count(array_unique(explode(' ,',($milico[$militar['Militar']['id']]['maior8'])))).' (DO) "';
				$vetor[$numera]['Lei']=iconv("UTF-8","ISO-8859-1",'Item II do Art. 67 do Decreto nº 4.307, de 18 Jul 2002');

				$numera++;
			}
		}
		//print_r($vetor);
		$numeros = implode(",", $numeros);

		$this->set(compact('vetor'));


	}
	function externocalendario(){
		$this->layout='admin';
		$sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Escala.id, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
		INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.setor_id)
		order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";
		$escalas = $this->Escala->query($sql);
		$totalescala=count($escalas)-1;
		$escalastring = '';

		for($c=0;$c<$totalescala;$c++){
			$escalastring.=$escalas[$c]['Setor']['id'].',';
			$vetor3[]=$escalas[$c]['Setor']['id'];
			$vetor4[]=$escalas[$c][0]['escala'];
		}
		$escalastring.=$escalas[$c]['Setor']['id'].',';
		$vetor3[]=$escalas[$c]['Setor']['id'];
		$vetor4[]=$escalas[$c][0]['escala'];
		$vetor3[]=0;
		$vetor4[]=' ';

		$escalas = array_combine($vetor3,$vetor4);
		$this->set(compact('escalas','responsavel'));

	}

	function externoupdateano($setorId = null) {
		$this->layout = 'ajax';
		if(!empty($setorId)) {
			//$filtro = 'Setor.id='.$setorId;
			$consultasql = "
				select escalasmonths.id, escalasmonths.mes from escalas
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id)
				 where escalas.setor_id='{$setorId}'
				group by escalasmonths.id, escalasmonths.mes
				order by escalasmonths.mes desc			
			";
			//$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_Setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
			$consulta = $this->Escala->query($consultasql);
			//			print_r($consulta);
			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['escalasmonths']['id']]=substr($dados['escalasmonths']['mes'],0,4).'/'.substr($dados['escalasmonths']['mes'],-2);
			}

			if(!empty($lista)) {
				foreach($lista as $k => $v) {
					echo "<option value='$k'>$v</option>";
				}
			}
		}


		exit();
	}

	function externoupdatemilitar($escalasmonthId = null) {
		$this->layout = 'ajax';

		if(!empty($escalasmonthId)) {
			//$filtro = 'Setor.id='.$setorId;
			$consultasql = "
select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade,' - ', Militar.nm_guerra, ' - ',Militar.nm_completo) as nomecompleto,  
			concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade   
			FROM militars_escalas as MilitarsEscala
			INNER JOIN escalas as Escala on (Escala.id=MilitarsEscala.escala_id)
			INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.id='$escalasmonthId'  and Escalasmonth.escala_id=MilitarsEscala.escala_id)
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			 INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
			LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id)
			where  (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.escala_id=Escala.id and MilitarsEscala.cumprida=1 )
			order by  Militar.nm_guerra asc			
";

			//echo $consultasql.'<br>';
				
			$consulta = $this->Escala->query($consultasql);
			//			print_r($consulta);
			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['Militar']['id']]=$dados[0]['nomecompleto'];
			}

			if(!empty($lista)) {
				foreach($lista as $k => $v) {
					echo "<option value='$k'>$v</option>";
				}
			}
		}


		exit();
	}
	function externopdfcalendario($escalasmonthId = null, $militarId = null) {
		$this->layout = 'pdf';
		//echo 'teste setor='.$setorId.'  anomes='.$escalasmonthId;
		if((!empty($militarId))&&(!empty($escalasmonthId))) {
			$consultasql = "
select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ',Militar.nm_completo) as nomecompleto, 
concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, Escala.id,
Cumprimentoescala.dia, Turno.rotulo, Turno.hora_inicio, Turno.hora_termino, Turno.id, Escalasmonth.mes, Escala.id
FROM militars as Militar
LEFT JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
LEFT JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) 
LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id) 
INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.militar_id='$militarId'   and MilitarsEscala.cumprida=1) 
INNER JOIN escalas as Escala on (MilitarsEscala.escala_id=Escala.id ) 
INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.id='$escalasmonthId' and Escalasmonth.escala_id=Escala.id)
INNER JOIN cumprimentoescalas as Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.cumprido=Militar.id)
INNER JOIN turnos as Turno on (Turno.escala_id=Escala.id and Turno.id=Cumprimentoescala.id_turno) 
order by nomecompleto asc			
";

			//echo $consultasql;exit();
			$consulta = $this->Escala->query($consultasql);
			//$consulta = $this->externoquadrinho($militarId);
			//echo($consulta);exit();
			$nome=$consulta[0][0]['nomecompleto'];
			$unidade=$consulta[0][0]['unidade'];
			$this->data['Escala']['id'] =$consulta[0]['Escala']['id'];
				
			$consultasql = "select * from turnos as Turno where Turno.escala_id = '{$this->data['Escala']['id']}' order by Turno.id asc";
			//echo $consultasql.'<br>';exit();
			$consultaTurno = $this->Escala->query($consultasql);
			$t=1;
			$ultimo=0;
			foreach($consultaTurno as $dadoturno){
				$vetorTurnos[$dadoturno['Turno']['id']]['periodo']=$dadoturno['Turno']['hora_inicio'].'-'.$dadoturno['Turno']['hora_termino'];
				if($dadoturno['Turno']['rotulo']=='PRETA'){
					$vetorTurnos[$dadoturno['Turno']['id']]['nome']='PRETA';
				}else{
					if($dadoturno['Turno']['rotulo']=='VERMELHA'){
						$vetorTurnos[$dadoturno['Turno']['id']]['nome']='VERMELHA';
					}else{
						if($dadoturno['Turno']['rotulo']=='ROXA'){
							$vetorTurnos[$dadoturno['Turno']['id']]['nome']='ROXA';
						}else{
							if($dadoturno['Turno']['rotulo']=='SOMBRA'){
								$vetorTurnos[$dadoturno['Turno']['id']]['nome']='SOMBRA';
							}else{
								$vetorTurnos[$dadoturno['Turno']['id']]['nome']='T'.$t;
							}
						}
					}
						
				}
				//				$vetorTurnos[$dadoturno['Turno']['id']]['nome']='T'.$t;
				$vetorTurnos[$dadoturno['Turno']['id']]['total']=0;
				$t++;
			}
				
			//print_r($vetorTurnos);
			//exit();
			$dias = $consulta;
				
			//$data = $this->Escala->query('select * from escalasmonths where id='.$escalasmonthId);
			$ano=substr($consulta[0]['Escalasmonth']['mes'],0,4);
			$mes=substr($consulta[0]['Escalasmonth']['mes'],-2);
			$nome.= ' - REFERÊNCIA:'.$mes.'/'.$ano;
			$dtIni="$ano/$mes/1";
			$qtd_dias = date('t',strtotime($dtIni));
			$primeirodiasemana = date('N',strtotime($dtIni));
				
			for($i=-7;$i<=$qtd_dias;$i++){
				$calendarioDiasVetor[$i]='';
			}
			foreach($dias as $dados){
				$calendarioDiasVetor[$dados['Cumprimentoescala']['dia']].=$vetorTurnos[$dados['Turno']['id']]['nome']."\n";
			}
			//echo $primeirodiasemana;
				
			$vetorCalendario[0][1]='Seg';
			$vetorCalendario[0][2]='Ter';
			$vetorCalendario[0][3]='Qua';
			$vetorCalendario[0][4]='Qui';
			$vetorCalendario[0][5]='Sex';
			$vetorCalendario[0][6]='Sáb';
			$vetorCalendario[0][7]='Dom';
				
			$contadias=($primeirodiasemana);
			$contagem=0;
			for($q=1;$q<=$contadias;$q++){
				$vetorCalendario[1][$q]='';
			}
			for($i=1;$i<=6;$i++){
				for($c=1;$c<=7;$c++){
					if(!(($i==1)&&($c<$contadias))){
						$contangem++;
						$vetorCalendario[$i][$c]=$calendarioDiasVetor[$contangem];
					}
				}
			}
			//print_r($vetorCalendario);exit();
			//$contadias=($primeirodiasemana);
			//$contadias=($primeirodiasemana);
			//$contadias-=7;
			$totaldias=$qtd_dias;
			//echo $contadias.' '.$totaldias;	exit();
			$this->set(compact('nome','unidade','vetorCalendario','contadias','totaldias','vetorTurnos'));
		}

		$this->render();

		//	exit();
	}
	function externomapa($escalasmonthId = null) {
		$this->layout = 'ajax';
		if($this->data['Escala']['prevista']=='p'){
			$ativos = "MilitarsEscala.prevista=1";
			$legenda = "MilitarsEscala.legenda_prevista";
			$cumprimento = "previsto";
		}else{
			$ativos = "MilitarsEscala.cumprida=1";
			$legenda = "MilitarsEscala.legenda_cumprida";
			$cumprimento = "cumprido";
		}
			

		//$filtro = 'Setor.id='.$setorId;
		$consultasql = "select concat($legenda,'-',Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade
			FROM militars_escalas as MilitarsEscala 
			INNER JOIN militars as Militar ON (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
			LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id)
			INNER JOIN escalas as Escala on (MilitarsEscala.escala_id=Escala.id )
			INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.id='{$this->data['Escalasmonth']['id']}' and Escalasmonth.escala_id=MilitarsEscala.escala_id)
			WHERE $ativos
			order by  nome asc";
			
		//echo $consultasql;
		//INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.escala_id=Escala.id and $ativos )
			
		$consultaLegenda = $this->Escala->query($consultasql);
			
		foreach($consultaLegenda as $dado){
			$qtdDias = date('t',$this->data['Escala']['ano'].'/'.$this->data['Escala']['mes'].'/1');
			for($c=1;$c<=$qtdDias;$c++){
				$vetorGeral[$dado['Militar']['id']][$c]='';
			}
			$vetorGeral[$dado['Militar']['id']]['nome']=$dado[0]['nome'];
			$vetorGeral[$dado['Militar']['id']]['horas']=0;
			$vetorGeral[$dado['Militar']['id']]['etapasM8']=0;
			$vetorGeral[$dado['Militar']['id']]['totaldias']=0;
		}
		//print_r($vetorGeral);
			
		$consultasql = "select * from turnos as Turno where Turno.escala_id = '{$this->data['Escala']['id']}' order by Turno.id asc";
		$consultaTurno = $this->Escala->query($consultasql);
			
		$t=1;
		$diaSemana=array(0=>'Dom',1=>'Seg',2=>'Ter',3=>'Qua',4=>'Qui',5=>'Sex',6=>'Sáb');
		$ultimo=0;
		foreach($consultaTurno as $dadoturno){
			$qtdDias = date('t',strtotime($this->data['Escala']['ano'].'/'.$this->data['Escala']['mes'].'/1'));
			$vetorTurnos[$dadoturno['Turno']['id']]['periodo']=$dadoturno['Turno']['hora_inicio'].'-'.$dadoturno['Turno']['hora_termino'];
			$vetorTurnos[$dadoturno['Turno']['id']]['nome']='T'.$t;
			$vetorTurnos[$dadoturno['Turno']['id']]['total']=0;

			$inicio = strtotime($dadoturno['Turno']['hora_inicio']);
			$termino = strtotime($dadoturno['Turno']['hora_termino']);
			$v1h1 = date('G', $inicio);
			$v1h2 = date('G', $termino);
			$v1m1 = date('i', $inicio);
			$v1m2 = date('i', $termino);

			$v1 = $v1h1 + ($v1m1/60);
			$v2 = $v1h2 + ($v1m2/60);

			if($v2<$v1){
				$qtd_horas = (24-$v1) + $v2;
			}else{
				$qtd_horas = (abs($v1 - $v2));
			}

			$vetorTurnos[$dadoturno['Turno']['id']]['horas']=$qtd_horas;

			$t++;
			for($c=1;$c<=$qtdDias;$c++){
				$vetorTurnos[$dadoturno['Turno']['id']][$c]=0;
				$data=strtotime($this->data['Escala']['ano'].'/'.$this->data['Escala']['mes'].'/'.$c);
				$indice=date('w',$data);
				$vetorTurnos[$dadoturno['Turno']['id']]['semana'][$c]= $diaSemana[$indice];
                                $diaDaSemana[$c] = $diaSemana[$indice];
			}
			$ultimo=$dadoturno['Turno']['id'];
		}
			
		$consultasql = "select * from cumprimentoescalas as Cumprimentoescala where Cumprimentoescala.escalasmonth_id = '{$this->data['Escalasmonth']['id']}' order by Cumprimentoescala.dia asc, Cumprimentoescala.id_turno asc, Cumprimentoescala.$cumprimento asc ";
		$consultaCumprimento = $this->Escala->query($consultasql);
			
		foreach($consultaCumprimento as $dadoReal){
			if(strlen($vetorGeral[$dadoReal['Cumprimentoescala'][$cumprimento]]['nome'])>0){
				$vetorTurnos[$dadoReal['Cumprimentoescala']['id_turno']]['total'] += 1;
				$vetorTurnos[$dadoReal['Cumprimentoescala']['id_turno']][$dadoReal['Cumprimentoescala']['dia']] = $vetorTurnos[$dadoReal['Cumprimentoescala']['id_turno']][$dadoReal['Cumprimentoescala']['dia']]+1;
				$vetorGeral[$dadoReal['Cumprimentoescala'][$cumprimento]][$dadoReal['Cumprimentoescala']['dia']].= $vetorTurnos[$dadoReal['Cumprimentoescala']['id_turno']]['nome'];
				$vetorGeral[$dadoReal['Cumprimentoescala'][$cumprimento]]['horas'] += $vetorTurnos[$dadoReal['Cumprimentoescala']['id_turno']]['horas'];
				$vetorGeral[$dadoReal['Cumprimentoescala'][$cumprimento]]['totaldias'] += 1;
				if($vetorTurnos[$dadoReal['Cumprimentoescala']['id_turno']]['horas']>8){
					$vetorGeral[$dadoReal['Cumprimentoescala'][$cumprimento]]['etapasM8'] += 1;
				}
			}
		}
		//print_r($vetorGeral);
		$mensagem .= "<div style='padding: 0px;margin: 0px;color: #000000;height: 100%;background:#ffffff; opacity: 1;position:relative;'>";

		$mensagem .= "<table cellpadding='0' cellspacing='0' border='1' width='100%' style='font-size:8px;'><tr style='background-color:#8080ff;' align='center' ><td><b>Operadores/Turnos</b></td>";
		for($c=1;$c<=$qtdDias;$c++){
			$mensagem.="<td style='background-color:#203040;color:#ffffff;text-align:center;' ><b>".$c."</b></td>";
		}
			
		$mensagem.='<td><b>Horas</b></td><td><b>Dias</b></td><td><b>Etapas>8h</b></td></tr>';

		$mensagem .= "<tr><td><b></b></td>";
		for($c=1;$c<=$qtdDias;$c++){
			if($vetorTurnos[$ultimo]['semana'][$c]=='Sáb'||$vetorTurnos[$ultimo]['semana'][$c]=='Dom'){
				$mensagem.="<td style='background-color:#f00000;color:#ffffff;'><b>".$vetorTurnos[$ultimo]['semana'][$c]."</b></td>";
			}else{
				$mensagem.="<td style='background-color:#8080f0;color:#000000;text-align:center;'><b>".$vetorTurnos[$ultimo]['semana'][$c]."</b></td>";
			}
		}
		$mensagem.='<td></td><td></td><td></td></tr>';
			
		foreach($vetorTurnos as $chave=>$valor){
			$mensagem .= "<tr style='background-color:#8080ff;' ><td style='text-align:right;background-color:#808080;color:#000000;'><b>".$valor['nome']."->".$valor['periodo']."</b></td>";
			for($c=1;$c<=$qtdDias;$c++){
				$mensagem.="<td style='background-color:#b08080;color:#000000;text-align:center;'><b>".$valor[$c]."</b></td>";
			}
			$mensagem.='<td></td><td>'.$valor['total'].'</td><td></td></tr>';
		}


		$i=0;
			
		foreach($vetorGeral as $chave=>$valor){
			$class = null;
                        if ($i++ % 2 == 0) {
                            $class = " style='background-color:#e0e0f0;'";
                        }
                        $antes = $class;

			$mensagem .= '<tr ><td '.$class.' ><b>'.$valor['nome'].'</b></td>';
			for($c=1;$c<=$qtdDias;$c++){
                                if($diaDaSemana[$c]=='Sáb'||$diaDaSemana[$c]=='Dom'){
                                        $class = " style='background-color:#ff0000;color:#ffffff;'";
                                }else{
                                    
                                        $class = $antes;
                                    
                                }
				$mensagem.='<td '.$class.'><b>'.$valor[$c].'</b></td>';
			}
			$mensagem.="<td style='background-color:#b08080;color:#000000;text-align:center;'><b>".$valor['horas']."</b></td><td style='background-color:#b08080;color:#000000;text-align:center;'><b>".$valor['totaldias']."</b></td><td style='background-color:#b08080;color:#000000;text-align:center;'><b>".$valor['etapasM8'].'</b></td></tr>';
		}
			
		$mensagem .= "<tr><td colspan='40'></td></tr></table></div>";

		//$mensagem .= "<div style='align:center;border:2px solid #000000;padding: 0px;margin: 0px;color: #000000;opacity: 1;background:#b0b0b0;'></div>";
			
		//print_r($vetorGeral);
		//echo $mensagem;

		//	header('Content-type: application/x-json');
		$ok=1;
		echo '{ "mediaHoras":"'.$media.'","mensagem":"'.($mensagem).'","alteracao":"'.urlencode(($alteracoes)).'", "ok":"'.$ok.'" }';


		exit();
	}

	function externoespelho(){
		//$this->layout = 'ajax';
		$u=$this->Session->read('Usuario');
                
		if($u[0]['Usuario']['privilegio_id']==1){
			$setores = " 1=1 ";
		}else{
			$setores = " setors.id in ('".$u[0][0]['setores']."') ";
		}
		//$filtro = 'Setor.id='.$setorId;
		$consultasql = "
				select escalasmonths.id, escalasmonths.mes from escalas
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id)
				inner join setors on (setors.id=escalas.setor_id and {$setores})
				group by escalasmonths.mes
				order by escalasmonths.mes desc			
			";
		//echo $consultasql.'<br>';
		//$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_Setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
		$consulta = $this->Escala->query($consultasql);
		//			print_r($consulta);
		$lista[0] = '';
		$lista[0] = '---';
		foreach($consulta as $dados){
			$lista[$dados['escalasmonths']['mes']]=substr($dados['escalasmonths']['mes'],0,4).'/'.substr($dados['escalasmonths']['mes'],-2);
		}

		if(!empty($lista)) {
			foreach($lista as $k => $v) {
				$escalasm.="<option value='$k'>$v</option>";
				//$escalasmonth[$k]=$v;
			}
		}
	 	
		$escalasmonth=$lista;
		$this->set(compact('escalasmonth'));
	}
	function externoespelhopdf(){
		//$this->layout = 'ajax';
		$anomes=$this->data['Escala']['ano'];
		$vetorIdEscalasmonths=$this->data['Escala']['escala'];
		$quantidade=count($this->data['Escala']['escala']);
		$dia=$this->data['Escala']['dia'];

		//print_r($this->data);
		$ids = '"';
		foreach($vetorIdEscalasmonths as $chave=>$valor){
			$ids .= $valor.'","';
		}
                $ids .= '"';
		//$ids = substr($ids,0,-1);

		//$estrutura[$turno][$escala][$militar][0]=$nome.$rg.$posto.$sup;

		//Consultar turnos com hora_inicio e hora_termino distintos

		$consultaturnossql = "
				select turnos.hora_inicio, turnos.hora_termino from turnos
				inner join escalas on (escalas.id=turnos.escala_id)
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id and escalasmonths.id in ($ids))
				group by turnos.hora_inicio, turnos.hora_termino
				order by turnos.hora_inicio asc, turnos.hora_termino asc			
			";
		$consultaturnos = $this->Escala->query($consultaturnossql);


		$consultaescalassql = "
				select escalasmonths.id, setors.sigla_setor   from escalasmonths
				inner join escalas on (escalas.id=escalasmonths.escala_id)
				inner join setors on (setors.id=escalas.setor_id )
				where escalasmonths.id in ($ids)
				order by  setors.sigla_setor asc			
			";
		$consultaescalas = $this->Escala->query($consultaescalassql);

		$consultaescaladossql = "
				select militars.nm_guerra, postos.sigla_posto, especialidades.nm_especialidade,
				militars.supervisor, militars.instrutor, militars.identidade, escalasmonths.id,
				cumprimentoescalas.id_turno, cumprimentoescalas.escalasmonth_id,
				cumprimentoescalas.cumprido, turnos.hora_inicio, turnos.hora_termino, militars_escalas.legenda_cumprida,
				setors.sigla_setor, postos.antiguidade, quadros.sigla_quadro
				 from cumprimentoescalas
				inner join escalasmonths on (escalasmonths.id in ($ids) and escalasmonths.id=cumprimentoescalas.escalasmonth_id)
				inner join escalas on (escalas.id=escalasmonths.escala_id)
				inner join militars_escalas on (militars_escalas.escala_id=escalas.id and militars_escalas.cumprida=1)
				inner join militars on (militars.id=cumprimentoescalas.cumprido and militars.id=militars_escalas.militar_id)
				inner join turnos on (turnos.escala_id=escalas.id)
				inner join postos on (postos.id=militars.posto_id)
				left  join especialidades on (especialidades.id=militars.especialidade_id)
				inner join quadros on (quadros.id=especialidades.quadro_id)
				inner join setors on (setors.id=escalas.setor_id )
				where cumprimentoescalas.dia=$dia
				order by  turnos.hora_inicio asc, turnos.hora_termino asc, setors.sigla_setor asc, postos.antiguidade asc			
			";
		$consultaescalados = $this->Escala->query($consultaescaladossql);
		//echo $consultaescaladossql;
		echo '<pre>';
		//	print_r($consultaescalados);
		echo '</pre>';
		//echo $consultasql;


	}

	function externoupdateescalas($escalasmonthmes=null){
		$this->layout = 'ajax';
		$u=$this->Session->read('Usuario');
                
		//$filtro = 'Setor.id='.$setorId;
                if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==2)){
		$consultasql = "
				select Escalasmonth.id, concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala from escalas as Escala
				inner join escalasmonths as Escalasmonth on (Escalasmonth.escala_id=Escala.id and Escalasmonth.mes=$escalasmonthmes)
				inner join setors as Setor on (Setor.id=Escala.setor_id)
				inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
				LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
				order by Escala.tipo, Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc
				";			
                }else{
		$consultasql = "
				select Escalasmonth.id, concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala from escalas as Escala
				inner join escalasmonths as Escalasmonth on (Escalasmonth.escala_id=Escala.id and Escalasmonth.mes=$escalasmonthmes)
				inner join setors as Setor on (Setor.id=Escala.setor_id and Setor.id in ({$u[0][0]['setores']}))
				inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
				LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
				order by Escala.tipo, Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc
				";			
                }

		//echo $consultasql.'<br>';
			
		$consulta = $this->Escala->query($consultasql);
		$lista[0] = '';
		$lista[0] = '---';
		foreach($consulta as $dados){
			$lista[$dados['Escalasmonth']['id']]=$dados[0]['escala'];
		}

		if(!empty($lista)) {
			foreach($lista as $k => $v) {
				echo "<option value='$k'>$v</option>";
			}
		}
	 	
		exit();


	}
	function externoupdatedias($anomes=null){
		$this->layout = 'ajax';

		$dta=substr($anomes,0,4);
		$dtm=substr($anomes,-2);
		$dtIni = strtotime("$dta/$dtm/1");
		$qtddias = date('t',$dtIni);
		echo "<option value=''></option>";
		//echo $dtIni.' '.$qtddias;
		for($d=1;$d<=$qtddias;$d++){
			echo "<option value='$d'>$d</option>";
			//$diasVetor[$d]=$d;
		}
	 	
		exit();


	}

	function externocontaetapas(){
		$dta = 2010;
		$dtm = 0;
		//$dtIni = strtotime("$dta/$dtm/1");

		for($i=1;$i<=12;$i++){
			$dtm++;
			if($dtm<10){
				$data = '0'.$dtm;
			}else{
				$data = $dtm;
			}
			$dtIni = "$dta$data";
			$selmes = "select cumprimentoescalas.*, turnos.hora_inicio, turnos.hora_termino, unidades.sigla_unidade, setors.sigla_setor from cumprimentoescalas
		inner join escalasmonths on (escalasmonths.id=cumprimentoescalas.escalasmonth_id and escalasmonths.mes='$dtIni')
		inner join escalas on (escalas.ativa>0 and escalas.id=escalasmonths.escala_id)
		inner join turnos on (turnos.id=cumprimentoescalas.id_turno)
		inner join setors on (setors.id=escalas.setor_id)
		inner join unidades on (unidades.id=setors.unidade_id)
		where cumprido is not null
		";
			$consulta = $this->Escala->query($selmes);
			$vetor[$data]['total']=0;
			foreach ($consulta as $dados){
				$inicio = strtotime($dados['turnos']['hora_inicio']);
				$termino = strtotime($dados['turnos']['hora_termino']);
				$v1h1 = date('G', $inicio);
				$v1h2 = date('G', $termino);
				$v1m1 = date('i', $inicio);
				$v1m2 = date('i', $termino);
				$v1 = $v1h1 + ($v1m1/60);
				$v2 = $v1h2 + ($v1m2/60);
				if($v2<$v1){
					$qtd_horas = (24-$v1) + $v2;
				}else{
					$qtd_horas = (abs($v1 - $v2));
				}
				if($qtd_horas>8){
					$total = $vetor[$data]['total'];
					$total++;
					$vetor[$data]['total']=$total;
				}
			}
			//echo $selmes;
		}
		$tabela="<table><tr><th>JANEIRO</th><th>FEVEREIRO</th><th>MARÇO</th><th>ABRIL</th><th>MAIO</th><th>JUNHO</th><th>JULHO</th><th>AGOSTO</th><th>SETEMBRO</th><th>OUTUBRO</th><th>NOVEMBRO</th><th>DEZEMBRO</th></tr><tr>";
		$dtm = 0;

		for($i=1;$i<=12;$i++){
			$dtm++;
			if($dtm<10){
				$data = '0'.$dtm;
			}else{
				$data = $dtm;
			}
			$tabela.="<td>{$vetor[$data]['total']}</td>";

		}
		$tabela.="</table>";

		echo $tabela;
		//print_r($vetor);
		exit();

	}
	function externozip(){
		$this->layout = null;
		$dta = $this->data['Escala']['ano'];
		$dtm = 0;
		//$dtIni = strtotime("$dta/$dtm/1");

		for($i=1;$i<=12;$i++){
			$dtm++;
			if($dtm<10){
				$data = '0'.$dtm;
			}else{
				$data = $dtm;
			}
			$dtIni = "$dta$data";
			$selmes = "select cumprimentoescalas.*, turnos.hora_inicio, turnos.hora_termino, unidades.sigla_unidade, setors.sigla_setor from cumprimentoescalas
		inner join escalasmonths on (escalasmonths.id=cumprimentoescalas.escalasmonth_id and escalasmonths.mes='$dtIni')
		inner join escalas on (escalas.ativa>0 and escalas.id=escalasmonths.escala_id)
		inner join turnos on (turnos.id=cumprimentoescalas.id_turno)
		inner join setors on (setors.id=escalas.setor_id)
		inner join unidades on (unidades.id=setors.unidade_id)
		where cumprido is not null
		";
			//print_r($this->data);
			$consulta = $this->Escala->query($selmes);
			$vetor[$data]['total']=0;
			foreach ($consulta as $dados){
				$inicio = strtotime($dados['turnos']['hora_inicio']);
				$termino = strtotime($dados['turnos']['hora_termino']);
				$v1h1 = date('G', $inicio);
				$v1h2 = date('G', $termino);
				$v1m1 = date('i', $inicio);
				$v1m2 = date('i', $termino);
				$v1 = $v1h1 + ($v1m1/60);
				$v2 = $v1h2 + ($v1m2/60);
				if($v2<$v1){
					$qtd_horas = (24-$v1) + $v2;
				}else{
					$qtd_horas = (abs($v1 - $v2));
				}
				if($qtd_horas>8){
					$total = $vetor[$data]['total'];
					$total++;
					$vetor[$data]['total']=$total;
				}
			}
			//echo $selmes;
		}

		$this->set('vetor',$vetor);
		//print_r($vetor);
		//exit();
	}
	function externoquantitativo(){

	}

	function externocursosrealizados(){
		$ok = 1;
		$this->Escala->recursive = 1;
			
		if($this->data['Paeatsindicado']['opcao']=='nome'){
			$conditions=array('Paeatsindicado.nomecompleto like "%'.$this->data['Paeatsindicado']['nome'].'%"');
			$order=array('Paeat.inicio'=>'asc');
			$paeats = $this->Escala->find('all',array('conditions'=>$conditions, 'order'=>$order));
		}
			
		if($this->data['Paeatsindicado']['opcao']=='unidade'){
			$conditions=array('Setor.unidade_id='.$this->data['Paeatsindicado']['unidade'].'%');
			$consulta = 'select Paeatsindicado.*,Paeat.* from paeatsindicados Paeatsindicado
				inner join paeats Paeat on (Paeat.id=Paeatsindicado.paeat_id)
				inner join militars on (militars.id=Paeatsindicado.militar_id) inner join setors on (militars.setor_id=setors.id and setors.unidade_id="'.$this->data['Paeatsindicado']['unidade'].'") order by Paeat.inicio asc';
			//echo $consulta;
			$paeats = $this->Escala->query($consulta);
		}
			
		//print_r($paeats);
		$cor=' style="background-color:#a0ccd0;" ';
		$mensagem= "<table cellpadding='0' cellspacing='1' border='1'><tr><th $cor>Indicado</th><th $cor>Curso</th><th $cor>Inicio</th><th $cor>T&eacute;rmino</th><th $cor>Refer&ecirc;ncia</th><th $cor>Respons&aacute;vel pelo Cadastro</th><th $cor>Data do Cadastro</th></tr>";
		$i=0;
		foreach($paeats as $dado){
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			$mensagem .= "	<tr ><td{$class}>{$dado['Paeatsindicado']['nomecompleto']}</td><td{$class}>{$dado['Paeatsindicado']['codcurso']}</td><td{$class}>{$dado['Paeat']['inicio']}</td><td{$class}>{$dado['Paeat']['fim']}</td><td{$class}>{$dado['Paeatsindicado']['referenciavaga']}</td><td{$class}>{$dado['Paeatsindicado']['responsavel']}</td><td{$class}>{$dado['Paeatsindicado']['created']}</td></tr>";
		}
			
		$mensagem.="</table>";
			
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode((str_replace("\n"," ",($mensagem)))).'"}';
		exit();

	}
	function externomilitarescala(){
		$u=$this->Session->read('Usuario');
		$consultasql = "
				select escalasmonths.id, escalasmonths.mes from escalas
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id)
				left join setors on (setors.id=escalas.setor_id)
				group by escalasmonths.mes
				order by escalasmonths.mes desc			
			";
		$consulta = $this->Escala->query($consultasql);
		//			print_r($consulta);
		$lista[0] = '';
		$lista[0] = '---';
		foreach($consulta as $dados){
			$lista[$dados['escalasmonths']['mes']]=substr($dados['escalasmonths']['mes'],0,4).'/'.substr($dados['escalasmonths']['mes'],-2);
		}

		$escalasm = '';
		if(!empty($lista)) {
			foreach($lista as $k => $v) {
				$escalasm.="<option value='$k'>$v</option>";
				//$escalasmonth[$k]=$v;
			}
		}
	 	
		$escalasmonth=$lista;
		$this->set(compact('escalasmonth'));
			
		echo $conteudo;
	}        
	function externomilitarescalaadd(){
                   $this->layout = null;
		$u=$this->Session->read('Usuario');
                $obtemescala = "select escala_id from escalasmonths where id='{$this->data['Escala']['escala']}'";
                $escalaobtida = $this->Escala->query($obtemescala);
                $this->data['Escala']['escala'] = $escalaobtida[0]['escalasmonths']['escala_id'];
                if(isset($this->data['Escala']['prevista'])){
                    $this->data['Escala']['prevista']=1;
                }else{
                    $this->data['Escala']['prevista']=0;
                }
                if(isset($this->data['Escala']['cumprida'])){
                    $this->data['Escala']['cumprida']=1;
                }else{
                    $this->data['Escala']['cumprida']=0;
                }
                $mensagem = ''; $ok = 1;
                if(empty($this->data['Escala']['escala'])||empty($this->data['Escala']['militar'])||empty($this->data['Escala']['legendap'])||empty($this->data['Escala']['legendac'])){
                   $mensagem = 'Um dos itens não foi preenchido: 1- Escala, 2-Militar, 3- Legenda Prevista, 4- Legenda Cumprida<br>'; $ok = 0;
                }
                if(empty($mensagem)){
                    $insere = "insert into militars_escalas (id, escala_id, militar_id, legenda_prevista, legenda_cumprida, prevista, cumprida, ignoraafastamento) values (uuid(), '{$this->data['Escala']['escala']}', '{$this->data['Escala']['militar']}', '{$this->data['Escala']['legendap']}', '{$this->data['Escala']['legendac']}', {$this->data['Escala']['prevista']}, {$this->data['Escala']['cumprida']},'N')";
                    $resultado = $this->Escala->query($insere);
                    if(!$resultado){
                        $ok = 0; $mensagem = 'Houve problema no cadastro. Dados não cadastrados! ';
                    }
                    
                }
                //echo $insere;
		$consultasql = " select concat(Militar.nm_completo,' ', Posto.sigla_posto) as nome, MilitarsEscala.id, Militar.id, MilitarsEscala.legenda_prevista, MilitarsEscala.ignoraafastamento, MilitarsEscala.legenda_cumprida, MilitarsEscala.prevista,MilitarsEscala.cumprida  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and MilitarsEscala.escala_id='{$this->data['Escala']['escala']}')
			order by length(MilitarsEscala.legenda_prevista) desc, MilitarsEscala.legenda_prevista desc ";
		$consulta = $this->Escala->query($consultasql);
                $registros = '<table><tr><th>Legenda</th><th>Nome</th></tr>';
                foreach($consulta as $dado){
                    $registros .= '<tr><td>'.$dado['MilitarsEscala']['legenda_prevista'].'</td><td>'.$dado[0]['nome'].'</td></tr>';
                }
                $registros .= '</table>';
		header('Content-type: application/x-json');

		$ok = 1;
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.$mensagem.'", "registros":"'.$registros.'"}';
		exit();
	}        
	function externoboletim(){
		//$this->layout = 'ajax';
		$u=$this->Session->read('Usuario');
                
		//print_r($u);
		//if($u[0]['Usuario']['privilegio_id']==1){$setores = " 1=1 ";}else{$setores = " setors.id in ('".$u[0][0]['setores']."') ";}

		//if(empty($u[0][0]['setores'])){$this->redirect('Usuario');}
		//$filtro = 'Setor.id='.$setorId;
		$consultasql = "
				select escalasmonths.id, escalasmonths.mes from escalas
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id)
				inner join setors on (setors.id=escalas.setor_id)
				group by escalasmonths.mes
				order by escalasmonths.mes desc			
			";
		//echo $consultasql.'<br>';
		//$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_Setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
		$consulta = $this->Escala->query($consultasql);
		//			print_r($consulta);
		$lista[0] = '';
		$lista[0] = '---';
		foreach($consulta as $dados){
			$lista[$dados['escalasmonths']['mes']]=substr($dados['escalasmonths']['mes'],0,4).'/'.substr($dados['escalasmonths']['mes'],-2);
		}

		$escalasm = '';
		if(!empty($lista)) {
			foreach($lista as $k => $v) {
				$escalasm.="<option value='$k'>$v</option>";
				//$escalasmonth[$k]=$v;
			}
		}
	 	
		$escalasmonth=$lista;
		$this->set(compact('escalasmonth'));
			
		echo $conteudo;
		//echo $this->_encrypt('TEstando');
	}
	function externogeraboletim(){
		//$this->layout = 'ajax';
		$ano=substr($this->data['Escala']['ano'],0,4);
		$mes=substr($this->data['Escala']['ano'],-2);
		$inicio=$this->data['Escala']['inicio'];
		$termino=$this->data['Escala']['termino'];
		$meses = array('01'=>'janeiro','02'=>'fevereiro','03'=>'março','04'=>'abril','05'=>'maio','06'=>'junho','07'=>'julho','08'=>'agosto','09'=>'setembro','10'=>'outubro','11'=>'novembro','12'=>'dezembro');
		$semanas = array('1'=>'segunda','2'=>'terça','3'=>'quarta','4'=>'quinta','5'=>'sexta','6'=>'sábado','7'=>'domingo');
		//$unidade = $this->data['Escala']['escala'][0]['Unidade']['sigla_unidade'];

		$vetescalas=explode(',',$this->data['Escala']['escala'][0]);
		$escalasid='';
                foreach($vetescalas as $dado){
                   $escalasid .= "'".$dado."',";
                }
                

                 
		$escalasid = substr($escalasid,0,-1);	
		
		$sql1 = <<< HEREDOC

			select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Militar.nm_completo,' ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nomecompleto,  
			concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.nm_completo, Militar.nm_guerra, Militar.saram, Militar.indicativo, 
			MilitarEscala.legenda_cumprida, MilitarEscala.id, Militar.id , Turno.id, Turno.rotulo, Unidade.sigla_unidade, Setor.sigla_setor, Unidade.sigla_unidade, Escala.tipo,
			Turno.hora_inicio,Turno.hora_termino, Cumprimentoescala.dia
			from militars_escalas MilitarEscala
			inner join escalasmonths Escalasmonth on (Escalasmonth.id in ( $escalasid ) and MilitarEscala.escala_id=Escalasmonth.escala_id)
			inner join turnos Turno on (Turno.escala_id=Escalasmonth.escala_id)
			inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.dia>=$inicio and Cumprimentoescala.dia<=$termino and Cumprimentoescala.cumprido=MilitarEscala.militar_id and Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.id_turno=Turno.id)
			inner join militars Militar on (Militar.id=MilitarEscala.militar_id and MilitarEscala.cumprida=1)
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)			
			left join escalas Escala on (Escala.id=MilitarEscala.escala_id)
			left join setors Setor on (Escala.setor_id=Setor.id)
			left join unidades Unidade on (Unidade.id=Setor.unidade_id)
			order by Cumprimentoescala.dia asc, Unidade.sigla_unidade asc, concat(Turno.hora_inicio,Turno.hora_termino) asc, Setor.sigla_setor asc,   nome asc
			
HEREDOC;
	$sql = $sql1;
		//echo $sql."\n";exit();

		$consulta = $this->Escala->query($sql);
		$unico=$consulta[0]['Cumprimentoescala']['dia'];
		$semana = date('N',strtotime($ano.'-'.$mes.'-'.$unico));
		$conteudo = 'Para o dia '.$unico.' de '.iconv('UTF-8','ISO-8859-1',$meses[$mes]).' de '.$ano.' ('.iconv('UTF-8','ISO-8859-1',$semanas[$semana]).")\n\r".$consulta[0]['Unidade']['sigla_unidade']."\n\r";
		$primeiraocorrencia = $consulta[0]['Unidade']['sigla_unidade'];
		foreach($consulta as $dados){

			if($unico==$dados['Cumprimentoescala']['dia']){
				$posicao = '';
				if(($dados['Escala']['tipo']=='RISAER')||($dados['Escala']['tipo']=='TECNICA')){
					if($primeiraocorrencia!=$dados['Unidade']['sigla_unidade']){
						$entrelinhas = "\n\r".$dados['Unidade']['sigla_unidade']."\n\r";
						$primeiraocorrencia= $dados['Unidade']['sigla_unidade'];
					}else{
						$entrelinhas = "";
					}
					
					//$posicao=$entrelinhas.substr($dados['Setor']['sigla_setor'],3);
					$posicao= $dados['Unidade']['sigla_unidade'].'-'.substr($dados['Setor']['sigla_setor'],3);
					$posicao=str_pad(iconv('UTF-8','ISO-8859-1',$posicao),50,'.');
					$posicao = $entrelinhas.$posicao;
				}else{
					if($primeiraocorrencia!=$dados['Unidade']['sigla_unidade']){
						$entrelinhas = "";
						$primeiraocorrencia= $dados['Unidade']['sigla_unidade'];
					}else{
						$entrelinhas = "";
					}
					
					//$posicao=$entrelinhas.$dados['Unidade']['sigla_unidade'].'-'.substr($dados['Setor']['sigla_setor'],3);
				if(($dados['Escala']['tipo']=='RISAER')||($dados['Escala']['tipo']=='TECNICA')){
					$posicao=$dados['Unidade']['sigla_unidade'].'-'.substr($dados['Setor']['sigla_setor'],3);
                                }else{
					$posicao=$dados['Unidade']['sigla_unidade'].'-'.$dados['Setor']['sigla_setor'];
                                }
					//$posicao=$dados['Unidade']['sigla_unidade'].'-'.$dados['Setor']['sigla_setor'];
					$posicao=$entrelinhas.str_pad(iconv('UTF-8','ISO-8859-1',$posicao),50,'.');
					$posicao.=str_pad(' -> '.iconv('UTF-8','ISO-8859-1',$dados['Turno']['rotulo']),20,'.').'('.substr($dados['Turno']['hora_inicio'],0,5).'-'.substr($dados['Turno']['hora_termino'],0,5).')';
				}
				$posicao.=':'.$dados[0]['nome']."\n\r";
				$conteudo .=$posicao;
					
			}else{
				$posicao = '';
				$unico=$dados['Cumprimentoescala']['dia'];
				$semana = date('N',strtotime($ano.'-'.$mes.'-'.$unico));
				$conteudo .= "\n\r".'Para o dia '.$unico.' de '.iconv('UTF-8','ISO-8859-1',$meses[$mes]).' de '.$ano.' ('.iconv('UTF-8','ISO-8859-1',$semanas[$semana]).")\n\r".$dados['Unidade']['sigla_unidade']."\n\r";
                                $unidade = $dados['Unidade']['sigla_unidade'].'-';
				if(($dados['Escala']['tipo']=='RISAER')||($dados['Escala']['tipo']=='TECNICA')){
					$posicao=substr($dados['Setor']['sigla_setor'],3);
					$posicao=str_pad(iconv('UTF-8','ISO-8859-1',$unidade.$posicao),50,'.');
				}else{
					$posicao=$dados['Setor']['sigla_setor'];
					$posicao=str_pad(iconv('UTF-8','ISO-8859-1',$unidade.$posicao),50,'.');
					$posicao.=str_pad(' -> '.iconv('UTF-8','ISO-8859-1',$dados['Turno']['rotulo']),20,'.').'('.substr($dados['Turno']['hora_inicio'],0,5).'-'.substr($dados['Turno']['hora_termino'],0,5).')';
				}
				$posicao.=':'.$dados[0]['nome']."\n\r";
				$conteudo .=$posicao;
					
			}


		}
		//	print_r($consulta);
		//$conteudo .= print_r($consulta,true);
		$conteudo .= $posicao;
			


		$consultasql = "
				select escalasmonths.id, escalasmonths.mes from escalas
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id)
				inner join setors on (setors.id=escalas.setor_id and {$setores})
				group by escalasmonths.mes
				order by escalasmonths.mes desc			
			";
		//echo $consultasql.'<br>';
		//$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_Setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
		//			print_r($consulta);
		$lista[0] = '';
		$lista[0] = '---';
		foreach($consulta as $dados){
			$lista[$dados['escalasmonths']['mes']]=substr($dados['escalasmonths']['mes'],0,4).'/'.substr($dados['escalasmonths']['mes'],-2);
		}

		$escalasm = '';
		if(!empty($lista)) {
			foreach($lista as $k => $v) {
				$escalasm.="<option value='$k'>$v</option>";
				//$escalasmonth[$k]=$v;
			}
		}
		// $conteudo=iconv('UTF-8','ISO-8859-1',$conteudo);
		$escalasmonth=$lista;
		$this->set(compact('escalasmonth'));
			
		//echo $conteudo;
			
		header('Content-type: application/x-json');

		$ok = 1;
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode((str_replace("\n"," ",($conteudo)))).'"}';
		exit();
	}
	function externoquadrinho($militarId = null, $setorId=null, $escalasmonthmes=null) {
		if(empty($this->layout)){
			$this->layout = 'ajax';
		}
		if((!empty($militarId))&&(!empty($setorId))) {
			//, group_concat(lpad(Cumprimentoescala.dia,2,'0'),'-',Escala.mes,'-', Escala.ano)
			#select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ',Militar.nm_completo) as nomecompleto,concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, Escala.id,
			$consultasql = "
select Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, date( concat(Escala.ano,'-', Escala.mes, '-', lpad(Cumprimentoescala.dia,2,'0'))) as data,
Escala.id, Cumprimentoescala.dia,  Escalasmonth.mes, Escala.ano, Turno.rotulo
FROM militars as Militar
LEFT JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
LEFT JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) 
LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id) 
INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and MilitarsEscala.militar_id='$militarId'   and MilitarsEscala.cumprida=1) 
INNER JOIN escalas as Escala on (MilitarsEscala.escala_id=Escala.id and Escala.setor_id='$setorId' ) 
INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.escala_id=Escala.id and Escalasmonth.mes<=$escalasmonthmes)
INNER JOIN cumprimentoescalas as Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.cumprido=Militar.id)
INNER JOIN turnos as Turno on (Turno.escala_id=Escala.id and Turno.id=Cumprimentoescala.id_turno and Turno.rotulo<>'SOMBRA') 
order by data desc
limit 0,10
";
			//group by Militar.id

			//echo $consultasql;exit();
			$consulta = $this->Escala->query($consultasql);
			foreach($consulta as $dado){
				if($dado['Turno']['rotulo']=='PRETA'){
					$diasp[]= $dado[0]['data'];
				}else{
					if($dado['Turno']['rotulo']=='VERMELHA'){
						$diasv[]= $dado[0]['data'];
					}else{
						if(date('N',strtotime($dado[0]['data']))>=6){
							$diasv[]= $dado[0]['data'];
						}
						if(date('N',strtotime($dado[0]['data']))<6){
							$diasp[]= $dado[0]['data'];
						}
					}
				}
				$dias[]=$dado[0]['data'];
			}
				
			$preta = implode(', ',$diasp);
			$vermelha = implode(', ',$diasv);
			if(!empty($diasp)||!empty($diasv)){
				$consulta = 'P=>'.$preta.' | V=>'.$vermelha;
			}
			//$consulta = print_r($consulta,true);
			return $consulta;
			//	exit();
		}
		return 0;
	}

	function externoquadrinhos() {
		if(empty($this->layout)){
			$this->layout = 'ajax';
		}
		$escalasmonthmes=$this->params['form']['escalasmonthmes'];
		$setorId=$this->params['form']['setorid'];
		if((!empty($escalasmonthmes))&&(!empty($setorId))) {
			//, group_concat(lpad(Cumprimentoescala.dia,2,'0'),'-',Escala.mes,'-', Escala.ano)
			#select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, concat( Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ',Militar.nm_completo) as nomecompleto,concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as postograd, Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, Escala.id,
			$consultasql = "
			select 
			concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, 
			Militar.id , concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) as unidade, date( concat(Escala.ano,'-', Escala.mes, '-', lpad(Cumprimentoescala.dia,2,'0'))) as data,
			Escala.id, Cumprimentoescala.dia,  Escalasmonth.mes, Escala.ano, Turno.rotulo, MilitarsEscala.legenda_cumprida
			FROM militars as Militar
			LEFT JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
			LEFT JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) 
			LEFT JOIN setors as Setor on (Setor.id=Militar.setor_id) 
			LEFT JOIN unidades as Unidade ON (Unidade.id=Setor.unidade_id) 
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and  MilitarsEscala.cumprida=1) 
			INNER JOIN escalas as Escala on (MilitarsEscala.escala_id=Escala.id and Escala.setor_id='$setorId' ) 
			INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.escala_id=Escala.id and Escalasmonth.mes<=$escalasmonthmes)
			INNER JOIN cumprimentoescalas as Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.cumprido=Militar.id)
			INNER JOIN turnos as Turno on (Turno.escala_id=Escala.id and Turno.id=Cumprimentoescala.id_turno) 
			order by MilitarsEscala.legenda_cumprida asc, data desc
";
			//group by Militar.id
			$consultalegendas = "
			select 
			Militar.id,Escala.id, MilitarsEscala.legenda_cumprida
			FROM militars as Militar
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id = MilitarsEscala.militar_id and  MilitarsEscala.cumprida=1) 
			INNER JOIN escalas as Escala on (MilitarsEscala.escala_id=Escala.id and Escala.setor_id='$setorId' ) 
			INNER JOIN escalasmonths as Escalasmonth on (Escalasmonth.escala_id=Escala.id and Escalasmonth.mes=$escalasmonthmes)
			order by  length(MilitarsEscala.legenda_cumprida),MilitarsEscala.legenda_cumprida asc";
				
			$legendas = $this->Escala->query($consultalegendas);
				
			//echo $consultalegendas;exit();
			$consulta = $this->Escala->query($consultasql);
			foreach($consulta as $dado){
				$nomes[$dado['Militar']['id']]= $dado[0]['nome'];
				$legenda[$dado['Militar']['id']]= $dado['MilitarsEscala']['legenda_cumprida'];
				if($dado['Turno']['rotulo']=='PRETA'){
					$diasp[$dado['Militar']['id']][]= $dado[0]['data'];
				}else{
					if($dado['Turno']['rotulo']=='VERMELHA'){
						$diasv[$dado['Militar']['id']][]= $dado[0]['data'];
					}else{
						if($dado['Turno']['rotulo']=='SOMBRA'){
							$diass[$dado['Militar']['id']][]= $dado[0]['data'];
							
						}else{
							if(date('N',strtotime($dado[0]['data']))>=6){
								$diasv[$dado['Militar']['id']][]= $dado[0]['data'];
							}
							if(date('N',strtotime($dado[0]['data']))<6){
								$diasp[$dado['Militar']['id']][]= $dado[0]['data'];
							}
						}
					}
				}
			}
			$consulta='<table><tr><td><table><tr><td style=\'background-color:black;color:white;\' colspan=\'2\'>PRETA</td></tr>';
			foreach($legendas as $sequencia){

				$consulta .= '<tr  style=\'background-color:white;\'><td><b>'.$sequencia['MilitarsEscala']['legenda_cumprida'].'</b></td><td>';
				foreach($diasp[$sequencia['Militar']['id']] as $chave=>$valor){
					$consulta .= $valor.',';
				}
				$consulta=substr($consulta,0,-1);
				$consulta.="</td></tr>";
			}
			/*
			 foreach($diasp as $militarid=>$vetor){
				$consulta .= '<tr><td>'.$legenda[$militarid].'</td><td>';
				foreach($vetor as $chave=>$valor){
				$consulta .= $valor.',';
				}
				$consulta=substr($consulta,0,-1);
				$consulta.="</td></tr>";
				}*/
			$consulta.="</table></td><td>";
			$consulta.='<table><tr><td style=\'background-color:red;color:white;\' colspan=\'2\'>VERMELHA</td></tr>';
			foreach($legendas as $sequencia){

				$consulta .= '<tr><td><b>'.$sequencia['MilitarsEscala']['legenda_cumprida'].'</b></td><td>';
				foreach($diasv[$sequencia['Militar']['id']] as $chave=>$valor){
					$consulta .= $valor.',';
				}
				$consulta=substr($consulta,0,-1);
				$consulta.="</td></tr>";
			}
			/*
			 foreach($diasv as $militarid=>$vetor){
				$consulta .= '<tr><td>'.$legenda[$militarid].'</td><td>';
				foreach($vetor as $chave=>$valor){
				$consulta .= $valor.',';
				}
				$consulta=substr($consulta,0,-1);
				$consulta.="</td></tr>";
				}*/

			$consulta.="</table></td></tr></table>";
			//$consulta = print_r($consulta,true);
			//	exit();
		}
		header('Content-type: application/x-json');
		//echo $consulta;
		//
		//echo '{ "ok":"1", "mensagem":"'.rawurlencode((str_replace("\n"," ",($consulta)))).'"}';
		echo '{ "ok":"1", "mensagem":"'.rawurlencode($consulta).'"}';
		exit();

	}
	function externochefes() {
		$this->layout = 'ajax';
                $ok=0;
                $mensagem='';

		if(!empty($this->data['Escala']['nome_chefe'])) {
			$consultasql = "
                        update escalas, escalasmonths set escalas.nm_comandante='{$this->data['Escala']['nome_chefe']}', escalasmonths.nm_comandantep='{$this->data['Escala']['nome_chefe']}'
                        where escalas.tipo='{$this->data['Escala']['tipo_escala']}' and (escalasmonths.ok_chefeorgaop is null or escalasmonths.ok_chefeorgaop is null) and escalas.id=escalasmonths.escala_id
                        ";
			$consulta = $this->Escala->query($consultasql);
                        $mensagem=$consultasql;

                        $consultasql = "
                        update escalas, escalasmonths set escalas.nm_comandante='{$this->data['Escala']['nome_chefe']}', escalasmonths.nm_comandantec='{$this->data['Escala']['nome_chefe']}'
                        where escalas.tipo='{$this->data['Escala']['tipo_escala']}' and (escalasmonths.ok_chefeorgaoc is null or escalasmonths.ok_chefeorgaoc is null) and escalas.id=escalasmonths.escala_id
                        ";
			$consulta = $this->Escala->query($consultasql);
                        $mensagem.='->'.$consultasql;

                        $ok=1;
			//echo $consultasql.'<br>';
				
		}
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes('').'" }';



		exit();
	}
        
	function externoobtemlicencasximenes(){
                $cpf = '02566472750';
                $url = "http://servicos.decea.gov.br/lpna/api/?api=escala&id={$cpf}&apiKey=f75d1c10-7904-11e1-b0c4-0800200c9a66";
            
		$this->layout = 'admin';

                $consultacpf = "
                select cpf
                FROM militars as Militar inner join especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id and Especialidade.nm_especialidade='BCT')
                ";

                $cpfs = $this->Escala->query($consultacpf);

                $this->set(compact('cpfs','url'));
//		header('Content-type: application/x-json');
//		+echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes('').'" }';



//		exit();

	}
	function externoenviarelacao90dias($url){
		$this->layout = 'ajax';
               
		header('Content-type: application/x-json');                
                echo $url;


		exit();

	}
	function externoconsultanomes(){
		$nome = $this->params['form']['nome'];
		//Configure::write(array('debug'=> 2));
		$this->layout = null;
		if(!empty($nome)){
			$sql = "select * from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			where Militar.nm_completo like '%$nome%' and Militar.ativa>0 order by Militar.nm_completo asc
			";
			$resultados = $this->Escala->query($sql);
			foreach($resultados as $dado){
				$nomes[$dado['Militar']['id']] = str_pad($dado['Militar']['nm_completo'],40,'_').$dado['Militar']['nm_guerra'].' '.$dado['Posto']['sigla_posto'].' '.$dado['Especialidade']['nm_especialidade'];

			}
			//print_r($nomes);
			$this->set(compact('nomes'));
		}
	}
	function externoconsultanomesexiste(){
		$escala = $this->data['Escala']['escala'];
		$militar = $this->data['Escala']['militar'];
                $mensagem = '';
                $legenda = '';
		$this->layout = null;
		if(!empty($escala)&&!empty($militar)){
			$sql = "select * from militars_escalas MilitarEscala inner join escalasmonths Escalasmonth on ( Escalasmonth.id='$escala' and Escalasmonth.escala_id=MilitarEscala.escala_id )	where militar_id='$militar' ";

			$resultados = $this->Escala->query($sql);

			if(!empty($resultados[0]['MilitarEscala']['militar_id'])){
                            $mensagem = 'Militar já possui a legenda:'.$resultados[0]['MilitarEscala']['legenda_prevista'];
                        }else{
                            $ultimalegenda = "select * from militars_escalas MilitarEscala inner join escalasmonths Escalasmonth on ( Escalasmonth.id='$escala' and Escalasmonth.escala_id=MilitarEscala.escala_id )	order by length(MilitarEscala.legenda_prevista) desc, MilitarEscala.legenda_prevista desc ";
                            $legendas = $this->Escala->query($ultimalegenda);
                            $legenda = $legendas[0]['MilitarEscala']['legenda_prevista'];
                            }
		}else{
                    $mensagem = 'Falta informar a escala e o nome de um militar que existe!';
                }
		header('Content-type: application/x-json');                
		echo '{ "ok":"1", "mensagem":"'.$mensagem.'", "legenda":"'.$legenda.'"}';
		exit();                
	}        
	function externoatualizamilitarescala() {
		$this->layout = 'ajax';
                $ok=0;
                $mensagem='';
		$dados=$this->params['form'];
                

			$consultasql = "
                        update militars_escalas set legenda_prevista = '{$dados['legendap']}', legenda_cumprida = '{$dados['legendac']}', prevista={$dados['ativalegendap']} , cumprida= {$dados['ativalegendac']} where id='{$dados['militarescala']}'
                        ";
                        
			$consulta = $this->Escala->query($consultasql);
                           if($consulta){
                              $ok =1;
                           }
                        

		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'" }';



		exit();
	}	
	function externoreserva() {
		$this->layout = 'ajax';
                $ok=0;
                $mensagem='';
		$dados=$this->params['form'];
			$consultasql = "
                        update versoescalas set reservas = '{$dados['reserva']}' where escalasmonth_id='{$dados['escalasmonth']}'
                        ";
                        
			$consulta = $this->Escala->query($consultasql);
                           if($consulta){
                              $ok =1;
                           }
                        

		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'" }';
		exit();
	}           

}
?>
