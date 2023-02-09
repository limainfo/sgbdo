<?php
class TesteopprovasagendadasController extends AppController {

	var $name = 'Testeopprovasagendadas';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');

function add() {
		//$this->layout = null;
		$organizacoes = $this->arvore;
		$this->set(compact('organizacoes'));
}

function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido ', true));
			$this->redirect(array('action'=>'add'));
		}
		$oculta= "&nbsp;&nbsp;<a onclick=\"this.href='#';HideContent('flashMsg');return false;\" href=\"{$this->webroot}testeopprovas/externoedit\"><img border=\"0\" title=\"Oculta\" alt=\"Ocultar\" src=\"{$this->webroot}img/btsair.gif\"></a>";
		if ($this->Testeopprovasagendada->delete($id)) {
			$this->Session->setFlash(__('Registro excluído'.$oculta, true));
			$this->redirect(array('action'=>'add'));
		}
}
 
function externoedit($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Testeopprovasagendada->read(null, $id);
		
		$resultado = $this->Testeopprovasagendada->query('select Especialidade.id, Quadro.sigla_quadro, Especialidade.nm_especialidade from especialidades Especialidade inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id) order by Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc ');
		$especialidades[0] = 'Selecione uma Especialidade';
		foreach($resultado as $dado){
			$especialidades[$dado['Especialidade']['id']]=$dado['Quadro']['sigla_quadro'].' - '.$dado['Especialidade']['nm_especialidade'];
		}
		//$setors = $this->Testeopprovasagendada->Setor->find('list');
		$testeopprovas = $this->Testeopprovasagendada->Testeopprova->find('list');
		$organizacoes = $this->arvore;
		$this->set(compact(  'especialidades', 'testeopprovas','organizacoes'));		
}

function externoadd($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Testeopprovasagendada->read(null,$id);
		//$this->Testeopprovasagendada->recursive=1;
		//$especialidades = $this->Testeopprovasagendada->Especialidade->find('list');
		$resultado = $this->Testeopprovasagendada->query('select Especialidade.id, Quadro.sigla_quadro, Especialidade.nm_especialidade from especialidades Especialidade inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id) order by Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc ');
		$especialidades[0] = 'Selecione uma Especialidade';
		foreach($resultado as $dado){
			$especialidades[$dado['Especialidade']['id']]=$dado['Quadro']['sigla_quadro'].' - '.$dado['Especialidade']['nm_especialidade'];
		}
		
		$organizacoes = $this->arvore;
	
		//$setors = $this->Testeopprovasagendada->Setor->find('list');
		$testeopprovas = $this->Testeopprovasagendada->Testeopprova->find('list');
		$this->set(compact(  'especialidades', 'testeopprovas','organizacoes'));		
}

function externoeditgrava($id = null) {
	
		$this->layout = null;
//		$this->data['Militar']['id']=$this->data['Militar']['militar_id'];
//		unset($this->data['Militar']['militar_id']);
//		unset($divisao);
//		unset($subdivisao);
		$ok=0;
		if (!empty($this->data)) {
			$this->Testeopprovasagendada->create();
			if ($this->Testeopprovasagendada->save($this->data)) {
				$ok=1;
			} else {
				$ok=0;
			}
		}
		$this->set(compact('ok'));
}

function externolista($id = null) {
		$this->layout = 'ajax';
		$sql = "select Testeopprovasagendada.*,  Especialidade.*, Testeopprova.*
		FROM testeopprovasagendadas as Testeopprovasagendada
		inner join especialidades Especialidade on (Especialidade.id=Testeopprovasagendada.especialidade_id)
		inner join testeopprovas Testeopprova on (Testeopprova.id=Testeopprovasagendada.testeopprova_id)
		order by  Testeopprovasagendada.ano asc, Testeopprova.nm_prova asc ";
		return $this->Testeopprovasagendada->query($sql);
		
		//return $this->Testeopprovasagendada->find('all');
}
function externosetores() {
		$this->layout = 'ajax';
		//$consulta=$this->Testeopprovasagendada->Setor->find('list',array('conditions'=>array('Setor.unidade_id'=>$this->data['Testeopprovasagendada']['unidade_id'])));
		$consulta[0] = '---';

		$sql = "select Setor.sigla_setor, Setor.id
		FROM setors as Setor
		inner join unidades on (unidades.id=Setor.unidade_id and unidades.id={$this->data['Testeopprovasagendada']['unidade_id']})
		where Setor.id not in (select setor_id from escalas)
		order by  Setor.sigla_setor asc ";
		$consulta = $this->Testeopprovasagendada->query($sql);
		
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Setor']['id']}'>{$conteudo['Setor']['sigla_setor']}</option>";
			//$setors[$conteudo['Setor']['id']]=$conteudo['Setor']['sigla_setor'];
		}
		
	//	foreach($consulta as $k => $v){	echo "<option value='$k'>$v</option>"; }
	
		exit();
		
}

}
?>