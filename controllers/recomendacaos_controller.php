<?php
class RecomendacaosController extends AppController {

	var $name = 'Recomendacaos';
	var $helpers = array('Html', 'Form');
	var $paginate = array('limit'=>10);
	
	function index() {
		$findUrl = low(trim($this->data['formFind']['find']) );
		if ( $findUrl != '' ) {
			$this->Recomendacao->recursive = 0;
			$opcoes = "LOWER(`Recomendacao`.`documento`) LIKE '%" . $findUrl ."%' OR LOWER(`Recomendacao`.`localidade`) LIKE '%" . $findUrl ."%' OR LOWER(`Recomendacao`.`setor`) LIKE '%" . $findUrl ."%' OR LOWER(`Recomendacao`.`status`)  LIKE '%" . $findUrl."%' OR LOWER(`Recomendacao`.`numero_recomendacao`)  LIKE '%" . $findUrl."%'";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Recomendacao->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Recomendacao->recursive = 0;
			$this->set('recomendacaos', $this->paginate('Recomendacao',array("LOWER(`Recomendacao`.`documento`) LIKE '%" . $findUrl ."%' OR LOWER(`Recomendacao`.`localidade`) LIKE '%" . $findUrl ."%' OR LOWER(`Recomendacao`.`setor`) LIKE '%" . $findUrl ."%' OR LOWER(`Recomendacao`.`status`)  LIKE '%" . $findUrl."%' OR LOWER(`Recomendacao`.`numero_recomendacao`)  LIKE '%" . $findUrl."%'")));
		} else {
			$this->Recomendacao->recursive = 0;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Recomendacao->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Recomendacao->recursive = 0;
			$this->set('recomendacaos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Recomendacao.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('recomendacao', $this->Recomendacao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Recomendacao->create();
			if ($this->Recomendacao->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Recomendacao foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Recomendacao não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if(empty($this->data)){
			$sql = 'select distinct(documento) from recomendacaos ';
			$documento = $this->Recomendacao->query($sql);
			$sql = 'select distinct(localidade) from recomendacaos ';
			$localidade = $this->Recomendacao->query($sql);
			$sql = 'select distinct(setor) from recomendacaos ';
			$setor = $this->Recomendacao->query($sql);
			$sql = 'select distinct(status) from recomendacaos ';
			$status = $this->Recomendacao->query($sql);
			
			$this->set(compact('documento','localidade','setor','status'));
		}
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Valor inválido para Recomendacao', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Recomendacao->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Recomendacao foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Recomendacao não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$sql = 'select distinct(documento) from recomendacaos ';
			$documento = $this->Recomendacao->query($sql);
			$sql = 'select distinct(localidade) from recomendacaos ';
			$localidade = $this->Recomendacao->query($sql);
			$sql = 'select distinct(setor) from recomendacaos ';
			$setor = $this->Recomendacao->query($sql);
			$sql = 'select distinct(status) from recomendacaos ';
			$status = $this->Recomendacao->query($sql);
			
			$this->set(compact('documento','localidade','setor','status'));
			$this->data = $this->Recomendacao->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Recomendacao', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Recomendacao->delete($id)) {
			$this->Session->setFlash(__('Recomendacao excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function indexExcel($consulta = null)
	{

		$this->layout = 'openoffice' ; 
		$this->Recomendacao->recursive = null;
		$filtro = "";

		if(!empty($consulta)){
			$consulta = strtolower($consulta);
			$filtro = "LOWER(`Recomendacao`.`documento`) LIKE '%" . $consulta ."%' OR LOWER(`Recomendacao`.`localidade`) LIKE '%" . $consulta ."%' OR LOWER(`Recomendacao`.`setor`) LIKE '%" . $consulta ."%' OR LOWER(`Recomendacao`.`status`)  LIKE '%" . $consulta."%' OR LOWER(`Recomendacao`.`numero_recomendacao`)  LIKE '%" . $consulta."%'";
			$conteudo = $this->Recomendacao->find('all',array($filtro));
		}else{
			$conteudo = $this->Recomendacao->find('all');
		}
		
		$filtro = " Recomendacao.id > 0  ";
		$campos_busca = $this->Recomendacao->find('all',array($filtro));

		$i = 0;
		foreach($campos_busca[0]['Recomendacao'] as $campo=>$valor){
			$campos[$i] = $campo;
			$i ++;
		}
		
		//print_r($conteudo);
		$titulo = 'Dados de Recomendacao';
		$tabela = 'Recomendacao';
		$nome = 'planilha_recomendacao';

		//exit(1);
		$this->set(compact('titulo','tabela','conteudo','campos','nome'));
		$this->render();
	}
	
	
	
}
?>