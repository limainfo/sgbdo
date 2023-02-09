<?php
class CumprimentoescalasController extends AppController {

	var $name = 'Cumprimentoescalas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Cumprimentoescala->recursive = 0;
		$this->set('cumprimentoescalas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Cumprimentoescala.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('cumprimentoescala', $this->Cumprimentoescala->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cumprimentoescala->create();
			if ($this->Cumprimentoescala->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Cumprimentoescala foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Cumprimentoescala não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$escalasmonths = $this->Cumprimentoescala->Escalasmonth->find('list');
		$this->set(compact('escalasmonths'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Cumprimentoescala', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cumprimentoescala->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Cumprimentoescala foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Cumprimentoescala não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cumprimentoescala->read(null, $id);
		}
		$escalasmonths = $this->Cumprimentoescala->Escalasmonth->find('list');
		$this->set(compact('escalasmonths'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Cumprimentoescala', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cumprimentoescala->delete($id)) {
			$this->Session->setFlash(__('Cumprimentoescala excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>