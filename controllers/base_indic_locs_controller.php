<?php
class BaseIndicLocsController extends AppController {

	var $name = 'BaseIndicLocs';

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
		
		$esquema = $this->BaseIndicLoc->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`BaseIndicLoc`.``) LIKE '%" . $findUrl ."%' OR LOWER(`BaseIndicLoc`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->BaseIndicLoc->recursive = 1;
			//$this->BaseIndicLoc->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('baseIndicLocs', $this->paginate('BaseIndicLoc',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->BaseIndicLoc->recursive = 1;
			//$this->BaseIndicLoc->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('baseIndicLocs', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela base indic loc não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('baseIndicLoc', $this->BaseIndicLoc->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->BaseIndicLoc->create();
			if ($this->BaseIndicLoc->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['BaseIndicLoc'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em BaseIndicLoc",now(),"BaseIndicLoc", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->BaseIndicLoc->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela base indic loc foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela base indic loc não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela base indic loc não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from baseIndicLocs BaseIndicLoc where BaseIndicLoc.id='.$id;
		$dadoslog=$this->BaseIndicLoc->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['BaseIndicLoc'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['BaseIndicLoc'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em BaseIndicLoc",now(),"BaseIndicLoc", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->BaseIndicLoc->query($monitora);
		
		
		
			if ($this->BaseIndicLoc->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela base indic loc foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela base indic loc não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BaseIndicLoc->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela base indic loc não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from baseIndicLocs BaseIndicLoc where BaseIndicLoc.id='.$id;
		$dadoslog=$this->BaseIndicLoc->query($consultalog);
		foreach($dadoslog[0]['BaseIndicLoc'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de BaseIndicLoc",now(),"BaseIndicLoc", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->BaseIndicLoc->query($monitora);
		
		
		
		
		
		if ($this->BaseIndicLoc->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Base indic loc excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Base indic loc não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->BaseIndicLoc->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->BaseIndicLoc->query('select * from baseIndicLocs BaseIndicLoc where '.$filtro);
		$campos_busca = $this->BaseIndicLoc->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de BaseIndicLoc';
		$tabela = 'BaseIndicLoc';
		$nome = 'planilha_BaseIndicLoc';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>