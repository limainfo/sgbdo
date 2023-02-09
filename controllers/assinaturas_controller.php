<?php
class AssinaturasController extends AppController {

	var $name = 'Assinaturas';
	var $helpers = array('Html', 'Form');

	function index() {
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
		echo $findUrl;

		if ( $findUrl != '' ) {
			$opcoes = "LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%'  ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Assinatura->recursive = 1;
					$registros = $this->Assinatura->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Assinatura->recursive = 2;
			$this->set('fotos', $this->paginate('Assinatura',array($opcoes)));
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Assinatura->recursive = 0;
					$registros = $this->Assinatura->find('all');
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Assinatura->recursive = 2;
			$this->set('fotos', $this->paginate());
				
		}


	}
/*
	function view($id = null) {
		$this->layout = 'admin';

		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Assinatura.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('assinatura', $this->Assinatura->read(null, $id));
	}
*/
 	function view() {
 
		$this->layout = null;
		$this->Assinatura->recursive = 0;
		$criar = 1;
                $u=$this->Session->read('Usuario'); 

                if ( !empty($u[0]['Usuario']['militar_id'])) {
                $data = $_POST['datasign'];
                //$filename = 'jqScribbleImage.png';
                $data = substr($data, strpos($data, ",")+1);
                $data = base64_decode($data);
                //$imgRes = imagecreatefromstring($data);
                //if($imgRes !== false && imagepng($imgRes, $filename) === true)  echo "<img src='{$filename}' alt='jqScribble Created Image'/>";
                $this->data['Assinatura']['dados']['type'] = 'image/png';
                $this->data['Assinatura']['dados']['size'] = strlen($data);
                $this->data['Assinatura']['dados']['name'] = $u[0]['Usuario']['militar_id'];
                $this->data['Assinatura']['dados']['data'] = addslashes($data);
                //$this->data['Assinatura']['dados']['data'] = ($data);
                $this->data['Assinatura']['dados']['militar_id'] = $u[0]['Usuario']['militar_id'];
                
                //print_r($this->data);
                $this->Assinatura->recursive = -1;   
                $id_assinatura = $this->Assinatura->findByMilitarId($u[0]['Usuario']['militar_id']);
                //print_r($id_assinatura); exit();
                $mensagens['mensagem']='';
                $mensagens['situacao']='';
                $mensagens['destino']='';
                $mensagens['assinatura']='';
                $mensagens['tamanho']=$this->data['Assinatura']['dados']['size'];
                header('Content-type: application/x-json');


                if ($id_assinatura['Assinatura']['id']>0){
                        $this->data['Assinatura']['dados']['id'] = $id_assinatura['Assinatura']['id'];
                        $criar = 0;
                }
                if($mensagens['tamanho']<1000){
                        $mensagens['mensagem']='<br>Assinatura não foi registrada. Pouco conteúdo na rubrica!';
                        $mensagens['situacao']='0';
                        $mensagens['destino']='';
                        $mensagens['assinatura']='0';
                        echo json_encode($mensagens);
                        exit();
                }
                if($criar){
                        $this->Assinatura->create();
                }
                $this->Assinatura->save($this->data['Assinatura']['dados']);

                if ( $this->Assinatura->id ) {
                        $mensagens['mensagem']='<br>Assinatura registrada com sucesso! Logo abaixo encontra-se a confirmação da assinatura! Se estiver satisfeito, clique em SAIR e realize novo login.';
                        $mensagens['situacao']='100';
                        $mensagens['destino']='usuarios/login';
                        $mensagens['assinatura']=$this->Assinatura->id;

                } else {
                        $mensagens['mensagem']='<br>Assinatura não foi registrada. Entre em contato com o administrador!';
                        $mensagens['situacao']='0';
                        $mensagens['destino']='';
                        $mensagens['assinatura']='0';
                }
                
                echo json_encode($mensagens);
                exit();


            }else{
                $this->redirect(array('action'=>'logout','controller'=>'usuarios'));
            }
            
	}
        
        

	function add($id=null) {
            $this->Assinatura->recursive = 0;
            $this->layout = 'admin';
            $criar = 1;
            $u=$this->Session->read('Usuario'); 
           // print_r($u);exit();
            //!empty($this->data) &&
            if ( empty($u[0]['Usuario']['militar_id'])) {
                $this->redirect(array('action'=>'logout','controller'=>'usuarios'));
            }


	}

	function addantigo($id=null) {
		$this->Assinatura->recursive = 0;
		$this->layout = 'admin';
		$criar = 1;

		if (is_uploaded_file($this->data['Assinatura']['dados']['tmp_name'])){
			$conteudo = fread(fopen($this->data['Assinatura']['dados']['tmp_name'], "r"),	$this->data['Assinatura']['dados']['size']);
		}

		if (!empty($this->data)&& strlen($conteudo)>0) {

			//			echo 'Acessou condicao 1';

			if ((stripos($this->data['Assinatura']['dados']['type'],'image')!==false)&&((stripos($this->data['Assinatura']['dados']['type'],'jpg')!==false)||(stripos($this->data['Assinatura']['dados']['type'],'jpeg')!==false))){

				$this->data['Assinatura']['dados']['data'] = addslashes($conteudo);
				$this->data['Assinatura']['dados']['militar_id'] = $this->data['Assinatura']['militar_id'];

				$id_foto = $this->Assinatura->findByMilitarId($this->data['Assinatura']['militar_id']);


				if ($id_foto['Assinatura']['id']>0){
					$this->data['Assinatura']['dados']['id'] = $id_foto['Assinatura']['id'];
					$criar = 0;
				}
				//print_r($this->data);
				//exit(1);

				//print_r($id_foto);
				if($criar){
					$this->Assinatura->create();
				}
				$this->Assinatura->save($this->data['Assinatura']['dados']);
					
				if ( $this->Assinatura->id ) {

					$this->Session->setFlash(__('Os dados de  Assinatura foram gravados.', true));
					$this->redirect(array('controller'=>'militars','action'=>'index'));

				} else {
					$this->Session->setFlash(__('Os dados de Assinatura não foram gravados. Por favor, tente novamente.', true));
				}

			} else {
				$this->Session->setFlash(__('Somente arquivos do tipo imagem JPG . Por favor, tente novamente.', true));
			}
		}

		if($id!=null){
			$sql1 = "select  Militar.id  , concat(Militar.nm_completo, ' - ', Posto.sigla_posto )  as 'Militar.nm_completo'
			FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			WHERE Militar.id=$id
			order by Militar.nm_completo asc";
		}else{
			$sql1 = "select  Militar.id  , concat(Militar.nm_completo, ' - ', Posto.sigla_posto)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Militar.nm_completo asc";
		}

		$militars = $this->Assinatura->Militar->query($sql1);


		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);


		$this->set(compact('militars','id'));


	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Assinatura', true));
			$this->redirect(array('controller'=>'militars','action'=>'index'));
		}
		if ($this->Assinatura->delete($id)) {
			$this->Session->setFlash(__('Assinatura excluído', true));
			$this->redirect(array('controller'=>'militars','action'=>'index'));
		}
	}
	function download($id, $alternativa = null)
	{
		$this->layout = 'fotos'; //this will use the pdf.thtml layout
		$this->Assinatura->recursive = NULL;
		//$this->set('especialidades', $this->find('All'));
		if($id!='Z'){
			$dados = $this->Assinatura->findById($id);
		}


		//if (!empty($this->passedArgs[1])){$alternativa = 1;}

		//		print_r($this->passedArgs);


		//if($alternativa){
		//	$dados['Foto']['alt'] = 1;
		//}


		$this->set('fotos',$dados);
		$this->render();
	}
	
	function externodownload($id)
	{
                $this->layout = null; //this will use the pdf.thtml layout
                $u=$this->Session->read('Usuario'); 

                if ( !empty($u[0]['Usuario']['militar_id']) && !empty($id)) {
                    $this->Assinatura->recursive = -1;
                    $dados = $this->Assinatura->findById($id);
                    echo stripslashes($dados['Assinatura']['data']);
/**                 
	$im = imagecreatefromstring(stripslashes($dados['Assinatura']['data']));
ob_start();
	$nWidth = imagesx($im); 
	$nHeight = imagesy($im);
	$nDestinationWidth = 40; $nDestinationHeight = 30;
	$size=40;
  	$aspect_ratio = $nHeight/$nWidth;

   if ($nWidth <= $size) {
     $nDestinationWidth = $nWidth;
     $nDestinationHeight = $nHeight;
   } else {
     $nDestinationWidth = $size;
     $nDestinationHeight = abs($nDestinationWidth * $aspect_ratio);
   }	
   if(isset($alternativa)){
     $nDestinationWidth = $nWidth;
     $nDestinationHeight = $nHeight;
   }
	$oDestinationImage = imagecreatetruecolor($nDestinationWidth, $nDestinationHeight); 
	$oResult = imagecopyresampled( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight); 
	ImageCopyResized( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight);
	imagepng($oDestinationImage);
	$image_buffer = ob_get_contents();
ob_end_clean();

	header('Content-type: image/png');
	header('Content-length: ' . strlen($image_buffer));
	header('Content-Disposition: attachment; filename='.$dados['Assinatura']['name']);
echo $image_buffer;
**/
   
                }
                exit();
	}
	function externostream($id, $alternativa = null)
	{
                $u=$this->Session->read('Usuario'); 

                if ( empty($u[0]['Usuario']['militar_id']) ) {
                    exit();
                }
		$this->set('id',$id);
		$this->layout = 'fotos'; //this will use the pdf.thtml layout
		$this->Assinatura->recursive = NULL;
		if($id!='Z'){
			$dados = $this->Assinatura->findById($id);
		}
		$this->set('fotos',$dados);
		$this->render();
	}
	

}
?>