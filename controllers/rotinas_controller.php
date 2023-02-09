<?php
class RotinasController extends AppController {

	var $name = 'Rotinas';

	function index() {
	/*
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
	*/	
		$findUrl = decodeURIComponent($this->data['formFind']['find']);
		$findUrl = str_replace('||','%',$findUrl);
		
		
		$opcoes = $findUrl;
		
		$esquema = $this->Rotina->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Rotina`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Rotina`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Rotina->recursive = 1;
			//$this->Rotina->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('rotinas', $this->paginate('Rotina',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Rotina->recursive = 1;
			//$this->Rotina->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('rotinas', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela rotina não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rotina', $this->Rotina->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Rotina->create();
			if ($this->Rotina->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Rotina'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Rotina",now(),"Rotina", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Rotina->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela rotina foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela rotina não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$setors = $this->Rotina->Setor->find('list');
		$periodicidades = $this->Rotina->Periodicidade->find('list');
		$this->set(compact('setors', 'periodicidades'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela rotina não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from rotinas Rotina where Rotina.id='.$id;
		$dadoslog=$this->Rotina->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Rotina'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Rotina'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Rotina",now(),"Rotina", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Rotina->query($monitora);
		
		
		
			if ($this->Rotina->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela rotina foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela rotina não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Rotina->read(null, $id);
		}
		$setors = $this->Rotina->Setor->find('list');
		$periodicidades = $this->Rotina->Periodicidade->find('list');
		$this->set(compact('setors', 'periodicidades'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela rotina não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from rotinas Rotina where Rotina.id='.$id;
		$dadoslog=$this->Rotina->query($consultalog);
		foreach($dadoslog[0]['Rotina'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Rotina",now(),"Rotina", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Rotina->query($monitora);
		
		
		
		
		
		if ($this->Rotina->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Rotina excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Rotina não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Rotina->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Rotina->query('select * from rotinas Rotina where '.$filtro);
		$campos_busca = $this->Rotina->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Rotina';
		$tabela = 'Rotina';
		$nome = 'planilha_Rotina';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>