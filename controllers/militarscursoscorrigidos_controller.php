<?php
class MilitarscursoscorrigidosController extends AppController {

	var $name = 'Militarscursoscorrigidos';
	var $helpers = array('Html', 'Form');

	function externoverso($acao = null, $id = null, $setor = null) {
		$u=$this->Session->read('Usuario');
                
		
		$mensagem="";
		$ok='0';

		$setoressql = " and Setor.id in ({$u[0][0]['setores']}) ";
		
		if (($acao=='setor')&&(!empty($id))) {
			
				$ok='1';
				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.confirma, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento, MilitarsCurso.acao    
				FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN militarscursoscorrigidos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.unidade_id=MilitarsCurso.unidade_id and Setor.id=$id )
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id, acao
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$atuais = $this->Militarscursoscorrigido->query($sql);
				$checkbox = 0;
				
				if(($u[0]['Usuario']['privilegio_id']==6)){
					$checkbox = 1;
				}
				
				$atual= "<h2>Cadastros do Escalante </h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th><th>PROCEDIMENTO</th><th>Ações</th></tr>";

				$i = 0;
				foreach ($atuais as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				if($militarscurso['MilitarsCurso']['confirma']==1){
					$acao = "<img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/verde.gif\"/>";
				}else{
					$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$militarscurso['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$militarscurso['MilitarsCurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				}

				if($militarscurso['MilitarsCurso']['confirma']!=1){
					if($checkbox){
						$acao = "<input type='checkbox' id='".$militarscurso['MilitarsCurso']['id']."' onclick=\"confirma('".$militarscurso['MilitarsCurso']['id']."');\">";
					}
				}
				$inicio = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_inicio_curso']));
				$fim = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_fim_curso']));
				$atual .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$inicio}</td><td>{$fim}</td><td>{$militarscurso['MilitarsCurso']['acao']}</td><td>{$acao}</td></tr>";

				endforeach;
				$atual.="</table>";


				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento    FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.id=$id)
				INNER JOIN militars_cursos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$milicos = $this->Militarscursoscorrigido->query($sql);

				$mensagem= "<h2>Atualmente cadastrados no SGBDO</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th></tr>";

				$i = 0;
				foreach ($milicos as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				$mensagem .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>".date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_inicio_curso']))."</td><td>".date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_fim_curso']))."</td></tr>";

				endforeach;
				$mensagem.="</table>";

			
		}
		if (($acao=='militar')&&(!empty($id))) {
			
				$ok='1';
				$militar = ' AND MilitarsCurso.militar_id='.$id;

				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.confirma, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento, MilitarsCurso.acao    
				FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN militarscursoscorrigidos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id  $militar)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.unidade_id=MilitarsCurso.unidade_id)
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id, acao
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$atuais = $this->Militarscursoscorrigido->query($sql);
				$checkbox = 0;
				
				if(($u[0]['Usuario']['privilegio_id']==6)){
					$checkbox = 1;
				}
				
				$atual= "<h2>Cadastros do Escalante </h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th><th>PROCEDIMENTO</th><th>Ações</th></tr>";

				$i = 0;
				foreach ($atuais as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				if($militarscurso['MilitarsCurso']['confirma']==1){
					$acao = "<img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/verde.gif\"/>";
				}else{
					$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$militarscurso['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$militarscurso['MilitarsCurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				}

				if($militarscurso['MilitarsCurso']['confirma']!=1){
					if($checkbox){
						$acao = "<input type='checkbox' id='".$militarscurso['MilitarsCurso']['id']."' onclick=\"confirma('".$militarscurso['MilitarsCurso']['id']."');\">";
					}
				}
				$inicio = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_inicio_curso']));
				$fim = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_fim_curso']));
				$atual .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$inicio}</td><td>{$fim}</td><td>{$militarscurso['MilitarsCurso']['acao']}</td><td>{$acao}</td></tr>";

				endforeach;
				$atual.="</table>";


				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento    FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id )
				INNER JOIN militars_cursos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id $militar)
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$milicos = $this->Militarscursoscorrigido->query($sql);

				$mensagem= "<h2>Atualmente cadastrados no SGBDO</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th></tr>";

				$i = 0;
				foreach ($milicos as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				
				
				$mensagem .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>".date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_inicio_curso']))."</td><td>".date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_fim_curso']))."</td></tr>";

				endforeach;
				$mensagem.="</table>";

			
		}
		
		if (($acao=='militar')&&($id==0)&&(!empty($setor))) {
				$id = $setor;
				
				$ok='1';
				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.confirma, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento, MilitarsCurso.acao    
				FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN militarscursoscorrigidos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.unidade_id=MilitarsCurso.unidade_id and Setor.id=$id )
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id, acao
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$atuais = $this->Militarscursoscorrigido->query($sql);
				$checkbox = 0;
				
				if(($u[0]['Usuario']['privilegio_id']==6)){
					$checkbox = 1;
				}
				
				$atual= "<h2>Cadastros do Escalante </h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th><th>PROCEDIMENTO</th><th>Ações</th></tr>";

				$i = 0;
				foreach ($atuais as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				if($militarscurso['MilitarsCurso']['confirma']==1){
					$acao = "<img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/verde.gif\"/>";
				}else{
					$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$militarscurso['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$militarscurso['MilitarsCurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				}

				if($militarscurso['MilitarsCurso']['confirma']!=1){
					if($checkbox){
						$acao = "<input type='checkbox' id='".$militarscurso['MilitarsCurso']['id']."' onclick=\"confirma('".$militarscurso['MilitarsCurso']['id']."');\">";
					}
				}
				$inicio = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_inicio_curso']));
				$fim = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_fim_curso']));
				$atual .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$inicio}</td><td>{$fim}</td><td>{$militarscurso['MilitarsCurso']['acao']}</td><td>{$acao}</td></tr>";

				endforeach;
				$atual.="</table>";


				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento    FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.id=$id)
				INNER JOIN militars_cursos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$milicos = $this->Militarscursoscorrigido->query($sql);

				$mensagem= "<h2>Atualmente cadastrados no SGBDO</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th></tr>";

				$i = 0;
				foreach ($milicos as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				$mensagem .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>".date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_inicio_curso']))."</td><td>".date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_fim_curso']))."</td></tr>";

				endforeach;
				$mensagem.="</table>";
			
		}
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';

		exit();


	}
	function index() {
		$this->redirect(array('action'=>'externoindex'));
	}
	function externoindex() {
		$this->Militarscursoscorrigido->recursive = 0;
		$this->set('militarscursoscorrigidos', $this->paginate());
	}

	function externoview($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Militarscursoscorrigido.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('militarscursoscorrigido', $this->Militarscursoscorrigido->read(null, $id));
	}

	function add() {
		$u=$this->Session->read('Usuario');
                
		$setorsql = " and Setor.id in ({$u[0][0]['setores']}) ";
		$this->layout = 'admin';
		$militars[0] = '---';

		$unidadeSql = "select Unidade.id, Unidade.sigla_unidade from unidades Unidade inner join setors Setor on (Setor.unidade_id=Unidade.id $setorsql) order by Unidade.sigla_unidade asc ";
		$unidade = $this->Militarscursoscorrigido->Unidade->query($unidadeSql);
		foreach($unidade as $dados){
			$unidades[$dados['Unidade']['id']]=$dados['Unidade']['sigla_unidade'];
		}
		$unidades[0]='---';
		$cursos = $this->Militarscursoscorrigido->Curso->find('list');
		$setors[0] = '---';
		$this->set(compact('unidades', 'militars', 'cursos', 'setors', 'u'));
	}
	
	function externoadd() {
		$u=$this->Session->read('Usuario');
                
		$setorsql = " and Setor.id in ({$u[0][0]['setores']}) ";
		$this->layout = 'ajax';
		if (!empty($this->data)) {
			//$this->data['Militarscursoscorrigido']['updated']=date('d-m-Y h:i:s');
			$this->data['Militarscursoscorrigido']['updated']=date('Y-m-d h:i:s');
			$this->Militarscursoscorrigido->create();
			if ($this->Militarscursoscorrigido->save($this->data)) {
				$ok = '1';
			} else {
				$ok='0';
			}
			$mensagem="";

				$setorsql = ' and Setor.id='+$this->data['Militarscursoscorrigido']['setor_id']+" and Setor.id in ({$u[0][0]['setores']}) ";
				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.confirma, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento, MilitarsCurso.acao 
				   FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN militarscursoscorrigidos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id  and MilitarsCurso.militar_id={$this->data['Militarscursoscorrigido']['militar_id']})
				INNER JOIN setors as Setor on (Setor.id=Militar.setor_id  )
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id, acao
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$atuais = $this->Militarscursoscorrigido->query($sql);
				$u=$this->Session->read('Usuario');
                                
				
				$checkbox = 0;
				
				if(($u[0]['Usuario']['privilegio_id']==6)){
						$checkbox = 1;
				}
				
				$atual= "<h2>Cadastros do Escalante </h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th><th>PROCEDIMENTO</th><th>Ações</th></tr>";

				//				print_r($militarscursos);

				$i = 0;
				foreach ($atuais as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				if($militarscurso['MilitarsCurso']['confirma']==1){
					$acao = "<img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/verde.gif\"/>";
				}else{
					$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$militarscurso['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$militarscurso['MilitarsCurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				}

				if($militarscurso['MilitarsCurso']['confirma']!=1){
					if($checkbox){
						$acao = "<input type='checkbox' id='".$militarscurso['MilitarsCurso']['id']."' onclick=\"confirma('".$militarscurso['MilitarsCurso']['id']."');\">";
					}
				}

						$atual .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$militarscurso['MilitarsCurso']['dt_inicio_curso']}</td><td>{$militarscurso['MilitarsCurso']['dt_fim_curso']}</td><td>{$militarscurso['MilitarsCurso']['acao']}</td><td>{$acao}</td></tr>";

			endforeach;
			$atual.="</table>";


			$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
			MilitarsCurso.id, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento     FROM militars as Militar
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			INNER JOIN setors as Setor on (Setor.id={$this->data['Militarscursoscorrigido']['setor_id']} and Militar.setor_id=Setor.id)
			INNER JOIN militars_cursos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id )
			INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
			where Militar.ativa>0
			group by Militar.id, Curso.id
			order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
			$milicos = $this->Militarscursoscorrigido->query($sql);
//			INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.unidade_id=$unidade_id $setorsql)



			//echo $sql;

			//$consulta = $this->Militarscursoscorrigido->query($sql);

			$mensagem= "<h2>Atualmente cadastrados no SGBDO</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th><th>Documento</th></tr>";

			//				print_r($militarscursos);

			$i = 0;
			foreach ($milicos as $militarscurso):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}

			//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);

			$mensagem .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$militarscurso['MilitarsCurso']['dt_inicio_curso']}</td><td>{$militarscurso['MilitarsCurso']['dt_fim_curso']}</td><td>{$militarscurso['MilitarsCurso']['acao']}</td></tr>";

			endforeach;
			$mensagem.="</table>";

			header('Content-type: application/x-json');

			//$ok = urlencode(print_r($this, true));

			//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
			echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';

			exit();

				
		}
		
		
	}

	function externoPdf($unidade_id = null, $setor_id = null, $militar_id = null) {
		$valida = 0;
		$militarsql = '';
		if(!empty($setor_id)){
			$setorsql = ' and Setor.id='.$setor_id;
		}
		
		if(($militar_id!=1048)&&(!empty($militar_id))){
			$militarsql = ' and MilitarsCurso.militar_id='.$militar_id;
		}
		$this->layout = 'pdf'; //this will use the pdf.thtml layout
		$sql = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade, '-', Militar.nm_completo,'-',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
		MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento, Unidade.sigla_unidade, MilitarsCurso.acao, Setor.sigla_setor
		FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
		INNER JOIN setors as Setor on (Militar.setor_id=Setor.id $setorsql)
		INNER JOIN unidades as Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN militarscursoscorrigidos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id and MilitarsCurso.unidade_id=$unidade_id  $militarsql)
		INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
		order by  Posto.antiguidade asc, Militar.nm_completo asc";
		//echo $sql;
		
			
		$militars = $this->Militarscursoscorrigido->query($sql);
		
		$setors = 0;
		if(!empty($setor_id)){
			$setors = $militars[0]['Setor']['sigla_setor'];
		}
		
		$this->set(compact('militars','setors'));
			
		//print_r($militars);
		//exit();
		//$this->redirect(array('action'=>'externoadd'));

	}

	function externoedit($id = null) {
		$this->layout = 'adminexterno';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Militarscursoscorrigido', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Militarscursoscorrigido->save($this->data)) {
				$this->Session->setFlash(__('The Militarscursoscorrigido has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Militarscursoscorrigido could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Militarscursoscorrigido->read(null, $id);
		}
		$setors = $this->Militarscursoscorrigido->Setor->find('list');
		$militars = $this->Militarscursoscorrigido->Militar->find('list');
		$cursos = $this->Militarscursoscorrigido->Curso->find('list');
		$this->set(compact('setors','militars','cursos'));
	}

	function delete($id = null, $setor_id = null) {
		$this->layout = 'ajax';
		if ($this->Militarscursoscorrigido->delete($id)) {
			$ok = '1';
		}else{
			$ok = '0';
		}
		$mensagem="";
				$id = $setor_id;

				$ok='1';
				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.confirma, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento, MilitarsCurso.acao    
				FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN militarscursoscorrigidos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.unidade_id=MilitarsCurso.unidade_id and Setor.id=$id )
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id, acao
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$atuais = $this->Militarscursoscorrigido->query($sql);
				$checkbox = 0;
				
				if(($u[0]['Usuario']['privilegio_id']==6)){
					$checkbox = 1;
				}
				
				$atual= "<h2>Cadastros do Escalante </h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th><th>PROCEDIMENTO</th><th>Ações</th></tr>";

				$i = 0;
				foreach ($atuais as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				if($militarscurso['MilitarsCurso']['confirma']==1){
					$acao = "<img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/verde.gif\"/>";
				}else{
					$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$militarscurso['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$militarscurso['MilitarsCurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				}

				if($militarscurso['MilitarsCurso']['confirma']!=1){
					if($checkbox){
						$acao = "<input type='checkbox' id='".$militarscurso['MilitarsCurso']['id']."' onclick=\"confirma('".$militarscurso['MilitarsCurso']['id']."');\">";
					}
				}
				$inicio = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_inicio_curso']));
				$fim = date('d-m-Y',strtotime($militarscurso['MilitarsCurso']['dt_fim_curso']));
				$atual .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$inicio}</td><td>{$fim}</td><td>{$militarscurso['MilitarsCurso']['acao']}</td><td>{$acao}</td></tr>";

				endforeach;
				$atual.="</table>";


				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id, Curso.codigo,
				MilitarsCurso.id, MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao, MilitarsCurso.documento    FROM militars as Militar
				INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
				INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
				INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
				INNER JOIN setors as Setor on (Militar.setor_id=Setor.id and Setor.id=$id)
				INNER JOIN militars_cursos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
				INNER JOIN cursos as Curso on (Curso.id=MilitarsCurso.curso_id)
				where Militar.ativa>0
				group by Militar.id, Curso.id
				order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$milicos = $this->Militarscursoscorrigido->query($sql);

				$mensagem= "<h2>Atualmente cadastrados no SGBDO</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Curso</th><th>Local</th><th>Data Inicio</th><th>Data Fim</th></tr>";

				$i = 0;
				foreach ($milicos as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				$mensagem .= "	<tr {$class}><td>{$militarscurso[0]['nomecompleto']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$militarscurso['MilitarsCurso']['dt_inicio_curso']}</td><td>{$militarscurso['MilitarsCurso']['dt_fim_curso']}</td></tr>";

				endforeach;
				$mensagem.="</table>";
		
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';

		exit();

	}
	
	function externoupdatesetor($acao = null, $id = null) {
		$u=$this->Session->read('Usuario');
                
		//print_r($u);
		
		$this->layout = 'ajax';

		//$setorsql = " and Setor.id in ({$u[0][0]['setores']}) ";
		
		if(($id!=0)&&($acao=='unidade')) {
			$setorsql = " and Setor.id in ({$u[0][0]['setores']}) ";
			$sql1 = "select  Setor.id  , Setor.sigla_setor
			FROM setors as Setor
			where Setor.unidade_id={$id}  $setorsql
			order by  Setor.sigla_setor asc";
			
			//echo $sql1;
			
			$consulta = $this->Militarscursoscorrigido->query($sql1);

			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['Setor']['id']]=$dados['Setor']['sigla_setor'];
			}

			if(!empty($lista)) {
	  			foreach($lista as $k => $v) {
	  				echo "<option value='$k'>$v</option>";
	  			}
	 		 }
		}



		exit();
	}
	

	function externoupdate($acao = null, $id = null) {
		$u=$this->Session->read('Usuario');
                
		//print_r($u);
		
		$this->layout = 'ajax';

		//$setorsql = " and Setor.id in ({$u[0][0]['setores']}) ";
		
		if(($id!=0)&&($acao=='unidade')) {
			$setorsql = " and Setor.id in ({$u[0][0]['setores']}) ";
			$sql1 = "select  Setor.id  , Setor.sigla_setor
			FROM setors as Setor
			where Setor.unidade_id={$id}  $setorsql
			order by  Setor.sigla_setor asc";
			
			//echo $sql1;
			
			$consulta = $this->Militarscursoscorrigido->query($sql1);

			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['Setor']['id']]=$dados['Setor']['sigla_setor'];
			}

			if(!empty($lista)) {
	  			foreach($lista as $k => $v) {
	  				echo "<option value='$k'>$v</option>";
	  			}
	 		 }
		}

		if(($id!=0)&&($acao=='setor')) {
			
				$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto, Militar.id
				,Militar.nm_guerra, Posto.sigla_posto   
				FROM militars as Militar
					INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
					INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
					INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
					where Militar.ativa>0 and Militar.setor_id=$id
					order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
				$milicos = $this->Militarscursoscorrigido->query($sql);
		
		
				$lista[0] = '';
				$lista[0] = '---';
				
				foreach($milicos as $r){
				 $nome = $r[0]['nomecompleto'];
				// $nome = str_replace($r['Militar']['nm_guerra'], "<b>".$r['Militar']['nm_guerra']."</b>", $nome);
				// $nome = str_replace($r['Posto']['sigla_posto'], "<b>".$r['Posto']['sigla_posto']."</b>", $nome);
					$lista[$r['Militar']['id']] = $nome;
				}

	
				if(!empty($lista)) {
		  			foreach($lista as $k => $v) {
		  				echo "<option value='$k'>$v</option>";
		  			}
		 		 }
		}
		if(($id==0)&&($acao=='setor')) {
			
				$lista[0] = '';
				$lista[0] = '---';
				
	
				if(!empty($lista)) {
		  			foreach($lista as $k => $v) {
		  				echo "<option value='$k'>$v</option>";
		  			}
		 		 }
		}
		



		exit();
	}

	function externoconfirma($id = null, $opcao = null) {
		$this->layout = 'ajax';
			if(!empty($id)){
			
			$aprova = $this->data['Militarscursoscorrigido']['aprova_dados'];
			$dt_aprova = $this->data['Militarscursoscorrigido']['dt_aprova'];
			
			$sql1 = "select  *	FROM militarscursoscorrigidos where id={$id}";
			
			$consulta = $this->Militarscursoscorrigido->query($sql1);
			
			$militarId = $consulta[0]['militarscursoscorrigidos']['militar_id'];
			$cursoId = $consulta[0]['militarscursoscorrigidos']['curso_id'];
			if(!empty($opcao)){
			$acao = $opcao;
			}else{
			$acao = $consulta[0]['militarscursoscorrigidos']['acao'];
			}
			$inicio = $consulta[0]['militarscursoscorrigidos']['dt_inicio_curso'];
			$fim = $consulta[0]['militarscursoscorrigidos']['dt_fim_curso'];
			$local = $consulta[0]['militarscursoscorrigidos']['local_realizacao'];
			$periodo = $inicio.' a '.$fim;
			
			$sqlAtualiza = "update militarscursoscorrigidos set confirma=1, acao='{$acao}', aprova_dados='{$aprova}', dt_aprova='{$dt_aprova}' where id=$id";

			$atualiza = $this->Militarscursoscorrigido->query($sqlAtualiza);
			
			$mensagem = '';
			$ok = 0;
			
			if($acao=='INCLUIR'){
				$sql = "insert into militars_cursos (id, militar_id, curso_id, dt_inicio_curso, dt_fim_curso, local_realizacao, periodo)
				 values (uuid(),$militarId, $cursoId,'$inicio', '$fim', '$local', '$periodo')";
				 
				$acoes = $this->Militarscursoscorrigido->query($sql);
				
				$sql = "select * from militars_cursos where militar_id=$militarId and curso_id=$cursoId and  dt_inicio_curso='$inicio' and 
				 dt_fim_curso='$fim' and  local_realizacao='$local' and  periodo='$periodo'";
				 
				$valida = $this->Militarscursoscorrigido->query($sql);
				
				
				if($valida[0]['militars_cursos']['id']>0){
					$ok = 1;
					$mensagem = 'Registro inserido com sucesso!';
				}else{
					$sqlAtualiza = "update militarscursoscorrigidos set confirma=0, aprova_dados='{$aprova}', dt_aprova='{$dt_aprova}' where id=$id";
					$atualiza = $this->Militarscursoscorrigido->query($sqlAtualiza);
					$mensagem = 'Registro não foi inserido !';
				}
				 
			}
			
			if($acao=='RETIFICAR'){
				$sql = "update militars_cursos set militar_id=$militarId, curso_id=$cursoId,
				 dt_inicio_curso='$inicio', dt_fim_curso='$fim', local_realizacao='$local', periodo='$periodo'
				 where curso_id=$cursoId and militar_id=$militarId ;";
				$acoes = $this->Militarscursoscorrigido->query($sql);

				$sql = "select * from militars_cursos where militar_id=$militarId and curso_id=$cursoId and  dt_inicio_curso='$inicio' and 
				 dt_fim_curso='$fim' and  local_realizacao='$local' and  periodo='$periodo'";
								 
				$valida = $this->Militarscursoscorrigido->query($sql);
				
				if($valida[0]['militars_cursos']['id']>0){
					$ok = 1;
					$mensagem = 'Registro atualizado com sucesso!';
				}else{
					$sqlAtualiza = "update militarscursoscorrigidos set confirma=0, aprova_dados='{$aprova}', dt_aprova='{$dt_aprova}'  where id=$id";
					$atualiza = $this->Militarscursoscorrigido->query($sqlAtualiza);
					$mensagem = 'Registro não existe na base para RETIFICAR!';
				}
				 
			}
			
			if($acao=='EXCLUIR'){
				$sql = "delete militars_cursos where curso_id=$cursoId and militar_id=$militarId ;";
				$acoes = $this->Militarscursoscorrigido->query($sql);

				$sql = "select * from militars_cursos where militar_id=$militarId and curso_id=$cursoId and  dt_inicio_curso='$inicio' and 
				 dt_fim_curso='$fim' and  local_realizacao='$local' and  periodo='$periodo'";
								 
				$valida = $this->Militarscursoscorrigido->query($sql);
				
				if(count($valida)>0){
					$ok = 0;
					$sqlAtualiza = "update militarscursoscorrigidos set confirma=0, aprova_dados='{$aprova}', dt_aprova='{$dt_aprova}'  where id=$id";
					$atualiza = $this->Militarscursoscorrigido->query($sqlAtualiza);
					$mensagem = 'Registro não foi excluído, pois não existe na base!';
				}else{
					$ok = 1;
					$mensagem = 'Registro excluído com sucesso!';
				}
				 
			}
			
			
			
			
			
			header('Content-type: application/x-json');
			echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';
			
			exit();
			}
	}
	function externosugestao($militarId=null, $setorId=null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = 'popupsugestao';
		$sugestaos['responsavel']=$u[0][0]['nome'];
		$sugestaos['setor_id']=$setorId;
		$sugestaos['militar_id']=$militarId;
		$sugestaos['dt_sugestao']=date('Y-m-d h:i:s');
		$sql = "select concat(Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade, ' - ', Militar.nm_completo,' - ',Militar.nm_guerra ) as nomecompleto
				,Militar.nm_guerra, Posto.sigla_posto   
				FROM militars as Militar
					INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
					INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
					INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
					where Militar.ativa>0 and Militar.id=$militarId
					order by  Posto.antiguidade asc,Militar.nm_guerra asc, Militar.nm_completo asc";
		$milicos = $this->Militarscursoscorrigido->query($sql);
		$sugestaos['nm_militar']=$milicos[0][0]['nomecompleto'];
		
		$this->set(compact('sugestaos'));
		
		
		//print_r($u);
	}
	function externosugestaoadd() {
		$u=$this->Session->read('Usuario');
                
		$this->layout = 'ajax';
		$insere = "insert into sugestaos(id, dt_sugestao, militar_id, nm_militar, responsavel, setor_id, sugestao, tipo_sugestao)
		values(uuid(),'{$this->data['Militarscursoscorrigido']['dt_sugestao']}',{$this->data['Militarscursoscorrigido']['militar_id']},
		'{$this->data['Militarscursoscorrigido']['nm_militar']}','{$this->data['Militarscursoscorrigido']['responsavel']}',
		{$this->data['Militarscursoscorrigido']['setor_id']},'{$this->data['Militarscursoscorrigido']['sugestao']}',
		'{$this->data['Militarscursoscorrigido']['tipo_sugestao']}')";
		//echo $insere;
		$resultado = $this->Militarscursoscorrigido->query($insere);
		$ok=1;
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes('Agradecemos pela ajuda!').'" }';
		exit();
		//print_r($u);
	}
	
}
?>