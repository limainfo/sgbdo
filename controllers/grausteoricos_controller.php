<?php
class GrausteoricosController extends AppController {

	var $name = 'Grausteoricos';
	var $helpers = array('Html', 'Form');

	function index() {

/*
		$consultaSetor="select id,sigla_setor from setors where sigla_setor in (select ESCALA from aatco group by ESCALA)";
		$setores = $this->Grausteorico->query($consultaSetor);
		foreach($setores as $setor){
		$sql1 = "(select (select id from escalas where setor_id={$setor['setors']['id']}) escala_id, IDENTIDADE   from aatco where ESCALA='{$setor['setors']['sigla_setor']}')";
		$militars = $this->Grausteorico->query($sql1);
		
		$legenda = 'A';
		$contados = 0;
		foreach($militars as $dados){
			$contador++;
			$escala_id=$dados[0]['escala_id'];
			$militar_id=$dados['aatco']['IDENTIDADE'];
			$novaLegenda=$legenda.$contador;
			$insere="insert ignore into militars_escalas (escala_id, militar_id, legenda_prevista, legenda_cumprida, prevista, cumprida) values ({$escala_id} , {$militar_id}, '{$novaLegenda}', '{$novaLegenda}', 1, 1) 		";
			//echo $insere.'<br>';
			$this->Grausteorico->query($insere);
			
			
		}
		}
		*/		
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );

		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Posto.antiguidade,Militar.nm_completo asc";

		$militars = $this->Grausteorico->Militar->query($sql1);
       

		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);

		if ( $findUrl != '' ) {
			$opcoes = "LOWER(`Atividade`.`orgao`) LIKE '%" . $findUrl ."%' OR LOWER(`Atividade`.`desc_atividade`) LIKE '%" . $findUrl ."%' OR LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Grausteorico->recursive = 1;
					$registros = $this->Grausteorico->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Grausteorico->recursive = 2;
			$this->set('atividades', $this->paginate('Atividade',array("LOWER(`Atividade`.`orgao`) LIKE '%" . $findUrl ."%' OR LOWER(`Atividade`.`desc_atividade`) LIKE '%" . $findUrl ."%' OR LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' ")));
			$this->set(compact('militars','atividades'));
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Grausteorico->recursive = 1;
					$registros = $this->Grausteorico->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Grausteorico->recursive = 1;
			$this->set('grausteoricos', $this->paginate());
			$this->set(compact('militars','grausteoricos'));
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Atividade.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('atividade', $this->Grausteorico->read(null, $id));
	}

	function add($id=null) {
		if (!empty($this->data)) {
			$this->Grausteorico->create();
			if ($this->Grausteorico->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Atividade foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Atividade não foram gravados. Por favor, tente novamente.', true));
			}
		}

		$sql = 'select distinct(sigla_setor) from setors order by sigla_setor asc ';
		$setor = $this->Grausteorico->query($sql);

		if($id!=null){
		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
WHERE Militar.id=$id
order by Posto.antiguidade,Militar.nm_completo asc";
		}else{
		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Posto.antiguidade,Militar.nm_completo asc";
			
		}

		$militars = $this->Grausteorico->Militar->query($sql1);

		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);
		$this->set(compact('militars','setor','id'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Atividade inválida!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Grausteorico->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Atividade foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Atividade não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$verifica = 0;
		if (empty($this->data)) {
			$this->data = $this->Grausteorico->read(null, $id);
			$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
WHERE Militar.id={$this->data['Atividade']['militar_id']}
order by Posto.antiguidade,Militar.nm_completo asc";

			$militars = $this->Grausteorico->Militar->query($sql1);
			$verifica = 1;
		}
		$sql = 'select distinct(sigla_setor) from setors order by sigla_setor asc ';
		$setor = $this->Grausteorico->query($sql);

		if($verifica!=1){
			$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
WHERE Militar.id={$this->data['Atividade']['militar_id']}
order by Posto.antiguidade,Militar.nm_completo asc";

			$militars = $this->Grausteorico->Militar->query($sql1);
			
		}



		$this->set(compact('militars','setor'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Grausteorico', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Grausteorico->delete($id)) {
			$this->Session->setFlash(__('Grausteorico excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>