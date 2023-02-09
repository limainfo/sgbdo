<?php
class AditivosController extends AppController {

	var $name = 'Aditivos';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');
        
function externoxml($id) {

    $this->layout = null;
	
    if ($id==4) {
 


               $tratamento =array( 'fields'=>array('Aditivosplanosetor.setor, sum(Aditivosplanosetor.qtd) , year(Aditivosplanosetor.data), month(Aditivosplanosetor.data) '),  'group'=>array('year(Aditivosplanosetor.data), month(Aditivosplanosetor.data), Aditivosplanosetor.setor'), 'order'=>array('Aditivosplanosetor.data asc, Aditivosplanosetor.setor asc'));
               $dadosplanilha= $this->Aditivo->Aditivosplanosetor->find('all', $tratamento);
               echo '<pre>';
               //print_r($dadosplanilha);
               echo '</pre>';
               foreach($dadosplanilha as $categoria){
                    $categorias[$categoria[0]['year(Aditivosplanosetor.data)'].'/'.$categoria[0]['month(Aditivosplanosetor.data)']] = $categoria[0]['month(Aditivosplanosetor.data)'].'/'.$categoria[0]['year(Aditivosplanosetor.data)'];
                    $series[$categoria['Aditivosplanosetor']['setor']][$categoria[0]['year(Aditivosplanosetor.data)'].'/'.$categoria[0]['month(Aditivosplanosetor.data)']] = $categoria[0]["sum(`Aditivosplanosetor`.`qtd`)"]; 
               }
               $categoria =array_unique($categoria);
               $grafico = $this->webroot.'js/FCF_StackedBar2D.swf';
               $xmlcategories = '<categories>';
               foreach($categorias as $chave=>$rotulo){
                  $xmlcategories .= '<category name=\''.$rotulo.'\'/></category>';
               }
               $xmlcategories .= '</categories>';
               $xmlseries = '';
               foreach($series as $setor=>$dados){
                     $xmlseries .= '<dataset seriesName=\''.$setor.'\' color=\'AFD8F8\' showValues=\'0\'>';
                     foreach($dados as $chave=>$qtd){
                      $xmlseries .= '<set value=\''.$qtd.'\'/></set>';
                     }
                     $xmlseries .= '</dataset>';
                  }
                 
                  $xmlseries .= '</graph>';

            
$xmlChart =<<<XML
<graph xAxisName='Products' yAxisName='Quantidade' caption='Planos por Setor' subCaption=''  decimalPrecision='0' numDivLines='12' numberPrefix='' showValues='0'>
$xmlcategories
$xmlseries        
XML;

            echo $xmlChart;
            exit();

           //$this->set(compact('grafico','xmlChart'));
            
 }
		
}        

function index() {

	
   
		
        $postos=$this->Aditivo->Posto->find('list',array('order'=>'Posto.antiguidade asc'));
        $consultaespecialidade='select Especialidade.id, Quadro.sigla_quadro, Especialidade.nm_especialidade from especialidades Especialidade inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id) order by Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc ';
        $dadosconsulta=$this->Aditivo->query($consultaespecialidade);
        foreach($dadosconsulta as $espec){
           $especialidades[$espec['Especialidade']['id']] = $espec['Quadro']['sigla_quadro'].' - '.$espec['Especialidade']['nm_especialidade'];
        }
     //   $especialidades=$this->Aditivo->Especialidade->query('list');

        $unidades=$this->Aditivo->Unidade->find('list');
        $unidades[0]='Selecione';
        $atividades=$this->Aditivo->Atividadelicenca->find('list');
		$atividades[0]='Selecione';
		$empresas=$this->Aditivo->Empresa->find('list');
		$empresas[0]='Selecione';
		$membrosconselhos=$this->Aditivo->Membrosconselho->find('list');
		$membrosconselhos[0]='Selecione';
		$cargosconselhos=$this->Aditivo->Cargosconselho->find('list');
		$cargosconselhos[0]='Selecione';
		$instituicaoensinos=$this->Aditivo->Instituicaoensino->find('list');
		$instituicaoensinos[0]='Selecione';
		$motivosuspensaos=$this->Aditivo->Motivosuspensao->find('list');
		$motivosuspensaos[0]='Selecione';
		$qualificacaos=$this->Aditivo->Qualificacao->find('list');
		$qualificacaos[0]='Selecione';
		$boletiminternos=$this->Aditivo->Boletiminterno->find('list');
		$boletiminternos[0]='Selecione';
		$atas=$this->Aditivo->Ata->find('list');
		$atas[0]='Selecione';
		//$setors=$this->Aditivo->Setor->find('list');
		
		$sql = "select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id, Unidade.id
		FROM setors as Setor
		inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
		where trim(Setor.sigla_setor) not like 'NA' and trim(Setor.sigla_setor) not like 'R.%' and trim(Setor.sigla_setor) not like '%EST%'
		order by  Unidade.id asc ";
		$setor = $this->Aditivo->query($sql);
		$conta = 0;

		$siglas_setores[0] = 'Selecione';
		foreach($setor as $conteudo){
			$organizacaos[$conteudo['Unidade']['id']][$conta]=$conteudo['Setor']['id'].'||'.$conteudo['Setor']['sigla_setor'];
			$conta++;
			if(!in_array($conteudo['Setor']['sigla_setor'],$siglas_setores)){
				$siglas_setores[$conteudo['Setor']['sigla_setor']]=$conteudo['Setor']['sigla_setor'];
			}
		}
				
		$this->set(compact('postos','especialidades','atividades','unidades','empresas','cargosconselhos','membrosconselhos','instituicaoensinos','motivosuspensaos','qualificacaos','boletiminternos','atas','organizacaos','siglas_setores'));
	}
		function edit() {
		
		$unidades=$this->Aditivo->Unidade->find('list');
		$atividades=$this->Aditivo->Atividadelicenca->find('list');
		$empresas=$this->Aditivo->Empresa->find('list');
		$cargosconselhos=$this->Aditivo->Cargosconselho->find('list');
		$instituicaoensinos=$this->Aditivo->Instituicaoensino->find('list');
		$motivosuspensaos=$this->Aditivo->Motivosuspensao->find('list');
		$qualificacaos=$this->Aditivo->Qualificacao->find('list');
		$boletiminternos=$this->Aditivo->Boletiminterno->find('list');
		$atas=$this->Aditivo->Ata->find('list');
		//$setors=$this->Aditivo->Setor->find('list');
		
		$sql = "select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id, Unidade.id
		FROM setors as Setor
		inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
		where trim(Setor.sigla_setor) not like 'NA' and trim(Setor.sigla_setor) not like 'R.%' and trim(Setor.sigla_setor) not like '%EST%'
		order by  Unidade.id asc ";
		$setor = $this->Aditivo->query($sql);
		$conta = 0;

		foreach($setor as $conteudo){
			$organizacaos[$conteudo['Unidade']['id']][$conta]=$conteudo['Setor']['id'].'||'.$conteudo['Setor']['sigla_setor'];
			$conta++;
		}
				
		$this->set(compact('atividades','unidades','empresas','cargosconselhos','instituicaoensinos','motivosuspensaos','qualificacaos','boletiminternos','atas','organizacaos'));
		
	}
	

	function externodownload() {
            
	}
	
	function add() {
            
	}
	
	function externoatualiza($atualizacao=null) {
		$u=$this->Session->read('Usuario');
                echo date('d-m-Y h:i:s');
                
		$this->layout = null;
		
		if(($this->data['Aditivo']['orgao']=='sigpes')||($atualizacao=='sigpes')){
			$tabela[0]['tabela']='SIGPES';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';
			$tabela[1]['fim']='';
			$tabela[1]['status']='';
			
                        
                        
			$conectasigpes=$conn = pg_connect("host=10.32.63.32 port=5432 dbname=sigpes_interface user=ascom password=ascom01");
			if (!$conectasigpes) {
			    die('Não conectou ao servidor do sigpes.DECEA. ');
			}

			
			$efetivosgbdo=$this->Aditivo->query("select *, left(trim(Militar.saram),7) as nrsaram from militars Militar inner join postos Posto on (Posto.id=Militar.posto_id) left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id) left join quadros Quadro on (Quadro.id=Especialidade.quadro_id) where trim(nrsaram)=''   order by Militar.nm_completo asc ");
		//	print_r($efetivosgbdo);
                        /*
			foreach($efetivosgbdo as $efetivo){
                                    echo "{$efetivo['Militar']['saram']} - {$efetivo['Militar']['nm_completo']}<br>";
                        }                        
                                    exit();
                         * 
                         */
                        //print_r($efetivosgbdo);exit();
			foreach($efetivosgbdo as $efetivo){
				//$consultasigpes = pg_query($conectasigpes, "select * from public.militares inner join public.organizacoes on (public.militares.cd_org=public.organizacoes.cd_org) where nr_ordem='{$efetivo['Militar']['saram']}' and nr_cpf='{$efetivo['Militar']['cpf']}' ");
				$consultasigpes = pg_query($conectasigpes, "select * from public.militares inner join public.organizacoes on (public.militares.cd_org=public.organizacoes.cd_org) where nm_pessoa like '%{$efetivo['Militar']['nm_completo']}%' ");
                                 echo "<br><b>{$efetivo['Militar']['saram']}</b> - {$efetivo['Militar']['nm_completo']} - <u>VERIFICADO</u><br>";

				if (!$consultasigpes) {
					//die('Não foi possível obter os dados da tabela militares ');
                                        echo "<b>{$efetivo['Militar']['saram']}</b> - {$efetivo['Militar']['nm_completo']} - <u>APRESENTOU PROBLEMAS</u><br>";
					break;
				}
				$registrosigpes = pg_fetch_array($consultasigpes, 0, PGSQL_ASSOC);

				$om = $registrosigpes['cd_org_svc'];
                                
                                if(!empty($om)){
                                    $consultasigpes = pg_query($conectasigpes, "select * from public.militares inner join public.organizacoes on (public.militares.cd_org_svc=public.organizacoes.cd_org) where trim(nm_pessoa)=trim('{$efetivo['Militar']['nm_completo']}')  ");
                                    if (!$consultasigpes) {
                                            echo "<b>{$efetivo['Militar']['saram']}</b> - {$efetivo['Militar']['nm_completo']} - <u>APRESENTOU PROBLEMAS</u><br>";
                                            //die('Não foi possível obter os dados da tabela militares ');
                                            break;
                                    }
                                    $registrosigpes = pg_fetch_array($consultasigpes, 0, PGSQL_ASSOC);
                                }
                                
 				$cpfsigpes = $registrosigpes['nr_cpf'];
                                
                                if(strpos($registrosigpes['perfis_type'],'ATIVO')!==false){
					$tmp = $registrosigpes['sg_posto'];
					$registrosigpes['sg_posto'] = $tmp.'R';
				}
                    
                                
				$postos = $this->Aditivo->query("select * from postos where sigla_compativel='{$registrosigpes['sg_posto']}' ");
				$postoid=$postos[0]['postos']['id'];
                                

				
				$quadros = $this->Aditivo->query("select * from quadros where sigla_quadro='{$registrosigpes['sg_qdr']}' ");
				$quadroid=$quadros[0]['quadros']['id'];
				
				$especialidades = $this->Aditivo->query("select * from especialidades where nm_especialidade='{$registrosigpes['sg_espd']}' and  quadro_id='{$quadroid}' ");
				$especialidadeid=$especialidades[0]['especialidades']['id'];
				
				$unidades = $this->Aditivo->query("select * from unidades where sigla_unidade=trim(replace('{$registrosigpes['sg_org']}','-','')) ");
				$unidadeid=$unidades[0]['unidades']['id'];
                                
                                if(strlen($unidadeid)<5){
                                    $this->Aditivo->query("insert into unidades (cidade_id, nm_unidade, sigla_unidade) values (1,'{$registrosigpes['nm_org']}', replace('{$registrosigpes['sg_org']}','-','')) ");
                                    $unidades = $this->Aditivo->query("select * from unidades where sigla_unidade=trim(replace('{$registrosigpes['sg_org']}','-','')) ");
                                    $unidadeid=$unidades[0]['unidades']['id'];
                                    
                                }
				
				$unidadesantes = $this->Aditivo->query("select * from unidades where id='{$efetivo['Militar']['unidade_id']}' ");
				$unidadesgantes=$unidades[0]['unidades']['sigla_unidade'];
				$unidadeidantes=$unidades[0]['unidades']['id'];
                                
                                
                                if(strlen($registrosigpes['nr_cpf'])>4){
                                    $this->Aditivo->query("update militars set cpf='{$registrosigpes['nr_cpf']}', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}' where id='{$efetivo['Militar']['id']}'");
                                    echo "<br>{$registrosigpes['nm_pessoa']} - update militars set cpf='{$cpfsigpes}', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}' where id='{$efetivo['Militar']['id']}'";
                                }
				//print_r($registrosigpes);exit();
				
				//$this->Aditivo->query(" update militars set militars set posto_id='$postoid', especialidade_id='$especialidadeid' where id='{$efetivo['Militar']['id']}' ");
				
				if(strlen($postoid)>5 && strlen($especialidadeid)>5){
					if(strlen($registrosigpes['nm_guerra'])>3){
						//echo "<br><b>{$efetivo['Militar']['nm_completo']} </b> Unidade Antes:<b>{$unidadesgantes}-{$unidadeidantes}</b>  Depois:<b>{$registrosigpes['sg_org']}-$unidadeid</b>  nm_guerra='{$registrosigpes['nm_guerra']}' ";
                                        if(empty($postoid)){
					$this->Aditivo->query("update militars set cpf='$cpfsigpes',especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', nm_guerra='{$registrosigpes['nm_guerra']}',  saram='{$registrosigpes['nr_ordem']}' where id='{$efetivo['Militar']['id']}'");
                                            
                                        }else{
					$this->Aditivo->query("update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', nm_guerra='{$registrosigpes['nm_guerra']}', saram='{$registrosigpes['nr_ordem']}' where id='{$efetivo['Militar']['id']}'");
                                            
                                        }
                                //                echo "update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', nm_guerra='{$registrosigpes['nm_guerra']}' where id='{$efetivo['Militar']['id']}'";
					}else{
						//echo "<br><b>{$efetivo['Militar']['nm_completo']} </b> Unidade Antes:<b>{$unidadesgantes}-{$unidadeidantes}</b>  Depois:<b>{$registrosigpes['sg_org']}-$unidadeid</b>  nm_guerra não alterado ";
                                       if(empty($postoid)){
                                                $this->Aditivo->query("update militars set cpf='$cpfsigpes', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', saram='{$registrosigpes['nr_ordem']}', nm_guerra='{$registrosigpes['nm_guerra']}' where id='{$efetivo['Militar']['id']}'");
                                           
                                       }else{
                                                $this->Aditivo->query("update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', nm_guerra='{$registrosigpes['nm_guerra']}' where id='{$efetivo['Militar']['id']}'");
                                           
                                       }

                                  //              echo "update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid' where id='{$efetivo['Militar']['id']}'";
					}
				
				}
                                
				
			}
                        
                        
                        
			
			
			$efetivosgbdo=$this->Aditivo->query("select *, left(trim(Militar.saram),7) as nrsaram from militars Militar inner join postos Posto on (Posto.id=Militar.posto_id) left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id) left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)   order by Militar.nm_completo asc ");
		//	print_r($efetivosgbdo);
                        /*
			foreach($efetivosgbdo as $efetivo){
                                    echo "{$efetivo['Militar']['saram']} - {$efetivo['Militar']['nm_completo']}<br>";
                        }                        
                                    exit();
                         * 
                         */
                        //print_r($efetivosgbdo);exit();
			foreach($efetivosgbdo as $efetivo){
				//$consultasigpes = pg_query($conectasigpes, "select * from public.militares inner join public.organizacoes on (public.militares.cd_org=public.organizacoes.cd_org) where nr_ordem='{$efetivo['Militar']['saram']}' and nr_cpf='{$efetivo['Militar']['cpf']}' ");
				$consultasigpes = pg_query($conectasigpes, "select * from public.militares inner join public.organizacoes on (public.militares.cd_org=public.organizacoes.cd_org) where nr_ordem like '%{$efetivo[0]['nrsaram']}%' ");
                                 echo "<br><b>{$efetivo['Militar']['saram']}</b> - {$efetivo['Militar']['nm_completo']} - <u>VERIFICADO</u><br>";

				if (!$consultasigpes) {
					//die('Não foi possível obter os dados da tabela militares ');
                                        echo "<b>{$efetivo['Militar']['saram']}</b> - {$efetivo['Militar']['nm_completo']} - <u>APRESENTOU PROBLEMAS</u><br>";
					break;
				}
				$registrosigpes = pg_fetch_array($consultasigpes, 0, PGSQL_ASSOC);

				$om = $registrosigpes['cd_org_svc'];
                                
                                if(!empty($om)){
                                    $consultasigpes = pg_query($conectasigpes, "select * from public.militares inner join public.organizacoes on (public.militares.cd_org_svc=public.organizacoes.cd_org) where trim(nr_ordem)=trim('{$efetivo['Militar']['saram']}')  ");
                                    if (!$consultasigpes) {
                                            echo "<b>{$efetivo['Militar']['saram']}</b> - {$efetivo['Militar']['nm_completo']} - <u>APRESENTOU PROBLEMAS</u><br>";
                                            //die('Não foi possível obter os dados da tabela militares ');
                                            break;
                                    }
                                    $registrosigpes = pg_fetch_array($consultasigpes, 0, PGSQL_ASSOC);
                                }
                                
 				$cpfsigpes = $registrosigpes['nr_cpf'];
                                
                                if(strpos($registrosigpes['perfis_type'],'ATIVO')!==false){
					$tmp = $registrosigpes['sg_posto'];
					$registrosigpes['sg_posto'] = $tmp.'R';
				}
                    
                                
				$postos = $this->Aditivo->query("select * from postos where sigla_compativel='{$registrosigpes['sg_posto']}' ");
				$postoid=$postos[0]['postos']['id'];
                                

				
				$quadros = $this->Aditivo->query("select * from quadros where sigla_quadro='{$registrosigpes['sg_qdr']}' ");
				$quadroid=$quadros[0]['quadros']['id'];
				
				$especialidades = $this->Aditivo->query("select * from especialidades where nm_especialidade='{$registrosigpes['sg_espd']}' and  quadro_id='{$quadroid}' ");
				$especialidadeid=$especialidades[0]['especialidades']['id'];
				
				$unidades = $this->Aditivo->query("select * from unidades where sigla_unidade=trim(replace('{$registrosigpes['sg_org']}','-','')) ");
				$unidadeid=$unidades[0]['unidades']['id'];
                                
                                if(strlen($unidadeid)<5){
                                    $this->Aditivo->query("insert into unidades (cidade_id, nm_unidade, sigla_unidade) values (1,'{$registrosigpes['nm_org']}', replace('{$registrosigpes['sg_org']}','-','')) ");
                                    $unidades = $this->Aditivo->query("select * from unidades where sigla_unidade=trim(replace('{$registrosigpes['sg_org']}','-','')) ");
                                    $unidadeid=$unidades[0]['unidades']['id'];
                                    
                                }
				
				$unidadesantes = $this->Aditivo->query("select * from unidades where id='{$efetivo['Militar']['unidade_id']}' ");
				$unidadesgantes=$unidades[0]['unidades']['sigla_unidade'];
				$unidadeidantes=$unidades[0]['unidades']['id'];
                                
                                
                                if(strlen($registrosigpes['nr_cpf'])>4){
                                    $this->Aditivo->query("update militars set cpf='{$registrosigpes['nr_cpf']}', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}' where id='{$efetivo['Militar']['id']}'");
                                    echo "<br>{$registrosigpes['nm_pessoa']} - update militars set cpf='{$cpfsigpes}', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}' where id='{$efetivo['Militar']['id']}'";
                                }
				//print_r($registrosigpes);exit();
				
				//$this->Aditivo->query(" update militars set militars set posto_id='$postoid', especialidade_id='$especialidadeid' where id='{$efetivo['Militar']['id']}' ");
				
				if(strlen($postoid)>5 && strlen($especialidadeid)>5){
					if(strlen($registrosigpes['nm_guerra'])>3){
						//echo "<br><b>{$efetivo['Militar']['nm_completo']} </b> Unidade Antes:<b>{$unidadesgantes}-{$unidadeidantes}</b>  Depois:<b>{$registrosigpes['sg_org']}-$unidadeid</b>  nm_guerra='{$registrosigpes['nm_guerra']}' ";
                                        if(empty($postoid)){
					$this->Aditivo->query("update militars set cpf='$cpfsigpes',especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', nm_guerra='{$registrosigpes['nm_guerra']}' where id='{$efetivo['Militar']['id']}'");
                                            
                                        }else{
					$this->Aditivo->query("update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', nm_guerra='{$registrosigpes['nm_guerra']}' where id='{$efetivo['Militar']['id']}'");
                                            
                                        }
                                //                echo "update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid', nm_guerra='{$registrosigpes['nm_guerra']}' where id='{$efetivo['Militar']['id']}'";
					}else{
						//echo "<br><b>{$efetivo['Militar']['nm_completo']} </b> Unidade Antes:<b>{$unidadesgantes}-{$unidadeidantes}</b>  Depois:<b>{$registrosigpes['sg_org']}-$unidadeid</b>  nm_guerra não alterado ";
                                       if(empty($postoid)){
                                                $this->Aditivo->query("update militars set cpf='$cpfsigpes', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid' where id='{$efetivo['Militar']['id']}'");
                                           
                                       }else{
                                                $this->Aditivo->query("update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid' where id='{$efetivo['Militar']['id']}'");
                                           
                                       }

                                  //              echo "update militars set cpf='$cpfsigpes',posto_id='$postoid', especialidade_id='$especialidadeid', dt_nascimento='{$registrosigpes['dt_nasc']}', dt_admissao='{$registrosigpes['dt_praca']}', dt_apresentacao='{$registrosigpes['dt_apres_atual']}', unidade_id='$unidadeid' where id='{$efetivo['Militar']['id']}'";
					}
				
				}
                                
				
			}
			$tabela[0]['status'] = '<ul>';
				
			
				
			
			$contaTabelaInicio = count($registrosigpes);
			$contaTbInicio = $contaTabelaInicio;
			
//#    BAMN,      BAPV,     CINDACTA IV,  DSM-MN, DSTAEEI,  DSTAEUA, DSTAEVH, DTCEA-AA,  DTCEA-BE, DTCEA-BV, DTCEA-CC, DTCEA-CY, DTCEA-CZ, DTCEA-EG, DTCEA-EI, DTCEA-EK, DTCEA-EP, DTCEA-FA, DTCEA-FX, DTCEA-GM, DTCEA-IZ, DTCEA-MN, DTCEA-MQ, DTCEA-MY, DTCEA-OI, DTCEA-PV, DTCEA-RB, DTCEA-SI, DTCEA-SL, DTCEA-SN, DTCEA-TF, DTCEA-TS, DTCEA-TT, DTCEA-UA, DTCEA-VH, SRPV MN
//#('110401', '172304',             '370401',  '370408',   '170405',    '170406',  '172306',     '311514',     '311510',   ' 312401',    '311504',    '341202',     '370406',    '370403',   '370410',    '311506',    '341211',     '341209',    '311516',    '312302',    '311101',      '310404',    '311518',     '310405',   '000346',     '312301',    '310102',    '361302',   '321101',     '311515',    '370407',    '000303',   '370402',     '000726',    '372401',   '000029')
			

			//select * from militares where cd_org_svc in ('110401', '172304',             '370401',  '370408',   '170405',    '170406',  '172306',     '311514',     '311510',   ' 312401',    '311504',    '341202',     '370406',    '370403',   '370410',    '311506',    '341211',     '341209',    '311516',    '312302',    '311101',      '310404',    '311518',     '310405',   '000346',     '312301',    '310102',    '361302',   '321101',     '311515',    '370407',    '000303',   '370402',     '000726',    '372401',   '000029')
                        
                        
			
			$contaTabelaFim=$this->Aditivo->query('select count(*) total from militares;');
			$contaTbFim= $contaTabelaFim[0][0]['total'];
			
			$tabela[0]['status']='No SGBDO:'.$contaTbFim.' - No SIGPES:'.$contaTbInicio.' registros.';
			
			if($contaTbFim<$contaTbInicio){
				
				$registroatualizados = 0;
										
				
				$tabela[0]['status']= $tabela[0]['status'].' '.$registroatualizados.' registros atualizados';
				
			}
			
			$tabela[0]['fim']=date('Y-m-d h:i:s');
				
				
			
                                
				
                     
                        
		}		
		
/////---------------------LPNA
		if(($this->data['Aditivo']['orgao']=='LPNA')||($atualizacao=='LPNA')){
			$tabela[0]['tabela']='LPNA';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';
			$tabela[1]['fim']='';
			$tabela[1]['status']='';

			$conectasgbdo=mysql_pconnect('10.112.30.28','sgbdo','sgbdo');
			if (!$conectasgbdo) {
				die('Not connected SGBDO : ' . mysql_error());
			}
			$selecionasgbdo = mysql_select_db('SGBDO', $conectasgbdo);
			if (!$selecionasgbdo) {
				die ('Can\'t use avaliacao : ' . mysql_error());
			}
			$consultasgbdo = mysql_query('select * from militars ',$conectasgbdo);
			
			$contaTabelaInicio = mysql_fetch_array($consultasgbdo);
			
			$contaTbInicio = 0;
				
			$contaTabelaFim=0;
			$contaTbFim= count($contaTabelaInicio);
				
			$tabela[0]['status']='No SGBDO:'.$contaTbFim.' registros.';
			$registroatualizados = 0;
		
			$port = '80';
			$path = '/sdop/index.cfm';
			$host = 'servicos.decea.intraer';
			$type = 'http'; 
			$post = "_method=POST$postado";
			
			$conectalpna=mysql_pconnect('10.228.12.140','UsuSGPO','12345678');
			if (!$conectalpna) {
				die('Not connected LPNA : ' . mysql_error());
			}
			$selecionalpna = mysql_select_db('lpna', $conectalpna);
			if (!$selecionalpna) {
				die ('Can\'t use avaliacao : ' . mysql_error());
			}
			mysql_query('set names "utf8"');
			
				
			while ($d = mysql_fetch_array($consultasgbdo, MYSQL_BOTH)) {
				/*
				
				$_err = 'lib sockets::'.__FUNCTION__.'(): ';
				switch($type) { case 'http': $type = ''; case 'ssl': continue; default: die($_err.'bad $type'); } if(!ctype_digit($port)) die($_err.'bad port');
				$fp = fsockopen($host,$port,$errno,$errstr,$timeout=30);
				if(!$fp) die($_err.$errstr.$errno); else {
					fputs($fp, "POST $path HTTP/1.1\r\n"."Host: $host\r\n"."Content-type: application/x-www-form-urlencoded\r\n"."Content-length: ".strlen($data)."\r\n"."Connection: close\r\n\r\n".$data."\r\n\r\n");
					$controla = 0;
					while(!feof($fp)){
						$resposta = fgets($fp,16384);
						if($controla){
							$d .= $resposta;
						}
						if(strpos($resposta,'<start>')!==false){
							$controla=1;
						}
					}
					fclose($fp);
				}
				
				
				$this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.identidade=militars.identidade, nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.identidade=militars.identidade ');
				if($this->Aditivo->query($insereforcado)){
					$registroatualizados++;
				}
				
				
			}
				$tabela[0]['status']= $tabela[0]['status'].' '.$registroatualizados.' registros atualizados';
		
			
				
			$tabela[0]['fim']=date('Y-m-d h:i:s');
	*/
				$consultalpna = mysql_query("select * from cadastros where IDENT='{$d['identidade']}' or CPF='{$d['cpf']}' ",$conectalpna);
				if (!$conectalpna) {
					die('Invalid query: ' . mysql_error());
				}
				$saida ="";
				//$contaTabelaInicio = mysql_fetch_array($consultalpna);
				while ($l = mysql_fetch_array($consultalpna, MYSQL_BOTH)) {
					mysql_query("update SGBDO.militars set indicativo='{$l['id_operacional']}', nr_licenca='{$l['licenca']}', cpf='{$l['CPF']}', eplis_nota={$l['eplis_nota']}, eplis_ano={$l['eplis_ano']} where identidade='{$d['identidade']}'   ",$conectasgbdo);
					$saida .= "{$d['nm_completo']} - IND.:{$l['id_operacional']} EPLIS:{$l['eplis_nota']}-{$l['eplis_ano']} - CPF.:{$l['CPF']} <br>";
				}
				//$saida .= "<hr><br>";
				echo $saida;
			}
		
			 
		
		}		
		
		
		
		
		if(($this->data['Aditivo']['orgao']=='LPNAllllll')||($atualizacao=='LPNA,,,,')){
			$tabela[0]['tabela']='EplisFase1';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';
			$tabela[1]['fim']='';
			$tabela[1]['status']='';
				
		
		
			$conectaicea=mysql_pconnect('10.132.8.37','decea','t2l2decea');
			if (!$conectaicea) {
				die('Not connected : ' . mysql_error());
			}
			$selecionaicea = mysql_select_db('avaliacao', $conectaicea);
			if (!$selecionaicea) {
				die ('Can\'t use avaliacao : ' . mysql_error());
			}
		
			mysql_query('set names "utf8"');
			$consultaicea = mysql_query('select count(*) total from EplisFase1;');
			if (!$consultaicea) {
				die('Invalid query: ' . mysql_error());
			}
			$contaTabelaInicio = mysql_fetch_array($consultaicea);
			$contaTbInicio = $contaTabelaInicio['total'];
		
		
		
				
			$contaTabelaFim=$this->Aditivo->query('select count(*) total from nivel_ingles_fase01s;');
			$contaTbFim= $contaTabelaFim[0][0]['total'];
				
			$tabela[0]['status']='No SGBDO:'.$contaTbFim.' - No ICEA:'.$contaTbInicio.' registros.';
				
			if($contaTbFim<$contaTbInicio){
		
				$consultaicea = mysql_query('select * from EplisFase1 ');
				if (!$consultaicea) {
					die('Invalid query: ' . mysql_error());
				}
				$registroatualizados = 0;
		
				while ($d = mysql_fetch_array($consultaicea, MYSQL_BOTH)) {
					//				  $insereforcado = 'insert ignore into EplisFase1 (rg, cpf, posto, quadro, especialidade, nome, acertos, erros, nota, local_trab, regional, profissao, operacional, data,ip, mac, usuario, maquina, anoref) values("'.$d[0].'","'.$d[1].'","'.$d[2].'","'.$d[3].'","'.$d[4].'","'.$d[5].'",'.$d[6].','.$d[7].','.$d[8].',"'.$d[9].'","'.$d[10].'","'.$d[11].'","'.$d[12].'","'.$d[13].'","'.$d[14].'","'.$d[15].'","'.$d[16].'","'.$d[17].'","'.$d[18].'")';
					$insereforcado = 'insert ignore into nivel_ingles_fase01s (identidade, cpf, acertos, erros, nota, local_trabalho, regional, operacional, dt_realizacao, ano) values("'.$d[0].'",replace(replace("'.$d[1].'",".",""),"-",""),'.$d[6].','.$d[7].','.$d[8].',"'.$d[9].'","'.$d[10].'","'.$d[12].'","'.$d[13].'","'.$d[18].'")';
					if($this->Aditivo->query($insereforcado)){
						$registroatualizados++;
					}
				}
				$this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.identidade=militars.identidade, nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.identidade=militars.identidade ');
				$this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.militar_rg=militars.identidade, nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") ');
		
				//$this->Aditivo->query('insert ignore into nivel_ingles_fase01s (militar_id, ano, dt_realizacao, local_trabalho, regional, acertos, erros, nota, identidade, operacional) select militar_id, anoref, data, local_trab, regional, acertos, erros, nota, militar_rg, operacional from EplisFase1');
				//echo $insereforcado;
				$tabela[0]['status']= $tabela[0]['status'].' '.$registroatualizados.' registros atualizados';
		
			}
				
			$tabela[0]['fim']=date('Y-m-d h:i:s');
		
		
			$tabela[1]['tabela']='EplisFase2';
			$tabela[1]['inicio']=date('Y-m-d h:i:s');
			$tabela[1]['fim']='';
			$tabela[1]['status']='';
				
			$consultaicea = mysql_query('select count(*) total from EplisFase2 ');
			if (!$consultaicea) {
				die('Invalid query: ' . mysql_error());
			}
			$contaTabelaInicio = mysql_fetch_array($consultaicea);
			$contaTbInicio = $contaTabelaInicio['total'];
				
			$contaTabelaFim=$this->Aditivo->query('select count(*) total from nivel_ingles_fase02s');
			$contaTbFim= $contaTabelaFim[0][0]['total'];
				
			$tabela[1]['status']='No SGBDO:'.$contaTbFim.' - No ICEA:'.$contaTbInicio.' registros.';
				
			if($contaTbFim<$contaTbInicio){
		
				$consultaicea = mysql_query('select * from EplisFase2 ');
				if (!$consultaicea) {
					die('Invalid query: ' . mysql_error());
				}
				$registroatualizados = 0;
		
				while ($d = mysql_fetch_array($consultaicea, MYSQL_BOTH)) {
					//				  $insereforcado = 'insert ignore into EplisFase2 (rg, cpf, posto, quadro, especialidade, nome, profissao, regional, local, regional_exame, data_exame, interlocutor, avaliador, setUtil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, operacional, obs, anoref) values 							("'.$d[0].'","'.$d[1].'","'.$d[2].'","'.$d[3].'","'.$d[4].'","'.$d[5].'","'.$d[6].'","'.$d[7].'","'.$d[8].'","'.$d[9].'","'.$d[10].'","'.$d[11].'","'.$d[12].'",'.$d[13].','.$d[14].','.$d[15].','.$d[16].','.$d[17].','.$d[18].','.$d[19].','.$d[20].',"'.$d[21].'","'.$d[22].'","'.$d[23].'")';
					$insereforcado = 'insert ignore into nivel_ingles_fase02s (identidade, cpf, regional, local_trabalho, regional_exame, dt_realizacao,identidade_interlocutor, identidade_avaliador, setutil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, operacional, obs, ano) values ("'.$d[0].'",replace(replace("'.$d[1].'",".",""),"-",""),"'.$d[7].'","'.$d[8].'","'.$d[9].'","'.$d[10].'","'.$d[11].'","'.$d[12].'",'.$d[13].','.$d[14].','.$d[15].','.$d[16].','.$d[17].','.$d[18].','.$d[19].','.$d[20].',"'.$d[21].'","'.$d[22].'","'.$d[23].'")';
					//echo $insereforcado;exit();
		
					if($this->Aditivo->query($insereforcado)){
						$registroatualizados++;
					}
				}
				$this->Aditivo->query('update nivel_ingles_fase02s, militars set nivel_ingles_fase02s.militar_id=militars.id, nivel_ingles_fase02s.cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase02s.identidade=militars.identidade ');
				$this->Aditivo->query('update nivel_ingles_fase02s, militars set nivel_ingles_fase02s.militar_id=militars.id, nivel_ingles_fase02s.militar_cpf=militars.cpf_limpo where nivel_ingles_fase02s.cpf=replace(replace(militars.cpf,".",""),"-","") ');
		
				// $this->Aditivo->query('insert ignore into nivel_ingles_fase02s (militar_id, ano, dt_realizacao, local_trabalho, regional, regional_exame, setutil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, identidade, identidade_interlocutor, identidade_avaliador, obs, operacional) select militar_id, anoref, data_exame, local, regional, regional_exame, setUtil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, rg, interlocutor, avaliador, obs, operacional from nivel_ingles_fase02s where nivel_ingles_fase02s.militar_id is not null');
				$tabela[1]['status']= $tabela[1]['status'].' '.$registroatualizados.' registros atualizados';
					
				 
			}
			 
			/*
		
			$this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.militar_rg=militars.identidade, nivel_ingles_fase01s.militar_cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.rg=militars.identidade ');
			$this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.militar_rg=militars.identidade, nivel_ingles_fase01s.militar_cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") ');
			$this->Aditivo->query('insert ignore into nivel_ingles_fase01s (militar_id, ano, dt_realizacao, local_trabalho, regional, acertos, erros, nota, identidade, operacional) select militar_id, anoref, data, local_trab, regional, acertos, erros, nota, militar_rg, operacional from EplisFase1');
			$tabela[0]['status']= ' registros atualizados';
			$tabela[0]['fim']=date('Y-m-d h:i:s');
				
			$tabela[1]['inicio']=date('Y-m-d h:i:s');
			$this->Aditivo->query('update EplisFase2, militars set EplisFase2.militar_id=militars.id, EplisFase2.militar_cpf=militars.cpf_limpo where EplisFase2.rg=militars.identidade ');
			$this->Aditivo->query('update EplisFase2, militars set EplisFase2.militar_id=militars.id, EplisFase2.militar_cpf=militars.cpf_limpo where EplisFase2.cpf=militars.cpf_limpo ');
			$this->Aditivo->query('insert ignore into nivel_ingles_fase02s (militar_id, ano, dt_realizacao, local_trabalho, regional, regional_exame, setutil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, identidade, identidade_interlocutor, identidade_avaliador, obs, operacional) select militar_id, anoref, data_exame, local, regional, regional_exame, setUtil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, rg, interlocutor, avaliador, obs, operacional from EplisFase2 where EplisFase2.militar_id is not null');
			$tabela[1]['status']= ' registros atualizados';
			*/
		
			$tabela[1]['fim']=date('Y-m-d h:i:s');
		
			 
		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		if(($this->data['Aditivo']['orgao']=='icea')||($atualizacao=='icea')){
			$tabela[0]['tabela']='EplisFase1';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';
			$tabela[1]['fim']='';
			$tabela[1]['status']='';
			
                        
                        
			$conectaicea=mysql_pconnect('10.132.8.37','decea','t2l2decea');
			if (!$conectaicea) {
			    die('Not connected : ' . mysql_error());
			}
			$selecionaicea = mysql_select_db('avaliacao', $conectaicea);
			if (!$selecionaicea) {
			    die ('Can\'t use avaliacao : ' . mysql_error());
			}
                        
			mysql_query('set names "utf8"');
			$consultaicea = mysql_query('select count(*) total from EplisFase1;');
			if (!$consultaicea) {
			    die('Invalid query: ' . mysql_error());
			}
			$contaTabelaInicio = mysql_fetch_array($consultaicea);
			$contaTbInicio = $contaTabelaInicio['total'];

                        
                        
			
			$contaTabelaFim=$this->Aditivo->query('select count(*) total from nivel_ingles_fase01s;');
			$contaTbFim= $contaTabelaFim[0][0]['total'];
			
			$tabela[0]['status']='No SGBDO:'.$contaTbFim.' - No ICEA:'.$contaTbInicio.' registros.';
			
			if($contaTbFim<$contaTbInicio){
				
				$consultaicea = mysql_query('select * from EplisFase1 ');
				if (!$consultaicea) {
				    die('Invalid query: ' . mysql_error());
				}
				$registroatualizados = 0;
										
				while ($d = mysql_fetch_array($consultaicea, MYSQL_BOTH)) {
//				  $insereforcado = 'insert ignore into EplisFase1 (rg, cpf, posto, quadro, especialidade, nome, acertos, erros, nota, local_trab, regional, profissao, operacional, data,ip, mac, usuario, maquina, anoref) values("'.$d[0].'","'.$d[1].'","'.$d[2].'","'.$d[3].'","'.$d[4].'","'.$d[5].'",'.$d[6].','.$d[7].','.$d[8].',"'.$d[9].'","'.$d[10].'","'.$d[11].'","'.$d[12].'","'.$d[13].'","'.$d[14].'","'.$d[15].'","'.$d[16].'","'.$d[17].'","'.$d[18].'")';
				  $insereforcado = 'insert ignore into nivel_ingles_fase01s (identidade, cpf, acertos, erros, nota, local_trabalho, regional, operacional, dt_realizacao, ano) values("'.$d[0].'",replace(replace("'.$d[1].'",".",""),"-",""),'.$d[6].','.$d[7].','.$d[8].',"'.$d[9].'","'.$d[10].'","'.$d[12].'","'.$d[13].'","'.$d[18].'")';
				  if($this->Aditivo->query($insereforcado)){
				  	$registroatualizados++;
				  }
				}
				 $this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.identidade=militars.identidade, nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.identidade=militars.identidade ');
				 $this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.militar_rg=militars.identidade, nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") ');

				 //$this->Aditivo->query('insert ignore into nivel_ingles_fase01s (militar_id, ano, dt_realizacao, local_trabalho, regional, acertos, erros, nota, identidade, operacional) select militar_id, anoref, data, local_trab, regional, acertos, erros, nota, militar_rg, operacional from EplisFase1');
				 //echo $insereforcado;
				$tabela[0]['status']= $tabela[0]['status'].' '.$registroatualizados.' registros atualizados';
				
			}
			
			$tabela[0]['fim']=date('Y-m-d h:i:s');
				
				
			$tabela[1]['tabela']='EplisFase2';
			$tabela[1]['inicio']=date('Y-m-d h:i:s');
			$tabela[1]['fim']='';
			$tabela[1]['status']='';
			
			$consultaicea = mysql_query('select count(*) total from EplisFase2 ');
			if (!$consultaicea) {
			    die('Invalid query: ' . mysql_error());
			}
			$contaTabelaInicio = mysql_fetch_array($consultaicea);
			$contaTbInicio = $contaTabelaInicio['total'];
			
			$contaTabelaFim=$this->Aditivo->query('select count(*) total from nivel_ingles_fase02s');
			$contaTbFim= $contaTabelaFim[0][0]['total'];
			
			$tabela[1]['status']='No SGBDO:'.$contaTbFim.' - No ICEA:'.$contaTbInicio.' registros.';
			
			if($contaTbFim<$contaTbInicio){
				
				$consultaicea = mysql_query('select * from EplisFase2 ');
				if (!$consultaicea) {
				    die('Invalid query: ' . mysql_error());
				}
				$registroatualizados = 0;
										
				while ($d = mysql_fetch_array($consultaicea, MYSQL_BOTH)) {
//				  $insereforcado = 'insert ignore into EplisFase2 (rg, cpf, posto, quadro, especialidade, nome, profissao, regional, local, regional_exame, data_exame, interlocutor, avaliador, setUtil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, operacional, obs, anoref) values 							("'.$d[0].'","'.$d[1].'","'.$d[2].'","'.$d[3].'","'.$d[4].'","'.$d[5].'","'.$d[6].'","'.$d[7].'","'.$d[8].'","'.$d[9].'","'.$d[10].'","'.$d[11].'","'.$d[12].'",'.$d[13].','.$d[14].','.$d[15].','.$d[16].','.$d[17].','.$d[18].','.$d[19].','.$d[20].',"'.$d[21].'","'.$d[22].'","'.$d[23].'")';
				  $insereforcado = 'insert ignore into nivel_ingles_fase02s (identidade, cpf, regional, local_trabalho, regional_exame, dt_realizacao,identidade_interlocutor, identidade_avaliador, setutil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, operacional, obs, ano) values ("'.$d[0].'",replace(replace("'.$d[1].'",".",""),"-",""),"'.$d[7].'","'.$d[8].'","'.$d[9].'","'.$d[10].'","'.$d[11].'","'.$d[12].'",'.$d[13].','.$d[14].','.$d[15].','.$d[16].','.$d[17].','.$d[18].','.$d[19].','.$d[20].',"'.$d[21].'","'.$d[22].'","'.$d[23].'")';
                                  //echo $insereforcado;exit();
                                
				  if($this->Aditivo->query($insereforcado)){
				  	$registroatualizados++;
				  }
				}
				 $this->Aditivo->query('update nivel_ingles_fase02s, militars set nivel_ingles_fase02s.militar_id=militars.id, nivel_ingles_fase02s.cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase02s.identidade=militars.identidade ');
				 $this->Aditivo->query('update nivel_ingles_fase02s, militars set nivel_ingles_fase02s.militar_id=militars.id, nivel_ingles_fase02s.militar_cpf=militars.cpf_limpo where nivel_ingles_fase02s.cpf=replace(replace(militars.cpf,".",""),"-","") ');

				// $this->Aditivo->query('insert ignore into nivel_ingles_fase02s (militar_id, ano, dt_realizacao, local_trabalho, regional, regional_exame, setutil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, identidade, identidade_interlocutor, identidade_avaliador, obs, operacional) select militar_id, anoref, data_exame, local, regional, regional_exame, setUtil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, rg, interlocutor, avaliador, obs, operacional from nivel_ingles_fase02s where nivel_ingles_fase02s.militar_id is not null');
				 $tabela[1]['status']= $tabela[1]['status'].' '.$registroatualizados.' registros atualizados';
			
                      	
			}
                         
                        /*
                        
				 $this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.militar_rg=militars.identidade, nivel_ingles_fase01s.militar_cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.rg=militars.identidade ');
				 $this->Aditivo->query('update nivel_ingles_fase01s, militars set nivel_ingles_fase01s.militar_id=militars.id, nivel_ingles_fase01s.militar_rg=militars.identidade, nivel_ingles_fase01s.militar_cpf=replace(replace(militars.cpf,".",""),"-","") where nivel_ingles_fase01s.cpf=replace(replace(militars.cpf,".",""),"-","") ');
				 $this->Aditivo->query('insert ignore into nivel_ingles_fase01s (militar_id, ano, dt_realizacao, local_trabalho, regional, acertos, erros, nota, identidade, operacional) select militar_id, anoref, data, local_trab, regional, acertos, erros, nota, militar_rg, operacional from EplisFase1');
				$tabela[0]['status']= ' registros atualizados';
				$tabela[0]['fim']=date('Y-m-d h:i:s');
			
                                 $tabela[1]['inicio']=date('Y-m-d h:i:s');
				 $this->Aditivo->query('update EplisFase2, militars set EplisFase2.militar_id=militars.id, EplisFase2.militar_cpf=militars.cpf_limpo where EplisFase2.rg=militars.identidade ');
				 $this->Aditivo->query('update EplisFase2, militars set EplisFase2.militar_id=militars.id, EplisFase2.militar_cpf=militars.cpf_limpo where EplisFase2.cpf=militars.cpf_limpo ');
				 $this->Aditivo->query('insert ignore into nivel_ingles_fase02s (militar_id, ano, dt_realizacao, local_trabalho, regional, regional_exame, setutil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, identidade, identidade_interlocutor, identidade_avaliador, obs, operacional) select militar_id, anoref, data_exame, local, regional, regional_exame, setUtil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, rg, interlocutor, avaliador, obs, operacional from EplisFase2 where EplisFase2.militar_id is not null');
                                $tabela[1]['status']= ' registros atualizados';
                                */
                                
				$tabela[1]['fim']=date('Y-m-d h:i:s');
				
                     
                        
		}
		
                
                
		if(($this->data['Aditivo']['orgao']=='decea')||($atualizacao=='decea')){
//		if($this->data['Aditivo']['orgao']=='decea'){
                    
			$tabela[0]['tabela']='decea';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';

                        
			$conectadecea=mysql_pconnect('10.32.63.29','drhu','drhu');
			if (!$conectadecea) {
			    die('Not connected : ' . mysql_error());
			}
			$selecionadecea = mysql_select_db('drhu', $conectadecea);
			if (!$selecionadecea) {
			    die ('Can\'t use drhu DECEA : ' . mysql_error());
			}
			mysql_query('set names "utf8"');
			$consultadecea = mysql_query('select count(*) total from pefca;');
			if (!$consultadecea) {
			    die('Invalid query: ' . mysql_error());
			}

                        
			$tabela[0]['fim']=date('Y-m-d h:i:s');
                    
                }
                
                
		if(($this->data['Aditivo']['orgao']=='hidra')||($atualizacao=='hidra')){
	//if($this->data['Aditivo']['orgao']=='hidra'){
            
			$tabela[0]['tabela']='hidra';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';
			//Atualizar dados de unidades- garantido por unidadesidx01.unique
                        $basehidra = 'sistema.';
                        $basesgbdo = 'sgbdo.';
                                                
                        
                        $siglas=$this->Aditivo->query("select omi_codigo  from {$basehidra}usuario as Hidra group by omi_codigo ");
                        //echo "select omi_codigo  from {$basehidra}usuario as Hidra group by omi_codigo ";
                        //print_r($siglas);exit();
                        foreach($siglas as $registro){
                            $this->Aditivo->query("insert ignore into unidades(id, sigla_unidade, cidade_id) values(uuid(),'{$registro['Hidra']['omi_codigo']}',null); ");
                           // echo "insert ignore into unidades(id, sigla_unidade, cidade_id) values(uuid(),'{$registro['Hidra']['omi_codigo']}',null); <br>";
                        }
                        $tabela[0]['status'] = '<ul>';
                        $tabela[0]['status'] .= '<li><b>1.</b>&nbsp;<i>Inseridas as siglas das unidades do hydra e atualizadas as chaves</i></li>';
      
                        $this->Aditivo->query("update unidades, {$basehidra}organizacao_militar  set unidades.nm_unidade={$basehidra}organizacao_militar.omi_descricao where unidades.sigla_unidade={$basehidra}organizacao_militar.omi_codigo;");
                        
 
                        $this->Aditivo->query("update unidades, {$basehidra}organizacao_militar, cidades  set unidades.cidade_id=cidades.id  where  (({$basehidra}organizacao_militar.omi_cidade)=(upper(cidades.nome)) or soundex({$basehidra}organizacao_militar.omi_cidade)=soundex(upper(cidades.nome)) or  CONVERT({$basehidra}organizacao_militar.omi_cidade USING latin1) COLLATE latin1_german2_ci =   CONVERT(upper(cidades.nome) USING latin1) COLLATE latin1_german2_ci    )and 	unidades.sigla_unidade={$basehidra}organizacao_militar.omi_codigo;    ");

 
                        $this->Aditivo->query("update unidades, {$basehidra}organizacao_militar  set {$basehidra}organizacao_militar.sgbdo_id=unidades.id   where unidades.sigla_unidade={$basehidra}organizacao_militar.omi_codigo;");
                        $tabela[0]['status'] .= '<li><b>2.</b>&nbsp;<i>Atualizados os nomes das unidades</i></li>';
                        

                        $semcidade = $this->Aditivo->query("select count(*) total from unidades where cidade_id is null");
                        
                        
                        $tabela[0]['status'] .= "<li><font style=\"color:red;background-color:yellow;\"><b>3.&nbsp;<i>Há {$semcidade[0][0]['total']} unidades que necessitam atualização da cidade.</i></b></font></li>";

                        $setores =  $this->Aditivo->query("select OM.sgbdo_id, Usuario.omi_codigo, Usuario.set_codigo  from {$basehidra}usuario Usuario inner join {$basehidra}organizacao_militar as OM on (OM.omi_codigo=Usuario.omi_codigo) group by Usuario.omi_codigo, Usuario.set_codigo; ");

                        
//                        $setores = $this->Aditivo->query("select {$basehidra}organizacao_militar.sgbdo_id sgbdo_id, {$basehidra}usuario.omi_codigo omi_codigo omi_codigo, {$basehidra}usuario.set_codigo set_codigo from {$basehidra}usuario Usuario inner join {$basehidra}organizacao_militar on ({$basehidra}organizacao_militar.omi_codigo={$basehidra}usuario.omi_codigo) group by {$basehidra}usuario.omi_codigo, {$basehidra}usuario.set_codigo ");
                        
                        
                        //echo "select OM.sgbdo_id, Usuario.omi_codigo, Usuario.set_codigo  from {$basehidra}usuario Usuario inner join {$basehidra}organizacao_militar as OM on (OM.omi_codigo=Usuario.omi_codigo) group by Usuario.omi_codigo, Usuario.set_codigo; ";
//print_r($setores);
                        
                        
                        foreach($setores as $registro){
                            $this->Aditivo->query("insert ignore into setors(id, unidade_id, sigla_setor, nm_setor, efetivo_previsto, tipo, parent_id ) values(uuid(),'{$registro['OM']['sgbdo_id']}','{$registro['Usuario']['set_codigo']}' ,'{$registro['Usuario']['set_codigo']}', 1, 'SECAO', NULL); ");
                           
//echo "insert ignore into setors(id, unidade_id, sigla_setor, nm_setor, efetivo_previsto, tipo, parent_id ) values(uuid(),'{$registro['organizacao_militar']['sgbdo_id']}','{$registro['usuario']['set_codigo']}' ,'{$registro['usuario']['set_codigo']}', 1, 'SECAO', NULL); ";                            
                        }
                        
                        
                        $this->Aditivo->query("update {$basehidra}setor_organizacao_militar, setors, unidades set {$basehidra}setor_organizacao_militar.sgbdo_id=setors.id where {$basehidra}setor_organizacao_militar.omi_codigo=unidades.sigla_unidade and  {$basehidra}setor_organizacao_militar.set_codigo=setors.sigla_setor and setors.unidade_id=unidades.id");

                        $this->Aditivo->query("update setors, {$basehidra}setor_organizacao_militar set setors.nm_chefe_setor={$basehidra}setor_organizacao_militar.usu_chefesetor, setors.tel_setor={$basehidra}setor_organizacao_militar.som_email where setors.id={$basehidra}setor_organizacao_militar.sgbdo_id; ");
                       
$this->Aditivo->query("                        
update setors,  (select tab01.sgbdo sgbdo_id, tab01.setor, tab01.divisao, {$basehidra}setor_organizacao_militar.sgbdo_id parent_id, {$basehidra}setor_organizacao_militar.som_divisao from {$basehidra}setor_organizacao_militar , (select {$basehidra}setor_organizacao_militar.sgbdo_id sgbdo,  {$basehidra}setor_organizacao_militar.set_codigo setor, {$basehidra}setor_organizacao_militar.som_divisao divisao, {$basehidra}setor_organizacao_militar.omi_codigo unidade from {$basehidra}setor_organizacao_militar where {$basehidra}setor_organizacao_militar.som_divisao is not null and {$basehidra}setor_organizacao_militar.sgbdo_id is not null) as tab01 where tab01.divisao=hidra_cindacta3.setor_organizacao_militar.set_codigo and tab01.unidade=hidra_cindacta3.setor_organizacao_militar.omi_codigo) as visao set setors.parent_id=visao.parent_id where setors.id=visao.sgbdo_id ");
                        
                        $tabela[0]['status'] .= '<li><b>4.</b>&nbsp;<i>Atualizados os nomes dos setores</i></li>';

                        $efetivo=$this->Aditivo->query("select {$basehidra}organizacao_militar.sgbdo_id as unidade_id, {$basehidra}setor_organizacao_militar.sgbdo_id as setor_id, {$basehidra}especialidade.sgbdo_id as especialidade_id, {$basehidra}posto_graduacao.sgbdo_id as posto_id, {$basehidra}usuario.usu_nome as nome, {$basehidra}usuario.usu_nomeguerra as nome_guerra, {$basehidra}usuario.usu_rg as identidade, {$basehidra}usuario.usu_datanascimento as dtnascimento, {$basehidra}usuario.usu_ativo as ativo,{$basehidra}usuario.usu_sexo as sexo,{$basehidra}usuario.usu_cpf as cpf from {$basehidra}usuario inner join {$basehidra}organizacao_militar on ({$basehidra}organizacao_militar.omi_codigo={$basehidra}usuario.omi_codigo) inner join {$basehidra}setor_organizacao_militar on ({$basehidra}setor_organizacao_militar.omi_codigo={$basehidra}organizacao_militar.omi_codigo and {$basehidra}setor_organizacao_militar.set_codigo={$basehidra}usuario.set_codigo) inner join {$basehidra}posto_graduacao on ({$basehidra}posto_graduacao.pgr_codigo={$basehidra}usuario.pgr_codigo) inner join {$basehidra}especialidade on ({$basehidra}especialidade.esp_codigo={$basehidra}usuario.esp_codigo) ");
                       // print_r($efetivo);
                        foreach($efetivo as $registro){
                            $c1  = $registro['organizacao_militar']['unidade_id'];
                            $c2  = $registro['setor_organizacao_militar']['setor_id'];
                            $c3  = $registro['posto_graduacao']['posto_id'];
                            $c4  = $registro['especialidade']['especialidade_id'];
                            $c5  = $registro['usuario']['identidade'];
                            $c6  = 'CAER';
                           // $c7  = $registro[0]['saram'];
                            $c8  = $registro['usuario']['nome'];
                            $c9  = $registro['usuario']['nome_guerra'];
                            $c10 = $registro['usuario']['dtnascimento'];
                            $c11 = $registro['usuario']['sexo'];
                            $c12 = $registro['usuario']['cpf'];
                            $c13 = ($registro['usuario']['ativo']=='S')?'1':'0';
                            $this->Aditivo->query("insert ignore into militars (unidade_id, setor_id, posto_id, especialidade_id, identidade, expedidor, nm_completo, nm_guerra, dt_nascimento, sexo, cpf, ativa) values(uuid(),'$c1','$c2','$c3','$c4','$c5','$c6','$c8','$c9','$c10','$c11','$c12','$c13') on duplicate key update unidade_id='$c1', setor_id='$c2', posto_id='$c3',especialidade_id='$c4',nm_completo='$c8',nm_guerra='$c9',dt_nascimento='$c10',ativa='$c13'; ");
                            
                            //echo "insert ignore into militars (unidade_id, setor_id, posto_id, especialidade_id, identidade, expedidor, nm_completo, nm_guerra, dt_nascimento, sexo, cpf, ativa) values(uuid(),'$c1','$c2','$c3','$c4','$c5','$c6','$c8','$c9','$c10','$c11','$c12','$c13') on duplicate key update unidade_id='$c1', setor_id='$c2', posto_id='$c3',especialidade_id='$c4',nm_completo='$c8',nm_guerra='$c9',dt_nascimento='$c10',ativa='$c13'; ";
         //echo "insert ignore into militars (unidade_id, setor_id, posto_id, especialidade_id, identidade, expedidor, nm_completo, nm_guerra, dt_nascimento, sexo, cpf, ativa) values(uuid(),'$c1','$c2','$c3','$c4','$c5','$c6','$c8','$c9','$c10','$c11','$c12','$c13')on duplicate key update unidade_id='$c1', setor_id='$c2', posto_id='$c3',especialidade_id='$c4',nm_completo='$c8',nm_guerra='$c9',dt_nascimento='$c10',ativa='$c13'; ";                  
                        }      
                        $tabela[0]['status'] .= '<li><b>5.</b>&nbsp;<i>Tabela com o efetivo importada</i></li>';
                        //id de consulta=2
                        $usuarios=$this->Aditivo->query("select militars.id, 2, {$basehidra}usuario.usu_login,  {$basehidra}usuario.usu_email, {$basehidra}usuario.usu_senha, now(),null  from militars, {$basehidra}usuario where militars.identidade={$basehidra}usuario.usu_rg;");
                        foreach($usuarios as $registro){
                            $c1  = $registro['militars']['id'];
                            $c2  = $registro['usuario']['usu_login'];
                            $c3  = $registro['usuario']['usu_email'];
                            $c4  = $registro['usuario']['usu_senha'];
                            $this->Aditivo->query("insert ignore into usuarios ( militar_id, privilegio_id, login, email, senha, created, updated) values('$c1',2, '$c2','$c3','$c4',now(), null) on duplicate key update login='$c2',email='$c3', senha='$c4', updated=now(); ");
                           
                        }      
                                
                        $totalusuario = count($usuarios);
                        $tabela[0]['status'] .= "<li><b>6.</b>&nbsp;<i>$totalusuario Senhas e usuários atualizados</i></li>";
                        
                        
//update hidra_cindacta3.posto_graduacao, cindacta3.postos set hidra_cindacta3.posto_graduacao.sgbdo_id=cindacta3.postos.id where hidra_cindacta3.posto_graduacao.pgr_codigo=cindacta3.postos.sigla_compativel
                        //update hidra_cindacta3.especialidade, (select concat(sigla_quadro,' ',nm_especialidade) as esp, especialidades.id as id, especialidades.nm_especialidade as espcodigo   from quadros, especialidades where especialidades.quadro_id=quadros.id)  as novo  set hidra_cindacta3.especialidade.sgbdo_id=id where hidra_cindacta3.especialidade.esp_codigo=novo.esp

                        
                        $tabela[0]['status'] .= '<ul>';
			
			$tabela[0]['fim']=date('Y-m-d h:i:s');
		}
                
	if(($this->data['Aditivo']['orgao']=='dctp')||($atualizacao=='dctp')){
                
//	if($this->data['Aditivo']['orgao']=='dctp'){
			$tabela[0]['tabela']='pefcr';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';
			
			$conectadctp=mysql_pconnect('10.32.63.29','drhu','drhu');
			if (!$conectadctp) {
			    die('Not connected : ' . mysql_error());
			}
			$selecionadctp = mysql_select_db('dctp', $conectadctp);
			if (!$selecionadctp) {
			    die ('Can\'t use iceaEPLIS : ' . mysql_error());
			}
			mysql_query('set names "utf8"');
			//$this->Aditivo->query('delete from pefcr;');
			$consultadctp = mysql_query('select count(*) total from pefcr;');
			if (!$consultadctp) {
			    die('Invalid query: ' . mysql_error());
			}
			$contaTabelaInicio = mysql_fetch_array($consultadctp);
			$contaTbInicio = $contaTabelaInicio['total'];

			
			$contaTabelaFim=$this->Aditivo->query('select count(*) total from pefcr;');
			$contaTbFim= $contaTabelaFim[0][0]['total'];
			
			$tabela[0]['status']='No SGBDO:'.$contaTbFim.' - Na DCTP:'.$contaTbInicio.' registros.';
                        
			if($contaTbFim<$contaTbInicio){
				
				$consultadctp = mysql_query(' select * from pefcr ',$conectadctp);
				if (!$consultadctp) {
				    die('Invalid query: ' . mysql_error());
				}
				$registroatualizados = 0;
				//print_r(mysql_fetch_row($consultadctp, MYSQL_BOTH));
				while ($d = mysql_fetch_array($consultadctp)) {
				  $insereforcado = 'insert ignore into pefcr (codPEFCR, cpf, ORGEXPED, CM, codcurso, local, grau, dtInicio, dtTerm, DURACAO, Ident ) values('.$d[0].',"'.$d[1].'","'.$d[2].'","'.$d[3].'","'.$d[4].'","'.$d[5].'","'.$d[6].'","'.$d[7].'","'.$d[8].'","'.$d[9].'","'.$d[10].'")';
                                  //echo $insereforcado;
				  if($this->Aditivo->query($insereforcado)){
				  	$registroatualizados++;
				  }
				} 
				 $this->Aditivo->query('update pefcr, militars set pefcr.militar_id=militars.id where pefcr.Ident=militars.identidade ');
				 $this->Aditivo->query('update pefcr, cursos set pefcr.curso_id=cursos.id where pefcr.codcurso=cursos.codigo ');

    			 $this->Aditivo->query('insert ignore into militars_cursos (militar_id, curso_id, dt_inicio_curso, dt_fim_curso, local_realizacao, periodo, grau)  (select militar_id, curso_id, dtInicio, dtTerm, local, concat(dtInicio,"-",dtTerm), grau from pefcr)  on duplicate key update  dt_inicio_curso=pefcr.dtInicio, dt_fim_curso=pefcr.dtTerm, local_realizacao=pefcr.local, periodo=concat(pefcr.dtInicio,"-",pefcr.dtTerm), grau=pefcr.grau');
				 $tabela[0]['status']= $tabela[0]['status'].' '.$registroatualizados.' registros atualizados';
				
			}
			$tabela[0]['fim']=date('Y-m-d h:i:s');
		}
                
                
	if(($this->data['Aditivo']['orgao']=='saeweb')||($atualizacao=='saeweb')){
                
//	if($this->data['Aditivo']['orgao']=='dctp'){
			$tabela[0]['tabela']='pefcr';
			$tabela[0]['inicio']=date('Y-m-d h:i:s');
			$tabela[0]['fim']='';
			$tabela[0]['status']='';
			
			$conectadctp=mysql_pconnect('10.228.12.110','usu_sgbdo','dacta4@saeweb');
			if (!$conectadctp) {
			    die('Not connected : ' . mysql_error());
			}
			$selecionadctp = mysql_select_db('bcpessoal', $conectadctp);
			if (!$selecionadctp) {
			    die ('Can\'t use iceaEPLIS : ' . mysql_error());
			}
			//mysql_query('set names "utf8"');
			$consultadctp = mysql_query('select * from consulta_sgbdo  ');
			if (!$consultadctp) {
			    die('Invalid query: ' . mysql_error());
			}
                        
                        while ($d = mysql_fetch_array($consultadctp, MYSQL_BOTH)) {
				//  $insereforcado = 'insert ignore into pefcr (codPEFCR, cpf, ORGEXPED, CM, codcurso, local, grau, dtInicio, dtTerm, DURACAO, Ident ) values('.$d[0].',"'.$d[1].'","'.$d[2].'","'.$d[3].'","'.$d[4].'","'.$d[5].'","'.$d[6].'","'.$d[7].'","'.$d[8].'","'.$d[9].'","'.$d[10].'")';
                                  //echo $insereforcado;
                            $d['nm_nome'] = iconv('latin1','utf8',$d['nm_nome']);
                            $d['nm_guerra'] = iconv('latin1','utf8',$d['nm_guerra']);
                            $efetivocindacta1 = $this->Aditivo->query("update militars set saram='{$d['nr_saram']}', cpf='{$d['nr_cpf']}',nm_completo='{$d['nm_nome']}', nm_guerra='{$d['nm_guerra']}', sexo='{$d['tp_sexo']}' where identidade='{$d['id_numero']}'");
                              

				//  print_r($efetivocindacta1);
				} 
			$tabela[0]['fim']=date('Y-m-d h:i:s');
		}

		if(($this->data['Aditivo']['orgao']=='formdctp')||($atualizacao=='obter')){
                
						$tabela[0]['tabela']='formdctp';
						$tabela[0]['inicio']=date('Y-m-d h:i:s');
						$tabela[0]['fim']='';
						$tabela[0]['status']='';
						
						$consultasgbdo = $this->Aditivo->query('select cpf, nm_completo from militars where LENGTH(trim(cpf))=11 and obs is null limit 3 ');
						echo '<pre>';print_r($consultasgbdo);echo '</pre>';
						//exit();
						$contaTabelaInicio = count($consultasgbdo);

						$militarid = $consultasgbdo[0]['militars']['cpf'];

						
						$contaTbInicio = 0;
							
						$contaTabelaFim=0;
						$contaTbFim= count($contaTabelaInicio);
							
						$tabela[0]['status']='No SGBDO:'.$contaTabelaInicio.' registros.';
						$registroatualizados = 0;
					
						$port = '80';
						$path = '/portal/meuscursos/pesquisanomes';
						$host = 'dctp.decea.intraer';
						$type = 'http'; 
						$post = "_method=POST$postado";
							
						for($inicio=0;$inicio<$contaTabelaInicio;$inicio++) {

							$cpfdctp = substr($consultasgbdo[$inicio]['militars']['cpf'],0,3).'.'.substr($consultasgbdo[$inicio]['militars']['cpf'],3,3).'.'.substr($consultasgbdo[$inicio]['militars']['cpf'],6,3).'-'.substr($consultasgbdo[$inicio]['militars']['cpf'],9,2);

							echo '<br>'.$consultasgbdo[$inicio]['militars']['cpf'].'<br>';
							echo '<br>'.$cpfdctp.'<br>';
							echo $consultasgbdo[$inicio]['militars']['nm_completo'].'<br>';

							$datapost['codcpf'] = $cpfdctp;
							$datapost['nome'] = '';
							$datapost['local'] = '';
							$datapost['tipocursos'] = array('concluido','indicado');


							$ch = curl_init('http://dctp.decea.intraer/portal/meuscursos/pesquisanomes');
							curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($datapost));
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0");
							curl_setopt($ch, CURLOPT_VERBOSE, 0);
							$resposta = curl_exec($ch);
							curl_close($ch);
	
							$posicaoinicio = strpos($resposta, 'http://dctp.decea.intraer/portal/meuscursos/pesquisacursos/');
							$posicaofim = strpos($resposta, '/indiconcl');
							$url = trim(substr($resposta, $posicaoinicio, $posicaofim+strlen('/indiconcl')-$posicaoinicio));
							//echo $linkcursos;
	
							//$url = "http://dctp.decea.intraer/portal/meuscursos/pesquisacursos/11959/indiconcl";
	
							if(strlen($url)>20){
								$post = $datapost;
							
								$data = http_build_query($datapost);
								$url = parse_url($url); 
								
								if($url["scheme"] != "http"){ 
									die("Error: only HTTP requests supported!");
								}
								$valorsessao = 'laravel_session=eyJpdiI6ImxkWDdGRlBqQjUyaEM5dFBGYXBTTWc9PSIsInZhbHVlIjoibG10UGRsXC9KUmdtalBEMTJPNEhqejdlRUZCTnI0SUN2K1N2RzBYa3ZHa01abUtrT2RzOGRvT1NkZGJ5VGc0a3RBUVB3S2lwMGZtaFprcERGNUkwakdBPT0iLCJtYWMiOiIwNjdlOTNjMWMwMDBhNGExN2Y3ODNjZmQzNGVjNWVkYWJkM2E2ZGM4ODU0ZDc4M2VjYmJkMWZhYjRjOTA4NDk2In0%3D; expires=Wed, 15-Jun-2022 20:07:07 GMT; Max-Age=7200; path=/; HttpOnly';
								$host = $url["host"];
								$path = $url["path"];
							
								// open a socket connection with port 80, set timeout 40 sec.
								$fp = fsockopen($host, 80, $errno, $errstr, 120);
								$result = "";
							
								if($fp){ 
									// send a request headers
									fputs($fp, "GET $path HTTP/1.1\r\n");
									fputs($fp, "Host: $host\r\n");
									if(!empty($valorsessao)){
										fputs($fp, "Cookie: $valorsessao\r\n");
									}
									if($referer != "") fputs($fp, "Referer: $referer\r\n");
									
									
									
									//fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
									//fputs($fp, "Content-length: ".strlen($data)."\r\n");
									
									
									
									fputs($fp, "Connection: close\r\n\r\n");
									fputs($fp, $data);
									
											
									// receive result from request
									while(!feof($fp)) $result .= fgets($fp, 4096);
									
								}else{ 
									header('Content-type: application/x-json');
									$retorno = array ("status"=>"err","error"=>$errstr.' '.$errno);
									//echo '{"status":"err", "error":"'.$errstr.' '.$errno.'"}';
									echo json_encode($retorno);
								}
							
								// close socket connection
								fclose($fp);
							
								// split result header from the content
								$result = explode("\r\n\r\n", $result, 2);	
								//var_dump($result);
								//$result[1];
								$restante = $result[1];
								$posicao_inicio = stripos($restante, 'Curso(s) Realizado(s)');
								$restante = substr($restante, $posicao_inicio+strlen('Curso(s) Realizado(s)'), strlen($restante)-strlen('Curso(s) Realizado(s)'));
								$posicao_final = stripos($restante, '</table>');
								
								if($posicao_final!==false){

									$restante = substr($restante, 0, ($posicao_final+strlen('</table>')));
									echo $restante;
									
										unset($Header);	
										unset($Detail);	
										unset($aDataTableDetailHTML);
										unset($sNodeDetail);
										unset($NodeHeader);
										unset($aTempData);
										unset($aDataTableHeaderHTML);
										
									$DOM = new DOMDocument('1.0', 'UTF-8');
									$DOM->loadHTML(mb_convert_encoding($restante, 'HTML-ENTITIES', 'UTF-8'));
									
									$Header = $DOM->getElementsByTagName('th');
									$Detail = $DOM->getElementsByTagName('td');
								
									//#Get header name of the table
									foreach($Header as $NodeHeader) {	$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);		}
									//print_r($aDataTableHeaderHTML); die();
								
									//#Get row data/detail table without header name as key
									$i = 0;
									$j = 0;
									foreach($Detail as $sNodeDetail) 
									{
										$aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
										$i = $i + 1;
										$j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
									}
									//print_r($aDataTableDetailHTML); die();
									
									//#Get row data/detail table with header name as key and outer array index as row number
									for($i = 0; $i < count($aDataTableDetailHTML); $i++)
									{
										for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
										{
											$aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
										}
									}
									$aDataTableDetailHTML = $aTempData; unset($aTempData);


									foreach($aDataTableDetailHTML as $nome){
										$cursoexiste = $this->Aditivo->query('select * from cursos where codigo="'.trim($nome['Código do Curso']).'" ');
										if(!isset($cursoexiste[0]['cursos']['id'])){
											$inserecurso = $this->Aditivo->query('insert into cursos (codigo, descricao) values("'.trim($nome['Código do Curso']).'", "'.$nome['Nome Curso'].'") ');
											echo 'insert into cursos (codigo, descricao) values("'.trim($nome['Código do Curso']).'", "'.$nome['Nome Curso'].'") <br>';
											$cursoexiste = $this->Aditivo->query('select * from cursos where codigo="'.trim($nome['Código do Curso']).'" ');
										}
										$cursoid = $cursoexiste[0]['cursos']['id'];
										$local = $nome['Local'];
										$militarid = $consultasgbdo[$inicio]['militars']['cpf'];

										$dtinicio = implode('/', array_reverse(explode('/', $nome['Data Início'])));
										$dttermino = implode('/', array_reverse(explode('/', $nome['Data Fim'])));
										$inseremilitarcurso = $this->Aditivo->query('insert ignore into militars_cursos (militar_id, curso_id, dt_inicio_curso, dt_fim_curso, local_realizacao, periodo) values("'.$militarid.'", "'.$cursoid.'", "'.$dtinicio.'", "'.$dttermino.'", "'.$local.'", "'.$dtinicio.' - '.$dttermino.'") on duplicate key update dt_inicio_curso="'.$dtinicio.'", dt_fim_curso="'.$dttermino.'" ');
										echo 'insert ignore into militars_cursos (militar_id, curso_id, dt_inicio_curso, dt_fim_curso, local_realizacao, periodo) values("'.$militarid.'", "'.$cursoid.'", "'.$dtinicio.'", "'.$dttermino.'", "'.$local.'", "'.$dtinicio.' - '.$dttermino.'") on duplicate key update dt_inicio_curso="'.$dtinicio.'", dt_fim_curso="'.$dttermino.'" <br>';




									}
								}

							}
							$this->Aditivo->query('update militars set obs="curso atualizado '.date('d-m-Y').'" where id="'.$militarid.'" ');

							echo '<pre>';
							print_r($aDataTableDetailHTML); 
							echo '<pre>';

							
								
						}
							
						if($contaTabelaInicio==0){
							$this->redirect(array('action'=>'add'));
						}
						
						$tabela[0]['status']= $tabela[0]['status'].' '.$registroatualizados.' registros atualizados';
					
						
							
						$tabela[0]['fim']=date('Y-m-d h:i:s');
					}
			

                
		$this->set('tabela',$tabela);
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
	}
	function externocsv(){
		$sqlC = '';
        if($this->data['id']=='R16'){
           for($i=0;$i<10;$i++){
              if(!empty($this->data[$this->data['id']]['condicao'][$i])&&!empty($this->data[$this->data['id']]['valor'][$i])){
                 if(ereg("^E -", $this->data[$this->data['id']]['condicao'][$i])){
                     $primeiro = " and {$this->data[$this->data['id']]['campo'][$i]} ";
                 }
                 if(ereg("^OU -", $this->data[$this->data['id']]['condicao'][$i])){
                     $primeiro = " or {$this->data[$this->data['id']]['campo'][$i]} ";
                 }
                 if(ereg("CONTENHA", $this->data[$this->data['id']]['condicao'][$i])){
                    if(ereg("NÃO", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = " not like '%{$this->data[$this->data['id']]['valor'][$i]}%' ";
                    }else{
                        $segundo = " like '%{$this->data[$this->data['id']]['valor'][$i]}%' ";
                    }
                 }
                 if(ereg("COMECE", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  like '%{$this->data[$this->data['id']]['valor'][$i]}' ";
                 }
                 if(ereg("TERMINE", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  like '{$this->data[$this->data['id']]['valor'][$i]}%' ";
                 }
                 if(ereg("IGUAL", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  = {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 if(ereg("MAIOR", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  > {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 if(ereg("MENOR", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  < {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 if(ereg("DIFERENTE", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  <> {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 
                   $sqlC .= " {$primeiro} {$segundo} ";
              }
              
           }

            $sqlinicio = 'select Militar.nm_completo, Militar.sexo,
            Posto.sigla_posto,  Quadro.sigla_quadro, Especialidade.nm_especialidade, Curso.codigo,
            Unidade.sigla_unidade, Setor.sigla_setor, datediff(now(),Militar.dt_admissao)/365 anos,
            Habilitacao.validade_cht, Exame.data_validade
                from
                militars Militar 
                left join militars_cursos MilitarCurso on (MilitarCurso.militar_id=Militar.id)
                left join cursos Curso on (Curso.id=MilitarCurso.curso_id)
                inner join postos Posto on (Posto.id=Militar.posto_id) 
                inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
                inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
                left join setors Setor on (Setor.id=Militar.setor_id)
                left join unidades Unidade on (Unidade.id=Militar.unidade_id)
                left join habilitacaos Habilitacao on (Habilitacao.militar_id=Militar.id)
                left join exames Exame on (Exame.militar_id=Militar.id)
                where 1=1 '.$sqlC;
            
         //   print_r($this->data);
       //echo $sqlinicio;
            
            $temp = $this->Aditivo->query($sqlinicio);
            
           // print_r($temp);
            
            foreach($temp as $chave=>$valor){
                $conteudo[$chave]['Efetivo']['sigla_unidade']=$valor['Unidade']['sigla_unidade'];
                $conteudo[$chave]['Efetivo']['sigla_setor']=$valor['Setor']['sigla_setor'];
                $conteudo[$chave]['Efetivo']['sigla_posto']=$valor['Posto']['sigla_posto'];
                $conteudo[$chave]['Efetivo']['sigla_quadro']=$valor['Quadro']['sigla_quadro'];
                $conteudo[$chave]['Efetivo']['nm_especialidade']=$valor['Especialidade']['nm_especialidade'];
                $conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];
                $conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
                $conteudo[$chave]['Efetivo']['codigo']=$valor['Curso']['codigo'];
                $conteudo[$chave]['Efetivo']['validade_cht']=$valor['Habilitacao']['validade_cht'];
                $conteudo[$chave]['Efetivo']['validade_ccf']=$valor['Exame']['data_validade'];
                $conteudo[$chave]['Efetivo']['anos']=$valor[0]['anos'];
            }
			$titulo = 'Consulta Personalizada';
			$tabela = 'Efetivo';
			$nome = 'planilha_personalizada';
		
        }        
		
		if($this->data['id']=='R5'){
			if(!empty($this->data[$this->data['id']]['admissao_inicio'])){
					$sql .= ' and Habilitacao.dt_concessao >= "'.$this->data[$this->data['id']]['licenca'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['admissao_termino'])){
					$sql .= ' and Habilitacao.dt_concessao <= "'.$this->data[$this->data['id']]['licenca'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['licenca'])){
				$sql .= ' and Licenca.nr_licenca like "'.$this->data[$this->data['id']]['licenca'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['nome'])){
				$sql .= ' and Militar.nm_completo like "'.$this->data[$this->data['id']]['nome'].'" ';
			}
			if($this->data[$this->data['id']]['organizacao']>0){
				$sql .= ' and Unidade.id='.$this->data[$this->data['id']]['organizacao'].' ';
			}
			
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.sigla_setor in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['qualificacao'][0])){
				$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['empresa'][0])){
				//$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['atividade'][0])){
				//$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['area'][0])){
				//$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			$sqlinicio = 'select Militar.* , Unidade.sigla_unidade, Setor.sigla_setor, Posto.sigla_posto, Especialidade.nm_especialidade, Licenca.*
				from
				militars Militar 
				left join licencas Licenca on (Licenca.militar_id=Militar.id)
				inner join habilitacaos Habilitacao on (Habilitacao.militar_id=Militar.id)
				inner join postos Posto on (Posto.id=Militar.posto_id) 
				inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) 
				left join setors Setor on (Setor.unidade_id=Unidade.id and Militar.setor_id=Setor.id)
				where 1=1 '.$sql;
			
				//echo $sqlinicio;exit();
			$temp = $this->Aditivo->query($sqlinicio);
			foreach($temp as $chave=>$valor){
				$conteudo[$chave]['Efetivo']['tipo_licenca']=$valor['Licenca']['tipo_licenca'];
				$conteudo[$chave]['Efetivo']['nr_licenca']=$valor['Licenca']['nr_licenca'];
				$conteudo[$chave]['Efetivo']['indicativo']=$valor['Licenca']['indicativo'];
				if(!empty($valor['Licenca']['expedicao'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['expedicao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['expedicao']=$data;
				if(!empty($valor['Licenca']['validade'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['validade']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['validade']=$data;
				$conteudo[$chave]['Efetivo']['unidade']=$valor['Unidade']['sigla_unidade'];
				$conteudo[$chave]['Efetivo']['setor']=$valor['Setor']['sigla_setor'];
				$conteudo[$chave]['Efetivo']['identidade']=$valor['Militar']['identidade'];
				$conteudo[$chave]['Efetivo']['expedidor']=$valor['Militar']['expedidor'];
				$conteudo[$chave]['Efetivo']['posto']=$valor['Posto']['sigla_posto'];
				$conteudo[$chave]['Efetivo']['especialidade']=$valor['Especialidade']['nm_especialidade'];
				$conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];
				$conteudo[$chave]['Efetivo']['nm_guerra']=$valor['Militar']['nm_guerra'];
				$conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
				$conteudo[$chave]['Efetivo']['cht']=$valor['Habilitacao']['cht'];
				$conteudo[$chave]['Efetivo']['validade_cht']=$valor['Habilitacao']['validade_cht'];
				$conteudo[$chave]['Efetivo']['funcao']=$valor['Habilitacao']['funcao'];
				$conteudo[$chave]['Efetivo']['localidade']=$valor['Habilitacao']['localidade'];
				if(!empty($valor['Habilitacao']['dt_concessao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_concessao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_concessao']=$data;
				if(!empty($valor['Habilitacao']['dt_suspensao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_suspensao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_suspensao']=$data;
				if(!empty($valor['Habilitacao']['dt_perda'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_perda']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_perda']=$data;
			}
				$titulo = 'Situacao Tecnico';
				$tabela = 'Efetivo';
				$nome = 'planilha_Situacao_Tec';
			
		}		 
		
	if($this->data['id']=='R3'){
			if(!empty($this->data[$this->data['id']]['vencimento'])){
				$sql .= ' and datediff(Habilitacao.validade_cht,now())<='.$this->data[$this->data['id']]['vencimento'].'  ';
			}
			if($this->data[$this->data['id']]['organizacao']>0){
				$sql .= ' and Unidade.id='.$this->data[$this->data['id']]['organizacao'].' ';
			}
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.sigla_setor in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['atividade'][0])){
				//$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			$sqlinicio = 'select Militar.* , Unidade.sigla_unidade, Setor.sigla_setor, Posto.sigla_posto, Especialidade.nm_especialidade, Licenca.*
				from
				militars Militar 
				left join licencas Licenca on (Licenca.militar_id=Militar.id)
				inner join habilitacaos Habilitacao on (Habilitacao.militar_id=Militar.id)
				inner join postos Posto on (Posto.id=Militar.posto_id) 
				inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) 
				left join setors Setor on (Setor.unidade_id=Unidade.id and Militar.setor_id=Setor.id)
				where 1=1 '.$sql;
			
				//echo $sqlinicio;exit();
			$temp = $this->Aditivo->query($sqlinicio);
			foreach($temp as $chave=>$valor){
				$conteudo[$chave]['Efetivo']['tipo_licenca']=$valor['Licenca']['tipo_licenca'];
				$conteudo[$chave]['Efetivo']['nr_licenca']=$valor['Licenca']['nr_licenca'];
				$conteudo[$chave]['Efetivo']['indicativo']=$valor['Licenca']['indicativo'];
				if(!empty($valor['Licenca']['expedicao'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['expedicao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['expedicao']=$data;
				if(!empty($valor['Licenca']['validade'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['validade']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['validade']=$data;
				$conteudo[$chave]['Efetivo']['unidade']=$valor['Unidade']['sigla_unidade'];
				$conteudo[$chave]['Efetivo']['setor']=$valor['Setor']['sigla_setor'];
				$conteudo[$chave]['Efetivo']['identidade']=$valor['Militar']['identidade'];
				$conteudo[$chave]['Efetivo']['expedidor']=$valor['Militar']['expedidor'];
				$conteudo[$chave]['Efetivo']['posto']=$valor['Posto']['sigla_posto'];
				$conteudo[$chave]['Efetivo']['especialidade']=$valor['Especialidade']['nm_especialidade'];
				$conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];
				$conteudo[$chave]['Efetivo']['nm_guerra']=$valor['Militar']['nm_guerra'];
				$conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
				$conteudo[$chave]['Efetivo']['cht']=$valor['Habilitacao']['cht'];
				$conteudo[$chave]['Efetivo']['validade_cht']=$valor['Habilitacao']['validade_cht'];
				$conteudo[$chave]['Efetivo']['funcao']=$valor['Habilitacao']['funcao'];
				$conteudo[$chave]['Efetivo']['localidade']=$valor['Habilitacao']['localidade'];
				if(!empty($valor['Habilitacao']['dt_concessao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_concessao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_concessao']=$data;
				if(!empty($valor['Habilitacao']['dt_suspensao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_suspensao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_suspensao']=$data;
				if(!empty($valor['Habilitacao']['dt_perda'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_perda']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_perda']=$data;
			}
				$titulo = 'CHT Vencida';
				$tabela = 'Efetivo';
				$nome = 'planilha_cht_vencida';
			
		}		 
		
		if($this->data['id']=='R2'){
			if(!empty($this->data[$this->data['id']]['vencida'])){
					$sql .= ' and datediff(Habilitacao.validade_cht,now())<0 and Habilitacao.dt_suspensao is null   and Habilitacao.dt_perda is null ';
			}
			if(!empty($this->data[$this->data['id']]['valida'])){
					$sql .= ' and (Habilitacao.dt_concessao is not null  and Habilitacao.dt_suspensao is null   and Habilitacao.dt_perda is null  and datediff(Habilitacao.validade_cht,now())>=0 ) ';
			}
			if(!empty($this->data[$this->data['id']]['suspensa'])){
					$sql .= ' and (Habilitacao.dt_concessao is not null  and Habilitacao.dt_suspensao is not null   and Habilitacao.dt_perda is null  and datediff(Habilitacao.validade_cht,now())>=0 ) ';
			}
			if(!empty($this->data[$this->data['id']]['perdida'])){
					$sql .= ' and (Habilitacao.dt_concessao is not null and Habilitacao.dt_perda is not null ) ';
			}
			if(!empty($this->data[$this->data['id']]['admissao_inicio'])){
					$sql .= ' and Habilitacao.dt_concessao >= "'.$this->data[$this->data['id']]['licenca'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['admissao_termino'])){
					$sql .= ' and Habilitacao.dt_concessao <= "'.$this->data[$this->data['id']]['licenca'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['licenca'])){
				$sql .= ' and Licenca.nr_licenca like "'.$this->data[$this->data['id']]['licenca'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['nome'])){
				$sql .= ' and Militar.nm_completo like "'.$this->data[$this->data['id']]['nome'].'" ';
			}
			if($this->data[$this->data['id']]['organizacao']>0){
				$sql .= ' and Unidade.id='.$this->data[$this->data['id']]['organizacao'].' ';
			}
			
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.sigla_setor in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['qualificacao'][0])){
				$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['empresa'][0])){
				//$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['atividade'][0])){
				//$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['area'][0])){
				//$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
			$sqlinicio = 'select Militar.* , Unidade.sigla_unidade, Setor.sigla_setor, Posto.sigla_posto, Especialidade.nm_especialidade, Licenca.*
				from
				militars Militar 
				left join licencas Licenca on (Licenca.militar_id=Militar.id)
				inner join habilitacaos Habilitacao on (Habilitacao.militar_id=Militar.id)
				inner join postos Posto on (Posto.id=Militar.posto_id) 
				inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) 
				left join setors Setor on (Setor.unidade_id=Unidade.id and Militar.setor_id=Setor.id)
				where 1=1 '.$sql;
			
//echo $sqlinicio;exit();
			$temp = $this->Aditivo->query($sqlinicio);
			foreach($temp as $chave=>$valor){
				$conteudo[$chave]['Efetivo']['tipo_licenca']=$valor['Licenca']['tipo_licenca'];
				$conteudo[$chave]['Efetivo']['nr_licenca']=$valor['Licenca']['nr_licenca'];
				$conteudo[$chave]['Efetivo']['indicativo']=$valor['Licenca']['indicativo'];
				if(!empty($valor['Licenca']['expedicao'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['expedicao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['expedicao']=$data;
				if(!empty($valor['Licenca']['validade'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['validade']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['validade']=$data;
				$conteudo[$chave]['Efetivo']['unidade']=$valor['Unidade']['sigla_unidade'];
				$conteudo[$chave]['Efetivo']['setor']=$valor['Setor']['sigla_setor'];
				$conteudo[$chave]['Efetivo']['identidade']=$valor['Militar']['identidade'];
				$conteudo[$chave]['Efetivo']['expedidor']=$valor['Militar']['expedidor'];
				$conteudo[$chave]['Efetivo']['posto']=$valor['Posto']['sigla_posto'];
				$conteudo[$chave]['Efetivo']['especialidade']=$valor['Especialidade']['nm_especialidade'];
				$conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];
				$conteudo[$chave]['Efetivo']['nm_guerra']=$valor['Militar']['nm_guerra'];
				$conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
				$conteudo[$chave]['Efetivo']['cht']=$valor['Habilitacao']['cht'];
				$conteudo[$chave]['Efetivo']['validade_cht']=$valor['Habilitacao']['validade_cht'];
				$conteudo[$chave]['Efetivo']['funcao']=$valor['Habilitacao']['funcao'];
				$conteudo[$chave]['Efetivo']['localidade']=$valor['Habilitacao']['localidade'];
				if(!empty($valor['Habilitacao']['dt_concessao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_concessao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_concessao']=$data;
				if(!empty($valor['Habilitacao']['dt_suspensao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_suspensao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_suspensao']=$data;
				if(!empty($valor['Habilitacao']['dt_perda'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_perda']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_perda']=$data;
			}
				$titulo = 'CHT Concedida';
				$tabela = 'Efetivo';
				$nome = 'planilha_cht_concedida';
			
		}		 
		
		
	if($this->data['id']=='R1'){
			if(!empty($this->data[$this->data['id']]['organizacao'][0])){
				$sql .= ' and Unidade.id in ('.$this->data[$this->data['id']]['organizacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.sigla_setor in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['qualificacao'][0])){
				$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
			}
				$sqlinicio = 'select Militar.* , Unidade.sigla_unidade, Setor.sigla_setor, Posto.sigla_posto, Especialidade.nm_especialidade, Licenca.*
				from
				militars Militar 
				inner join licencas Licenca on (Licenca.militar_id=Militar.id)
				inner join postos Posto on (Posto.id=Militar.posto_id) 
				inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) 
				left join setors Setor on (Setor.unidade_id=Unidade.id and Militar.setor_id=Setor.id)
				where 1=1 '.$sql;
			
				//echo $sqlinicio;exit();
			$temp = $this->Aditivo->query($sqlinicio);
			foreach($temp as $chave=>$valor){
				$conteudo[$chave]['Efetivo']['tipo_licenca']=$valor['Licenca']['tipo_licenca'];
				$conteudo[$chave]['Efetivo']['nr_licenca']=$valor['Licenca']['nr_licenca'];
				$conteudo[$chave]['Efetivo']['indicativo']=$valor['Licenca']['indicativo'];
				$conteudo[$chave]['Efetivo']['codigo_barra']=$valor['Licenca']['codigo_barra'];
				$conteudo[$chave]['Efetivo']['expedicao']=date('d-m-Y',strtotime($valor['Licenca']['expedicao']));
				$conteudo[$chave]['Efetivo']['validade']=date('d-m-Y',strtotime($valor['Licenca']['validade']));
				$conteudo[$chave]['Efetivo']['ticket']=$valor['Licenca']['ticket'];
				$conteudo[$chave]['Efetivo']['unidade']=$valor['Unidade']['sigla_unidade'];
				$conteudo[$chave]['Efetivo']['setor']=$valor['Setor']['sigla_setor'];
				$conteudo[$chave]['Efetivo']['identidade']=$valor['Militar']['identidade'];
				$conteudo[$chave]['Efetivo']['expedidor']=$valor['Militar']['expedidor'];
				$conteudo[$chave]['Efetivo']['posto']=$valor['Posto']['sigla_posto'];
				$conteudo[$chave]['Efetivo']['especialidade']=$valor['Especialidade']['nm_especialidade'];
				$conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];
				$conteudo[$chave]['Efetivo']['nm_guerra']=$valor['Militar']['nm_guerra'];
				$conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
				$conteudo[$chave]['Efetivo']['cpf']=$valor['Militar']['cpf'];
				$conteudo[$chave]['Efetivo']['saram']=$valor['Militar']['saram'];
				$conteudo[$chave]['Efetivo']['rc']=$valor['Militar']['rc'];
				$conteudo[$chave]['Efetivo']['dt_nascimento']=$valor['Militar']['dt_nascimento'];
				$conteudo[$chave]['Efetivo']['dt_admissao']=$valor['Militar']['dt_admissao'];
				$conteudo[$chave]['Efetivo']['locatual']=$valor['Militar']['locatual'];
				$conteudo[$chave]['Efetivo']['comando']=$valor['Militar']['comando'];
				$conteudo[$chave]['Efetivo']['area']=$valor['Militar']['area'];
				$conteudo[$chave]['Efetivo']['pasep']=$valor['Militar']['pasep'];
				$conteudo[$chave]['Efetivo']['beneficiarios']=$valor['Militar']['total_beneficiarios'];
				$conteudo[$chave]['Efetivo']['num_lesp']=$valor['Militar']['num_lesp'];
				$conteudo[$chave]['Efetivo']['funcao']=$valor['Militar']['funcao'];
				$conteudo[$chave]['Efetivo']['obs']=$valor['Militar']['obs'];
				$conteudo[$chave]['Efetivo']['situacao']=$valor['Militar']['situacao'];
				$conteudo[$chave]['Efetivo']['indicativo']=$valor['Militar']['indicativo'];
				$conteudo[$chave]['Efetivo']['orgao']=$valor['Militar']['orgao'];
				$conteudo[$chave]['Efetivo']['nr_licenca']=$valor['Militar']['nr_licenca'];
				$conteudo[$chave]['Efetivo']['nacionalidade']=$valor['Militar']['nacionalidade'];
			}
				$titulo = 'Licença Concedida';
				$tabela = 'Efetivo';
				$nome = 'planilha_licenca_concedida';
			
		}		 
		
		
	if($this->data['id']=='R6'){
		if(!empty($this->data[$this->data['id']]['organizacao'][0])){
			$sql .= ' and Unidade.id in ('.$this->data[$this->data['id']]['organizacao'][0].') ';
		}
		if(!empty($this->data[$this->data['id']]['setor'][0])){
			$sql .= ' and Setor.sigla_setor in ('.$this->data[$this->data['id']]['setor'][0].') ';
		}
		if(!empty($this->data[$this->data['id']]['situacao'][0])){
			$sql .= ' and Militar.situacao in ('.$this->data[$this->data['id']]['situacao'][0].') ';
		}
			$sqlinicio = 'select Militar.* , Unidade.sigla_unidade, Setor.sigla_setor, Posto.sigla_posto, Especialidade.nm_especialidade
			from
			militars Militar 
			inner join postos Posto on (Posto.id=Militar.posto_id) 
			inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			inner join unidades Unidade on (Unidade.id=Militar.unidade_id) 
			left join setors Setor on (Setor.unidade_id=Unidade.id and Militar.setor_id=Setor.id)
			where 1=1 '.$sql;
		
//echo $sqlinicio;exit();
		$temp = $this->Aditivo->query($sqlinicio);
		foreach($temp as $chave=>$valor){
			$conteudo[$chave]['Efetivo']['unidade']=$valor['Unidade']['sigla_unidade'];

			$conteudo[$chave]['Efetivo']['setor']=$valor['Setor']['sigla_setor'];
			$conteudo[$chave]['Efetivo']['identidade']=$valor['Militar']['identidade'];
			$conteudo[$chave]['Efetivo']['expedidor']=$valor['Militar']['expedidor'];
			$conteudo[$chave]['Efetivo']['posto']=$valor['Posto']['sigla_posto'];
			$conteudo[$chave]['Efetivo']['especialidade']=$valor['Especialidade']['nm_especialidade'];

			$conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];

			$conteudo[$chave]['Efetivo']['nm_guerra']=$valor['Militar']['nm_guerra'];
			$conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
			$conteudo[$chave]['Efetivo']['cpf']=$valor['Militar']['cpf'];
			$conteudo[$chave]['Efetivo']['saram']=$valor['Militar']['saram'];
			$conteudo[$chave]['Efetivo']['rc']=$valor['Militar']['rc'];
			$conteudo[$chave]['Efetivo']['dt_nascimento']=$valor['Militar']['dt_nascimento'];
			$conteudo[$chave]['Efetivo']['dt_admissao']=$valor['Militar']['dt_admissao'];
			$conteudo[$chave]['Efetivo']['locatual']=$valor['Militar']['locatual'];
			$conteudo[$chave]['Efetivo']['comando']=$valor['Militar']['comando'];
			$conteudo[$chave]['Efetivo']['area']=$valor['Militar']['area'];
			$conteudo[$chave]['Efetivo']['pasep']=$valor['Militar']['pasep'];
			$conteudo[$chave]['Efetivo']['beneficiarios']=$valor['Militar']['total_beneficiarios'];
			$conteudo[$chave]['Efetivo']['num_lesp']=$valor['Militar']['num_lesp'];
			$conteudo[$chave]['Efetivo']['funcao']=$valor['Militar']['funcao'];
			$conteudo[$chave]['Efetivo']['obs']=$valor['Militar']['obs'];
			$conteudo[$chave]['Efetivo']['situacao']=$valor['Militar']['situacao'];
			$conteudo[$chave]['Efetivo']['indicativo']=$valor['Militar']['indicativo'];
			$conteudo[$chave]['Efetivo']['orgao']=$valor['Militar']['orgao'];
			$conteudo[$chave]['Efetivo']['nr_licenca']=$valor['Militar']['nr_licenca'];
			$conteudo[$chave]['Efetivo']['nacionalidade']=$valor['Militar']['nacionalidade'];

		}
		$titulo = 'Efetivo Sisceab';
		$tabela = 'Efetivo';
		$nome = 'planilha_efetivo_sisceab';
	}		 
		
	if($this->data['id']=='R15'){
			if(!empty($this->data[$this->data['id']]['organizacao'][0])){
				$sql .= ' and Unidade.id in ('.$this->data[$this->data['id']]['organizacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['cargo_conselho'][0])){
				$sql .= ' and Cargosconselho.id in ('.$this->data[$this->data['id']]['cargo_conselho'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['tipo_licenca'][0])){
				$sql .= ' and Membrosconselho.tipo_licenca in ('.$this->data[$this->data['id']]['tipo_licenca'][0].') ';
			}
				$sqlinicio = 'select Militar.identidade, Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_completo, Unidade.sigla_unidade, 
				Membrosconselho.tipo_licenca, Membrosconselho.dt_inicio, Membrosconselho.dt_termino, Cargosconselho.nm_cargo 
				from
				militars Militar 
				inner join postos Posto on (Posto.id=Militar.posto_id) 
				inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) 
				inner join membrosconselhos Membrosconselho on (Membrosconselho.militar_id=Militar.id) 
				inner join cargosconselhos Cargosconselho on (Cargosconselho.id=Membrosconselho.cargosconselho_id) 
				where 1=1 '.$sql;
			
				//echo $sqlinicio;exit();
			$temp = $this->Aditivo->query($sqlinicio);
			foreach($temp as $chave=>$valor){
				$conteudo[$chave]['Membrosconselho']['identidade']=$valor['Militar']['identidade'];
				$conteudo[$chave]['Membrosconselho']['posto']=$valor['Posto']['sigla_posto'];
				$conteudo[$chave]['Membrosconselho']['especialidade']=$valor['Especialidade']['nm_especialidade'];
				$conteudo[$chave]['Membrosconselho']['nm_completo']=$valor['Militar']['nm_completo'];
				$conteudo[$chave]['Membrosconselho']['unidade']=$valor['Unidade']['sigla_unidade'];
				$conteudo[$chave]['Membrosconselho']['cargo']=$valor['Cargosconselho']['nm_cargo'];
				$conteudo[$chave]['Membrosconselho']['licenca_conselho']=$valor['Membrosconselho']['tipo_licenca'];
				$conteudo[$chave]['Membrosconselho']['inicio']=$valor['Membrosconselho']['dt_inicio'];
				$conteudo[$chave]['Membrosconselho']['termino']=$valor['Membrosconselho']['dt_termino'];
			}
				$titulo = 'Membros do Conselho';
				$tabela = 'Membrosconselho';
				$nome = 'planilha_membros_conselho';
			
		}		 
		if($this->data['id']=='R14'){
			//Campos: Identidade, nome, unidade, setor,  nr_licenca, data_inspecao (saude - obter tabela com monteiro) - manter qualificacao - remover empresa
			if($this->data[$this->data['id']]['organizacao_tecnico']>0){
				$sql .= ' and Unidade.id='.$this->data[$this->data['id']]['organizacao_tecnico'];
			}
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.id in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
		//Ingles: Fase1: Identidade, nome, unidade, setor, acertos, erros, nota
			if($this->data[$this->data['id']]['fase']=='fase01'){
			if(!empty($this->data[$this->data['id']]['anos'][0])){
				$sql .= ' and NivelInglesFase01.ano in ('.$this->data[$this->data['id']]['anos'][0].') ';
			}
				$sqlinicio = 'select Militar.identidade, Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_completo, Unidade.sigla_unidade, Setor.sigla_setor,
				NivelInglesFase01.acertos, NivelInglesFase01.erros, NivelInglesFase01.nota, NivelInglesFase01.operacional
				from militars Militar inner join postos Posto on (Posto.id=Militar.posto_id) inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) left join setors Setor on (Setor.id=Militar.setor_id)
				inner join nivel_ingles_fase01s NivelInglesFase01 on (NivelInglesFase01.militar_id=Militar.id) 
				where 1=1 '.$sql;
			
				$temp = $this->Aditivo->query($sqlinicio);
				foreach($temp as $chave=>$valor){
					$conteudo[$chave]['Fase01']['identidade']=$valor['Militar']['identidade'];
					$conteudo[$chave]['Fase01']['posto']=$valor['Posto']['sigla_posto'];
					$conteudo[$chave]['Fase01']['especialidade']=$valor['Especialidade']['nm_especialidade'];
					$conteudo[$chave]['Fase01']['nm_completo']=$valor['Militar']['nm_completo'];
					$conteudo[$chave]['Fase01']['unidade']=$valor['Unidade']['sigla_unidade'];
					$conteudo[$chave]['Fase01']['setor']=$valor['Setor']['sigla_setor'];
					$conteudo[$chave]['Fase01']['acertos']=$valor['NivelInglesFase01']['acertos'];
					$conteudo[$chave]['Fase01']['erros']=$valor['NivelInglesFase01']['erros'];
					$conteudo[$chave]['Fase01']['nota']="'".strval($valor['NivelInglesFase01']['nota']);
					$conteudo[$chave]['Fase01']['operacional']="'".strval($valor['NivelInglesFase01']['operacional']);
				}
				$titulo = 'Dados de Fase01';
				$tabela = 'Fase01';
				$nome = 'planilha_Fase01';
			}
		//Ingles: Fase2: Identidade, nome, unidade, setor, interlocutor, avaliador, setUtil, banda, pronuncia, estrutura, vocabulario, fluencia, compreensao, interacao, operacional, obs, anoref
			if($this->data[$this->data['id']]['fase']=='fase02'){
			if(!empty($this->data[$this->data['id']]['anos'][0])){
				$sql .= ' and NivelInglesFase02.ano in ('.$this->data[$this->data['id']]['anos'][0].') ';
			}
				$sqlinicio = 'select Militar.identidade, Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_completo, Unidade.sigla_unidade, Setor.sigla_setor,
				NivelInglesFase02.identidade_interlocutor, NivelInglesFase02.identidade_avaliador, NivelInglesFase02.operacional, NivelInglesFase02.setutil, NivelInglesFase02.banda, NivelInglesFase02.pronuncia,
				 NivelInglesFase02.estrutura, NivelInglesFase02.vocabulario, NivelInglesFase02.fluencia, NivelInglesFase02.compreensao, NivelInglesFase02.ano
				from militars Militar inner join postos Posto on (Posto.id=Militar.posto_id) inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) left join setors Setor on (Setor.id=Militar.setor_id)
				inner join nivel_ingles_fase02s NivelInglesFase02 on (NivelInglesFase02.militar_id=Militar.id) 
				where 1=1 '.$sql;
			
			$temp = $this->Aditivo->query($sqlinicio);
			foreach($temp as $chave=>$valor){
				$conteudo[$chave]['Fase02']['identidade']=$valor['Militar']['identidade'];
				$conteudo[$chave]['Fase02']['posto']=$valor['Posto']['sigla_posto'];
				$conteudo[$chave]['Fase02']['especialidade']=$valor['Especialidade']['nm_especialidade'];
				$conteudo[$chave]['Fase02']['nm_completo']=$valor['Militar']['nm_completo'];
				$conteudo[$chave]['Fase02']['unidade']=$valor['Unidade']['sigla_unidade'];
				$conteudo[$chave]['Fase02']['setor']=$valor['Setor']['sigla_setor'];
				$conteudo[$chave]['Fase02']['identidade_interlocutor']=$valor['NivelInglesFase02']['identidade_interlocutor'];
				$conteudo[$chave]['Fase02']['identidade_avaliador']=$valor['NivelInglesFase02']['identidade_avaliador'];
				$conteudo[$chave]['Fase02']['setutil']=$valor['NivelInglesFase02']['setutil'];
				$conteudo[$chave]['Fase02']['banda']=$valor['NivelInglesFase02']['banda'];
				$conteudo[$chave]['Fase02']['pronuncia']=$valor['NivelInglesFase02']['pronuncia'];
				$conteudo[$chave]['Fase02']['estrutura']=$valor['NivelInglesFase02']['estrutura'];
				$conteudo[$chave]['Fase02']['vocabulario']=$valor['NivelInglesFase02']['vocabulario'];
				$conteudo[$chave]['Fase02']['fluencia']=$valor['NivelInglesFase02']['fluencia'];
				$conteudo[$chave]['Fase02']['compreensao']=$valor['NivelInglesFase02']['compreensao'];
				$conteudo[$chave]['Fase02']['ano']=$valor['NivelInglesFase02']['ano'];
				$conteudo[$chave]['Fase02']['operacional']=$valor['NivelInglesFase02']['operacional'];
			}
				$titulo = 'Dados de Fase02';
				$tabela = 'Fase02';
				$nome = 'planilha_Fase02';
			}
		}

		if($this->data['id']=='R4'){
			//Campos: Identidade, nome, unidade, setor,  nr_licenca, data_inspecao (saude - obter tabela com monteiro) - manter qualificacao - remover empresa
			if($this->data[$this->data['id']]['organizacao_tecnico']>0){
				$sql .= ' and Unidade.id='.$this->data[$this->data['id']]['organizacao_tecnico'];
			}
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.id in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['qualificacao'][0])){
				$sql .= ' and Qualificacao.id in ('.$this->data[$this->data['id']]['qualificacao'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['empresa'][0])){
				$sql .= ' and Empresa.id in ('.$this->data[$this->data['id']]['empresa'][0].') ';
			}
			$sqlinicio = 'select Militar.* , Unidade.sigla_unidade, Setor.sigla_setor, Posto.sigla_posto, Especialidade.nm_especialidade, Licenca.*
				from
				militars Militar 
				left join licencas Licenca on (Licenca.militar_id=Militar.id)
				inner join habilitacaos Habilitacao on (Habilitacao.militar_id=Militar.id)
				inner join postos Posto on (Posto.id=Militar.posto_id) 
				inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
				inner join unidades Unidade on (Unidade.id=Militar.unidade_id) 
				left join setors Setor on (Setor.unidade_id=Unidade.id and Militar.setor_id=Setor.id)
				where 1=1 '.$sql;
			
//echo $sqlinicio;exit();
			$temp = $this->Aditivo->query($sqlinicio);
			foreach($temp as $chave=>$valor){
				$conteudo[$chave]['Efetivo']['tipo_licenca']=$valor['Licenca']['tipo_licenca'];
				$conteudo[$chave]['Efetivo']['nr_licenca']=$valor['Licenca']['nr_licenca'];
				$conteudo[$chave]['Efetivo']['indicativo']=$valor['Licenca']['indicativo'];
				if(!empty($valor['Licenca']['expedicao'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['expedicao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['expedicao']=$data;
				if(!empty($valor['Licenca']['validade'])){
					$data=date('d-m-Y',strtotime($valor['Licenca']['validade']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['validade']=$data;
				$conteudo[$chave]['Efetivo']['unidade']=$valor['Unidade']['sigla_unidade'];
				$conteudo[$chave]['Efetivo']['setor']=$valor['Setor']['sigla_setor'];
				$conteudo[$chave]['Efetivo']['identidade']=$valor['Militar']['identidade'];
				$conteudo[$chave]['Efetivo']['expedidor']=$valor['Militar']['expedidor'];
				$conteudo[$chave]['Efetivo']['posto']=$valor['Posto']['sigla_posto'];
				$conteudo[$chave]['Efetivo']['especialidade']=$valor['Especialidade']['nm_especialidade'];
				$conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];
				$conteudo[$chave]['Efetivo']['nm_guerra']=$valor['Militar']['nm_guerra'];
				$conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
				$conteudo[$chave]['Efetivo']['cht']=$valor['Habilitacao']['cht'];
				$conteudo[$chave]['Efetivo']['validade_cht']=$valor['Habilitacao']['validade_cht'];
				$conteudo[$chave]['Efetivo']['funcao']=$valor['Habilitacao']['funcao'];
				$conteudo[$chave]['Efetivo']['localidade']=$valor['Habilitacao']['localidade'];
				if(!empty($valor['Habilitacao']['dt_concessao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_concessao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_concessao']=$data;
				if(!empty($valor['Habilitacao']['dt_suspensao'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_suspensao']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_suspensao']=$data;
				if(!empty($valor['Habilitacao']['dt_perda'])){
					$data=date('d-m-Y',strtotime($valor['Habilitacao']['dt_perda']));
				}else{
					$data="";
				}
				$conteudo[$chave]['Efetivo']['dt_perda']=$data;
			}
				$titulo = 'Tecnicos Habilitados';
				$tabela = 'Efetivo';
				$nome = 'planilha_habilitados';
			
		}
                
                
	if ($this->data['id'] == 'R18') {

            $centro = substr($this->data[$this->data['id']]['setor'],0,2);
            $setor = substr($this->data[$this->data['id']]['setor'],2);  
            if($setor>0){
                $sqlsetor = "setor={$setor}";
            }
                
            $sqlinicio = "select *, hour(entrada) hora, minute(entrada) minuto
				from
				aditivosplanosets Planos 
				where 
                                month(data)={$this->data[$this->data['id']]['mes']} 
                                and year(data)={$this->data[$this->data['id']]['ano']} 
                                and centro='{$centro}' 
                                $sqlsetor
                                and hour(entrada)>={$this->data[$this->data['id']]['inicio']}
                                and hour(entrada)<={$this->data[$this->data['id']]['fim']}
                                order by entrada asc
                                ";

            $dados = $this->Aditivo->query($sqlinicio);
            
            $inicial = $this->data[$this->data['id']]['inicio']*60;
            $final = $this->data[$this->data['id']]['fim']*60;
            $passo = $this->data[$this->data['id']]['hora']*60+$this->data[$this->data['id']]['minuto'];
            
            $dias = date('t',strtotime($this->data[$this->data['id']]['ano'].'-'.$this->data[$this->data['id']]['mes'].'-1'));

            $camposplanos = array(
                0 => 'inicio',
                1 => 'termino'
            );
            for ($d = 1; $d <= $dias; $d++) {
                array_push($camposplanos, $d);
            }
            
            array_push($camposplanos, 'total');
            array_push($camposplanos, 'media');
            
            

            for ($i = $inicial; $i <= $final; $i+=$passo) {
                $vetor[$i]['inicio'] = str_pad(floor($i/60), 2, "0", STR_PAD_LEFT).':'.str_pad(($i%60), 2, "0", STR_PAD_LEFT);
                $temptermino = str_pad(floor(($i+$passo)/60), 2, "0", STR_PAD_LEFT).':'.str_pad((($i+$passo)%60), 2, "0", STR_PAD_LEFT);
                $vetor[$i]['termino'] = $temptermino;
                for ($d = 1; $d <= $dias; $d++) {
                     $vetor[$i][$d] = 0;
                }
                $vetor[$i]['total'] = 0;
                $vetor[$i]['media'] = 0;
            }
            
            for ($i = $inicial; $i <= $final; $i+=$passo) {
                $vetor[$i]['inicio'] = floor($i/60).':'.($i%60);
                $temptermino = floor(($i+$passo)/60).':'.(($i+$passo)%60);
                $vetor[$i]['termino'] = $temptermino;
                    foreach($dados as $registros){
                        $intervalo = $registros[0]['hora']*60 + $registros[0]['minuto'];
                        $minimo = $i;
                        $maximo = $i+$passo;
                        if($intervalo>=$minimo and $intervalo<=$maximo){
                            $d = date('j', strtotime($registros['Planos']['entrada']));
                            $vetor[$i][$d] = $vetor[$i][$d]+1;
                            $vetor[$i]['total'] += 1;
                        }
                    }
                    $media = $vetor[$i]['total']/$dias;
                    $vetor[$i]['media'] = $media;
            }

            
            $inicial = $this->data[$this->data['id']]['inicio'];
            $final = $this->data[$this->data['id']]['fim'];
            $intervalo = $this->data[$this->data['id']]['hora'].':'.$this->data[$this->data['id']]['minuto'];
            if($setor>0){
                $txtsetor = ",SETOR ($setor) ";
            }
            $titulo = "QUANTITATIVO MENSAL POR REGIÃO ($centro)$txtsetor, INÍCIO: $inicial, TÉRMINO: $final, INTERVALO: $intervalo";
            $titulo = iconv('UTF-8','ISO-8859-1',$titulo);
            $tabela = 'aditivosplanosets';
            $nome = 'planilha_quantitativo_mensal'.date('Ymd_his');
        }
	if ($this->data['id'] == 'R19a') {

            $centro = substr($this->data[$this->data['id']]['setor'], 0, 2);
            $setor = substr($this->data[$this->data['id']]['setor'], 2);

            $sqlinicio = "select *, day(entrada) dia, time(entrada) entrada, time(saida) saida
				from
				aditivosplanosets Planos 
				where 
                                month(data)={$this->data[$this->data['id']]['mes']} 
                                and year(data)={$this->data[$this->data['id']]['ano']} 
                                and cfl_entrada>={$this->data[$this->data['id']]['nivelinicial']}
                                and cfl_entrada<={$this->data[$this->data['id']]['nivelfinal']}
                                order by dia, entrada, indic, adep, ades, entrada, saida
                                ";

            $dados = $this->Aditivo->query($sqlinicio);

            $camposplanos = array();
            array_push($camposplanos, 'dia', 'entrada', 'saida', 'indic', 'tipo', 'adep', 'pto_entrada', 'pto_saida', 'cfl_entrada', 'cfl_saida', 'aerovia_entrada', 'aerovia_saida', 'centro');
            

            $i = 0;
            foreach ($dados as $registros) {
                $vetor[$i]['dia'] = $registros[0]['dia'];
                $vetor[$i]['entrada'] = $registros[0]['entrada'];
                $vetor[$i]['saida'] = $registros[0]['saida'];
                $vetor[$i]['indic'] = $registros['Planos']['indic'];
                $vetor[$i]['tipo'] = $registros['Planos']['tipo'];
                $vetor[$i]['adep'] = $registros['Planos']['adep'];
                $vetor[$i]['pto_entrada'] = $registros['Planos']['pto_entrada'];
                $vetor[$i]['pto_saida'] = $registros['Planos']['pto_saida'];
                $vetor[$i]['cfl_entrada'] = $registros['Planos']['cfl_entrada'];
                $vetor[$i]['cfl_saida'] = $registros['Planos']['cfl_saida'];
                $vetor[$i]['aerovia_entrada'] = $registros['Planos']['aerovia_entrada'];
                $vetor[$i]['aerovia_saida'] = $registros['Planos']['aerovia_saida'];
                $vetor[$i]['centro'] = $registros['Planos']['centro'];
                $i++;
            }


            $mes = $this->data[$this->data['id']]['mes'];
            $ano = $this->data[$this->data['id']]['ano'];
            $nvinicial = $this->data[$this->data['id']]['nivelinicial'];
            $nvfinal = $this->data[$this->data['id']]['nivelfinal'];
            $titulo = "MOVIMENTO MENSAL POR NÍVEL DE VÔO DO MÊS:$mes, ANO:$ano, NÍVEL INICIAL:$nvinicial, NÍVEL FINAL:$nvfinal";
            $titulo = iconv('UTF-8','ISO-8859-1',$titulo);

            $tabela = 'aditivosplanosets';
            $nome = 'planilha_nivel_voo'.date('Ymd_his');
        }
	if ($this->data['id'] == 'R19b') {

            $centro = substr($this->data[$this->data['id']]['setor'], 0, 2);
            $setor = substr($this->data[$this->data['id']]['setor'], 2);

            $camposplanos = array();
            array_push($camposplanos, 'dia', 'entrada', 'saida', 'indic', 'tipo', 'adep', 'pto_entrada', 'pto_saida', 'cfl_entrada', 'cfl_saida', 'aerovia_entrada', 'aerovia_saida', 'centro');

            $sqlinicio = "select *, day(entrada) dia, time(entrada) entrada, time(saida) saida
				from
				aditivosplanosets Planos 
				where 
                                SUBSTR(adep,1,2) <> 'SB' AND SUBSTR(ades,1,2) <> 'SB' AND SUBSTR(adep,1,2) <> 'SN' 
                                AND SUBSTR(ades,1,2) <> 'SN' AND SUBSTR(adep,1,2) <> 'SW' AND SUBSTR(ades,1,2) <> 'SW' 
                                AND SUBSTR(adep,1,2) <> 'SD' AND SUBSTR(ades,1,2) <> 'SD' AND SUBSTR(adep,1,2) <> 'SI' 
                                AND SUBSTR(ades,1,2) <> 'SI' AND SUBSTR(adep,1,2) <> 'SJ' AND SUBSTR(ades,1,2) <> 'SJ'            
                                and month(data)={$this->data[$this->data['id']]['mes']} 
                                and year(data)={$this->data[$this->data['id']]['ano']} 
                                order by dia, entrada, indic, adep, ades, saida
                                ";

            $dados = $this->Aditivo->query($sqlinicio);


            $i = 0;
            foreach ($dados as $registros) {
                $vetor[$i]['dia'] = $registros[0]['dia'];
                $vetor[$i]['entrada'] = $registros[0]['entrada'];
                $vetor[$i]['saida'] = $registros[0]['saida'];
                $vetor[$i]['indic'] = $registros['Planos']['indic'];
                $vetor[$i]['tipo'] = $registros['Planos']['tipo'];
                $vetor[$i]['adep'] = $registros['Planos']['adep'];
                $vetor[$i]['pto_entrada'] = $registros['Planos']['pto_entrada'];
                $vetor[$i]['pto_saida'] = $registros['Planos']['pto_saida'];
                $vetor[$i]['cfl_entrada'] = $registros['Planos']['cfl_entrada'];
                $vetor[$i]['cfl_saida'] = $registros['Planos']['cfl_saida'];
                $vetor[$i]['aerovia_entrada'] = $registros['Planos']['aerovia_entrada'];
                $vetor[$i]['aerovia_saida'] = $registros['Planos']['aerovia_saida'];
                $vetor[$i]['centro'] = $registros['Planos']['centro'];
                $i++;
            }


            $mes = $this->data[$this->data['id']]['mes'];
            $ano = $this->data[$this->data['id']]['ano'];
            $titulo = "MOVIMENTO MENSAL POR NÍVEL DE SOBREVÔO DO MÊS:$mes, ANO:$ano";
            $titulo = iconv('UTF-8','ISO-8859-1',$titulo);
            $tabela = 'aditivosplanosets';
            $nome = 'planilha_nivel_sobrevoo'.date('Ymd_his');

        }
	if ($this->data['id'] == 'R20') {

            $centro = substr($this->data[$this->data['id']]['setor'], 0, 2);
            $setor = substr($this->data[$this->data['id']]['setor'], 2);

            $camposplanos = array();
            array_push($camposplanos, 'data', 'dia', 'entrada', 'saida', 'indic', 'tipo', 'adep','ades', 'pto_entrada', 'pto_saida', 'cfl_entrada', 'cfl_saida', 'aerovia_entrada', 'aerovia_saida', 'centro');

            //$sqlinicio = "select *, day(entrada) dia, time(entrada) entrada, time(saida) saida from aditivosplanosets Planos  	where adep in ('SINQ', 'SNCC', 'SBMQ', 'SBOI', 'SBBE') and indic in ('PPBRV', 'PTVCD', 'PTRXF', 'PTKPD', 'PTRGO') and year(data)>2010  order by data, dia, entrada, indic, adep, ades, saida ";

            $sqlinicio = "select *, day(entrada) dia, time(entrada) entrada, time(saida) saida from aditivosplanosets Planos  	where indic='PTLGG' and (year(data)>=2007 and year(data)<=2008) order by data, dia, entrada, indic, adep, ades, saida ";

            //$sqlinicio = "select *, day(entrada) dia, time(entrada) entrada, time(saida) saida from aditivosplanosets Planos  where adep like '%{$this->data[$this->data['id']]['adep']}%'  and indic like '%{$this->data[$this->data['id']]['indic']}%'  and year(data)={$this->data[$this->data['id']]['ano']} order by dia, entrada,  indic, adep, ades, saida ";

            //echo $sqlinicio;
            $dados = $this->Aditivo->query($sqlinicio);
            
            $quantidade = count($dados);


            $i = 0;
            foreach ($dados as $registros) {
                $vetor[$i]['data'] = $registros['Planos']['data'];
                $vetor[$i]['dia'] = $registros[0]['dia'];
                $vetor[$i]['entrada'] = $registros[0]['entrada'];
                $vetor[$i]['saida'] = $registros[0]['saida'];
                $vetor[$i]['indic'] = $registros['Planos']['indic'];
                $vetor[$i]['tipo'] = $registros['Planos']['tipo'];
                $vetor[$i]['adep'] = $registros['Planos']['adep'];
                $vetor[$i]['ades'] = $registros['Planos']['ades'];
                $vetor[$i]['pto_entrada'] = $registros['Planos']['pto_entrada'];
                $vetor[$i]['pto_saida'] = $registros['Planos']['pto_saida'];
                $vetor[$i]['cfl_entrada'] = $registros['Planos']['cfl_entrada'];
                $vetor[$i]['cfl_saida'] = $registros['Planos']['cfl_saida'];
                $vetor[$i]['aerovia_entrada'] = $registros['Planos']['aerovia_entrada'];
                $vetor[$i]['aerovia_saida'] = $registros['Planos']['aerovia_saida'];
                $vetor[$i]['centro'] = $registros['Planos']['centro'];
                $i++;
            }
            
            if($quantidade<1){
                $vetor[0]['data'] = 'Nenhum registro encontrado com os criterios informados';
                $vetor[0]['dia'] = '';
                $vetor[0]['entrada'] = '';
                $vetor[0]['saida'] = '';
                $vetor[0]['indic'] = '';
                $vetor[0]['tipo'] = '';
                $vetor[0]['adep'] = '';
                $vetor[0]['ades'] = '';
                $vetor[0]['pto_entrada'] = '';
                $vetor[0]['pto_saida'] = '';
                $vetor[0]['cfl_entrada'] = '';
                $vetor[0]['cfl_saida'] = '';
                $vetor[0]['aerovia_entrada'] = '';
                $vetor[0]['aerovia_saida'] = '';
                $vetor[0]['centro'] = '';
                
            }



            $adep = $this->data[$this->data['id']]['adep'];
            $ano = $this->data[$this->data['id']]['ano'];
            $indic = $this->data[$this->data['id']]['indic'];
            $titulo = "LOCALIZAR AERONAVE DO ANO:$ano COM ADEP:$adep E INDIC:$indic";
            $titulo = iconv('UTF-8','ISO-8859-1',$titulo);
            $tabela = 'aditivosplanosets';
            $nome = 'planilha_localizar_aeronave'.date('Ymd_his');
        }
        
        
	if ($this->data['id'] == 'R21') {

            $inicio = $this->data[$this->data['id']]['ano'].'-'.$this->data[$this->data['id']]['mes'].'-'.$this->data[$this->data['id']]['dia'].' '.$this->data[$this->data['id']]['horainicio'].':'.$this->data[$this->data['id']]['minutoinicio'];
            $termino = $this->data[$this->data['id']]['ano'].'-'.$this->data[$this->data['id']]['mes'].'-'.$this->data[$this->data['id']]['dia'].' '.$this->data[$this->data['id']]['horatermino'].':'.$this->data[$this->data['id']]['minutotermino'];
            
            $centro = substr($this->data[$this->data['id']]['setor'], 0, 2);
            $setor = substr($this->data[$this->data['id']]['setor'], 2);

            $camposplanos = array();
            array_push($camposplanos, 'dia', 'entrada', 'saida', 'indic', 'tipo', 'adep', 'pto_entrada', 'pto_saida', 'cfl_entrada', 'cfl_saida', 'aerovia_entrada', 'aerovia_saida', 'centro');

            $sqlinicio = "select *, day(entrada) dia, time(entrada) entrada, time(saida) saida
				from
				aditivosplanosets Planos 
				where 
                                entrada >='$inicio'
                                and saida<='$termino'
                                and day(data)={$this->data[$this->data['id']]['dia']} 
                               and month(data)={$this->data[$this->data['id']]['mes']} 
                               and year(data)={$this->data[$this->data['id']]['ano']} 
                                order by dia, entrada, indic, adep, ades, saida
                                ";

            $dados = $this->Aditivo->query($sqlinicio);


            $i = 0;
            foreach ($dados as $registros) {
                $vetor[$i]['dia'] = $registros[0]['dia'];
                $vetor[$i]['entrada'] = $registros[0]['entrada'];
                $vetor[$i]['saida'] = $registros[0]['saida'];
                $vetor[$i]['indic'] = $registros['Planos']['indic'];
                $vetor[$i]['tipo'] = $registros['Planos']['tipo'];
                $vetor[$i]['adep'] = $registros['Planos']['adep'];
                $vetor[$i]['pto_entrada'] = $registros['Planos']['pto_entrada'];
                $vetor[$i]['pto_saida'] = $registros['Planos']['pto_saida'];
                $vetor[$i]['cfl_entrada'] = $registros['Planos']['cfl_entrada'];
                $vetor[$i]['cfl_saida'] = $registros['Planos']['cfl_saida'];
                $vetor[$i]['aerovia_entrada'] = $registros['Planos']['aerovia_entrada'];
                $vetor[$i]['aerovia_saida'] = $registros['Planos']['aerovia_saida'];
                $vetor[$i]['centro'] = $registros['Planos']['centro'];
                $i++;
            }

            $dia = $this->data[$this->data['id']]['dia'];
            $ano = $this->data[$this->data['id']]['ano'];
            $mes = $this->data[$this->data['id']]['mes'];
            $titulo = "LISTA PERSONALIZADA DO ANO:$ano , MÊS:$mes, DIA:$dia COM INÍCIO:$inicio E TÉRMINO:$termino";
            $titulo = iconv('UTF-8','ISO-8859-1',$titulo);
            $tabela = 'aditivosplanosets';
            $nome = 'planilha_personalizada'.date('Ymd_his');
        }
        
		
	//$this->set('vetor',$vetor);

            if(!empty($vetor)){
                $this->layout = 'excel';
            }
            if(!empty($conteudo)){
                $this->layout = null;
            }
		
		//echo $sql;

		//print_r($this->data);exit();

		$this->set(compact('titulo','tabela','vetor','nome','conteudo','camposplanos'));
		$this->render();
		
	}
	
	
	
	function externopdf(){
		$sql = '';
		$this->layout = 'pdf';

		if($this->data['id']=='R8'){
                    $sql = '';
			if($this->data[$this->data['id']]['organizacao_tecnico']>0){
				$sql .= ' and Unidade.id='.$this->data[$this->data['id']]['organizacao_tecnico'];
			}
			if($this->data[$this->data['id']]['tipo_licenca']!='0'){
				$sql .= ' and Licenca.tipo_licenca="'.$this->data[$this->data['id']]['tipo_licenca'].'"';
			}
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.id in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
			
			if(!empty($this->data[$this->data['id']]['licenca_inicial'])){
				$sql .= ' and Militar.nr_licenca>='.$this->data[$this->data['id']]['licenca_inicial'].' ';
			}
			if(!empty($this->data[$this->data['id']]['licenca_final'])){
				$sql .= ' and Militar.nr_licenca<='.$this->data[$this->data['id']]['licenca_final'].' ';
			}
			
			if(!empty($this->data[$this->data['id']]['admissao_inicio'])){
				$sql .= ' and Habilitacao.dt_concessao>="'.$this->data[$this->data['id']]['admissao_inicio'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['admissao_termino'])){
				$sql .= ' and Habilitacao.dt_concessao<="'.$this->data[$this->data['id']]['admissao_termino'].'" ';
			}
			
//		echo $sql;exit();
			$destino='Habilitacao';
			#$this->Aditivo->Habilitacao->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
			#$this->Aditivo->Habilitacao->Militar->bindModel(array('belongsTo'=>array('Setor','Especialidade','Posto','Unidade')));
//			$this->Aditivo->Habilitacao->recursive = 1;

			//$habilitacaos=$this->Aditivo->Habilitacao->find('all',array('conditions'=>array($sql)));
//			$this->Aditivo->Habilitacao->limit=10;
$sql = "
select Militar.id, group_concat('|', Militar.id,',', Habilitacao.cht,',', Habilitacao.validade_cht,',', Habilitacao.nome_emitente, '|') habilitacao, Militar.nm_completo, Militar.nr_licenca, NivelInglesFase02.banda, NivelInglesFase02.pronuncia, NivelInglesFase02.estrutura,
NivelInglesFase02.vocabulario, NivelInglesFase02.fluencia ,NivelInglesFase02.compreensao, NivelInglesFase02.interacao, Licenca.tipo_licenca,  NivelInglesFase02.dt_realizacao
from habilitacaos Habilitacao
inner join militars Militar on (Militar.id=Habilitacao.militar_id)
inner join licencas Licenca on (Licenca.militar_id=Militar.id)
inner join unidades Unidade on (Unidade.id=Militar.unidade_id)
left join nivel_ingles_fase02s NivelInglesFase02 on (NivelInglesFase02.militar_id=Militar.id) 
left join setors Setor on (Setor.id=Militar.setor_id)  where 1=1 $sql 
group by Militar.id
order by Militar.nm_completo asc, NivelInglesFase02.dt_realizacao desc 
                         ";
                        
                        

			$habilitados=$this->Aditivo->query($sql);
                        //echo $sql;exit();
                        //echo '<pre>';	print_r($habilitados); echo '</pre>';    exit();
			
			$conta=0;
                        $repeticao[0]=0;
                        
			foreach($habilitados as $dados){
                                $indices = $dados['Militar']['id'];
                                if(!isset($repeticao[$indices])){
                                    $repeticao[$indices]=1;
                                    $habilitacaos[$conta]['nome']=$dados['Militar']['nm_completo'];
                                    $habilitacaos[$conta]['licenca']=$dados['Militar']['nr_licenca'];
                                    $habilitacaos[$conta]['tipo_licenca']=$dados['Licenca']['tipo_licenca'];
                                    
                                    $habilitacaos[$conta]['cht']=$dados['Habilitacao']['cht'];
                                    $habilitacaos[$conta]['nome_emitente']=$dados['Habilitacao']['nome_emitente'];
                                    
                                    //Realizar criacao do vetor numerado contendo  cht, validade_cht, nome_emitente  $habilitacao[$conta]['habilitacao'][0]
                                    $habilitacoes = $dados[0]['habilitacao'];
                                    $vetorhabilitacoes = explode('|',$habilitacoes);
                                    $contagemhabilitacoes= array_unique($vetorhabilitacoes);
                                   // echo '<pre>'; 	print_r($novovetor);  echo '</pre><hr>';
                                    
                                    $contagem = 0;

                                    foreach($contagemhabilitacoes as $duplicados){
                                        if($duplicados!='' && $duplicados!=','){
                                            //echo '<pre>';
                                            //echo $duplicados;
                                            $colunas = explode(',',$duplicados);
                                           // print_r($colunas);
                                            $habilitacaos[$conta]['Habilitacao'][$contagem]['habilitacao'] = $colunas[1];
                                            $habilitacaos[$conta]['Habilitacao'][$contagem]['validade'] = $colunas[2];
                                            $habilitacaos[$conta]['Habilitacao'][$contagem]['emitente'] = $colunas[3];
                                            $contagem++;
                                            //echo '</pre><hr>';
                                        }
                                    }
                                   // echo '<pre>'; 	print_r($habilitacaos);  echo '</pre><hr>';
                                    
                                    if(!empty($dados['Habilitacao']['validade_cht'])){
                                            $habilitacaos[$conta]['validade_cht']=date('d-m-Y',strtotime($dados['Habilitacao']['validade_cht']));
                                    }else{
                                            $habilitacaos[$conta]['validade_cht']='';
                                    }
                                    $menor=20;
                                    if($dados['NivelInglesFase02']['banda']<$menor){
                                        $menor=$dados['NivelInglesFase02']['banda'];
                                    }
                                    if($dados['NivelInglesFase02']['pronuncia']<$menor){
                                        $menor=$dados['NivelInglesFase02']['pronuncia'];
                                    }
                                    if($dados['NivelInglesFase02']['estrutura']<$menor){
                                        $menor=$dados['NivelInglesFase02']['estrutura'];
                                    }
                                    if($dados['NivelInglesFase02']['vocabulario']<$menor){
                                        $menor=$dados['NivelInglesFase02']['vocabulario'];
                                    }
                                    if($dados['NivelInglesFase02']['fluencia']<$menor){
                                        $menor=$dados['NivelInglesFase02']['fluencia'];
                                    }
                                    if($dados['NivelInglesFase02']['compreensao']<$menor){
                                        $menor=$dados['NivelInglesFase02']['compreensao'];
                                    }
                                    if($dados['NivelInglesFase02']['interacao']<$menor){
                                        $menor=$dados['NivelInglesFase02']['interacao'];
                                    }
                                    if($menor!=20){
                                        $diferencadata = round((strtotime('now') - strtotime($dados['NivelInglesFase02']['dt_realizacao']))/60/60/24/365);
                                        $somadatanivel4 = date('m/Y',strtotime($dados['NivelInglesFase02']['dt_realizacao'])+60*60*24*365*3);
                                        $somadatanivel5 = date('m/Y',strtotime($dados['NivelInglesFase02']['dt_realizacao'])+60*60*24*365*6);
                                        $nivelingles = $menor;
                                        if($menor<=3 && $diferencadata>1){
                                            $nivelingles = 'ND';
                                        }
                                        if($menor<=3 && $diferencadata<=1){
                                            $nivelingles = $menor;
                                        }
                                        if($menor==4 && $diferencadata<=3){
                                            $nivelingles = $menor.' - '.$somadatanivel4.'';
                                        }
                                        if($menor==4 && $diferencadata>3){
                                            $nivelingles = 'ND';
                                        }
                                        if($menor==5 && $diferencadata<=6){
                                            $nivelingles = $menor.' - '.$somadatanivel5.'';
                                        }
                                        if($menor==5 && $diferencadata>6){
                                            $nivelingles = 'ND';
                                        }
                                        $habilitacaos[$conta]['ingles']=$nivelingles;
                                    }else{
                                        $habilitacaos[$conta]['ingles']='ND';
                                    }
                                    $conta++;
                                    
                                }
			}
			//print_r($repeticao);exit();
			
			$this->set(compact('habilitacaos',$habilitacaos));
		}
		
			
		if($this->data['id']=='R7'){
			if($this->data[$this->data['id']]['organizacao_tecnico']>0){
				$sql .= ' and Licenca.unidade_id='.$this->data[$this->data['id']]['organizacao_tecnico'];
			}
			if(!empty($this->data[$this->data['id']]['setor'][0])){
				$sql .= ' and Setor.id in ('.$this->data[$this->data['id']]['setor'][0].') ';
			}
			if(!empty($this->data[$this->data['id']]['tipo_licenca'][0])){
				$sql .= ' and locate(Licenca.tipo_licenca,\''.$this->data[$this->data['id']]['tipo_licenca'][0].'\')>0 ';
			}
			
			if(!empty($this->data[$this->data['id']]['licenca_inicial'])){
				$sql .= ' and Licenca.nr_licenca>='.$this->data[$this->data['id']]['licenca_inicial'].' ';
			}
			if(!empty($this->data[$this->data['id']]['licenca_final'])){
				$sql .= ' and Licenca.nr_licenca<='.$this->data[$this->data['id']]['licenca_final'].' ';
			}
			
			if(!empty($this->data[$this->data['id']]['expedicao_inicio'])){
				$sql .= ' and Licenca.expedicao>="'.$this->data[$this->data['id']]['expedicao_inicio'].'" ';
			}
			if(!empty($this->data[$this->data['id']]['expedicao_termino'])){
				$sql .= ' and Licenca.expedicao<="'.$this->data[$this->data['id']]['expedicao_termino'].'" ';
			}
			
		
		$destino='Licenca';
			$this->Aditivo->bindModel(array('hasMany'=>array('Licenca'=>array('foreignKey' => false, 'dependent' => false, 'conditions' => array('Licenca.nr_licenca>1000')))));
			$resultados = $this->Aditivo->Licenca->find(array($sql));
			foreach($resultados as $chave=>$valor){
				$militares[] = $valor['Militar']['id']; 
			}
			$efetivo = implode(',',$militares);
			$this->Aditivo->Licenca->unbindModel(array('belongsTo'=>array('Ata','Boletiminterno','Unidade')));
			$this->Aditivo->Licenca->Carimbo->unbindModel(array('hasMany'=>array('Licenca'),'belongsTo'=>array('Militar')));
			$this->Aditivo->Licenca->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Curso','Escala'), 'hasOne'=>array('Assinatura'),'hasMany'=>array('Afastamento','Atividade','Atividade', 'Exame', 'Habilitacao', 'Paeatsindicado')));
			$this->Aditivo->Licenca->Militar->bindModel(array('belongsTo'=>array('Setor','Especialidade','Posto','Unidade')));
			$this->Aditivo->Licenca->recursive = 2;

			$licencas=$this->Aditivo->Licenca->find('all',array('conditions'=>array($sql)));
			$this->set(compact('licencas',$licencas));
		}
		$this->set(compact('destino',$destino));
		$this->render();
	}
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        function externograficos() {

            $this->Aditivo->recursive = 0;
            $aerovias = "select  Aditivosplanoset.aerovia_entrada
                    from aditivosplanosets Aditivosplanoset
                    group by Aditivosplanoset.aerovia_entrada order by Aditivosplanoset.aerovia_entrada  ";
            $optionentrada = $this->Aditivo->query($aerovias);
            foreach($optionentrada as $dadoentrada){
                $optionsentrada[$dadoentrada['Aditivosplanoset']['aerovia_entrada']]=$dadoentrada['Aditivosplanoset']['aerovia_entrada'];
            }

            $aerovias = "select  Aditivosplanoset.aerovia_saida
                    from aditivosplanosets Aditivosplanoset
                    group by Aditivosplanoset.aerovia_saida order by  Aditivosplanoset.aerovia_saida";
            $optionsaida = $this->Aditivo->query($aerovias);
            foreach($optionsaida as $dadosaida){
                $optionssaida[$dadosaida['Aditivosplanoset']['aerovia_saida']]=$dadosaida['Aditivosplanoset']['aerovia_saida'];
            }
            
            $this->set(compact('optionsentrada', 'optionssaida'));
            
            $this->data['R171']['dtreferencia'] = $this->data['R171']['ano'].'-'.$this->data['R171']['mes'].'-'.$this->data['R171']['dia'];
            
            
        if (!empty($this->data['id'])) {

                //echo '<pre>';print_r($this->data);echo '</pre>';
            
                //$tratamento = array('fields' => array(' hour(Aditivosplanoset.entrada) hora, minute(Aditivosplanoset.entrada) minuto, Aditivosplanoset.aerovia_entrada, Aditivosplanoset.aerovia_saida '), 'where' => array('year(Aditivosplanoset.data)=2011 and and (aerovia_entrada=\'UL304\' or aerovia_entrada=\'UZ24\')'));
                $tratamento = "select  hour(Aditivosplanoset.entrada) hora, minute(Aditivosplanoset.entrada) minuto, Aditivosplanoset.aerovia_entrada, Aditivosplanoset.aerovia_saida  
                    from aditivosplanosets Aditivosplanoset where year(Aditivosplanoset.data)={$this->data['R23']['ano']} and (aerovia_entrada='{$this->data['R23']['aeroviaentrada01']}' or aerovia_entrada='{$this->data['R23']['aeroviaentrada02']}') ";
                //$dadosplanilha = $this->Aditivo->Aditivosplanoset->find('all', $tratamento);
                $dadosplanilha = $this->Aditivo->query($tratamento);
 
               // echo '<pre>';print_r($dadosplanilha);exit();


            for ($i = 0; $i <= 1440; $i+=30) {
                $vetor[$this->data['R23']['aeroviaentrada01']][$i] = 0;
                $vetor[$this->data['R23']['aeroviaentrada02']][$i] = 0;
                $vetor['SOMA'][$indice] = 0;
            }

            foreach ($dadosplanilha as $row) {
                $indice = $row[0]['hora'] * 60;
                if ($row[0]['minuto'] > 30) {
                    $indice += 30;
                }
                if ($row['Aditivosplanoset']['aerovia_entrada'] == $this->data['R23']['aeroviaentrada01'] || $row['Aditivosplanoset']['aerovia_saida'] == $this->data['R23']['aeroviaentrada01']) {
                    $vetor[$this->data['R23']['aeroviaentrada01']][$indice] = $vetor[$this->data['R23']['aeroviaentrada01']][$indice] + 1;
                }
                if ($row['Aditivosplanoset']['aerovia_entrada'] == $this->data['R23']['aeroviaentrada02'] || $row['Aditivosplanoset']['aerovia_saida'] == $this->data['R23']['aeroviaentrada02']) {
                    $vetor[$this->data['R23']['aeroviaentrada02']][$indice] = $vetor[$this->data['R23']['aeroviaentrada02']][$indice] + 1;
                }

                $vetor['SOMA'][$indice] = $vetor['SOMA'][$indice] + 1;
            }


            $strXML = "<graph caption='Voos realizados em 2011' subcaption='(jan/{$this->data['R23']['ano']} até dez/{$this->data['R23']['ano']})' hovercapbg='FFECAA'  hovercapborder='F47E00' formatNumberScale='0' decimalPrecision='0' showvalues='0' numdivlines='3' numVdivlines='0' yaxisminvalue='1000' yaxismaxvalue='1800'  rotateNames='1'><categories ><category name='00:00' /><category name='00:30' /><category name='01:00' /><category name='01:30' /><category name='02:00' /><category name='02:30' /><category name='03:00' /><category name='03:30' /><category name='04:00' /><category name='04:30' /><category name='05:00' /><category name='05:30' /><category name='06:00' /><category name='06:30' /><category name='07:00' /><category name='07:30' /><category name='08:00' /><category name='08:30' /><category name='09:00' /><category name='09:30' /><category name='10:00' /><category name='10:30' /><category name='11:00' /><category name='11:30' /><category name='12:00' /><category name='12:30' /><category name='13:00' /><category name='13:30' /><category name='14:00' /><category name='14:30' /><category name='15:00' /><category name='15:30' /><category name='16:00' /><category name='16:30' /><category name='17:00' /><category name='17:30' /><category name='18:00' /><category name='18:30' /><category name='19:00' /><category name='19:30' /><category name='20:00' /><category name='20:30' /><category name='21:00' /><category name='21:30' /><category name='22:00' /><category name='22:30' /><category name='23:00' /><category name='23:30' /><category name='24:00' /></categories><dataset seriesName='{$this->data['R23']['aeroviaentrada02']}' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";


            for ($i = 0; $i <= 1440; $i+=30) {
                $strXML .= "<set value='{$vetor[$this->data['R23']['aeroviaentrada02']][$i]}' />";
            }

            $strXML .="</dataset><dataset seriesName='{$this->data['R23']['aeroviaentrada01']}' color='802020' anchorBorderColor='802020' anchorBgColor='802020'>";

            for ($i = 0; $i <= 1440; $i+=30) {
                $strXML .= "<set value='{$vetor[$this->data['R23']['aeroviaentrada01']][$i]}' />";
            }

            $strXML .="</dataset><dataset seriesName='SOMA' color='000000' anchorBorderColor='000000' anchorBgColor='000000'>";

            for ($i = 0; $i <= 1440; $i+=30) {
                $strXML .= "<set value='{$vetor['SOMA'][$i]}' />";
            }

            $strXML .= "</dataset></graph>";
            
            //$strXML = iconv('UTF-8','ISO-8859-1',$strXML);


            $this->set(compact('strXML'));
        }





        if (!empty($this->data['R171'])) {

            if ($this->data['R171']['tipo'] == 4) {


                $tratamento = array('fields' => array('Aditivosplanosetor.setor, sum(Aditivosplanosetor.qtd) , year(Aditivosplanosetor.data), month(Aditivosplanosetor.data) '), 'group' => array('year(Aditivosplanosetor.data), month(Aditivosplanosetor.data), Aditivosplanosetor.setor'), 'order' => array('Aditivosplanosetor.data asc, Aditivosplanosetor.setor asc'));
                $dadosplanilha = $this->Aditivo->Aditivosplanosetor->find('all', $tratamento);
                foreach ($dadosplanilha as $categoria) {
                    $categorias[$categoria[0]['year(Aditivosplanosetor.data)'] . '/' . $categoria[0]['month(Aditivosplanosetor.data)']] = $categoria[0]['month(Aditivosplanosetor.data)'] . '/' . $categoria[0]['year(Aditivosplanosetor.data)'];
                    $series[$categoria['Aditivosplanosetor']['setor']][$categoria[0]['year(Aditivosplanosetor.data)'] . '/' . $categoria[0]['month(Aditivosplanosetor.data)']] = $categoria[0]["sum(`Aditivosplanosetor`.`qtd`)"];
                }
                $r = rand(0, 5);
                $g = rand(0, 5);
                $b = rand(0, 5);
                $vetor = array('00', '33', '66', '99', 'cc', 'ff');
                $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];

                $categoria = array_unique($categoria);
                $grafico = $this->webroot . 'js/FCF_StackedBar2D.swf';
                $xmlcategories = '<categories>' . "\n";
                foreach ($categorias as $chave => $rotulo) {
                    $xmlcategories .= '<category name=\'' . $rotulo . '\'/>' . "\n";
                }
                $xmlcategories .= '</categories>' . "\n";


                foreach ($series as $setor => $dados) {
                    $r = rand(0, 5);
                    $g = rand(0, 5);
                    $b = rand(0, 5);
                    $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];
                    $xmlseries .= '<dataset seriesName=\'' . $setor . '\' color=\'' . $hexa . '\' showValues=\'0\'>' . "\n";
                    foreach ($dados as $chave => $qtd) {
                        $xmlseries .= '<set value=\'' . $qtd . '\'/>' . "\n";
                    }
                    $xmlseries .= '</dataset>' . "\n";
                }

                $xmlseries .= '</graph>' . "\n";


                $xmlChart = <<<XML
<graph xAxisName='Meses' yAxisName='Quantidade' caption='Planos por Setor' subCaption=''  decimalPrecision='0' numDivLines='12' numberPrefix='' showValues='0'>
$xmlcategories
$xmlseries        
XML;


//                $grafico = $this->webroot.'js/FCF_StackedBar2D.swf';
                $grafico = $this->webroot . 'js/FCF_MSColumn2D.swf';
                $nomeXML = 'webroot/xml/relatorio4.xml';
            }

            if ($this->data['R171']['tipo'] == 2) {


                $tratamento = array('fields' => array(' year(Aditivosplanodia.data),month(Aditivosplanodia.data), sum(Aditivosplanodia.ativados) , sum(Aditivosplanodia.naoativados) '), 'group' => array('year(Aditivosplanodia.data), month(Aditivosplanodia.data)'), 'order' => array('Aditivosplanodia.data asc'));
                $dadosplanilha = $this->Aditivo->Aditivosplanodia->find('all', $tratamento);
                //echo '<pre>';
                //print_r($dadosplanilha);echo '</pre>';
                foreach ($dadosplanilha as $categoria) {
                    $categorias[$categoria[0]['year(`Aditivosplanodia`.`data`)'] . '/' . $categoria[0]['month(Aditivosplanodia.data)']] = $categoria[0]['month(Aditivosplanodia.data)'] . '/' . $categoria[0]['year(`Aditivosplanodia`.`data`)'];
                    $series['ativados'][$categoria[0]['month(Aditivosplanodia.data)'] . '/' . $categoria[0]['year(`Aditivosplanodia`.`data`)']] = $categoria[0]["sum(Aditivosplanodia.ativados)"];
                    $series['naoativados'][$categoria[0]['month(Aditivosplanodia.data)'] . '/' . $categoria[0]['year(`Aditivosplanodia`.`data`)']] = $categoria[0]["sum(Aditivosplanodia.naoativados)"];
                }
                // echo '<pre>';
                // print_r($series);echo '</pre>';
                $r = rand(0, 5);
                $g = rand(0, 5);
                $b = rand(0, 5);
                $vetor = array('00', '33', '66', '99', 'cc', 'ff');
//                $vetor = array('00','66','7f','cc', 'ff');
                $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];

                // $categoria =array_unique($categoria);
                $grafico = $this->webroot . 'js/FCF_MSColumn2D.swf';

                $xmlcategories = '<categories>' . "\n";
                foreach ($categorias as $chave => $rotulo) {
                    $xmlcategories .= '<category name=\'' . $chave . '\'/>' . "\n";
                }
                $xmlcategories .= '</categories>' . "\n";
                $xmlseries = '';

                $xmlseries .= '<dataset seriesName=\'Ativados\' color=\'' . $hexa . '\'>' . "\n";
                foreach ($series['ativados'] as $setor => $dados) {
                    $xmlseries .= '<set value=\'' . $dados . '\'/>' . "\n";
                }
                $xmlseries .= '</dataset>' . "\n";

                $r = rand(0, 5);
                $g = rand(0, 5);
                $b = rand(0, 5);
                $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];

                $xmlseries .= '<dataset seriesName=\'Nao Ativados\' color=\'' . $hexa . '\'>' . "\n";
                foreach ($series['naoativados'] as $setor => $dados) {
                    $xmlseries .= '<set value=\'' . $dados . '\'/>' . "\n";
                }
                $xmlseries .= '</dataset>' . "\n";



                $xmlseries .= '</graph>' . "\n";

                $titulo = date('m/Y', strtotime($this->data['R171']['dtreferencia']));
                $mm = utf8_decode('Mês');
                $xmlChart = <<<XML
<graph xaxisname='$mm' yaxisname='Quantidade' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' yAxisMaxValue='100' numdivlines='9' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC' caption='Planos diarios $titulo' subcaption='Agrupados por mes' >
$xmlcategories
$xmlseries        
XML;


                $grafico = $this->webroot . 'js/FCF_MSColumn2D.swf';
                $nomeXML = 'webroot/xml/relatorio2.xml';


                $tratamento2 = array('conditions' => array('and' => array('month(Aditivosplanodia.data)' => date('m', strtotime($this->data['R171']['dtreferencia'])), 'year(Aditivosplanodia.data)' => date('Y', strtotime($this->data['R171']['dtreferencia'])))), 'fields' => array(' year(Aditivosplanodia.data),month(Aditivosplanodia.data),day(Aditivosplanodia.data), sum(Aditivosplanodia.ativados) , sum(Aditivosplanodia.naoativados) '), 'group' => array('year(Aditivosplanodia.data), month(Aditivosplanodia.data), day(Aditivosplanodia.data)'), 'order' => array('Aditivosplanodia.data asc'));
                $dadosplanilha2 = $this->Aditivo->Aditivosplanodia->find('all', $tratamento2);
                //echo '<pre>';
                //print_r($dadosplanilha2);echo '</pre>';
                foreach ($dadosplanilha2 as $categoria) {
                    $categorias2[$categoria[0]['day(Aditivosplanodia.data)']] = $categoria[0]['day(Aditivosplanodia.data)'];
                    $series2['ativados'][$categoria[0]['day(Aditivosplanodia.data)']] = $categoria[0]["sum(Aditivosplanodia.ativados)"];
                    $series2['naoativados'][$categoria[0]['day(Aditivosplanodia.data)']] = $categoria[0]["sum(Aditivosplanodia.naoativados)"];
                }
                $r = rand(0, 5);
                $g = rand(0, 5);
                $b = rand(0, 5);
                $vetor = array('00', '33', '66', '99', 'cc', 'ff');
//                $vetor = array('00','66','7f','cc', 'ff');
                $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];

                $xmlcategories2 = '<categories>' . "\n";


                foreach ($categorias2 as $indice => $dados) {
                    $xmlcategories2 .= '<category name=\'' . $dados . '\'/>' . "\n";
                }
                $xmlcategories2 .= '</categories>' . "\n";
                $xmlseries2 = '';

                $xmlseries2 .= '<dataset seriesName=\'Ativados\' color=\'' . $hexa . '\'>' . "\n";
                foreach ($series2['ativados'] as $setor => $dados) {
                    $xmlseries2 .= '<set value=\'' . $dados . '\'/>' . "\n";
                }
                $xmlseries2 .= '</dataset>' . "\n";

                //echo '<pre>';
                //print_r($series2);echo '</pre>';
                $r = rand(0, 5);
                $g = rand(0, 5);
                $b = rand(0, 5);
                $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];

                $xmlseries2 .= '<dataset seriesName=\'Nao Ativados\' color=\'' . $hexa . '\'>' . "\n";
                foreach ($series2['naoativados'] as $setor => $dados) {
                    $xmlseries2 .= '<set value=\'' . $dados . '\'/>' . "\n";
                }
                $xmlseries2 .= '</dataset>' . "\n";



                $xmlseries2 .= '</graph>' . "\n";
                $titulo = date('m/Y', strtotime($this->data['R171']['dtreferencia']));


                $xmlChart2 = <<<XML
<graph xaxisname='Dia' yaxisname='Quantidade' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' yAxisMaxValue='100' numdivlines='9' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC' caption='Planos diarios' subcaption='Mes:$titulo' >
$xmlcategories2
$xmlseries2        
XML;


                $grafico2 = $this->webroot . 'js/FCF_MSColumn2D.swf';
                $nomeXML2 = 'webroot/xml/relatorio21.xml';
                $this->set(compact('grafico2', 'nomeXML2'));

                $caminho = substr(__FILE__, 0, strrpos(__FILE__, '/'));
                $caminho = str_replace('controllers', '', $caminho);

                $manip = fopen($caminho . $nomeXML2, 'w');
                fwrite($manip, $xmlChart2, strlen($xmlChart2));
                fclose($manip);
            }

            if ($this->data['R171']['tipo'] == 3) {


                $tratamento = array('conditions' => array(' Aditivosplanohora.data' => $this->data['R171']['dtreferencia']), 'fields' => array(' Aditivosplanohora.data,Aditivosplanohora.hora, sum(Aditivosplanohora.qtd)  '), 'group' => array('Aditivosplanohora.data, Aditivosplanohora.hora'), 'order' => array('Aditivosplanohora.data asc, Aditivosplanohora.hora asc'));
                $dadosplanilha = $this->Aditivo->Aditivosplanohora->find('all', $tratamento);
                //echo '<pre>';
                //print_r($dadosplanilha);echo '</pre>';
                foreach ($dadosplanilha as $categoria) {
                    $categorias[$categoria['Aditivosplanohora']['hora']] = $categoria[0]['sum(`Aditivosplanohora`.`qtd`)'];
                }
                // echo '<pre>';
                // print_r($categorias);echo '</pre>';
                $r = rand(0, 5);
                $g = rand(0, 5);
                $b = rand(0, 5);
                $vetor = array('00', '33', '66', '99', 'cc', 'ff');
//               $vetor = array('00','66','7f','cc', 'ff');
                $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];

                $grafico = $this->webroot . 'js/FCF_MSColumn2D.swf';

                $xmlcategories = '<categories>' . "\n";
                foreach ($categorias as $chave => $qtd) {
                    $xmlcategories .= '<category name=\'' . $chave . '\'/>' . "\n";
                }
                $xmlcategories .= '</categories>' . "\n";

                //echo '<pre>';
                //print_r($categorias);echo '</pre>';
                $xmlseries = '';

                $xmlseries .= '<dataset seriesname=\'Planos de voo\' color=\'FF5904\' showValues=\'0\' areaAlpha=\'50\' showAreaBorder=\'1\' areaBorderThickness=\'2\' areaBorderColor=\'FF0000\'>' . "\n";
                foreach ($categorias as $chave => $qtd) {
                    $xmlseries .= '<set value=\'' . $qtd . '\'/>' . "\n";
                }
                $xmlseries .= '</dataset>' . "\n";

                $r = rand(0, 5);
                $g = rand(0, 5);
                $b = rand(0, 5);
                $hexa = $vetor[$r] . $vetor[$g] . $vetor[$b];





                $xmlseries .= '</graph>' . "\n";

                $titulo = date('d-m-Y', strtotime($this->data['R171']['dtreferencia']));
                $xmlChart = <<<XML
<graph caption='Demonstrativo do dia' subcaption='$titulo' divlinecolor='F47E00' numdivlines='4' showAreaBorder='1' areaBorderColor='000000' numberPrefix='' showNames='1' numVDivLines='29' vDivLineAlpha='30' formatNumberScale='1' rotateNames='1'  decimalPrecision='0'>        
$xmlcategories
$xmlseries        
XML;


                $grafico = $this->webroot . 'js/FCF_MSArea2D.swf';
                $nomeXML = 'webroot/xml/relatorio3.xml';
            }


            $this->set(compact('grafico', 'nomeXML'));

            $caminho = substr(__FILE__, 0, strrpos(__FILE__, '/'));
            $caminho = str_replace('controllers', '', $caminho);

            $manip = fopen($caminho . $nomeXML, 'w');
            fwrite($manip, $xmlChart, strlen($xmlChart));
            fclose($manip);

            if ($this->data['R171']['tipo'] == 2) {
                
            }

            if ($this->data['R171']['tipo'] == 1) {
                
            }
        }

        $postos = $this->Aditivo->Posto->find('list', array('order' => 'Posto.antiguidade asc'));
        $consultaespecialidade = 'select Especialidade.id, Quadro.sigla_quadro, Especialidade.nm_especialidade from especialidades Especialidade inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id) order by Quadro.sigla_quadro asc, Especialidade.nm_especialidade asc ';
        $dadosconsulta = $this->Aditivo->query($consultaespecialidade);
        foreach ($dadosconsulta as $espec) {
            $especialidades[$espec['Especialidade']['id']] = $espec['Quadro']['sigla_quadro'] . ' - ' . $espec['Especialidade']['nm_especialidade'];
        }
        //   $especialidades=$this->Aditivo->Especialidade->query('list');

        $unidades = $this->Aditivo->Unidade->find('list');
        $unidades[0] = 'Selecione';
        $this->set(compact());
    }        
        
        
        function externofaltas(){
            $mes = $this->params['url']['mes'];
            if(empty($mes)){
                $mes = date('m');
            }
            $ano = $this->params['url']['ano'];
            if(empty($ano)){
                $ano = date('Y');
            }
            $this->layout = 'limpo';

            $peculio=$this->Aditivo->query('select * from zfaltasnomes where setor="OPG" and ativo="S" ');
            $conta = 0;
            foreach($peculio as $registros){
                $nomes[$conta]=$registros['zfaltasnomes']['nome'];
                $nomesid[$conta]=$registros['zfaltasnomes']['id'];
                $conta++;
            }
            $total = count($nomes);
            $this->set('total',$total);
            $this->set('nomes',$nomes);
            $this->set('nomesid',$nomesid);
            $registros=$this->Aditivo->query('select * from zfaltas, zfaltasnomes where zfaltasnomes.setor="OPG" and zfaltasnomes.id=zfaltas.zfaltasnomes_id and month(zfaltas.data)="'.$mes.'" and year(zfaltas.data)="'.$ano.'" order by data asc   ');
            foreach($registros as $registro){
                $dados[strtotime($registro['zfaltas']['data'])]=array(
                     'zfaltas' => Array ( 'id' => $registro['zfaltas']['id'], 'zfaltasnomes_id' => $registro['zfaltas']['zfaltasnomes_id'], 'motivo_inicio' => $registro['zfaltas']['motivo_inicio'],'motivo_termino' => $registro['zfaltas']['motivo_termino'], 'data' => $registro['zfaltas']['data'] , 'emailInicio' => $registro['zfaltas']['emailInicio'] , 'emailTermino' => $registro['zfaltas']['emailTermino'] ), 
                    'zfaltasnomes' => Array ( 'nome' => $registro['zfaltasnomes']['nome'] , 'setor' => $registro['zfaltasnomes']['setor'] , 'id' => $registro['zfaltasnomes']['id'] , 'ativo' => $registro['zfaltasnomes']['ativo'] )
                );
                
            }
            //print_r($dados);
            $this->set('dados',$dados);
        }
        
        function externofaltasinsere(){
            $this->layout = null;
            $total = count($this->data['Falta']['id']);
            for($i=0;$i<$total;$i++){
                $zfaltasnomes_id=$this->data['Falta']['zfaltasnomes_id'][$i];
                $zfaltas_id=$this->data['Falta']['id'][$i];
                $motivo_inicio=$this->data['Falta']['inicio'][$i];
                $motivo_termino=$this->data['Falta']['termino'][$i];
                $data=$this->data['Falta']['data'];
                if($zfaltas_id==0){
                $sqlinsere = "insert ignore into zfaltas (zfaltasnomes_id, motivo_inicio, motivo_termino, data) values({$zfaltasnomes_id}, '{$motivo_inicio}', '{$motivo_termino}', '{$data}');";
                }else{
                $sqlinsere = "update zfaltas, zfaltasnomes set motivo_inicio='{$motivo_inicio}', motivo_termino='{$motivo_termino}' where zfaltas.zfaltasnomes_id=zfaltasnomes.id and zfaltas.id='{$zfaltas_id}'";
                    
                }
                if($this->Aditivo->query($sqlinsere)){
                    $mensagem .= $this->data['Falta']['nome'][$i].' -> INSERIDO '."\n";
                    //$falha=0;
                }else{
                    $mensagem .= '<b>'.$this->data['Falta']['nome'][$i].' -> PROBLEMA '."</b>\n";
                    //$falha=1;
                }
                //echo $sqlinsere;exit();
                
                //echo $sqlinsere.'<br>'; 
            }
                 $mensagem=json_encode($mensagem);

		//header('Content-type: application/x-json');
$retornoajax=<<<Ajax
{ "ok":1, "mensagem":$mensagem}       
Ajax;
echo $retornoajax;            
            exit();
            
        }
        function externofaltasleitura(){
            $this->layout = null;
            $sqlleitura = "select * from zfaltas left join zfaltasnomes on (zfaltas.zfaltasnomes_id=zfaltasnomes.id) where zfaltas.data={$this->data} ";
            
            $sqlcomplemento = "select * from zfaltasnomes where id not in (select zfaltasnomes_id from zfaltas where zfaltas.data={$this->data}) and zfaltasnomes.ativo='S'";
            $conteudo=$this->Aditivo->query($sqlleitura);
            $complemento=$this->Aditivo->query($sqlcomplemento);
            //print_r($conteudo);
            $data = $conteudo[0]['zfaltas']['data'];
            
$html01=<<<INICIO
<form accept-charset="utf-8" action="{$this->webroot}aditivos/externofaltasinsere" method="post" enctype="multipart/form-data" id="AditivosExternofaltasinsereForm" onsubmit="submitForm(this); return false;"><div style="display:none;"><input type="hidden" value="POST" name="_method"></div><table cellspacing="0" cellpadding="0" bgcolor="#ffffff" id="login">
	<tbody>
		<tr>
			<td valign="center" bgcolor="#ffffff" align="center">
			<table cellspacing="0" cellpadding="0" width="100%" id="logins">
				<tbody><tr bgcolor="#8080f0">
					<th width="3%"><a id="btfechar" onclick="HideContent('faltas');" href="#">X</a></th>
					<th width="85%" align="center" colspan="2">Modificar Informações sobre faltas do dia </th>
					<th width="12%" bgcolor="#80f0f0" align="center"><div id="textodata" style="position:static;">{$data}</div></th>
				</tr>
				<tr bgcolor="#808080" align="center">
					<th width="3%"></th>
					<th width="33%" align="center">NOME</th>
					<th width="33%" align="center">INÍCIO</th>
					<th width="31%" align="center">TÉRMINO</th>
				</tr>
                                
INICIO;

$c = 0;
foreach($conteudo as $dados){

$htmlmeio.=<<<INICIO
<tr>
					<td width="3%"></td>
					<td width="33%"><input type="text" name="data[Falta][nome][{$c}]" class="formulario" readonly="readonly" maxlength="20" value="{$dados['zfaltasnomes']['nome']}">
                                        <input type="hidden" name="data[Falta][zfaltasnomes_id][{$c}]" value="{$dados['zfaltasnomes']['id']}">
                                        <input type="hidden" name="data[Falta][id][{$c}]" value="{$dados['zfaltas']['id']}">
                                        </td>
					<td width="33%"><input type="text" name="data[Falta][inicio][{$c}]" onchange="var valor=$('inicio{$c}').value; valor=valor.toUpperCase();$('termino{$c}').value=valor;$('inicio{$c}').value=valor;" id="inicio{$c}" class="formulario" maxlength="30" value="{$dados['zfaltas']['motivo_inicio']}"></td>
					<td width="31%"><input type="text" name="data[Falta][termino][{$c}]" onchange="var valor=$('termino{$c}').value; valor=valor.toUpperCase();$('termino{$c}').value=valor;" id="termino{$c}" class="formulario" maxlength="30" value="{$dados['zfaltas']['motivo_termino']}"></td>
				</tr>

INICIO;
$c++;

}
foreach($complemento as $completa){

$htmlmeio.=<<<INICIO
<tr>
					<td width="3%"></td>
					<td width="33%"><input type="text" name="data[Falta][nome][{$c}]" class="formulario" readonly="readonly" maxlength="20" value="{$completa['zfaltasnomes']['nome']}">
                                        <input type="hidden" name="data[Falta][zfaltasnomes_id][{$c}]" value="{$completa['zfaltasnomes']['id']}">
                                        <input type="hidden" name="data[Falta][id][{$c}]" value="0">
                                        </td>
					<td width="33%"><input type="text" name="data[Falta][inicio][{$c}]" onchange="var valor=$('inicio{$c}').value; valor=valor.toUpperCase();$('termino{$c}').value=valor;$('inicio{$c}').value=valor;" id="inicio{$c}" class="formulario" maxlength="30" value=""></td>
					<td width="31%"><input type="text" name="data[Falta][termino][{$c}]" onchange="var valor=$('termino{$c}').value; valor=valor.toUpperCase();$('termino{$c}').value=valor;" id="termino{$c}" class="formulario" maxlength="30" value=""></td>
				</tr>

INICIO;
$c++;

}
                        if(!empty($dados['zfaltas']['emailInicio'])){
                            $emailInicio = 'btimagemverde';
                        }else{
                            $emailInicio = 'btimagemvermelho';
                        }
                        if(!empty($dados['zfaltas']['emailTermino'])){
                            $emailTermino = 'btimagemverde';
                        }else{
                            $emailTermino = 'btimagemvermelho';
                        }

$html03=<<<SAIDAM
                                <tr>
					<td width="3%">
					</td>
					<td width="33%">
                                               <input type="hidden" id="data" name="data[Falta][data]" value="{$data}">
                                               <div class="submit"><input type="submit" value="Registrar" class="botoes"></div>					
                                        </td>
					<td width="33%">
                                               <a class="{$emailInicio}" href="#" onclick="enviaEmail('{$data}','INICIO');">ENVIAR E-MAIL</a>					
                                        </td>
					<td width="31%">
                                               <a class="{$emailTermino}" href="#" onclick="enviaEmail('{$data}','TERMINO');">ENVIAR E-MAIL</a>					
					
                                        </td>
				</tr>

			</tbody></table>
			</td>
		</tr>
	</tbody>
</table>
</form> 
SAIDAM;

            $mensagem=json_encode($html01.$htmlmeio.$html03);
            
            //echo $sqlleitura;
            if($c>0){
                $ok=1;
            }else{
                $ok=0;
            }

		//header('Content-type: application/x-json');
$retornoajax=<<<Ajax
{ "ok":$ok, "mensagem":$mensagem}       
Ajax;

            echo $retornoajax;            
            exit();
            
        }
        function externofaltasemail(){
            $this->layout = null;
            //Configure::write('debug',2);
            

            $this->data = $_POST['data'];
            $this->tipo = $_POST['tipo'];
             
            $sqlleitura = "select * from zfaltas, zfaltasnomes where zfaltas.zfaltasnomes_id=zfaltasnomes.id and zfaltas.data='{$this->data}' ";

            $registros=$this->Aditivo->query($sqlleitura);
            
            //echo $sqlleitura;
$cabecalho=<<<TABELA01
<table cellspacing="0" cellpadding="0" id="logins" width="100%">
				<tr bgcolor="#8080f0">
					<th width="85%" align="center" colspan="3">Controle de presenças do dia {$this->data}</th>
				</tr>
				<tr bgcolor="#808080" align="center">
					<th width="33%" align="center">NOME</th>
					<th width="33%" align="center">INÍCIO</th>
					<th width="34%" align="center">TÉRMINO</th>
				</tr>
				

TABELA01;
                                
            if($this->tipo=="INICIO"){
                $inicio = ' emailInicio=now()';
                $assunto = 'início do expediente do dia:'.$this->data;
                
                foreach($registros as $dados){
                    $meio.="<tr><td width='33%'>{$dados['zfaltasnomes']['nome']}</td><td width='33%'>{$dados['zfaltas']['motivo_inicio']}</td><td width='34%'></td></tr>";    
                                        
                }
            }else{
                $inicio = '';
            }

            if($this->tipo=="TERMINO"){
                $termino = ' emailTermino=now()';
                $assunto = 'término do expediente do dia:'.$this->data;
                foreach($registros as $dados){
                    $meio.="<tr><td width='33%'>{$dados['zfaltasnomes']['nome']}</td><td width='33%'>{$dados['zfaltas']['motivo_inicio']}</td><td width='34%'>{$dados['zfaltas']['motivo_termino']}</td></tr>";    
                                        
                }
            }else{
                $termino = '';
            }
            
            $sqlupdate = "update zfaltas set $inicio $termino where data='{$this->data}' ";
            //echo $sqlupdate;
            $this->Aditivo->query($sqlupdate);
            $destinos = array(0=>'<osec-6@cindacta4.intraer>', 1=>'<opg-1@cindacta4.intraer>', 2=>'<opg-2@cindacta4.intraer>', 3=>'<opg-3@cindacta4.intraer>', 4=>'<opg-4@cindacta4.intraer>', 5=>'<opg-5@cindacta4.intraer>', 6=>'<opg-6@cindacta4.intraer>');
//            $destinos = array(0=>'<oaple-6@cindacta4.intraer>');
            //$to = '<osec-2@cindacta4.intraer>, <oaple-1@cindacta4.intraer>, <opg-1@cindacta4.intraer>, <oaple-2@cindacta4.intraer>, <oaple-3@cindacta4.intraer>, <oaple-6@cindacta4.intraer>';
            $ok = 1;
            
            for($i=6;$i<=5;$i++){
            $to = $destinos[$i];
            $subject = iconv('UTF-8','ISO-8859-1',"OPG - Controle de presença - $assunto");
            $from = '<opg-5@cindacta4.intraer>';
            $namefrom = 'SO BET EVALDO';
            $nameto = '';
            $message = $cabecalho.$meio.'</table><br>E-mail enviado através do SGBDO.';
            $smtpServer = "expresso.cindacta4.intraer";
            $port       = "25";
            $timeout    = "30";
            $username   = "opg-5@cindacta4.intraer";
            $password   = "evaldoesl";
            $localhost  = "expresso.cindacta4.intraer";
            $newLine    = "\r\n";  
            $fimMsg    = "\r\n.\r\n";  

            //Connect to the host on the specified port
            $smtpConnect  = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
            $smtpResponse = fgets($smtpConnect, 515);
            if(empty($smtpConnect))
            {
                $output = "Failed to connect: $smtpResponse";
                return $output;
            }
            else
            {
                $errorLog['connection'] = "Connected: $smtpResponse";
            }  

            //Request Auth Login
            /*
            fputs($smtpConnect,"AUTH LOGIN" . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['authrequest'] = "$smtpResponse";  

            //Send username
            fputs($smtpConnect, base64_encode($username) . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['authusername'] = "$smtpResponse";  

            //Send password
            fputs($smtpConnect, base64_encode($password) . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['authpassword'] = "$smtpResponse";  
*/
            //Say Hello to SMTP
            fputs($smtpConnect, "HELO $localhost" . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['heloresponse'] = "$smtpResponse";  

            //Email From
            fputs($smtpConnect, "MAIL FROM: $from" . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['mailfromresponse'] = "$smtpResponse";  

            //Email To
            fputs($smtpConnect, "RCPT TO: $to" . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['mailtoresponse'] = "$smtpResponse";  

            //The Email
            fputs($smtpConnect, "DATA" . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['data1response'] = "$smtpResponse";  

            //Construct Headers
            $headers  = "MIME-Version: 1.0" . $newLine;
            //$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
            $headers .= "Content-type: text/html; charset=utf-8" . $newLine;
            $headers .= "To: $nameto $to" . $newLine;
            $headers .= "From: $namefrom $from" . $newLine;  

            $data = date("D, d M Y H:i:s O");
            fputs($smtpConnect, "Date: {$data}\nTo: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");
            //fputs($smtpConnect, "Subject: $subject\n$headers\n\n$message\n.\n");
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['data2response'] = "$smtpResponse";  
            if( strpos($errorLog['data2response'], 'queued')!==false ){ $ok=1; }
            // SMTP Loggin Out
            fputs($smtpConnect,"QUIT" . $newLine);
            $smtpResponse = fgets($smtpConnect, 515);
            $errorLog['quitresponse'] = "$smtpResponse";   

           // var_dump($errorLog);
            }
            
            
           // ($cabecalho.$meio.'</table><br>E-mail enviado através do SGBDO.');

            //header('Content-type: application/x-json');
$retornoajax=<<<Ajax
{"ok":$ok}       
Ajax;

            echo $retornoajax;            
            exit();
            
        }
        
        function externolpna(){
            
        }
        
        function externolpnaconsulta(){
            $this->layout = 'ajax';
$sqlC = '';
        if($this->data['id']=='R16'){
           for($i=0;$i<10;$i++){
              if(!empty($this->data[$this->data['id']]['condicao'][$i])&&!empty($this->data[$this->data['id']]['valor'][$i])){
                 if(ereg("^E -", $this->data[$this->data['id']]['condicao'][$i])){
                     $primeiro = " and {$this->data[$this->data['id']]['campo'][$i]} ";
                 }
                 if(ereg("^OU -", $this->data[$this->data['id']]['condicao'][$i])){
                     $primeiro = " or {$this->data[$this->data['id']]['campo'][$i]} ";
                 }
                 if(ereg("CONTENHA", $this->data[$this->data['id']]['condicao'][$i])){
                    if(ereg("NÃO", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = " not like '%{$this->data[$this->data['id']]['valor'][$i]}%' ";
                    }else{
                        $segundo = " like '%{$this->data[$this->data['id']]['valor'][$i]}%' ";
                    }
                 }
                 if(ereg("COMECE", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  like '%{$this->data[$this->data['id']]['valor'][$i]}' ";
                 }
                 if(ereg("TERMINE", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  like '{$this->data[$this->data['id']]['valor'][$i]}%' ";
                 }
                 if(ereg("IGUAL", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  = {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 if(ereg("MAIOR", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  > {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 if(ereg("MENOR", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  < {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 if(ereg("DIFERENTE", $this->data[$this->data['id']]['condicao'][$i])){
                        $segundo = "  <> {$this->data[$this->data['id']]['valor'][$i]} ";
                 }
                 
                   $sqlC .= " {$primeiro} {$segundo} ";
              }
              
           }
				Configure::write('debug',2);
           
	//$this->Aditivo->mudaDBModelo('lpna');
	//$db = ConnectionManager::getInstance();
	//$connected = $db->getDataSource('lpna');
	//if($connected->isConnected()){	echo 'Conectou';}else{	echo 'Nao conectou';	}	
        
        //$dados = $this->Aditivo->query('select * from lpna.cadastro where 1=1 '.$sqlC);
        //print_r($dados);
                        $conectalpna=mysql_pconnect("10.228.12.140","usu_sgbdo","dacta@sgbdo");
			if (!$conectalpna) {
			    echo 'Bloqueado em 10.228.12.140 <br> ';
			}else{
			    echo 'Conectado em 10.228.12.140 <br> ';
                        }
                        $conectalpna=mysql_pconnect("10.112.24.12","sgbdo","sgbdo");
			if (!$conectalpna) {
			    echo 'Bloqueado em 10.112.24.12 <br> ';
			}else{
			    echo 'Conectado em 10.112.24.12 <br> ';
                        }

			//$conectalpna=mysql_pconnect("10.228.12.140","usu_sgbdo","dacta@sgbdo");
			if (!$conectalpna) {
			    die('Not connected : ' . mysql_error());
			}
			$selecionalpna = mysql_select_db('lpna', $conectalpna);
			if (!$selecionalpna) {
			    die ('Can\'t use lpna : ' . mysql_error());
			}
			$consultalpna = mysql_query('select * from cadastros where 1=1 '.$sqlC);
			if (!$consultalpna) {
			    die('Invalid query: ' . mysql_error());
			}
			$dados = mysql_fetch_array($consultalpna);
			
            exit();
         //   print_r($this->data);
       //echo $sqlinicio;
            
            
           // print_r($temp);
            
            foreach($dados as $chave=>$valor){
                $conteudo[$chave]['Efetivo']['sigla_unidade']=$valor['Unidade']['sigla_unidade'];
                $conteudo[$chave]['Efetivo']['sigla_setor']=$valor['Setor']['sigla_setor'];
                $conteudo[$chave]['Efetivo']['sigla_posto']=$valor['Posto']['sigla_posto'];
                $conteudo[$chave]['Efetivo']['sigla_quadro']=$valor['Quadro']['sigla_quadro'];
                $conteudo[$chave]['Efetivo']['nm_especialidade']=$valor['Especialidade']['nm_especialidade'];
                $conteudo[$chave]['Efetivo']['nm_completo']=$valor['Militar']['nm_completo'];
                $conteudo[$chave]['Efetivo']['sexo']=$valor['Militar']['sexo'];
                $conteudo[$chave]['Efetivo']['codigo']=$valor['Curso']['codigo'];
                $conteudo[$chave]['Efetivo']['validade_cht']=$valor['Habilitacao']['validade_cht'];
                $conteudo[$chave]['Efetivo']['validade_ccf']=$valor['Exame']['data_validade'];
                $conteudo[$chave]['Efetivo']['anos']=$valor[0]['anos'];
            }
			$titulo = 'Consulta Personalizada';
			$tabela = 'Efetivo';
			$nome = 'planilha_personalizada';
		
        }             
        }
        function externoproxy(){
				$this->layout = null;
		}
        
              
        function externorelatorioonix(){
            
            $exercicio = 213;
            $meta = 2448;
            $etapa = 7318;
            $nd = 5;
            $dtfim = date('Y-m-d');
            $sql = "select meta.display, etapa.display, subetapa.display, evento.display, os.prioridade, os.os, concat(cidade.cidade,'/',cidade.uf) as cid, fase.display, os.id_os, os.justificativa,os.resumo_servico, os.id_fase, pernoite.saida_data, pernoite.regresso_data, passagem_tipo, passagem_valor, cidade.valor_medio_psg, pernoite.id_cidade, diaria_qtd, (diaria_qtd * diaria_estimada) as valor, acrescimo_valor,os.id_identificador, identificador.display, left(concat_ws(' ', nome_guerra,posto,especialidade),30), os.id_evento, os_boletim, num_boletim, data_boletim, pernoite.id_pernoite, os.prioridade, fase.cod_controle , to_days(now()) - to_days(pernoite.regresso_data) as atraso, concat_ws(' ', posto,especialidade, nome_completo) , os_debito.pago_valor, os_debito.valor from pernoite left join (os left join sc on os.id_sc=sc.id_sc left join fase on os.id_fase=fase.id_fase left join identificador on os.id_identificador=identificador.id_identificador left join os_debito on os.id_os=os_debito.id_os left join (evento left join (subetapa left join (etapa left join meta on etapa.id_meta = meta.id_meta) on subetapa.id_etapa = etapa.id_etapa) on evento.id_subetapa=subetapa.id_subetapa) on os.id_evento=evento.id_evento) on pernoite.id_os=os.id_os left join cidade on pernoite.id_cidade=cidade.id_cidade left join (servidor left join posto on servidor.id_posto=posto.id_posto left join especialidade on servidor.id_especialidade=especialidade.id_especialidade ) on pernoite.id_servidor=servidor.id_servidor join nd on pernoite.id_nd=nd.id_nd WHERE meta.id_exercicio=$exercicio and os.id_os>1 and pernoite.id_pernoite>1 and meta.id_meta = $meta and etapa.id_etapa = $etapa and pernoite.id_nd = $nd and ( os_debito.data_debito >= '2013-01-01') and ( os_debito.data_debito <= '$dtfim') ORDER by os.saida_data ";
        }
        
        
        function externocontracheque(){
		$u=$this->Session->read('Usuario');
                if(empty($u[0][0]['nome'])){
                    exit();
                }
            
            
                $this->set(compact('u'));
            
        }
        function externoindicacoes(){
        	$u=$this->Session->read('Usuario');
                $this->set(compact('u'));
                if(empty($u[0][0]['nome'])){
                    exit();
                
                }
               // http://dctp.decea.intraer/portal/meuscursos/pesquisanomes
               // $_POST['codcpf']='';
        }
        
        
}
?>
