<?php
class FotosController extends AppController {

	var $name = 'Fotos';
	var $helpers = array('Html', 'Form', 'Ajax');

	function index() {
            
            	$p=$this->Session->read('Usuario');
                if($p[0]['Privilegio']['acesso']!=0){
                    exit();
                }

		
		if ( $findUrl != '' ) {
			$opcoes = "LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Foto->recursive = 1;
					$registros = $this->Foto->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Foto->recursive = 2;
			$this->set('fotos', $this->paginate('Foto',array("LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' ")));
						
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Foto->recursive = 1;
					$registros = $this->Foto->find('all');
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Foto->recursive = 2;
			$this->set('fotos', $this->paginate());
									
			}
		
	}

	function view($id = null) {
		$this->layout = 'admin';
		$this->Foto->recursive = 2;
		
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Foto.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('foto', $this->Foto->read(null, $id));
	}


	function add($Mid=null) {

		
		$criar = 1;
		//echo 'id='.$Mid;
                $u=$this->Session->read('Usuario');
                if(empty($u[0][0]['nome'])){
                    exit();
                }
                 $Mid=$u[0]['Usuario']['militar_id'];
		if($Mid==null){
			$Mid=$this->data['Foto']['militar_id'];
		}
		$this->Foto->recursive = 0;

		//echo $this->data['Foto']['dados']['tmp_name'];
		
		if (is_uploaded_file($this->data['Foto']['dados']['tmp_name'])){
			$conteudo = fread(fopen($this->data['Foto']['dados']['tmp_name'], "r"),	$this->data['Foto']['dados']['size']);
		}

		if (!empty($this->data)&& strlen($conteudo)>0) {

//			echo 'Acessou condicao 1';

		//	if (stripos($this->data['Foto']['dados']['type'],'image') !== false){
			if ((stripos($this->data['Foto']['dados']['type'],'image')!==false)&&((stripos($this->data['Foto']['dados']['type'],'jpg')!==false)||(stripos($this->data['Foto']['dados']['type'],'jpeg')!==false))){
				
				//$this->data['Foto']['dados']['data'] = addslashes($conteudo);
				$this->data['Foto']['dados']['data'] = ($conteudo);
				$this->data['Foto']['dados']['militar_id'] = $this->data['Foto']['militar_id'];

				$id_foto = $this->Foto->findByMilitarId($this->data['Foto']['militar_id']);

				if ($id_foto){
					$this->data['Foto']['dados']['id'] = $id_foto['Foto']['id'];
				}

				//print_r($id_foto);
				if ($id_foto['Foto']['id']>0){
					$this->data['Foto']['dados']['id'] = $id_foto['Foto']['id'];
					$criar = 0;
				}
				//print_r($this->data);
				//exit(1);

				//print_r($id_foto);
				if($criar){
					$this->Foto->create();
				}
				$this->Foto->save($this->data['Foto']['dados']);
					
				if ( $this->Foto->id ) {

					$this->Session->setFlash(__('Os dados de  Foto foram gravados.', true));
					$this->redirect(array('action'=>'add/'.$Mid));

				} else {
					$this->Session->setFlash(__('Os dados de Foto não foram gravados. Por favor, tente novamente.', true));
				}

			} else {
				$this->Session->setFlash(__('Somente arquivos do tipo imagem jpg ou jpeg são aceitos. Por favor, tente novamente.', true));
			}
		}
		
		$sql1 = "select  Militar.id  , concat( Militar.nm_completo,' ', Posto.sigla_posto)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
WHERE Militar.id='$Mid'
order by Militar.nm_completo asc";
		
		$militars = $this->Foto->Militar->query($sql1);
		
		$sqlfoto = "select * FROM fotos as Foto WHERE Foto.militar_id='$Mid'";
		
		$fotos = $this->Foto->query($sqlfoto);
		
		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);
		
		
		//$militars = $this->Foto->Militar->find('list');
		$id=$Mid;
                $fotoid = $fotos[0]['Foto']['id'];
		$this->set(compact('militars','id','fotoid'));
		//$this->redirect('add/'.$id);
	}



	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Foto', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Foto->delete($id)) {
			$this->Session->setFlash(__('Foto excluído', true));
			$this->redirect(array('controller'=>'militars', 'action'=>'index'));
		}
	}
	function externodownload($id, $alternativa = null)
	{
		$this->set('id',$id);
		$this->set('alternativa',$alternativa);
		//$u=$this->Session->read('Usuario');
		//$this->layout = 'fotos'; //this will use the pdf.thtml layout
		$this->layout = ''; //this will use the pdf.thtml layout
		$this->Foto->recursive = NULL;
		//$this->set('especialidades', $this->find('All'));
        	$u=$this->Session->read('Usuario');
                if(empty($u[0][0]['nome'])){
                    exit();
                }

		if($id!='Z'){
			$dados = $this->Foto->findById($id);
		}
		
		
		//if (!empty($this->passedArgs[1])){$alternativa = 1;}
		
//		print_r($this->passedArgs);
		
		
		//if($alternativa){
		//	$dados['Foto']['alt'] = 1;
		//}
		
		
		$this->set('fotos',$dados);
		$this->render();
	}
	function externostream($id, $alternativa = null)
	{
		$this->set('id',$id);
		$this->layout = 'fotos'; //this will use the pdf.thtml layout
		$this->Foto->recursive = NULL;
		$u=$this->Session->read('Usuario');
                if(empty($u[0][0]['nome'])){
                    exit();
                }
                
		if($id!='Z'){
			$dados = $this->Foto->findById($id);
		}
		$this->set('fotos',$dados);
		$this->render();
	}
	
}


?>