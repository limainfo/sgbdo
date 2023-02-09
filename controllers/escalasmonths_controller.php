<?php
class EscalasmonthsController extends AppController {

	var $name = 'Escalasmonths';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Escalasmonth->recursive = 0;
		$this->set('escalasmonths', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Escalasmonth.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('escalasmonth', $this->Escalasmonth->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Escalasmonth->create();
			if ($this->Escalasmonth->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Escalasmonth foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Escalasmonth não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$escalas = $this->Escalasmonth->Escala->find('list');
		$this->set(compact('escalas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Escalasmonth', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Escalasmonth->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Escalasmonth foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Escalasmonth não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Escalasmonth->read(null, $id);
		}
		$escalas = $this->Escalasmonth->Escala->find('list');
		$this->set(compact('escalas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Escalasmonth', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Escalasmonth->delete($id)) {
			$this->Session->setFlash(__('Escalasmonth excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>