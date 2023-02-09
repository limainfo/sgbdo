<?php
class RotulosController extends AppController {

	var $name = 'Rotulos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Rotulo->recursive = 0;
		$this->set('rotulos', $this->paginate());
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Rotulo.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Rotulo->recursive = 2;
		$this->set('rotulo', $this->Rotulo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Rotulo->create();
			if ($this->Rotulo->save($this->data)) {
				$this->Session->setFlash(__('The Rotulo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Rotulo could not be saved. Please, try again.', true));
			}
		}
		$cursos = $this->Rotulo->Curso->find('list');
		$this->set(compact('cursos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Rotulo', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Rotulo->save($this->data)) {
				$this->Session->setFlash(__('The Rotulo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Rotulo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Rotulo->read(null, $id);
		}
		$cursos = $this->Rotulo->Curso->find('list');
		$this->set(compact('cursos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Não há item para excluir!', true));
			$this->redirect(array('action'=>'index'));
		}
	    $condicao = array(""=>$id);
		if ($this->Rotulo->delete($id)) {
			$this->Session->setFlash(__('Registro excluído!', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>