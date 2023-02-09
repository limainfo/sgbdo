<?php
class CargosconselhosController extends AppController {

	var $name = 'Cargosconselhos';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Cargosconselho->recursive = 1;
			$opcoes = "LOWER(`Cargosconselho`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Cargosconselho`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Cargosconselho->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Cargosconselho->recursive = 1;
			$this->set('cargosconselhos', $this->paginate('Cargosconselho',array("LOWER(`Cargosconselho`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Cargosconselho`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Cargosconselho->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Cargosconselho->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Cargosconselho->recursive = 1;
		$this->set('cargosconselhos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela cargosconselho não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cargosconselho', $this->Cargosconselho->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cargosconselho->create();
			if ($this->Cargosconselho->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Cargosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Cargosconselho",now(),"Cargosconselho", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Cargosconselho->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela cargosconselho foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela cargosconselho não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela cargosconselho não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from cargosconselhos Cargosconselho where Cargosconselho.id='.$id;
		$dadoslog=$this->Cargosconselho->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Cargosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Cargosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Cargosconselho",now(),"Cargosconselho", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Cargosconselho->query($monitora);
		
		
		
			if ($this->Cargosconselho->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela cargosconselho foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela cargosconselho não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cargosconselho->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela cargosconselho não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from cargosconselhos Cargosconselho where Cargosconselho.id='.$id;
		$dadoslog=$this->Cargosconselho->query($consultalog);
		foreach($dadoslog[0]['Cargosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Cargosconselho",now(),"Cargosconselho", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Cargosconselho->query($monitora);
		
		
		
		
		
		if ($this->Cargosconselho->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Cargosconselho excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Cargosconselho não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>