<?php
class TesteopcandidatosController extends AppController {

	var $name = 'Testeopcandidatos';

	
function edit(){
		$u=$this->Session->read('Usuario');
                

		$resultado = $this->Testeopcandidato->query('select 
		Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao, Testeopprova.nm_prova, Especialidade.nm_especialidade,
		Testeopprovaagendada.id
		 from testeopprovasagendadas Testeopprovaagendada
		inner join testeopprovas Testeopprova on (Testeopprova.id=Testeopprovaagendada.testeopprova_id)
		inner join especialidades Especialidade on (Especialidade.id=Testeopprovaagendada.especialidade_id)
		order by Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao,  Testeopprova.nm_prova, Especialidade.nm_especialidade asc ');
		$testeopprovasagendadas[0] = 'Selecione uma prova';
		foreach($resultado as $dado){
			$testeopprovasagendadas[$dado['Testeopprovaagendada']['id']]=$dado['Testeopprovaagendada']['ano'].' - '.$dado['Testeopprovaagendada']['divisao'].' - '.$dado['Testeopprovaagendada']['subdivisao'].' - '.$dado['Testeopprova']['nm_prova'];
			//.' - '.$dado['Especialidade']['nm_especialidade']
		}
		$sql = "select Especialidade.id, Especialidade.nm_especialidade, Quadro.sigla_quadro 
		from especialidades Especialidade 
		inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		order by Quadro.sigla_quadro, Especialidade.nm_especialidade asc";
		
		$resultados = $this->Testeopcandidato->query($sql);
		$especialidades[0] = 'Selecione uma especialidade';
		foreach($resultados as $dado){
			$especialidades[$dado['Especialidade']['id']]=$dado['Quadro']['sigla_quadro'].'-'.$dado['Especialidade']['nm_especialidade'];
		}
		
		/*
		$sql = "select Unidade.id, Unidade.sigla_unidade from unidades Unidade order by Unidade.sigla_unidade asc";
		$unidade = $this->Testeopcandidato->query($sql);
		*/
		
		$setors[0] = 'Selecione a Unidade';
		
		$unidades = $this->Testeopcandidato->Unidade->find('list');
		
		$setors = $this->Testeopcandidato->Setor->find('list');
		$unidades[0] = 'Selecione a Unidade';
		
		
		
		$this->set(compact(  'especialidades', 'testeopprovasagendadas', 'unidades', 'setors'));		

//		$this->set(compact(  'especialidades', 'testeopprovasagendadas', 'testeopcandidatos', 'unidades', 'setors', 'militars'));		
	
	
}
	
function view(){
		$this->layout = 'admin';
		$u=$this->Session->read('Usuario');
                
		//$esquema = $this->Testeopcandidato->_schema;

		$esquema['Ano']['campo'] = 'Testeopprovasagendada.ano';
		$esquema['Ano']['type'] = 'integer';
		$esquema['Ano']['nome'] = 'Ano';
		
		$esquema['Unidade']['campo'] = 'Unidade.sigla_unidade';
		$esquema['Unidade']['type'] = 'string';
		$esquema['Unidade']['nome'] = 'Unidade';
		
		$esquema['Setor']['campo'] = 'Setor.sigla_unidade';
		$esquema['Setor']['type'] = 'string';
		$esquema['Setor']['nome'] = 'Setor';
		
		$esquema['Militar']['campo'] = 'Setor.sigla_unidade';
		$esquema['Setor']['type'] = 'string';
		$esquema['Setor']['nome'] = 'Setor';
		
		$this->set('esquema',$esquema);
		
		$resultado = $this->Testeopcandidato->query('select 
		Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao, Testeopprova.nm_prova, Especialidade.nm_especialidade,
		Testeopprovaagendada.id
		 from testeopprovasagendadas Testeopprovaagendada
		inner join testeopprovas Testeopprova on (Testeopprova.id=Testeopprovaagendada.testeopprova_id)
		inner join especialidades Especialidade on (Especialidade.id=Testeopprovaagendada.especialidade_id)
		order by Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao,  Testeopprova.nm_prova, Especialidade.nm_especialidade asc ');
		$testeopprovasagendadas[0] = 'Selecione uma prova';
		foreach($resultado as $dado){
			$testeopprovasagendadas[$dado['Testeopprovaagendada']['id']]=$dado['Testeopprovaagendada']['ano'].' - '.$dado['Testeopprovaagendada']['divisao'].' - '.$dado['Testeopprovaagendada']['subdivisao'].' - '.$dado['Testeopprova']['nm_prova'];
			//.' - '.$dado['Especialidade']['nm_especialidade']
		}
		$sql = "select Especialidade.id, Especialidade.nm_especialidade, Quadro.sigla_quadro 
		from especialidades Especialidade 
		inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		order by Quadro.sigla_quadro, Especialidade.nm_especialidade asc";
		
		$resultados = $this->Testeopcandidato->query($sql);
		$especialidades[0] = 'Selecione uma especialidade';
		foreach($resultados as $dado){
			$especialidades[$dado['Especialidade']['id']]=$dado['Quadro']['sigla_quadro'].'-'.$dado['Especialidade']['nm_especialidade'];
		}
		
		/*
		$sql = "select Unidade.id, Unidade.sigla_unidade from unidades Unidade order by Unidade.sigla_unidade asc";
		$unidade = $this->Testeopcandidato->query($sql);
		*/
		
		$setors[0] = 'Selecione a Unidade';
		
		$unidades = $this->Testeopcandidato->Unidade->find('list');
		
		$setors = $this->Testeopcandidato->Setor->find('list');
		$unidades[0] = 'Selecione a Unidade';
		
		
		
		$this->set(compact(  'especialidades', 'testeopprovasagendadas', 'unidades', 'setors'));		

//		$this->set(compact(  'especialidades', 'testeopprovasagendadas', 'testeopcandidatos', 'unidades', 'setors', 'militars'));		
	
	
}

function add() {
		//$this->layout = null;
}

function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido ', true));
			$this->redirect(array('action'=>'add'));
		}
		$oculta= "&nbsp;&nbsp;<a onclick=\"this.href='#';HideContent('flashMsg');return false;\" href=\"{$this->webroot}testeopprovas/externoedit\"><img border=\"0\" title=\"Oculta\" alt=\"Ocultar\" src=\"{$this->webroot}img/btsair.gif\"></a>";
		if ($this->Testeopcandidato->delete($id)) {
			$this->Session->setFlash(__('Registro excluído'.$oculta, true));
			$this->redirect(array('action'=>'add'));
		}
}
 
function externoedit($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$this->Testeopcandidato->recursive = null;
		$this->data = $this->Testeopcandidato->read(null,$id);
		
		//print_r($this->data);
		
		
		$resultado = $this->Testeopcandidato->query('select 
		Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao, Testeopprova.nm_prova, Especialidade.nm_especialidade,
		Testeopprovaagendada.id
		 from testeopprovasagendadas Testeopprovaagendada
		inner join testeopprovas Testeopprova on (Testeopprova.id=Testeopprovaagendada.testeopprova_id)
		inner join especialidades Especialidade on (Especialidade.id=Testeopprovaagendada.especialidade_id)
		order by Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao,  Testeopprova.nm_prova, Especialidade.nm_especialidade asc ');
		$testeopprovasagendadas[0] = 'Selecione uma prova';
		foreach($resultado as $dado){
			$testeopprovasagendadas[$dado['Testeopprovaagendada']['id']]=$dado['Testeopprovaagendada']['ano'].' - '.$dado['Testeopprovaagendada']['divisao'].' - '.$dado['Testeopprovaagendada']['subdivisao'].' - '.$dado['Testeopprova']['nm_prova'];
			//.' - '.$dado['Especialidade']['nm_especialidade']
		}
		$sql = "select Especialidade.id, Especialidade.nm_especialidade, Quadro.sigla_quadro 
		from especialidades Especialidade 
		inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		order by Quadro.sigla_quadro, Especialidade.nm_especialidade asc";
		
		$resultados = $this->Testeopcandidato->query($sql);
		$especialidades[0] = 'Selecione uma especialidade';
		foreach($resultados as $dado){
			$especialidades[$dado['Especialidade']['id']]=$dado['Quadro']['sigla_quadro'].'-'.$dado['Especialidade']['nm_especialidade'];
		}
		
		/*
		$sql = "select Unidade.id, Unidade.sigla_unidade from unidades Unidade order by Unidade.sigla_unidade asc";
		$unidade = $this->Testeopcandidato->query($sql);
		*/
		
		$setors[0] = 'Selecione a Unidade';
		
		$unidades = $this->Testeopcandidato->Unidade->find('list');
		
		$setors = $this->Testeopcandidato->Setor->find('list');
		$unidades[0] = 'Selecione a Unidade';
		
		
		
		$this->set(compact(  'especialidades', 'testeopprovasagendadas', 'unidades', 'setors'));		

//		$this->set(compact(  'especialidades', 'testeopprovasagendadas', 'testeopcandidatos', 'unidades', 'setors', 'militars'));		
	
	
}

function externoadd($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Testeopcandidato->read(null,$id);
		$resultado = $this->Testeopcandidato->query('select 
		Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao, Testeopprova.nm_prova, Especialidade.nm_especialidade,
		Testeopprovaagendada.id
		 from testeopprovasagendadas Testeopprovaagendada
		inner join testeopprovas Testeopprova on (Testeopprova.id=Testeopprovaagendada.testeopprova_id)
		inner join especialidades Especialidade on (Especialidade.id=Testeopprovaagendada.especialidade_id)
		order by Testeopprovaagendada.ano, Testeopprovaagendada.divisao, Testeopprovaagendada.subdivisao,  Testeopprova.nm_prova, Especialidade.nm_especialidade asc ');
		$testeopprovasagendadas[0] = 'Selecione uma prova';
		foreach($resultado as $dado){
			$testeopprovasagendadas[$dado['Testeopprovaagendada']['id']]=$dado['Testeopprovaagendada']['ano'].' - '.$dado['Testeopprovaagendada']['divisao'].' - '.$dado['Testeopprovaagendada']['subdivisao'].' - '.$dado['Testeopprova']['nm_prova'];
			//.' - '.$dado['Especialidade']['nm_especialidade']
		}
		$sql = "select Especialidade.id, Especialidade.nm_especialidade, Quadro.sigla_quadro 
		from especialidades Especialidade 
		inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		order by Quadro.sigla_quadro, Especialidade.nm_especialidade asc";
		
		$resultados = $this->Testeopcandidato->query($sql);
		$especialidades[0] = 'Selecione uma especialidade';
		foreach($resultados as $dado){
			$especialidades[$dado['Especialidade']['id']]=$dado['Quadro']['sigla_quadro'].'-'.$dado['Especialidade']['nm_especialidade'];
		}
		
		$sql = "select Unidade.id, Unidade.sigla_unidade from unidades Unidade order by Unidade.sigla_unidade asc";
		$unidade = $this->Testeopcandidato->query($sql);
		$setors[0] = 'Selecione a Unidade';

		$unidades = $this->Testeopcandidato->Unidade->find('list');
		$unidades[0] = 'Selecione a Unidade';
		
		
		
		$this->set(compact(  'especialidades', 'testeopprovasagendadas', 'unidades', 'setors'));		
}

function externoeditgrava($id = null) {
    unset($this->data['Testeopcandidato']['especialidade_id']);
    unset($this->data['Testeopcandidato']['militar_id']);
	$this->layout = null;
		$ok=0;
		if (!empty($this->data)) {
			$this->Testeopcandidato->create();
			if ($this->Testeopcandidato->save($this->data)) {
				$ok=1;
			} else {
				$ok=0;
			}
		}
		$this->set(compact('ok'));
}

function externolista($id = null) {
		$this->layout = 'ajax';
		$sql = "select *
		from testeopcandidatos as Testeopcandidato
		inner join testeopprovasagendadas Testeopprovasagendada on (Testeopprovasagendada.id=Testeopcandidato.testeopprovasagendada_id)
		inner join testeopprovas Testeopprova on (Testeopprova.id=Testeopprovasagendada.testeopprova_id)
		inner join unidades Unidade on (Unidade.id=Testeopcandidato.unidade_id)
		inner join setors Setor on (Setor.id=Testeopcandidato.setor_id)
		inner join especialidades Especialidade on (Especialidade.id=Testeopprovasagendada.especialidade_id)
		order by  Testeopprovasagendada.ano asc, Testeopprova.nm_prova asc, Testeopcandidato.nm_candidato asc ";
		
		return $this->Testeopcandidato->query($sql);
}

function externoconsulta($id = null) {
		$this->layout = null;
		if(!empty($this->data['Militar'])){
			
			foreach($this->data['Militar']['inclusao'] as $incluir){
				$this->Testeopcandidato->Militar->recursive=1;
				$this->Testeopcandidato->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Escala'), 'hasOne'=>array('Assinatura','Foto'), 'hasMany'=>array('Afastamento', 'Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso', 'Escala')));
				$resultado = $this->Testeopcandidato->Militar->read(null,$incluir);
				$dado['Testeopcandidato']['unidade_id']=$resultado['Militar']['unidade_id'];
				$dado['Testeopcandidato']['setor_id']=$resultado['Militar']['setor_id'];
				$dado['Testeopcandidato']['testeopprovasagendada_id']=$this->data['Testeopcandidato']['testeopprovasagendada_id'];
				$dado['Testeopcandidato']['militar_id']=$resultado['Militar']['id'];
				$dado['Testeopcandidato']['nm_candidato']=$resultado['Posto']['sigla_posto'].' '.$resultado['Quadro']['sigla_quadro'].' '.$resultado['Especialidade']['nm_especialidade'].'  '.$resultado['Militar']['nm_completo'];
				$this->Testeopcandidato->create();
				$this->Testeopcandidato->save($dado);
				unset($dado);
				
			}
			foreach($this->data['Militar']['exclusao'] as $incluir){
				$this->Testeopcandidato->delete($incluir);
			}
		}
		$sql = "select *
		from militars as Militar
		inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id and Especialidade.id='{$this->data['Testeopcandidato']['especialidade_id']}' )
		inner join setors Setor on (Setor.id=Militar.setor_id)
		inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
		inner join postos Posto on (Posto.id=Militar.posto_id)
		left join testeopcandidatos as Testeopcandidato on (Testeopcandidato.militar_id=Militar.id)
		left join testeopprovasagendadas Testeopprovasagendada on (Testeopprovasagendada.id=Testeopcandidato.testeopprovasagendada_id)
		left join testeopprovas Testeopprova on (Testeopprova.id=Testeopprovasagendada.testeopprova_id)
		      where Militar.ativa='1'
		
		order by  Unidade.sigla_unidade asc, Setor.sigla_setor asc, Posto.antiguidade asc, Militar.nm_completo asc ";
		
		//echo $sql;
		
		$dados = $this->Testeopcandidato->query($sql);
		$this->set(compact('dados'));
}


function externosetores() {
		$this->layout = 'ajax';
		//$consulta=$this->Testeopcandidato->Setor->find('list',array('conditions'=>array('Setor.unidade_id'=>$this->data['Testeopcandidato']['unidade_id'])));
		$consulta[0] = '---';

		$sql = "select Setor.sigla_setor, Setor.id
		FROM setors as Setor
		inner join unidades on (unidades.id=Setor.unidade_id and unidades.id='{$this->data['Testeopcandidato']['unidade_id']}')
		order by  Setor.sigla_setor asc ";
		$consulta = $this->Testeopcandidato->query($sql);
		
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Setor']['id']}'>{$conteudo['Setor']['sigla_setor']}</option>";
			//$setors[$conteudo['Setor']['id']]=$conteudo['Setor']['sigla_setor'];
		}
		
	//	foreach($consulta as $k => $v){	echo "<option value='$k'>$v</option>"; }
	
		exit();
		
}
function externomilitares() {
		$this->layout = 'ajax';
		//$consulta=$this->Testeopcandidato->Setor->find('list',array('conditions'=>array('Setor.unidade_id'=>$this->data['Testeopcandidato']['unidade_id'])));
		$consulta[0] = '---';

		$sql = "select Militar.id, Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade,
		Militar.nm_completo
		FROM militars Militar
		inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id and Especialidade.id='{$this->data['Testeopcandidato']['especialidade_id']}' )
		inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		inner join postos Posto on (Posto.id=Militar.posto_id)
		where Militar.ativa='1'
		order by  Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade,
		Militar.nm_completo asc ";
		$consulta = $this->Testeopcandidato->query($sql);
		
		echo "<option value=''>Selecione o militar</option>";
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Militar']['id']}'>{$conteudo['Posto']['sigla_posto']} {$conteudo['Quadro']['sigla_quadro']} {$conteudo['Especialidade']['nm_especialidade']} - {$conteudo['Militar']['nm_completo']}</option>";
			//$setors[$conteudo['Setor']['id']]=$conteudo['Setor']['sigla_setor'];
		}
		
	//	foreach($consulta as $k => $v){	echo "<option value='$k'>$v</option>"; }
	
		exit();
		
}



function externoespecialidadeid() {
		$this->layout = 'ajax';
		$opcoes = array('Testeopprovasagendada.id'=>$this->data['Testeopcandidato']['testeopprovasagendada_id']);
		$consulta = $this->Testeopcandidato->Testeopprovasagendada->find('all',array('conditions'=>$opcoes));
		$especialidadeId = $consulta[0]['Especialidade']['id'];
		echo '{ "especialidadeid":"'.$especialidadeId.'"}';
		
	//	print_r($consulta);
		exit();
		
}
}
?>