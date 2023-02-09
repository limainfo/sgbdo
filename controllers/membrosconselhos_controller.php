<?php
class MembrosconselhosController extends AppController {

	var $name = 'Membrosconselhos';

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
		
		$esquema = $this->Membrosconselho->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Membrosconselho`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Membrosconselho`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Membrosconselho->recursive = 1;
			//$this->Membrosconselho->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('membrosconselhos', $this->paginate('Membrosconselho',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Membrosconselho->recursive = 1;
			//$this->Membrosconselho->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('membrosconselhos', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela membrosconselho não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('membrosconselho', $this->Membrosconselho->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Membrosconselho->create();
			if ($this->Membrosconselho->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Membrosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Membrosconselho",now(),"Membrosconselho", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Membrosconselho->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela membrosconselho foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela membrosconselho não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$militars = $this->Membrosconselho->Militar->find('list');
		$unidades = $this->Membrosconselho->Unidade->find('list');
		$cargosconselhos = $this->Membrosconselho->Cargosconselho->find('list');
		$this->set(compact('militars', 'unidades', 'cargosconselhos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela membrosconselho não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from membrosconselhos Membrosconselho where Membrosconselho.id='.$id;
		$dadoslog=$this->Membrosconselho->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Membrosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Membrosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Membrosconselho",now(),"Membrosconselho", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Membrosconselho->query($monitora);
		
		
		
			if ($this->Membrosconselho->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela membrosconselho foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela membrosconselho não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Membrosconselho->read(null, $id);
		}
		$militars = $this->Membrosconselho->Militar->find('list');
		$unidades = $this->Membrosconselho->Unidade->find('list');
		$cargosconselhos = $this->Membrosconselho->Cargosconselho->find('list');
		$this->set(compact('militars', 'unidades', 'cargosconselhos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela membrosconselho não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from membrosconselhos Membrosconselho where Membrosconselho.id='.$id;
		$dadoslog=$this->Membrosconselho->query($consultalog);
		foreach($dadoslog[0]['Membrosconselho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Membrosconselho",now(),"Membrosconselho", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Membrosconselho->query($monitora);
		
		
		
		
		
		if ($this->Membrosconselho->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Membrosconselho excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Membrosconselho não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Membrosconselho->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Membrosconselho->query('select * from membrosconselhos Membrosconselho where '.$filtro);
		$campos_busca = $this->Membrosconselho->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Membrosconselho';
		$tabela = 'Membrosconselho';
		$nome = 'planilha_Membrosconselho';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>