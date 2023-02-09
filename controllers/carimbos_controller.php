<?php
class CarimbosController extends AppController {

	var $name = 'Carimbos';

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
		
		$esquema = $this->Carimbo->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Carimbo`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Carimbo`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Carimbo->recursive = 1;
			//$this->Carimbo->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('carimbos', $this->paginate('Carimbo',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Carimbo->recursive = 1;
			//$this->Carimbo->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('carimbos', $this->paginate());
			}
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela carimbo não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('carimbo', $this->Carimbo->read(null, $id));
	}

	function add($id=null) {
	
ini_set('display_errors', true);
ini_set('error_reporting', true);

//print_r($this->data);
		$Mid=$this->data['Carimbo']['militar_id'];
		$this->Carimbo->recursive = 0;
		
		if (is_uploaded_file($this->data['Carimbo']['dados']['tmp_name'])){
			$conteudo = fread(fopen($this->data['Carimbo']['dados']['tmp_name'], "r"),	$this->data['Carimbo']['dados']['size']);
		}

		if (!empty($this->data)&& ($this->data['Carimbo']['dados']['error']==0)) {

			if ((stripos($this->data['Carimbo']['dados']['type'],'image')!==false)&&((stripos($this->data['Carimbo']['dados']['type'],'jpg')!==false)||(stripos($this->data['Carimbo']['dados']['type'],'png')!==false)||(stripos($this->data['Carimbo']['dados']['type'],'jpeg')!==false))){
				$this->data['Carimbo']['dados']['data'] = ($conteudo);
				$this->data['Carimbo']['dados']['militar_id'] = $this->data['Carimbo']['militar_id'];
				$this->data['Carimbo']['dados']['emitente'] = $this->data['Carimbo']['emitente'];
				$this->data['Carimbo']['dados']['funcao'] = $this->data['Carimbo']['funcao'];
				$this->Carimbo->create();
				$this->Carimbo->save($this->data['Carimbo']['dados']);
				
			$ip = $_SERVER['REMOTE_ADDR'];
			$u = $this->Session->read('Usuario');
			$usuario = $u[0][0]['nome'];
			foreach($this->data['Carimbo'] as $chave=>$valor){$mudanca .= '['.$chave.']='.$valor.' ,';}
			$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Carimbo",now(),"Carimbo", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
			$this->Carimbo->query($monitora);
				
				if ( $this->Carimbo->id ) {
					$this->Session->setFlash(__('Os dados de  Carimbo foram gravados.', true));
				} else {
					$this->Session->setFlash(__('Os dados de Carimbo não foram gravados. Por favor, tente novamente.', true));
				}

			} else {
				$this->Session->setFlash(__('Somente arquivos do tipo imagem jpeg. Por favor, tente novamente.', true));
			}
		}
		
		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Posto.antiguidade asc, Militar.nm_completo asc";
		
		$militars = $this->Carimbo->Militar->query($sql1);
		
		
		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);
		$carimbos = $this->Carimbo->read(null,$id);
		$this->set(compact('militars','carimbos'));
		
		
		
		
		
		
		
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela carimbo não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		   /*
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from carimbos Carimbo where Carimbo.id='.$id;
		$dadoslog=$this->Carimbo->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Carimbo'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Carimbo'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Carimbo",now(),"Carimbo", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Carimbo->query($monitora);
		*/
		//print_r($this->data['Carimbo']['dados']);
		
       if (is_uploaded_file($this->data['Carimbo']['dados']['tmp_name'])){
            $conteudo = fread(fopen($this->data['Carimbo']['dados']['tmp_name'], "r"),  $this->data['Carimbo']['dados']['size']);
        }

        if (!empty($this->data)&& ($this->data['Carimbo']['dados']['error']==0)) {

            if ((stripos($this->data['Carimbo']['dados']['type'],'image')!==false)&&((stripos($this->data['Carimbo']['dados']['type'],'jpg')!==false)||(stripos($this->data['Carimbo']['dados']['type'],'png')!==false)||(stripos($this->data['Carimbo']['dados']['type'],'jpeg')!==false))){
                $this->data['Carimbo']['data']=$conteudo;
                $this->data['Carimbo']['type']=$this->data['Carimbo']['dados']['type'];
                $this->data['Carimbo']['size']=$this->data['Carimbo']['dados']['size'];
                $this->data['Carimbo']['name']=$this->data['Carimbo']['dados']['name'];
                //      $this->Carimbo->save($this->data['Carimbo']['dados']);
            }
        }
		
			if ($this->Carimbo->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela carimbo foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela carimbo não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Carimbo->read(null, $id);
		}
		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
WHERE Militar.id={$this->data['Carimbo']['militar_id']}
order by Posto.antiguidade asc, Militar.nm_completo asc";
		$militars = $this->Carimbo->Militar->query($sql1);
		
		
		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);
		$carimbos = $this->Carimbo->read(null,$id);
		$this->set(compact('militars'));
		
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela carimbo não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from carimbos Carimbo where Carimbo.id='.$id;
		$dadoslog=$this->Carimbo->query($consultalog);
		foreach($dadoslog[0]['Carimbo'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Carimbo",now(),"Carimbo", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Carimbo->query($monitora);
		
		
		
		
		
		if ($this->Carimbo->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Carimbo excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Carimbo não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Carimbo->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Carimbo->query('select * from carimbos Carimbo where '.$filtro);
		$campos_busca = $this->Carimbo->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Carimbo';
		$tabela = 'Carimbo';
		$nome = 'planilha_Carimbo';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	function externodownload($id, $alternativa = null)
	{
		$this->set('id',$id);
		$this->set('alternativa',$alternativa);
		//$u=$this->Session->read('Usuario');
		//$this->layout = 'fotos'; //this will use the pdf.thtml layout
		$this->layout = ''; //this will use the pdf.thtml layout
		$this->Carimbo->recursive = NULL;
		//$this->set('especialidades', $this->find('All'));
		if($id!='Z'){
			$dados = $this->Carimbo->read(null,$id);
		}
		
		
		//if (!empty($this->passedArgs[1])){$alternativa = 1;}
		
//		print_r($this->passedArgs);
		
		
		//if($alternativa){
		//	$dados['Foto']['alt'] = 1;
		//}
		
		
		$this->set('carimbos',$dados);
		$this->render();
	}
	function externostream($id)
	{
		$this->layout = ''; //this will use the pdf.thtml layout
		$this->Carimbo->recursive = NULL;
		$dados = $this->Carimbo->findById($id);
		$this->set('carimbos',$dados);
		$this->render();
	}
	


	
}
?>