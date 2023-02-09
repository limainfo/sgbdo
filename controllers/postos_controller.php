<?php
class PostosController extends AppController {

	var $name = 'Postos';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Posto->recursive = 1;
			$opcoes = "LOWER(`Posto`.`sigla_posto`) LIKE '%" . $findUrl ."%' OR LOWER(`Posto`.`sigla_compativel`) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Posto->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Posto->recursive = 1;
			$this->set('postos', $this->paginate('Posto',array("LOWER(`Posto`.`sigla_posto`) LIKE '%" . $findUrl ."%' OR LOWER(`Posto`.`sigla_compativel`) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Posto->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Posto->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Posto->recursive = 1;
		$this->set('postos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela posto não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('posto', $this->Posto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Posto->create();
			if ($this->Posto->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Posto'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Posto",now(),"Posto", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Posto->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela posto foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela posto não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela posto não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from postos Posto where Posto.id='.$id;
		$dadoslog=$this->Posto->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Posto'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Posto'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Posto",now(),"Posto", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Posto->query($monitora);
		
		
		
			if ($this->Posto->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela posto foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela posto não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Posto->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela posto não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from postos Posto where Posto.id='.$id;
		$dadoslog=$this->Posto->query($consultalog);
		foreach($dadoslog[0]['Posto'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Posto",now(),"Posto", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Posto->query($monitora);
		
		
		
		
		
		if ($this->Posto->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Posto excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Posto não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>