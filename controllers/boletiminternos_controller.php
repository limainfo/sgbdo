<?php
class BoletiminternosController extends AppController {

	var $name = 'Boletiminternos';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Boletiminterno->recursive = 1;
			$opcoes = "LOWER(`Boletiminterno`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Boletiminterno`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Boletiminterno->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Boletiminterno->recursive = 1;
			$this->set('boletiminternos', $this->paginate('Boletiminterno',array("LOWER(`Boletiminterno`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Boletiminterno`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Boletiminterno->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Boletiminterno->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Boletiminterno->recursive = 1;
		$this->set('boletiminternos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela boletiminterno não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('boletiminterno', $this->Boletiminterno->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Boletiminterno->create();
			if ($this->Boletiminterno->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Boletiminterno'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Boletiminterno",now(),"Boletiminterno", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Boletiminterno->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela boletiminterno foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela boletiminterno não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$unidades = $this->Boletiminterno->Unidade->find('list');
		$this->set(compact('unidades'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela boletiminterno não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from boletiminternos Boletiminterno where Boletiminterno.id='.$id;
		$dadoslog=$this->Boletiminterno->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Boletiminterno'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Boletiminterno'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Boletiminterno",now(),"Boletiminterno", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Boletiminterno->query($monitora);
		
		
		
			if ($this->Boletiminterno->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela boletiminterno foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela boletiminterno não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Boletiminterno->read(null, $id);
		}
		$unidades = $this->Boletiminterno->Unidade->find('list');
		$this->set(compact('unidades'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela boletiminterno não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from boletiminternos Boletiminterno where Boletiminterno.id='.$id;
		$dadoslog=$this->Boletiminterno->query($consultalog);
		foreach($dadoslog[0]['Boletiminterno'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Boletiminterno",now(),"Boletiminterno", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Boletiminterno->query($monitora);
		
		
		
		
		
		if ($this->Boletiminterno->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Boletiminterno excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Boletiminterno não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>