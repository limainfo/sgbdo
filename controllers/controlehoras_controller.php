<?php
class ControlehorasController extends AppController {

	var $name = 'Controlehoras';
	var $helpers = array('Html', 'Form');

	function index() {
		$u=$this->Session->read('Usuario');
                
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']
		['find']) );
		$this->cleanData = $sanitize->clean(
		$this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
$sql = "
select Militar.id , concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome_completo, Setor.sigla_setor, Controlehora.dia_referencia, Controlehora.hora_inicio, Controlehora.hora_termino, Controlehora.supervisor, Controlehora.supervisor_id, Controlehora.id 
FROM controlehoras as Controlehora
INNER JOIN militars as Militar ON (Controlehora.militar_id=Militar.id ) 
INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
INNER JOIN escalas as Escala on (Escala.setor_id=Controlehora.setor_id) 
INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and Escala.id=MilitarsEscala.escala_id) 
INNER JOIN setors Setor ON (Militar.setor_id=Setor.id) 
order by Controlehora.hora_inicio, Controlehora.hora_termino, Posto.sigla_posto, Militar.nm_completo asc			
			";
		//	print_r($this->data);
		//	echo $sql;
   			
		$controlehoras = $this->Controlehora->query($sql);



		if ( $findUrl != '' ) {
			$this->Controlehora->recursive = 2;
			$this->set('controlehoras', $this->paginate('Controlehora',array("LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%'  OR LOWER(`Controlehora`.`militar_id`) LIKE '%" . $findUrl ."%' ) AND LOWER(`Militar`.`setor_id`) in ({$u[0][0]['setores']}) ")));
					$this->set('afastamentos',$controlehoras);
		} else {
			$this->Controlehora->recursive = 2;
			$this->set('controlehoras', $this->paginate(array("LOWER(`Militar`.`setor_id`) in ({$u[0][0]['setores']}) ")));
					$this->set('afastamentos',$controlehoras);
				
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Afastamento.', true));
			$this->redirect(array('action'=>'index'));
		}

		$this->set('afastamento', $this->Controlehora->read(null, $id));
	}

    function add($id = null) {
        $u=$this->Session->read('Usuario');
                
        $hoje = date('Y-m-d');
            /*
        if (!empty($this->data)) {
                    
                $this->Controlehora->create();
                if ($this->Controlehora->save($this->data)) {
                    $this->Session->setFlash(__('Os dados de  Afastamento foram gravados.', true));
                } else {
                    $this->Session->setFlash(__('Os dados de Afastamento não foram gravados. Por favor, tente novamente.', true));
                }
            }
            */

        $militars[1] = 'INFORME PARTE DO NOME OU SARAM';
        $setors[1] = 'INFORME O MILITAR';
        
        $this->set(compact('militars', 'setors','hoje'));
        
        
    }

 function externoadd($id = null) {
       $this->layout = null;
       
          //  print_r($this->data);
            
        if (!empty($this->data)) {
                    
                $this->Controlehora->create();
                if ($this->Controlehora->save($this->data)) {
                    $ok = 1;
                } else {
                    $ok = 0;
                }
            }
        //  }

        $militars[1] = 'INFORME PARTE DO NOME OU SARAM';

        //$militars = $this->Afastamento->Militar->find('list');
        $this->set(compact( 'ok'));
        
    }
    
	function edit($id = null) {
		$u=$this->Session->read('Usuario');
                
		$sql = "select concat(Unidade.sigla_unidade,'-',Localidade.sigla_localidade,'-',Setor.sigla_setor) escala, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
		INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.setor_id in ({$u[0][0]['setores']}))
		order by Unidade.sigla_unidade, Localidade.sigla_localidade, Setor.sigla_setor asc";
		$escalas = $this->Controlehora->query($sql);

		$totalescala=count($escalas)-1;
		$escalastring = '';

		$vetor3[0]=0;
		$vetor4[0]='GERAL';

		for($c=0;$c<$totalescala;$c++){
			$escalastring.=$escalas[$c]['Setor']['id'].',';
			$vetor3[]=$escalas[$c]['Setor']['id'];
			$vetor4[]=$escalas[$c][0]['escala'];
		}
		$escalastring.=$escalas[$c]['Setor']['id'];
		$vetor3[]=$escalas[$c]['Setor']['id'];
		$vetor4[]=$escalas[$c][0]['escala'];
			
		$escalasselect = array_combine($vetor3,$vetor4);

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Afastamento inválido!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$mensagem = '';

			if(trim($this->data['Afastamento']['dt_inicio'])==''){
				$mensagem .= '<li>Data de Início em branco.</li>';
			}
			if(trim($this->data['Afastamento']['dt_termino'])==''){
				$mensagem .= '<li> Data de Término em branco.</li>';
			}

			$data1 = $this->data['Afastamento']['dt_inicio'];
			$data2 = $this->data['Afastamento']['dt_termino'];

			$data1vetor = explode('-',$data1);
			$dia1=$data1vetor[0];
			$mes1=$data1vetor[1];
			$ano1=$data1vetor[2];

			$data2vetor = explode('-',$data2);
			$dia2=$data2vetor[0];
			$mes2=$data2vetor[1];
			$ano2=$data2vetor[2];

			$dt1 = $ano1.'-'.$mes1.'-'.$dia1;
			$dt2 = $ano2.'-'.$mes2.'-'.$dia2;

			$data1 = strtotime($dt1);
			$data2 = strtotime($dt2);

			$militarid = $this->data['Afastamento']['militar_id'];

			if($data2<$data1){
				$mensagem .= '<li>Data de Término inferior a Data de Início.</li>';
			}

			$motivo = $this->data['Afastamento']['motivo'];
			$escala_id = $this->data['Afastamento']['escala_id'];
			/*
			 if($escala_id==0){
				$mensagem .= '<li> É necessário informar a Escala.</li>';
				}
				*/
				

			//echo $sql;

			//print_r($conflitos);
				
			if($mensagem==''){
					
				$this->Controlehora->create();
				if ($this->Controlehora->save($this->data)) {
					$this->Session->setFlash(__('Os dados de  Afastamento foram gravados.', true));
					$this->redirect(array('action'=>'index'));
				} else {
					$this->Session->setFlash(__('Os dados de Afastamento não foram gravados. Por favor, tente novamente.', true));
				}
					
			}else{
				$this->Session->setFlash(__($mensagem, true));

			}
		}
		if (empty($this->data)) {
			$this->data = $this->Controlehora->read(null, $id);
		}
		if(($u[0]['Usuario']['privilegio_id']==5)||($u[0]['Usuario']['privilegio_id']==6)){
			$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
			FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN escalas as Escala on (Militar.setor_id=Escala.setor_id  and Escala.setor_id in ({$escalastring}))
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and Escala.id=MilitarsEscala.escala_id)
			INNER JOIN setors Setor ON (Militar.setor_id=Setor.id)
			where Militar.ativa >0
			order by  Posto.sigla_posto, Militar.nm_completo asc";

			//echo $sql1;


		}else{
			$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
where Militar.ativa >0
order by Posto.antiguidade,Militar.nm_completo asc";
		}

		$militars = $this->Controlehora->Militar->query($sql1);


		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);

		//$militars = $this->Afastamento->Militar->find('list');
		$this->set(compact('militars','escalasselect'));



	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Controlehora', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Controlehora->delete($id)) {
			$this->Session->setFlash(__('Controlehora excluído', true));
			//$this->redirect(array('action'=>'index'));
		}
	}

	
	function update($mes = null) {
		$this->layout = 'ajax_embutido';
   		if(!empty($this->data['Controlehora']['setor_id'])) {
			$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
			FROM militars as Militar INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id)
			LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
			INNER JOIN escalas as Escala on (Escala.setor_id in ({$this->data['Controlehora']['setor_id']}))
			INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and Escala.id=MilitarsEscala.escala_id)
			INNER JOIN setors Setor ON (Militar.setor_id=Setor.id)
			where Militar.ativa>0
			order by  Posto.sigla_posto asc, Militar.nm_completo asc";
			
			$militars = $this->Controlehora->Militar->query($sql1);


			foreach($militars as $milico){
				$vetor[]=$milico['Militar']['id'];
				$vetor2[]=$milico[0]['Militar.nm_completo'];
			}
			$militars=array_combine($vetor,$vetor2);
			
 			$this->set('options',$militars);
 		}
		
	}
	
	function ajax($mes = null) {
		$this->layout = 'ajax_embutido';
   		if(!empty($this->data['Controlehora']['setor_id'])) {
			$sql = "
select Militar.id , concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome_completo, Setor.sigla_setor, Controlehora.dia_referencia, Controlehora.hora_inicio, Controlehora.hora_termino, Controlehora.supervisor, Controlehora.supervisor_id, Controlehora.id 
FROM controlehoras as Controlehora
INNER JOIN militars as Militar ON (Controlehora.militar_id=Militar.id ) 
INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
INNER JOIN escalas as Escala on (Escala.setor_id=Controlehora.setor_id and Escala.setor_id={$this->data['Controlehora']['setor_id']} AND Escala.mes=$mes) 
INNER JOIN militars_escalas as MilitarsEscala on (Militar.id=MilitarsEscala.militar_id and Escala.id=MilitarsEscala.escala_id) 
INNER JOIN setors Setor ON (Militar.setor_id=Setor.id) 
order by Controlehora.hora_inicio, Controlehora.hora_termino, Posto.sigla_posto, Militar.nm_completo asc			
			";
		//	print_r($this->data);
		//	echo $sql;
   			
		$controlehoras = $this->Controlehora->query($sql);

		$this->set('afastamentos',$controlehoras);
   		}
 		
 		
		
	}
	
}
?>