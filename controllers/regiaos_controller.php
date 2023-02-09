<?php
class RegiaosController extends AppController {

	var $name = 'Regiaos';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']
		['find']) );
		$this->cleanData = $sanitize->clean(
		$this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
		if ( $findUrl != '' ) {
			$this->Regiao->recursive = 0;
			$opcoes = "LOWER(`Setor`.`sigla_setor`) LIKE '%" . $findUrl ."%' OR LOWER(`Setor`.`nm_chefe_setor`) LIKE '%" . $findUrl ."%'";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Regiao->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Regiao->recursive = 0;
			$this->set('Regiaos', $this->paginate('Regiao',array("LOWER(`Regiao`.`sigla_setor`) LIKE '%" . $findUrl ."%' OR LOWER(`Setor`.`nm_chefe_setor`) LIKE '%" . $findUrl ."%'")));
		} else {
			$this->Regiao->recursive = 0;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Regiao->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Regiao->recursive = 0;
			$this->set('Regiaos', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Setor.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Regiao->recursive = 2;
		$this->set('Regiao', $this->Regiao->read(null, $id));
	}

	function add() {
		
		if (!empty($this->data)) {
			$this->Regiao->create();
			if ($this->Regiao->save($this->data)) {
				$id = $this->Regiao->id;
				$lista_administradores_e_planejamento = 'select * from usuarios, setors_usuarios where setors_usuarios.usuario_id=usuarios.id and (usuarios.privilegio_id=1 or usuarios.privilegio_id=4) and setors_usuarios.setor_id<>'.$id.'  group by usuarios.id';
				$usuarios = $this->Regiao->query($lista_administradores_e_planejamento);
				foreach($usuarios as $dados){
					$atualizasetores = 'insert into setors_usuarios (id, usuario_id, setor_id) values (uuid(),"'.$dados['usuarios']['id'].'","'.$id.'") ';
					$this->Regiao->query($atualizasetores);					
				}
				
				$this->Session->setFlash(__('Os dados de  Setor foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Setor não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$unidades = $this->Regiao->Unidade->find('list');
		$this->set(compact('unidades'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Setor', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Regiao->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Setor foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Setor não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Regiao->read(null, $id);
		}
		$unidades = $this->Regiao->Unidade->find('list');
		$this->set(compact('unidades'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Setor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Regiao->delete($id)) {
			$this->Session->setFlash(__('Setor excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>