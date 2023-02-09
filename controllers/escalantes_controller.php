<?php
class EscalantesController extends AppController {

	var $name = 'Escalantes';
	var $helpers = array('Html', 'Form');




	function index($id = null) {
		$this->layout='admin';
		/*
		if (!empty($id)){
			$sql01 = "select * from turnos as Turno where escala_id=".$id;
			$sql02 = "select concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome, MilitarsEscala.id, MilitarsEscala.codigo  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and MilitarsEscala.escala_id=$id) order by Posto.antiguidade, Militar.dt_ultima_promocao, MilitarsEscala.codigo asc";
			$turnos = $this->Escala->query($sql01);
			$milescalas = $this->Escala->query($sql02);
		}else{
			$turnos=null;
			$milescalas=null;
		}

		$sql1 = "select concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) WHERE Posto.antiguidade<120 order by Posto.antiguidade asc";

		$chefes = $this->Escala->query($sql1);

		$cont = 0;
			
		foreach ($chefes as $chf){
			$chefe[$cont] = iconv('UTF-8','UTF-8',$chf[0]['nome']);
			$cont++;
		}


		$sql2 = "select concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) WHERE Posto.antiguidade<126 order by Posto.antiguidade asc";


		$chefesID = $this->Escala->query($sql2);

		$cont = 0;


		foreach ($chefesID as $chf){
			$chefeID[$cont] = iconv('UTF-8','UTF-8',$chf[0]['nome']);
			$cont++;
		}


		$sql3 = "select concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome, Militar.id  FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)  order by Posto.antiguidade, Militar.dt_ultima_promocao asc";

		$militaresid = $this->Escala->query($sql3);



		$sql = "select Escala.id, Escala.setor_id, Escala.nm_escalante, Escala.nm_comandante, Escala.dt_limite_cumprida, Escala.dt_limite_previsao,
		 Setor.sigla_setor, Setor.id, Unidade.sigla_unidade, Unidade.id, Estado.nome, Estado.id  FROM escalas as Escala INNER JOIN setors as Setor ON(Escala.setor_id = Setor.id) INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 INNER JOIN estados as Estado on (Unidade.estado_id=Estado.id) WHERE Escala.ativa=1";

		$escalas = $this->Escala->query($sql);
		
		$sql = "select Setor.id, concat(Estado.nome,'-',Unidade.sigla_unidade,'-',Setor.sigla_setor) setor  FROM setors as Setor INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 INNER JOIN estados as Estado on (Unidade.estado_id=Estado.id) order by Estado.nome, Unidade.sigla_unidade, Setor.sigla_setor ASC";

		$setors = $this->Escala->query($sql);
			
		$militars = $this->Escala->Militar->find('list');


		$raiz = $this->webroot;

		if ((trim($this->data['formFind']['find'])!='')){
			uses('sanitize');
			$sanitize = new Sanitize();
			$this->set('findUrlNotCleaned',	trim($this->data['formFind']['find']) );
			$this->cleanData = $sanitize->clean($this->data );
			$findUrl = low(trim($this->cleanData['formFind']['find']) );
			if ( $findUrl != '' ) {
				$this->Escala->recursive = 2;
		
				$sql = "select Escala.id, Escala.setor_id, Escala.nm_escalante, Escala.nm_comandante, Escala.dt_limite_cumprida, Escala.dt_limite_previsao,
		 Setor.sigla_setor, Setor.id, Unidade.sigla_unidade, Unidade.id, Estado.nome, Estado.id  FROM escalas as Escala INNER JOIN setors as Setor ON(Escala.setor_id = Setor.id) INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 INNER JOIN estados as Estado on (Unidade.estado_id=Estado.id) WHERE Escala.ativa=1 AND LOWER(`Setor`.`sigla_setor`) LIKE '%" . $findUrl ."%' ";

				$escalas = $this->Escala->query($sql);
				
				$this->set('escalas', $this->paginate('Escala'));
				$this->set(compact('militars', 'setors', 'chefe','chefeID','raiz','escalas','militaresid','turnos','milescalas'));
					
			} else {
				$this->Escala->recursive = 0;
				$this->set('escalas', $this->paginate('Escala',array("`Escala`.`ativa`=1")));
				$this->set(compact('militars', 'setors', 'chefe','chefeID','raiz','escalas','militaresid','turnos','milescalas'));
					
			}


			$this->render('add');
				


		}else{


			if (!empty($this->data)&&($this->data['Escala']['contaTurnos']>0)) {
				$this->Escala->create();
				if ($this->Escala->save($this->data)) {

					$sql = "insert into turnos (escala_id, hora_inicio, hora_termino, qtd, dt_escala) values";
					$conta = $this->data['Escala']['contaTurnos'];
					$conta--;
					$escala = $this->Escala->read(null, $this->Escala->id);


					for ($x=0;$x<$conta;$x++){
						$c = $x +1;
						$sql .= '('.$escala['Escala']['id'].',"'.$this->data['Escala']['turno_inicio']['hour'][$x].':'.$this->data['Escala']['turno_inicio']['min'][$x].'","'.$this->data['Escala']['turno_inicio']['hour'][$c].':'.$this->data['Escala']['turno_inicio']['min'][$c].'",'.$this->data['Escala']['turno_qtd'][$x].',"'.$escala['Escala']['created'].'"),';
					}
					$sql .= '('.$escala['Escala']['id'].',"'.$this->data['Escala']['turno_inicio']['hour'][$x].':'.$this->data['Escala']['turno_inicio']['min'][$x].'","'.$this->data['Escala']['turno_inicio']['hour'][0].':'.$this->data['Escala']['turno_inicio']['min'][0].'",'.$this->data['Escala']['turno_qtd'][$x].',"'.$escala['Escala']['created'].'")';

					//echo $sql;
					$this->Escala->query($sql);


					$sql = "insert into militars_escalas (escala_id, militar_id, codigo) values ";
					$conta = $this->data['Escala']['contaMilitares'];
					$conta--;
					for ($x=0;$x<$conta;$x++){
						$sql .= '('.$escala['Escala']['id'].','.$this->data['Escala']['militares_id'][$x].',"'.$this->data['Escala']['legendas'][$x].'"),';
					}
					$sql .= '('.$escala['Escala']['id'].','.$this->data['Escala']['militares_id'][$x].',"'.$this->data['Escala']['legendas'][$x].'")';

					//echo $sql;
					$this->Escala->query($sql);



					$this->Session->setFlash(__('Os dados da Escala foram gravados.', true));

					//$this->set('escalas', $this->paginate());
					//$this->set(compact('militars', 'setors', 'chefe','chefeID','raiz','escalas'));
					//$this->render('add');
				} else {
					$this->Session->setFlash(__('Os dados de Escala não foram gravados. Por favor, tente novamente.', true));
					$this->redirect(array('action'=>'add'));
				}
			}
			if (empty($this->data)&&($id>0)) {
				$this->Escala->recursive = 0;
				$data = $this->Escala->read(null, $id);
				$this->set('escalas', $this->paginate('Escala',array("`Escala`.`ativa`=1")));
				$this->set(compact('militars', 'setors', 'chefe','chefeID','raiz','escalas','militaresid','turnos','milescalas','data'));
				//$this->render('add');
			}
			$this->data = null;

			$sql = "select Escala.id, Escala.setor_id, Escala.nm_escalante, Escala.nm_comandante, Escala.dt_limite_cumprida, Escala.dt_limite_previsao,
		 Setor.sigla_setor, Setor.id, Unidade.sigla_unidade, Unidade.id, Estado.nome, Estado.id  FROM escalas as Escala INNER JOIN setors as Setor ON(Escala.setor_id = Setor.id) INNER JOIN unidades as Unidade ON (Setor.unidade_id=Unidade.id)
		 INNER JOIN estados as Estado on (Unidade.estado_id=Estado.id) where Escala.ativa=1";

			$escalas = $this->Escala->query($sql);

			$this->set('escalas', $this->paginate('Escala',array("`Escala`.`ativa`=1")));
			$this->set(compact('militars', 'setors', 'chefe','chefeID','raiz','escalas','militaresid','turnos','milescalas'));
			$this->render('add');

		}
*/

	}


}
?>