<?php
class CalendariorotinasController extends AppController {

	var $name = 'Calendariorotinas';
	var $components = array('Domini');

	function beforeFilter() {
		parent::beforeFilter();
			$this->layout = 'default';

	}

	function gerador($ano){
		$this->Calendariorotina->Rotina->recursive = 0;
		$rotinas = $this->Calendariorotina->Rotina->find('all');

		
		foreach($rotinas as $rotina){
			$dep_id = $rotina['Rotina']['rotina_id'];
				$id = $rotina['Rotina']['id'];
				// dep_id = 1 deve ser criado, tendo como texto NENHUMA,
				// ou seja, para ausência de rotina o rotina_id deve ser 1
				
				//if (($dep_id == 1)&&($this->Rotina->data['Rotina']['ativa'] ==1)){
					
					$qtDias = $rotina['Periodicidade']['nr_dias'];
					$TipoData = $rotina['Periodicidade']['tipo_data'];
					
					$dtInicio = strtotime($rotina['Rotina']['dt_referencia'])+0;
					$anoAtual = date('Y',$dtInicio)+0;

					$anoSeguinte = date('Y',strtotime('+1 year'))+0;
					$conta = 0;
					$erros = 0;

					// Se nr_dias <> 0 executa contagem e geracao do calendario, caso contrário
					// insere diretamente os dados baseado no dia e mês previstos
					if ($qtDias>0){
						while($anoAtual<$anoSeguinte){

							$fmtDias = "+ {$qtDias} {$TipoData}";
							$dtInicio = strtotime($fmtDias, $dtInicio);
							$anoAtual = date('Y',$dtInicio)+0;

							$dtPrevisto = date ('d-m-Y H:i:s',$dtInicio);


							$CalRotina = array('Calendariorotina'=>array('rotina_id'=>$id,'dt_inicio_previsto'=>$dtPrevisto));


							if ($anoAtual<$anoSeguinte){
								$this->Calendariorotina->create();
								if ($this->Calendariorotina->save($CalRotina)) {
									$conta++;

								}else{
									$erros++;
								}
							}
						}
					}else{

						if (!empty($rotina['Rotina']['dia_previsto'])&&!empty($rotina['Rotina']['mes_previsto'])){
							$fmtDias = " {$anoAtual}/{$rotina['Rotina']['mes_previsto']}/{$rotina['Rotina']['dia_previsto']}";
							$dtInicio = strtotime($fmtDias, $dtInicio);
							$anoAtual = date('Y',$dtInicio)+0;
							$CalRotina = array('Calendariorotina'=>array('rotina_id'=>$id,'dt_inicio_previsto'=>$dtPrevisto));
							$this->Calendariorotina->create();
							if ($this->Calendariorotina->save($CalRotina)) {
								$conta++;

							}else{
								$erros++;
							}
						}
						if (empty($rotina['Rotina']['dia_previsto'])&&!empty($rotina['Rotina']['mes_previsto'])){
							$fmtDias = " {$anoAtual}/{$rotina['Rotina']['mes_previsto']}/".date('d');
							$dtInicio = strtotime($fmtDias, $dtInicio);
							$anoAtual = date('Y',$dtInicio)+0;
							$CalRotina = array('Calendariorotina'=>array('rotina_id'=>$id,'dt_inicio_previsto'=>$dtPrevisto));
							$this->Calendariorotina->create();
							if ($this->Calendariorotina->save($CalRotina)) {
								$conta++;

							}else{
								$erros++;
							}
						}
						if (!empty($rotina['Rotina']['dia_previsto'])&&empty($rotina['Rotina']['mes_previsto'])){
							$fmtDias = " {$anoAtual}/{$rotina['Rotina']['mes_previsto']}/{$rotina['Rotina']['dia_previsto']}";
							$dtInicio = strtotime($fmtDias, $dtInicio);
							$anoAtual = date('Y',$dtInicio)+0;
							$CalRotina = array('Calendariorotina'=>array('rotina_id'=>$id,'dt_inicio_previsto'=>$dtPrevisto));
						}


						if ($anoAtual<$anoSeguinte){
							$this->Calendariorotina->create();
							if ($this->Calendariorotina->save($CalRotina)) {
								$conta++;

							}else{
								$erros++;
							}
						}
					}

				//}else{
					
					

				//}

		}
		
	}

	function findCalendarioRotinas() {
		/*
'Orgao'=>array('className' => 'Orgao',
								'foreignKey' => 'orgao_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''),
*/ 
		$this->Calendariorotina->Rotina->bindModel( array('belongsTo'=>
		array( 
                  'Setor'=>array('className' => 'Setor',
								'foreignKey' => 'setor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''),  
                 'Periodicidade'=>array('className' => 'Periodicidade',
								'foreignKey' => 'periodicidade_id',
								'conditions' => '',
								'fields' => '',
								'order' => '')  
		)));
		$this->Calendariorotina->Rotina->recursive = 0;

		$condicao1 = ' 1=1 group by Rotina.orgao_id order by Orgao.sigla_orgao ASC';
		$condicao2 = ' 1=1 group by Rotina.orgao_id, Rotina.setor_id order by Orgao.sigla_orgao, Setor.sigla_setor ASC';
		$campos1 = array('Orgao.sigla_orgao');
		$campos2 = array('Orgao.sigla_orgao, Setor.sigla_setor');
		$valores1 = $this->Calendariorotina->Rotina->findAll($condicao1,$campos1);
		$valores2 = $this->Calendariorotina->Rotina->findAll($condicao2,$campos2);

		$resultado = array();

		foreach($valores1 as $orgao){
			unset($setores);
			$setores = array();
			foreach($valores2 as $setor){
				if (($orgao['Orgao']['sigla_orgao'] == $setor['Orgao']['sigla_orgao'])){
					$setores[] = $setor['Setor']['sigla_setor'];
				}

			}
			array_push($resultado, $resultado + array('Orgao'=>array('sigla_orgao'=>$orgao['Orgao']['sigla_orgao'],'Setor'=>$setores)));
			//$resultado['Orgao']['sigla_orgao'][$orgao['Orgao']['sigla_orgao']]['Setor'] = $setores;

		}

		//print_r($valores);

		return $resultado;
	}

	function view($orgao=null,$setor=null,$date=null,$id = null) {
		$consulta_anos = 'select YEAR(dt_inicio_previsto) ano from calendariorotinas group by YEAR(dt_inicio_previsto) order by dt_inicio_previsto desc';
		$anos = $this->Calendariorotina->query($consulta_anos);
		$anoAtual = date('Y');
		$anoBase = $anos[0][0]['ano'];

		//$this->gerador($anoAtual);
		
		//echo "ano base= $anoBase  anoAtual = $anoAtual";
		if($anoAtual>$anoBase){
			$this->gerador($anoAtual);
		}

		$data = $this->Domini->parseUrl($orgao,$setor,$date);
		$prev = rawurldecode($this->Domini->findPrev($this->params['pass']));
		$next = rawurldecode($this->Domini->findNext($this->params['pass']));

		/* rawurldecode

		$this->Calendariorotina->Rotina->bindModel( array('belongsTo'=>
		array('Orgao'=>array('className' => 'Orgao',
		'foreignKey' => 'orgao_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''),
		'Setor'=>array('className' => 'Setor',
		'foreignKey' => 'setor_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''),
		'Periodicidade'=>array('className' => 'Periodicidade',
		'foreignKey' => 'periodicidade_id',
		'conditions' => '',
		'fields' => '',
		'order' => '')
		)));
		*/
		/*
		 $this->Calendariorotina->bindModel( array('hasOne'=>
		 array('Rotina'=>array('className' => 'Rotina',
		 'foreignKey' => 'rotina_id',
		 'conditions' => '',
		 'fields' => '',
		 'order' => '')
		 )));
		 */

		$conditions = array();

		if($data['orgao']!='Todos'){
	/*
			$condOrgao = array('Orgao.sigla_orgao'=>$data['orgao']);
			$idOrgao =  $this->Calendariorotina->Rotina->Orgao->find($condOrgao);
			array_push($conditions,array('Rotina.orgao_id'=>$idOrgao['Orgao']['id']));
	*/		
		}

		if($data['setor']!='Todos'){

			$condSetor = array('Setor.sigla_setor'=>$data['setor']);
			$idSetor =  $this->Calendariorotina->Rotina->Setor->find($condSetor);
			array_push($conditions, array('Rotina.setor_id'=>$idSetor['Setor']['id']));

		}

		if (!empty($data['month'])){
			array_push($conditions, array('month(Calendariorotina.dt_inicio_previsto)'=>$data['month']));
			// O uso do parentesis adicional em rubrica foi devido ao fato do Cake gerar parentesis ao redor do campo, e por tratar-se de
			// condições múltiplas é gerado o operador AND, porém a quantidade de parentesis não ficou adequada
			//			array_push($conditions, array('month(Calendariorotina.dt_inicio_previsto)'=>$data['month'],' (Calendariorotina.rubrica) IS NULL'));
			
		}
		//print_r($conditions);

		$this->Calendariorotina->recursive = 2;

		//array_push($conditions, array('MONTH(Calendariorotina.dt_inicio_previsto)'=>$data['month']));

		//print_r($idSetor);
		//$campos = 'Rotina.id';   
		
		$calendrotina = $this->Calendariorotina->findAll($conditions);
		//print_r($calendrotina);
		$this->set(compact('calendrotina','data', 'next', 'prev'));

		//echo 'Orgao:'.$data['calendar'].'  Setor:'.$data['tag'].'  Date:'.$date.' <br>';
		//Debugger::dump($calendrotina);
		//pr(Debugger::trace);
		//print_r($prev);
		//print_r($this->params['pass']);
		/*
		$data['calendar_name'] = $this->requestAction('/calendars/findNameByShortname/'.$orgao);
		$data['tag_name'] = $this->requestAction('/tags/findNameByShortname/'.$setor);
		$this->set(compact('events','prev','next','data'));
		*/

		/*
		 if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Calendariorotina.', true));
			$this->redirect(array('action'=>'index'));
			}
			$this->set('calendariorotina', $this->Calendariorotina->read(null, $id));
			*/
	}

	/* Deve ser usado ao inves da anterior
	 function view($calendar=null,$tag=null,$date=null) {
		//echo 'Calendar='.$calendar.' Tag='.$tag.' date='.$date.'<br>';
		$data = $this->Domini->parseUrl($calendar,$tag,$date);
		//print_r($data);
		$prev = $this->Domini->findPrev($this->params['pass']);
		$next = $this->Domini->findNext($this->params['pass']);
		$events = $this->Event->findEvents($data);
		$data['calendar_name'] = $this->requestAction('/calendars/findNameByShortname/'.$calendar);
		$data['tag_name'] = $this->requestAction('/tags/findNameByShortname/'.$tag);
		$this->set(compact('events','prev','next','data'));
		}

		*
		* */

	function add() {
		if (!empty($this->data)) {
			$this->Calendariorotina->create();
			if ($this->Calendariorotina->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Calendariorotina foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Calendariorotina não foram gravados. Por favor, tente novamente.', true));
			}
		}
		$rotinas = $this->Calendariorotina->Rotina->find('list');
		$this->set(compact('rotinas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Calendariorotina inválido.', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Calendariorotina->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Calendariorotina foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Calendariorotina não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Calendariorotina->read(null, $id);
		}
		$rotinas = $this->Calendariorotina->Rotina->find('list');
		$this->set(compact('rotinas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Calendariorotina', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Calendariorotina->delete($id)) {
			$this->Session->setFlash(__('Calendariorotina excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}



	function ldap() {
		if (empty($this->data)) {
			$this->Session->setFlash(__('Dados inválidos', true));
			$this->redirect(array('action'=>'index'));
		}
		#configuracoes do servidor (server config):
		$SERVER = '10.112.24.1';
		$PORT = '389';
		$BASE_DN = 'OU=CINDACTA 4,DC=cindacta4,DC=intraer';
		$DOMAIN_AUTENTICATION= 'dc=CINDACTA4,dc=intraer,dc=CINDACTA IV';
		$DIRTEMP = 'temp';
		#Classe de usuarios que devera ser consultada para validar os usuariosi(classe for autentication the users):
		$OBJECTCLASS = 'person';
		$ATTRIBUTE='uid';

		if(empty($this->data['Calendariorotina']["rubrica"])){
			//Usuário inseriu incorretamente ou veio da página do termo
		 $USER="lixo@cindacta4.intraer";}
		 else{
		 	$USER=$this->data['Calendariorotina']["rubrica"]."@cindacta4.intraer";
		 	//$USER=$this->data['Calendariorotina']["rubrica"]."";
		 }
		 $USER_DOMAIN="uid=$USER,$DOMAIN_AUTENTICATION";
		 $ds=ldap_connect("$SERVER");
		 $P=$this->data['Calendariorotina']["password"];
		 if($P!=""){
		 	$PASSWORD=$P;
		 }else{
		 	$PASSWORD="lixo";
		 }
		 $U=$this->data['Calendariorotina']["rubrica"];
		 $BASE_DN = 'OU=CINDACTA 4,DC=cindacta4,DC=cindacta IV,DC=intraer';

          $results = ldap_search($ds, $BASE_DN, "Name=*");
		  $info = ldap_get_entries($ds, $results);
          
          
			//print_r($this->data);
		 

		 if ($ds) {
		 	if(!empty($this->data['Calendariorotina']["rubrica"])){
		 		$r=ldap_bind($ds,$USER,$PASSWORD);
		 	}
		 	//$r=0;
		 	if($r){
		 		if ($this->Calendariorotina->save($this->data)) {
		 			$this->Session->setFlash(__('Assinado com sucesso !', true));
		 		} else {
		 			$this->Session->setFlash(__('Os dados não foram gravados. Por favor, tente novamente.', true));
		 		}
		 		//   echo "<br>Usuário autenticado!!!<br>";
		 	}else{
		 		$this->Session->setFlash(__('Usuário e/ou Senha inválidos! Lembre-se da senha utilizada na rede!', true));

		 	}
		 }else{

		 	$this->Session->setFlash(__('Não foi possível conectar no Servidor LDAP ! Informe ao administrador da Rede !', true));

		 }


		 /*
		  if (!empty($this->data)) {
		 	if ($this->Calendariorotina->save($this->data)) {
		 	$this->Session->setFlash(__('Os dados de Calendariorotina foram gravados.', true));
		 	$this->redirect(array('action'=>'index'));
		 	} else {
		 	$this->Session->setFlash(__('Os dados de Calendariorotina não foram gravados. Por favor, tente novamente.', true));
		 	}
		 	}
		 	*/
		 //return 'OK';
		 $this->redirect(array('action'=>'view'));
	}






}
?>