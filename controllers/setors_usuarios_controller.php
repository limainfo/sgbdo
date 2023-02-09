<?php
class SetorsUsuariosController extends AppController {

	var $name = 'SetorsUsuarios';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->SetorsUsuario->recursive = 0;
		$this->set('setorsUsuarios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  SetorsUsuario.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('setorsUsuario', $this->SetorsUsuario->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SetorsUsuario->create();
			if ($this->SetorsUsuario->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  SetorsUsuario foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de SetorsUsuario não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$usuarios = $this->SetorsUsuario->Usuario->find('list');
		$setors = $this->SetorsUsuario->Setor->find('list');
		$this->set(compact('usuarios', 'setors'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid SetorsUsuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->SetorsUsuario->save($this->data)) {
				$this->Session->setFlash(__('Os dados de SetorsUsuario foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de SetorsUsuario não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SetorsUsuario->read(null, $id);
		}
		$usuarios = $this->SetorsUsuario->Usuario->find('list');
		$setors = $this->SetorsUsuario->Setor->find('list');
		$this->set(compact('usuarios','setors'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para SetorsUsuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SetorsUsuario->delete($id)) {
			$this->Session->setFlash(__('SetorsUsuario excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>