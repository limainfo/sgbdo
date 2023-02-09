<?php
class AtasController extends AppController {

	var $name = 'Atas';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Ata->recursive = 1;
			$opcoes = "LOWER(`Ata`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Ata`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Ata->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Ata->recursive = 1;
			$this->set('atas', $this->paginate('Ata',array("LOWER(`Ata`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Ata`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Ata->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Ata->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Ata->recursive = 1;
		$this->set('atas', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela ata não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ata', $this->Ata->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ata->create();
			if ($this->Ata->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Ata'] as $chave=>$valor){
			if($chave!='ata'){
				$mudanca .= '['.$chave.']='.$valor.' ,';
			}
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Ata",now(),"Ata", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Ata->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela ata foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela ata não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$unidades = $this->Ata->Unidade->find('list');
		$boletiminternos = $this->Ata->Boletiminterno->find('list');
		$this->set(compact('unidades', 'boletiminternos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela ata não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from atas Ata where Ata.id='.$id;
		$dadoslog=$this->Ata->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Ata'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Ata'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Ata",now(),"Ata", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Ata->query($monitora);
		
		
		
			if ($this->Ata->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela ata foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela ata não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ata->read(null, $id);
		}
		$unidades = $this->Ata->Unidade->find('list');
		$boletiminternos = $this->Ata->Boletiminterno->find('list');
		$this->set(compact('unidades', 'boletiminternos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela ata não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from atas Ata where Ata.id='.$id;
		$dadoslog=$this->Ata->query($consultalog);
		foreach($dadoslog[0]['Ata'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Ata",now(),"Ata", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Ata->query($monitora);
		
		
		
		
		
		if ($this->Ata->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Ata excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Ata não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>