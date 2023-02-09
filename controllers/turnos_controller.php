<?php
class TurnosController extends AppController {

	var $name = 'Turnos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Turno->recursive = 0;
		$this->set('turnos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Turno.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('turno', $this->Turno->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Turno->create();
			if ($this->Turno->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Turno foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Turno não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$escalas = $this->Turno->Escala->find('list');
		$this->set(compact('escalas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Turno', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Turno->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Turno foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Turno não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Turno->read(null, $id);
		}
		$escalas = $this->Turno->Escala->find('list');
		$this->set(compact('escalas'));
	}

	function delete($id = null,$escala_id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Turno', true));
			$this->redirect(array('controller'=>'escalas','action'=>'add/'.$escala_id));
		}
		if ($this->Turno->delete($id)) {
			$this->Session->setFlash(__('Turno excluído', true));
			$this->redirect(array('controller'=>'escalas','action'=>'add/'.$escala_id));
		}
	}

}
?>