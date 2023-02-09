<?php
class TesteopprovasController extends AppController {

	var $name = 'Testeopprovas';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');
    var $components = array('RequestHandler');
    var $paginate = array('limit' => 15, 'page' => 1, 'order'=>array('nm_prova'=>'asc'));
	
function add() {
		//$this->layout = null;
		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
		 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
		order by Posto.antiguidade,Militar.nm_completo asc";
		$this->set('testeopprovas', $this->Testeopprova->find('all'));

		$this->set(compact('militars'));
}

function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido ', true));
			$this->redirect(array('action'=>'add'));
		}
		$oculta= "&nbsp;&nbsp;<a onclick=\"this.href='#';HideContent('flashMsg');return false;\" href=\"{$this->webroot}testeopprovas/externoedit\"><img border=\"0\" title=\"Oculta\" alt=\"Ocultar\" src=\"{$this->webroot}img/btsair.gif\"></a>";
		if ($this->Testeopprova->delete($id)) {
			$this->Session->setFlash(__('Registro excluído'.$oculta, true));
			$this->redirect(array('action'=>'add'));
		}
}
 
function externoedit($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Testeopprova->read(null,$id);
}

function externoadd($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Testeopprova->read(null,$id);
}

function externoeditgrava($id = null) {
	
		$this->layout = null;
//		$this->data['Militar']['id']=$this->data['Militar']['militar_id'];
//		unset($this->data['Militar']['militar_id']);
//		unset($divisao);
//		unset($subdivisao);
		$ok=0;
		if (!empty($this->data)) {
			$this->Testeopprova->create();
			if ($this->Testeopprova->save($this->data)) {
				$ok=1;
			} else {
				$ok=0;
			}
		}
		$this->set(compact('ok'));
}

function externolista($id = null) {
		$this->layout = 'ajax';
		return $this->Testeopprova->find('all');
}


}
?>