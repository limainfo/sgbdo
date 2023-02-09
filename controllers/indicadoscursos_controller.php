<?php
class IndicadoscursosController extends AppController {

	var $name = 'Indicadoscursos';
	var $helpers = array('Html', 'Form');

	function ajax($id = null, $cursoid = null, $militarid = null) {
		$this->layout = 'admin';
		$ok = 0;
		$this->Indicadoscurso->recursive = 1;
		//unset($id);
		if(!empty($id)){
			$vetor['Indicadoscurso']['id'] = $id;
			$vetor['Indicadoscurso']['status'] = 'C';
			if($this->Indicadoscurso->save($vetor['Indicadoscurso'])){
				$ok = 1;
				$dados = $this->Indicadoscurso->findById($id);

				$inicio = explode('-',$dados['Cursoativo']['data_inicio']);

				$termino = explode('-',$dados['Cursoativo']['data_termino']);

				$dt_inicio = $inicio[2].'-'.$inicio[1].'-'.$inicio[0];
				$dt_termino = $termino[2].'-'.$termino[1].'-'.$termino[0];




				$insere = "insert into militars_cursos(id, militar_id, curso_id, dt_inicio_curso, dt_fim_curso, documento, local_realizacao, periodo) values (uuid(), $militarid, $cursoid, '{$dt_inicio}','{$dt_termino}', '{$dados['Cursoativo']['documento_ativacao']}', '{$dados['Cursoativo']['local_realizacao']}', '{$dados['Cursoativo']['data_inicio']} a {$dados['Cursoativo']['data_termino']}')";
				//echo $insere;

				$this->Indicadoscurso->query($insere);

				//$consulta = 'insert into militars_cursos(militar_id, curso_id)';
			}

		}
		//		print_r($this->data);
		$opcao = $this->data['opcao'];

		if(empty($opcao)){
			$complemento = null;
		}
		if($opcao=='INDICADOS'){
			$complemento = array('Indicadoscurso.status'=>'I');
		}
		if($opcao=='CURSANDO'){
			$complemento = array('Indicadoscurso.status'=>'C');
		}

		if($opcao=='CONCLUÍDO'){
			$complemento = array('Indicadoscurso.status'=>'F');
		}


		$this->Indicadoscurso->order = array('Cursoativo.data_inicio'=>'asc');
		$indicadoscursos = $this->Indicadoscurso->findAll($complemento);
		//,'ok'
		$this->set(compact('indicadoscursos', 'opcao'));
	}


	function add(){
		$this->Indicadoscurso->Cursoativo->Curso->recursive = 0;
		/*
		 $temp = $this->Indicadoscurso->Cursoativo->find('all');
		 foreach($temp as $chave=>$valor){
			$cursoativos[$valor['Cursoativo']['id']] = $valor['Curso']['codigo'].'/'.$valor['Cursoativo']['turma'].'/'.$valor['Cursoativo']['data_inicio'].'/'.$valor['Cursoativo']['data_termino'];
			}
			*/


		$sql = "select Unidade.id, Unidade.sigla_unidade from unidades Unidade order by Unidade.sigla_unidade asc";
		$unidade = $this->Indicadoscurso->query($sql);
		$unidades[0] = 'Selecione a Unidade';
		$setors[0] = 'Selecione a Unidade';
		$especialidades[0] = 'Selecione o Setor';
		$cursoativos[0] = 'Selecione o Curso';
		$cursos[0] = 'Selecione a Especialidade';
		$militars[0] = 'Selecione uma Turma';
		foreach($unidade as $linha){
			$unidades[$linha['Unidade']['id']] = $linha['Unidade']['sigla_unidade'];
		}

		$this->set(compact('cursoativos', 'militars','mensagem','unidades','setors','especialidades','cursos'));
			
	}

	function index() {
		$this->redirect(array('action'=>'add'));

		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
		if ( $findUrl != '' ) {
			$this->Indicadoscurso->recursive = 0;
			$this->set('indicadoscursos', $this->paginate());
		} else {
			$this->Indicadoscurso->recursive = 0;
			$this->set('indicadoscursos', $this->paginate());
		}

	}

	function view($setor_id = null, $curso_id = null) {
		$this->layout = 'ajax';

		
		
		$destaque = ' style="background-color:#000000;color:#ffffff;font-size:11 px;font-weight:bold;border-color:#ffffff;" ';
		$destaque2 = ' style="background-color:#e0e0e0;color:#000000;font-size:11 px;" ';
		$negativo = ' style="background-color:#e08080;color:#808080;font-size:11 px;" ';
			

		$mensagem = "<table id=\"tituloplanejamento\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"border:1px #0000;background-color:#0000;\">";

		if($curso_id==0){
			$sql01 = "";
		}else{
			$sql01 = " and Curso.id={$curso_id}";
		}
			
		if($setor_id==0){
			$sql02 = "";
		}else{
			$sql02 = " and Setor.id={$setor_id}";
		}
			
		$sql = "select Cidade.nome, Unidade.sigla_unidade, Setor.sigla_setor, Especialidade.nm_especialidade, Curso.codigo, EspecialidadesSetor.necessario,
		Setor.id, Especialidade.id, Curso.id
		from especialidades_setors EspecialidadesSetor
		INNER JOIN cursos Curso on (Curso.id=EspecialidadesSetor.curso_id $sql01)
		INNER JOIN setors Setor on (Setor.id=EspecialidadesSetor.setor_id $sql02)
		INNER JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
		INNER JOIN especialidades Especialidade on (Especialidade.id=EspecialidadesSetor.especialidade_id)
		order by Cidade.nome asc, Unidade.sigla_unidade asc, Setor.sigla_setor asc, Especialidade.nm_especialidade asc, Curso.codigo asc";
			
		$cursos_rotulos = $this->Indicadoscurso->query($sql);
			
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
				inner join militars Militar on (MilitarsCurso.militar_id=Militar.id and Militar.ativa>0)
				inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id='{$dados['Curso']['id']}')
					";
					
				$possuiCurso = $this->Indicadoscurso->query($todos);
				unset($contaPossuiCurso);
				$contaPossuiCurso = 0;
				$contaPossuiCurso = $possuiCurso[0][0]['total'];
					
					
				$existentes = "select count(*) total from militars_cursos MilitarsCurso
				inner join militars Militar on (Militar.especialidade_id='{$dados['Especialidade']['id']}' and Militar.setor_id='{$dados['Setor']['id']}' and MilitarsCurso.militar_id=Militar.id and Militar.ativa>0)
				inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id='{$dados['Curso']['id']}')
					";
				unset($contagem);
					
				$contagem = $this->Indicadoscurso->query($existentes);
				$contagem[0][0]['total'] += 0;
				$saldo = $contagem[0][0]['total'] - $dados['EspecialidadesSetor']['necessario'];
					
				if($saldo<0){
					$vetor[$conta][0] = 'UNIDADE - SETOR - ESPECIALIDADE';
					$vetor[$conta][$colunas] = $dados['Curso']['codigo'];
					$caminho = $this->webroot;
					$vetor[$primeira_linha][0] = $dados['Cidade']['nome'].' - '.$dados['Unidade']['sigla_unidade'].' - '.$dados['Setor']['sigla_setor'].' - '.$dados['Especialidade']['nm_especialidade'];
					$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/{$dados['Setor']['id']}/{$dados['Especialidade']['id']}/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >E={$contagem[0][0]['total']}</a><br>S={$saldo}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/0/0/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >T={$contaPossuiCurso}</a>";
					$auxiliar[$primeira_linha][$colunas] = 1;
					$colunas++;
					if($colunas>$max){
						$max = $colunas;
					}
				}
					
					
			}else{
				$colunas = 1;
				$temp = $dados['Setor']['id'].'-'.$dados['Especialidade']['id'];
				$conta = $primeira_linha+1;
				$primeira_linha = $conta + 1;
				$todos = "select count(*) total from militars_cursos MilitarsCurso
				inner join militars Militar on (MilitarsCurso.militar_id=Militar.id and Militar.ativa>0)
				inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id={$dados['Curso']['id']})
										";
				$possuiCurso = $this->Indicadoscurso->query($todos);
				unset($contaPossuiCurso);
				$contaPossuiCurso = 0;
				$contaPossuiCurso = $possuiCurso[0][0]['total'];
					
				$existentes = "select count(*) total from militars_cursos MilitarsCurso
				inner join militars Militar on (Militar.especialidade_id={$dados['Especialidade']['id']} and Militar.setor_id={$dados['Setor']['id']} and MilitarsCurso.militar_id=Militar.id  and Militar.ativa>0)
				inner join cursos Curso on (Curso.id=MilitarsCurso.curso_id and MilitarsCurso.curso_id={$dados['Curso']['id']})
					";
					
				unset($contagem);

				$contagem = $this->Indicadoscurso->query($existentes);
				$contagem[0][0]['total'] += 0;
				$saldo = $contagem[0][0]['total'] - $dados['EspecialidadesSetor']['necessario'];
				if($saldo<0){
					$vetor[$conta][0] = 'UNIDADE - SETOR - ESPECIALIDADE';
					$vetor[$conta][$colunas] = $dados['Curso']['codigo'];
					$vetor[$primeira_linha][0] = $dados['Cidade']['nome'].' - '.$dados['Unidade']['sigla_unidade'].' - '.$dados['Setor']['sigla_setor'].' - '.$dados['Especialidade']['nm_especialidade'];
					$vetor[$primeira_linha][$colunas] = "P={$dados['EspecialidadesSetor']['necessario']}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/{$dados['Setor']['id']}/{$dados['Especialidade']['id']}/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >E={$contagem[0][0]['total']}</a><br>S={$saldo}<br><a onclick=\"var x=screen.height;var y=screen.width;window.open('{$caminho}cursos/view/{$dados['Curso']['id']}/0/0/p','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');\" href=\"#\" >T={$contaPossuiCurso}</a>";
					$auxiliar[$primeira_linha][$colunas] = 1;
					$colunas++;
					if($colunas>$max){
						$max = $colunas;
					}
				}
					
					
			}

		}
			
		$id = 0;
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
						if(!empty($auxiliar[$inicio][$x])){
							$tabela.="<td style='background-color:#ff8080;color:#ffffff;'>{$vetor[$inicio][$x]}</td>";
						}else{
							$tabela.="<td >{$vetor[$inicio][$x]}</td>";
						}
					}else{
						$tabela.="<td> </td>";
					}
				}
				$tabela.="</tr>";
			}
		}
		$tabela .= "</table>";
		$mensagem = $tabela;
		if($linha % 6 == 0){
		}else{
		}
		$coluna = 0;

		if($x<0){
			$class = ' style="background-color:#f08080;" ';
		}else{
			$class = $class2;
		}

		echo $mensagem;
		
		exit();
		

	}


	function edit($id = null) {
		$mensagem="";
		$ok='0';
		unset($this->militar);

		if(!empty($this->data)){
			if ($this->Indicadoscurso->save($this->data)) {
				$ok='1';
			}
		}


		if(!($id)){
			$options = array("Indicadoscurso.id"=>$id);
			$indicadoscurso= $this->Indicadoscurso->findAll($options);
			$this->data['Indicadoscurso']['cursoativo_id'] = $indicadoscurso[0]['Indicadoscurso']['cursoativo_id'];
		}
		//print_r($this->data);

		$this->Indicadoscurso->Cursoativo->recursive = 2;
		$options = array("Cursoativo.id"=>$this->data['Indicadoscurso']['cursoativo_id']);
		$cursos= $this->Indicadoscurso->Cursoativo->findAll($options);

		//print_r($cursos);

		$cursoId = $cursos[0]['Curso']['id'];
		$cursoNome = $cursos[0]['Curso']['codigo'];


		$this->Indicadoscurso->recursive = 1;
		$options = array("Cursoativo.curso_id"=>$cursoId);
		$indicados= $this->Indicadoscurso->findAll($options);

		$turmas = $this->Indicadoscurso->Cursoativo->findAll($options);

		$excluir = array();

		foreach ($turmas as $indicado){
			$excluir[$indicado['Cursoativo']['id']] = $indicado['Cursoativo']['turma'];
		}

		foreach ($excluir as $chave=>$valor){
			$opcoes .= "<option value=\"{$chave}\">{$valor}</option>";
		}

		$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Nome Completo</th><th>Saram</th><th>Identidade</th><th>Setor</th><th>Turma</th><th>Curso</th><th>Prioridade</th><th>Tipo</th><th>Ações</th></tr>";

		//print_r($indicados);

		$i = 0;
		foreach ($indicados as $indicado):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

		//rawurlencode
		$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$indicado['Posto']['sigla_posto'].' '.$indicado['Quadro']['sigla_quadro'].' '.$indicado['Especialidade']['nm_especialidade'].' '.$indicado['Militar']['nm_completo']." ?\" ,\"javascript:excluiRegistro(".$indicado['Indicadoscurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
		$acao .= "<img border=\"0\" onclick=\"seleciona('".rawurlencode($opcoes)."');exibe('".$indicado['Indicadoscurso']['id']."' ,'".rawurlencode($indicado['Posto']['sigla_posto'].' '.$indicado['Quadro']['sigla_quadro'].' '.$indicado['Especialidade']['nm_especialidade'].' '.$indicado['Militar']['nm_completo'])."' ,'".$indicado['Indicadoscurso']['militar_id']."' ,'".$indicado['Indicadoscurso']['prioridade']."', '".$indicado['Indicadoscurso']['status']."', '".$indicado['Cursoativo']['turma']."', '".$indicado['Indicadoscurso']['tipo']."');\" title=\"Editar\" alt=\"Editar\" src=\"".$this->webroot."img/lapis.gif\"/>";
		if($indicado['Indicadoscurso']['status']<>'I'){
			$acao = '';
		}
		$mensagem .= "	<tr {$class}><td>{$indicado['Posto']['sigla_posto']} {$indicado['Quadro']['sigla_quadro']} {$indicado['Especialidade']['nm_especialidade']} {$indicado['Militar']['nm_completo']}</td><td>{$indicado['Militar']['saram']}</td><td>{$indicado['Militar']['identidade']}</td><td>{$indicado['Setor']['sigla_setor']}</td><td>{$indicado['Cursoativo']['turma']}</td><td>{$cursoNome}</td><td>{$indicado['Indicadoscurso']['prioridade']}</td><td>{$indicado['Indicadoscurso']['tipo']}</td><td>{$acao}</td></tr>";

		endforeach;
		$mensagem.="</table>";


		header('Content-type: application/x-json');

		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();


	}

	function delete($id = null) {
		$mensagem="";
		$ok='0';
		if(!empty($id)){
			$options = array("Indicadoscurso.id"=>$id);
			$indicadoscurso= $this->Indicadoscurso->findAll($options);
			$this->data['Indicadoscurso']['cursoativo_id'] = $indicadoscurso[0]['Indicadoscurso']['cursoativo_id'];
		}

		if ($this->Indicadoscurso->delete($id)) {
			$ok='1';
		}

		$this->Indicadoscurso->Cursoativo->recursive = 2;
		$options = array("Cursoativo.id"=>$this->data['Indicadoscurso']['cursoativo_id']);
		$cursos= $this->Indicadoscurso->Cursoativo->findAll($options);

		$cursoId = $cursos[0]['Curso']['id'];
		$cursoNome = $cursos[0]['Curso']['codigo'];


		$this->Indicadoscurso->recursive = 1;
		$options = array("Cursoativo.curso_id"=>$cursoId);
		$indicados= $this->Indicadoscurso->findAll($options);

		$turmas = $this->Indicadoscurso->Cursoativo->findAll($options);

		$excluir = array();

		foreach ($turmas as $indicado){
			$excluir[$indicado['Cursoativo']['id']] = $indicado['Cursoativo']['turma'];
		}

		foreach ($excluir as $chave=>$valor){
			$opcoes .= "<option value=\"{$chave}\">{$valor}</option>";
		}


		$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Nome Completo</th><th>Saram</th><th>Identidade</th><th>Setor</th><th>Turma</th><th>Curso</th><th>Prioridade</th><th>Tipo</th><th>Ações</th></tr>";

		//print_r($indicados);

		$i = 0;
		foreach ($indicados as $indicado):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

		//rawurlencode
		$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$indicado['Posto']['sigla_posto'].' '.$indicado['Quadro']['sigla_quadro'].' '.$indicado['Especialidade']['nm_especialidade'].' '.$indicado['Militar']['nm_completo']." ?\" ,\"javascript:excluiRegistro(".$indicado['Indicadoscurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
		$acao .= "<img border=\"0\" onclick=\"seleciona('".rawurlencode($opcoes)."');exibe('".$indicado['Indicadoscurso']['id']."' ,'".rawurlencode($indicado['Posto']['sigla_posto'].' '.$indicado['Quadro']['sigla_quadro'].' '.$indicado['Especialidade']['nm_especialidade'].' '.$indicado['Militar']['nm_completo'])."' ,'".$indicado['Indicadoscurso']['militar_id']."' ,'".$indicado['Indicadoscurso']['prioridade']."', '".$indicado['Indicadoscurso']['status']."', '".$indicado['Cursoativo']['turma']."', '".$indicado['Indicadoscurso']['tipo']."');\" title=\"Editar\" alt=\"Editar\" src=\"".$this->webroot."img/lapis.gif\"/>";
		if($indicado['Indicadoscurso']['status']<>'I'){
			$acao = '';
		}
		$mensagem .= "	<tr {$class}><td>{$indicado['Posto']['sigla_posto']} {$indicado['Quadro']['sigla_quadro']} {$indicado['Especialidade']['nm_especialidade']} {$indicado['Militar']['nm_completo']}</td><td>{$indicado['Militar']['saram']}</td><td>{$indicado['Militar']['identidade']}</td><td>{$indicado['Setor']['sigla_setor']}</td><td>{$indicado['Cursoativo']['turma']}</td><td>{$cursoNome}</td><td>{$indicado['Indicadoscurso']['prioridade']}</td><td>{$indicado['Indicadoscurso']['tipo']}</td><td>{$acao}</td></tr>";

		endforeach;
		$mensagem.="</table>";


		header('Content-type: application/x-json');

		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();

	}
	function update($acao = null, $complementa_setor = null, $anobase = null, $complementa_especialidade = null) {
		$this->layout = 'ajax';

		if(!empty($this->data['Indicadoscurso']['unidade_id'])&&($acao=='unidade')) {

			$sql1 = "select  Setor.id  , Setor.sigla_setor
			FROM setors as Setor
			where Setor.unidade_id={$this->data['Indicadoscurso']['unidade_id']}
			order by  Setor.sigla_setor asc";

			$consulta = $this->Indicadoscurso->Militar->query($sql1);

			$lista[0] = '';
			foreach($consulta as $dados){
				$lista[$dados['Setor']['id']]=$dados['Setor']['sigla_setor'];
			}

			if(!empty($lista)) {
	  	foreach($lista as $k => $v) {
	  		echo "<option value='$k'>$v</option>";
	  	}
	  }
		}

		if(!empty($this->data['Indicadoscurso']['setor_id'])&&($acao=='setor')&&($this->data['Indicadoscurso']['setor_id']>0)) {

			$sql1 = "select  Especialidade.id  , Especialidade.nm_especialidade
			FROM especialidades as Especialidade
			INNER JOIN militars Militar on (Militar.especialidade_id=Especialidade.id and Militar.setor_id={$this->data['Indicadoscurso']['setor_id']})
			order by  Especialidade.nm_especialidade asc";


			$consulta = $this->Indicadoscurso->Militar->query($sql1);

			$lista[0] = '';
			foreach($consulta as $dados){
				$lista[$dados['Especialidade']['id']]=$dados['Especialidade']['nm_especialidade'];
			}

			if(!empty($lista)) {
	  	foreach($lista as $k => $v) {
	  		echo "<option value='$k'>$v</option>";
	  	}
	  }
		}


		if(!empty($this->data['Indicadoscurso']['especialidade_id'])&&($acao=='especialidade')&&($this->data['Indicadoscurso']['especialidade_id']>0)&&(!empty($complementa_setor))) {

			$sql1 = "select  Curso.id, Curso.codigo
			FROM especialidades_setors EspecialidadesSetor 
			INNER JOIN cursos Curso on (EspecialidadesSetor.curso_id=Curso.id) 
			where EspecialidadesSetor.especialidade_id={$this->data['Indicadoscurso']['especialidade_id']}  AND EspecialidadesSetor.setor_id={$complementa_setor}
			group by Curso.id
			order by Curso.codigo asc
			";
				
			//echo $sql1;


			$consulta = $this->Indicadoscurso->Militar->query($sql1);

			$lista[0] = '';
			foreach($consulta as $dados){
				$lista[$dados['Curso']['id']]=$dados['Curso']['codigo'];
			}

			if(!empty($lista)) {
	  	foreach($lista as $k => $v) {
	  		echo "<option value='$k'>$v</option>";
	  	}
	  }
		}


		if(!empty($this->data['Indicadoscurso']['curso_id'])&&($acao=='curso')&&($this->data['Indicadoscurso']['curso_id']>0)&&(!empty($complementa_especialidade)&&(!empty($complementa_setor)))) {

			$sql1 = "select  Cursoativo.id  , concat(Tipocurso.tipo_curso,'-', Cursoativo.natureza,'-', Cursoativo.turma, ' / ', Cursoativo.data_inicio, ' / ', Cursoativo.data_termino) nome
			FROM cursoativos as Cursoativo
			INNER JOIN cursos Curso on (Curso.id=Cursoativo.curso_id)
			INNER JOIN especialidades_setors EspecialidadesSetor on (EspecialidadesSetor.especialidade_id={$complementa_especialidade}  AND EspecialidadesSetor.setor_id={$complementa_setor}  AND EspecialidadesSetor.curso_id={$this->data['Indicadoscurso']['curso_id']} AND EspecialidadesSetor.curso_id=Curso.id)
			INNER JOIN tipocursos Tipocurso on (Tipocurso.id=Cursoativo.tipocurso_id)
			where Cursoativo.ano_base={$anobase}
			order by Curso.codigo asc, Cursoativo.data_inicio asc, Cursoativo.turma asc
			";
			$consulta = $this->Indicadoscurso->Militar->query($sql1);
			$lista[0] = '';
			foreach($consulta as $dados){
				$lista[$dados['Cursoativo']['id']]=$dados[0]['nome'];
			}

			if(!empty($lista)) {
				foreach($lista as $k => $v) {
					echo "<option value='$k'>$v</option>";
				}
			}
		}


		if(!empty($this->data['Indicadoscurso']['curso_id'])&&($acao=='cursonecessidade')&&($this->data['Indicadoscurso']['curso_id']>0)&&(!empty($complementa_especialidade))) {

			$sql1 = "select EspecialidadesSetor.necessario
			FROM especialidades_setors EspecialidadesSetor
			where (EspecialidadesSetor.especialidade_id={$complementa_especialidade}  AND EspecialidadesSetor.setor_id={$complementa_setor}  AND EspecialidadesSetor.curso_id={$this->data['Indicadoscurso']['curso_id']})
			";
				
			//echo $sql1;


			$consulta = $this->Indicadoscurso->Militar->query($sql1);

			$lista = $consulta[0]['EspecialidadesSetor']['necessario'];
			echo "<option value='$lista'>$lista</option>";


		}

		if(!empty($this->data['Indicadoscurso']['curso_id'])&&($acao=='cursomilicos')&&($this->data['Indicadoscurso']['curso_id']>0)) {

			// AND Setor.id={$complementa_setor}
			$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_completo, '-',Militar.nm_guerra)  as 'Militar.nm_completo'
			FROM militars as Militar
			INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id)
			INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id AND Especialidade.id={$complementa_especialidade})
			INNER JOIN setors Setor on (Setor.id=Militar.setor_id)
			INNER JOIN militars_cursos MilitarsCurso on (MilitarsCurso.curso_id<>({$this->data['Indicadoscurso']['curso_id']}) AND MilitarsCurso.militar_id=Militar.id)
			where Militar.ativa>0
			group by Militar.id
			order by  Posto.sigla_posto asc, Militar.nm_completo asc";

			$militars = $this->Indicadoscurso->Militar->query($sql1);

			
			foreach($militars as $milico){
				$vetor[$milico['Militar']['id']]=$milico[0]['Militar.nm_completo'];
			}
			$militars=$vetor;

			if(!empty($militars)) {
	  	foreach($militars as $k => $v) {
	  		echo "<option value='$k'>$v</option>";
	  	}
	  }
		}


		exit();
	}


	function verso($filtro = null) {
		$mensagem="";
		$ok='0';
		$cadastro = 0;
		if ($filtro=='cadastrar') {
			if ($this->Indicadoscurso->save($this->data['Indicadoscurso'])) {	$ok='1';$cadastro = 1;}
		}
		$this->Indicadoscurso->Cursoativo->recursive = 2;
		$options = array("Cursoativo.id"=>$this->data['Indicadoscurso']['cursoativo_id']);
		$cursos= $this->Indicadoscurso->Cursoativo->findAll($options);

		$cursoId = $cursos[0]['Curso']['id'];
		$cursoNome = $cursos[0]['Curso']['codigo'];


		$this->Indicadoscurso->recursive = 1;
		$options = array("Cursoativo.curso_id"=>$cursoId);
		$indicados= $this->Indicadoscurso->findAll($options);

		$turmas = $this->Indicadoscurso->Cursoativo->findAll($options);

		$excluir = array();

		foreach ($turmas as $indicado){
			$excluir[$indicado['Cursoativo']['id']] = $indicado['Cursoativo']['turma'];
		}

		foreach ($excluir as $chave=>$valor){
			$opcoes .= "<option value=\"{$chave}\">{$valor}</option>";
		}

		$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Nome Completo</th><th>Saram</th><th>Identidade</th><th>Setor</th><th>Turma</th><th>Curso</th><th>Prioridade</th><th>Tipo</th><th>Ações</th></tr>";

		//print_r($indicados);

		$i = 0;
		foreach ($indicados as $indicado):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

		//rawurlencode
		$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$indicado['Posto']['sigla_posto'].' '.$indicado['Quadro']['sigla_quadro'].' '.$indicado['Especialidade']['nm_especialidade'].' '.$indicado['Militar']['nm_completo']." ?\" ,\"javascript:excluiRegistro(".$indicado['Indicadoscurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
		$acao .= "<img border=\"0\" onclick=\"seleciona('".rawurlencode($opcoes)."');exibe('".$indicado['Indicadoscurso']['id']."' ,'".rawurlencode($indicado['Posto']['sigla_posto'].' '.$indicado['Quadro']['sigla_quadro'].' '.$indicado['Especialidade']['nm_especialidade'].' '.$indicado['Militar']['nm_completo'])."' ,'".$indicado['Indicadoscurso']['militar_id']."' ,'".$indicado['Indicadoscurso']['prioridade']."', '".$indicado['Indicadoscurso']['status']."', '".$indicado['Cursoativo']['turma']."', '".$indicado['Indicadoscurso']['tipo']."');\" title=\"Editar\" alt=\"Editar\" src=\"".$this->webroot."img/lapis.gif\"/>";
		if($indicado['Indicadoscurso']['status']<>'I'){
			$acao = '';
		}
		$mensagem .= "	<tr {$class}><td>{$indicado['Posto']['sigla_posto']} {$indicado['Quadro']['sigla_quadro']} {$indicado['Especialidade']['nm_especialidade']} {$indicado['Militar']['nm_completo']}</td><td>{$indicado['Militar']['saram']}</td><td>{$indicado['Militar']['identidade']}</td><td>{$indicado['Setor']['sigla_setor']}</td><td>{$indicado['Cursoativo']['turma']}</td><td>{$cursoNome}</td><td>{$indicado['Indicadoscurso']['prioridade']}</td><td>{$indicado['Indicadoscurso']['tipo']}</td><td>{$acao}</td></tr>";

		endforeach;
		$mensagem.="</table>";

		header('Content-type: application/x-json');
		if($cadastro){
			echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		}else{
			echo $mensagem;

		}




		exit();



	}

	function indexExcel($id = null, $consulta = null)
	{

		$this->layout = 'openoffice' ;
		$titulo = 'Dados dos Indicados para Cursos';
		$tabela = 'indicados';
		$nome = 'planilha_indicados_cursos';

		$this->Indicadoscurso->Cursoativo->Curso->recursive = 0;
		$this->Indicadoscurso->order = array('Curso.codigo'=>'asc', 'Indicadoscurso.prioridade'=>'asc');
		$linha = $this->Indicadoscurso->find('all');

		$i = 0;
		foreach($linha as $coluna){
			if(count($coluna['Indicadoscurso'])>0){
				$conteudo[$i]['Curso'] = $coluna['Curso']['codigo'];
				$conteudo[$i]['Turma'] = $coluna['Cursoativo']['turma'];
				$conteudo[$i]['DataInicio'] = $coluna['Cursoativo']['data_inicio'];
				$conteudo[$i]['DataTermino'] = $coluna['Cursoativo']['data_termino'];
				$conteudo[$i]['DataTermino'] = $coluna['Cursoativo']['data_termino'];
				$conteudo[$i]['Tipo'] = $coluna['Indicadoscurso']['tipo'];
				$conteudo[$i]['Prioridade'] = $coluna['Indicadoscurso']['prioridade'];
				$conteudo[$i]['Posto'] = $coluna['Posto']['sigla_posto'];
				$conteudo[$i]['Quadro'] = $coluna['Quadro']['sigla_quadro'];
				$conteudo[$i]['Especialidade'] = $coluna['Especialidade']['nm_especialidade'];
				$conteudo[$i]['Nome'] = $coluna['Militar']['nm_completo'];
				$conteudo[$i]['Saram'] = $coluna['Militar']['saram'];
				$conteudo[$i]['Identidade'] = $coluna['Militar']['identidade'];
				$conteudo[$i]['Setor'] = $coluna['Setor']['sigla_setor'];
				$i ++;
			}
		}
		$campos = array('Curso','Turma', 'DataInicio', 'DataTermino', 'Tipo', 'Prioridade', 'Posto', 'Quadro', 'Especialidade', 'Nome', 'Saram', 'Identidade', 'Setor');

		/*
		 echo "<pre>";
		 print_r($linha);
		 echo "</pre>";
		 exit(1);
		 * 		*/


		$this->set(compact('titulo','tabela','conteudo','campos','nome'));

		$this->render();
	}

	function indexExcelAntes($id = null, $consulta = null)
	{

		$this->layout = 'openoffice' ;
		$titulo = 'Dados dos Indicados para Cursos';
		$tabela = 'indicados';
		$nome = 'planilha_indicados_cursos';

		$this->Indicadoscurso->Cursoativo->Curso->recursive = 0;
		$this->Indicadoscurso->order = array('Curso.codigo'=>'asc', 'Indicadoscurso.prioridade'=>'asc');
		$linha = $this->Indicadoscurso->find('all');

		$i = 0;
		foreach($linha as $coluna){
			if(count($coluna['Indicadoscurso'])>0){
				$conteudo[$i]['Curso'] = $coluna['Curso']['codigo'];
				$conteudo[$i]['Turma'] = $coluna['Cursoativo']['turma'];
				$conteudo[$i]['DataInicio'] = $coluna['Cursoativo']['data_inicio'];
				$conteudo[$i]['DataTermino'] = $coluna['Cursoativo']['data_termino'];
				$conteudo[$i]['DataTermino'] = $coluna['Cursoativo']['data_termino'];
				$conteudo[$i]['Tipo'] = $coluna['Indicadoscurso']['tipo'];
				$conteudo[$i]['Prioridade'] = $coluna['Indicadoscurso']['prioridade'];
				$conteudo[$i]['Posto'] = $coluna['Posto']['sigla_posto'];
				$conteudo[$i]['Quadro'] = $coluna['Quadro']['sigla_quadro'];
				$conteudo[$i]['Especialidade'] = $coluna['Especialidade']['nm_especialidade'];
				$conteudo[$i]['Nome'] = $coluna['Militar']['nm_completo'];
				$conteudo[$i]['Saram'] = $coluna['Militar']['saram'];
				$conteudo[$i]['Identidade'] = $coluna['Militar']['identidade'];
				$conteudo[$i]['Setor'] = $coluna['Setor']['sigla_setor'];
				$i ++;
			}
		}
		$campos = array('Curso','Turma', 'DataInicio', 'DataTermino', 'Tipo', 'Prioridade', 'Posto', 'Quadro', 'Especialidade', 'Nome', 'Saram', 'Identidade', 'Setor');

		/*
		 echo "<pre>";
		 print_r($linha);
		 echo "</pre>";
		 exit(1);
		 * 		*/


		$this->set(compact('titulo','tabela','conteudo','campos','nome'));

		$this->render();
	}
	

}
?>