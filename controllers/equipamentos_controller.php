<?php
class EquipamentosController extends AppController {

	var $name = 'Equipamentos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Equipamento->recursive = 0;
		$this->set('equipamentos', $this->paginate());
	}

	function view($valor1 = null, $valor2 = null) {

		$ok='1';

		$this->Equipamento->recursive = 2;
		
		if($militar_id>0){
			$options = array('MilitarsCurso.curso_id'=>$curso_id, 'MilitarsCurso.militar_id'=>$militar_id);
		}else{
			$options = array('MilitarsCurso.curso_id'=>$curso_id);
		}
		$equipamentos= $this->Equipamento->findAll();
		$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Localidade</th><th>Equipamento</th><th>Tipo</th><th>Descrição</th><th>Ações</th></tr>";
		

		$i = 0;
		foreach ($equipamentos as $equipamento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

		$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$equipamento['Equipamento']['nome']." ?\" ,\"javascript:excluiRegistro(".$equipamento['Equipamento']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

				$mensagem .= "	<tr {$class}><td>{$equipamento['Localidade']['sigla_localidade']} {$equipamento['Equipamento']['nome']} - {$equipamento['Equipamento']['tipo']}</td><td>{$equipamento['Equipamento']['descricao']}</td><td>{$acao}</td></tr>";
		
		endforeach;
		$mensagem.="</table>";

		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();

			}

	function add() {
		if (!empty($this->data)) {
			$this->Equipamento->create();
			if ($this->Equipamento->save($this->data)) {
				$this->Session->setFlash(__('The Equipamento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Equipamento could not be saved. Please, try again.', true));
			}
		}
		$localidades = $this->Equipamento->Localidade->find('list');
		$this->set(compact('localidades'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Equipamento', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Equipamento->save($this->data)) {
				$this->Session->setFlash(__('The Equipamento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Equipamento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Equipamento->read(null, $id);
		}
		$localidades = $this->Equipamento->Localidade->find('list');
		$this->set(compact('localidades'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Equipamento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Equipamento->delete($id)) {
			$this->Session->setFlash(__('Equipamento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>