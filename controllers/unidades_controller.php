<?php
class UnidadesController extends AppController {

	var $name = 'Unidades';

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
		
		$esquema = $this->Unidade->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Unidade`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Unidade`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Unidade->recursive = 1;
			//$this->Unidade->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('unidades', $this->paginate('Unidade',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Unidade->recursive = 1;
			//$this->Unidade->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('unidades', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela unidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
                $this->Unidade->recursive = 2;
		$this->set('unidade', $this->Unidade->findById($id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Unidade->create();
			if ($this->Unidade->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Unidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Unidade",now(),"Unidade", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Unidade->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela unidade foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela unidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		
		$cidades = $this->Unidade->Cidade->find('list');
		
		
		$this->set(compact('cidades'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela unidade não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from unidades Unidade where Unidade.id='.$id;
		$dadoslog=$this->Unidade->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Unidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Unidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Unidade",now(),"Unidade", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Unidade->query($monitora);
		
		
		
			if ($this->Unidade->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela unidade foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela unidade não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Unidade->read(null, $id);
		}
		$lista = $this->Unidade->query('select Cidade.nome, Cidade.id, Estado.nome from cidades Cidade inner join estados Estado on (Estado.id=Cidade.estado_id) order by Cidade.nome asc ');
		foreach($lista as $dado){
		   $cidades[$dado['Cidade']['id']] = $dado['Cidade']['nome'].' - '.$dado['Estado']['nome'];
		}
                
		//$cidades = $this->Unidade->Cidade->find('list');
        //print_r($cidades);
		
		$this->set(compact('cidades'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela unidade não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from unidades Unidade where Unidade.id='.$id;
		$dadoslog=$this->Unidade->query($consultalog);
		foreach($dadoslog[0]['Unidade'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Unidade",now(),"Unidade", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Unidade->query($monitora);
		
		
		
		
		
		if ($this->Unidade->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Unidade excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Unidade não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Unidade->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Unidade->query('select * from unidades Unidade where '.$filtro);
		$campos_busca = $this->Unidade->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Unidade';
		$tabela = 'Unidade';
		$nome = 'planilha_Unidade';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>