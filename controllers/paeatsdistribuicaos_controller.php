<?php
class PaeatsdistribuicaosController extends AppController {

	var $name = 'Paeatsdistribuicaos';
	var $helpers = array('Html', 'Form');


	function externoconsulta($paeatid = null) {
		$this->layout='popup';
			$ok=1;
			$this->Paeatsdistribuicao->recursive = 0;
			$listalocalidades = 'select * from paeatsdistribuicaos where paeat_id='.$paeatid.' order by vaga asc';
			//echo $listalocalidades;
			$resultado=$this->Paeatsdistribuicao->query($listalocalidades);
			$lista = '<option value=""></option>';
			foreach($resultado as $dado){
				$lista.= '<option value="'.$dado['paeatsdistribuicaos']['vaga'].'">'.$dado['paeatsdistribuicaos']['vaga'].'</option>';
			}
        $objetivos = '<table width="300px"><tr><th>Objetivo '.$dado['paeatsdistribuicaos']['codcurso'].'</th></tr><tr><td>'.(iconv('UTF-8','ISO-8859-1',$dado['paeatsdistribuicaos']['objetivo'])).'</td></tr><tr><th>Pr&eacute;-Requisitos</th></tr><tr><td>'.(iconv('UTF-8','ISO-8859-1',$dado['paeatsdistribuicaos']['prerequisitos'])).'</td></table>';
		header('Content-type: application/x-json');
		//
		//iconv('UTF-8','ISO-8859-1',
		echo '{ "ok":"'.$ok.'",  "mensagem":"'.rawurlencode(iconv('UTF-8','ISO-8859-1',$lista)).'",  "objetivos":"'.rawurlencode($objetivos).'" }';
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
		
			$mensagem= "<table cellpadding='0' cellspacing='0'><tr><th>Prioridade</th><th>Indicado</th><th>Respons&aacute;vel pela indica&ccedil;&atilde;o</th><th>Privil&eacute;gio</th><th>A&ccedil;&otilde;es</th></tr>";
			$i = 0;
			$class = null;			
			$listanomes='select * from militars 
			inner join postos on (postos.id=militars.posto_id)
			inner join especialidades on (especialidades.id=militars.especialidade_id)
			inner join quadros on (quadros.id=especialidades.quadro_id)
			where identidade like "%'.$this->data['Paeat']['identidade'].'%" order by nm_completo asc';
			//echo $listanomes;
			$respostas=$this->Paeat->query($listanomes);
			foreach ($respostas as $resposta){
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/accept.png"/>';
			$ciente = '<input type="checkbox" id="'.$resposta['Paeat']['id'].'"  value="'.$resposta['Paeat']['id'].'" />';
			$despacho = '<img border="0" title="Despacho" alt="despacho" src="'.$this->webroot.'img/despacho.gif"/>';
	$bloqueio = 0;
	$u=$this->Session->read('Usuario');
        
	if(($u[0]['Usuario']['privilegio_id']==6)||($u[0]['Usuario']['privilegio_id']==5)){
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
			$resultado=$this->Paeat->query($listanomes);
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

	function externocursosrealizados(){
			$ok = 1;
			$listacursos='select * from dctp.pefcr where Ident='.$this->data['Paeat']['identidade'].' order by dtInicio asc';
			//echo $listacursos;
			$resultado=$this->Paeat->query($listacursos);
			$mensagem= "<table cellpadding='0' cellspacing='0'><tr><th>Curso</th><th>Inicio</th><th>Termino</th><th>Grau</th><th>Local</th><th>CPF</th></tr>";
			$i=0;
			foreach($resultado as $dado){
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
}
?>