<?php
class ManutencaooperacionalsController extends AppController {

	var $name = 'Manutencaooperacionals';
	var $helpers = array('Html', 'Form');

	function index() {
	   
      //  Configure::write(array('debug'=> 2));
	   
		$u=$this->Session->read('Usuario');
                
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',	trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
                
                if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==2)||($u[0]['Usuario']['privilegio_id']==4)){
                        $sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Setor.id from setors Setor
                        LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
                        LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
                        INNER JOIN escalas Escala on (Escala.setor_id=Setor.id)
                        order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";
                }else{
                        $sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Escala.id, Setor.id from setors Setor
                        LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
                        LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
                        INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.setor_id in ({$u[0][0]['setores']}))
                        order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";
                }


		$escalas = $this->Manutencaooperacional->query($sql);


		$sql_responsaveis = "select  Afastamento.militar_responsavel  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo', Militar.identidade
			FROM militars as Militar INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN manutencaooperacionals as Afastamento on (Afastamento.militar_responsavel=Militar.id)
			INNER JOIN setors Setor ON (Militar.setor_id=Setor.id)
			group by Afastamento.militar_responsavel
			order by  Posto.sigla_posto asc, Militar.nm_completo asc";
		$resp = $this->Manutencaooperacional->query($sql_responsaveis);

		$responsavel[0]='';
		foreach($resp as $r){
			$responsavel[0][$r['Afastamento']['militar_responsavel']] = $r[0]['Militar.nm_completo'];
			$responsavel[1][$r['Afastamento']['militar_responsavel']] = $r['Militar']['identidade'];
		}


		$totalescala=count($escalas)-1;
		$escalastring = '';

		for($c=0;$c<$totalescala;$c++){
			$escalastring.=$escalas[$c]['Setor']['id'].',';
			$vetor3[]=$escalas[$c]['Setor']['id'];
			$vetor4[]=$escalas[$c][0]['escala'];
		}
		$escalastring.=$escalas[$c]['Setor']['id'].',';
		$vetor3[]=$escalas[$c]['Setor']['id'];
		$vetor4[]=$escalas[$c][0]['escala'];
		$vetor3[]=0;
		$vetor4[]=' ';

		$escalas = array_combine($vetor3,$vetor4);
		$this->Manutencaooperacional->order = array('Afastamento.dt_termino'=>'desc');

		if ( $findUrl != '' ) {
			$opcoes = "LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%'  OR LOWER(`Afastamento`.`militar_id`) LIKE '%" . $findUrl ."%' OR LOWER(`Afastamento`.`motivo`) LIKE '%" . $findUrl ."%' AND LOWER(`Militar`.`setor_id`) in ({$u[0][0]['setores']}) ";
			$this->Manutencaooperacional->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Manutencaooperacional->recursive = 0;
					$registros = $this->Manutencaooperacional->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Manutencaooperacional->recursive = 2;
			$this->Manutencaooperacional->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
			$this->Manutencaooperacional->Militar->bindModel(array('belongsTo'=>array('Escala'=>array('className'=>'Escala','foreignKey' => 'setor_id','conditions' => 'Escala.setor_id in ("'.$u[0][0]['setores'].'")'))),false);
			$this->set('manutencaooperacionals', $this->paginate('Afastamento',array("LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%'  OR LOWER(`Afastamento`.`militar_id`) LIKE '%" . $findUrl ."%' OR LOWER(`Afastamento`.`motivo`) LIKE '%" . $findUrl ."%' AND LOWER(`Militar`.`setor_id`) in ({$u[0][0]['setores']})  AND MONTH(`Afastamento`.`dt_termino`)>=(MONTH(NOW())-1)")));
			$this->set(compact('escalas','responsavel'));
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Manutencaooperacional->recursive = 0;
					$registros = $this->Manutencaooperacional->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Manutencaooperacional->recursive = 2;
			$this->Manutencaooperacional->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
			$this->Manutencaooperacional->Militar->bindModel(array('belongsTo'=>array('Escala'=>array('className'=>'Escala','foreignKey' => 'setor_id','conditions' => 'Escala.setor_id in ("'.$u[0][0]['setores'].'")'))),false);
			$this->set('manutencaooperacionals', $this->paginate(array("LOWER(`Militar`.`setor_id`) in ({$u[0][0]['setores']}) AND MONTH(`Afastamento`.`dt_termino`)>=(MONTH(NOW())-1)")));
			$this->set(compact('escalas','responsavel'));
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Afastamento.', true));
			$this->redirect(array('action'=>'index'));
		}

		$this->Manutencaooperacional->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
		$this->set('afastamento', $this->Manutencaooperacional->read(null, $id));
	}

	function add($id = null) {
		//Configure::write(array('debug'=> 2));
		$this->layout = 'admin';
		if (!empty($this->data)) {
			$mensagem = '';
			$this->data['Manutencaooperacional']['created']=date('Y-m-d h:i:s');
			
			if(trim($this->data['Manutencaooperacional']['dt_inicio'])==''){
				$mensagem .= '<li>Data de Início em branco.</li>';
			}
			$data1 = strtotime($this->data['Manutencaooperacional']['dt_inicio']);

			//$data1vetor = explode('-',$data1);
			$dia1=date('d',$data1);
			$mes1=date('m',$data1);
			$ano1=date('Y',$data1);

			$dt1 = $ano1.'-'.$mes1.'-'.$dia1;

			$militarid = $this->data['Manutencaooperacional']['militar_id'];

			$motivo = $this->data['Manutencaooperacional']['motivo'];
			$setor_id = $this->data['Manutencaooperacional']['setor_id'];
				


			if(strlen($mensagem)<4){
					
				$this->Manutencaooperacional->create();
				if ($this->Manutencaooperacional->save($this->data)) {
					$this->Session->setFlash(__('Os dados de  Manutencaooperacional foram gravados.', true));
					//$this->redirect(array('action'=>'index'));
				} else {
					//O militar encontra-se escalado para o dia X na escala Y. Para cadastrar o afastamento, deve-se
					//fazer contato com o escalante providenciando um substituto.
					$this->Session->setFlash(__('Os dados de Manutencaooperacional não foram gravados. Por favor, tente novamente.', true));
				}
					
			}else{
        				$this->Session->setFlash($mensagem);

			}
//					$this->Session->setFlash(__('Os dados de  Manutencaooperacional foram gravados.', true));
                                        
                        

		}
		//	}

		
		$this->set(compact('mensagem'));
	}

	function edit($id = null, $militar_id = null) {
			$this->redirect(array('action'=>'add'));
	}

	function delete($id = null) {
			$this->redirect(array('action'=>'index'));
	}
	function update($id = null) {
		$this->layout = 'ajax_embutido';
		$u=$this->Session->read('Usuario');
                
		//print_r($this->data);
		
   		if(!empty($this->data['Manutencaooperacional']['setor_id'])) {
		
			$sql1 = "select  Militar.id  , concat(  Militar.nm_completo,' ', Posto.sigla_posto,' -> ',Posto.sigla_posto,' ', Militar.nm_guerra)  as 'Militar.nm_completo', Militar.nm_guerra
			FROM militars as Militar INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN escalas as Escala on (Escala.setor_id in ('{$this->data['Manutencaooperacional']['setor_id']}'))
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and Escala.id=MilitarsEscala.escala_id)
			LEFT JOIN setors Setor ON (Militar.setor_id=Setor.id)
			where Militar.ativa>0
			order by  Posto.sigla_posto asc, Militar.nm_completo asc";

		
		$militars = $this->Manutencaooperacional->Militar->query($sql1);

		
		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			//$vetor2[]= str_replace($milico['Militar']['nm_guerra'], "<b>".$milico['Militar']['nm_guerra']."</b>", $milico[0]['Militar.nm_completo']);
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);
		//print_r($militars);
		$this->set('options',$militars);		
   		}
		
   		
		
	}

	function externoupdateano($setorId = null) {
		$this->layout = 'ajax';
		if(!empty($setorId)) {
			//$filtro = 'Setor.id='.$setorId;
			$consultasql = "
				select escalasmonths.id, escalasmonths.mes from manutencaooperacionals
				inner join escalas on (manutencaooperacionals.setor_id=escalas.setor_id)
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id)
				 where manutencaooperacionals.setor_id='{$setorId}'
				group by escalasmonths.id, escalasmonths.mes
				order by escalasmonths.mes desc			
			";
			//$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_Setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
			$consulta = $this->Manutencaooperacional->query($consultasql);
//			print_r($consulta);
			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['escalasmonths']['id']]=substr($dados['escalasmonths']['mes'],0,4).'/'.substr($dados['escalasmonths']['mes'],-2);
			}

			if(!empty($lista)) {
	  			foreach($lista as $k => $v) {
	  				echo "<option value='$k'>$v</option>";
	  			}
	 		 }
		}


		exit();
	}

function externopdf($setorId = null, $escalasmonthId = null) {
		$this->layout = 'pdf';
                //$this->layout = null;
		//echo 'teste setor='.$setorId.'  anomes='.$escalasmonthId;
		if((!empty($setorId))&&(!empty($escalasmonthId))) {
			$dadosescalasmonth = $this->Manutencaooperacional->query('select setors.sigla_setor, escalasmonths.escala_id, escalasmonths.mes  from escalasmonths inner join escalas on (escalasmonths.escala_id=escalas.id) inner join setors on (setors.id="'.$setorId.'" and setors.id=escalas.setor_id) where escalasmonths.id="'.$escalasmonthId.'"');
			$escalaId=$dadosescalasmonth[0]['escalasmonths']['escala_id'];
			$ano = substr($dadosescalasmonth[0]['escalasmonths']['mes'],0,4);
			$mes = substr($dadosescalasmonth[0]['escalasmonths']['mes'],-2);
			$dtIni = "$ano-$mes-1";
			$dtFim = "$ano-$mes-".date('t',strtotime($dtIni));

			$sqlafastamento = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome,  Manutencaooperacional.* from manutencaooperacionals Manutencaooperacional
			INNER JOIN militars as Militar ON (Militar.id in (select militar_id from militars_escalas where escala_id='{$escalaId}') and Militar.id=Manutencaooperacional.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
                        INNER JOIN setors on (setors.id=Manutencaooperacional.setor_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Manutencaooperacional.setor_id is null or Manutencaooperacional.setor_id='{$setorId}')
			order by nome asc, Manutencaooperacional.motivo, Manutencaooperacional.dt_inicio asc ";
			$afastados = $this->Manutencaooperacional->query($sqlafastamento);
			$setor = $dadosescalasmonth[0]['setors']['sigla_setor'];
			$this->set(compact('afastados','setor'));
		}

			$this->render();
		
	//	exit();
	}
	function externoconsultanomes(){
		$nome = $this->params['form']['nome'];
		//Configure::write(array('debug'=> 2));
		$this->layout = null;
		if(!empty($nome)){
			$sql = "select * from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			where Militar.nm_completo like '%$nome%' order by Militar.nm_completo asc
			";
			$resultados = $this->Manutencaooperacional->query($sql);
			foreach($resultados as $dado){
				$nomes[$dado['Militar']['id']] = str_pad($dado['Militar']['nm_completo'],50,'_').$dado['Posto']['sigla_posto'].' '.$dado['Especialidade']['nm_especialidade'];

			}
			$this->set(compact('nomes'));
		}
	}
	function externoconsultaescalas(){
		$this->layout = null;
		$u=$this->Session->read('Usuario');
                if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==2)||($u[0]['Usuario']['privilegio_id']==4)){
                        $sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Setor.id from setors Setor
                        LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
                        LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
                        INNER JOIN escalas Escala on (Escala.setor_id=Setor.id)
                        inner join militars_escalas MilitarEscala on (MilitarEscala.escala_id=Escala.id and MilitarEscala.militar_id='{$this->data['Manutencaooperacional']['militar_id']}')
                        order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";
                }else{
                        $sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Setor.id from setors Setor
                        LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
                        LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
                        INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.setor_id in ({$u[0][0]['setores']}))
                        inner join militars_escalas MilitarEscala on (MilitarEscala.escala_id=Escala.id and MilitarEscala.militar_id='{$this->data['Manutencaooperacional']['militar_id']}')
                        order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";

                }
		$escalas = $this->Manutencaooperacional->query($sql);
		$totalescala=count($escalas)-1;
		$escalastring = '';
		$vetor3[0]=0;
		$vetor4[0]=' ';

		for($c=0;$c<$totalescala;$c++){
			$escalastring.=$escalas[$c]['Setor']['id'].',';
			$vetor3[]=$escalas[$c]['Setor']['id'];
			$vetor4[]=$escalas[$c][0]['escala'];
		}
		$escalastring.=$escalas[$c]['Setor']['id'];
		$vetor3[]=$escalas[$c]['Setor']['id'];
		$vetor4[]=$escalas[$c][0]['escala'];
			
		$escalasselect = array_combine($vetor3,$vetor4);
		
	
		$this->set('escalas',$escalasselect);
	}
	
	function externocadastramanutencaooperacionals(){
		$this->layout = null;
		$this->Session->delete('Message.flash');
		if (!empty($this->data)) {
			$mensagem = '';
			$this->data['Manutencaooperacional']['created']=date('Y-m-d h:i:s');
			
			if(trim($this->data['Manutencaooperacional']['dt_inicio'])==''){
				$mensagem .= '<li>Data de Início em branco.</li>';
			}
			//print_r($this->data);
			$data1 = strtotime($this->data['Manutencaooperacional']['dt_inicio']);

			$dia1=date('d',$data1);
			$mes1=date('m',$data1);
			$ano1=date('Y',$data1);

			$dt1 = $ano1.'-'.$mes1.'-'.$dia1;


			$militarid = $this->data['Manutencaooperacional']['militar_id'];

			$horas_fora = $this->data['Manutencaooperacional']['horas_fora_sede'];
			$motivo = $this->data['Manutencaooperacional']['motivo_fora_sede'];

			$setor_id = $this->data['Manutencaooperacional']['setor_id'];
				
			if((trim($motivo)=='')&&($horas_fora>0)){
				$mensagem .= '<li> É necessário informar o Motivo.</li>';
			}
				


				
			if(strlen($mensagem)<4){
					
				$this->Manutencaooperacional->create();
				if ($this->Manutencaooperacional->save($this->data)) {
					$this->Session->setFlash(__('Os dados de  Manutencaooperacional foram gravados.', true));
				} else {
					$this->Session->setFlash(__('Os dados de Manutencaooperacional não foram gravados. Por favor, tente novamente.', true));
				}
					
			}else{
        				$this->Session->setFlash($mensagem);

			}
		}
			header('Content-type: application/x-json');
		
		$u=$this->Session->read('Usuario');
		$responsavel = $u[0]['Usuario']['militar_id'];
		$selecionamanutencaooperacionalsdodia = "select * from manutencaooperacionals Manutencaooperacional
		left join militars Militar on (Militar.id=Manutencaooperacional.militar_id)
		left join postos Posto on (Posto.id=Militar.posto_id)
		left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		where Manutencaooperacional.militar_responsavel='{$responsavel}' and year(Manutencaooperacional.created)=year(now())  and month(Manutencaooperacional.created)=month(now())  and day(Manutencaooperacional.created)=day(now()) 
		";
		$dadosdodia = $this->Manutencaooperacional->query($selecionamanutencaooperacionalsdodia);
		$this->set('manutencaooperacionalsdodia',$dadosdodia);
		
	}
	function externoexcluimanutencaooperacionals(){
		$this->layout = null;
		$this->Session->delete('Message.flash');
		$id= $this->params['form']['excluiId'];
		if (empty($id)) {
			$this->Session->setFlash(__('ID inválido para Manutencaooperacional', true));
		}
		$excluido = $this->Manutencaooperacional->read(null,$id);
		if ($this->Manutencaooperacional->delete($id)) {
			$this->Session->setFlash(__('Manutencaooperacional excluído:'.$excluido['Manutencaooperacional']['motivo'].'->'.$excluido['Manutencaooperacional']['dt_inicio'], true));
		}		
		
		$u=$this->Session->read('Usuario');
		$responsavel = $u[0]['Usuario']['militar_id'];
		$selecionamanutencaooperacionalsdodia = "select * from manutencaooperacionals Manutencaooperacional
		left join militars Militar on (Militar.id=Manutencaooperacional.militar_id)
		left join postos Posto on (Posto.id=Militar.posto_id)
		left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		left join setors Setor on (Setor.id=Manutencaooperacional.setor_id)
		where Manutencaooperacional.militar_responsavel='{$responsavel}' and year(Manutencaooperacional.created)=year(now())  and month(Manutencaooperacional.created)=month(now())  and day(Manutencaooperacional.created)=day(now()) 
		";
		$dadosdodia = $this->Manutencaooperacional->query($selecionamanutencaooperacionalsdodia);
		//	}
//		$this->set('manutencaooperacionalsdodia',$manutencaooperacionalspelousuario);
		$this->set('manutencaooperacionalsdodia',$dadosdodia);
		//$this->set('mensagem',$mensagem);
		header('Content-type: application/x-json');
//echo 'Teste';exit();		
		
		
	}	
}
?>
