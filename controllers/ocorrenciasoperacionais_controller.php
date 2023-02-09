<?php
class OcorrenciasoperacionaisController extends AppController {

	var $name = 'Ocorrenciasoperacionais';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Ocorrenciasoperacionai->recursive = 0;
		$this->set('ocorrenciasoperacionais', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Ocorrenciasoperacionai.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ocorrenciasoperacionai', $this->Ocorrenciasoperacionai->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ocorrenciasoperacionai->create();
			if ($this->Ocorrenciasoperacionai->save($this->data)) {
				$this->Session->setFlash(__('The Ocorrenciasoperacionai has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Ocorrenciasoperacionai could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ocorrenciasoperacionai', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ocorrenciasoperacionai->save($this->data)) {
				$this->Session->setFlash(__('The Ocorrenciasoperacionai has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Ocorrenciasoperacionai could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ocorrenciasoperacionai->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Ocorrenciasoperacionai', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ocorrenciasoperacionai->delete($id)) {
			$this->Session->setFlash(__('Ocorrenciasoperacionai deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>