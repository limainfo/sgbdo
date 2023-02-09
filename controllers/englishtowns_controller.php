<?php
class EnglishtownsController extends AppController {

	var $name = 'Englishtowns';

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
		
		$esquema = $this->Englishtown->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Englishtown`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Englishtown`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Englishtown->recursive = 1;
			//$this->Englishtown->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('englishtowns', $this->paginate('Englishtown',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Englishtown->recursive = 1;
			//$this->Englishtown->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('englishtowns', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela englishtown não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('englishtown', $this->Englishtown->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Englishtown->create();
			if ($this->Englishtown->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Englishtown'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Englishtown",now(),"Englishtown", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Englishtown->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela englishtown foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela englishtown não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$militars = $this->Englishtown->Militar->find('list');
		$this->set(compact('militars'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela englishtown não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from englishtowns Englishtown where Englishtown.id='.$id;
		$dadoslog=$this->Englishtown->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Englishtown'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Englishtown'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Englishtown",now(),"Englishtown", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Englishtown->query($monitora);
		
		
		
			if ($this->Englishtown->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela englishtown foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela englishtown não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Englishtown->read(null, $id);
		}
		$militars = $this->Englishtown->Militar->find('list');
		$this->set(compact('militars'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela englishtown não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from englishtowns Englishtown where Englishtown.id='.$id;
		$dadoslog=$this->Englishtown->query($consultalog);
		foreach($dadoslog[0]['Englishtown'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Englishtown",now(),"Englishtown", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Englishtown->query($monitora);
		
		
		
		
		
		if ($this->Englishtown->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Englishtown excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Englishtown não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Englishtown->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Englishtown->query('select * from englishtowns Englishtown where '.$filtro);
		$campos_busca = $this->Englishtown->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Englishtown';
		$tabela = 'Englishtown';
		$nome = 'planilha_Englishtown';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>