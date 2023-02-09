<?php
class PaisesController extends AppController {

	var $name = 'Paises';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Paise->recursive = 1;
			$opcoes = "LOWER(`Paise`.`nome`) LIKE '%" . $findUrl ."%' OR LOWER(`Paise`.`sigla`) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Paise->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Paise->recursive = 1;
			$this->set('paises', $this->paginate('Paise',array("LOWER(`Paise`.`sigla`) LIKE '%" . $findUrl ."%' OR LOWER(`Paise`.`nome`) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Paise->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Paise->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Paise->recursive = 1;
		$this->set('paises', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela paise não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Paise->recursive = 1;
		$this->set('paise', $this->Paise->findById($id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Paise->create();
			if ($this->Paise->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Paise'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Paise",now(),"Paise", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Paise->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela paise foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela paise não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela paise não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from paises Paise where Paise.id='.$id;
		$dadoslog=$this->Paise->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Paise'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Paise'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Paise",now(),"Paise", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Paise->query($monitora);
		
		
		
			if ($this->Paise->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela paise foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela paise não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Paise->read(null, $id);
		}
	}

	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela paise não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from paises Paise where Paise.id='.$id;
		$dadoslog=$this->Paise->query($consultalog);
		foreach($dadoslog[0]['Paise'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Paise",now(),"Paise", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Paise->query($monitora);
		
		
		
		
		
		if ($this->Paise->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Paise excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Paise não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function externoadd() {
		//print_r($this);
		foreach($this->viewVars[acesso] as $chave=>$valor){
			$tabelas[$chave] = $chave;
		}
		sort($tabelas);
		
		if (!empty($this->data['Paise']['tabelas'])) {
			$monitora = 'describe '.$tabelas[$this->data['Paise']['tabelas']].';';
			$executa=$this->Paise->query($monitora);
			foreach($executa as $chave=>$valor){
				foreach($valor as $coluna=>$campo){
					$campos[$campo['Field']]=$campo['Field'];
				}
			    //echo $valor['Field'];
			}
		if (!empty($this->data['Paise']['campos'])) {
			$sqlcampos = '';
			foreach($this->data['Paise']['campos'] as $indice=>$conteudo){
				$sqlcampos .=', convert('.$conteudo.' using latin1) as '.$conteudo.' ';
			}
				//			$this->Paise->query("SET NAMES latin1;SELECT id ".$x." FROM ".$tabelas[$this->data['Paise']['tabelas']].';');
			//echo "SELECT id ".$sqlcampos." FROM ".$tabelas[$this->data['Paise']['tabelas']].';';
			//$this->Paise->query("SET NAMES latin1;");
			//$this->Paise->query("SET NAMES latin1;");
			$listaDados=$this->Paise->query("SELECT id ".$sqlcampos." FROM ".$tabelas[$this->data['Paise']['tabelas']].';');
			//echo "SELECT id ".$sqlcampos." FROM ".$tabelas[$this->data['Paise']['tabelas']].';';
			//echo '<pre>';
			//print_r($listaDados);
			//echo '</pre>';
			foreach($listaDados as $qq=>$dados){
				$sqlsetupdate = 'id='.$dados[$tabelas[$this->data['Paise']['tabelas']]]['id'];
				foreach($this->data['Paise']['campos'] as $indice=>$update){
					//$sqlsetupdate .=','.$update.'=UNHEX(\''.bin2hex($dados[$tabelas[$this->data['Paise']['tabelas']]][$update])."') ";
				//	$sqlsetupdate .=','.$update.'=UNHEX(\''.bin2hex(iconv('ISO-8859-1','UTF-8',$dados[$tabelas[$this->data['Paise']['tabelas']]][$update]))."') ";
				//	$sqlsetupdate .=','.$update.'=UNHEX(\''.bin2hex($dados[$tabelas[$this->data['Paise']['tabelas']]][$update])."') ";
				//	$sqlsetupdate .=','.$update.'=\''.iconv('ISO-8859-1','UTF-8',$dados[0][$update])."' ";
					$sqlsetupdate .=','.$update.'=\''.$dados[0][$update]."' ";
				}
				
				//echo "UPDATE ".$tabelas[$this->data['Paise']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Paise']['tabelas']]]['id'];
				//$this->Paise->query("SET NAMES utf8;UPDATE ".$tabelas[$this->data['Paise']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Paise']['tabelas']]]['id']);
				//$this->Paise->query("SET NAMES utf8;");
				$this->Paise->query("UPDATE ".$tabelas[$this->data['Paise']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Paise']['tabelas']]]['id'].';');
				//echo "UPDATE ".$tabelas[$this->data['Paise']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Paise']['tabelas']]]['id'].';<br>';
				$sqlcampos .=','.$conteudo.' ';
			}
			
			
		}
			//print_r($executa);
			
				$this->Paise->query("SET NAMES utf8;");
		}
		
		
		
		/*
		echo '<pre>';
		print_r($this->viewVars[acesso]);
		echo '</pre>';
		*/
		if(empty($campos)){
                    $campos[0]='';
                }
		$this->set('tabelas', $tabelas);
		$this->set('campos', $campos);
		$this->set('selecionado', $this->data['Paise']['tabelas']);
		
	}
	
}
?>