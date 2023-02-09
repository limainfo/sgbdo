<?php
class EmpresasController extends AppController {

	var $name = 'Empresas';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Empresa->recursive = 1;
			$opcoes = "LOWER(`Empresa`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Empresa`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Empresa->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Empresa->recursive = 1;
			$this->set('empresas', $this->paginate('Empresa',array("LOWER(`Empresa`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Empresa`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Empresa->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Empresa->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Empresa->recursive = 1;
		$this->set('empresas', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela empresa não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('empresa', $this->Empresa->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Empresa->create();
			if ($this->Empresa->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Empresa'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Empresa",now(),"Empresa", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Empresa->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela empresa foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela empresa não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela empresa não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from empresas Empresa where Empresa.id='.$id;
		$dadoslog=$this->Empresa->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Empresa'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Empresa'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Empresa",now(),"Empresa", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Empresa->query($monitora);
		
		
		
			if ($this->Empresa->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela empresa foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela empresa não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Empresa->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela empresa não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from empresas Empresa where Empresa.id='.$id;
		$dadoslog=$this->Empresa->query($consultalog);
		foreach($dadoslog[0]['Empresa'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Empresa",now(),"Empresa", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Empresa->query($monitora);
		
		
		
		
		
		if ($this->Empresa->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Empresa excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Empresa não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>