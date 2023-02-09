<?php
class OcorrenciastecnicasController extends AppController {

	var $name = 'Ocorrenciastecnicas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Ocorrenciastecnica->recursive = 0;
		$this->set('ocorrenciastecnicas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Ocorrenciastecnica.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ocorrenciastecnica', $this->Ocorrenciastecnica->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ocorrenciastecnica->create();
			if ($this->Ocorrenciastecnica->save($this->data)) {
				$this->Session->setFlash(__('The Ocorrenciastecnica has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Ocorrenciastecnica could not be saved. Please, try again.', true));
			}
		}
		$equipamentos = $this->Ocorrenciastecnica->Equipamento->find('list');
		$this->set(compact('equipamentos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ocorrenciastecnica', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ocorrenciastecnica->save($this->data)) {
				$this->Session->setFlash(__('The Ocorrenciastecnica has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Ocorrenciastecnica could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ocorrenciastecnica->read(null, $id);
		}
		$equipamentos = $this->Ocorrenciastecnica->Equipamento->find('list');
		$this->set(compact('equipamentos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Ocorrenciastecnica', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ocorrenciastecnica->delete($id)) {
			$this->Session->setFlash(__('Ocorrenciastecnica deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>