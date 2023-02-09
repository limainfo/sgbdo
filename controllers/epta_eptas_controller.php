<?php
class EptaEptasController extends AppController {

	var $name = 'EptaEptas';

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
		
		$esquema = $this->EptaEpta->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`EptaEpta`.``) LIKE '%" . $findUrl ."%' OR LOWER(`EptaEpta`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->EptaEpta->recursive = 1;
			//$this->EptaEpta->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('eptaEptas', $this->paginate('EptaEpta',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->EptaEpta->recursive = 1;
			//$this->EptaEpta->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('eptaEptas', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela epta epta não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('eptaEpta', $this->EptaEpta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EptaEpta->create();
			if ($this->EptaEpta->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['EptaEpta'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em EptaEpta",now(),"EptaEpta", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->EptaEpta->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela epta epta foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela epta epta não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$baseIndicLocs = $this->EptaEpta->BaseIndicLoc->find('list');
		$estados = $this->EptaEpta->Estado->find('list');
		$this->set(compact('baseIndicLocs', 'estados'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela epta epta não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from eptaEptas EptaEpta where EptaEpta.id='.$id;
		$dadoslog=$this->EptaEpta->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['EptaEpta'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['EptaEpta'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em EptaEpta",now(),"EptaEpta", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->EptaEpta->query($monitora);
		
		
		
			if ($this->EptaEpta->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela epta epta foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela epta epta não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EptaEpta->read(null, $id);
		}
		$baseIndicLocs = $this->EptaEpta->BaseIndicLoc->find('list');
		$estados = $this->EptaEpta->Estado->find('list');
		$this->set(compact('baseIndicLocs', 'estados'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela epta epta não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from eptaEptas EptaEpta where EptaEpta.id='.$id;
		$dadoslog=$this->EptaEpta->query($consultalog);
		foreach($dadoslog[0]['EptaEpta'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de EptaEpta",now(),"EptaEpta", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->EptaEpta->query($monitora);
		
		
		
		
		
		if ($this->EptaEpta->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Epta epta excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Epta epta não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->EptaEpta->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->EptaEpta->query('select * from epta_eptas EptaEpta where '.$filtro);
		$esquema = $this->EptaEpta->_schema;
                foreach($esquema as $chave=>$valor){
                    $campos[$chave]=$chave;
                }
                echo '<pre>-------------'.print_r($campos,true).'</pre>';
                //echo '<pre>-------------'.print_r($conteudo,true).'</pre>';
                $campos_busca = $this->EptaEpta->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de EptaEpta';
		$tabela = 'EptaEpta';
		$nome = 'planilha_EptaEpta';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	


	
}
?>