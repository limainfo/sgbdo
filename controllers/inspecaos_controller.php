<?php
class InspecaosController extends AppController {

	var $name = 'Inspecaos';
	var $helpers = array('Html', 'Form','Javascript', 'Ajax');

	function index($consulta = null) {
		$this->layout = 'admin';
                //print_r($this->data);
		$sql = "select Inspecao.status from inspecaos Inspecao group by Inspecao.status";
		$status = $this->Inspecao->query($sql);
		$this->set('status',$status);
		$esquema = $this->Inspecao->_schema;
		$this->set('esquema',$esquema);
		if ( (!empty($this->data['valor01']) && !empty($this->data['campo01']))||(!empty($this->data['campo02']) && !empty($this->data['campo02'])) ) {
			$this->Session->write('inspecoes',$this->data);
		}else{
			if($this->Session->check('inspecoes')){
				$this->data = $this->Session->read('inspecoes');
			}
		}
		$opcoes = array();
                $opcao=' (Inspecao.status not like "CONCL%") and (Inspecao.status not like "%CANCELA%")';
                $contaconsulta = 0;

                $campo01=$this->data['campo01']; 
                $this->set('campo01',$campo01);
                $valor01=$this->data['buscaajax']['valor01']; 
                $filtro01= str_replace('++++',$valor01, $this->data['filtro01']);
                if(!empty($valor01) && !empty($campo01)){
					$opcoes01 = array('Inspecao.'.$campo01.$filtro01 );
					array_push($opcoes, $opcoes01);
                                        $contaconsulta++;
					
				}
                

                $campo02=$this->data['campo02']; 
                $this->set('campo02',$campo02);
                $valor02=$this->data['buscaajax']['valor02']; 
                $filtro02= str_replace('++++',$valor02, $this->data['filtro02']);
                if(!empty($valor02) && !empty($campo02)){
                        $opcoes02 = array('Inspecao.'.$campo02.$filtro02 );
                        array_push($opcoes, $opcoes02);
                        $contaconsulta++;
					
                }
                
                
		if ( (!empty($valor01) && !empty($campo01))||(!empty($valor02) && !empty($campo02)) ) {
			if(!empty($this->data['formFind']['paginas'])){
                            if($contaconsulta>0){
                                    $registros = $this->Inspecao->find('all',$opcoes);
                                    $qtdPaginas = 1;
                                    $this->data['formFind']['paginas'] = count($registros);
                            }
                            if($this->data['formFind']['paginas']=='TODAS'){
                                    $registros = $this->Inspecao->find('all',$opcoes);
                                    $qtdPaginas = $this->data['formFind']['paginas'];
                                    $this->data['formFind']['paginas'] = count($registros);
                            }
                            $this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
                        
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Inspecao->recursive = 0;
			//	$this->set('inspecaos', $this->paginate('Inspecao',array("LOWER(`Inspecao`.`origem`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`meta`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`gestor`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`status`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`item`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`orgao`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`tipo`) LIKE '%" . $findUrl ."%'  OR LOWER(`Inspecao`.`acao_recomendada`) LIKE '%" . $findUrl ."%'  OR LOWER(`Inspecao`.`plano_acao_gestor`) LIKE '%" . $findUrl ."%'  OR LOWER(`Inspecao`.`acoes_executadas`) LIKE '%" . $findUrl ."%' ")));//
					//print_r($opcoes);
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Inspecao->find('all',$opcoes);
					$this->Session->del('inspecoes');
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
                                if($this->data['formFind']['paginas']>30 && $this->data['formFind']['paginas']!='TODAS'){
                                    $this->data['formFind']['paginas']=30;
                                }
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Inspecao->recursive = 0;
		}
			$this->set('inspecaos', $this->paginate('Inspecao',array($opcoes)));

	}

	function externoindex() {
		$this->layout = 'adminexterno';
		/*uses('sanitize');
		 $sanitize = new Sanitize();
		 $this->set('findUrlNotCleaned',
		 trim($this->data['formFind']
		 ['find']) );
		 $this->cleanData = $sanitize->clean(
		 $this->data );
		 $findUrl = low(trim($this->cleanData['formFind']['find']) );
		 */
		$findUrl = low(trim($this->data['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Inspecao->recursive = 0;
			$this->set('inspecaos', $this->paginate('Inspecao',array("LOWER(`Inspecao`.`origem`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`tipo`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`numero`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`gestor`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`executor`) LIKE '%" . $findUrl ."%' OR LOWER(`Inspecao`.`executor`) LIKE '%" . $findUrl ."%'")));
		} else {
			$this->Inspecao->recursive = 0;
			$this->set('inspecaos', $this->paginate());
		}

	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Inspecao.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('inspecao', $this->Inspecao->read(null, $id));
	}

	function externoview($id = null) {
		$this->layout = 'adminexterno';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Inspecao.', true));
			$this->redirect(array('action'=>'externoindex'));
		}
		$this->set('inspecao', $this->Inspecao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Inspecao->create();
			if ($this->Inspecao->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Inspecao foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Inspecao não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if(empty($this->data)){
			$sql = 'select distinct(organizacao) from inspecaos ';
			$origem = $this->Inspecao->query($sql);
			$sql = 'select distinct(tipo) from inspecaos ';
			$tipo = $this->Inspecao->query($sql);
			$sql = 'select distinct(orgao) from inspecaos ';
			$organizacao = $this->Inspecao->query($sql);
				
			$this->set(compact('origem','tipo','organizacao'));
		}
	}

	function edit($id = null, $consulta = null) {
		$u=$this->Session->read('Usuario');
                
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalido Inspecao', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Inspecao->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Inspecao foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Inspecao não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$sql = 'select distinct(origem) from inspecaos ';
			$origem = $this->Inspecao->query($sql);
			$sql = 'select distinct(tipo) from inspecaos ';
			$tipo = $this->Inspecao->query($sql);
			$sql = 'select distinct(orgao) from inspecaos ';
			$organizacao = $this->Inspecao->query($sql);

			$this->set(compact('origem','tipo','organizacao','consulta'));
			$this->data = $this->Inspecao->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Inspecao', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Inspecao->delete($id)) {
			$this->Session->setFlash(__('Inspecao excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function indexExcel()
	{

		$this->layout = 'openoffice' ;
		$this->Inspecao->recursive = null;

                $campo=$this->data['campo']; 
                $this->set('campo',$campo);
                $valor=$this->data['valor']; 
                $filtro= str_replace('++++',$valor, $this->data['filtro']);
                $opcoes = array('Inspecao.'.$campo.$filtro );

		if ( !empty($valor) && !empty($filtro) && !empty($campo) ) {
			$conteudo = $this->Inspecao->find('all',array('conditions'=>array($opcoes)));
		}else{
			$conteudo = $this->Inspecao->find('all');
		}

		$esquema = $this->Inspecao->_schema;
		$conta = 0;
		foreach($esquema as $indice=>$vetor){
		   $campos[$conta]=$indice;
		   $conta++;
		}
		
		$titulo = 'Dados de Inspecao';
		$tabela = 'Inspecao';
		$nome = 'planilha_inspecao';

		$this->set(compact('titulo','tabela','conteudo','campos','nome'));
		//$this->render();
                //print_r($this->data);
                //exit();
	}

	function verso() {
		$mensagem="";
		$ok='0';
		if (!empty($this->data)) {
			if ($this->Inspecao->save($this->data)) {
				$ok='1';
			}
		}
/*
		$inspecao = $this->Inspecao->findById($this->data['Inspecao']['id']);
		
		$id = $this->data['Inspecao']['id'];


		
		if($inspecao['Inspecao']['status']=='PENDENTE'){
			$td = ' style="background-color:#F0D0D0;" ';
		}else{
			$td='';
		}
		if(($inspecao['Inspecao']['plano_acao_gestor_status']=="MODIFICADO")||($inspecao['Inspecao']['acao_recomendada_status']=="MODIFICADO")||($inspecao['Inspecao']['acoes_executadas_status']=="MODIFICADO")){
			$td = ' style="background-color:#A0A0B0;" ';
		}

		$conteudo =<<<CONTEUDO

		<td {$td}>{$inspecao['Inspecao']['origem']}></td>
		<td {$td}>{$inspecao['Inspecao']['tipo']}></td>
		<td {$td}>{$inspecao['Inspecao']['orgao']}></td>
		<td {$td}>{$inspecao['Inspecao']['item']}></td>
		<td {$td}>{$inspecao['Inspecao']['descricao']}</td>
		<td {$td}>{$inspecao['Inspecao']['meta']}</td>
		<td {$td}>{$inspecao['Inspecao']['status_meta']}</td>
		<td {$td}>{$inspecao['Inspecao']['gestor']}</td>
		<td {$td}>{$inspecao['Inspecao']['acao_recomendada']}</td>
		<td {$td}>{$inspecao['Inspecao']['obs_chf_d_o']}</td>
		<td {$td}>{$inspecao['Inspecao']['plano_acao_gestor']}</td>
		<td {$td}>{$inspecao['Inspecao']['acoes_executadas']}</td>
		<td {$td}>{$inspecao['Inspecao']['prazo']}</td>
		<td {$td}>{$inspecao['Inspecao']['status']}</td>
		<td class="actions"><a href="{$this->webroot}{$this->params['controller']}/view/{$inspecao['Inspecao']['id']}"><img border="0" title="Visualizar" alt="Exibir" src="{$this->webroot}img/lupa.gif"/></a>
<img border="0" onclick="exibe('{$inspecao['Inspecao']['id']}' ,'{$inspecao['Inspecao']['origem']}', '{$inspecao['Inspecao']['data']}', '{$inspecao['Inspecao']['numero']}', '{$inspecao['Inspecao']['orgao']}', '{$inspecao['Inspecao']['tipo']}', '{$inspecao['Inspecao']['item']}', '{$inspecao['Inspecao']['descricao']}', '{$inspecao['Inspecao']['meta']}', '{$inspecao['Inspecao']['status_meta']}', '{$inspecao['Inspecao']['controle_oaple']}', '{$inspecao['Inspecao']['gestor']}', '{$inspecao['Inspecao']['acao_recomendada']}', '{$inspecao['Inspecao']['plano_acao_gestor']}', '{$inspecao['Inspecao']['acoes_executadas']}', '{$inspecao['Inspecao']['obs_chf_d_o']}', '{$inspecao['Inspecao']['prazo']}', '{$inspecao['Inspecao']['status']}', '{$inspecao['Inspecao']['plano_acao_gestor_status']}', '{$inspecao['Inspecao']['acoes_executadas_status']}', '{$inspecao['Inspecao']['acao_recomendada_status']}');" title="Editar" alt="Editar" src="{$this->webroot}img/lapis.gif"/>
<a onclick='this.href="#";return false;' onmousedown='dialogo("Deseja realmente excluir o registro {$inspecao['Inspecao']['origem']} ?" ,"{$this->webroot}{$this->params['controller']}/delete/{$inspecao['Inspecao']['id']}");' href="/operacional/inspecaos"><img border="0" title="Excluir" alt="Excluir" src="/operacional/img/lixo.gif"/></a>		</td>	
</td>
CONTEUDO;
*/

//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "id":"'.$id.'", "mensagem":"'.addslashes($conteudo).'" }';

		exit();

	}

        function externopdf(){
            $this->layout="xtcpdf";
//            $this->render();

            $campo=$this->data['campo']; 
            $this->set('campo',$campo);
            $valor=$this->data['valor']; 
            $filtro= str_replace('++++',$valor, $this->data['filtro']);
            $opcoes = array('Inspecao.'.$campo.$filtro );

            if ( !empty($valor) && !empty($filtro) && !empty($campo) ) {
                    $conteudo = $this->Inspecao->find('all',array('conditions'=>array($opcoes)));
            }else{
                    $conteudo = $this->Inspecao->find('all');

            }
            
            
      //      $this->set('inspecao',$status);
            
        $esquema = $this->Inspecao->_schema;
        $conta = 0;
        $campos[$conta]['nome']='ORGANIZAÇÃO';
        $campos[$conta]['campo']='organizacao';
        $campos[$conta]['width']='20%';
        
        $conta++;
        $campos[$conta]['nome']='NÚMERO';
        $campos[$conta]['campo']='numero';
        $campos[$conta]['width']='20%';
        
        $conta++;
        $campos[$conta]['nome']='TIPO';
        $campos[$conta]['campo']='tipo';
        $campos[$conta]['width']='20%';
        
        $conta++;
        $campos[$conta]['nome']='DATA';
        $campos[$conta]['campo']='data';
        $campos[$conta]['width']='20%';
        
        $conta++;
        $campos[$conta]['nome']='ÓRGÃO';
        $campos[$conta]['campo']='orgao';
        $campos[$conta]['width']='20%';
        
        /*
        foreach($esquema as $indice=>$vetor){
           $campos[$conta]=$indice;
           $conta++;
        }
        */
        
        $titulo = 'Dados de Inspecao';
        $tabela = 'Inspecao';
        $nome = 'relatorio_inspecao';

        $this->set(compact('titulo','tabela','conteudo','campos','nome'));
            
            $this->render();
        }
        
        function externoautoComplete01() {
                //Partial strings will come from the autocomplete field as
                $campo=$this->data['campo01']; 
                $this->set('campo',$campo);
                $valor=$this->data['buscaajax']['valor01']; 
                $filtro= str_replace('++++',$valor, $this->data['filtro01']);
                $this->set('inspecaos', $this->Inspecao->find('all', array(
                                        'conditions' => array(
                                                'Inspecao.'.$campo.$filtro 
                                        ),
                                        'fields' => 'Inspecao.'.$campo,
                                        'group'=> 'Inspecao.'.$campo
                )));
                $this->layout = 'ajax_embutido';
        }        
        function externoautoComplete02() {
                //Partial strings will come from the autocomplete field as
                $campo=$this->data['campo02']; 
                $this->set('campo',$campo);
                $valor=$this->data['buscaajax']['valor02']; 
                $filtro= str_replace('++++',$valor, $this->data['filtro02']);
                $this->set('inspecaos', $this->Inspecao->find('all', array(
                                        'conditions' => array(
                                                'Inspecao.'.$campo.$filtro 
                                        ),
                                        'fields' => 'Inspecao.'.$campo,
                                        'group'=> 'Inspecao.'.$campo
                )));
                $this->layout = 'ajax_embutido';
        }        

	
}
?>
