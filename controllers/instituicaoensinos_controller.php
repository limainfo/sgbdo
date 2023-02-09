<?php
class InstituicaoensinosController extends AppController {

	var $name = 'Instituicaoensinos';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Instituicaoensino->recursive = 1;
			$opcoes = "LOWER(`Instituicaoensino`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Instituicaoensino`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Instituicaoensino->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Instituicaoensino->recursive = 1;
			$this->set('instituicaoensinos', $this->paginate('Instituicaoensino',array("LOWER(`Instituicaoensino`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Instituicaoensino`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Instituicaoensino->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Instituicaoensino->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Instituicaoensino->recursive = 1;
		$this->set('instituicaoensinos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela instituicaoensino não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('instituicaoensino', $this->Instituicaoensino->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Instituicaoensino->create();
			if ($this->Instituicaoensino->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Instituicaoensino'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Instituicaoensino",now(),"Instituicaoensino", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Instituicaoensino->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela instituicaoensino foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela instituicaoensino não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela instituicaoensino não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from instituicaoensinos Instituicaoensino where Instituicaoensino.id='.$id;
		$dadoslog=$this->Instituicaoensino->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Instituicaoensino'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Instituicaoensino'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Instituicaoensino",now(),"Instituicaoensino", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Instituicaoensino->query($monitora);
		
		
		
			if ($this->Instituicaoensino->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela instituicaoensino foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela instituicaoensino não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Instituicaoensino->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela instituicaoensino não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from instituicaoensinos Instituicaoensino where Instituicaoensino.id='.$id;
		$dadoslog=$this->Instituicaoensino->query($consultalog);
		foreach($dadoslog[0]['Instituicaoensino'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Instituicaoensino",now(),"Instituicaoensino", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Instituicaoensino->query($monitora);
		
		
		
		
		
		if ($this->Instituicaoensino->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Instituicaoensino excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Instituicaoensino não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>