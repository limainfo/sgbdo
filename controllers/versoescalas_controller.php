<?php
class VersoescalasController extends AppController {

	var $name = 'Versoescalas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Versoescala->recursive = 0;
		$this->set('versoescalas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Versoescala.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('versoescala', $this->Versoescala->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Versoescala->create();
			if ($this->Versoescala->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Versoescala foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Versoescala não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$escalasmonths = $this->Versoescala->Escalasmonth->find('list');
		$this->set(compact('escalasmonths'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Versoescala', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Versoescala->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Versoescala foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Versoescala não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Versoescala->read(null, $id);
		}
		$escalasmonths = $this->Versoescala->Escalasmonth->find('list');
		$this->set(compact('escalasmonths'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Versoescala', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Versoescala->delete($id)) {
			$this->Session->setFlash(__('Versoescala excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>