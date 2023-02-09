<?php
class ZquestaosController extends AppController {

	var $name = 'Zquestaos';

	function index() {
		$this->Zquestao->recursive = 0;
		$this->set('zquestaos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid zquestao', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('zquestao', $this->Zquestao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			
		if (is_uploaded_file($this->data['Zquestao']['imagem']['tmp_name'])){
			$conteudo = fread(fopen($this->data['Zquestao']['imagem']['tmp_name'], "r"),	$this->data['Zquestao']['imagem']['size']);
		}
		
			$this->Zquestao->create();
			$condicao=$this->Zquestao->save($this->data);
			$id = $this->Zquestao->id;
			
		if (!empty($this->data)&& strlen($conteudo)>0) {
			if ((stripos($this->data['Zquestao']['imagem']['type'],'image')!==false)&&((stripos($this->data['Zquestao']['imagem']['type'],'jpg')!==false)||(stripos($this->data['Zquestao']['imagem']['type'],'jpeg')!==false))){
				$this->data['Zquestao']['imagem']['data'] = addslashes($conteudo);
				$size = strlen(addslashes($conteudo));
				$this->data['Zquestao']['imagem']['questao_id'] = $id;

				$insere  = 'insert into zfotos (id, type, name, size, data, created, zquestao_id) values (uuid(),';
				$insere .= "'{$this->data['Zquestao']['imagem']['type']}',";
				$insere .= "'{$this->data['Zquestao']['imagem']['name']}',";
				$insere .= "{$size},";
				$insere .= "'{$this->data['Zquestao']['imagem']['data']}',now(),";
				$insere .= "{$id});";
				$this->Zquestao->query($insere);

				$sqlfoto = 'select Zfoto.id from zfotos Zfoto where Zfoto.zquestao_id='.$id;
				$consultafoto=$this->Zquestao->query($sqlfoto);
				$id_foto=$consultafoto[0]['Zfoto']['id'];
				$this->data['Zquestao']['zfoto_id']=$id_foto;
				$this->data['Zquestao']['id']=$id;
				$this->Zquestao->save($this->data);
				
			} else {
				$this->Session->setFlash(__('Somente arquivos do tipo imagem. Por favor, tente novamente.', true));
			}
		}
			
			if ($condicao) {
				$this->Session->setFlash(__('Registrado com sucesso', true));
			} else {
				$this->Session->setFlash(__('Houve um problema. Tente novamente!', true));
			}
		}
		$sqlp = 'select Zquestao.regulamento from zquestaos Zquestao group by Zquestao.regulamento order by Zquestao.regulamento asc ';
		//echo '<br><br><br>'.$sqlp;
		$prova = $this->Zquestao->query($sqlp);
		$conta=0;
		$nomes[0]['zquestaos']['regulamento'] = $prova[0]['Zquestao']['regulamento'];
		foreach ($prova as $dados){
				$conta++;
				$nomes[$conta]['zquestaos']['regulamento'] = $dados['Zquestao']['regulamento'];
		}

		$this->set(compact('regulamentos','nomeprovas','nomes'));
		
	}

	function edit($id = null) {
		$sqlc = 'select Zquestao.regulamento from zquestaos Zquestao group by Zquestao.regulamento ';
		$legislacao = $this->Zquestao->query($sqlc);
		foreach ($legislacao as $dados){
			$provas[$dados['Zquestao']['regulamento']]=$dados['Zquestao']['regulamento'];
						
		}
		
			$sqli = 'select Zquestao.id from zquestaos Zquestao where Zquestao.id>'.$id.' order by Zquestao.id asc';
			$novoid = $this->Zquestao->query($sqli);
			$iddepois = $novoid[0]['Zquestao']['id'];

			$sqli = 'select Zquestao.id from zquestaos Zquestao where Zquestao.id<'.$id.' order by Zquestao.id desc';
			$novoid = $this->Zquestao->query($sqli);
			$idantes = $novoid[0]['Zquestao']['id'];
		
		$this->set(compact('provas','idantes','iddepois'));
		
			
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid zquestao', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Zquestao->save($this->data)) {
				$this->Session->setFlash(__('Dados modificados!', true));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zquestao could not be saved. Please, try again.', true));
			}
		}

			$this->data = $this->Zquestao->read(null, $id);
		
		if (empty($this->data)) {
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for zquestao', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Zquestao->delete($id)) {
			$this->Session->setFlash(__('Zquestao deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Zquestao was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function externodownload($id = null)
	{
		$this->set('id',$id);
		$this->layout = ''; //this will use the pdf.thtml layout
		$sqlc = 'select * from zfotos Zfoto where Zfoto.id='.$id;
		$fotos = $this->Zquestao->query($sqlc);
//		print_r($dados);
		$this->set('fotos',$fotos);
		$this->render();
	}		
}
?>