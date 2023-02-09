<?php
class PaeatsController extends AppController {

	var $name = 'Paeats';
	var $helpers = array('Html', 'Form');

	function externozip($id, $porcaria=null){
		$this->layout = null;
		$dta = $this->data['Escala']['ano'];
		$dtm = 0;
		//$dtIni = strtotime("$dta/$dtm/1");

		$sql = "select Militar.nm_completo , Militar.nm_guerra , Militar.dt_admissao, Posto.sigla_posto , Quadro.sigla_quadro, Especialidade.nm_especialidade , Militar.nm_completo , 
		 Militar.cpf, Militar.saram , Militar.identidade , Militar.dt_formacao , Militar.dt_ultima_promocao , Militar.total_beneficiarios, Militar.setor_id, Militar.email, Militar.telefone01, Quadro.sigla_quadro,
		 Unidade.sigla_unidade , Setor.sigla_setor, Paeat.codcurso, Paeat.inicio, Paeat.fim, Paeat.local, Paeat.turma, Paeat.vagas,
		 Paeatsindicado.id,Paeatsindicado.paeat_id, Paeat.id, Paeatsindicado.unidade, Paeatsindicado.nomecompleto, Paeatsindicado.referenciavaga, Paeatsindicado.passagem, Paeatsindicado.diaria_ajuda,
		 Paeatsindicado.responsavel , Paeatsindicado.privilegio, Paeatsindicado.prioridade, Paeatsindicado.atributo, Paeat.observacoes, Curso.objetivo
		FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
		LEFT JOIN setors as Setor on (Militar.setor_id = Setor.id)
		LEFT JOIN unidades as Unidade on (Militar.unidade_id = Unidade.id)
		inner join paeatsindicados Paeatsindicado on (Paeatsindicado.militar_id=Militar.id)
		inner join paeats Paeat on (Paeat.id=Paeatsindicado.paeat_id)
		left join cursos Curso on (Curso.codigo=Paeat.codcurso)
		where Paeat.id='$id'
		order by  Paeat.indicacao asc, Paeat.codcurso asc,  Paeatsindicado.responsavel asc, Paeatsindicado.privilegio asc, Paeatsindicado.referenciavaga asc, Paeatsindicado.prioridade asc, Paeatsindicado.atributo asc ";
		$indicados = $this->Paeat->query($sql);
		//echo $sql.'<pre>';print_r($indicados);echo '</pre>';exit();
		/*
		$efetivo = "select * from federatedpefca where situacao='ATV' ";
		$todos = $this->Paeat->query($efetivo);
		foreach($todos as $dependentes){
			$dependente[trim($dependentes['federatedpefca']['IDENT'])]=$dependentes['federatedpefca']['DEPEND'];			
			$dependente[trim($dependentes['federatedpefca']['SARAM'])]=$dependentes['federatedpefca']['DEPEND'];			
			}
		*/
		$this->set('indicados',$indicados);		
		//$this->set('dependente',$dependente);
		//print_r($vetor);exit();
		
	}
	
	
	function index($id = null) {
			//$this->layout='';
			//$this->layout = 'paeat';
			$this->Paeat->recursive = 0;
			$conditions=array('Paeat.ano'=>$this->data['Paeat']['ano'],'Paeat.tipo'=>'OPERACIONAL');
			$order=array('Paeat.arquivado'=>'asc','Paeat.status'=>'asc','Paeat.indicacao'=>'asc','Paeat.inicio'=>'asc','Paeat.codcurso'=>'asc');
			//$this->set('paeats', $this->Paeat->find('all',array('conditions'=>$conditions,'order'=>$order,'limit'=>30)));
            $paeats =$this->Paeat->find('all',array('conditions'=>$conditions,'order'=>$order,'recursive'=>2));
            $cursos =$this->Paeat->query("select * from cursos Curso order by Curso.codigo");
			$this->set('paeats', $paeats);
			$this->set('cursos', $cursos);
                                                //print_r($cursos);

                        //foreach($paeats as $i->$valor){
                             // echo $valor['Paeatsindicado'][0];
                            //foreach($valor['Paeatsindicado'] as $z->$indicado){
                               // echo $indicado['militar_id'];
                                
                            //}
                            
                        //}
	}
	
	function externocadastro(){
		$tipo = 'registros';
		$tabela=1;
		if($this->params['form']['opcao']=='sim'){
			$u = $this->Session->read('Usuario');
			$usuario = $u[0][0]['nome'];
			$privilegio = $u[0]['Privilegio']['descricao'];

			$paeatId=$this->data['Paeat']['id'];
			$prioridade=$this->data['Paeat']['prioridade'];
			$militarId=$this->data['Paeat']['militarid'];
			$atributo=$this->data['Paeat']['atributo'];
			
			if($atributo!='ALUNO'){
				$verificadados = 0;
			}else{
				$verificadados = 1;
			}
			
			$listanome='select * from militars Militar
			inner join postos Posto on (Posto.id=Militar.posto_id)
			inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			where Militar.id="'.$militarId.'" order by nm_completo asc';
			$nomevetor=$this->Paeat->query($listanome);
			$nomeCompleto=$nomevetor[0]['Posto']['sigla_posto'].' '.$nomevetor[0]['Quadro']['sigla_quadro'].' '.$nomevetor[0]['Especialidade']['nm_especialidade'].' '.$nomevetor[0]['Militar']['nm_completo'];
			$saram=$nomevetor[0]['Militar']['saram'];
			$identidade = $nomevetor[0]['Militar']['identidade'];

			$listaunidade='select * from militars Militar
			inner join setors Setor on (Setor.id=Militar.setor_id)
			inner join unidades Unidade on (Unidade.id=Setor.unidade_id)
			where Militar.id="'.$militarId.'"';
			$unidadevetor=$this->Paeat->query($listaunidade);
			
			$unidade = $unidadevetor[0]['Unidade']['sigla_unidade'].' - '.$unidadevetor[0]['Setor']['sigla_setor'];
			
			
			$listadistribuicao = 'select * from paeatsdistribuicaos Paeatsdistribuicao where paeat_id='.$paeatId.' and vaga="'.$this->data['Paeat']['unidade'].'" order by vaga asc';
			$distribuicao=$this->Paeat->query($listadistribuicao);
			
			$codcurso=$distribuicao[0]['Paeatsdistribuicao']['codcurso'];
			$referenciavaga=$distribuicao[0]['Paeatsdistribuicao']['vaga'];
			$vagas=$distribuicao[0]['Paeatsdistribuicao']['vagas'];
			$responsavel=$usuario;
			$ip=$_SERVER['REMOTE_ADDR'];
			$created='now()';
			
			//Inserir somente após validar se o militar não foi pré-cadastrado e não há conflito entre datas
			if($verificadados){
                            $verificaIndicacoes = "select * from paeatsindicados Paeatsindicado where militar_id='{$militarId}'  ";
                            $indicacoesanteriores=$this->Paeat->query($verificaIndicacoes);
                        }else{
                            $indicacoesanteriores = array();
                        }
                        //print_r($indicacoesanteriores);
			$indice = 0;
			$sqlpaeatid = '';
                        //ATM038 pode ser realizado mais de uma vez
			foreach($indicacoesanteriores as $indicacoes){
				$paeatindicacao[$indice]['paeat_id'] = $indicacoes['Paeatsindicado']['paeat_id'];
				$paeatindicacao[$indice]['codcurso'] = $indicacoes['Paeatsindicado']['codcurso'];
				$sqlpaeatid .= $indicacoes['Paeatsindicado']['paeat_id'].' ,';
				$indice++;	
			}
			$sqlpaeatid = substr($sqlpaeatid,0,-1);
			
			$verificaDatas = "select * from paeats Paeat where id={$paeatId} ";
			$dataIndicacaoAtual=$this->Paeat->query($verificaDatas);
                        $datalimitedecea=$dataIndicacaoAtual[0]['Paeat']['indicacao'];
			$indice = 0;
			foreach($dataIndicacaoAtual as $dataAtual){
				$tentativa[0]['inicio'] = strtotime($dataAtual['Paeat']['inicio']);
				$tentativa[0]['fim'] = strtotime($dataAtual['Paeat']['fim']);
				$tentativa[0]['codcurso'] = $dataAtual['Paeat']['codcurso'];
				$tentativa[1]['inicio'] = strtotime($dataAtual['Paeat']['inicio2']);
				$tentativa[1]['fim'] = strtotime($dataAtual['Paeat']['fim2']);
				$tentativa[1]['codcurso'] = $dataAtual['Paeat']['codcurso'];
				$tentativa[2]['inicio'] = strtotime($dataAtual['Paeat']['inicio3']);
				$tentativa[2]['fim'] = strtotime($dataAtual['Paeat']['fim3']);
				$tentativa[2]['codcurso'] = $dataAtual['Paeat']['codcurso'];
			}
	$ltitulo='';
	$laluno1='';
	$laluno2='';
	$linstrutor1='';
	$linstrutor2='';
    if($dataAtual['Paeat']['status']=='ATIVO'){
			$ltitulo='FFFFFF';
			$laluno1='EFF5FB';
			$laluno2='FAFAFA';
			$linstrutor1='D8D8D8';
			$linstrutor2='E6E6E6';
    	}

		if($dataAtual['Paeat']['subtipo']=='PROSIMA'){
			$ltitulo='FFFF00';
			$laluno1='F3F781';
			$laluno2='F2F5A9';
			$linstrutor1='F4FA58';
			$linstrutor2='F7FE2E';
	}
	
    if($dataAtual['Paeat']['status']=='ADIADO'){
			$ltitulo='FF8000';
			$laluno1='F5D0A9';
			$laluno2='F6E3CE';
			$linstrutor1='F7D358';
			$linstrutor2='F5DA81';
    	}

        $class = ' style="background-color:#fff;" ';


		$classcurso = ' style="background-color:#f0f0f0;" ';

	
	if($dataAtual['Paeat']['status']=='CANCELADO'){
			$ltitulo='FF0000';
			$laluno1='F7BE81';
			$laluno2='F5D0A9';
			$linstrutor1='FE2E2E';
			$linstrutor2='FA5858';
	}

	if($dataAtual['Paeat']['status']=='SEM INDICAÇÃO'){
			$ltitulo='6E000B';
			$laluno1='785357';
			$laluno2='796265';
			$linstrutor1='773239';
			$linstrutor2='773F45';
	}
	
	if($dataAtual['Paeat']['arquivado']==1){
			$ltitulo='6E6E6E';
			$laluno1='BDBDBD';
			$laluno2='D8D8D8';
			$linstrutor1='848484';
			$linstrutor2='A4A4A4';
         $arquivados ++;
	}			
			
			$datasAnteriores = "select * from paeats Paeat where id in ({$sqlpaeatid}) ";
			$datasIndicacoesAnteriores=$this->Paeat->query($datasAnteriores);
			$indice = 0;
			foreach($datasIndicacoesAnteriores as $datas){
				$jacadastradas[$indice]['paeat_id'] = ($datas['Paeat']['id']);
				$jacadastradas[$indice]['codcurso'] = ($datas['Paeat']['codcurso']);
				$jacadastradas[$indice]['dtinicio'] = ($datas['Paeat']['inicio']);
				$jacadastradas[$indice]['dtfim'] = ($datas['Paeat']['fim']);
				$jacadastradas[$indice]['inicio'] = strtotime($datas['Paeat']['inicio']);
				$jacadastradas[$indice]['fim'] = strtotime($datas['Paeat']['fim']);
				$indice++;
				$jacadastradas[$indice]['paeat_id'] = ($datas['Paeat']['id']);
				$jacadastradas[$indice]['codcurso'] = ($datas['Paeat']['codcurso']);
				$jacadastradas[$indice]['dtinicio'] = ($datas['Paeat']['inicio2']);
				$jacadastradas[$indice]['dtfim'] = ($datas['Paeat']['fim2']);
				$jacadastradas[$indice]['inicio'] = strtotime($datas['Paeat']['inicio2']);
				$jacadastradas[$indice]['fim'] = strtotime($datas['Paeat']['fim2']);
				$indice++;
				$jacadastradas[$indice]['paeat_id'] = ($datas['Paeat']['id']);
				$jacadastradas[$indice]['codcurso'] = ($datas['Paeat']['codcurso']);
				$jacadastradas[$indice]['dtinicio'] = ($datas['Paeat']['inicio3']);
				$jacadastradas[$indice]['dtfim'] = ($datas['Paeat']['fim3']);
				$jacadastradas[$indice]['inicio'] = strtotime($datas['Paeat']['inicio3']);
				$jacadastradas[$indice]['fim'] = strtotime($datas['Paeat']['fim3']);
				$indice++;
			}
			
			//print_r($jacadastradas);
			$insere = 0;
			$mensagemerro = '';
			$erro = 0;
			
			foreach($jacadastradas as $cadastrados){
				foreach($tentativa as $atual){
					$cmp1 = ($atual['inicio']>=$cadastrados['inicio']);
					$cmp2 = ($atual['inicio']<=$cadastrados['inicio']);
					$cmp3 = ($atual['fim']-$cadastrados['inicio']);
					$cmp4 = ($atual['inicio']>$cadastrados['fim']);
					$cmp5 = ($atual['codcurso']==$cadastrados['codcurso']);

                                        $cmp1 = ($atual['fim']>=$cadastrados['inicio']);
					$cmp2 = ($atual['inicio']<=$cadastrados['fim']);
//                                            if(($cmp1>=0 || $cmp2<=0) && ($cmp3>=0) && ($cmp4<=0) &&(!empty($atual['inicio'])||$cadastrados['inicio'])){
                                            if(($cmp1 && $cmp2)&&(!empty($atual['inicio']))&&(!empty($cadastrados['inicio']))){
                                                    $insere++;
                                                    $mensagemerro = $mensagemerro.'<b>'.$cadastrados['codcurso'].'</b>=> ['.$cadastrados['dtinicio'].']/['.$cadastrados['dtfim'].']<br>';
                                                    $erro=1;
                                            }
                                        
				}
			}
			
			if(!empty($mensagemerro)){
				$mesagemerro = '<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">Conflito(s) detectados:<br></p><p style="background-color:#d0d0f0;padding:0px;color:#800000;text-align:center;margin:0px;">'.$mensagemerro.'</p>';
			}
			
			if($verificadados){
                            //ATM038 pode ser feito mais de uma vez
				$verificasejafezcurso='select * from pefcr where Ident='.$identidade.' and codcurso="'.$tentativa[0]['codcurso'].'" and codcurso not like \'%ATM038%\' ';
                                //echo $verificasejafezcurso.' -> ';
				$fezcurso=$this->Paeat->query($verificasejafezcurso);//$dado['pefcr']['codcurso']
			//	print_r($fezcurso);
				if(!empty($fezcurso)){
					$insere++;
					$mensagemerro  .='<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">O Militar j&aacute; realizou o curso no per&iacute;odo:'.$fezcurso[0]['pefcr']['dtInicio'].'/'.$fezcurso[0]['pefcr']['dtTerm'].'<br></p>';
					$erro=1;
				}
			
			}
			
			
			if($insere==0 && !empty($responsavel)){
				$inseredados = 'insert into paeatsindicados (saram, paeat_id, prioridade, militar_id, nomecompleto, unidade, codcurso, referenciavaga, responsavel, privilegio, ip, created, atributo) 
				values ("'.$saram.'", '.$paeatId.', '.$prioridade.', "'.$militarId.'", "'.$nomeCompleto.'", "'.$unidade.'", "'.$codcurso.'" , "'.$referenciavaga.'" , "'.$responsavel.'", "'.$privilegio.'" ,"'.$ip.'" ,'.$created.',"'.$atributo.'"  )';
				//echo $inseredados;
				$inserir=$this->Paeat->query($inseredados);
			}else{
                                                if(empty($responsavel)){
                                                   $completa =  ' Saia do sistema e entre novamente!';
                                                }

				$mensagemerro .= '<p style="background-color:#ffffff;padding:0px;color:#800000;text-align:center;margin:0px;">Registro n&atilde;o inclu&iacute;do !'.$completa.'</p>';
				
			}
			
			$listaindicados = 'select * from paeatsindicados Paeatindicado where paeat_id='.$paeatId.' order by responsavel asc, privilegio asc, referenciavaga asc, prioridade asc, atributo asc ';
			$respostas=$this->Paeat->query($listaindicados);
			
			$class = ' style="background-color:#a0ffa0;"';
			
			$mensagem= "<table cellpadding='0' cellspacing='0' width='100%'><tr><td{$class}>Prioridade</td><td{$class}>Atributo</td><td{$class}>Indicado</td><td{$class}>Setor</td><td{$class}>Vaga</td><td{$class}>Respons&aacute;vel pela indica&ccedil;&atilde;o</td><td{$class}>Privil&eacute;gio</td><td{$class}>dtRegistro</td><td{$class}>Matriculado</td><td{$class}>A&ccedil;&otilde;es</td></tr>";
			$i = 0;

  			if(empty($respostas)){
				$mensagem = '';
			}
			
			foreach ($respostas as $resposta){
			$class = ' style="background-color:#'.$laluno1.';"';
				if($resposta['Paeatindicado']['atributo']!='ALUNO'){
					$class = ' style="background-color:#'.$linstrutor1.';"';
				}
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#'.$laluno2.';"';
				if($resposta['Paeatindicado']['atributo']!='ALUNO'){
					$class = ' style="background-color:#'.$linstrutor2.';"';
				}
			}
			
			
			$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/accept.png"/>';
			$ciente = '<input type="checkbox" id="'.$resposta['Paeat']['id'].'"  value="'.$resposta['Paeat']['id'].'" />';
			$despacho = '<img border="0" title="Despacho" alt="despacho" src="'.$this->webroot.'img/despacho.gif"/>';
	//		$excluir = "<a onclick=\"return false;\" onmousedown=\"dialogo('Deseja realmente excluir o registro #{$resposta['Paeatindicado']['id']} ?' ,'javascript:excluiRegistro({$resposta['Paeatindicado']['id']},{$paeatId});');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"{$this->webroot}img/lixo.gif\"/></a>";
			$excluir = "<a onclick=\"return false;\" onmousedown=\"dialogo('Deseja realmente excluir #{$resposta['Paeatindicado']['nomecompleto']} do curso {$resposta['Paeatindicado']['codcurso']} ?' ,'javascript:excluiRegistro({$resposta['Paeatindicado']['id']},{$resposta['Paeatindicado']['paeat_id']});');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"{$this->webroot}img/lixo.gif\"/></a>";


	$bloqueio = 0;
	$u=$this->Session->read('Usuario');
        
	if(($u[0]['Usuario']['privilegio_id']==6)||($u[0]['Usuario']['privilegio_id']==12)){
		//$final = '2011-01-25 23:59';
                $final = $datalimitedecea;
		$datafinal = strtotime($final);
		$datahoje = strtotime('+0 days');
		$limitesetor = strtotime($final.' -15 days');
		
		$intervalosetor01 = $datahoje-$datafinal;
		if($intervalosetor01<=0){
			$statussetor = 'laranja';
		}else{
			$statussetor = 'vermelho';
		}
		
		$intervalosetor01 = $datahoje-$limitesetor;
		if($intervalosetor01<0){
			$statussetor = 'verde';
		}
		if($statussetor=='vermelho'){
			$bloqueio=1;
		}
	}
	if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
		$bloqueio=0;
	}

	if(!$bloqueio){
			$acao= $excluir;
	}			
			//$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero']." ?\" ,\"javascript:excluiRegistro(".$resultado['lrotabela01s']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
         if($resposta['Paeatindicado']['autorizado']=='S'){
             $ticado = ' checked="checked" ';
             $txt = 'S';
         }else{
             $ticado = ' ';
             $txt = '';
         }
			
      if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
			$check="<div class='squaredFour'><input type='checkbox' $ticado onchange=\"matriculado('i{$resposta['Paeatindicado']['id']}', {$resposta['Paeatindicado']['id']}, $(this).checked );\" value='None' id='i{$resposta['Paeatindicado']['id']}' name='check{$resposta['Paeatindicado']['id']}' /><label for='i{$resposta['Paeatindicado']['id']}'></label></div>";                            
                            }else{
			$check="<div class='squaredFour'>{$txt}</div>";                            
                            }                           
			
			$mensagem .= "	<tr ><td{$class}>{$resposta['Paeatindicado']['prioridade']}</td><td{$class}>{$resposta['Paeatindicado']['atributo']}</td><td{$class}>{$resposta['Paeatindicado']['nomecompleto']}</td><td{$class}>{$resposta['Paeatindicado']['unidade']}</td><td{$class}>{$resposta['Paeatindicado']['referenciavaga']}</td><td{$class}>{$resposta['Paeatindicado']['responsavel']}</td><td{$class}>{$resposta['Paeatindicado']['privilegio']}</td><td{$class}>{$resposta['Paeatindicado']['created']}</td><td{$class}>{$resposta['Paeatindicado']['matriculado']}$check</td><td{$class}>{$acao}</td></tr>";
			
//			$mensagem .= "	<tr ><td{$class}>{$resposta['Paeatindicado']['prioridade']}</td><td{$class}>{$resposta['Paeatindicado']['atributo']}</td><td{$class}>{$resposta['Paeatindicado']['nomecompleto']}</td><td{$class}>{$resposta['Paeatindicado']['unidade']}</td><td{$class}>{$resposta['Paeatindicado']['referenciavaga']}</td><td{$class}>{$resposta['Paeatindicado']['responsavel']}</td><td{$class}>{$resposta['Paeatindicado']['privilegio']}</td><td{$class}>{$resposta['Paeatindicado']['ip']}</td><td{$class}>{$resposta['Paeatindicado']['created']}</td><td{$class}>{$acao}</td></tr>";
			
			}
			$mensagem.="</table>";
			$dados = $mensagem;
			$ok = 1;
			
		}
		if($this->params['form']['opcao']=='busca'){
		$ok = 1;
			$tipo = 'lista';
			$listanomes='select * from militars 
			inner join postos on (postos.id=militars.posto_id)
			inner join especialidades on (especialidades.id=militars.especialidade_id)
			inner join quadros on (quadros.id=especialidades.quadro_id)
			where nm_completo like "%'.$this->data['Paeat']['nome'].'%"  and ativa>0 order by nm_completo asc';
			$resultado=$this->Paeat->query($listanomes);
			$lista = '<option value=""></option>';
			foreach($resultado as $dado){
				$lista.= '<option value="'.$dado['militars']['id'].'">'.$dado['postos']['sigla_posto'].' '.$dado['quadros']['sigla_quadro'].' '.$dado['especialidades']['nm_especialidade'].' '.$dado['militars']['nm_completo'].'</option>';
			}
		}
		
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$dados)).'", "total":"'.$total.'", "lista":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$lista)).'", "tipo":"'.$tipo.'", "erro":"'.$erro.'", "mensagemerro":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$mensagemerro)).'" }';
		exit();
			}

	function externomatriculado(){
                $ok = 1;
                if($this->params['form']['valor']==true){
                    $autorizado = 'S';
                }else{
                    $autorizado = 'N';
                }
                $atualiza='update paeatsindicados set autorizado="'.$autorizado.'" where id='.$this->params['form']['id'];
               // echo $atualiza;
                $executa=$this->Paeat->query($atualiza);
                if(!$executa){
                    $ok = 0;
                }
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'","mensagem":""}';
		exit();
				
	}
	function externocursosrealizados(){
			$ok = 1;
			$listacursos='select * from pefcr, militars where Ident=militars.identidade and militars.id="'.$this->data['Paeat']['militarid'].'" order by dtInicio asc';
			//echo $listacursos;
			$mensagem= "<table cellpadding='0' cellspacing='0' width='100%'><tr><th>Curso</th><th>Inicio</th><th>Termino</th><th>Grau</th><th>Local</th><th>CPF</th></tr>";
			$i=0;
			$consulta=$this->Paeat->query($listacursos);
			//print_r($consulta);
			foreach($consulta as $dado){
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			$mensagem .= "	<tr ><td{$class}>{$dado['pefcr']['codcurso']}</td><td{$class}>{$dado['pefcr']['dtInicio']}</td><td{$class}>{$dado['pefcr']['dtTerm']}</td><td{$class}>{$dado['pefcr']['grau']}</td><td{$class}>{$dado['pefcr']['local']}</td><td{$class}>{$dado['pefcr']['cpf']}</td></tr>";
			}
			
			$mensagem.="</table>";
			
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode((str_replace("\n"," ",($mensagem)))).'"}';
		exit();
				
	}
	function indexExcel($id = null)
	{

//		$this->layout = 'openoffice' ; //this will use the pdf.thtml layout
		$this->layout = 'excel' ; //this will use the pdf.thtml layout
		$filtro = "";
		//$id = null;
		if(!empty($id)){
			$filtro = "where Paeat.id='$id'";
		}
		
		$sql = "select Militar.nm_guerra , Posto.sigla_posto , Quadro.sigla_quadro, Especialidade.nm_especialidade , Militar.nm_completo ,
		 Militar.cpf, Militar.saram , Militar.identidade , Militar.dt_formacao , Militar.dt_ultima_promocao , Militar.total_beneficiarios,
		 Unidade.sigla_unidade , Setor.sigla_setor, Paeat.codcurso, Paeat.inicio, Paeat.fim, Paeat.local, Paeat.turma,
		 Paeatsindicado.id,Paeatsindicado.paeat_id, Paeatsindicado.militar_id, Paeat.id, Paeatsindicado.unidade, Paeatsindicado.nomecompleto, Paeatsindicado.referenciavaga,
		 Paeatsindicado.responsavel , Paeatsindicado.privilegio, Paeatsindicado.prioridade, Paeatsindicado.atributo
		FROM militars as Militar
		INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
		INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
		LEFT JOIN setors as Setor on (Militar.setor_id = Setor.id)
		INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id)
		inner join paeatsindicados Paeatsindicado on (Paeatsindicado.militar_id=Militar.id)
		inner join paeats Paeat on (Paeat.id=Paeatsindicado.paeat_id)
		$filtro
		order by  Paeat.indicacao asc, Paeat.codcurso asc,  Paeatsindicado.responsavel asc, Paeatsindicado.privilegio asc, Paeatsindicado.referenciavaga asc, Paeatsindicado.prioridade asc, Paeatsindicado.atributo asc ";

		//echo $sql;
		$dados = $this->Paeat->query($sql);
		//print_r($dados);
		//exit();
		
		//$cursos = "";
		$nome = 'paeat_indicados';
		$this->set(compact('dados','nome'));
		$this->render();
	}
	
	function externocadastropaeat($id){
		$tipo = 'registros';
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
		$privilegio = $u[0]['Privilegio']['descricao'];
		
  
      $this->data['Paeat']['obs']=rawurlencode ($this->data['Paeat']['obs']);


		if(empty($this->data['Paeat']['indicacao'])){
			unset($this->data['Paeat']['indicacao']);
		}else{
			list($dia,$mes,$ano)=explode('-',$this->data['Paeat']['indicacao']);
			$this->data['Paeat']['indicacao']="$ano-$mes-$dia";
		}
		if(empty($this->data['Paeat']['inicio'])){
			unset($this->data['Paeat']['inicio']);
		}else{
			$this->data['Paeat']['inicio']=date('Y-m-d',strtotime($this->data['Paeat']['inicio']));
			if(empty($this->data['Paeat']['inicio'])){
				$this->data['Paeat']['indicacao']=date('Y-m-d',strtotime($this->data['Paeat']['inicio'].' -50 days'));
			}
		}
		if(empty($this->data['Paeat']['fim'])){
			unset($this->data['Paeat']['fim']);
		}else{
			$this->data['Paeat']['fim']=date('Y-m-d',strtotime($this->data['Paeat']['fim']));
		}
		if(empty($this->data['Paeat']['inicio2'])){
			unset($this->data['Paeat']['inicio2']);
		}else{
			$this->data['Paeat']['inicio2']=date('Y-m-d',strtotime($this->data['Paeat']['inicio2']));
		}
		if(empty($this->data['Paeat']['fim2'])){
			unset($this->data['Paeat']['fim2']);
		}else{
			$this->data['Paeat']['fim2']=date('Y-m-d',strtotime($this->data['Paeat']['fim2']));
		}
		if(empty($this->data['Paeat']['inicio3'])){
			unset($this->data['Paeat']['inicio3']);
		}else{
			$this->data['Paeat']['inicio3']=date('Y-m-d',strtotime($this->data['Paeat']['inicio3']));
		}
		if(empty($this->data['Paeat']['fim3'])){
			unset($this->data['Paeat']['fim3']);
		}else{
			$this->data['Paeat']['fim3']=date('Y-m-d',strtotime($this->data['Paeat']['fim3']));
		}
					
		//echo '<pre>'.print_r($this->data,true).'<\pre>';
		$erro= '';
		$ok = 2;
		$flagInsercao=$this->data['Paeat']['id'];
		if($flagInsercao==0 || empty($flagInsercao)){
			unset($this->data['Paeat']['id']);
         unset($GLOBALS[$this->data['Paeat']['id']]);                        
		}
		//echo '<pre>'.print_r($this->data,true).'<\pre>';
                
		if(($this->data['acao']=='INSERIR')||($this->data['acao']=='ATUALIZAR')){
         if($flagInsercao==0 || empty($flagInsercao)){
				$this->Paeat->create();
			}
                       // $this->Paeat->set(array($this->data['Paeat']));
                        //print_r($this->data);
			if($this->Paeat->save($this->data)){
				$erro = '<br><br><b>Dados atualizados com sucesso!</b><br><br><br>';
				$idpaeat = $this->Paeat->id;
				$consultacurso = "select * from cursos Curso where codigo='{$this->data['Paeat']['codcurso']}' ";
				$dadoscurso = $this->Paeat->query($consultacurso);
				$this->data['Paeat']['objetivo'] = $dadoscurso[0]['Curso']['objetivo'];
				$this->data['Paeat']['prerequisitos'] = $dadoscurso[0]['Curso']['pre_requisito'];
				$this->data['Paeat']['disciplinas'] = $dadoscurso[0]['Curso']['descricao'];
				
				
//				$insere = "insert into paeatsdistribuicaos (codcurso, objetivo, nivel, prerequisitos, disciplinas, indicacao, vaga, quantidade, paeat_id, ano, vagas, local, turma, inicio, fim, observacoes, ativado, conclusao, codplano, semhotel, local2, inicio2, fim2, local3, inicio3, fim3, vagasreserva, avisos, obs) values ('{$this->data['Paeat']['codcurso']}', '{$this->data['Paeat']['objetivo']}', '{$this->data['Paeat']['nivel']}', '{$this->data['Paeat']['prerequisitos']}', '{$this->data['Paeat']['disciplinas']}', '{$this->data['Paeat']['indicacao']}','{$this->data['Paeat']['local']}', '{$this->data['Paeat']['vagas']}', '{$idpaeat}', '{$this->data['Paeat']['ano']}', '{$this->data['Paeat']['vagas']}', '{$this->data['Paeat']['local']}', '{$this->data['Paeat']['turma']}', '{$this->data['Paeat']['inicio']}', '{$this->data['Paeat']['fim']}', '{$this->data['Paeat']['observacoes']}', '{$this->data['Paeat']['ativado']}', '{$this->data['Paeat']['conclusao']}', '{$this->data['Paeat']['codplano']}', '{$this->data['Paeat']['semhotel']}', '{$this->data['Paeat']['local2']}', '{$this->data['Paeat']['inicio2']}', '{$this->data['Paeat']['fim2']}','{$this->data['Paeat']['local3']}', '{$this->data['Paeat']['inicio3']}', '{$this->data['Paeat']['fim3']}', '{$this->data['Paeat']['vagas']}', '{$this->data['Paeat']['avisos']}', '{$this->data['Paeat']['obs']}') on duplicate key update indicacao='{$this->data['Paeat']['indicacao']}', vaga='{$this->data['Paeat']['local']}', quantidade='{$this->data['Paeat']['vagas']}', vagas='{$this->data['Paeat']['vagas']}', local='{$this->data['Paeat']['local']}', turma='{$this->data['Paeat']['turma']}', inicio='{$this->data['Paeat']['inicio']}', fim='{$this->data['Paeat']['fim']}', ativado='{$this->data['Paeat']['ativado']}', conclusao='{$this->data['Paeat']['conclusao']}', codplano='{$this->data['Paeat']['codplano']}', semhotel='{$this->data['Paeat']['semhotel']}', local2='{$this->data['Paeat']['local2']}',inicio2='{$this->data['Paeat']['inicio2']}', fim2='{$this->data['Paeat']['fim2']}', local3='{$this->data['Paeat']['local3']}', inicio3='{$this->data['Paeat']['inicio3']}', fim3='{$this->data['Paeat']['fim3']}', vagasreserva='{$this->data['Paeat']['vagas']}', avisos='{$this->data['Paeat']['avisos']}', obs='{$this->data['Paeat']['obs']}'";
$insere = "insert into paeatsdistribuicaos (codcurso, objetivo, nivel, prerequisitos, disciplinas, indicacao, vaga, quantidade, paeat_id, ano, vagas, local, turma, inicio, fim, observacoes, ativado, conclusao, codplano, semhotel, vagasreserva, avisos, obs)
values ('{$this->data['Paeat']['codcurso']}', '{$this->data['Paeat']['objetivo']}', '{$this->data['Paeat']['nivel']}', '{$this->data['Paeat']['prerequisitos']}', '{$this->data['Paeat']['disciplinas']}', '{$this->data['Paeat']['indicacao']}','{$this->data['Paeat']['local']}', '{$this->data['Paeat']['vagas']}', '{$idpaeat}', '{$this->data['Paeat']['ano']}', '{$this->data['Paeat']['vagas']}', '{$this->data['Paeat']['local']}', '{$this->data['Paeat']['turma']}', '{$this->data['Paeat']['inicio']}', '{$this->data['Paeat']['fim']}', '{$this->data['Paeat']['observacoes']}', '{$this->data['Paeat']['ativado']}', '{$this->data['Paeat']['conclusao']}', '{$this->data['Paeat']['codplano']}', '{$this->data['Paeat']['semhotel']}', '{$this->data['Paeat']['vagas']}', '{$this->data['Paeat']['avisos']}', '{$this->data['Paeat']['obs']}') on duplicate key update indicacao='{$this->data['Paeat']['indicacao']}', vaga='{$this->data['Paeat']['local']}', quantidade='{$this->data['Paeat']['vagas']}', vagas='{$this->data['Paeat']['vagas']}', local='{$this->data['Paeat']['local']}', turma='{$this->data['Paeat']['turma']}', inicio='{$this->data['Paeat']['inicio']}', fim='{$this->data['Paeat']['fim']}', ativado='{$this->data['Paeat']['ativado']}', conclusao='{$this->data['Paeat']['conclusao']}', codplano='{$this->data['Paeat']['codplano']}', semhotel='{$this->data['Paeat']['semhotel']}', local2='{$this->data['Paeat']['local2']}',
inicio2='{$this->data['Paeat']['inicio2']}', fim2='{$this->data['Paeat']['fim2']}', local3='{$this->data['Paeat']['local3']}', inicio3='{$this->data['Paeat']['inicio3']}', fim3='{$this->data['Paeat']['fim3']}', vagasreserva='{$this->data['Paeat']['vagas']}', avisos='{$this->data['Paeat']['avisos']}', obs='{$this->data['Paeat']['obs']}'";
//echo $insere;
 
            $this->Paeat->query($insere);
				$erro= '<br><br><b>Dados atualizados!</b><br><br><br>';
				$ok=1;

			}else{
				$erro= '<br><br><b>Dados não atualizados!</b><br><br><br>';
				$ok = 0;
				
			}
		}
		
		
		$registro="select * from paeats Paeat where Paeat.id=".$id; //$this->data['Paeat']['id'];
		$resultado=$this->Paeat->query($registro);
		
		$mensagem = '';
		
		

		//print_r($resultado);
                //echo json_encode($resultado);
                
		foreach($resultado as $dado){
			$mensagem.=',"ano":"'.$dado['Paeat']['ano'].'",';	
			$mensagem.='"id":"'.$dado['Paeat']['id'].'",';	
			if(!empty($dado['Paeat']['indicacao'])){
			$mensagem.='"indicacao":"'.date('j-n-Y',strtotime($dado['Paeat']['indicacao'])).'",';
			}else{
				$mensagem.='"indicacao":"",';
			}	
			
			$mensagem.='"codcurso":"'.$dado['Paeat']['codcurso'].'",';	
			$mensagem.='"vagas":"'.$dado['Paeat']['vagas'].'",';	
			$mensagem.='"local":"'.$dado['Paeat']['local'].'",';	
			$mensagem.='"turma":"'.$dado['Paeat']['turma'].'",';	
			if(!empty($dado['Paeat']['inicio'])){
				$mensagem.='"inicio":"'.date('j-n-Y',strtotime($dado['Paeat']['inicio'])).'",';
			}else{
				$mensagem.='"inicio":"",';
			}	
			if(!empty($dado['Paeat']['fim'])){
				$mensagem.='"fim":"'.date('j-n-Y',strtotime($dado['Paeat']['fim'])).'",';	
			}else{
				$mensagem.='"fim":"",';
			}	
			$mensagem.='"observacoes":"'.$dado['Paeat']['observacoes'].'",';	
			$mensagem.='"conclusao":"'.$dado['Paeat']['conclusao'].'",';	
			$mensagem.='"codplano":"'.$dado['Paeat']['codplano'].'",';	
			$mensagem.='"semhotel":"'.$dado['Paeat']['semhotel'].'",';	
			$mensagem.='"local2":"'.$dado['Paeat']['local2'].'",';	
			if(!empty($dado['Paeat']['inicio2'])){
				$mensagem.='"inicio2":"'.date('j-n-Y',strtotime($dado['Paeat']['inicio2'])).'",';	
			}else{
				$mensagem.='"inicio2":"",';
			}	
			if(!empty($dado['Paeat']['fim2'])){
				$mensagem.='"fim2":"'.date('j-n-Y',strtotime($dado['Paeat']['fim2'])).'",';	
			}else{
				$mensagem.='"fim2":"",';
			}	
			$mensagem.='"local3":"'.$dado['Paeat']['local3'].'",';	
			if(!empty($dado['Paeat']['inicio3'])){
				$mensagem.='"inicio3":"'.date('j-n-Y',strtotime($dado['Paeat']['inicio3'])).'",';	
			}else{
				$mensagem.='"inicio3":"",';
			}	
			if(!empty($dado['Paeat']['fim3'])){
				$mensagem.='"fim3":"'.date('j-n-Y',strtotime($dado['Paeat']['fim3'])).'",';
			}else{
				$mensagem.='"fim3":"",';
			}	
				
			$mensagem.='"vagasreserva":"'.$dado['Paeat']['vagasreserva'].'",';	
			//$mensagem.='"avisos":"'.iconv('ISO-8859-1','UTF-8',$dado['Paeat']['avisos']).'",';	
			$mensagem.='"avisos":"'.$dado['Paeat']['avisos'].'",';	
			$mensagem.='"status":"'.$dado['Paeat']['status'].'",';	

			$mensagem.='"obs":"'.$dado['Paeat']['obs'].'",';	
			$mensagem.='"tipo":"'.$dado['Paeat']['tipo'].'",';	
			$mensagem.='"subtipo":"'.$dado['Paeat']['subtipo'].'",';	
			$mensagem.='"arquivado":"'.$dado['Paeat']['arquivado'].'"';	
		}
		
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'"'.$mensagem.',"erro":"'.$erro.'"}';
//		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$dados)).'", "total":"'.$total.'", "lista":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$lista)).'", "tipo":"'.$tipo.'", "erro":"'.$erro.'", "mensagemerro":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$mensagemerro)).'" }';
		exit();
			}
	
	function externoatualizapaeat(){
		$tipo = 'registros';
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
		$privilegio = $u[0]['Privilegio']['descricao'];
		$mensagem = '';
		$ok=0;
		//echo '<pre>'.print_r($this->data,true).'<\pre>';
		
		if($this->Paeat->Save($this->data['Paeat'])){
			$mensagem='Registro atualizado!';
			$ok=1;
		}else{
			$mensagemerro='O registro não foi atualizado!';
		}
		
		
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$mensagem)).'", "mensagemerro":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$mensagemerro)).'" }';
		exit();
			}
                        
  function delete($paeatId = null){
		$this->layout = 'ajax';
		$u=$this->Session->read('Usuario');
                $mensagemerro="";
                $mensagem="";
                
		if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
			$this->Paeat->recursive = 0;
		}
		
		if ($this->Paeat->delete($paeatId)) {
			$ok = '1';
                        $mensagem="Registro excluído com sucesso!";
		}else{
			$ok = '0';
                        $mensagemerro="Registro não foi excluído!";
		}
		
		
		header('Content-type: application/x-json');

		echo '{ "ok":"'.$ok.'", "mensagem":"'.$mensagem.'", "mensagemerro":"'.$mensagemerro.'" }';

		exit();  	
  }	
                        
		
}
?>
