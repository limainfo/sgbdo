<?php
class CidadesController extends AppController {

	var $name = 'Cidades';

	function index() {
		uses('sanitize');
                //print_r($this->data);
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		//$findUrl = low(trim($this->data['formFind']['find']));
		if ( !empty($findUrl) ) {
			$this->Cidade->recursive = 2;
			$opcoes = " LOWER(`Cidade`.`nome`) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Cidade->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Cidade->recursive = 1;
			$this->set('cidades', $this->paginate('Cidade',array(" LOWER(`Cidade`.`nome`) LIKE '%" . $findUrl ."%'  ")));
		} else {
			$this->Cidade->recursive = 2;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
                                    $registros = $this->Cidade->find('all');
                                    $qtdPaginas = $this->data['formFind']['paginas'];
                                    $this->data['formFind']['paginas'] = count($registros);
                                }
                            $this->paginate['limit'] = $this->data['formFind']['paginas'];
                        }
                        $this->data['formFind']['paginas'] = $this->paginate['limit'];
                        $this->Cidade->recursive = 2;
                        $this->set('cidades', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela cidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cidade', $this->Cidade->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cidade->create();
			if ($this->Cidade->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Cidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Cidade",now(),"Cidade", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Cidade->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela cidade foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela cidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$estados = $this->Cidade->Estado->find('list');
		$this->set(compact('estados'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela cidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from cidades Cidade where Cidade.id='.$id;
		$dadoslog=$this->Cidade->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Cidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Cidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Cidade",now(),"Cidade", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Cidade->query($monitora);
		
		
		
			if ($this->Cidade->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela cidade foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela cidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cidade->read(null, $id);
		}
		$estados = $this->Cidade->Estado->find('list');
		$this->set(compact('estados'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela cidade não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from cidades Cidade where Cidade.id='.$id;
		$dadoslog=$this->Cidade->query($consultalog);
		foreach($dadoslog[0]['Cidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Cidade",now(),"Cidade", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Cidade->query($monitora);
		
		
		
		
		
		if ($this->Cidade->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Cidade excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Cidade não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>