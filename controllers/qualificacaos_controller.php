<?php
class QualificacaosController extends AppController {

	var $name = 'Qualificacaos';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Qualificacao->recursive = 1;
			$opcoes = "LOWER(`Qualificacao`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Qualificacao`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Qualificacao->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Qualificacao->recursive = 1;
			$this->set('qualificacaos', $this->paginate('Qualificacao',array("LOWER(`Qualificacao`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Qualificacao`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Qualificacao->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Qualificacao->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Qualificacao->recursive = 1;
		$this->set('qualificacaos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela qualificacao não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('qualificacao', $this->Qualificacao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Qualificacao->create();
			if ($this->Qualificacao->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Qualificacao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Qualificacao",now(),"Qualificacao", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Qualificacao->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela qualificacao foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela qualificacao não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela qualificacao não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from qualificacaos Qualificacao where Qualificacao.id='.$id;
		$dadoslog=$this->Qualificacao->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Qualificacao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Qualificacao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Qualificacao",now(),"Qualificacao", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Qualificacao->query($monitora);
		
		
		
			if ($this->Qualificacao->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela qualificacao foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela qualificacao não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Qualificacao->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela qualificacao não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from qualificacaos Qualificacao where Qualificacao.id='.$id;
		$dadoslog=$this->Qualificacao->query($consultalog);
		foreach($dadoslog[0]['Qualificacao'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Qualificacao",now(),"Qualificacao", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Qualificacao->query($monitora);
		
		
		
		
		
		if ($this->Qualificacao->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Qualificacao excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Qualificacao não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>