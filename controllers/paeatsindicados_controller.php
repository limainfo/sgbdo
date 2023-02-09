<?php
class PaeatsindicadosController extends AppController {

	var $name = 'Paeatsindicados';
	var $helpers = array('Html', 'Form');


	function externoconsulta($id = null) {
			//$this->layout='popup';
			$this->Paeatsindicado->recursive = 0;
			$this->layout='admin';
			//$conditions=array('Paeat.ano'=>'2011');
			$order=array('Paeat.inicio'=>'asc','Paeat.ano'=>'desc');
			//$this->set('paeats', $this->Paeatsindicado->find('all',array('conditions'=>$conditions,'order'=>$order,'limit'=>30)));
			$this->set('paeats', $this->Paeatsindicado->find('all',array('order'=>$order,'limit'=>30)));
			
			$sql = 'select * from unidades order by sigla_unidade asc';
			$this->set('unidades', $this->Paeatsindicado->query($sql));
			
			$sql = "select concat(Unidade.sigla_unidade,'-',Cidade.nome,'-',Setor.sigla_setor) escala, Escala.id, Setor.id from setors Setor
			INNER JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
			INNER JOIN cidades Cidade on (Cidade.id=Unidade.cidade_id)
			INNER JOIN escalas Escala on (Escala.setor_id=Setor.id and Escala.setor_id)
			order by Unidade.sigla_unidade, Cidade.nome, Setor.sigla_setor asc";
		$escalas = $this->Paeatsindicado->query($sql);
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
			$this->set('escalas', $escalas);
			

	}
	
	function externocursosrealizados(){
			$ok = 1;
			$this->Paeatsindicado->recursive = 1;
			//print_r($this->params['form']);
                        $anopaeat = $this->params['form']['ano'];
			if($this->data['Paeatsindicado']['opcao']=='nome'){
				$conditions=array("(Paeatsindicado.nomecompleto like \"%{$this->data['Paeatsindicado']['nome']}%\" or Paeatsindicado.codcurso like \"%{$this->data['Paeatsindicado']['nome']}%\") and Paeat.ano=$anopaeat");
				$order=array('Paeat.ano'=>'desc','Paeat.inicio'=>'asc');
				$paeats = $this->Paeatsindicado->find('all',array('conditions'=>$conditions, 'order'=>$order));
			}
			
			if($this->data['Paeatsindicado']['opcao']=='unidade'){
				$conditions=array('Setor.unidade_id="'.$this->data['Paeatsindicado']['unidade'].'%"');
				$consulta = "select Paeatsindicado.*,Paeat.* from paeatsindicados Paeatsindicado 
				inner join paeats Paeat on (Paeat.id=Paeatsindicado.paeat_id and Paeat.ano=$anopaeat)
				inner join militars on (militars.id=Paeatsindicado.militar_id) inner join setors on (militars.setor_id=setors.id and setors.unidade_id='{$this->data['Paeatsindicado']['unidade']}') order by Paeat.ano desc, Paeat.inicio asc";
				//echo $consulta;
				$paeats = $this->Paeatsindicado->query($consulta);
			} 
			
			if($this->data['Paeatsindicado']['opcao']=='escala'){
				$escalasmonths=$this->data['Escala']['ano'];
				$consulta = "select Paeatsindicado.*,Paeat.* from paeatsindicados Paeatsindicado 
				inner join paeats Paeat on (Paeat.id=Paeatsindicado.paeat_id and Paeat.ano=$anopaeat)
				inner join escalasmonths on (escalasmonths.id=$escalasmonths)
				inner join escalas on (escalasmonths.escala_id=escalas.id)
				inner join militars_escalas on (militars_escalas.militar_id=Paeatsindicado.militar_id and militars_escalas.escala_id=escalas.id) 
				 order by Paeat.ano desc, Paeat.inicio asc";
				//echo $consulta;
				$paeats = $this->Paeatsindicado->query($consulta);
			}
			
			//print_r($paeats);
			$cor=' style="background-color:#a0ccd0;" ';
			$mensagem= "<table cellpadding='0' cellspacing='1' border='1'><tr><th $cor>Indicado</th><th $cor>Curso</th><th $cor>Inicio</th><th $cor>T&eacute;rmino</th><th $cor>Refer&ecirc;ncia</th><th $cor>Respons&aacute;vel pelo Cadastro</th><th $cor>Data do Cadastro</th></tr>";
			$i=0;
			foreach($paeats as $dado){
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			$nomecompleto=iconv('UTF-8','ISO-8859-1',$dado['Paeatsindicado']['nomecompleto']);
			$nomeresponsavel=iconv('UTF-8','ISO-8859-1',$dado['Paeatsindicado']['responsavel']);
			$mensagem .= "	<tr ><td{$class}>{$nomecompleto}</td><td{$class}>{$dado['Paeatsindicado']['codcurso']}<b><u>({$dado['Paeat']['status']})</u></b></td><td{$class}>{$dado['Paeat']['inicio']}</td><td{$class}>{$dado['Paeat']['fim']}</td><td{$class}>{$dado['Paeatsindicado']['referenciavaga']}</td><td{$class}>{$nomeresponsavel}</td><td{$class}>{$dado['Paeatsindicado']['created']}</td></tr>";
			}
			
			$mensagem.="</table>";
			
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode((str_replace("\n"," ",($mensagem)))).'"}';
		exit();
				
	}
	
	
	function externocadastro(){
		$tipo = 'registros';
		$tabela=1;
		if($this->params['form']['opcao']=='sim'){
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
//		$privilegio = print_r($u,true);
		$privilegio = $u[0]['Privilegio']['descricao'];
		
			$mensagem= "<table cellpadding='0' cellspacing='0'><tr><th>Indicado</th><th>Respons&aacute;vel pela indica&ccedil;&atilde;o</th><th>Privil&eacute;gio</th><th>A&ccedil;&otilde;es</th></tr>";
			$i = 0;
			$class = null;			
			$listanomes='select * from militars 
			inner join postos on (postos.id=militars.posto_id)
			inner join especialidades on (especialidades.id=militars.especialidade_id)
			inner join quadros on (quadros.id=especialidades.quadro_id)
			where identidade like "%'.$this->data['Paeat']['identidade'].'%" order by nm_completo asc';
			//echo $listanomes;
			$respostas=$this->Paeatsindicado->query($listanomes);
			foreach ($respostas as $resposta){
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/accept.png"/>';
			$ciente = '<input type="checkbox" id="'.$resposta['Paeat']['id'].'"  value="'.$resposta['Paeat']['id'].'" />';
			$despacho = '<img border="0" title="Despacho" alt="despacho" src="'.$this->webroot.'img/despacho.gif"/>';
			$acao= $excluir.$ciente.$despacho;			
						//$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero']." ?\" ,\"javascript:excluiRegistro(".$resultado['lrotabela01s']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
			$mensagem .= "	<tr ><td{$class}>{$resposta['postos']['sigla_posto']} {$resposta['quadros']['sigla_quadro']} {$resposta['especialidades']['nm_especialidade']} {$resposta['militars']['nm_completo']}</td><td{$class}>{$usuario}</td><td{$class}>{$privilegio}</td><td{$class}>{$acao}</td></tr>";
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
			where nm_completo like "%'.$this->data['Paeat']['nome'].'%" order by nm_completo asc';
			$resultado=$this->Paeatsindicado->query($listanomes);
			$lista = '<option value=""></option>';
			foreach($resultado as $dado){
				$lista.= '<option value="'.$dado['militars']['identidade'].'">'.$dado['postos']['sigla_posto'].' '.$dado['quadros']['sigla_quadro'].' '.$dado['especialidades']['nm_especialidade'].' '.$dado['militars']['nm_completo'].'</option>';
			}
		}
		
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode((str_replace("\n"," ",($dados)))).'", "total":"'.$total.'", "lista":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$lista)).'", "tipo":"'.$tipo.'" }';
		exit();
			}

  function delete($id = null, $paeatId = null){
		$this->layout = 'ajax';
		$u=$this->Session->read('Usuario');
                
		$exclusao = 1;
		//print_r($u);
		if(($u[0]['Usuario']['privilegio_id']==6)||($u[0]['Usuario']['privilegio_id']==12)){
			$this->Paeatsindicado->recursive = 0;
			$conditions='Paeatsindicado.id='.$id.' and Paeatsindicado.paeat_id='.$paeatId;
			$registros = $this->Paeatsindicado->find('all',array('conditions'=>$conditions));
			if(($registros[0]['Paeatsindicado']['responsavel']==$u[0][0]['nome'])&&($registros[0]['Paeatsindicado']['privilegio']==$u[0]['Privilegio']['descricao'])){
				
			}else{
				$mensagemerro = 'Somente o responsável pelo cadastro, de mesmo privilégio,  que pode excluir o registro.';
				$mensagemerro = '<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">Registro n&atilde;o excluído pelo seguinte motivo:<br></p><p style="background-color:#d0d0f0;padding:0px;color:#800000;text-align:center;margin:0px;">'.$mensagemerro.'</p>';
				$ok = 0;
				$exclusao = 0;
			}
		}
		if(!empty($paeatId)){
			$verificaDatas = "select * from paeats Paeat where id={$paeatId} ";
			$dataIndicacaoAtual=$this->Paeatsindicado->query($verificaDatas);
			foreach($dataIndicacaoAtual as $dataAtual){
			}
			
			
		}
		
		if($exclusao){
		if ($this->Paeatsindicado->delete($id)) {
			$ok = '1';
		}else{
			$ok = '0';
		}
		}else{
			$ok = '0';
		}
		$mensagem="";

				$checkbox = 0;
				
				
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
		//	$listaindicados = 'select * from paeatsindicados Paeatindicado where paeat_id='.$paeatId;
			$listaindicados = 'select * from paeatsindicados Paeatindicado where paeat_id='.$paeatId.' order by responsavel asc, privilegio asc, referenciavaga asc, prioridade asc, atributo asc  ';
			$respostas=$this->Paeatsindicado->query($listaindicados);
			
			$class = ' style="background-color:#a0ffa0;"';
			$mensagem= "<table cellpadding='0' cellspacing='0' width='100%'><tr><td{$class}>Prioridade</td><td{$class}>Atributo</td><td{$class}>Indicado</td><td{$class}>Setor</td><td{$class}>Vaga</td><td{$class}>Respons&aacute;vel pela indica&ccedil;&atilde;o</td><td{$class}>Privil&eacute;gio</td><td{$class}>dtRegistro</td><td{$class}>Matriculado</td><td{$class}>A&ccedil;&otilde;es</td></tr>";

//			$mensagem= "<table cellpadding='0' cellspacing='0' width='100%'><tr><td{$class}>Prioridade</td><td{$class}>Atributo</td><td{$class}>Indicado</td><td{$class}>Setor</td><td{$class}>Vaga</td><td{$class}>Respons&aacute;vel pela indica&ccedil;&atilde;o</td><td{$class}>Privil&eacute;gio</td><td{$class}>IP</td><td{$class}>dtRegistro</td><td{$class}>A&ccedil;&otilde;es</td></tr>";
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
//			$excluir = "<a onclick=\"return false;\" onmousedown=\"dialogo('Deseja realmente excluir o registro #{$resposta['Paeatindicado']['id']} ?' ,'javascript:excluiRegistro({$resposta['Paeatindicado']['id']},{$paeatId});');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"{$this->webroot}img/lixo.gif\"/></a>";
			$excluir = "<a onclick=\"return false;\" onmousedown=\"dialogo('Deseja realmente excluir #{$resposta['Paeatindicado']['nomecompleto']} do curso {$resposta['Paeatindicado']['codcurso']} ?' ,'javascript:excluiRegistro({$resposta['Paeatindicado']['id']},{$resposta['Paeatindicado']['paeat_id']});');\" href=\"{$this->webroot}{$this->params['controller']}\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"{$this->webroot}img/lixo.gif\"/></a>";
	$bloqueio = 0;
	if(($u[0]['Usuario']['privilegio_id']==6)||($u[0]['Usuario']['privilegio_id']==12)){
		$final = '2011-01-25 23:59';
		$datafinal = strtotime($final);
		$datahoje = strtotime('+0 days');
		$limitesetor = strtotime($final.' -10 days');
		
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
				
	//		$mensagem .= "	<tr ><td{$class}>{$resposta['Paeatindicado']['prioridade']}</td><td{$class}>{$resposta['Paeatindicado']['atributo']}</td><td{$class}>{$resposta['Paeatindicado']['nomecompleto']}</td><td{$class}>{$resposta['Paeatindicado']['unidade']}</td><td{$class}>{$resposta['Paeatindicado']['referenciavaga']}</td><td{$class}>{$resposta['Paeatindicado']['responsavel']}</td><td{$class}>{$resposta['Paeatindicado']['privilegio']}</td><td{$class}>{$resposta['Paeatindicado']['ip']}</td><td{$class}>{$resposta['Paeatindicado']['created']}</td><td{$class}>{$acao}</td></tr>";
			
			}

			$mensagem.="</table>";
			$dados = $mensagem;

			
			

		
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$mensagem)).'", "atual":"'.addslashes($atual).'", "mensagemerro":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$mensagemerro)).'" }';

		exit();  	
  }	
	
}
?>