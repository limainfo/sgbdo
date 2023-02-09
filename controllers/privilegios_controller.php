<?php
class PrivilegiosController extends AppController {

	var $name = 'Privilegios';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Privilegio->recursive = 0;
		$this->set('privilegios', $this->paginate());
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Privilegio.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('privilegio', $this->Privilegio->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Privilegio->create();
			if ($this->Privilegio->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Privilegio foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Privilegio não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$tabelas = $this->Privilegio->Tabela->find('list');
		$usuarios = $this->Privilegio->Usuario->find('list');
		$this->set(compact('tabelas', 'usuarios'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Privilegio', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Privilegio->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Privilegio foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Privilegio não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Privilegio->read(null, $id);
		}
		$tabelas = $this->Privilegio->Tabela->find('list');
		$usuarios = $this->Privilegio->Usuario->find('list');
		$this->set(compact('tabelas','usuarios'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Privilegio', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Privilegio->delete($id)) {
			$this->Session->setFlash(__('Privilegio excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>