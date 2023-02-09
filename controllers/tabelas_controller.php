<?php
class TabelasController extends AppController {

	var $name = 'Tabelas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Tabela->recursive = 0;
		$this->set('tabelas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Tabela.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tabela', $this->Tabela->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tabela->create();
			if ($this->Tabela->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Tabela foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Tabela não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$privilegios = $this->Tabela->Privilegio->find('list');
		$this->set(compact('privilegios'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tabela', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tabela->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Tabela foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Tabela não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tabela->read(null, $id);
		}
		$privilegios = $this->Tabela->Privilegio->find('list');
		$this->set(compact('privilegios'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Tabela', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tabela->delete($id)) {
			$this->Session->setFlash(__('Tabela excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>