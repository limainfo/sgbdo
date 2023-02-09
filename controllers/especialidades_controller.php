<?php
class EspecialidadesController extends AppController {

	var $name = 'Especialidades';

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
		
		$esquema = $this->Especialidade->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Especialidade`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Especialidade`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Especialidade->recursive = 1;
			//$this->Especialidade->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('especialidades', $this->paginate('Especialidade',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Especialidade->recursive = 1;
			//$this->Especialidade->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('especialidades', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela especialidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('especialidade', $this->Especialidade->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Especialidade->create();
			if ($this->Especialidade->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Especialidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Especialidade",now(),"Especialidade", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Especialidade->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela especialidade foram armazenados.', true));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela especialidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$quadros = $this->Especialidade->Quadro->find('list');
		$this->set(compact('quadros'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela especialidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from especialidades Especialidade where Especialidade.id='.$id;
		$dadoslog=$this->Especialidade->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Especialidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Especialidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Especialidade",now(),"Especialidade", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Especialidade->query($monitora);
		
		
		
			if ($this->Especialidade->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela especialidade foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela especialidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Especialidade->read(null, $id);
		}
		$quadros = $this->Especialidade->Quadro->find('list');
		$this->set(compact('quadros'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela especialidade não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from especialidades Especialidade where Especialidade.id='.$id;
		$dadoslog=$this->Especialidade->query($consultalog);
		foreach($dadoslog[0]['Especialidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Especialidade",now(),"Especialidade", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Especialidade->query($monitora);
		
		
		
		
		
		if ($this->Especialidade->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Especialidade excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Especialidade não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Especialidade->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Especialidade->query('select * from especialidades Especialidade where '.$filtro);
		$campos_busca = $this->Especialidade->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Especialidade';
		$tabela = 'Especialidade';
		$nome = 'planilha_Especialidade';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>