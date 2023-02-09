<?php
class ProgramadetrabalhosController extends AppController {

	var $name = 'Programadetrabalhos';

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
		
		$esquema = $this->Programadetrabalho->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Programadetrabalho`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Programadetrabalho`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Programadetrabalho->recursive = 1;
			//$this->Programadetrabalho->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('programadetrabalhos', $this->paginate('Programadetrabalho',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Programadetrabalho->recursive = 1;
			//$this->Programadetrabalho->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('programadetrabalhos', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela programadetrabalho não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('programadetrabalho', $this->Programadetrabalho->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Programadetrabalho->create();
			if ($this->Programadetrabalho->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Programadetrabalho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Programadetrabalho",now(),"Programadetrabalho", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Programadetrabalho->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela programadetrabalho foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela programadetrabalho não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela programadetrabalho não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from programadetrabalhos Programadetrabalho where Programadetrabalho.id='.$id;
		$dadoslog=$this->Programadetrabalho->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Programadetrabalho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Programadetrabalho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Programadetrabalho",now(),"Programadetrabalho", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Programadetrabalho->query($monitora);
		
		
		
			if ($this->Programadetrabalho->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela programadetrabalho foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela programadetrabalho não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Programadetrabalho->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela programadetrabalho não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from programadetrabalhos Programadetrabalho where Programadetrabalho.id='.$id;
		$dadoslog=$this->Programadetrabalho->query($consultalog);
		foreach($dadoslog[0]['Programadetrabalho'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Programadetrabalho",now(),"Programadetrabalho", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Programadetrabalho->query($monitora);
		
		
		
		
		
		if ($this->Programadetrabalho->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Programadetrabalho excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Programadetrabalho não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Programadetrabalho->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Programadetrabalho->query('select * from programadetrabalhos Programadetrabalho where '.$filtro);
		$campos_busca = $this->Programadetrabalho->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Programadetrabalho';
		$tabela = 'Programadetrabalho';
		$nome = 'planilha_Programadetrabalho';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>