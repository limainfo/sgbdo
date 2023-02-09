<?php
class AtividadelicencasController extends AppController {

	var $name = 'Atividadelicencas';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Atividadelicenca->recursive = 1;
			$opcoes = "LOWER(`Atividadelicenca`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Atividadelicenca`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Atividadelicenca->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Atividadelicenca->recursive = 1;
			$this->set('atividadelicencas', $this->paginate('Atividadelicenca',array("LOWER(`Atividadelicenca`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Atividadelicenca`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Atividadelicenca->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Atividadelicenca->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Atividadelicenca->recursive = 1;
		$this->set('atividadelicencas', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela atividadelicenca não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('atividadelicenca', $this->Atividadelicenca->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Atividadelicenca->create();
			if ($this->Atividadelicenca->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Atividadelicenca'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Atividadelicenca",now(),"Atividadelicenca", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Atividadelicenca->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela atividadelicenca foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela atividadelicenca não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela atividadelicenca não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from atividadelicencas Atividadelicenca where Atividadelicenca.id='.$id;
		$dadoslog=$this->Atividadelicenca->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Atividadelicenca'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Atividadelicenca'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Atividadelicenca",now(),"Atividadelicenca", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Atividadelicenca->query($monitora);
		
		
		
			if ($this->Atividadelicenca->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela atividadelicenca foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela atividadelicenca não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Atividadelicenca->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela atividadelicenca não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from atividadelicencas Atividadelicenca where Atividadelicenca.id='.$id;
		$dadoslog=$this->Atividadelicenca->query($consultalog);
		foreach($dadoslog[0]['Atividadelicenca'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Atividadelicenca",now(),"Atividadelicenca", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Atividadelicenca->query($monitora);
		
		
		
		
		
		if ($this->Atividadelicenca->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Atividadelicenca excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Atividadelicenca não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>