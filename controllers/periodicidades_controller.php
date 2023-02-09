<?php
class PeriodicidadesController extends AppController {

	var $name = 'Periodicidades';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');

	function index() {
		/*
		$this->Periodicidade->recursive = 0;
		$this->set('periodicidades', $this->paginate());
*/
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Periodicidade.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('periodicidade', $this->Periodicidade->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Periodicidade->create();
			if ($this->Periodicidade->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Periodicidade foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Periodicidade não foram gravados. Por favor, tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Periodicidade', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Periodicidade->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Periodicidade foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Periodicidade não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Periodicidade->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Periodicidade', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Periodicidade->delete($id)) {
			$this->Session->setFlash(__('Periodicidade excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>