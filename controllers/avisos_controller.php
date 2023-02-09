<?php
class AvisosController extends AppController {

	var $name = 'Avisos';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Aviso->recursive = 0;
			$opcoes = "LOWER(`Aviso`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Aviso`.``) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Aviso->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Aviso->recursive = 1;
			$this->set('paises', $this->paginate('Aviso',array("LOWER(`Aviso`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Aviso`.``) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Aviso->recursive = 1;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Aviso->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Aviso->recursive = 1;
		$this->set('avisos', $this->paginate());
		}
	}


	function add() {
		$this->Session->delete('Message.flash');
		$this->Session->delete('Message.auth');
	
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
		
		
		if (!empty($this->data)) {
                        $this->data['Aviso']['usuario']=$usuario;
			$this->Aviso->create();
			if ($this->Aviso->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];

		foreach($this->data['Aviso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Aviso",now(),"Aviso", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Aviso->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela Avisos foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela Avisos não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
                $this->Session->delete('Message.flash');
                $this->Session->delete('Message.auth');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela Avisos não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from avisos Aviso where Aviso.id='.$id;
		$dadoslog=$this->Aviso->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Aviso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Aviso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Aviso",now(),"Aviso", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Aviso->query($monitora);
		

                        $this->data['Aviso']['usuario']=$usuario;

		
			if ($this->Aviso->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela Avisos foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela Avisos não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Aviso->read(null, $id);
		}
	}

	
	function delete($id = null) {
                $this->Session->delete('Message.flash');
                $this->Session->delete('Message.auth');
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela Avisos não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from paises Aviso where Aviso.id='.$id;
		$dadoslog=$this->Aviso->query($consultalog);
		foreach($dadoslog[0]['Aviso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Aviso",now(),"Aviso", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Aviso->query($monitora);
		
		
		
		
		
		if ($this->Aviso->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Aviso excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Aviso não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function externoadd() {
		//print_r($this);
		foreach($this->viewVars[acesso] as $chave=>$valor){
			$tabelas[$chave] = $chave;
		}
		sort($tabelas);
		
		if (!empty($this->data['Aviso']['tabelas'])) {
			$monitora = 'describe '.$tabelas[$this->data['Aviso']['tabelas']].';';
			$executa=$this->Aviso->query($monitora);
			foreach($executa as $chave=>$valor){
				foreach($valor as $coluna=>$campo){
					$campos[$campo['Field']]=$campo['Field'];
				}
			    //echo $valor['Field'];
			}
		if (!empty($this->data['Aviso']['campos'])) {
			$sqlcampos = '';
			foreach($this->data['Aviso']['campos'] as $indice=>$conteudo){
				$sqlcampos .=', convert('.$conteudo.' using latin1) as '.$conteudo.' ';
			}
				//			$this->Aviso->query("SET NAMES latin1;SELECT id ".$x." FROM ".$tabelas[$this->data['Aviso']['tabelas']].';');
			//echo "SELECT id ".$sqlcampos." FROM ".$tabelas[$this->data['Aviso']['tabelas']].';';
			//$this->Aviso->query("SET NAMES latin1;");
			//$this->Aviso->query("SET NAMES latin1;");
			$listaDados=$this->Aviso->query("SELECT id ".$sqlcampos." FROM ".$tabelas[$this->data['Aviso']['tabelas']].';');
			//echo "SELECT id ".$sqlcampos." FROM ".$tabelas[$this->data['Aviso']['tabelas']].';';
			//echo '<pre>';
			//print_r($listaDados);
			//echo '</pre>';
			foreach($listaDados as $qq=>$dados){
				$sqlsetupdate = 'id='.$dados[$tabelas[$this->data['Aviso']['tabelas']]]['id'];
				foreach($this->data['Aviso']['campos'] as $indice=>$update){
					//$sqlsetupdate .=','.$update.'=UNHEX(\''.bin2hex($dados[$tabelas[$this->data['Aviso']['tabelas']]][$update])."') ";
				//	$sqlsetupdate .=','.$update.'=UNHEX(\''.bin2hex(iconv('ISO-8859-1','UTF-8',$dados[$tabelas[$this->data['Aviso']['tabelas']]][$update]))."') ";
				//	$sqlsetupdate .=','.$update.'=UNHEX(\''.bin2hex($dados[$tabelas[$this->data['Aviso']['tabelas']]][$update])."') ";
				//	$sqlsetupdate .=','.$update.'=\''.iconv('ISO-8859-1','UTF-8',$dados[0][$update])."' ";
					$sqlsetupdate .=','.$update.'=\''.$dados[0][$update]."' ";
				}
				
				//echo "UPDATE ".$tabelas[$this->data['Aviso']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Aviso']['tabelas']]]['id'];
				//$this->Aviso->query("SET NAMES utf8;UPDATE ".$tabelas[$this->data['Aviso']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Aviso']['tabelas']]]['id']);
				//$this->Aviso->query("SET NAMES utf8;");
				$this->Aviso->query("UPDATE ".$tabelas[$this->data['Aviso']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Aviso']['tabelas']]]['id'].';');
				//echo "UPDATE ".$tabelas[$this->data['Aviso']['tabelas']]." SET {$sqlsetupdate} WHERE id=".$dados[$tabelas[$this->data['Aviso']['tabelas']]]['id'].';<br>';
				$sqlcampos .=','.$conteudo.' ';
			}
			
			
		}
			//print_r($executa);
			
				$this->Aviso->query("SET NAMES utf8;");
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
		$this->set('selecionado', $this->data['Aviso']['tabelas']);
		
	}
	
}
?>