<?php
class MilitarsController extends AppController {

	var $name = 'Militars';
	//    var $paginate = array('limit'=>100);


	function index($consulta = null) {

		//echo '<br><br><br><br>Teste'.
		//echo '<pre>';
		//print_r($this->params['named']['ultimo']);
            
		$findUrl = decodeURIComponent($this->data['formFind']['find']);
		$findUrl = str_replace('||','%',$findUrl);
		
		$opcoes = $findUrl.$ativos;
		
		$esquema = $this->Militar->_schema;
		
                $this->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
                $this->Militar->recursive = 0;
                $this->set('esquema',$esquema);
		if ( $findUrl != '' ) {
                    if(!empty($this->data['formFind']['paginas'])){
                        if($this->data['formFind']['paginas']=='TODAS'){
                            $this->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
                            $registros = $this->Militar->find('all',$opcoes);
                            $qtdPaginas = $this->data['formFind']['paginas'];
                            $this->data['formFind']['paginas'] = count($registros);
                        }
                        $this->paginate['limit'] = $this->data['formFind']['paginas'];
                    }
                    $this->data['formFind']['paginas'] = $this->paginate['limit'];
                    $this->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
                    $this->Militar->recursive = 0;
                    $this->set('militars', $this->paginate('Militar',array($opcoes)));
                    $this->set(compact('qtdPaginas'));

		} else {
                    if(!empty($this->data['formFind']['paginas'])){
                        if($this->data['formFind']['paginas']=='TODAS'){
                        $this->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
                        $this->Militar->recursive = 0;
                        $registros = $this->Militar->find('all');
                        $qtdPaginas = $this->data['formFind']['paginas'];
                        $this->data['formFind']['paginas'] = count($registros);
                        }
                        $this->paginate['limit'] = $this->data['formFind']['paginas'];
                    }
					//$this->params['named']['ultimo']
                    $this->data['formFind']['paginas'] = $this->paginate['limit'];
                    $this->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
                    $this->Militar->recursive = 0;
					$ultimo = $this->paginate('Militar', array('Militar.id LIKE' => $this->params['named']['ultimo']));
					//echo '<pre>';
					$dadosmiltar = array_merge((array)$ultimo, (array)$this->paginate('Militar'));
					//print_r($dadosmiltar);exit();
                    $this->set('militars', $dadosmiltar);
                    $this->set(compact('qtdPaginas'));
		}

	}

	function view($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Militar.', true));
			$this->redirect(array('action'=>'index'));
		}
		$sql = "select concat(Unidade.sigla_unidade,'-',Setor.sigla_setor) escala, Escala.id, Setor.id from militars Militar
		INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.militar_id=Militar.id and Militar.id='$id')
		INNER JOIN escalas Escala on (MilitarsEscala.escala_id=Escala.id and Escala.ativa>0)
		INNER JOIN setors Setor on (Escala.setor_id=Setor.id)
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		order by Unidade.sigla_unidade, Setor.sigla_setor asc";

		$escalas = $this->Militar->query($sql);
                //print_r($escalas);exit();
		//echo $sql;
		
		
		
		//Localidade.sigla_localidade,'-', /, Localidade.sigla_localidade
		//		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)

		$totalescala=count($escalas)-1;
		$escalastring = '';

		/*
		 $unidades = $this->Militar->query('select Unidade.id, Setor.id, Unidade.sigla_unidade from unidades Unidade, setors Setor where Setor.unidade_id=Unidade.id');
		 $vetor3[0]=0;
		 $vetor4[0]=0;

		 for($c=0;$c<count($unidades);$c++){
			$vetor3[]=$unidades[$c]['Unidade']['id'];
			$vetor4[]=$unidades[$c]['Unidade']['sigla_unidade'];
			}

			$unidades = array_combine($vetor3,$vetor4);
			*/

		$vetor3[0]=0;
		$vetor4[0]='GERAL';

		for($c=0;$c<$totalescala;$c++){
			$escalastring.=$escalas[$c]['Setor']['id'].',';
			$vetor3[]=$escalas[$c]['Setor']['id'];
			$vetor4[]=$escalas[$c][0]['escala'];
		}
		$escalastring.=$escalas[$c]['Setor']['id'].',';
		$vetor3[]=$escalas[$c]['Setor']['id'];
		$vetor4[]=$escalas[$c][0]['escala'];

		$escalas = array_combine($vetor3,$vetor4);
			
		$escalas = array_combine($vetor3,$vetor4);
                //$this->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
		$this->Militar->unbindModel(array('hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Habilitacao')));
                
		$this->set('militar', $this->Militar->read(null, $id));
		$this->set(compact('militar','escalas'));

	}

	function add() {
                    if($p[0]['Privilegio']['acesso']!=0 && $p[0]['Privilegio']['acesso']!=3 && $p[0]['Privilegio']['acesso']!=11){
                        exit();
                    }

		if (!empty($this->data)) {
			//$this->data['Militar']['nm_completo'] = iconv('UTF-8', 'ASCII//TRANSLIT', $this->data['Militar']['nm_completo']);
			//$this->data['Militar']['nm_guerra'] = iconv('UTF-8', 'ASCII//TRANSLIT', $this->data['Militar']['nm_guerra']);
			if(!empty($this->data['Militar']['setor_id'])){	
				$sqlunidade = "select * from unidades Unidade inner join setors Setor on (Setor.id='$this->data['Militar']['setor_id']' and Setor.unidade_id=Unidade.id ) ";
				$unidadesres = $this->Militar->query($sqlunidade);
				foreach($unidadesres as $unidade){
					$this->data['Militar']['unidade_id'] = $unidade['Unidade']['id']; 
				}
			}
//			Configure::write('debug', 2);
			//echo '<br><br><br>';print_r($this->data);
			$this->Militar->create();
			if ($this->Militar->save($this->data)) {
				
					uses('sanitize');
					$sanitize = new Sanitize();
					$ip = $_SERVER['REMOTE_ADDR'];
					$u = $this->Session->read('Usuario');
					$usuario = $u[0][0]['nome'];
					
					$this->cleanData = $sanitize->clean($this->data );
					$mudanca = '<u><b>Dados:</b></u>'.implode(', ',$this->data['Militar']);
					$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Inclusão",now(),"MILITAR", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
					$this->Militar->query($monitora);
				
				
				$this->Session->setFlash(__('Os dados de  Militar foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Militar não foram gravados. Por favor, tente novamente.', true));
			}
		}

		$this->Militar->recursive = 0;
                
		
		$this->Militar->Especialidade->recursive = 0;
		$consultaespecialidades = 'select Especialidade.id, concat(Quadro.sigla_quadro," - ", Especialidade.nm_especialidade) Especialidade from especialidades Especialidade inner join quadros Quadro on (Especialidade.quadro_id=Quadro.id)  order by Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc';
		$respecialidades = $this->Militar->Especialidade->query($consultaespecialidades);
		foreach($respecialidades as $respecialidade){
			$especialidades[$respecialidade['Especialidade']['id']] = $respecialidade[0]['Especialidade']; 
		}


		$this->Militar->Setor->recursive = 0;
		$consultaunidades = "select Unidade.id, concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) Unidade, Setor.id from unidades Unidade inner join setors Setor on (Setor.unidade_id=Unidade.id) order by Unidade.sigla_unidade asc, Setor.sigla_setor asc";
		$runidades = $this->Militar->Setor->query($consultaunidades);
		$unidades[0] = 'Selecione uma Unidade'; 
		foreach($runidades as $runidade){
			$unidades[$runidade['Setor']['id']] = $runidade[0]['Unidade']; 
		}

		//$setors[0] = 'Selecione uma Unidade'; 
		$consultapostos = 'select Posto.id, Posto.sigla_posto  from postos Posto  order by Posto.antiguidade asc';
		$rpostos = $this->Militar->query($consultapostos);
		foreach($rpostos as $rposto){
			$postos[$rposto['Posto']['id']] = $rposto['Posto']['sigla_posto']; 
		}



		//$this->set(compact('cursos', 'escalas', 'especialidades', 'setors', 'postos'));
		$this->set(compact(  'especialidades', 'setors', 'postos','unidades'));
	}

	function edit($id = null) {
                $p=$this->Session->read('Usuario');
                
                //echo '<br><br>'.print_r($p);
                if($p[0]['Usuario']['militar_id']!=$id){
                    if($p[0]['Privilegio']['acesso']!=0 && $p[0]['Privilegio']['acesso']!=3 && $p[0]['Privilegio']['acesso']!=11){
                        exit();
                    }
                }

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('ID inválido para Militar', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			
			//$this->data['Militar']['unidade_id']
			$sqlunidade = "select * from unidades Unidade inner join setors Setor on (Setor.id='{$this->data['Militar']['setor_id']}' and Setor.unidade_id=Unidade.id ) ";
			$unidadesres = $this->Militar->query($sqlunidade);
			foreach($unidadesres as $unidade){
				$this->data['Militar']['unidade_id'] = $unidade['Setor']['unidade_id']; 
			}
		//Configure::write('debug', 2);

         uses('sanitize');
         $sanitize = new Sanitize();
         $ip = $_SERVER['REMOTE_ADDR'];
         $u = $this->Session->read('Usuario');
         $usuario = $u[0][0]['nome'];

         $this->cleanData = $sanitize->clean($this->data );
         $mudanca = '<u><b>Dados:</b></u>'.implode(', ',$this->cleanData['Militar']);
         $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Edição",now(),"MILITAR", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
         $this->Militar->query($monitora);
			
         
			
			if($this->data['Militar']['ativa']=="0"){
				$excluiUsuarios = 'delete   t1, t2 from usuarios  t1, setors_usuarios t2 where t1.id=t2.usuario_id and t1.militar_id="'.$this->data['Militar']['id'].'"';
				$this->Militar->query($excluiUsuarios);
			}
			//$this->data['Militar']['nm_completo'] = iconv('UTF-8', 'ASCII//TRANSLIT', $this->data['Militar']['nm_completo']);
			//$this->data['Militar']['nm_guerra'] = iconv('UTF-8', 'ASCII//TRANSLIT', $this->data['Militar']['nm_guerra']);
			if ($this->Militar->save($this->data)) {
			
			$rc = $this->Militar->query("select concat(' ', Posto.sigla_posto, ' ', Quadro.sigla_quadro, ' ', Especialidade.nm_especialidade) complemento	FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id) where Militar.id='{$this->data['Militar']['id']}'	");
			
			$participaEscalanteP = 'select * from escalasmonths where (ok_comandantep is null or ok_comandantep=0)  and nm_escalantep like "%'.$this->data['Militar']['nm_completo'].'%" ';
			$participaEscalanteP_Resultado = $this->Militar->query($participaEscalanteP);
			//if(!empty($participaEscalanteP_Resultado)){
				foreach($participaEscalanteP_Resultado as $r){
					$this->Militar->query('update escalasmonths set nm_escalantep="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  id="'.$r['escalasmonths']['id'].'"');
					$this->Militar->query('update escalas, escalasmonths set escalas.nm_escalante="'.iconv('UTF-8','UTF-8',$this->data['Militar']['nm_completo'].$rc[0][0]['complemento']).'"  where  escalasmonths.id="'.$r['escalasmonths']['id'].'" and escalasmonths.escala_id=escalas.id ');
				}
			//}

			$participaEscalanteC = 'select * from escalasmonths where (ok_comandantec is null or ok_comandantec=0)  and nm_escalantec like "%'.$this->data['Militar']['nm_completo'].'%" ';
			$participaEscalanteC_Resultado = $this->Militar->query($participaEscalanteC);
			//if(!empty($participaEscalanteC_Resultado)){
				foreach($participaEscalanteC_Resultado as $r){
					$this->Militar->query('update escalasmonths set nm_escalantec="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  id="'.$r['escalasmonths']['id'].'"');
					$this->Militar->query('update escalas,escalasmonths set escalas.nm_escalante="'.iconv('UTF-8','UTF-8',$this->data['Militar']['nm_completo'].$rc[0][0]['complemento']).'"  where  escalasmonths.id="'.$r['escalasmonths']['id'].'" and escalasmonths.escala_id=escalas.id ');
					//echo 'update escalasmonths set nm_escalantec="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  id='.$r['escalasmonths']['id'];
				}
			//}

			$participaChefeP = 'select * from escalasmonths where (ok_comandantep is null or ok_comandantep=0)  and nm_chefe_orgaop like "%'.$this->data['Militar']['nm_completo'].'%" ';
			$participaChefeP_Resultado = $this->Militar->query($participaChefeP);
			if(!empty($participaChefeP_Resultado)){
				foreach($participaChefeP_Resultado as $r){
					$this->Militar->query('update escalasmonths set nm_chefe_orgaop="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  id="'.$r['escalasmonths']['id'].'"');
					$this->Militar->query('update escalas,escalasmonths set escalas.nm_chefe_orgao="'.iconv('UTF-8','UTF-8',$this->data['Militar']['nm_completo'].$rc[0][0]['complemento']).'"  where  escalasmonths.id="'.$r['escalasmonths']['id'].'" and escalasmonths.escala_id=escalas.id ');
					//echo 'update escalasmonths set nm_chefe_orgaop="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  id='.$r['escalasmonths']['id'];
				}
			}
			

			$participaChefeC = 'select * from escalasmonths where (ok_comandantec is null or ok_comandantec=0)  and nm_chefe_orgaoc like "%'.$this->data['Militar']['nm_completo'].'%" ';
			$participaChefeC_Resultado = $this->Militar->query($participaChefeC);
			if(!empty($participaChefeC_Resultado)){
				foreach($participaChefeC_Resultado as $r){
					$this->Militar->query('update escalasmonths set nm_chefe_orgaoc="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  id="'.$r['escalasmonths']['id'].'"');
				//	echo 'update escalas,escalasmonths set escalas.nm_chefe_orgao="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  escalasmonths.id='.$r['escalasmonths']['id'].' and escalasmonths.escala_id=escalas.id ';
					$this->Militar->query('update escalas,escalasmonths set escalas.nm_chefe_orgao="'.iconv('UTF-8','UTF-8',$this->data['Militar']['nm_completo'].$rc[0][0]['complemento']).'"  where  escalasmonths.id="'.$r['escalasmonths']['id'].'" and escalasmonths.escala_id=escalas.id ');
					//echo 'update escalasmonths set nm_chefe_orgaoc="'.$this->data['Militar']['nm_completo'].$rc[0][0]['complemento'].'"  where  id='.$r['escalasmonths']['id'];
				}
			}
			
				$this->Session->setFlash(__('Os dados de Militar foram gravados.', true));
				$this->redirect(array('action'=>'index','ultimo'=>$this->data['Militar']['id']));
			} else {
				$this->Session->setFlash(__('Os dados de Militar não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Militar->read(null, $id);
		}
		//$cursos = $this->Militar->Curso->find('list');
		//$escalas = $this->Militar->Escala->find('list');
		
		$this->Militar->recursive = 0;
		
		$this->Militar->Especialidade->recursive = 0;
		$consultaespecialidades = 'select Especialidade.id, concat(Quadro.sigla_quadro," - ", Especialidade.nm_especialidade) Especialidade from especialidades Especialidade inner join quadros Quadro on (Especialidade.quadro_id=Quadro.id)  order by Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc';
		$respecialidades = $this->Militar->Especialidade->query($consultaespecialidades);
		foreach($respecialidades as $respecialidade){
			$especialidades[$respecialidade['Especialidade']['id']] = $respecialidade[0]['Especialidade']; 
		}
		
/*
		
		$this->Militar->Especialidade->recursive = 0;
		$especialidades = $this->Militar->Especialidade->find('all');

		foreach($especialidades as $milico){
			$vetor[]=$milico['Especialidade']['id'];
			$vetor2[]=$milico['Quadro']['sigla_quadro'].' - '.$milico['Especialidade']['nm_especialidade'];
		}
		$especialidades=array_combine($vetor,$vetor2);
		asort($especialidades);

*/
		$this->Militar->Setor->recursive = 0;
		//$consultasetores = 'select Setor.id, concat(Setor.sigla_setor) Setor from setors Setor where Setor.unidade_id="'.$this->data['Militar']['unidade_id'].'" order by  Setor.sigla_setor asc';
		$consultasetores = "select Unidade.id, concat(Unidade.sigla_unidade,' - ',Setor.sigla_setor) Setor, Setor.id from unidades Unidade inner join setors Setor on (Setor.unidade_id=Unidade.id ) order by Unidade.sigla_unidade asc, Setor.sigla_setor asc";
		
		$rsetores = $this->Militar->Setor->query($consultasetores);
               // echo $consultasetores;
		foreach($rsetores as $rsetor){
			$setors[$rsetor['Setor']['id']] = $rsetor[0]['Setor']; 
		}
/*
		
		$this->Militar->Setor->recursive = 0;
		$setors = $this->Militar->Setor->find('all');

		foreach($setors as $milico){
			$vetor[]=$milico['Setor']['id'];
			$vetor2[]=$milico['Unidade']['sigla_unidade'].' - '.$milico['Setor']['sigla_setor'];
		}
		$setors=array_combine($vetor,$vetor2);
		asort($setors);
*/

		$postos = $this->Militar->Posto->find('list');
		$unidades = $this->Militar->Unidade->find('list');
		//$this->set(compact('cursos', 'escalas', 'especialidades', 'setors', 'postos'));
		$this->set(compact(  'especialidades', 'setors', 'postos','unidades'));
}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Militar', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->data['Militar']['id'] = $id;
		$this->data['Militar']['ativa'] = "0";
		$this->Militar->recursive = 1;
		$dependencias = $this->Militar->findById($id);
		$foto = $dependencias['Foto']['id'];
		$assinatura = $dependencias['Assinatura']['id'];
		$afastamento = count($dependencias['Afastamento']);
		$atividade = count($dependencias['Atividade']);
		$exame = count($dependencias['Exame']);
		$habilitacao = count($dependencias['Habilitacao']);
		$cursos = count($dependencias['Curso']);
		$escalas = count($dependencias['Escala']);
		$mensagem = '';
		if($foto>0){
			$mensagem .= "<li>O Militar possui foto cadastrada.</li>\n";
		}
		if($assinatura>0){
			$mensagem .= "<li>O Militar possui assinatura cadastrada.</li>\n";
		}
		if($afastamento>0){
			$mensagem .= "<li>O Militar possui $afastamento afastamento(s) cadastrado(s).</li><br>";
		}
		if($atividade>0){
			$mensagem .= "<li>O Militar possui $atividade atividade(s) cadastrada(s).</li><br>";
		}
		if($exame>0){
			$mensagem .= "<li>O Militar possui $exame exame(s) cadastrado(s).</li><br>";
		}
		if($habilitacao>0){
			$mensagem .= "<li>O Militar possui $habilitacao habilitacao(s) cadastrada(s).</li><br>";
		}
		if($cursos>0){
			$mensagem .= "<li>O Militar possui $cursos curso(s) cadastrado(s).</li><br>";
		}
		if($escalas>0){
			$mensagem .= "<li>O Militar possui $escalas escala(s) cadastrada(s).</li><br>";
		}
					uses('sanitize');
					$sanitize = new Sanitize();
					$ip = $_SERVER['REMOTE_ADDR'];
					$u = $this->Session->read('Usuario');
					$usuario = $u[0][0]['nome'];
					
				
		if(strlen($mensagem)>0){
			$mensagem .= "O militar foi desativado e não excluído devido aos cadastros informados. Os privilégios foram automaticamente excluídos.";
			if ($this->Militar->save($this->data)) {

					$this->cleanData = $sanitize->clean($this->data );
					$mudanca = '<u><b>Dados:</b></u>'.implode(', ',$this->data['Militar']);
					$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Desativação",now(),"MILITAR", "Del","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
					$this->Militar->query($monitora);
                                        
				if($this->data['Militar']['ativa']=="0"){
                                    
$remover="select militars_escalas.id, count(cumprimentoescalas.cumprido) dias   from  militars_escalas
inner join escalas on (escalas.id=militars_escalas.escala_id)
inner join escalasmonths on (escalasmonths.ok_chefeorgaop is null  and escalasmonths.escala_id=militars_escalas.escala_id)
left join cumprimentoescalas on (cumprimentoescalas.escalasmonth_id=escalasmonths.id and cumprimentoescalas.cumprido=militars_escalas.militar_id )
 where militars_escalas.militar_id={$this->data['Militar']['id']}
group by cumprimentoescalas.escalasmonth_id, cumprimentoescalas.cumprido
having dias=0;";
$dadosremover=$this->Militar->query($remover);

foreach($dadosremover as $dados){
    $this->Militar->query("delete from militars_escalas where id={$dados['militars_escalas']['id']}");
    $mudanca = '<u><b>Dados:</b></u>militars_escalas.id='.$dados['militars_escalas']['id'].' militars.id='.$id;
    $monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Desativação",now(),"MILITARS_ESCALAS", "Del","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
    $this->Militar->query($monitora);
}

        
					$excluiUsuarios = 'delete   t1, t2 from usuarios  t1, setors_usuarios t2 where t1.id=t2.usuario_id and t1.militar_id='.$this->data['Militar']['id'];
					$this->Militar->query($excluiUsuarios);
				}
				$this->Session->setFlash(__($mensagem, true));
				$this->redirect(array('action'=>'index'));
			}

		}else{
					$this->cleanData = $sanitize->clean($this->data );
					$mudanca = '<u><b>Dados:</b></u>'.implode(', ',$this->data['Militar']);
					$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão",now(),"MILITAR", "Del","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
					$this->Militar->query($monitora);
			
			if ($this->Militar->delete($id)) {
				$excluiUsuarios = 'delete   t1, t2 from usuarios  t1, setors_usuarios t2 where t1.id=t2.usuario_id and t1.militar_id='.$this->data['Militar']['id'];
				$this->Militar->query($excluiUsuarios);
				$this->Session->setFlash(__('Militar excluído.', true));
				$this->redirect(array('action'=>'index'));
			}

		}

	}

	function indexPdf($id = null, $consulta = null)
	{

		$this->layout = 'pdf'; //this will use the pdf.thtml layout
		$this->Militar->recursive = 1;
		//$this->set('especialidades', $this->find('All'));
		if(!empty($id)){
			$this->set('um',100);
			$this->set('militars', $this->Militar->read(null, $id));
                //        print_r($this->Militar->read(null, $id));exit();
		}else{
			//uses('sanitize');
			//$sanitize = new Sanitize();
			//$this->cleanData = $sanitize->clean($consulta);
			$consulta = decodeURIComponent($consulta);
			$consulta = str_replace('||','%',$consulta);
			$consulta = str_replace(']]]','/',$consulta);
			
			
			//echo $consulta;exit();
			
			//$this->Militar->recursive = 2;
			//$this->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento')));
			$this->Militar->unbindModel(array('hasAndBelongsToMany'=>'Escala', 'hasOne'=>'Assinatura','hasMany'=>'Afastamento'));
			$militars=$this->Militar->findAll($consulta);
			//echo '<pre>';
			//print_r($militars);
			//echo '</pre>';exit();
			//$this->set('militars', $militars);
			//$militars = $this->Militar->find('all');
			$this->set(compact('militars','consulta'));
		}
		$this->render();
	}

	/*
	 function indexExcel($id)
	 {

		$this->layout = 'excel'; //this will use the pdf.thtml layout
		$this->Militar->recursive = null;
		//$this->set('especialidades', $this->find('All'));
		//$this->set('url','http://localhost/oaple/fotos/download/'.$id);
		$this->set('data', $this->Militar->find('all'));
		$this->render();
		}
		*/

	function indexExcel($consulta = null)
	{
		
//		echo $consulta;
//		exit();
		$this->layout = 'openoffice' ; //this will use the pdf.thtml layout
		$this->Militar->recursive = null;
		//$this->set('url','http://localhost/oaple/fotos/download/'.$id);
		$filtro = "";
		if(empty($consulta)){
		//	$consulta = strtolower($consulta);
		//	$filtro = " and (LOWER(Especialidade.nm_especialidade) like '%".$consulta."%' OR LOWER(Setor.sigla_setor) like '%".$consulta."%') ";
			$filtro = '1=1 AND Militar.ativa = "1" ';
		}else{
			$filtro = decodeURIComponent($consulta);
			$filtro = str_replace('||','%',$filtro);
			$filtro = str_replace(']]]','/',$filtro);
		}
		
		$sql = "select Militar.nm_guerra , Posto.sigla_posto , Quadro.sigla_quadro, Especialidade.nm_especialidade , Militar.nm_completo ,
		 Militar.obs, Militar.saram , Militar.identidade , Militar.dt_formacao , Militar.dt_ultima_promocao ,Militar.dt_admissao ,
		 Militar.dt_apresentacao , Unidade.sigla_unidade , Setor.sigla_setor, Militar.indicativo, Militar.orgao, Militar.situacao
		 , group_concat(Siglas.setores) setores , group_concat(MilitarsCurso.curso_id) cursos_id
		FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
		LEFT JOIN setors as Setor on (Militar.setor_id = Setor.id)
		LEFT JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
		LEFT JOIN (select Setor.sigla_setor setores, Militar.id milicoid from setors Setor, militars_escalas MilitarsEscala, escalas Escala, militars Militar where Escala.id=MilitarsEscala.id and Setor.id=Escala.setor_id and MilitarsEscala.militar_id=Militar.id ) Siglas on (Siglas.milicoid=Militar.id)
		LEFT JOIN militars_cursos MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
		where  $filtro
		group by Militar.id
		order by  Posto.antiguidade asc, Militar.dt_ultima_promocao asc ";
                

		$dados = $this->Militar->query($sql);

		
		$sql = "select Curso.codigo, Curso.id FROM cursos as Curso where Curso.id in (select MilitarsCurso.curso_id from militars_cursos MilitarsCurso group by MilitarsCurso.curso_id having count(*)>0 ) order by  Curso.codigo asc";
		$cursos = $this->Militar->query($sql);
		//$cursos = "";
		$nome = 'relacao_militares';
		$this->set(compact('dados','nome','cursos'));
		$this->render();
	}

	function ajax($consulta = null)
	{

		$this->layout = 'openoffice' ; //this will use the pdf.thtml layout
		$this->Militar->recursive = null;
		//$this->set('especialidades', $this->find('All'));
		//$this->set('url','http://localhost/oaple/fotos/download/'.$id);
		$filtro = "";


		$sql = "select Unidade.sigla_unidade ,Setor.sigla_setor, Quadro.sigla_quadro, Especialidade.nm_especialidade,
		count(*) Quantidade 
		FROM militars as Militar
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
		INNER JOIN setors as Setor on (Militar.setor_id = Setor.id)
		INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
		where Militar.ativa = '1' 
		group by Unidade.id, Setor.id, Quadro.id, Especialidade.id
		order by  Unidade.sigla_unidade asc, Setor.sigla_setor asc, Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc ";
		//echo $sql;
		$dados = $this->Militar->query($sql);
		$contalinha = 0;
		$temporario = '';
		foreach($dados as $dado){
			$vetor[$contalinha]['temp'] = $dado['Unidade']['sigla_unidade'].$dado['Setor']['sigla_setor'];
			if($vetor[$contalinha]['temp'] != $temporario){
				if(($contalinha>0)&&($total>0)){
					$vetor[$contalinha]['Total'] = $total;
					$contalinha++;
					
				}
				$temporario = $dado['Unidade']['sigla_unidade'].$dado['Setor']['sigla_setor'];
				
				$vetor[$contalinha]['Unidade'] = $dado['Unidade']['sigla_unidade'];
				$vetor[$contalinha]['Setor'] = $dado['Setor']['sigla_setor'];
				
				$contalinha++;

				$vetor[$contalinha]['Unidade'] = '';
				$vetor[$contalinha]['Setor'] = '';
				$vetor[$contalinha]['Quadro'] = $dado['Quadro']['sigla_quadro'];
				$vetor[$contalinha]['Especialidade'] = $dado['Especialidade']['nm_especialidade'];
				$vetor[$contalinha]['Quantidade'] = $dado[0]['Quantidade'];
				$vetor[$contalinha]['Unidade2'] = $dado['Unidade']['sigla_unidade'];
				$vetor[$contalinha]['Setor2'] = $dado['Setor']['sigla_setor'];
				$total = $dado[0]['Quantidade'];
				$contalinha++;

				
		
				}else{
					$vetor[$contalinha]['Unidade'] = '';
					$vetor[$contalinha]['Setor'] = '';
					$vetor[$contalinha]['Quadro'] = $dado['Quadro']['sigla_quadro'];
					$vetor[$contalinha]['Especialidade'] = $dado['Especialidade']['nm_especialidade'];
					$vetor[$contalinha]['Quantidade'] = $dado[0]['Quantidade'];
					$vetor[$contalinha]['Unidade2'] = '';
					$vetor[$contalinha]['Setor2'] = '';
					$vetor[$contalinha]['Unidade2'] = $dado['Unidade']['sigla_unidade'];
					$vetor[$contalinha]['Setor2'] = $dado['Setor']['sigla_setor'];
					$total += $dado[0]['Quantidade'];
					$contalinha++;
					
					
				}
		}
/*
	echo '<pre>';
	print_r($vetor);
	echo '</pre>';
*/
	$nome = 'relacao_militares';
		$conteudo = $vetor;
		$campos = array('Unidade','Setor', 'Quadro', 'Especialidade', 'Quantidade', 'Total','Unidade2','Setor2' );
		$titulo = 'Planilha Militar x Setores';
		//exit();
		$this->set(compact('dados','nome','titulo','conteudo','campos','cursos'));
	//	exit();
		$this->render();
	}

function mudaDBController($database='default'){
	$db = ConnectionManager::getInstance();
	$connected = $db->getDataSource($database);
	if($connected->isConnected()){
		return true;
	}else{
		return false;
	}
}
function externoNovosDados(){
	$this->Militar->mudaDBModelo('mssql');
	//$this->set('usuarios',$this->requestAction('/usuarios/pegarListaDeUsuarios'));
	if($this->mudaDBController('mssql')){
		$dados=$this->Militar->find('all');
		//$dados=$this->Militar->query('select * from dbo.vies_pessoal');
		print_r($dados);
		exit();
	}
}
	
function externopdf(){
            $this->layout="xtcpdf";
//            $sql = "select * from militars Militar";
            $sql = "select * from militars Militar inner join postos Posto on (Posto.id=Militar.posto_id) left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id) left join quadros Quadro on (Quadro.id=Especialidade.quadro_id) where Militar.orgao like '%DO%' and Militar.ativa = '1'  order by Militar.orgao asc, Posto.antiguidade asc, Militar.nm_completo asc";
            

            $status = $this->Militar->query($sql);
            $this->set('militar',$status);
	$this->render();

       }
       
function externoedit($id = null) {
		$u=$this->Session->read('Usuario');
                
	
		$this->Militar->recursive = 0;
		$this->Militar->Posto->recursive = 0;
		$postos = $this->Militar->Posto->find('list');
		//$this->set(compact('cursos', 'escalas', 'especialidades', 'setors', 'postos'));
		$sql = "select Militar.divisao
		FROM militars as Militar
		group by Militar.divisao
		order by  Militar.divisao asc ";
		$divisoes = $this->Militar->query($sql);
		
		$sql = "select Militar.subdivisao
		FROM militars as Militar
		group by Militar.subdivisao
		order by  Militar.subdivisao asc ";
		$subdivisoes = $this->Militar->query($sql);
		
		$sql = "select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id
		FROM setors as Setor
		inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
		where trim(Setor.sigla_setor) not like 'NA' and trim(Setor.sigla_setor) not like 'R.%' and trim(Setor.sigla_setor) not like '%EST%'
		order by  Unidade.sigla_unidade asc, Setor.sigla_setor asc ";
		$setor = $this->Militar->query($sql);
		
		$postos[0]='';
		$setors[0]='';
		foreach($setor as $conteudo){
			$setors[$conteudo['Setor']['id']]=$conteudo['Unidade']['sigla_unidade'].'-'.$conteudo['Setor']['sigla_setor'];
		}
		
		//echo $sql;
		//$arvore=$this->arvore;
		
		$dados = $this->Militar->query($sql);
		
		
		$this->set(compact('postos','divisoes','subdivisoes','u','setors'));
}

function externoeditgrava($id = null) {
	
		$this->layout = 'ajax';
		$this->data['Militar']['id']=$this->data['Militar']['militar_id'];
		unset($this->data['Militar']['militar_id']);
		unset($divisao);
		unset($subdivisao);
		if (!empty($this->data)) {
			$this->Militar->create();
			if ($this->Militar->save($this->data)) {
				echo '<p class="message"><b>Os dados de  Militar foram gravados.</b></p><script language="javascript">ShowContent(\'militares\');new Effect.Fade(\'message\',{delay: 20});</script>';
			} else {
				echo '<p class="message"><b>Os dados de Militar não foram gravados. Por favor, tente novamente.</b></p><script language="javascript">ShowContent(\'militares\');new Effect.Fade(\'message\',{delay: 20});</script>';
			}
		}
		
		exit();
}
function externoeditlista($id = null) {
	
		$this->layout = 'ajax';
		$this->data['Militar']['id']=$this->data['Militar']['militar_id'];
		
		$sql = "select Militar.nm_guerra , Posto.sigla_posto , Quadro.sigla_quadro, Especialidade.nm_especialidade , Militar.nm_completo,
		Militar.id
		FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id )
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
		INNER JOIN setors as Setor on (Militar.setor_id = Setor.id)
		INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
		where Militar.ativa = '1' and Militar.divisao like '{$this->data['Militar']['divisao']}' and Militar.subdivisao like '{$this->data['Militar']['subdivisao']}'
		group by Militar.id
		order by  Militar.nm_completo asc, Posto.antiguidade asc, Militar.dt_ultima_promocao asc ";

		
		$dados = $this->Militar->query($sql);
		echo "<h2>Efetivo {$this->data['Militar']['divisao']}-{$this->data['Militar']['subdivisao']}</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th></tr>";
		foreach($dados as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}><td>{$dado['Militar']['nm_completo']} - {$dado['Posto']['sigla_posto']} {$dado['Quadro']['sigla_quadro']} {$dado['Especialidade']['nm_especialidade']}</td></tr>";

		}
				echo "</table>";
			
				
		exit();
}
function externoposto($id = null) {
		$this->layout = null;
		$this->Militar->recursive = 0;
		$this->Militar->Posto->recursive = 0;
		$postos = $this->Militar->Posto->find('list');
		//$this->set(compact('cursos', 'escalas', 'especialidades', 'setors', 'postos'));
		$this->set(compact(  'postos'));
		header('Content-type: application/x-json');

		$sql = "select Militar.nm_guerra , Posto.sigla_posto , Quadro.sigla_quadro, Especialidade.nm_especialidade , Militar.nm_completo,
		Militar.id
		FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id and Posto.id={$this->data['Militar']['posto_id']} )
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
		INNER JOIN setors as Setor on (Militar.setor_id = Setor.id)
		INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
		where Militar.ativa = '1'
		group by Militar.id
		order by  Militar.nm_completo asc, Posto.antiguidade asc, Militar.dt_ultima_promocao asc ";

		$dados = $this->Militar->query($sql);
		
		foreach($dados as $dado){
			$militars[$dado['Militar']['id']]=$dado['Militar']['nm_completo'].'-'.$dado['Posto']['sigla_posto'].' '.$dado['Quadro']['sigla_quadro'].' '.$dado['Especialidade']['nm_especialidade'];
	  		echo "<option value='{$dado['Militar']['id']}'>{$militars[$dado['Militar']['id']]}</option>";
		}
		
//				echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';

		exit();
}

function externoconsulta($id = null) {
        $this->layout = null;
        $this->Militar->recursive = 0;
        header('Content-type: application/x-json');

        $sql = "select Militar.nm_guerra , Posto.sigla_posto , Quadro.sigla_quadro, Especialidade.nm_especialidade , Militar.nm_completo,
        Militar.id
        FROM militars as Militar
        INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id and Posto.id=Posto.id )
        LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
        INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
        INNER JOIN setors as Setor on (Militar.setor_id = Setor.id)
        INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
        where Militar.nm_completo like '%{$this->data['Controlehora']['nome_saram']}%' or Militar.saram like '%{$this->data['Controlehora']['nome_saram']}%'
        group by Militar.id
        order by  Militar.nm_completo asc, Posto.antiguidade asc, Militar.dt_ultima_promocao asc ";

        $dados = $this->Militar->query($sql);
        
        foreach($dados as $dado){
            $militars[$dado['Militar']['id']]=$dado['Militar']['nm_completo'].'-'.$dado['Posto']['sigla_posto'].' '.$dado['Quadro']['sigla_quadro'].' '.$dado['Especialidade']['nm_especialidade'];
            echo "<option value='{$dado['Militar']['id']}'>{$militars[$dado['Militar']['id']]}</option>";
        }
        
//              echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';

        exit();
}
function externoconsultaajax($saram=null) {
        $this->layout = null;
        $this->Militar->recursive = 0;
       header('Content-type: application/x-json');
//        where Militar.saram='{$_POST['saram']}'

        $sql = "select *
        FROM militars as Militar
        INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id and Posto.id=Posto.id )
        LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
        INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
        INNER JOIN setors as Setor on (Militar.setor_id = Setor.id)
        INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
        where Militar.saram='{$_POST['saram']}'
        group by Militar.id
        order by  Militar.nm_completo asc, Posto.antiguidade asc, Militar.dt_ultima_promocao asc ";

        $dados = $this->Militar->query($sql);
        
        echo json_encode($dados);
        
        

        exit();
}




}
?>