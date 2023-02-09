<?php
class LocalidadesController extends AppController {

	var $name = 'Localidades';

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
		
		$esquema = $this->Localidade->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Localidade`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Localidade`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Localidade->recursive = 1;
			//$this->Localidade->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('localidades', $this->paginate('Localidade',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Localidade->recursive = 1;
			//$this->Localidade->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('localidades', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela localidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('localidade', $this->Localidade->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Localidade->create();
			if ($this->Localidade->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Localidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Localidade",now(),"Localidade", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Localidade->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela localidade foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela localidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela localidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from localidades Localidade where Localidade.id='.$id;
		$dadoslog=$this->Localidade->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Localidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Localidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Localidade",now(),"Localidade", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Localidade->query($monitora);
		
		
		
			if ($this->Localidade->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela localidade foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela localidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Localidade->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela localidade não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from localidades Localidade where Localidade.id='.$id;
		$dadoslog=$this->Localidade->query($consultalog);
		foreach($dadoslog[0]['Localidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Localidade",now(),"Localidade", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Localidade->query($monitora);
		
		
		
		
		
		if ($this->Localidade->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Localidade excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Localidade não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Localidade->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Localidade->query('select * from localidades Localidade where '.$filtro);
		$campos_busca = $this->Localidade->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Localidade';
		$tabela = 'Localidade';
		$nome = 'planilha_Localidade';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>