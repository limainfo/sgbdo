<?php
class CursosRotulosController extends AppController {

	var $name = 'CursosRotulos';
	var $helpers = array('Html', 'Form');

	function index() {

		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
		if ( $findUrl != '' ) {
			$this->CursosRotulo->recursive = 0;
			$this->set('cursosRotulos', $this->paginate());
		} else {
			$this->CursosRotulo->recursive = 0;
			$this->set('cursosRotulos', $this->paginate());
		}

	}

	function view($id = null) {
		$this->layout = 'admin';

		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  CursosRotulo.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->CursosRotulo->recursive = 2;
		$this->set('cursosRotulo', $this->CursosRotulo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CursosRotulo->create();
			if ($this->CursosRotulo->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  CursosRotulo foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de CursosRotulo não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$rotulos = $this->CursosRotulo->Rotulo->find('list');
		$cursos = $this->CursosRotulo->Curso->find('list');
		$this->set(compact('rotulos', 'cursos'));
	}

	function edit($id = null) {
		$mensagem="";
		$ok='0';
		if (!empty($this->data)) {
			unset($this->data['Complemento']);
			if ($this->CursosRotulo->save($this->data)) {
				$ok='1';
			}
		}
		
				$options = array("CursosRotulo.rotulo_id"=>$id);
				$this->CursosRotulo->recursive = 1;
				$cursosrotulos= $this->CursosRotulo->findAll($options);

				$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Rótulo</th><th>Curso</th><th>Necessário</th><th>Ações</th></tr>";


				$i = 0;
				foreach ($cursosrotulos as $cursosrotulo):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$cursosrotulo['Rotulo']['rotulo'].'-'.$cursosrotulo['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$cursosrotulo['CursosRotulo']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				$acao .= "<img border=\"0\" onclick=\"exibe('".$cursosrotulo['CursosRotulo']['id']."' ,'".$cursosrotulo['CursosRotulo']['rotulo_id']."' ,'".$cursosrotulo['CursosRotulo']['curso_id']."' ,'".$cursosrotulo['Rotulo']['rotulo']."', '".$cursosrotulo['Curso']['codigo']."', '".$cursosrotulo['CursosRotulo']['necessario']."');\" title=\"Editar\" alt=\"Editar\" src=\"".$this->webroot."img/lapis.gif\"/>";
				$mensagem .= "	<tr {$class}><td>{$cursosrotulo['Rotulo']['rotulo']}</td><td>{$cursosrotulo['Curso']['codigo']}</td><td>{$cursosrotulo['CursosRotulo']['necessario']}</td><td>{$acao}</td></tr>";

				endforeach;
				$mensagem.="</table>";
		
				
		header('Content-type: application/x-json');

		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();
		
	}

	function delete($id = null, $filtro = null) {
		if (!$id) {
			$ok=0;
			exit();
		}
		if ($this->CursosRotulo->delete($id)) {
			$ok='1';

			$options = array("CursosRotulo.rotulo_id"=>$filtro);
			$this->CursosRotulo->recursive = 1;
			$cursosrotulos= $this->CursosRotulo->findAll($options);
			//unset($cursosrotulos[0]['Especialidade']['Militar']);

			//print_r($cursosrotulos[0],true).
			$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Rótulo</th><th>Curso</th><th>Necessário</th><th>Ações</th></tr>";


			$i = 0;
			foreach ($cursosrotulos as $cursosrotulo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}

			//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
			$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$cursosrotulo['Rotulo']['rotulo'].'-'.$cursosrotulo['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$cursosrotulo['CursosRotulo']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

			$mensagem .= "	<tr {$class}><td>{$cursosrotulo['Rotulo']['rotulo']}</td><td>{$cursosrotulo['Curso']['codigo']}</td><td>{$cursosrotulo['CursosRotulo']['necessario']}</td><td>{$acao}</td></tr>";

			endforeach;
			$mensagem.="</table>";
				
		}
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();
	}
	function verso($filtro = null) {
		$mensagem="";
		$ok='0';
		if (!empty($this->data)) {
			$this->CursosRotulo->create();
			if ($this->CursosRotulo->save($this->data)) {
				$ok='1';
			}
		}

				$options = array("CursosRotulo.rotulo_id"=>$filtro);
				$this->CursosRotulo->recursive = 1;
				$cursosrotulos= $this->CursosRotulo->findAll($options);

				$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Rótulo</th><th>Curso</th><th>Necessário</th><th>Ações</th></tr>";


				$i = 0;
				foreach ($cursosrotulos as $cursosrotulo):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$cursosrotulo['Rotulo']['rotulo'].'-'.$cursosrotulo['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$cursosrotulo['CursosRotulo']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				$acao .= "<img border=\"0\" onclick=\"exibe('".$cursosrotulo['CursosRotulo']['id']."' ,'".$cursosrotulo['CursosRotulo']['rotulo_id']."' ,'".$cursosrotulo['CursosRotulo']['curso_id']."' ,'".$cursosrotulo['Rotulo']['rotulo']."', '".$cursosrotulo['Curso']['codigo']."', '".$cursosrotulo['CursosRotulo']['necessario']."');\" title=\"Editar\" alt=\"Editar\" src=\"".$this->webroot."img/lapis.gif\"/>";
				$mensagem .= "	<tr {$class}><td>{$cursosrotulo['Rotulo']['rotulo']}</td><td>{$cursosrotulo['Curso']['codigo']}</td><td>{$cursosrotulo['CursosRotulo']['necessario']}</td><td>{$acao}</td></tr>";

				endforeach;
				$mensagem.="</table>";
		
		header('Content-type: application/x-json');

		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();
		
		

	}


}
?>
<?php
/*
 * 				$options = array("CursosRotulo.rotulo_id"=>$filtro);
				$this->CursosRotulo->recursive = 1;
				$cursosrotulos= $this->CursosRotulo->findAll($options);
				//unset($cursosrotulos[0]['Especialidade']['Militar']);

				//print_r($cursosrotulos[0],true).
				$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Rótulo</th><th>Curso</th><th>Necessário</th><th>Ações</th></tr>";


				$i = 0;
				foreach ($cursosrotulos as $cursosrotulo):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
				$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$cursosrotulo['Rotulo']['rotulo'].'-'.$cursosrotulo['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$cursosrotulo['CursosRotulo']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
				$acao .= "<img border=\"0\" onclick=\"exibe('".$cursosrotulo['CursosRotulo']['id']."' ,'".$cursosrotulo['CursosRotulo']['rotulo_id']."' ,'".$cursosrotulo['CursosRotulo']['curso_id']."' ,'".$cursosrotulo['Rotulo']['rotulo']."', '".$cursosrotulo['Curso']['codigo']."', '".$cursosrotulo['CursosRotulo']['necessario']."');\" title=\"Editar\" alt=\"Editar\" src=\"".$this->webroot."img/lapis.gif\"/>";
				$mensagem .= "	<tr {$class}><td>{$cursosrotulo['Rotulo']['rotulo']}</td><td>{$cursosrotulo['Curso']['codigo']}</td><td>{$cursosrotulo['CursosRotulo']['necessario']}</td><td>{$acao}</td></tr>";

				endforeach;
				$mensagem.="</table>";
			}
		}
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();
		
				$ok='1';
 * 
 * */
 
?>