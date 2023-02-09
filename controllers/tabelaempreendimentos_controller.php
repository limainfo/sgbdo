<?php
class TabelaempreendimentosController extends AppController {

	var $name = 'Tabelaempreendimentos';
	var $helpers = array('Html', 'Form');

	function index() {

		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
		if ( $findUrl != '' ) {
			$this->Tabelaempreendimento->recursive = 0;
			$this->set('tabelaempreendimentos', $this->paginate());	
		} else {
			$this->Tabelaempreendimento->recursive = 0;
			$this->set('tabelaempreendimentos', $this->paginate());
		}
	
	}

	function view($id = null) {
		$this->layout = 'admin';

		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Tabelaempreendimento.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tabelaempreendimento', $this->Tabelaempreendimento->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tabelaempreendimento->create();
			if ($this->Tabelaempreendimento->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Tabelaempreendimento foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Tabelaempreendimento não foram gravados. Por favor, tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tabelaempreendimento', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tabelaempreendimento->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Tabelaempreendimento foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Tabelaempreendimento não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tabelaempreendimento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Tabelaempreendimento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tabelaempreendimento->delete($id)) {
			$this->Session->setFlash(__('Tabelaempreendimento excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>