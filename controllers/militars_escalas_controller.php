<?php
class MilitarsEscalasController extends AppController {

	var $name = 'MilitarsEscalas';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');


	function indexEmbutido($idEscala) {
		$this->layout = 'embutido';
		$this->MilitarsEscala->recursive = 0;
		$this->set('militarsEscalas', $this->MilitarsEscala->findByEscalaId($idEscala));
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Militar/Escala.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('militarsEscala', $this->MilitarsEscala->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MilitarsEscala->create();
			if ($this->MilitarsEscala->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Militar/Escala foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Militar/Escala não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$escalas = $this->MilitarsEscala->Escala->find('list');
		$militars = $this->MilitarsEscala->Militar->find('list');
		$this->set(compact('escalas', 'militars'));
	}
	
	function addAjax() {
		$this->layout = 'ajax_embutido';
		if (!empty($this->data)) {
			$this->MilitarsEscala->create();
			if ($this->MilitarsEscala->save($this->data)) {
				$mensagem = 'Os dados de  Militar/Escala foram gravados.';
				$this->data['MilitarsEscala']['mensagem'] = $mensagem;
			} else {
				$mensagem = 'Os dados de Militar/Escala não foram gravados. Por favor, tente novamente.';
				$this->data['MilitarsEscala']['mensagem'] = $mensagem;
			}
		}
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Militar/Escala Inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->MilitarsEscala->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Militar/Escala foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Militar/Escala não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MilitarsEscala->read(null, $id);
		}
		$escalas = $this->MilitarsEscala->Escala->find('list');
		$militars = $this->MilitarsEscala->Militar->find('list');
		$this->set(compact('escalas','militars'));
	}

	function delete($id = null) {
			$this->redirect(array('action'=>'index'));
		/*
		 * 
		 if (!$id) {
			$this->Session->setFlash(__('ID inválido para Militar/Escala', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MilitarsEscala->delete($id)) {
			$this->Session->setFlash(__('MilitarsEscala excluído', true));
			$this->redirect(array('action'=>'index'));
		}
		*/
	}
function externoconsulta($id = null) {
        $this->layout = null;
        $this->MilitarsEscala->recursive = 0;
        header('Content-type: application/x-json');

        $sql = "select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id
        FROM militars_escalas as MilitarsEscala
        INNER JOIN militars as Militar on (Militar.id=MilitarsEscala.militar_id)
        INNER JOIN escalas as Escala on (Escala.id=MilitarsEscala.escala_id)
        INNER JOIN setors as Setor on (Escala.setor_id = Setor.id)
        INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
        where MilitarsEscala.militar_id={$this->data['Controlehora']['militar_id']}
        group by Setor.id
        order by  Unidade.sigla_unidade, Setor.sigla_setor asc 
        ";

//        echo $sql;
        
        $dados = $this->MilitarsEscala->query($sql);
        
        foreach($dados as $dado){
            $militars[$dado['Setor']['id']]=$dado['Unidade']['sigla_unidade'].'-'.$dado['Setor']['sigla_setor'];
            echo "<option value='{$dado['Setor']['id']}'>{$militars[$dado['Setor']['id']]}</option>";
        }
        
//              echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';

        exit();
}
	

}
?>