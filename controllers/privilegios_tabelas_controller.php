<?php
class PrivilegiosTabelasController extends AppController {

	var $name = 'PrivilegiosTabelas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->PrivilegiosTabela->recursive = 0;
		$this->set('privilegiosTabelas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  PrivilegiosTabela.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('privilegiosTabela', $this->PrivilegiosTabela->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PrivilegiosTabela->create();
			if ($this->PrivilegiosTabela->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  PrivilegiosTabela foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de PrivilegiosTabela não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$privilegios = $this->PrivilegiosTabela->Privilegio->find('list');
		$tabelas = $this->PrivilegiosTabela->Tabela->find('list');
		$this->set(compact('privilegios', 'tabelas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid PrivilegiosTabela', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrivilegiosTabela->save($this->data)) {
				$this->Session->setFlash(__('Os dados de PrivilegiosTabela foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de PrivilegiosTabela não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrivilegiosTabela->read(null, $id);
		}
		$privilegios = $this->PrivilegiosTabela->Privilegio->find('list');
		$tabelas = $this->PrivilegiosTabela->Tabela->find('list');
		$this->set(compact('privilegios','tabelas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para PrivilegiosTabela', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrivilegiosTabela->delete($id)) {
			$this->Session->setFlash(__('PrivilegiosTabela excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>