<?php
class BibliasController extends AppController {

	var $name = 'Biblias';
	var $helpers = array('Html', 'Form');


	function externoconsulta($id = null) {
			//$this->layout='popup';
			$this->Biblias->recursive = 0;
			$conditions=array('Paeat.ano'=>'2011');
			$order=array('Paeat.inicio'=>'asc');
			$this->set('paeats', $this->Biblias->find('all',array('conditions'=>$conditions,'order'=>$order,'limit'=>30)));
			
			$sql = 'select * from unidades order by sigla_unidade asc';
			$this->set('unidades', $this->Biblias->query($sql));
		

	}
	
	function externocursosrealizados(){
			$ok = 1;
			$this->Biblias->recursive = 1;
			
			$conditions=array('Paeatsindicado.nomecompleto like "%'.$this->data['Paeatsindicado']['nome'].'%"');
			$order=array('Paeat.inicio'=>'asc');
			$paeats = $this->Biblias->find('all',array('conditions'=>$conditions, 'order'=>$order));
			//print_r($paeats);
			$cor=' style="background-color:#a0ccd0;" ';
			$mensagem= "<table cellpadding='0' cellspacing='1' border='1'><tr><th $cor>Indicado</th><th $cor>Curso</th><th $cor>Inicio</th><th $cor>T&eacute;rmino</th><th $cor>Refer&ecirc;ncia</th><th $cor>Respons&aacute;vel pelo Cadastro</th><th $cor>Data do Cadastro</th></tr>";
			$i=0;
			foreach($paeats as $dado){
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			$mensagem .= "	<tr ><td{$class}>{$dado['Paeatsindicado']['nomecompleto']}</td><td{$class}>{$dado['Paeatsindicado']['codcurso']}</td><td{$class}>{$dado['Paeat']['inicio']}</td><td{$class}>{$dado['Paeat']['fim']}</td><td{$class}>{$dado['Paeatsindicado']['referenciavaga']}</td><td{$class}>{$dado['Paeatsindicado']['responsavel']}</td><td{$class}>{$dado['Paeatsindicado']['created']}</td></tr>";
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
			$respostas=$this->Biblias->query($listanomes);
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
			$resultado=$this->Biblias->query($listanomes);
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
			$this->Biblias->recursive = 0;
			$conditions='Paeatsindicado.id='.$id.' and Paeatsindicado.paeat_id='.$paeatId;
			$registros = $this->Biblias->find('all',array('conditions'=>$conditions));
			if(($registros[0]['Paeatsindicado']['responsavel']==$u[0][0]['nome'])&&($registros[0]['Paeatsindicado']['privilegio']==$u[0]['Privilegio']['descricao'])){
				
			}else{
				$mensagemerro = 'Somente o responsável pelo cadastro, de mesmo privilégio,  que pode excluir o registro.';
				$mensagemerro = '<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">Registro n&atilde;o excluído pelo seguinte motivo:<br></p><p style="background-color:#d0d0f0;padding:0px;color:#800000;text-align:center;margin:0px;">'.$mensagemerro.'</p>';
				$ok = 0;
				$exclusao = 0;
			}
		}
		
		if($exclusao){
		if ($this->Biblias->delete($id)) {
			$ok = '1';
		}else{
			$ok = '0';
		}
		}else{
			$ok = '0';
		}
		$mensagem="";

				$checkbox = 0;
				
				
		//	$listaindicados = 'select * from paeatsindicados Paeatindicado where paeat_id='.$paeatId;
			$listaindicados = 'select * from paeatsindicados Paeatindicado where paeat_id='.$paeatId.' order by responsavel asc, privilegio asc, referenciavaga asc, prioridade asc  ';
			$respostas=$this->Biblias->query($listaindicados);
			
			$class = ' style="background-color:#a0ffa0;"';
			$mensagem= "<table cellpadding='0' cellspacing='0'><tr><td{$class}>Prioridade</td><td{$class}>Atributo</td><td{$class}>Indicado</td><td{$class}>Setor</td><td{$class}>Vaga</td><td{$class}>Respons&aacute;vel pela indica&ccedil;&atilde;o</td><td{$class}>Privil&eacute;gio</td><td{$class}>IP</td><td{$class}>dtRegistro</td><td{$class}>A&ccedil;&otilde;es</td></tr>";
			$i = 0;
  			if(empty($respostas)){
				$mensagem = '';
			}
			foreach ($respostas as $resposta){
			$class = null;			
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#ffffa0;"';
				if($resposta['Paeatindicado']['atributo']!='ALUNO'){
					$class = ' style="background-color:#ffa0a0;"';
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
			$mensagem .= "	<tr ><td{$class}>{$resposta['Paeatindicado']['prioridade']}</td><td{$class}>{$resposta['Paeatindicado']['atributo']}</td><td{$class}>{$resposta['Paeatindicado']['nomecompleto']}</td><td{$class}>{$resposta['Paeatindicado']['unidade']}</td><td{$class}>{$resposta['Paeatindicado']['referenciavaga']}</td><td{$class}>{$resposta['Paeatindicado']['responsavel']}</td><td{$class}>{$resposta['Paeatindicado']['privilegio']}</td><td{$class}>{$resposta['Paeatindicado']['ip']}</td><td{$class}>{$resposta['Paeatindicado']['created']}</td><td{$class}>{$acao}</td></tr>";
			
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