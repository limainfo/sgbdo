<?php
class SetoresassociadosController extends AppController {

	var $name = 'Setoresassociados';

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
		
		$esquema = $this->Setoresassociado->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Setoresassociado`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Setoresassociado`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Setoresassociado->recursive = 1;
			//$this->Setoresassociado->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('setoresassociados', $this->paginate('Setoresassociado',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Setoresassociado->recursive = 1;
			//$this->Setoresassociado->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('setoresassociados', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela setoresassociado não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('setoresassociado', $this->Setoresassociado->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Setoresassociado->create();
			if ($this->Setoresassociado->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Setoresassociado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Setoresassociado",now(),"Setoresassociado", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Setoresassociado->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela setoresassociado foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela setoresassociado não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$setors = $this->Setoresassociado->Setor->find('list');
		$this->set(compact('setors'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela setoresassociado não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from setoresassociados Setoresassociado where Setoresassociado.id='.$id;
		$dadoslog=$this->Setoresassociado->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Setoresassociado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Setoresassociado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Setoresassociado",now(),"Setoresassociado", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Setoresassociado->query($monitora);
		
		
		
			if ($this->Setoresassociado->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela setoresassociado foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela setoresassociado não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setoresassociado->read(null, $id);
		}
		$setors = $this->Setoresassociado->Setor->find('list');
		$this->set(compact('setors'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela setoresassociado não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from setoresassociados Setoresassociado where Setoresassociado.id='.$id;
		$dadoslog=$this->Setoresassociado->query($consultalog);
		foreach($dadoslog[0]['Setoresassociado'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Setoresassociado",now(),"Setoresassociado", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Setoresassociado->query($monitora);
		
		
		
		
		
		if ($this->Setoresassociado->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Setoresassociado excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Setoresassociado não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Setoresassociado->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Setoresassociado->query('select * from setoresassociados Setoresassociado where '.$filtro);
		$campos_busca = $this->Setoresassociado->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Setoresassociado';
		$tabela = 'Setoresassociado';
		$nome = 'planilha_Setoresassociado';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>