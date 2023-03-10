<?php
class AfastamentosController extends AppController {

	var $name = 'Afastamentos';
	var $helpers = array('Html', 'Form');

	function index() {
	   
        //Configure::write(array('debug'=> 2));


	   
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


		$escalas = $this->Afastamento->query($sql);


		$sql_responsaveis = "select Afastamento.militar_responsavel , concat( Posto.sigla_posto,' ', Militar.nm_completo) as 'Militar.nm_completo', Militar.identidade FROM militars as Militar INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id) INNER JOIN afastamentos as Afastamento on (Militar.id = Afastamento.militar_responsavel)  group by Afastamento.militar_responsavel order by Posto.sigla_posto asc, Militar.nm_completo asc
		";
			//echo $sql_responsaveis;
		$resp = $this->Afastamento->query($sql_responsaveis);

		$responsavel[0]='';
		foreach($resp as $r){
			$responsavel[$r['Afastamento']['militar_responsavel']][0] = $r[0]['Militar.nm_completo'];
			$responsavel[$r['Afastamento']['militar_responsavel']][1] = $r['Militar']['identidade'];
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
		$this->Afastamento->order = array('Afastamento.dt_termino'=>'desc');

		if ( $findUrl != '' ) {
			$opcoes = " LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' OR LOWER(`Afastamento`.`motivo`) LIKE '%" . $findUrl ."%'  ";

			$opcoes = array('conditions'=>array(" LOWER(`Militar`.`nm_completo`) LIKE '%$findUrl%' OR LOWER(`Afastamento`.`motivo`) LIKE '%$findUrl%'  "));
				
			//echo $opcoes;exit();
			$this->Afastamento->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Afastamento->recursive = 0;
					$registros = $this->Afastamento->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Afastamento->recursive = 2;
			$this->Afastamento->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
			$this->Afastamento->Militar->bindModel(array('belongsTo'=>array('Escala'=>array('className'=>'Escala','foreignKey' => 'setor_id','conditions' => 'Escala.setor_id in ("'.$u[0][0]['setores'].'")'))),false);
			$this->set('afastamentos', $this->paginate('Afastamento',array(" LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%'   OR LOWER(`Afastamento`.`motivo`) LIKE '%" . $findUrl ."%' ")));
			// AND LOWER(`Militar`.`setor_id`) in ({$u[0][0]['setores']})
			$this->set(compact('escalas','responsavel'));
			// AND MONTH(`Afastamento`.`dt_termino`)>=(MONTH(NOW())-1)
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Afastamento->recursive = 0;
					$registros = $this->Afastamento->find('all');
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Afastamento->recursive = 2;
			$this->Afastamento->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
			$this->Afastamento->Militar->bindModel(array('belongsTo'=>array('Escala'=>array('className'=>'Escala','foreignKey' => 'setor_id','conditions' => 'Escala.setor_id in ("'.$u[0][0]['setores'].'")'))),false);
			$this->set('afastamentos', $this->paginate());
			//array("LOWER(`Militar`.`setor_id`) in ({$u[0][0]['setores']}) ")
			$this->set(compact('escalas','responsavel'));
		}


	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inv??lido para  Afastamento.', true));
			$this->redirect(array('action'=>'index'));
		}

		$this->Afastamento->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);
		$this->set('afastamento', $this->Afastamento->read(null, $id));
	}

	function add($id = null) {
		//Configure::write(array('debug'=> 2));
		$this->layout = 'admin';
       		$u=$this->Session->read('Usuario');
                
		//print_r($u);

		if (!empty($this->data)) {
			$mensagem = '';
			$this->data['Afastamento']['created']=date('Y-m-d h:i:s');
			
			if(trim($this->data['Afastamento']['dt_inicio'])==''){
				$mensagem .= '<li>Data de In??cio em branco.</li>';
			}
			if(trim($this->data['Afastamento']['dt_termino'])==''){
				$mensagem .= '<li> Data de T??rmino em branco.</li>';
			}

			$data1 = strtotime($this->data['Afastamento']['dt_inicio'].' +2 day');
			$data2 = strtotime($this->data['Afastamento']['dt_termino'].' +2 day');

			//$data1vetor = explode('-',$data1);
			$dia1=date('d',$data1);
			$mes1=date('m',$data1);
			$ano1=date('Y',$data1);

			$dia2=date('d',$data2);
			$mes2=date('m',$data2);
			$ano2=date('Y',$data2);

			$dt1 = $ano1.'-'.$mes1.'-'.$dia1;
			$dt2 = $ano2.'-'.$mes2.'-'.$dia2;


			$militarid = $this->data['Afastamento']['militar_id'];

			if($data2<$data1){
				$mensagem .= '<li>Data de T??rmino inferior a Data de In??cio.</li>';
			}

			$motivo = $this->data['Afastamento']['motivo'];
			$setor_id = $this->data['Afastamento']['setor_id'];
				
			if(trim($motivo)==''){
				$mensagem .= '<li> ?? necess??rio informar o Motivo.</li>';
			}
				

			$sql = "select count(*) fora from afastamentos where militar_id='$militarid'  and ( (DATEDIFF('{$dt1}',dt_inicio)>=0 or DATEDIFF('{$dt1}',dt_inicio)<=0) and DATEDIFF('{$dt1}',dt_termino)<=0) and  (DATEDIFF('{$dt2}',dt_inicio)>=0)  and setor_id='$setor_id'  and (motivo not like '%CTP%' or motivo not like '%CTOE%' ) group by militar_id	";
                        

			$conflitos = $this->Afastamento->query($sql);
			
			


			if(!(empty($conflitos))){
				$mensagem .= '<li>H?? '.$conflitos[0][0]['fora'].' afastamentos em conflito com as datas informadas.</li>';
			}

// --------------------------------------------------
// Seleciona escalas em que o militar j?? esteja cadastrado

			$mes_escala1 = $ano1.$mes1;
			$mes_escala2 = $ano2.$mes2;
			
			$sql = "select Setor.sigla_setor, STR_TO_DATE(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'%Y-%m-%d') as data, Turno.rotulo, Cumprimentoescala.legenda_cumprido from escalas Escala
			INNER JOIN  escalasmonths  Escalasmonth on  ((Escalasmonth.mes=$mes_escala1 or Escalasmonth.mes=$mes_escala2) and Escala.id=Escalasmonth.escala_id) 
			INNER JOIN cumprimentoescalas Cumprimentoescala on ( Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.cumprido='$militarid')
			INNER JOIN turnos Turno on (Turno.id=Cumprimentoescala.id_turno)
			INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Escala.setor_id='{$this->data['Afastamento']['setor_id']}')
			where ((DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0 or DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')<=0) and DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt2}')<=0) and  (DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0)			
			order by data asc
			 ";
			
			//echo $sql;
			$conflitos = $this->Afastamento->query($sql);

			$t01 = strtoupper($this->data['Afastamento']['motivo']);
			$p601 = '/COMPLEMENTARES/';
			$p701 = '/CTP/';
			$p801 = '/CTOP/';
			$p901 = '/CTOE/';
			if((preg_match($p601, $t01))||(preg_match($p701, $t01))||(preg_match($p801, $t01))||(preg_match($p901, $t01))){
			}else{
				if(!(empty($conflitos))){
					foreach($conflitos as $problemas){
						$problema.="<br>".$problemas['Setor']['sigla_setor'].' - '.$problemas['Turno']['rotulo'].' - '.$problemas[0]['data'].' - '.$problemas['Cumprimentoescala']['legenda_cumprido'];
					}
					$mensagem .= '<li>O militar j?? foi escalado '.count($conflitos).' vez(es). Para cadastrar o afastamento ?? necess??rio substitui o militar conforme dados abaixo :.'.$problema.'</li>';print_r($this->data);
				}
			}
						


			
			//echo $sql."\n".$mensagem;
			//exit();

//-----------------------------------------------------			
			//echo $sql;
                        //echo $mensagem;

			//print_r($conflitos);
				
			if(strlen($mensagem)<4){
					
					$this->Afastamento->create();
					if ($this->Afastamento->save($this->data)) {
						$this->Session->setFlash(__('Os dados de  Afastamento foram gravados.', true));
						//$this->redirect(array('action'=>'index'));
					} else {
						//O militar encontra-se escalado para o dia X na escala Y. Para cadastrar o afastamento, deve-se
						//fazer contato com o escalante providenciando um substituto.
						$this->Session->setFlash(__('Os dados de Afastamento n??o foram gravados. Por favor, tente novamente.', true));
					}
					
			}else{
        				$this->Session->setFlash($mensagem);

			}
//					$this->Session->setFlash(__('Os dados de  Afastamento foram gravados.', true));
                                        
                        

		}
		//	}

		$militars[1] = 'SELECIONE UMA ESCALA';

		//$militars = $this->Afastamento->Militar->find('list');
		$this->set(compact('militars','escalasselect','sql1','mensagem'));
	}

	function edit($id = null, $militar_id = null) {
					$this->redirect(array('action'=>'index'));

	}

	function delete($id = null) {
		$this->Afastamento->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro')),false);

                $this->layout = null;
                header('Content-type: application/x-json');
        
        
                
		//$this->layout='admin';
		if (!$id) {
			$this->Session->setFlash(__('ID inv??lido para Afastamento', true));
			$this->redirect(array('action'=>'index'));
		}
		//Configure::write(array('debug'=> 2));
		
		//----------------------------------------------------------------
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
		
		$consultaafastamento = 'select * from afastamentos Afastamento
					inner join setors Setor on (Setor.id=Afastamento.setor_id) 
					where Afastamento.id="'.$id.'" 	';
		
		//echo $consultaafastamento;
		//exit();
		//echo $consultaescala;
		//
		$resultafastamento=$this->Afastamento->query($consultaafastamento);
		//print_r($resultsetor);
		$rsetor=print_r($resultafastamento,true);
		$mudanca = '<u><b>Afastamento Exclu??do:</b></u>'.$rsetor;
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclus??o de Afastamento",now(),"AFASTAMENTO", "'.$mudanca.'","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
									//		echo $monitora;
		//		exit();
		$this->Afastamento->query($monitora);
		//------------------------------------------------------------------------------------------------------------
		
                
		if ($this->Afastamento->delete($id)) {
			$this->Session->setFlash(__('Afastamento exclu??do', true));
                        echo json_encode('Afastamento exclu??do');
			//$this->redirect(array('action'=>'index'));
		}
        exit();
	}
	function update($id = null) {
		$this->layout = 'ajax_embutido';
		$u=$this->Session->read('Usuario');
                
		//print_r($this->data);
		
   		if(!empty($this->data['Afastamento']['setor_id'])) {
		
			$sql1 = "select  Militar.id  , concat(  Militar.nm_completo,' ', Posto.sigla_posto,' -> ',Posto.sigla_posto,' ', Militar.nm_guerra)  as 'Militar.nm_completo', Militar.nm_guerra
			FROM militars as Militar INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN escalas as Escala on (Escala.setor_id in ('{$this->data['Afastamento']['setor_id']}'))
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and Escala.id=MilitarsEscala.escala_id)
			LEFT JOIN setors Setor ON (Militar.setor_id=Setor.id)
			where Militar.ativa>0
			order by  Posto.sigla_posto asc, Militar.nm_completo asc";

		
		$militars = $this->Afastamento->Militar->query($sql1);

		
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
	/*
	"
	select * from escalasmonths
inner join escalas on (escalasmonths.escala_id=escalas.id and escalasmonths.mes=201007)
inner join setors on (escalas.setor_id=setors.id)
inner join unidades on (unidades.id=setors.unidade_id)
inner join afastamentos on (afastamentos.escala_id=setors.id and 
(DATEDIFF('01/07/2010',dt_inicio)>=0 and DATEDIFF('{$dataTemp}',dt_termino)<=0)
)
inner join militars on (afastamentos.militar_id=militars.id)

where escalasmonths.id=3019
	"
	*/
	function externoupdateano($setorId = null) {
		$this->layout = 'ajax';
		if(!empty($setorId)) {
			//$filtro = 'Setor.id='.$setorId;
			$consultasql = "
			select escalasmonths.id, escalasmonths.mes from escalas 
				inner join escalasmonths on (escalasmonths.escala_id=escalas.id )
				where escalas.setor_id='{$setorId}'
				group by escalasmonths.id, escalasmonths.mes
				order by escalasmonths.mes desc
				
			";
			//$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_Setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
			$consulta = $this->Afastamento->query($consultasql);
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
			$dadosescalasmonth = $this->Afastamento->query('select setors.sigla_setor, escalasmonths.escala_id, escalasmonths.mes  from escalasmonths inner join escalas on (escalasmonths.escala_id=escalas.id) inner join setors on (setors.id="'.$setorId.'" and setors.id=escalas.setor_id) where escalasmonths.id="'.$escalasmonthId.'"');
			$escalaId=$dadosescalasmonth[0]['escalasmonths']['escala_id'];
			$ano = substr($dadosescalasmonth[0]['escalasmonths']['mes'],0,4);
			$mes = substr($dadosescalasmonth[0]['escalasmonths']['mes'],-2);
			$dtIni = "$ano-$mes-1";
			$dtFim = "$ano-$mes-".date('t',strtotime($dtIni));

			$sqlafastamento = "select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome,  Afastamento.* from afastamentos Afastamento
			INNER JOIN militars as Militar ON (Militar.id in (select militar_id from militars_escalas where escala_id='{$escalaId}') and Militar.id=Afastamento.militar_id )
			INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
                        INNER JOIN setors on (setors.id=Afastamento.setor_id)
			INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id)
			where ((DATEDIFF('{$dtIni}',dt_inicio)>=0 or DATEDIFF('{$dtIni}',dt_inicio)<=0) and DATEDIFF('{$dtIni}',dt_termino)<=0) and  (DATEDIFF('{$dtFim}',dt_inicio)>=0)  and (Afastamento.setor_id is null or Afastamento.setor_id='{$setorId}')
			order by nome asc, Afastamento.motivo, Afastamento.dt_inicio asc ";
	/*select concat(Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_guerra ) as nome, Afastamento.* from afastamentos Afastamento 
INNER JOIN militars as Militar on  ( Militar.id in (select militar_id from militars_escalas where escala_id=11) and Militar.id=Afastamento.militar_id ) 
INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
INNER JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) 
where (DATEDIFF('2010-07-1',dt_termino)<=0) and (DATEDIFF('2010-07-31',dt_inicio)>=0) and (Afastamento.escala_id=0 or Afastamento.escala_id=40)
 order by nome asc, Afastamento.motivo, Afastamento.dt_inicio asc */		
			//echo $sqlafastamento.'<br>';
			
			$afastados = $this->Afastamento->query($sqlafastamento);
                        //echo $afastados;exit();
			$setor = $dadosescalasmonth[0]['setors']['sigla_setor'];
			
			$this->set(compact('afastados','setor'));
		}

			$this->render();
		
	//	exit();
	}
	function externoconsultanomes($limpo=null){
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
			$resultados = $this->Afastamento->query($sql);
			foreach($resultados as $dado){
				if($limpo){
					$nomes[$dado['Militar']['id']] = $dado['Posto']['sigla_posto'].' '.$dado['Especialidade']['nm_especialidade'].' - '.$dado['Militar']['nm_completo'];
				}else{
					$nomes[$dado['Militar']['id']] = str_pad($dado['Militar']['nm_completo'],50,'_').$dado['Posto']['sigla_posto'].' '.$dado['Especialidade']['nm_especialidade'];
				}
			}
			//print_r($nomes);
			$this->set(compact('nomes'));
		}
	}
	function externoconsultaescalas(){
		$this->layout = null;
		$u=$this->Session->read('Usuario');
                if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==17)||($u[0]['Usuario']['privilegio_id']==5)||($u[0]['Usuario']['privilegio_id']==6)){
                   //if((date('d')>15)&&(date('d')<23)){$filtro = " and Escala.tipo not like 'RISAER' ";                  } 
                }
                
                if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==2)||($u[0]['Usuario']['privilegio_id']==4)){
                        $sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Setor.id from setors Setor
                        LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
                        LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
                        INNER JOIN escalas Escala on (Escala.setor_id=Setor.id $filtro and Escala.ativa>0)
                        inner join militars_escalas MilitarEscala on (MilitarEscala.escala_id=Escala.id and MilitarEscala.militar_id='{$this->data['Afastamento']['militar_id']}')
                        order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";
                }else{
//                        INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.setor_id in ({$u[0][0]['setores']}) $filtro )
                        $sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Setor.id from setors Setor
                        LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
                        LEFT JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
                        INNER JOIN escalas Escala on (Escala.setor_id=Setor.id  $filtro  and Escala.ativa>0 )
                        inner join militars_escalas MilitarEscala on (MilitarEscala.escala_id=Escala.id and MilitarEscala.militar_id='{$this->data['Afastamento']['militar_id']}')
                        order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";

                }
	
		$escalas = $this->Afastamento->query($sql);

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
	
	function externocadastraafastamentos(){
		$this->layout = null;
		$this->Session->delete('Message.flash');
		if (!empty($this->data)) {
			$mensagem = '';
			$this->data['Afastamento']['created']=date('Y-m-d h:i:s');
			
			if(trim($this->data['Afastamento']['dt_inicio'])==''){
				$mensagem .= '<li>Data de In??cio em branco.</li>';
			}
			if(trim($this->data['Afastamento']['dt_termino'])==''){
				$mensagem .= '<li> Data de T??rmino em branco.</li>';
			}

			$data1 = strtotime($this->data['Afastamento']['dt_inicio']);
			$data2 = strtotime($this->data['Afastamento']['dt_termino']);

			//$data1vetor = explode('-',$data1);
			$dia1=date('d',$data1);
			$mes1=date('m',$data1);
			$ano1=date('Y',$data1);

			$dia2=date('d',$data2);
			$mes2=date('m',$data2);
			$ano2=date('Y',$data2);

			$dt1 = $ano1.'-'.$mes1.'-'.$dia1;
			$dt2 = $ano2.'-'.$mes2.'-'.$dia2;


			$militarid = $this->data['Afastamento']['militar_id'];


			$motivo = $this->data['Afastamento']['motivo'];
			$horaextra = $this->data['Afastamento']['hora_extra'];
			
//			$setores_id = explode(',',$this->data['Afastamento']['setor_id'][0]);
			$setores_id = $this->data['Afastamento']['setor_id'];
			
			//print_r($this->data);
				
			if(trim($motivo)==''){
				$mensagem .= '<b><u> ?? necess??rio informar o Motivo.</u></b>';
			}
			
			
			if(count($setores_id)==1){
				$setores_id = $this->data['Afastamento']['setor_id'];
				$setores_id[1000] = $this->data['Afastamento']['setor_id'];
			}else{
				$setores_id = $this->data['Afastamento']['setor_id'];
			}
			
			//print_r($setores_id);
			//print_r($this->data);
				
			foreach($setores_id as $setor_id){
				
				//echo $setor_id;

			$sql = "select count(*) fora from afastamentos where militar_id='$militarid'  and ( (DATEDIFF('{$dt1}',dt_inicio)>=0 or DATEDIFF('{$dt1}',dt_inicio)<=0) and DATEDIFF('{$dt1}',dt_termino)<=0) and  (DATEDIFF('{$dt2}',dt_inicio)>=0)  and setor_id='$setor_id'  and (motivo not like '%CTP%' or motivo not like '%CTOE%' )  group by militar_id	";
                        
			$this->data['Afastamento']['setor_id']=$setor_id;
			$conflitos = $this->Afastamento->query($sql);
			
			$sqlnomes = "select sigla_setor from setors Setor where id='$setor_id' ";
			//echo $sqlnomes;
			
			$sqlnome = $this->Afastamento->query($sqlnomes);
			
			//print_r($sqlnome);
			$nomeEscala = $sqlnome[0]['Setor']['sigla_setor'];
			//echo $sql;
			$conflitos = $this->Afastamento->query($sql);

			$status = 0;
			

			if(!(empty($conflitos))){
				$sql = "select * from afastamentos where militar_id='$militarid'  and ( (DATEDIFF('{$dt1}',dt_inicio)>=0 or DATEDIFF('{$dt1}',dt_inicio)<=0) and DATEDIFF('{$dt1}',dt_termino)<=0) and  (DATEDIFF('{$dt2}',dt_inicio)>=0)  and setor_id='$setor_id' ";
				$mensagem .= '<b><u>H?? '.$conflitos[0][0]['fora'].' afastamentos em conflito com as datas informadas.</u></b>';
				$status = 1;
				$k = $this->Afastamento->query($sql);
				foreach($k as $afastamento){
					$mensagem .= "<li>Escala: <b>{$nomeEscala}</b> In??cio:{$afastamento['afastamentos']['dt_inicio']} - T??rmino:{$afastamento['afastamentos']['dt_termino']} - {$afastamento['afastamentos']['motivo']}</li>";
				}
			}

// --------------------------------------------------
// Seleciona escalas em que o militar j?? esteja cadastrado

			$mes_escala1 = $ano1.$mes1;
			$mes_escala2 = $ano2.$mes2;
			$completasql = '';
			for($intervaloano=$ano1;$intervaloano<=$ano2;$intervaloano++){
				for($intervalomes=$mes1;$intervalomes<=$mes2;$intervalomes++){
					$completasql .= ' Escalasmonth.mes='.$intervaloano.str_pad($intervalomes,2,'0',STR_PAD_LEFT).' or ';
				}
			}
			$completasql .= '1=1';
			//Escalasmonth.mes=$mes_escala1 or Escalasmonth.mes=$mes_escala2
			
			$sql = "select Setor.sigla_setor, STR_TO_DATE(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'%Y-%m-%d') as data, Turno.rotulo, Cumprimentoescala.legenda_cumprido from escalas Escala
			INNER JOIN  escalasmonths  Escalasmonth on  (({$completasql}) and Escala.id=Escalasmonth.escala_id) 
			INNER JOIN cumprimentoescalas Cumprimentoescala on ( Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.cumprido='$militarid')
			INNER JOIN turnos Turno on (Turno.id=Cumprimentoescala.id_turno)
			INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Escala.setor_id='{$this->data['Afastamento']['setor_id']}')
			where ((DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0 or DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')<=0) and DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt2}')<=0) and  (DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0)			
			order by data asc
			 ";
			
			//echo $sql;
			$conflitos = $this->Afastamento->query($sql);


			$t01 = strtoupper($this->data['Afastamento']['motivo']);
			$p601 = '/COMPLEMENTARES/';
			$p701 = '/CTP/';
			$p801 = '/CTOP/';
			$p901 = '/CTOE/';
			if((preg_match($p601, $t01))||(preg_match($p701, $t01))||(preg_match($p801, $t01))||(preg_match($p901, $t01))){
			}else{
				if(!(empty($conflitos))){
					foreach($conflitos as $problemas){
						$problema.="<li>".$problemas['Setor']['sigla_setor'].' - '.$problemas['Turno']['rotulo'].' - '.$problemas[0]['data'].' - '.$problemas['Cumprimentoescala']['legenda_cumprido'].'</li>';
					}
					$mensagem .= '<b><u>O militar j?? foi escalado '.count($conflitos).' vez(es). Para cadastrar o afastamento ?? necess??rio substitui o militar conforme dados abaixo :</u></b>'.$problema;
					$status = 1;
				}
			}


			if($data2<$data1){
				$mensagem = '<b><u>Data de T??rmino inferior a Data de In??cio.</u></b>';
				$status = 1;
			}

			if($status==0){
				$sqlexcecao = "select * from escalas Escala
				INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Escala.setor_id='{$this->data['Afastamento']['setor_id']}')
				where Escala.tipo='RISAER' ";
				$conflitosexcecao = $this->Afastamento->query($sqlexcecao);
				
				//echo $sqlexcecao;
				//print_r($conflitosexcecao);
					
				//if($conflitosexcecao[0]['Escala']['tipo']=='RISAER' && ( strpos($motivo, 'DO TURNO')!==FALSE ||strpos($motivo, 'EXPEDIENTE ADMINISTRATIV')!==FALSE ||  strpos($motivo, 'MUDAN')!==FALSE  )){
				//		$mensagem .= 'Os dados de Afastamento para a escala <b>'.$nomeEscala.'</b> n??o foram gravados. Por favor, tente novamente.<br>';
				//}else{
						
					//print_r($this->data);
					$this->Afastamento->create();
					if ($this->Afastamento->save($this->data)) {
						$mensagem .= 'Os dados de  Afastamento para a escala <b>'.$nomeEscala.'</b> foram gravados.<br>';
					} else {
						$mensagem .= 'Os dados de Afastamento para a escala <b>'.$nomeEscala.'</b> n??o foram gravados. Por favor, tente novamente.<br>';
					}
				//}
					
			}
			
			
			}
			
			//echo $sql."\n".$mensagem;
			//exit();

//-----------------------------------------------------			
			//echo $sql;
                        //echo $mensagem;

			//print_r($conflitos);
				

			$this->Session->setFlash($mensagem);

//					$this->Session->setFlash(__('Os dados de  Afastamento foram gravados.', true));
                                        
                        

		}
			header('Content-type: application/x-json');
		
		$u=$this->Session->read('Usuario');
		$responsavel = $u[0]['Usuario']['militar_id'];
		$selecionaafastamentosdodia = "select * from afastamentos Afastamento
		left join militars Militar on (Militar.id=Afastamento.militar_id)
		left join postos Posto on (Posto.id=Militar.posto_id)
		left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		left join setors Setor on (Setor.id=Afastamento.setor_id)
		where Afastamento.militar_responsavel='{$responsavel}' and year(Afastamento.created)=year(now())  and month(Afastamento.created)=month(now())  and day(Afastamento.created)=day(now()) 
		";
		$dadosdodia = $this->Afastamento->query($selecionaafastamentosdodia);
		
		//print_r($dadosdodia);
		//	}
//		$this->set('afastamentosdodia',$afastamentospelousuario);
		$this->set('afastamentosdodia',$dadosdodia);
		//$this->set('mensagem',$mensagem);
		
		
	}
	function externoexcluiafastamentos(){
		$this->layout = null;
		$this->Session->delete('Message.flash');
		$id= $this->params['form']['excluiId'];
		if (empty($id)) {
			$this->Session->setFlash(__('ID inv??lido para Afastamento', true));
		}
		$excluido = $this->Afastamento->read(null,$id);
		if ($this->Afastamento->delete($id)) {
			$this->Session->setFlash(__('Afastamento exclu??do:'.$excluido['Afastamento']['motivo'].'->'.$excluido['Afastamento']['dt_inicio'],true));
		}		
		
		$u=$this->Session->read('Usuario');
		$responsavel = $u[0]['Usuario']['militar_id'];
		$selecionaafastamentosdodia = "select * from afastamentos Afastamento
		left join militars Militar on (Militar.id=Afastamento.militar_id)
		left join postos Posto on (Posto.id=Militar.posto_id)
		left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		left join setors Setor on (Setor.id=Afastamento.setor_id)
		where Afastamento.militar_responsavel='{$responsavel}' and year(Afastamento.created)=year(now())  and month(Afastamento.created)=month(now())  and day(Afastamento.created)=day(now()) 
		";
		$dadosdodia = $this->Afastamento->query($selecionaafastamentosdodia);
		//	}
//		$this->set('afastamentosdodia',$afastamentospelousuario);
		$this->set('afastamentosdodia',$dadosdodia);
		//$this->set('mensagem',$mensagem);
		header('Content-type: application/x-json');
//echo 'Teste';exit();		
		
		
	}	
function externoexcel($mes = null, $ano = null) {
		$this->layout = null;
		if((!empty($mes))&&(!empty($ano))) {

			$sql= "select Militar.id, Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade, Unidade.sigla_unidade, Setor.sigla_setor, Militar.nm_guerra, Militar.nm_completo  from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			inner join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc ";
			$efetivo = $this->Afastamento->query($sql);
			$indice = 0;
			foreach($efetivo as $conteudo){
				$dados[$indice]['id']=$conteudo['Militar']['id'];	
				$dados[$indice]['posto']=$conteudo['Posto']['sigla_posto'];	
				$dados[$indice]['quadro']=$conteudo['Quadro']['sigla_quadro'];	
				$dados[$indice]['especialidade']=$conteudo['Especialidade']['nm_especialidade'];	
				$dados[$indice]['unidade']=$conteudo['Unidade']['sigla_unidade'];	
				$dados[$indice]['setor']=$conteudo['Setor']['sigla_setor'];	
				$dados[$indice]['nmguerra']=$conteudo['Militar']['nm_guerra'];	
				$dados[$indice]['nmcompleto']=$conteudo['Militar']['nm_completo'];	
				$dados[$indice]['afastamentos']='';	
				$indice++;
			}
			
			$dt1 = "{$ano}-{$mes}-1";
			$ultimodia = strftime('%d',mktime (0,0,0,$mes+1,0,$ano));
			$dt2 = "{$ano}-{$mes}-{$ultimodia}";
			
			$mes = str_pad($mes, 2, '0', STR_PAD_LEFT);

			for($i=0;$i<=$indice;$i++){
				$militarid = $dados[$i]['id'];
				$sql = "select * from afastamentos where militar_id='{$militarid}'  and ( (DATEDIFF('{$dt1}',dt_inicio)>=0 or DATEDIFF('{$dt1}',dt_inicio)<=0) and DATEDIFF('{$dt1}',dt_termino)<=0) and  (DATEDIFF('{$dt2}',dt_inicio)>=0) ";
				
				$k = $this->Afastamento->query($sql);
				foreach($k as $afastamento){
					$temp = $dados[$i]['afastamentos'];
					$dados[$i]['afastamentos'] = $temp."In??cio:{$afastamento['afastamentos']['dt_inicio']} - T??rmino:{$afastamento['afastamentos']['dt_termino']} - {$afastamento['afastamentos']['motivo']} --- ";
				}
				
				$mes_escala = $ano.$mes;
				$sql = "select Setor.sigla_setor, STR_TO_DATE(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'%Y-%m-%d') as data, Turno.rotulo, Cumprimentoescala.legenda_cumprido from escalas Escala
				INNER JOIN  escalasmonths  Escalasmonth on  ((Escalasmonth.mes={$mes_escala}) and Escala.id=Escalasmonth.escala_id) 
				INNER JOIN cumprimentoescalas Cumprimentoescala on ( Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.cumprido='$militarid')
				INNER JOIN turnos Turno on (Turno.id=Cumprimentoescala.id_turno)
				INNER JOIN setors Setor on (Setor.id=Escala.setor_id)
				where ((DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0 or DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')<=0) and DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt2}')<=0) and  (DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0)			
				order by data asc
				 ";
				$z = $this->Afastamento->query($sql);
				if(!(empty($z))){
					$problema = '';
					foreach($z as $problemas){
						$problema .= $problemas['Setor']['sigla_setor'].' - '.$problemas['Turno']['rotulo'].' - '.$problemas[0]['data'].' - '.$problemas['Cumprimentoescala']['legenda_cumprido']."---";
					}
					$temp = $dados[$i]['afastamentos'];
					$dados[$i]['afastamentos'] = $temp."Escala:{$problema} ---";
				}
			}




				
			
			
					
			$this->set(compact('dados','mes','ano'));
			//print_r($dados);exit();
    }

			$this->render();
		
	//	exit();
	}
        
function externoconsultaajax($militarid=null, $setorid=null) {
        $this->layout = null;
        $this->Afastamento->recursive = 0;
        header('Content-type: application/x-json');
//        where Militar.saram='{$_POST['saram']}'

        $sql = "select *
        FROM afastamentos as Afastamento
        where Afastamento.setor_id='{$_POST['setorid']}' and  Afastamento.militar_id={$_POST['militarid']} ";

        //echo $sql;
        
        $dados = $this->Afastamento->query($sql);
        
        echo json_encode($dados);
        
        

        exit();
}
        
	
}
?>
