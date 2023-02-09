<?php
class ChamadaefetivosController extends AppController {

	var $name = 'Chamadaefetivos';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');

function add() {
		//$this->layout = null;
	$u = $this->Session->read('Usuario');
	$divisao=$u[0]['Usuario']['divisao'];
	$compara = $u[0]['Usuario']['privilegio_id'];
	if(($compara==1)||(($compara==17)&&(!empty($divisao)))){
	
		$organizacoes = $this->arvore;
		$this->set(compact('organizacoes'));
	}
}

function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido ', true));
			$this->redirect(array('action'=>'add'));
		}
		$oculta= "&nbsp;&nbsp;<a onclick=\"this.href='#';HideContent('flashMsg');return false;\" href=\"{$this->webroot}testeopprovas/externoedit\"><img border=\"0\" title=\"Oculta\" alt=\"Ocultar\" src=\"{$this->webroot}img/btsair.gif\"></a>";
		if ($this->Chamadaefetivo->delete($id)) {
			$this->Session->setFlash(__('Registro excluído'.$oculta, true));
			$this->redirect(array('action'=>'add'));
		}
}
 
function externoedit($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Chamadaefetivo->read(null, $id);
//		$this->set(compact(  'especialidades', 'testeopprovas','organizacoes'));		
}

function externoadd($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;

		$u = $this->Session->read('Usuario');
		$divisao=$u[0]['Usuario']['divisao'];
		$compara = $u[0]['Usuario']['privilegio_id'];
		if(($compara==1)||(($compara==17)&&(!empty($divisao)))){
		
		$id = $this->data['id'];
		$this->data = $this->Chamadaefetivo->read(null,$id);
		//$this->Chamadaefetivo->recursive=1;
		//$especialidades = $this->Chamadaefetivo->Especialidade->find('list');
		$resultado = $this->Chamadaefetivo->query('select * from chamadaefetivos Chamadaefetivo ');
		$especialidades[0] = 'Selecione uma Especialidade';
		foreach($resultado as $dado){
			$especialidades[$dado['Chamadaefetivo']['id']]=$dado['Chamadaefetivo']['id'];
		}
		
		$organizacoes = $this->arvore;
	
		//$setors = $this->Chamadaefetivo->Setor->find('list');
		$testeopprovas = $this->Chamadaefetivo->find('list');
		$this->set(compact(  'especialidades', 'testeopprovas','organizacoes'));

		}
}

function externoeditgrava($id = null) {
	
		$this->layout = null;
//		$this->data['Militar']['id']=$this->data['Militar']['militar_id'];
//		unset($this->data['Militar']['militar_id']);
//		unset($divisao);
//		unset($subdivisao);
		$ok=0;
		$u = $this->Session->read('Usuario');
		$divisao=$u[0]['Usuario']['divisao'];
		$compara = $u[0]['Usuario']['privilegio_id'];
		if(($compara==1)||(($compara==17)&&(!empty($divisao)))){	
			if (!empty($this->data)) {
				$this->Chamadaefetivo->create();
				if ($this->Chamadaefetivo->save($this->data)) {
					$ok=1;
				} else {
					$ok=0;
				}
			}
			
		}
		$this->set(compact('ok'));
}

function externolista($id = null) {
		$this->layout = 'ajax';
		$u = $this->Session->read('Usuario');
		$divisao=$u[0]['Usuario']['divisao'];
		$compara = $u[0]['Usuario']['privilegio_id'];
		if(($compara==1)){
			$sql = "select * FROM chamadaefetivos as Chamadaefetivo 
					order by  Chamadaefetivo.divisao asc, Chamadaefetivo.nome_chamada asc, Chamadaefetivo.nome_militar asc";
		}

		if(($compara==17)&&(!empty($divisao))){
			$sql = "select * FROM chamadaefetivos as Chamadaefetivo 
					where Chamadaefetivo.divisao='$divisao'
					order by  Chamadaefetivo.divisao asc, Chamadaefetivo.nome_chamada asc, Chamadaefetivo.nome_militar asc";
		}
					
		return $this->Chamadaefetivo->query($sql);
		
		//return $this->Chamadaefetivo->find('all');
}
function externosetores() {
		$this->layout = 'ajax';
		//$consulta=$this->Chamadaefetivo->Setor->find('list',array('conditions'=>array('Setor.unidade_id'=>$this->data['Chamadaefetivo']['unidade_id'])));
		$consulta[0] = '---';

		$sql = "select Setor.sigla_setor, Setor.id
		FROM setors as Setor
		inner join unidades on (unidades.id=Setor.unidade_id and unidades.id={$this->data['Chamadaefetivo']['unidade_id']})
		where Setor.id not in (select setor_id from escalas)
		order by  Setor.sigla_setor asc ";
		$consulta = $this->Chamadaefetivo->query($sql);
		
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Setor']['id']}'>{$conteudo['Setor']['sigla_setor']}</option>";
			//$setors[$conteudo['Setor']['id']]=$conteudo['Setor']['sigla_setor'];
		}
		
	//	foreach($consulta as $k => $v){	echo "<option value='$k'>$v</option>"; }
	
		exit();
		
}


}
?>