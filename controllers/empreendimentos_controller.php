<?php
class EmpreendimentosController extends AppController {

	var $name = 'Empreendimentos';

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
		
		$esquema = $this->Empreendimento->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Empreendimento`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Empreendimento`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Empreendimento->recursive = 1;
			//$this->Empreendimento->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('empreendimentos', $this->paginate('Empreendimento',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Empreendimento->recursive = 1;
			//$this->Empreendimento->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('empreendimentos', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela empreendimento não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('empreendimento', $this->Empreendimento->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Empreendimento->create();
			if ($this->Empreendimento->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Empreendimento'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Empreendimento",now(),"Empreendimento", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Empreendimento->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela empreendimento foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela empreendimento não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela empreendimento não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from empreendimentos Empreendimento where Empreendimento.id='.$id;
		$dadoslog=$this->Empreendimento->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Empreendimento'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Empreendimento'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Empreendimento",now(),"Empreendimento", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Empreendimento->query($monitora);
		
		
		
			if ($this->Empreendimento->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela empreendimento foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela empreendimento não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Empreendimento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela empreendimento não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from empreendimentos Empreendimento where Empreendimento.id='.$id;
		$dadoslog=$this->Empreendimento->query($consultalog);
		foreach($dadoslog[0]['Empreendimento'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Empreendimento",now(),"Empreendimento", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Empreendimento->query($monitora);
		
		
		
		
		
		if ($this->Empreendimento->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Empreendimento excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Empreendimento não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Empreendimento->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Empreendimento->query('select * from empreendimentos Empreendimento where '.$filtro);
		$campos_busca = $this->Empreendimento->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Empreendimento';
		$tabela = 'Empreendimento';
		$nome = 'planilha_Empreendimento';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>