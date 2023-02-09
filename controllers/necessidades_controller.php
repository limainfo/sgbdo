<?php
class NecessidadesController extends AppController {

	var $name = 'Necessidades';

	function index() {
		$this->Necessidade->recursive = 0;
		$this->set('necessidades', $this->paginate());
		$this->flash(__('Tentativa inválida'), array('action' => 'add'));
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid necessidade', true), array('action' => 'index'));
		}
		$this->set('necessidade', $this->Necessidade->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $u = $this->Session->read('Usuario');
                        $usuario = $u[0][0]['nome'];
                        $privilegio = $u[0]['Privilegio']['descricao'];
                        $this->Necessidade->query($monitora);

                        $this->data['Necessidade']['responsavel'] = $usuario;
                        $this->data['Necessidade']['privilegio'] = $privilegio;
                        $this->data['Necessidade']['ip'] = $ip;
                
                    
			$this->Necessidade->create();
			if ($this->Necessidade->save($this->data)) {
				$this->flash(__('Necessidade saved.', true), array('action' => 'index'));
			} else {
			}
		}
		$solicitantes = $this->Necessidade->query("select Necessidade.divisao_solicitante  from necessidades Necessidade group by Necessidade.divisao_solicitante ");
		$quadros = $this->Necessidade->Quadro->find('list');
		$unidades = $this->Necessidade->Unidade->find('list');
		$cursos = $this->Necessidade->Curso->find('list');
		$this->set(compact('unidades', 'cursos','quadros','solicitantes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid necessidade', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Necessidade->save($this->data)) {
				$this->flash(__('The necessidade has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Necessidade->read(null, $id);
		}
		$especialidades = $this->Necessidade->Especialidade->find('list');
		$setors = $this->Necessidade->Setor->find('list');
		$cursos = $this->Necessidade->Curso->find('list');
		$this->set(compact('especialidades', 'setors', 'cursos'));
	}

	function delete($id = null) {
		$this->layout = 'ajax';
		$ok = 0;
                $registro=$this->Necessidade->query('select * from necessidades Necessidade where id='.$id);
                $espid=$registro[0]['Necessidade']['especialidade_id'];
                $uniid=$registro[0]['Necessidade']['unidade_id'];
                $curid=$registro[0]['Necessidade']['curso_id'];
                $anoid=$registro[0]['Necessidade']['ano'];
                
			$consultaFiltrada = "
			select * from necessidades Necessidade
			inner join cursos Curso on (Curso.id=Necessidade.curso_id)
			inner join especialidades Especialidade on (Especialidade.id=Necessidade.especialidade_id)
			inner join quadros Quadro on (Quadro.id=Necessidade.quadro_id)
			inner join unidades Unidade on (Unidade.id=Necessidade.unidade_id)
			where Necessidade.especialidade_id='$espid'
                                and Necessidade.unidade_id='$uniid'
                                and Necessidade.curso_id='$curid'
                                and Necessidade.ano='$anoid'
			";
			//echo $consultaFiltrada;
                        
		if (!$id) {
			$mensagem = 'ID inválido';
		}
		if ($this->Necessidade->delete($id)) {
			$mensagem = 'Registro excluído';
			$ok = 1;
		}else{
			$mensagem = 'Falha na operação.';
		}
		$mensagem="";
		$registros = $this->Necessidade->query($consultaFiltrada);
				
		$atual= "<h2>Cadastros atuais</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Ano</th><th>Unidade</th><th>Solicitante</th><th>Quadro</th><th>Esp</th><th>Curso</th><th>Classe</th><th>Efetivo</th><th>Nec</th><th>Existe</th><th>Pedido</th><th>Diária R$</th><th>AjudaCusto</th><th>Passagem R$</th><th>Responsável</th><th>Privilégio</th><th>IP</th><th>Inserido</th><th>Atualizado</th><th>Ações</th></tr>";


		$i = 0;
		foreach ($registros as $registro):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			$diferenca="select count(*) as diferenca from militars_cursos
			inner join militars on (militars.id=militars_cursos.militar_id and militars.ativa>0)
			inner join cursos on (cursos.id=militars_cursos.curso_id )
			inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
			inner join especialidades on (militars.especialidade_id=especialidades.id and especialidades.id='{$registro['Especialidade']['id']}') 
			group by cursos.id, especialidades.id, militars.unidade_id 
			";

			$dif=$this->Necessidade->query($diferenca);
			$vdif=$dif[0][0]['diferenca'];
			$totalSetores="select count(*) as todos from militars
			inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
			where militars.ativa>0 and militars.especialidade_id='{$registro['Especialidade']['id']}'  and militars.unidade_id=setors.unidade_id
			group by militars.unidade_id, militars.especialidade_id
			";
			$Tot=$this->Necessidade->query($totalSetores);
			$efetivo=$Tot[0][0]['todos'];
			
			$acao = "<a onclick='exibe(\"".rawurlencode($registro['Necessidade']['id']).'" ,"'.rawurlencode($registro['Necessidade']['ano']).'" ,"'.rawurlencode($registro['Quadro']['sigla_quadro']).'" ,"'.rawurlencode($registro['Especialidade']['nm_especialidade']).'", "'.rawurlencode($registro['Unidade']['sigla_unidade']).'", "'.rawurlencode($registro['Setor']['sigla_setor']).'", "'.rawurlencode($registro['Curso']['codigo']).'", "'.rawurlencode($registro['Necessidade']['necessario']).'", "'.rawurlencode($registro['Necessidade']['classe']).'", "'.rawurlencode($registro['Necessidade']['referencia']).'", "'.rawurlencode($registro['Necessidade']['valor_diaria']).'", "'.rawurlencode($registro['Necessidade']['valor_passagem']).'", "'.rawurlencode($registro['Necessidade']['divisao_solicitante']).'", "'.rawurlencode($registro['Necessidade']['valor_ajuda_custo'])."\"); return false;'   href=\"#\"><img border=\"0\" title=\"Editar\" alt=\"Excluir\" src=\"".$this->webroot."img/lapis.gif\"/></a>";
			
			$acao .= "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$registro['Curso']['codigo'].'-'.$registro['Especialidade']['nm_especialidade'].'-'.$registro['Setor']['sigla_setor']." ?\" ,\"javascript:excluiRegistro(".$registro['Necessidade']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

			$qtdexistente = "<a onclick=\"window.open('{$this->webroot}cursos/view/{$registro['Curso']['id']}/{$registro['Setor']['id']}/{$registro['Especialidade']['id']}/','','');\" href=\"#\" >{$vdif}</a>";
			
			$atual .= "	<tr {$class}><td>{$registro['Necessidade']['ano']}</td><td>{$registro['Unidade']['sigla_unidade']}</td><td>{$registro['Necessidade']['divisao_solicitante']}</td><td>{$registro['Quadro']['sigla_quadro']}</td><td>{$registro['Especialidade']['nm_especialidade']}</td><td>{$registro['Curso']['codigo']}</td><td>{$registro['Necessidade']['classe']}</td><td>$efetivo</td><td>{$registro['Necessidade']['necessario']}</td><td>$qtdexistente</td><td style='background-color:#ffff00;text-align:center;'>$solicitacao</td><td>".number_format($registro['Necessidade']['valor_diaria'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_ajuda_custo'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_passagem'], 2, ',', '.')."</td><td>{$registro['Necessidade']['responsavel']}</td><td>{$registro['Necessidade']['privilegio']}</td><td>{$registro['Necessidade']['ip']}</td><td>{$registro['Necessidade']['created']}</td><td>{$registro['Necessidade']['updated']}</td><td>{$acao}</td></tr>";


			endforeach;
			$atual.="</table>";



			
                
                 $atual=json_encode($atual);

		header('Content-type: application/x-json');
$retornoajax=<<<Ajax
{ "ok":$ok, "mensagem":"$mensagem", "registros":$atual}       
Ajax;
echo $retornoajax;
                
		exit();
		
	}
	function externoupdatesetor($unidade_id = null) {
		$this->layout = 'ajax';

		if(strlen($unidade_id)>6) {
			$filtro = 'Setor.unidade_id="'.$unidade_id.'"';
			$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
			//$this->Necessidade->Setor->recursive=0;
			//$consulta = $this->Necessidade->Setor->find('all',array('conditions'=>array('Setor.unidade_id'=>$unidade_id)));
//			print_r($consulta);
			$lista[0] = '';
			$lista[0] = '---';
                       //print_r($consulta);
			foreach($consulta as $dados){
				$lista[$dados['Setor']['id']]=$dados['Setor']['sigla_setor'];
  				//echo "<option value='{$dados['Setor']['id']}'>{$dados['Setor']['sigla_setor']}</option>";
			}

			if(!empty($lista)) {foreach($lista as $k => $v) {$conteudo .= '<option value="'.$k.'">'.$v;	} }
                        $saida = json_encode($conteudo);
                        echo $conteudo;

		}


		exit();
	}

	function externoupdateunidade($especialidade_id = null) {
		$this->layout = 'ajax';
		if(strlen($especialidade_id)>6) {
//			$consulta = $this->Necessidade->Setor->find('all',array('conditions'=>array('Setor.unidade_id'=>$unidade_id)));
			$consulta = $this->Necessidade->query('select Unidade.id, Unidade.sigla_unidade from unidades Unidade inner join militars on (militars.especialidade_id="'.$especialidade_id.'" and Unidade.id=militars.unidade_id) order by Unidade.sigla_unidade asc');
			
                        
//			print_r($consulta);
			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['Unidade']['id']]=$dados['Unidade']['sigla_unidade'];
			}
         $conteudo = "<option value=''>Selecione abaixo";
			if(!empty($lista)) {
	  			foreach($lista as $k => $v) {
	  				$conteudo .= '<option value="'.$k.'">'.$v;
	  			}
	 		 }
                        $saida = json_encode($conteudo);
                        echo $conteudo;

		}


		exit();
	}

	function externoupdateespecialidade($quadro_id = null) {
		$this->layout = 'ajax';
		if(strlen($quadro_id)>2) {
			//$consulta = $this->Necessidade->query('select Setor.id, Setor.sigla_Setor from setors Setor where '.$filtro.' order by Setor.sigla_setor asc');
			$this->Necessidade->Especialidade->recursive=0;
			$consulta = $this->Necessidade->Especialidade->find('all',array('conditions'=>array('Especialidade.quadro_id'=>$quadro_id)));

			//print_r($consulta);
			$lista[0] = '';
			$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['Especialidade']['id']]=$dados['Especialidade']['nm_especialidade'];
			}
         $conteudo = "<option value=''>Selecione abaixo";
			if(!empty($lista)) {
	  			foreach($lista as $k => $v) {
	  				$conteudo .= '<option value="'.$k.'">'.$v;
	  			}
	 		 }
                        $saida = json_encode($conteudo);
                        echo $conteudo;
	 		 
		}


		exit();
	}
	function externoupdatecurso($curso_id = null) {
		$this->layout = 'ajax';
		$filtro = 'Curso.id='.$curso_id;	

		$consulta = $this->Necessidade->query('select Curso.objetivo  from cursos Curso  where '.$filtro);
		//print_r($consulta);
		$conteudo = $consulta[0]['Curso']['objetivo'];
	
		$saida = json_encode($conteudo);
		//echo $conteudo;
	 		 
		exit();
	}	
	
	function externoadd() {
		$this->layout = 'ajax';
                
		if (!empty($this->data)) {
			$this->data['Necessidade']['setor_id']='';
			$ip = $_SERVER['REMOTE_ADDR'];
			$u = $this->Session->read('Usuario');
			$usuario = $u[0][0]['nome'];
			$privilegio = $u[0]['Privilegio']['descricao'];
			$this->Necessidade->query($monitora);

			$this->data['Necessidade']['responsavel'] = $usuario;
			$this->data['Necessidade']['privilegio'] = $privilegio;
			$this->data['Necessidade']['ip'] = $ip;
			//print_r($this->data);
			$this->Necessidade->create();
			$mensagem="";
			if ($this->Necessidade->save($this->data)) {
				$ok = '1';
				$mensagem="Dados gravados com sucesso!";
			} else {
				$ok='0';
				$mensagem="Os dados não foram gravados. Verifique se os campos do formulário estão preenchidos corretamente !";
			}

			//$consultaId = $this->Necessidade->getLastInsertId();
			$consultaFiltrada = "
			select * from necessidades Necessidade
			inner join cursos Curso on (Curso.id=Necessidade.curso_id)
			inner join especialidades Especialidade on (Especialidade.id=Necessidade.especialidade_id)
			inner join quadros Quadro on (Quadro.id=Necessidade.quadro_id)
			inner join unidades Unidade on (Unidade.id=Necessidade.unidade_id)
			where Necessidade.curso_id={$this->data['Necessidade']['curso_id']} and Necessidade.especialidade_id='{$this->data['Necessidade']['especialidade_id']}' and Necessidade.ano={$this->data['Necessidade']['ano']}			
			 order by Unidade.sigla_unidade asc, Especialidade.nm_especialidade asc, Curso.codigo asc 
			";
			
			//echo $consultaFiltrada;
			$registros = $this->Necessidade->query($consultaFiltrada);
			//echo $consultaFiltrada;
			//print_r($registros);
				
		$atual= "<h2>Cadastros atuais</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Ano</th><th>Unidade</th><th>Solicitante</th><th>Quadro</th><th>Esp</th><th>Curso</th><th>Classe</th><th>Efetivo</th><th>Nec</th><th>Existe</th><th>Pedido</th><th>Diária R$</th><th>AjudaCusto</th><th>Passagem R$</th><th>Responsável</th><th>Privilégio</th><th>IP</th><th>Inserido</th><th>Atualizado</th><th>Ações</th></tr>";


		$i = 0;
		foreach ($registros as $registro):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			$diferenca="select count(*) as diferenca from militars_cursos
			inner join militars on (militars.id=militars_cursos.militar_id and militars.ativa>0)
			inner join cursos on (cursos.id=militars_cursos.curso_id )
			inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
			inner join especialidades on (militars.especialidade_id=especialidades.id and especialidades.id='{$registro['Especialidade']['id']}') 
			group by cursos.id, especialidades.id, militars.unidade_id 
			";

			$dif=$this->Necessidade->query($diferenca);
			$vdif=$dif[0][0]['diferenca'];
			$totalSetores="select count(*) as todos from militars
			inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
			where militars.ativa>0 and militars.especialidade_id='{$registro['Especialidade']['id']}'  and militars.unidade_id=setors.unidade_id
			group by militars.unidade_id, militars.especialidade_id
			";
			$Tot=$this->Necessidade->query($totalSetores);
			$efetivo=$Tot[0][0]['todos'];
			
			$acao = "<a onclick='exibe(\"".rawurlencode($registro['Necessidade']['id']).'" ,"'.rawurlencode($registro['Necessidade']['ano']).'" ,"'.rawurlencode($registro['Quadro']['sigla_quadro']).'" ,"'.rawurlencode($registro['Especialidade']['nm_especialidade']).'", "'.rawurlencode($registro['Unidade']['sigla_unidade']).'", "'.rawurlencode($registro['Setor']['sigla_setor']).'", "'.rawurlencode($registro['Curso']['codigo']).'", "'.rawurlencode($registro['Necessidade']['necessario']).'", "'.rawurlencode($registro['Necessidade']['classe']).'", "'.rawurlencode($registro['Necessidade']['referencia']).'", "'.rawurlencode($registro['Necessidade']['valor_diaria']).'", "'.rawurlencode($registro['Necessidade']['valor_passagem']).'", "'.rawurlencode($registro['Necessidade']['divisao_solicitante']).'", "'.rawurlencode($registro['Necessidade']['valor_ajuda_custo'])."\"); return false;'   href=\"#\"><img border=\"0\" title=\"Editar\" alt=\"Excluir\" src=\"".$this->webroot."img/lapis.gif\"/></a>";
			
			$acao .= "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$registro['Curso']['codigo'].'-'.$registro['Especialidade']['nm_especialidade'].'-'.$registro['Setor']['sigla_setor']." ?\" ,\"javascript:excluiRegistro(".$registro['Necessidade']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

			$qtdexistente = "<a onclick=\"window.open('{$this->webroot}cursos/view/{$registro['Curso']['id']}/{$registro['Setor']['id']}/{$registro['Especialidade']['id']}/','','');\" href=\"#\" >{$vdif}</a>";
			
			$atual .= "	<tr {$class}><td>{$registro['Necessidade']['ano']}</td><td>{$registro['Unidade']['sigla_unidade']}</td><td>{$registro['Necessidade']['divisao_solicitante']}</td><td>{$registro['Quadro']['sigla_quadro']}</td><td>{$registro['Especialidade']['nm_especialidade']}</td><td>{$registro['Curso']['codigo']}</td><td>{$registro['Necessidade']['classe']}</td><td>$efetivo</td><td>{$registro['Necessidade']['necessario']}</td><td>$qtdexistente</td><td style='background-color:#ffff00;text-align:center;'>$solicitacao</td><td>".number_format($registro['Necessidade']['valor_diaria'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_ajuda_custo'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_passagem'], 2, ',', '.')."</td><td>{$registro['Necessidade']['responsavel']}</td><td>{$registro['Necessidade']['privilegio']}</td><td>{$registro['Necessidade']['ip']}</td><td>{$registro['Necessidade']['created']}</td><td>{$registro['Necessidade']['updated']}</td><td>{$acao}</td></tr>";


			endforeach;
			$atual.="</table>";


			//$ok=1;

			


				
		}

		$atual=json_encode($atual);

		header('Content-type: application/x-json');
$retornoajax=<<<Ajax
{ "ok":$ok, "mensagem":"$mensagem", "registros":$atual}       
Ajax;
echo $retornoajax;

			//header('Content-type: application/x-json');
			//$ok = urlencode(print_r($this, true));

			//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
			//echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';
			//echo $atual;


			exit();
	}
	
	function externopdf($ano = null)
	{
		$this->layout = 'pdf'; 
		//$this->layout = 'admin'; 

		
		$ano = $this->data['Necessidade']['ano'];
		
		$this->set('ano',$this->data['Necessidade']['ano']);
		$this->set('unidade',$this->data['Necessidade']['unidade_responsavel']);
		$this->set('siat',$this->data['Necessidade']['siat']);
		$this->set('chefe',$this->data['Necessidade']['chefe']);
		$this->set('divisao',$this->data['Necessidade']['divisao_solicitante']);
		$filtrodivisao = '';
			$filtrodivisao = ' and Necessidade.divisao_solicitante = "'.$this->data['Necessidade']['solicitantes'].'"';
		//--------
		$sql = 'select Necessidade.ano, Curso.codigo, Curso.descricao,  Unidade.sigla_unidade, sum(Necessidade.necessario) total,
		 Necessidade.referencia, Unidade.id, Curso.id, Necessidade.setor_id, Especialidade.id, sum(Necessidade.valor_diaria) as diaria, sum(Necessidade.valor_ajuda_custo) as ajudacusto, sum(Necessidade.valor_passagem) as passagem, Necessidade.divisao_solicitante from cursos Curso
		inner join necessidades Necessidade on (Necessidade.curso_id=Curso.id and Necessidade.ano='.$ano.$filtrodivisao.')
		inner join unidades Unidade on (Unidade.id=Necessidade.unidade_id)
		inner join especialidades Especialidade on (Especialidade.id=Necessidade.especialidade_id)
		group by Necessidade.ano, Necessidade.curso_id, Necessidade.unidade_id, Necessidade.especialidade_id, Necessidade.divisao_solicitante
		order by Necessidade.divisao_solicitante asc, Curso.codigo asc, Unidade.sigla_unidade asc, length(Necessidade.referencia) desc
		';
		//echo $sql;exit();
		//group by Necessidade.curso_id, Necessidade.unidade_id
		$resultados= $this->Necessidade->query($sql);
                
		//var_dump($resultados);exit();
		$qtdobtida = count($resultados);
		
		/* */
		$conta=0;
		$somaunidades=0;
		$tamanhoreferencia = 0;
		$maiorreferencia = 0;
		unset($primeiro);
		$primeiro=$resultados[0]['Curso']['codigo'];
		$auxiliar['somaunidades']=0;
		$auxiliar['codigoanterior']=$resultados[0]['Curso']['codigo'];
		$vetor['Curso'][$resultados[0]['Curso']['codigo']]['totalvagas']=$resultados[0][0]['total'];
		foreach($resultados as $dados){
			$vetor['Curso'][$dados['Curso']['codigo']]['valor_diaria']=$dados[0]['diaria'];
			$vetor['Curso'][$dados['Curso']['codigo']]['valor_ajuda_custo']=$dados[0]['ajudacusto'];
			$vetor['Curso'][$dados['Curso']['codigo']]['valor_passagem']=$dados[0]['passagem'];
			$vetor['Curso'][$dados['Curso']['codigo']]['divisao_solicitante']=$dados['Necessidade']['divisao_solicitante'];
		if($primeiro==$dados['Curso']['codigo']){

				$vetor['Curso'][$dados['Curso']['codigo']]['codigo']=$dados['Curso']['codigo'];
				$vetor['Curso'][$dados['Curso']['codigo']]['descricao']=$dados['Curso']['descricao'];
				$vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['nome']=$dados['Unidade']['sigla_unidade'];
								
				$diferenca="select count(*) as diferenca from militars_cursos
				inner join militars on (militars.id=militars_cursos.militar_id and militars.ativa>0)
				inner join cursos on (cursos.id=militars_cursos.curso_id and cursos.id={$dados['Curso']['id']})
				inner join unidades on (militars.unidade_id=setors.id and unidades.id='{$dados['Necessidade']['unidade_id']}' )
				inner join especialidades on (militars.especialidade_id=especialidades.id and especialidades.id='{$dados['Especialidade']['id']}') 
				group by militars.unidade_id,cursos.id, especialidades.id
				";
/*				$diferenca="select count(*) as diferenca from militars_cursos
				inner join militars on (militars.id=militars_cursos.militar_id and militars.ativa>0)
				inner join cursos on (cursos.id=militars_cursos.curso_id and cursos.id={$dados['Curso']['id']})
				inner join setors on (militars.setor_id=setors.id and setors.id={$dados['Necessidade']['setor_id']} )
				inner join especialidades on (militars.especialidade_id=especialidades.id and especialidades.id={$dados['Especialidade']['id']}) 
				group by setors.id, cursos.id, especialidades.id
				";

 */				//echo $diferenca;
				//exit();
				$dif=$this->Necessidade->query($diferenca);
				//$vdif=$dif[0][0]['diferenca'];

				//$somatorio = $dados[0]['total']-$vdif;
				$somatorio = $dados[0]['total'];
				
				$vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']=$somatorio;
				
				//$xx=$vetor['Curso'][$dados['Curso']['codigo']]['totalvagas'];
				$yy=($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']);
				$vetor['Curso'][$dados['Curso']['codigo']]['totalvagas']=$yy;
//Novos dados para o PDF
				
				if(($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']<=0)||empty($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas'])){
					unset($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]);
				}
										
				$var1= $vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas'];
				$var2 = $auxiliar['somaunidades'];
				$auxiliar['somaunidades']=$var1+$var2;

				if($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']>0){
					if(strlen($dados['Necessidade']['referencia'])>$maiorreferencia){
						$maiorreferencia = strlen($dados['Necessidade']['referencia']); 
						$vetor['Curso'][$dados['Curso']['codigo']]['justificativa'] =  $dados['Necessidade']['referencia'];
					}
					//$vetor['Curso'][$dados['Curso']['codigo']]['justificativa'] .= $vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['nome'].'->'.$dados['Necessidade']['referencia']."\r\n";
				}
    			$somaunidades++;
				$somatorio=0;
				
				
			}else{
				$somaunidades=0;
				$somatorio=0;
				$maiorreferencia = 0;
				
				
				if($auxiliar['somaunidades']<>$vetor['Curso'][$auxiliar['codigoanterior']]['totalvagas']){
					$vetor['Curso'][$auxiliar['codigoanterior']]['totalvagas']=$auxiliar['somaunidades'];
				}
				$auxiliar['somaunidades']=0;
				$auxiliar['codigoanterior']=$dados['Curso']['codigo'];
				
				$primeiro=$dados['Curso']['codigo'];
				$vetor['Curso'][$dados['Curso']['codigo']]['codigo']=$dados['Curso']['codigo'];
				$vetor['Curso'][$dados['Curso']['codigo']]['descricao']=$dados['Curso']['descricao'];
				$vetor['Curso'][$dados['Curso']['codigo']]['totalvagas']=$dados[0]['total'];
				$vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['nome']=$dados['Unidade']['sigla_unidade'];
				
				
				$diferenca="select count(*) as diferenca from militars_cursos
				inner join militars on (militars.id=militars_cursos.militar_id and militars.ativa>0)
				inner join cursos on (cursos.id=militars_cursos.curso_id and cursos.id={$dados['Curso']['id']})
				inner join unidades on (militars.unidade_id=setors.id and unidades.id='{$dados['Necessidade']['unidade_id']}' )
				inner join especialidades on (militars.especialidade_id=especialidades.id and especialidades.id='{$dados['Especialidade']['id']}') 
				group by militar.unidade_id, cursos.id, especialidades.id
				";
				$dif=$this->Necessidade->query($diferenca);
				//$vdif=$dif[0][0]['diferenca'];

				//$somatorio = $dados[0]['total']-$vdif;
				$somatorio = $dados[0]['total'];
				
				$vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']=$somatorio;
				
				//$xx=$vetor['Curso'][$dados['Curso']['codigo']]['totalvagas'];
				$yy=($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']);
				$vetor['Curso'][$dados['Curso']['codigo']]['totalvagas']=$yy;
				
				if(($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']<=0)||empty($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas'])){
					unset($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]);
				}
				
				//$vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']=$dados[0]['total'];
				$var1= $vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas'];
				$var2 = $auxiliar['somaunidades'];
				$auxiliar['somaunidades']=$var1+$var2;

				if($vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['vagas']>0){
					if(strlen($dados['Necessidade']['referencia'])>$maiorreferencia){
						$maiorreferencia = strlen($dados['Necessidade']['referencia']); 
						$vetor['Curso'][$dados['Curso']['codigo']]['justificativa'] =  $dados['Necessidade']['referencia'];
					}
					//$vetor['Curso'][$dados['Curso']['codigo']]['justificativa'] .= $vetor['Curso'][$dados['Curso']['codigo']]['unidades'][$somaunidades]['nome'].'->'.$dados['Necessidade']['referencia']."\r\n";
				}
				$somaunidades++;
				
			}
		}
		
		unset($primeiro);
		$somaunidades=0;
		$somatorio=0;
                
               // print_r($vetor);
		
		$monitora=0;
		foreach($vetor['Curso'] as $dadosR){
			$vetorX['Curso'][$dadosR['codigo']]['codigo']=$dadosR['codigo'];
			$vetorX['Curso'][$dadosR['codigo']]['totalvagas']=$dadosR['totalvagas'];
			$vetorX['Curso'][$dadosR['codigo']]['descricao']=$dadosR['descricao'];
			$vetorX['Curso'][$dadosR['codigo']]['valor_diaria']=$dadosR['valor_diaria'];
			$vetorX['Curso'][$dadosR['codigo']]['valor_ajuda_custo']=$dadosR['valor_ajuda_custo'];
			$vetorX['Curso'][$dadosR['codigo']]['valor_passagem']=$dadosR['valor_passagem'];
			$vetorX['Curso'][$dadosR['codigo']]['divisao_solicitante']=$dadosR['divisao_solicitante'];
			$somaunidades=0;
			$somatorio=0;
			
			foreach($dadosR['unidades'] as $contaUnidades){
				if(empty($primeiro)){
					$somatorio=0;
					$somaunidades=0;
					$primeiro=$contaUnidades['nome'];
				}
				if($primeiro==$contaUnidades['nome']){
					$vetorX['Curso'][$dadosR['codigo']]['unidades'][$somaunidades]['nome']=$contaUnidades['nome'];
					$somatorio+=$contaUnidades['vagas'];
					$vetorX['Curso'][$dadosR['codigo']]['unidades'][$somaunidades]['vagas']=$somatorio;
					$vetorX['Curso'][$dadosR['codigo']]['justificativa']=$dadosR['justificativa'];
					
					
				}else{
					$somaunidades++;
					//$somaunidades=0;
					$somatorio=0;
					$primeiro=$contaUnidades['nome'];
					$vetorX['Curso'][$dadosR['codigo']]['unidades'][$somaunidades]['nome']=$contaUnidades['nome'];
					$somatorio=$contaUnidades['vagas'];
					$vetorX['Curso'][$dadosR['codigo']]['unidades'][$somaunidades]['vagas']=$somatorio;
					$vetorX['Curso'][$dadosR['codigo']]['justificativa']=$dadosR['justificativa'];
					
				}
				
			}
			
		}
		
		/*
		echo '<pre>';
		print_r($vetor['Curso']['MET010']);	
		echo '</pre>';
		*/
		unset($vetor);
		$vetor=$vetorX;
		/*
		echo '<pre>';
		print_r($vetor['Curso']['MET010']);
		//print_r($vetor);
		echo '</pre>';
		*/
		//$this->layout = 'admin'; 

		$this->set(compact('vetor'));
        //print_r($vetor);exit();
		$this->render();
	}
	
	function externofiltro() {
		$this->layout = 'ajax';
		if (!empty($this->data)) {
			$mensagem="";

			$this->Necessidade->Quadro->recursive = 0;
			$this->Necessidade->Especialidade->recursive = 0;
			$this->Necessidade->Setor->recursive = 0;
			$this->Necessidade->Unidade->recursive = 0;
			$this->Necessidade->Curso->recursive = 0;
			//,'Curso.id'=>$this->data['Necessidade']['curso_id']
			//$unidade = $this->Necessidade->Setor->findById($this->data['Necessidade']['setor_id']);
			$consulta = ' 1=1 ';
			foreach($this->data['sql'] as $valor){
				$consulta .= rawurldecode($valor);
			}
			//echo $consulta;
			//print_r($unidade);
			//$registros = $this->Necessidade->find('all',array('conditions'=>$consulta,'order'=>' Unidade.sigla_unidade asc, Especialidade.nm_especialidade asc, Setor.sigla_setor asc, Curso.codigo asc '));
			$consultaFiltrada = "
			select * from necessidades Necessidade
			inner join cursos Curso on (Curso.id=Necessidade.curso_id)
			inner join especialidades Especialidade on (Especialidade.id=Necessidade.especialidade_id)
			inner join quadros Quadro on (Quadro.id=Necessidade.quadro_id)
			inner join unidades Unidade on (Unidade.id=Necessidade.unidade_id)
			where $consulta			
			 order by Unidade.sigla_unidade asc, Especialidade.nm_especialidade asc,  Curso.codigo asc ";
			$registros = $this->Necessidade->query($consultaFiltrada);
			//echo $consultaFiltrada;
			//print_r($registros);
				
			$atual= "<h2>Cadastros atuais</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Ano</th><th>Unidade</th><th>Solicitante</th><th>Quadro</th><th>Esp</th><th>Curso</th><th>Classe</th><th>Efetivo</th><th>Nec</th><th>Existe</th><th>Pedido</th><th>Diária R$</th><th>AjudaCusto R$</th><th>Passagem R$</th><th>Responsável</th><th>Privilégio</th><th>IP</th><th>Inserido</th><th>Atualizado</th><th>Ações</th></tr>";

				//				print_r($militarscursos);

				$i = 0;
			foreach ($registros as $registro):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				//inner join necessidades on (necessidades.setor_id=setors.id and necessidades.curso_id=cursos.id)
				
				$diferenca="select count(*) as diferenca from militars_cursos
				inner join militars on (militars.id=militars_cursos.militar_id and militars.ativa>0)
				inner join cursos on (cursos.id=militars_cursos.curso_id and cursos.id={$registro['Curso']['id']})
				inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
				inner join especialidades on (militars.especialidade_id=especialidades.id and especialidades.id='{$registro['Especialidade']['id']}') 
				group by militars.unidade_id, cursos.id, especialidades.id 
				";
				$dif=$this->Necessidade->query($diferenca);
				//echo $diferenca;
				//print_r($dif);exit();
				$vdif=$dif[0][0]['diferenca'];

				
				$totalSetores="select count(*) as todos from militars 
				inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
				where militars.ativa>0 and militars.especialidade_id='{$registro['Especialidade']['id']}'  and militars.unidade_id=setors.unidade_id 
				group by militars.unidade_id, militars.especialidade_id
				";
				
				$Tot=$this->Necessidade->query($totalSetores);
				$efetivo=$Tot[0][0]['todos'];
				


				$acao = "<a onclick='exibe(\"".rawurlencode($registro['Necessidade']['id'])."\" ,\"".rawurlencode($registro['Necessidade']['ano'])."\" ,\"".rawurlencode($registro['Quadro']['sigla_quadro'])."\" ,\"".rawurlencode($registro['Especialidade']['nm_especialidade'])."\", \"".rawurlencode($registro['Unidade']['sigla_unidade'])."\", \"".rawurlencode($registro['Setor']['sigla_setor'])."\", \"".rawurlencode($registro['Curso']['codigo'])."\", \"".rawurlencode($registro['Necessidade']['necessario'])."\", \"".rawurlencode($registro['Necessidade']['classe'])."\", \"".rawurlencode($registro['Necessidade']['referencia'])."\", \"".rawurlencode($registro['Necessidade']['valor_diaria'])."\", \"".rawurlencode($registro['Necessidade']['valor_passagem'])."\", \"".rawurlencode($registro['Necessidade']['divisao_solicitante'])."\", \"".rawurlencode($registro['Necessidade']['valor_ajuda_custo'])."\");return false;'   href=\"#\"><img border=\"0\" title=\"Editar\" alt=\"Excluir\" src=\"".$this->webroot."img/lapis.gif\"/></a>";
				
				$acao .= "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$registro['Curso']['codigo'].'-'.$registro['Especialidade']['nm_especialidade'].'-'.$registro['Setor']['sigla_setor']." ?\" ,\"javascript:excluiRegistro(".$registro['Necessidade']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";



				$qtdexistente = "<a onclick=\"window.open('{$this->webroot}cursos/view/{$registro['Curso']['id']}/{$registro['Setor']['id']}/{$registro['Especialidade']['id']}/','','');\" href=\"#\" >{$vdif}</a>";
				





				$solicitacao = $registro['Necessidade']['necessario'] - $vdif;
				if($solicitacao<0){
					$solicitacao=0;
				}
				$atual .= "	<tr {$class}><td>{$registro['Necessidade']['ano']}</td><td>{$registro['Unidade']['sigla_unidade']}</td><td>{$registro['Necessidade']['divisao_solicitante']}</td><td>{$registro['Quadro']['sigla_quadro']}</td><td>{$registro['Especialidade']['nm_especialidade']}</td><td>{$registro['Curso']['codigo']}</td><td>{$registro['Necessidade']['classe']}</td><td>$efetivo</td><td>{$registro['Necessidade']['necessario']}</td><td>$qtdexistente</td><td style='background-color:#ffff00;text-align:center;'>$solicitacao</td><td>".number_format($registro['Necessidade']['valor_diaria'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_ajuda_custo'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_passagem'], 2, ',', '.')."</td><td>{$registro['Necessidade']['responsavel']}</td><td>{$registro['Necessidade']['privilegio']}</td><td>{$registro['Necessidade']['ip']}</td><td>{$registro['Necessidade']['created']}</td><td>{$registro['Necessidade']['updated']}</td><td>{$acao}</td></tr>";

						
			endforeach;
			$atual.="</table>";


			$ok=1;
			header('Content-type: application/x-json');

			//$ok = urlencode(print_r($this, true));

			//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
			//echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';
                        // $atual=json_encode($atual);
			echo $atual;

			exit();

				
		}
	}
	
	function externoComplete(){
		 $this->set('cursos', $this->Necessidade->Curso->find('all', array('conditions' => array('Curso.sigla_curso LIKE' => $this->data['Necessidade']['subject'].'%'), 'fields' => array('subject'))));
		 $this->layout = 'ajax';
		 exit();
	}
	function externosave(){
		$ok = 1;
		//print_r($this->data);
			$consultaFiltrada = "
			select * from necessidades Necessidade
			inner join cursos Curso on (Curso.id=Necessidade.curso_id and Curso.codigo='{$this->data['Necessidade']['Curso']}')
			inner join especialidades Especialidade on (Especialidade.id=Necessidade.especialidade_id and Especialidade.nm_especialidade='{$this->data['Necessidade']['Especialidade']}')
			inner join quadros Quadro on (Quadro.id=Necessidade.quadro_id)
			inner join unidades Unidade on (Unidade.id=Necessidade.unidade_id and Unidade.sigla_unidade='{$this->data['Necessidade']['Unidade']}')
			where 
                            Necessidade.ano={$this->data['Necessidade']['ano']}
			";
			//echo $consultaFiltrada;
                        
		unset($this->data['Necessidade']['Quadro']);
		unset($this->data['Necessidade']['Especialidade']);
		unset($this->data['Necessidade']['Unidade']);
		unset($this->data['Necessidade']['Setor']);
		unset($this->data['Necessidade']['Curso']);
		unset($this->data['Necessidade']['Classe']);
					
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
		$privilegio = $u[0]['Privilegio']['descricao'];
		$this->Necessidade->query($monitora);
								
		$this->data['Necessidade']['responsavel'] = $usuario;
		$this->data['Necessidade']['privilegio'] = $privilegio;
		$this->data['Necessidade']['ip'] = $ip;
		

		$this->data['Necessidade']['necessario'] = $this->data['Necessidade']['Necessario'];
		unset($this->data['Necessidade']['Necessario']);
		$this->data['Necessidade']['referencia'] = $this->data['Necessidade']['Referencia'];
		unset($this->data['Necessidade']['Referencia']);
		$this->data['Necessidade']['valor_diaria'] = $this->data['Necessidade']['ValorDiaria'];
		unset($this->data['Necessidade']['ValorDiaria']);
		$this->data['Necessidade']['valor_passagem'] = $this->data['Necessidade']['ValorPassagem'];
		unset($this->data['Necessidade']['ValorPassagem']);
		$this->data['Necessidade']['divisao_solicitante'] = $this->data['Necessidade']['DivisaoSolicitante'];
		unset($this->data['Necessidade']['DivisaoSolicitante']);
		if($this->Necessidade->save($this->data['Necessidade'])){
			$ok = 1;
		}else{
			$ok = 0;
		}
		
			$registros = $this->Necessidade->query($consultaFiltrada);




			$atual= "<h2>Cadastros atuais</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Ano</th><th>Unidade</th><th>Solicitante</th><th>Quadro</th><th>Esp</th><th>Curso</th><th>Classe</th><th>Efetivo</th><th>Nec</th><th>Existe</th><th>Pedido</th><th>Diária R$</th><th>AjudaCusto R$</th><th>Passagem R$</th><th>Responsável</th><th>Privilégio</th><th>IP</th><th>Inserido</th><th>Atualizado</th><th>Ações</th></tr>";

				//				print_r($militarscursos);

				$i = 0;
			foreach ($registros as $registro):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				//inner join necessidades on (necessidades.setor_id=setors.id and necessidades.curso_id=cursos.id)
				
				$diferenca="select count(*) as diferenca from militars_cursos
				inner join militars on (militars.id=militars_cursos.militar_id and militars.ativa>0)
				inner join cursos on (cursos.id=militars_cursos.curso_id and cursos.id={$registro['Curso']['id']})
				inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
				inner join especialidades on (militars.especialidade_id=especialidades.id and especialidades.id='{$registro['Especialidade']['id']}') 
				group by militars.unidade_id, cursos.id, especialidades.id 
				";
				$dif=$this->Necessidade->query($diferenca);
				//echo $diferenca;
				//print_r($dif);exit();
				$vdif=$dif[0][0]['diferenca'];

				
				$totalSetores="select count(*) as todos from militars 
				inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$registro['Unidade']['id']}'  )
				where militars.ativa>0 and militars.especialidade_id='{$registro['Especialidade']['id']}'  and militars.unidade_id=setors.unidade_id 
				group by militars.unidade_id, militars.especialidade_id
				";
				
				$Tot=$this->Necessidade->query($totalSetores);
				$efetivo=$Tot[0][0]['todos'];
				


				$acao = "<a onclick='exibe(\"".rawurlencode($registro['Necessidade']['id'])."\" ,\"".rawurlencode($registro['Necessidade']['ano'])."\" ,\"".rawurlencode($registro['Quadro']['sigla_quadro'])."\" ,\"".rawurlencode($registro['Especialidade']['nm_especialidade'])."\", \"".rawurlencode($registro['Unidade']['sigla_unidade'])."\", \"".rawurlencode($registro['Setor']['sigla_setor'])."\", \"".rawurlencode($registro['Curso']['codigo'])."\", \"".rawurlencode($registro['Necessidade']['necessario'])."\", \"".rawurlencode($registro['Necessidade']['classe'])."\", \"".rawurlencode($registro['Necessidade']['referencia'])."\", \"".rawurlencode($registro['Necessidade']['valor_diaria'])."\", \"".rawurlencode($registro['Necessidade']['valor_passagem'])."\", \"".rawurlencode($registro['Necessidade']['divisao_solicitante'])."\", \"".rawurlencode($registro['Necessidade']['valor_ajuda_custo'])."\");return false;'   href=\"#\"><img border=\"0\" title=\"Editar\" alt=\"Excluir\" src=\"".$this->webroot."img/lapis.gif\"/></a>";
				
				$acao .= "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$registro['Curso']['codigo'].'-'.$registro['Especialidade']['nm_especialidade'].'-'.$registro['Setor']['sigla_setor']." ?\" ,\"javascript:excluiRegistro(".$registro['Necessidade']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";



				$qtdexistente = "<a onclick=\"window.open('{$this->webroot}cursos/view/{$registro['Curso']['id']}/{$registro['Setor']['id']}/{$registro['Especialidade']['id']}/','','');\" href=\"#\" >{$vdif}</a>";
				





				$solicitacao = $registro['Necessidade']['necessario'] - $vdif;
				if($solicitacao<0){
					$solicitacao=0;
				}
				$atual .= "	<tr {$class}><td>{$registro['Necessidade']['ano']}</td><td>{$registro['Unidade']['sigla_unidade']}</td><td>{$registro['Necessidade']['divisao_solicitante']}</td><td>{$registro['Quadro']['sigla_quadro']}</td><td>{$registro['Especialidade']['nm_especialidade']}</td><td>{$registro['Curso']['codigo']}</td><td>{$registro['Necessidade']['classe']}</td><td>$efetivo</td><td>{$registro['Necessidade']['necessario']}</td><td>$qtdexistente</td><td style='background-color:#ffff00;text-align:center;'>$solicitacao</td><td>".number_format($registro['Necessidade']['valor_diaria'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_ajuda_custo'], 2, ',', '.')."</td><td>".number_format($registro['Necessidade']['valor_passagem'], 2, ',', '.')."</td><td>{$registro['Necessidade']['responsavel']}</td><td>{$registro['Necessidade']['privilegio']}</td><td>{$registro['Necessidade']['ip']}</td><td>{$registro['Necessidade']['created']}</td><td>{$registro['Necessidade']['updated']}</td><td>{$acao}</td></tr>";






			endforeach;
			$atual.="</table></div>";



			
                
                
		//header('Content-type: application/x-json');
		//echo $atual;
		//exit();
                
                
	    header('Content-type: application/x-json');
            $atual=json_encode($atual);
$retornoajax=<<<Ajax
{ "ok":$ok, "mensagem":"$mensagem", "registros":$atual}       
Ajax;
echo $retornoajax;
//echo '{ "ok":"'.$ok.'", "mensagem":"'.(addslashes($mensagem)).'"}';
		exit();

		
	}
	
	function externoconsultas() {
		$this->layout = null;
		if (!empty($this->data['Necessidade']['curso_id'])&& !empty($this->data['Necessidade']['especialidade_id'])&& !empty($this->data['Necessidade']['quadro_id'])&& !empty($this->data['Necessidade']['unidade_id'])) {
			$mensagem="";

			$consultaMilitarDoSetorComCurso = "
			select Militar.id, MilitarsCurso.*, Setor.*, Unidade.* from militars Militar
			inner join militars_cursos MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
			inner join cursos Curso on (Curso.id={$this->data['Necessidade']['curso_id']} and MilitarsCurso.curso_id=Curso.id)
			inner join especialidades Especialidade on (Especialidade.id='{$this->data['Necessidade']['especialidade_id']}' and Militar.especialidade_id=Especialidade.id)
			inner join quadros Quadro on (Quadro.id='{$this->data['Necessidade']['quadro_id']}' and Especialidade.quadro_id=Quadro.id)
			inner join setors Setor on (Militar.setor_id=Setor.id)
			inner join unidades Unidade on (Unidade.id='{$this->data['Necessidade']['unidade_id']}' and Setor.unidade_id=Unidade.id)
                        where  Militar.ativa='1'
                        group by Militar.id
  		    order by Setor.sigla_setor asc, Militar.id asc ";
			//echo $consultaMilitarDoSetorComCurso;
			
			$comcurso = $this->Necessidade->query($consultaMilitarDoSetorComCurso);
				
			$consultaMilitaresDoSetor = "
			select * from militars Militar
			inner join postos Posto on (Posto.id=Militar.posto_id )
			inner join especialidades Especialidade on (Especialidade.id='{$this->data['Necessidade']['especialidade_id']}' and Militar.especialidade_id=Especialidade.id)
			inner join quadros Quadro on (Quadro.id='{$this->data['Necessidade']['quadro_id']}' and Especialidade.quadro_id=Quadro.id)
			inner join setors Setor on (Militar.setor_id=Setor.id)
			inner join unidades Unidade on (Unidade.id='{$this->data['Necessidade']['unidade_id']}' and Setor.unidade_id=Unidade.id)
                        where  Militar.ativa='1'
                        group by Militar.id
            order by Unidade.sigla_unidade asc, Setor.sigla_setor asc , Militar.id asc,  Especialidade.nm_especialidade asc";
			
			$existentes = $this->Necessidade->query($consultaMilitaresDoSetor);
			
			//echo "<br><br>".$consultaMilitaresDoSetor;
			
			$this->set(compact('existentes','comcurso'));
			
		
	}else{
		$this->set('problema',1);
	}
	}
	
}
?>