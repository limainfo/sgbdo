<?php
class ParecerestecnicosController extends AppController {

	var $name = 'Parecerestecnicos';
	var $helpers = array('Html', 'Form');
	var $paginate = array('limit' => 25,'order' => array('Parecerestecnico.id' => 'desc'));


	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean(
		$this->data );
		$findUrl = low(($this->cleanData['formFind']['find']) );
		
		if ( $findUrl != '' ) {
			if($findUrl>0){
				$opcoes = " YEAR(`Parecerestecnico`.`entrada_cindacta`)=" . $findUrl ." OR (`Parecerestecnico`.`entrada_cindacta`)='" . $findUrl ."'  OR `Parecerestecnico`.`parecer` LIKE '%" . $findUrl ."%'  LOWER(`Parecerestecnico`.`oficio`) LIKE '%" . $findUrl ."%'  ";
			}else{
				$opcoes = " LOWER(`Parecerestecnico`.`oficio`) LIKE '%" . $findUrl ."%'  OR LOWER(`Parecerestecnico`.`situacao`) LIKE '%" . $findUrl ."%'  OR LOWER(`Parecerestecnico`.`parecer`) LIKE '%" . $findUrl ."%'";
			}
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Parecerestecnico->recursive = 1;
					$registros = $this->Parecerestecnico->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Parecerestecnico->recursive = 0;
			$teste=$findUrl+0;
			if($findUrl>0){
				$this->set('parecerestecnicos', $this->paginate('Parecerestecnico',array(" YEAR(`Parecerestecnico`.`entrada_cindacta`)=" . $findUrl ." OR (`Parecerestecnico`.`entrada_cindacta`)='" . $findUrl ."'  OR `Parecerestecnico`.`parecer` LIKE '%" . $findUrl ."%'  LOWER(`Parecerestecnico`.`oficio`) LIKE '%" . $findUrl ."%'  ")));
			}else{
				$this->set('parecerestecnicos', $this->paginate('Parecerestecnico',array(" LOWER(`Parecerestecnico`.`oficio`) LIKE '%" . $findUrl ."%'  OR LOWER(`Parecerestecnico`.`situacao`) LIKE '%" . $findUrl ."%'  OR LOWER(`Parecerestecnico`.`parecer`) LIKE '%" . $findUrl ."%'")));
			}
					
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Parecerestecnico->recursive = 1;
					$registros = $this->Parecerestecnico->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Parecerestecnico->recursive = 0;
			$this->set('parecerestecnicos', $this->paginate());
															
			}
		
		
	}

	function externoindex() {
		$this->layout = 'adminexterno';
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(($this->cleanData['formFind']['find']) );
		if ( $findUrl != '' ) {
			$this->Parecerestecnico->recursive = 0;
			$teste=$findUrl+0;
			if($findUrl>0){
				$this->set('parecerestecnicos', $this->paginate('Parecerestecnico',array(" YEAR(`Parecerestecnico`.`entrada_cindacta`)=" . $findUrl ." OR (`Parecerestecnico`.`entrada_cindacta`)='" . $findUrl ."'  OR `Parecerestecnico`.`parecer` LIKE '%" . $findUrl ."%' OR  LOWER(`Parecerestecnico`.`oficio`) LIKE '%" . $findUrl ."%'  ")));
			}else{
				$this->set('parecerestecnicos', $this->paginate('Parecerestecnico',array(" LOWER(`Parecerestecnico`.`oficio`) LIKE '%" . $findUrl ."%'  OR LOWER(`Parecerestecnico`.`situacao`) LIKE '%" . $findUrl ."%'  OR LOWER(`Parecerestecnico`.`parecer`) LIKE '%" . $findUrl ."%'")));
			}
		} else {
			$this->Parecerestecnico->recursive = 0;
			$this->set('parecerestecnicos', $this->paginate());
		}

	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Parecerestecnico.', true));
			$this->redirect(array('action'=>'index'));
		}
		$file = $this->Parecerestecnico->findById($id);
		if(($file['Parecerestecnico']['type']=='application/pdf')||($file['Parecerestecnico']['type']=='application/save')){
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");;
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment;filename=parecer".$file['Parecerestecnico']['oficio'].'.pdf');
			echo stripslashes($file['Parecerestecnico']['arquivo']);
		}else{
			header('Content-type: text/html');
			header('Content-Disposition: attachment; filename=parecer'.$file['Parecerestecnico']['oficio'].'.html');
			echo $file['Parecerestecnico']['arquivo'];
		}
		exit();

	}

	function externoview($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Parecerestecnico.', true));
			$this->redirect(array('action'=>'index'));
		}
		$file = $this->Parecerestecnico->findById($id);
		if(($file['Parecerestecnico']['type']=='application/pdf')||($file['Parecerestecnico']['type']=='application/save')){
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");;
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment;filename=parecer".$file['Parecerestecnico']['oficio'].'.pdf');
			echo stripslashes($file['Parecerestecnico']['arquivo']);
		}else{
			header('Content-type: text/html');
			header('Content-Disposition: attachment; filename=parecer'.$file['Parecerestecnico']['oficio'].'.html');
			echo $file['Parecerestecnico']['arquivo'];
		}
		exit();

		
	}
	function add() {
		$status=1;
		if (is_uploaded_file($this->data['Parecerestecnico']['arquivos']['tmp_name'])){
			$conteudo = fread(fopen($this->data['Parecerestecnico']['arquivos']['tmp_name'], "r"),	$this->data['Parecerestecnico']['arquivos']['size']);
		}

		if (strlen($conteudo)>0) {
		//	print_r($this->data['Parecerestecnico']['arquivos']);
		//	exit();
			$this->data['Parecerestecnico']['type'] = $this->data['Parecerestecnico']['arquivos']['type'];
			$this->data['Parecerestecnico']['size'] = $this->data['Parecerestecnico']['arquivos']['size'];
			
			if ((stripos($this->data['Parecerestecnico']['arquivos']['type'],'application') !== false)||(stripos($this->data['Parecerestecnico']['arquivos']['type'],'htm') !== false)||(stripos($this->data['Parecerestecnico']['arquivos']['type'],'pdf') !== false)||(stripos($this->data['Parecerestecnico']['arquivos']['type'],'application') !== false)){
				$this->data['Parecerestecnico']['arquivo'] = addslashes($conteudo);

			}else {
				$status=0;
				$this->Session->setFlash(__('Somente arquivos do tipo html ou pdf. Por favor, tente novamente.', true));
					
			}

		}
		unset($this->data['Parecerestecnico']['arquivos']);
		/*
		 echo '<pre>';
		 print_r($this->data);
		 echo 'status='.$status;
		 echo '</pre>';
		 */

		if (!empty($this->data)&&($status==1)) {
			$this->Parecerestecnico->create();
			if ($this->Parecerestecnico->save($this->data)) {
				$this->Session->setFlash(__('Os dados foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados não foram gravados. Por favor, tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		$status=1;
		if (is_uploaded_file($this->data['Parecerestecnico']['arquivos']['tmp_name'])){
			$conteudo = fread(fopen($this->data['Parecerestecnico']['arquivos']['tmp_name'], "r"),	$this->data['Parecerestecnico']['arquivos']['size']);
		}

		if (strlen($conteudo)>0) {
		//	print_r($this->data['Parecerestecnico']['arquivos']);
		//	exit();
			$this->data['Parecerestecnico']['type'] = $this->data['Parecerestecnico']['arquivos']['type'];
			$this->data['Parecerestecnico']['size'] = $this->data['Parecerestecnico']['arquivos']['size'];
			
			if ((stripos($this->data['Parecerestecnico']['arquivos']['type'],'application') !== false)||(stripos($this->data['Parecerestecnico']['arquivos']['type'],'htm') !== false)||(stripos($this->data['Parecerestecnico']['arquivos']['type'],'pdf') !== false)||(stripos($this->data['Parecerestecnico']['arquivos']['type'],'application') !== false)){
				$this->data['Parecerestecnico']['arquivo'] = addslashes($conteudo);

			}else {
				$status=0;
				$this->Session->setFlash(__('Somente arquivos do tipo html ou pdf. Por favor, tente novamente.', true));
					
			}

		}
		unset($this->data['Parecerestecnico']['arquivos']);
		/*
		 echo '<pre>';
		 print_r($this->data);
		 echo 'status='.$status;
		 echo '</pre>';
		 */

		if (!empty($this->data)&&($status==1)) {
			$this->Parecerestecnico->create();
			if ($this->Parecerestecnico->save($this->data)) {
				$this->Session->setFlash(__('Os dados foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados não foram gravados. Por favor, tente novamente.', true));
			}
		}
		

		if (empty($this->data)) {
			$this->data = $this->Parecerestecnico->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Parecerestecnico', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Parecerestecnico->delete($id)) {
			$this->Session->setFlash(__('Parecerestecnico excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>