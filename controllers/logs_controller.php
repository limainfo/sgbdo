<?php
class LogsController extends AppController {

	var $name = 'Logs';
	var $helpers = array('Html', 'Form');

	function index() {

		$findUrl = low(trim($this->data['formFind']['find']) );
		
		if ( $findUrl != '' ) {
			$opcoes = " (LOWER(`Log`.`title`) LIKE '%".$findUrl."%' OR LOWER(`Log`.`model`) LIKE '%".$findUrl."%' OR LOWER(`Log`.`action`) LIKE '%" . $findUrl ."%' OR LOWER(`Log`.`usuario_nome`) LIKE '%" . $findUrl ."%' OR LOWER(`Log`.`changes`) LIKE '%" . $findUrl ."%' OR LOWER(`Log`.`ip`) LIKE '%" . $findUrl ."%') ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Log->recursive = 1;
					$registros = $this->Log->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Log->recursive = 0;
			$this->set('logs', $this->paginate('Log',array(" (LOWER(`Log`.`title`) LIKE '%".$findUrl."%' OR LOWER(`Log`.`model`) LIKE '%".$findUrl."%' OR LOWER(`Log`.`action`) LIKE '%" . $findUrl ."%' OR LOWER(`Log`.`usuario_nome`) LIKE '%" . $findUrl ."%' OR LOWER(`Log`.`changes`) LIKE '%" . $findUrl ."%' OR LOWER(`Log`.`ip`) LIKE '%" . $findUrl ."%') ")));	
						
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Log->recursive = 1;
					$registros = $this->Log->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Log->recursive = 0;
			$this->set('logs', $this->paginate());
															
			}
	}

	function view($id = null) {
		$this->layout = 'admin';

		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Log.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('log', $this->Log->read(null, $id));
	}




}
?>