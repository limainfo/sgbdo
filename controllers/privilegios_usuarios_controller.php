<?php
class PrivilegiosUsuariosController extends AppController {

	var $name = 'PrivilegiosUsuarios';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->PrivilegiosUsuario->recursive = 0;
		$this->set('privilegiosUsuarios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  PrivilegiosUsuario.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('privilegiosUsuario', $this->PrivilegiosUsuario->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PrivilegiosUsuario->create();
			if ($this->PrivilegiosUsuario->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  PrivilegiosUsuario foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de PrivilegiosUsuario não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$usuarios = $this->PrivilegiosUsuario->Usuario->find('list');
		$privilegios = $this->PrivilegiosUsuario->Privilegio->find('list');
		$this->set(compact('usuarios', 'privilegios'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid PrivilegiosUsuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrivilegiosUsuario->save($this->data)) {
				$this->Session->setFlash(__('Os dados de PrivilegiosUsuario foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de PrivilegiosUsuario não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrivilegiosUsuario->read(null, $id);
		}
		$usuarios = $this->PrivilegiosUsuario->Usuario->find('list');
		$privilegios = $this->PrivilegiosUsuario->Privilegio->find('list');
		$this->set(compact('usuarios','privilegios'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para PrivilegiosUsuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrivilegiosUsuario->delete($id)) {
			$this->Session->setFlash(__('PrivilegiosUsuario excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>