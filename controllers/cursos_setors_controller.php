<?php
class CursosSetorsController extends AppController {

	var $name = 'CursosSetors';
	var $helpers = array('Html', 'Form');

	function index() {


		
		$sql = "select Curso.id, Curso.codigo from cursos Curso order by Curso.codigo asc ";
		$rotulos = $this->CursosSetor->query($sql);
		
		$vetor[0] = '';
		$vetor[1] = 'TODOS';
		foreach($rotulos as $linha){
			$vetor[$linha['Curso']['id']] = $linha['Curso']['codigo'];
		}
		$cursos = $vetor;
		
		$sql = "select Unidade.sigla_unidade, Setor.id, Setor.sigla_setor from setors Setor
		inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
		order by Unidade.sigla_unidade asc, Setor.sigla_setor asc
		";
		$rotulos = $this->CursosSetor->query($sql);
		
		
		$vetor2[0] = '';
		$vetor2[1] = 'TODOS';
		foreach($rotulos as $linha){
			$vetor2[$linha['Setor']['id']] = $linha['Unidade']['sigla_unidade'].' - '.$linha['Setor']['sigla_setor'];
		}
		$setors = $vetor2;
		
		$this->set(compact('cursos', 'setors'));



	}


	function add() {
		if (!empty($this->data)) {
			$this->CursosSetor->create();
			if ($this->CursosSetor->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  CursosSetor foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de CursosSetor não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$cursos = $this->CursosSetor->Curso->find('list');
		$sql = "select concat(Unidade.sigla_unidade,'-',Localidade.sigla_localidade,'-',Setor.sigla_setor) setor, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
		order by Unidade.sigla_unidade, Localidade.sigla_localidade, Setor.sigla_setor asc";
		//echo $sql.'<br>';
		$setors = $this->CursosSetor->query($sql);
		$totalescala=count($setors)-1;
		$escalastring = '';

		$vetor3[0]=0;
		$vetor4[0]=' ';

		for($c=0;$c<$totalescala;$c++){
			$escalastring.=$setors[$c]['Setor']['id'].',';
			$vetor3[]=$setors[$c]['Setor']['id'];
			$vetor4[]=$setors[$c][0]['setor'];
		}
		$escalastring.=$setors[$c]['Setor']['id'];
		$vetor3[]=$setors[$c]['Setor']['id'];
		$vetor4[]=$setors[$c][0]['setor'];
			
		$setors = array_combine($vetor3,$vetor4);

		//$setors = $this->CursosSetor->Setor->find('list');
		$this->set(compact('cursos', 'setors'));
	}

	function edit($especialidades_setors_id = null, $cursos_rotulos_id = null, $valor_previsto = null, $linha = null, $coluna = null) {
		$ok = 0;
		$retorno = '"erro":"1"';

		if ((!empty($especialidades_setors_id))&&(!empty($cursos_rotulos_id))&&(($valor_previsto>=0))&&(!empty($linha))&&(!empty($coluna))) {

			$consulta = 'select * from cursos_setors CursosSetor where  CursosSetor.cursos_rotulo_id='.$cursos_rotulos_id.' and CursosSetor.especialidades_setor_id='.$especialidades_setors_id;
			$existe = $this->CursosSetor->query($consulta);

			if(!empty($existe)){
				$vetor['CursosSetor']['id'] = $existe[0]['CursosSetor']['id'];
				$vetor['CursosSetor']['previsto'] = $valor_previsto;
				$vetor['CursosSetor']['saldo'] = $existe[0]['CursosSetor']['existente'] - $valor_previsto;
				//print_r($vetor);

				if($this->CursosSetor->save($vetor)){
					$ok = 1;
					$retorno = '"saldo":"'.$vetor['CursosSetor']['saldo'].'", "linha":"'.$linha.'", "coluna":"'.$coluna.'"';
				}

			}




		}

		header('Content-type: application/x-json');

		echo '{ "ok":"'.$ok.'", '.$retorno.' }';

		exit();


	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para CursosSetor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CursosSetor->delete($id)) {
			$this->Session->setFlash(__('CursosSetor excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	function verso($curso_id = null, $setor_id = null) {
		$mensagem="";
		$ok='0';
		if ($curso_id>=0) {
			//	if (1) {
			$ok='1';

			$destaque = ' style="background-color:#000000;color:#ffffff;font-size:11 px;font-weight:bold;border-color:#ffffff;" ';
			$destaque2 = ' style="background-color:#e0e0e0;color:#000000;font-size:11 px;" ';
			$negativo = ' style="background-color:#e08080;color:#808080;font-size:11 px;" ';
			

			$mensagem = "<table id=\"tituloplanejamento\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"border:1px #0000;background-color:#0000;\">";

					if($curso_id<=1){
						$sql01 = "";
					}else{
						$sql01 = " and Curso.id={$curso_id}";
					}
					
					if($setor_id<=1){
						$sql02 = "";
					}else{
						$sql02 = " and Setor.id={$setor_id}";
					}
					
			$sql = "select Localidade.sigla_localidade, Unidade.sigla_unidade, Setor.sigla_setor, Especialidade.nm_especialidade, Curso.codigo, EspecialidadesSetor.necessario,
			Setor.id, Especialidade.id, Curso.id 
			from especialidades_setors EspecialidadesSetor
			INNER JOIN cursos Curso on (Curso.id=EspecialidadesSetor.curso_id $sql01)
			INNER JOIN setors Setor on (Setor.id=EspecialidadesSetor.setor_id $sql02)
			INNER JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
			INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
			INNER JOIN especialidades Especialidade on (Especialidade.id=EspecialidadesSetor.especialidade_id)
			order by Localidade.sigla_localidade asc, Unidade.sigla_unidade asc, Setor.sigla_setor asc, Especialidade.nm_especialidade asc, Curso.codigo asc";
			
			//echo $sql;
			
			$cursos_rotulos = $this->CursosSetor->query($sql);
			
			$temp = $cursos_rotulos[0]['Setor']['id'].'-'.$cursos_rotulos[0]['Especialidade']['id'];
			$conta = 0;
			$colunas = 1;
			$max = 0;
			$todos = 0;
			
			foreach($cursos_rotulos as $dados){
				$atual = $dados['Setor']['id'].'-'.$dados['Especialidade']['id'];
				if($temp==$atual){
					$primeira_linha = $conta+1;
					
					
					$todos = "select count(*) total from militars_cursos MilitarsCurso
					inner join militars Militar on (MilitarsCurso.militar_id=Militar.id)
					inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id={$dados['Curso']['id']})
					";
					
					$possuiCurso = $this->CursosSetor->query($todos);
					unset($contaPossuiCurso);
					$contaPossuiCurso = 0;
					$contaPossuiCurso = $possuiCurso[0][0]['total'];
					
					
					$existentes = "select count(*) total from militars_cursos MilitarsCurso
					inner join militars Militar on (Militar.especialidade_id={$dados['Especialidade']['id']} and Militar.setor_id={$dados['Setor']['id']} and MilitarsCurso.militar_id=Militar.id)
					inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id={$dados['Curso']['id']})
					";
//					echo $existentes.'<br>';
					unset($contagem);
					
					$contagem = $this->CursosSetor->query($existentes);
					
					$contagem[0][0]['total'] += 0;
					//print_r($contagem);
					$saldo = $contagem[0][0]['total'] - $dados['EspecialidadesSetor']['necessario'];
					
					$vetor[$conta][0] = 'UNIDADE - SETOR - ESPECIALIDADE';
					$vetor[$conta][$colunas] = $dados['Curso']['codigo'];
					
					$vetor[$primeira_linha][0] = $dados['Localidade']['sigla_localidade'].' - '.$dados['Unidade']['sigla_unidade'].' - '.$dados['Setor']['sigla_setor'].' - '.$dados['Especialidade']['nm_especialidade'];
					
					if($saldo<0){
					//	$vetor[$primeira_linha][$colunas] = "<p style='background-color:#ff8080;color:#ffffff;font-size:6 px;'>P={$dados['EspecialidadesSetor']['necessario']}<br>E={$contagem[0][0]['total']}<br>S={$saldo}<br>T={$contaPossuiCurso}</p>";
						//$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br>E={$contagem[0][0]['total']}<br>S={$saldo}<br>T={$contaPossuiCurso}";
						$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/{$dados['Setor']['id']}/{$dados['Especialidade']['id']}/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >E={$contagem[0][0]['total']}</a><br>S={$saldo}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/0/0/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >T={$contaPossuiCurso}</a>";
						$auxiliar[$primeira_linha][$colunas] = 1;
											}else{
						//$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br>E={$contagem[0][0]['total']}<br>S={$saldo}<br>T={$contaPossuiCurso}";
						$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/{$dados['Setor']['id']}/{$dados['Especialidade']['id']}/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >E={$contagem[0][0]['total']}</a><br>S={$saldo}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/0/0/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >T={$contaPossuiCurso}</a>";
					}
					
					$colunas++;
					if($colunas>$max){
						$max = $colunas;
					}
					
				}else{
					$colunas = 1;
					$temp = $dados['Setor']['id'].'-'.$dados['Especialidade']['id'];
					$conta = $primeira_linha+1;
					$primeira_linha = $conta + 1;
					$todos = "select count(*) total from militars_cursos MilitarsCurso
					inner join militars Militar on (MilitarsCurso.militar_id=Militar.id)
					inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id={$dados['Curso']['id']})
										";
					
					$possuiCurso = $this->CursosSetor->query($todos);
					unset($contaPossuiCurso);
					$contaPossuiCurso = 0;
					
					$contaPossuiCurso = $possuiCurso[0][0]['total'];
					
					$existentes = "select count(*) total from militars_cursos MilitarsCurso
					inner join militars Militar on (Militar.especialidade_id={$dados['Especialidade']['id']} and Militar.setor_id={$dados['Setor']['id']} and MilitarsCurso.militar_id=Militar.id)
					inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id={$dados['Curso']['id']})
					";
															
					unset($contagem);
										
					$contagem = $this->CursosSetor->query($existentes);
					
					$contagem[0][0]['total'] += 0;
					//print_r($contagem);
					$saldo = $contagem[0][0]['total'] - $dados['EspecialidadesSetor']['necessario'];
					
					$vetor[$conta][0] = 'UNIDADE - SETOR - ESPECIALIDADE';
					$vetor[$conta][$colunas] = $dados['Curso']['codigo'];
					
					$vetor[$primeira_linha][0] = $dados['Localidade']['sigla_localidade'].' - '.$dados['Unidade']['sigla_unidade'].' - '.$dados['Setor']['sigla_setor'].' - '.$dados['Especialidade']['nm_especialidade'];
					
					if($saldo<0){
					//	$vetor[$primeira_linha][$colunas] = "<p style='background-color:#ff8080;color:#ffffff;font-size:6 px;'>P={$dados['EspecialidadesSetor']['necessario']}<br>E={$contagem[0][0]['total']}<br>S={$saldo}<br>T={$contaPossuiCurso}</p>";
						//$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br>E={$contagem[0][0]['total']}<br>S={$saldo}<br>T={$contaPossuiCurso}";
						$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/{$dados['Setor']['id']}/{$dados['Especialidade']['id']}/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >E={$contagem[0][0]['total']}</a><br>S={$saldo}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/0/0/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >T={$contaPossuiCurso}</a>";
						$auxiliar[$primeira_linha][$colunas] = 1;
											}else{
						//$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br>E={$contagem[0][0]['total']}<br>S={$saldo}<br>T={$contaPossuiCurso}";
						$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/{$dados['Setor']['id']}/{$dados['Especialidade']['id']}/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >E={$contagem[0][0]['total']}</a><br>S={$saldo}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/0/0/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >T={$contaPossuiCurso}</a>";
											}
										
					$colunas++;
					if($colunas>$max){
						$max = $colunas;
					}
					
				}
				
			}
			$id = 0;
			//$contaespacos = 3;
			
			$tabela = '<table cellspacing="0" cellpadding="0" border="1" style="" id="tituloplanejamento">';
			$colunas = 0;
			$total = count($vetor);
			for($inicio=0;$inicio<$total;$inicio++){
				if($vetor[$inicio][0]=='UNIDADE - SETOR - ESPECIALIDADE'){
					$tabela .= "<tr><th><pre>UNIDADE - SETOR - ESPECIALIDADE</pre></th>";
					$colunas = count($vetor[$inicio]);
					for($x=1;$x<=$max;$x++){
						if($x<=$colunas){
							$tabela.="<th $destaque>{$vetor[$inicio][$x]}</th>";
							
						}else{
							$tabela.="<th $destaque> </th>";
						}
					}
					$tabela.="</tr>";
				}else{
					$tabela .= "<tr><td $destaque2><pre>{$vetor[$inicio][0]}</pre></td>";
					$colunas = count($vetor[$inicio]);
					for($x=1;$x<=$max;$x++){
						if($x<=$colunas){
							if($auxiliar[$inicio][$x]==1){
							$tabela.="<td style='background-color:#ff8080;color:#ffffff;'>{$vetor[$inicio][$x]}</td>";
							}else{
							$tabela.="<td >{$vetor[$inicio][$x]}</td>";
							}
							//$tabela.="<td>{$vetor[$inicio][$x]}</td>";
						}else{
							$tabela.="<td> </td>";
						}
					}
					$tabela.="</tr>";
					
					
				}
				
				
			}
		$tabela .= "</table>";
			//echo $tabela;

$mensagem = $tabela;

			//$mensagem .= "	<tr {$class}><th {$class}>{$especialidadesSetor['Unidade']['sigla_unidade']}</th><th {$class}>{$especialidadesSetor['Setor']['sigla_setor']}</th><th {$class}>{$especialidadesSetor['Quadro']['sigla_quadro']} - {$especialidadesSetor['Especialidade']['nm_especialidade']}<input type=\"hidden\" value=\"{$especialidadesSetor['EspecialidadesSetor']['id']}\" id=\"especialidadesetor{$linha}\" name=\"data[EspecialidadesSetors][id][]\"/></th>";
			if($linha % 6 == 0){
				//$mensagem .= $titulo."<tr><th><pre>{$especialidadesSetor['Unidade']['sigla_unidade']}</pre></th><th><pre>{$especialidadesSetor['Setor']['sigla_setor']}</pre></th><th><pre>{$especialidadesSetor['Quadro']['sigla_quadro']}-{$especialidadesSetor['Especialidade']['nm_especialidade']}<input type=\"hidden\" value=\"{$especialidadesSetor['EspecialidadesSetor']['id']}\" id=\"especialidadessetors{$linha}\" name=\"data[EspecialidadesSetors][id][{$linha}]\"/></pre></th>";
			}else{
				//$mensagem .= "<tr><th><pre>{$especialidadesSetor['Unidade']['sigla_unidade']}</pre></th><th><pre>{$especialidadesSetor['Setor']['sigla_setor']}</pre></th><th><pre>{$especialidadesSetor['Quadro']['sigla_quadro']}-{$especialidadesSetor['Especialidade']['nm_especialidade']}<input type=\"hidden\" value=\"{$especialidadesSetor['EspecialidadesSetor']['id']}\" id=\"especialidadessetors{$linha}\" name=\"data[EspecialidadesSetors][id][{$linha}]\"/></pre></th>";
			}
			//	for($k=1;$k<=$id;$k++){
			$coluna = 0;

			if($x<0){
				$class = ' style="background-color:#f08080;" ';
			}else{
				$class = $class2;
			}

//			$mensagem .= "<td {$class}>P:<input type=\"text\" value=\"{$vetor['CursosSetor']['previsto']}\" onchange=\"atualizaRegistros('previsto{$linha}c{$coluna}');\" size=\"1\" id=\"previsto{$linha}c{$coluna}\" name=\"data[previsto][{$linha}][{$coluna}]\"/><br>E:<input type=\"text\" size=\"1\" readonly=\"readonly\"  value=\"{$existentes[0][0]['existente']}\" id=\"existente{$linha}c{$coluna}\" name=\"data[existente][{$linha}][{$coluna}]\"/><br>S:<input type=\"text\" readonly=\"readonly\"  value=\"{$vetor['CursosSetor']['saldo']}\" size=\"1\"  id=\"saldo{$linha}c{$coluna}\" name=\"data[saldo][{$linha}][{$coluna}]\"/></td>";
			


		}

		header('Content-type: application/x-json');

		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();

	}

	function view() {
		$this->layout = 'ajax';
		$mensagem="";
		$acertos = 0;
		$erros = 0;
		$ok='0';
		if (!empty($this->data)) {
			$coluna = $this->data['colunas'];
			$linha =  $this->data['linhas'];
			for($l=1;$l<=$linha;$l++){
				for($c=1;$c<=$coluna;$c++){
					//inner join cursos Curso on (MilitarsCurso.curso_id=Curso.id)

					$vetor['CursosSetor']['cursos_rotulo_id'] = $this->data['CursosRotulos']['id'][$c];
					$vetor['CursosSetor']['especialidades_setor_id'] = $this->data['EspecialidadesSetors']['id'][$l];
					$consulta = 'select count(*) existente from militars Militar
inner join cursos_rotulos CursosRotulo on (CursosRotulo.id='.$this->data['CursosRotulos']['id'][$c].')
inner join especialidades_setors EspecialidadesSetor on (EspecialidadesSetor.especialidade_id=Militar.especialidade_id and EspecialidadesSetor.id='.$this->data['EspecialidadesSetors']['id'][$l].')
inner join militars_cursos MilitarsCurso on (MilitarsCurso.militar_id=Militar.id and Militar.setor_id=EspecialidadesSetor.setor_id and MilitarsCurso.curso_id=CursosRotulo.curso_id)
group by Militar.setor_id, Militar.especialidade_id, CursosRotulo.curso_id
';
					$existentes = $this->CursosSetor->query($consulta);
					//print_r($existentes);
					if(empty($existentes[0][0]['existente'])){
						$existentes[0][0]['existente'] = 0;
					}

					echo $consulta;

					$vetor['CursosSetor']['previsto'] = $this->data['previsto'][$l][$c];
					$vetor['CursosSetor']['existente'] = $existentes[0][0]['existente'];
					$vetor['CursosSetor']['saldo'] = $this->data['saldo'][$l][$c];
					$this->CursosSetor->create();
					if($this->CursosSetor->save($vetor)){
						$acertos++;
					}else{
						$erros++;
					}
					unset($vetor['CursosSetor']);

				}
			}
			$ok = 1;
			$mensagem = 'Teste OK. Erros:'.$erros.' Acertos:'.$acertos;
		}

		//$this->set('cursosSetor', $this->CursosSetor->read(null, $id));
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';
		exit();
	}

	function indexExcel($consulta = null)
	{

		$this->layout = 'openoffice' ;
		$this->CursosSetor->recursive = 1;
		$filtro = "";

		$coluna = "
		select CursosRotulo.id, CursosRotulo.curso_id, Curso.codigo, Curso.id  from cursos_setors CursosSetor
inner join cursos_rotulos CursosRotulo on (CursosRotulo.id=CursosSetor.cursos_rotulo_id) 
inner join cursos Curso on (Curso.id=CursosRotulo.curso_id)
group by CursosRotulo.curso_id 
order by Curso.codigo asc
		";


		$colunas = $this->CursosSetor->query($coluna);

		$linhas = "
select Unidade.sigla_unidade, Setor.id, Setor.sigla_setor, Especialidade.id, Especialidade.nm_especialidade from especialidades_setors EspecialidadesSetor 
inner join especialidades Especialidade on (Especialidade.id=EspecialidadesSetor.especialidade_id)
inner join setors Setor on (Setor.id=EspecialidadesSetor.setor_id)
inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
group by Especialidade.nm_especialidade, Setor.sigla_setor
order by Especialidade.nm_especialidade asc, Setor.sigla_setor asc		
		";

		$linhas = $this->CursosSetor->query($linhas);

		// Intercessão entre cursos e especialidades_setors já somados os rótulos
		$celulaP[0][0][0] = 0;
		$celulaE[0][0][0] = 0;
		$celulaS[0][0][0] = 0;
		// Soma total dos campos por curso
		$somaP[0] = 0;
		$somaE[0] = 0;
		$somaS[0] = 0;
		
		$limite = 0;


		foreach($colunas as $curso){
				
			foreach($linhas as $especialidadesetor){
				
				
				$microchamada = "select CursosSetor.previsto
				from especialidades_setors EspecialidadesSetor 
				right join cursos_setors CursosSetor on (
				 CursosSetor.especialidades_setor_id=EspecialidadesSetor.id
				 AND CursosSetor.cursos_rotulo_id={$curso['CursosRotulo']['id']} 
				)
				WHERE 
				 EspecialidadesSetor.especialidade_id={$especialidadesetor['Especialidade']['id']} 
				AND EspecialidadesSetor.setor_id in (select setorassociado from setoresassociados where setor_id={$especialidadesetor['Setor']['id']})
				
				";
				
				$microchamada = "select CursosSetor.previsto
				from especialidades_setors EspecialidadesSetor 
				inner join cursos_setors CursosSetor on (
				 CursosSetor.especialidades_setor_id=EspecialidadesSetor.id
				)
				inner join cursos_rotulos CursosRotulo  on (CursosRotulo.id=CursosSetor.cursos_rotulo_id AND CursosRotulo.curso_id={$curso['Curso']['id']})
				WHERE 
				 EspecialidadesSetor.especialidade_id={$especialidadesetor['Especialidade']['id']} 
				AND EspecialidadesSetor.setor_id in (select setorassociado from setoresassociados where setor_id={$especialidadesetor['Setor']['id']})
				
				";
				
				$limite++;
				//echo $microchamada;
				//exit();
				
					
				$micro = $this->CursosSetor->query($microchamada);
				$previsto = 0;
				foreach($micro as $previstos){
					$previsto = $previstos['CursosSetor']['previsto'];
				}
				
				/*
				echo "<pre>";
				print_r($micro);
				echo "</pre>";
				if($limite>25){
				exit();
				}
*/

				$celulaP[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']] = 0;
				$celulaE[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']] = 0;
				$celulaS[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']] = 0;

				//foreach($micro as $cel){
					
				$conta_cursos_especialidade_setor = "select count(*) existente
				from militars_cursos MilitarsCurso
				inner join militars Militar on (Militar.id=MilitarsCurso.militar_id AND Militar.especialidade_id={$especialidadesetor['Especialidade']['id']} 
				AND Militar.setor_id in (select setorassociado from setoresassociados where setor_id={$especialidadesetor['Setor']['id']}) )
				inner join cursos Curso  on (Curso.id=MilitarsCurso.curso_id AND   Curso.id={$curso['Curso']['id']})
				"; 
				
				if(empty($existente[0][0]['existente'])){
					$existente[0][0]['existente'] = 0;
				}

				//				inner join militars Militar on (Militar.id=MilitarsCurso.militar_id AND Militar.setor_id={$especialidadesetor['Setor']['id']} AND Militar.especialidade_id={$especialidadesetor['Especialidade']['id']} )

				//echo $conta_cursos_especialidade_setor.'<br>';
				
				$existente = $this->CursosSetor->query($conta_cursos_especialidade_setor);
				
				

				
					//echo 'curso_id='.$curso['CursosRotulo']['curso_id'].' especialidade_id='.$especialidadesetor['Especialidade']['id'].' setor_id'.$especialidadesetor['Setor']['id'];			
					$celulaP[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']] += $previsto;
					$celulaE[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']] += $existente[0][0]['existente'];//$cel['CursosSetor']['existente'];
					$celulaS[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']] += $existente[0][0]['existente'] - $previsto;
				//}
				
				//echo "<br>";

				$somaP[$curso['Curso']['id']] += $celulaP[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']];
				$somaE[$curso['Curso']['id']] += $celulaE[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']];
				$somaS[$curso['Curso']['id']] += $celulaE[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']] - $celulaP[$curso['Curso']['id']][$especialidadesetor['Especialidade']['id']][$especialidadesetor['Setor']['id']];



			}
				
				
		}


		$titulo = 'Dados de Inspecao';
		$tabela = 'Inspecao';
		$nome = 'planilha_cursos';

		$this->set(compact('linhas','colunas','celulaP','celulaE','celulaS','somaP','somaE','somaS', 'nome'));
		
		
		/*
		echo '<pre>';
		print_r($celulaS);
		echo '</pre>';
		
		exit();
		*/
		//exit(1);
		
		$this->render();
	}




}
?>