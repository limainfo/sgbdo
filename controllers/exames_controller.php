<?php
class ExamesController extends AppController {

	var $name = 'Exames';

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
		
		$esquema = $this->Exame->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Exame`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Exame`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Exame->recursive = 1;
			//$this->Exame->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('exames', $this->paginate('Exame',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Exame->recursive = 1;
			//$this->Exame->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('exames', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela exame não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('exame', $this->Exame->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Exame->create();
			if ($this->Exame->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Exame'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Exame",now(),"Exame", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Exame->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela exame foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela exame não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$militars = $this->Exame->Militar->find('list');
		$this->set(compact('militars'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela exame não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from exames Exame where Exame.id='.$id;
		$dadoslog=$this->Exame->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Exame'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Exame'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Exame",now(),"Exame", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Exame->query($monitora);
		
		
		
			if ($this->Exame->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela exame foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela exame não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Exame->read(null, $id);
		}
		$militars = $this->Exame->Militar->find('list');
		$this->set(compact('militars'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela exame não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from exames Exame where Exame.id='.$id;
		$dadoslog=$this->Exame->query($consultalog);
		foreach($dadoslog[0]['Exame'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Exame",now(),"Exame", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Exame->query($monitora);
		
		
		
		
		
		if ($this->Exame->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Exame excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Exame não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Exame->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Exame->query('select * from exames Exame where '.$filtro);
		$campos_busca = $this->Exame->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Exame';
		$tabela = 'Exame';
		$nome = 'planilha_Exame';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>