<?php
class MotivosuspensaosController extends AppController {

	var $name = 'Motivosuspensaos';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Motivosuspensao->recursive = 1;
			$opcoes = "LOWER(`Motivosuspensao`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Motivosuspensao`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Motivosuspensao->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Motivosuspensao->recursive = 1;
			$this->set('motivosuspensaos', $this->paginate('Motivosuspensao',array("LOWER(`Motivosuspensao`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Motivosuspensao`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Motivosuspensao->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Motivosuspensao->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Motivosuspensao->recursive = 1;
		$this->set('motivosuspensaos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela motivosuspensao não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('motivosuspensao', $this->Motivosuspensao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Motivosuspensao->create();
			if ($this->Motivosuspensao->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Motivosuspensao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Motivosuspensao",now(),"Motivosuspensao", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Motivosuspensao->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela motivosuspensao foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela motivosuspensao não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela motivosuspensao não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from motivosuspensaos Motivosuspensao where Motivosuspensao.id='.$id;
		$dadoslog=$this->Motivosuspensao->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Motivosuspensao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Motivosuspensao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Motivosuspensao",now(),"Motivosuspensao", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Motivosuspensao->query($monitora);
		
		
		
			if ($this->Motivosuspensao->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela motivosuspensao foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela motivosuspensao não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Motivosuspensao->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela motivosuspensao não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from motivosuspensaos Motivosuspensao where Motivosuspensao.id='.$id;
		$dadoslog=$this->Motivosuspensao->query($consultalog);
		foreach($dadoslog[0]['Motivosuspensao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Motivosuspensao",now(),"Motivosuspensao", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Motivosuspensao->query($monitora);
		
		
		
		
		
		if ($this->Motivosuspensao->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Motivosuspensao excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Motivosuspensao não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>