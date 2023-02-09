<?php
class EstadosController extends AppController {

	var $name = 'Estados';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Estado->recursive = 1;
			$opcoes = " LOWER(`Estado`.`nome`) LIKE '%" . $findUrl ."%' OR LOWER(`Estado`.`uf`) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Estado->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Estado->recursive = 1;
			$this->set('estados', $this->paginate('Estado',array("LOWER(`Estado`.`nome`) LIKE '%" . $findUrl ."%' OR LOWER(`Estado`.`uf`) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Estado->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Estado->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Estado->recursive = 1;
		$this->set('estados', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela estado não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
                $this->Estado->recursive=1;
		$this->set('estado', $this->Estado->findById($id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Estado->create();
			if ($this->Estado->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Estado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Estado",now(),"Estado", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Estado->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela estado foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela estado não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$paises = $this->Estado->Paise->find('list');
		$this->set(compact('paises'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela estado não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from estados Estado where Estado.id='.$id;
		$dadoslog=$this->Estado->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Estado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Estado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Estado",now(),"Estado", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Estado->query($monitora);
		
		
		
			if ($this->Estado->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela estado foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela estado não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Estado->read(null, $id);
		}
		$paises = $this->Estado->Paise->find('list');
		$this->set(compact('paises'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela estado não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from estados Estado where Estado.id='.$id;
		$dadoslog=$this->Estado->query($consultalog);
		foreach($dadoslog[0]['Estado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Estado",now(),"Estado", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Estado->query($monitora);
		
		
		
		
		
		if ($this->Estado->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Estado excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Estado não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>