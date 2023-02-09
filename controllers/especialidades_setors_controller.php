<?php
class EspecialidadesSetorsController extends AppController {

	var $name = 'EspecialidadesSetors';
	var $helpers = array('Html', 'Form');

	function index() {
			$this->redirect(array('action'=>'add'));
			}

	function view($id = null) {
			$this->redirect(array('action'=>'add'));
			}

	function verso($filtro = null) {
		$mensagem="";
		$ok='0';
		//print_r($this->data);
			$consulta = "select * from especialidades_setors EspecialidadesSetor where especialidade_id={$this->data['EspecialidadesSetor']['especialidade_id']} and setor_id={$this->data['EspecialidadesSetor']['setor_id']} and curso_id={$this->data['EspecialidadesSetor']['curso_id']} ";
			
			$existencia = $this->EspecialidadesSetor->query($consulta);
			
			
			if($existencia[0]['EspecialidadesSetor']['id']>0){
				$this->data['EspecialidadesSetor']['id'] = $existencia[0]['EspecialidadesSetor']['id']; 
			}
		
		if (!empty($this->data)) {
			$this->EspecialidadesSetor->create();
			
			if ($this->EspecialidadesSetor->save($this->data)) {
				$ok='1';

				$options = array("EspecialidadesSetor.especialidade_id"=>$filtro);
				$this->EspecialidadesSetor->recursive = 2;
				$this->EspecialidadesSetor->Setor->unbindModel(array('hasMany'=>array('Militar','Escala')));
				$this->EspecialidadesSetor->Especialidade->unbindModel(array('hasMany'=>array('Militar')));
				//$this->EspecialidadesSetor->Curso->recursive = 0;
				$this->EspecialidadesSetor->Curso->unbindModel(array('hasMany'=>array('Cursoativo'),'hasAndBelongsToMany'=>array('Militar')));
				//,'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Afastamento','Atividade','Exame','Habilitacao'),'hasAndBelongsToMany'=>array('Escala','Curso')));
				$especialidadesSetors= $this->EspecialidadesSetor->findAll($options);
			//	echo "<pre>";
			//	print_r($especialidadesSetors);
			//	echo "</pre>";
				
				//print_r($especialidadesSetors[0],true).
				$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Especialidade</th><th>Setor</th><th>Curso</th><th>Necessário</th><th>Ações</th></tr>";


				$i = 0;
				foreach ($especialidadesSetors as $especialidadesSetor):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
				$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?\" ,\"javascript:excluiRegistro(".$especialidadesSetor['EspecialidadesSetor']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

				$mensagem .= "	<tr {$class}><td>{$especialidadesSetor['Especialidade']['Quadro']['sigla_quadro']} - {$especialidadesSetor['Especialidade']['nm_especialidade']}</td><td>{$especialidadesSetor['Setor']['Unidade']['sigla_unidade']}-{$especialidadesSetor['Setor']['sigla_setor']}</td><td>{$especialidadesSetor['Curso']['codigo']}</td><td>{$especialidadesSetor['EspecialidadesSetor']['necessario']}</td><td>{$acao}</td></tr>";

				endforeach;
				$mensagem.="</table>";
			}
		}
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();

	}

	function add() {
		$especialidades = $this->EspecialidadesSetor->Especialidade->find('all');

		
		foreach($especialidades as $milico){
			$vetor[]=$milico['Especialidade']['id'];
			$vetor2[]=$milico['Quadro']['sigla_quadro'].' - '.$milico['Especialidade']['nm_especialidade'];
		}
		$especialidades=array_combine($vetor,$vetor2);
		asort($especialidades);

		
		$sql = "select Unidade.sigla_unidade, Setor.id, Setor.sigla_setor from setors Setor
		inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
		order by Unidade.sigla_unidade asc, Setor.sigla_setor asc
		";
		$rotulos = $this->EspecialidadesSetor->query($sql);
		
		foreach($rotulos as $linha){
			$vetor5[$linha['Setor']['id']] = $linha['Unidade']['sigla_unidade'].' - '.$linha['Setor']['sigla_setor'];
		}
		$setors = $vetor5;
		
		$curso = "select Curso.id, Curso.codigo from cursos Curso order by Curso.codigo asc ";
		$consulta = $this->EspecialidadesSetor->Curso->query($curso);
		foreach($consulta as $dados){
			$vetor3[]=$dados['Curso']['id'];
			$vetor4[]=$dados['Curso']['codigo'];
		}
		$cursos=array_combine($vetor3,$vetor4);
		
		$this->set(compact('especialidades', 'setors', 'cursos'));
	}

	function edit($especialidadeid = null, $setorid = null, $rotuloid = null) {
				$ok='1';
//"EspecialidadesSetor.setor_id"=>$setorid,
				//$options = array("EspecialidadesSetor.curso_id"=>$rotuloid,  "EspecialidadesSetor.especialidade_id"=>$especialidadeid);
				$options = array("EspecialidadesSetor.curso_id"=>$rotuloid,  "EspecialidadesSetor.especialidade_id"=>$especialidadeid);
				$this->EspecialidadesSetor->recursive = 2;
				$this->EspecialidadesSetor->Setor->unbindModel(array('hasMany'=>array('Militar','Escala')));
				$this->EspecialidadesSetor->Especialidade->unbindModel(array('hasMany'=>array('Militar')));
				//$this->EspecialidadesSetor->Curso->recursive = 0;
				$this->EspecialidadesSetor->Curso->unbindModel(array('hasMany'=>array('Cursoativo'),'hasAndBelongsToMany'=>array('Militar')));
				//,'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Afastamento','Atividade','Exame','Habilitacao'),'hasAndBelongsToMany'=>array('Escala','Curso')));
				$especialidadesSetors= $this->EspecialidadesSetor->findAll($options);
			//	echo "<pre>";
			//	print_r($especialidadesSetors);
			//	echo "</pre>";
				
				//print_r($especialidadesSetors[0],true).
				$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Especialidade</th><th>Setor</th><th>Curso</th><th>Necessário</th><th>Ações</th></tr>";


				$i = 0;
				foreach ($especialidadesSetors as $especialidadesSetor):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
				$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?\" ,\"javascript:excluiRegistro(".$especialidadesSetor['EspecialidadesSetor']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

				$mensagem .= "	<tr {$class}><td>{$especialidadesSetor['Especialidade']['Quadro']['sigla_quadro']} - {$especialidadesSetor['Especialidade']['nm_especialidade']}</td><td>{$especialidadesSetor['Setor']['Unidade']['sigla_unidade']}-{$especialidadesSetor['Setor']['sigla_setor']}</td><td>{$especialidadesSetor['Curso']['codigo']}</td><td>{$especialidadesSetor['EspecialidadesSetor']['necessario']}</td><td>{$acao}</td></tr>";

				endforeach;
				$mensagem.="</table>";
				
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();

		
	}

	function delete($id = null, $filtro = null) {
		if (!$id) {
			$ok=0;
			exit();
		}
		if ($this->EspecialidadesSetor->delete($id)) {
			$ok=1;
				
			$options = array("EspecialidadesSetor.rotulo_id"=>$filtro);
			$this->EspecialidadesSetor->recursive = 2;
			$this->EspecialidadesSetor->Setor->unbindModel(array('hasMany'=>array('Militar','Escala')));
			$this->EspecialidadesSetor->Especialidade->unbindModel(array('hasMany'=>array('Militar')));
			$this->EspecialidadesSetor->Curso->unbindModel(array('hasMany'=>array('Cursoativo'),'hasAndBelongsToMany'=>array('Militar')));
			$especialidadesSetors= $this->EspecialidadesSetor->findAll($options);


			$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Especialidade</th><th>Setor</th><th></th><th>Necessário</th><th>Ações</th></tr>";


			$i = 0;
			foreach ($especialidadesSetors as $especialidadesSetor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}

			//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
			$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?\" ,\"javascript:excluiRegistro(".$especialidadesSetor['EspecialidadesSetor']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

			$mensagem .= "	<tr {$class}><td>{$especialidadesSetor['Especialidade']['Quadro']['sigla_quadro']} - {$especialidadesSetor['Especialidade']['nm_especialidade']}</td><td>{$especialidadesSetor['Setor']['Unidade']['sigla_unidade']}-{$especialidadesSetor['Setor']['sigla_setor']}</td><td>{$especialidadesSetor['Rotulo']['rotulo']}</td><td>{$especialidadesSetor['EspecialidadesSetor']['necessario']}</td><td>{$acao}</td></tr>";
			endforeach;
			$mensagem.="</table>";
		}

		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();

		//$this->redirect(array('action'=>'index'));
	}

	function indexExcel($id = null, $consulta = null)
	{

		$this->layout = 'openoffice' ;
		$titulo = 'Calendário de Cursos ofertados';
		$tabela = 'indicados';
		$nome = 'planilha_cursos_ofertados';

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