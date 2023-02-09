<?php
class OrcamentosController extends AppController {

	var $name = 'Orcamentos';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');

function add($nome_Orcamento=null, $dia=null) {
		$this->layout = 'mobile';
		if(empty($nome_Orcamento)&&!empty($_POST['nome_Orcamento'])){
			$nome_Orcamento= $_POST['nome_Orcamento'];
		}
		if(empty($dia)&&!empty($_POST['dia'])){
			$dia= $_POST['dia'];
		}
		
		if(empty($dia)){
			$dia .= date('Y-m-d',strtotime(' now '));
		}
		$this->set(compact('dia'));
		
		if(empty($nome_Orcamento)){
			$nome_Orcamento = 'EXPEDIENTE';
		}
		
		$this->set(compact('nome_Orcamento'));
		$this->set(compact('dia'));
}

function delete($id = null, $nome_Orcamento=null, $dia=null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido ', true));
			$this->redirect(array('action'=>'add/',$nome_Orcamento.'/'.$dia));
		}
		$oculta= "&nbsp;&nbsp;<a onclick=\"this.href='#';HideContent('flashMsg');return false;\" href=\"{$this->webroot}testeopprovas/externoedit\"><img border=\"0\" title=\"Oculta\" alt=\"Ocultar\" src=\"{$this->webroot}img/btsair.gif\"></a>";
		if ($this->Orcamento->delete($id)) {
			$this->Session->setFlash(__('Registro excluído'.$oculta, true));
			$this->redirect(array('action'=>'add/',$nome_Orcamento.'/'.$dia));
		}
}
 
function externoedit($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$Orcamento = $this->data = $this->Orcamento->read(null, $id);
		
		$this->set(compact('$Orcamento'));		
}

function externoadd($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Orcamento->read(null,$id);
		//$this->Orcamento->recursive=1;
		//$especialidades = $this->Orcamento->Especialidade->find('list');
		$resultado = $this->Orcamento->query('select * from Orcamentos Orcamento ');
		$especialidades[0] = 'Selecione uma Especialidade';
		foreach($resultado as $dado){
			$especialidades[$dado['Orcamento']['id']]=$dado['Orcamento']['nm_completo'];
		}
		
		$organizacoes = $this->arvore;
	
		//$setors = $this->Orcamento->Setor->find('list');
		$testeopprovas = $this->Orcamento->find('list');
		$this->set(compact(  'especialidades', 'testeopprovas','organizacoes'));		
}

function externoeditgrava($id = null) {
	
		$this->layout = null;
//		$this->data['Militar']['id']=$this->data['Militar']['militar_id'];
//		unset($this->data['Militar']['militar_id']);
//		unset($divisao);
//		unset($subdivisao);
		$ok=0;
		$u = $this->Session->read('Usuario');
		$divisao=$u[0]['Usuario']['divisao'];
		$compara = $u[0]['Usuario']['privilegio_id'];
		
		if(($compara==1)||(($compara==17)&&(!empty($divisao))&&(empty($this->data['Orcamento']['id'])))){
			$sql = "select * from Orcamentoefetivos Orcamentoefetivo where divisao='{$this->data['Orcamento']['divisao']}' and nome_Orcamento='{$this->data['Orcamento']['nome_Orcamento']}' order by nome_militar asc ";
			$dia = $this->data['Orcamento']['dia'];
			$divisao= $this->data['Orcamento']['divisao'];
			$nome_Orcamento= $this->data['Orcamento']['nome_Orcamento'];
			
			$this->set(compact('nome_Orcamento'));
			$this->set(compact('dia'));
			
			$mes = date('m',strtotime($dia));
			$ano = date('Y',strtotime($dia));
				
			$consulta=$this->Orcamento->query($sql);
			foreach($consulta as $registro){
				unset($this->data);
				$this->data['Orcamento']['Orcamentoefetivo_id']=$registro['Orcamentoefetivo']['id'];
				$this->data['Orcamento']['dia']=$dia;
				$this->data['Orcamento']['nome_completo']=$registro['Orcamentoefetivo']['nome_militar'];
				$this->data['Orcamento']['divisao']=$registro['Orcamentoefetivo']['divisao'];
				$this->data['Orcamento']['nome_Orcamento']=$registro['Orcamentoefetivo']['nome_Orcamento'];
				
				$sqladicional = "select * from militars Militar
				left join setors Setor on (Setor.id=Militar.setor_id)
				left join escalas Escala on (Escala.setor_id=Setor.id and Escala.mes=$mes and Escala.ano=$ano)
				left join militars_escalas MilitarEscala on (MilitarEscala.escala_id=Escala.id and MilitarEscala.militar_id=Militar.id)
				 where Militar.id='{$registro['Orcamentoefetivo']['militar_id']}'
				group by Setor.id
				";
				
				$outrosdados = $this->Orcamento->query($sqladicional);
				
				$setores = '';
				foreach($outrosdados as $registros){
					$this->data['Orcamento']['nome_guerra']=$registros['Militar']['nm_guerra'];
					$tmp = $registros['Setor']['sigla_setor'];
					$setores .= $tmp;
					$setores .= "\n\r";
					
				}
				$this->data['Orcamento']['setor'] = $setores;
				
				
				$militarID = $registro['Orcamentoefetivo']['militar_id'];
				$data1 = strtotime($dia.' -1 day');
				$data2 = strtotime($dia);
				
				$dia1=date('d',$data1);
				$mes1=date('m',$data1);
				$ano1=date('Y',$data1);
				
				$dia2=date('d',$data2);
				$mes2=date('m',$data2);
				$ano2=date('Y',$data2);
				
				$dt1 = $ano1.'-'.$mes1.'-'.$dia1;
				$dt2 = $ano2.'-'.$mes2.'-'.$dia2;
		
				$sql = "select * from afastamentos Afastamento where militar_id='$militarID'  and ( (DATEDIFF('{$dt1}',dt_inicio)>=0 or DATEDIFF('{$dt1}',dt_inicio)<=0) and DATEDIFF('{$dt1}',dt_termino)<=0) and  (DATEDIFF('{$dt2}',dt_inicio)>=0) and motivo not like '%EXPEDIENTE ADMINISTRATIVO%' group by motivo, dt_inicio, dt_termino 	";
				
				$conflitos = $this->Orcamento->query($sql);
				
				$justificativa = '';
				
				foreach ($conflitos as $ausencia){
					$justificativa .= $ausencia['Afastamento']['motivo'].'->'.$ausencia['Afastamento']['dt_inicio'].' a '.$ausencia['Afastamento']['dt_termino'].'<br>';
				}
				
				$mes_escala1 = $ano1.$mes1;
				$mes_escala2 = $ano2.$mes2;
					
				$sql = "select Setor.sigla_setor, STR_TO_DATE(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'%Y-%m-%d') as data, Turno.rotulo, Turno.hora_inicio, Turno.hora_termino, Cumprimentoescala.legenda_cumprido, Cumprimentoescala.dia from escalas Escala
				INNER JOIN  escalasmonths  Escalasmonth on  ((Escalasmonth.mes=$mes_escala1 or Escalasmonth.mes=$mes_escala2) and Escala.id=Escalasmonth.escala_id)
				INNER JOIN cumprimentoescalas Cumprimentoescala on ( Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.cumprido='$militarID')
				INNER JOIN turnos Turno on (Turno.id=Cumprimentoescala.id_turno)
				INNER JOIN setors Setor on (Setor.id=Escala.setor_id)
				where ((DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0 or DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')<=0) and DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt2}')<=0) and  (DATEDIFF(concat(SUBSTRING(Escalasmonth.mes,-6,4),'-',SUBSTRING(Escalasmonth.mes,-2,2),'-', LPAD(Cumprimentoescala.dia,2,'0')),'{$dt1}')>=0)
				order by data asc
						";
							
				$conflitos = $this->Orcamento->query($sql);
				foreach ($conflitos as $ausencia){
					$justificativa .= $ausencia['Setor']['sigla_setor'].'->'.$ausencia['Turno']['rotulo'].' '.$ausencia['Turno']['hora_inicio'].'-'.$ausencia['Turno']['hora_termino'].' dia:'.$ausencia['Cumprimentoescala']['dia'].' '.$ausencia['Cumprimentoescala']['legenda_cumprido'].'<br>';
				}
				
				$this->data['Orcamento']['justificativa_termino'] = $justificativa;
				$this->data['Orcamento']['justificativa_inicio'] = $justificativa;

				$this->data['Orcamento']['divisao'] = $divisao;
				$this->data['Orcamento']['nome_Orcamento'] = $nome_Orcamento;
				
				if(strlen($justificativa)>5){
					$this->data['Orcamento']['presenca_inicio'] = 'F';
					$this->data['Orcamento']['presenca_termino'] = 'F';
				}
				$this->Orcamento->create();
				if ($this->Orcamento->save($this->data)) {
					$ok=1;
				} else {
					$ok=0;
				}
				
				
			}
			
		}
		if(($compara==1)||(($compara==17)&&(!empty($divisao))&&(!empty($this->data['Orcamento']['id'])))){
			$dia = $this->data['Orcamento']['dia'];
			$divisao= $this->data['Orcamento']['divisao'];
			$nome_Orcamento= $this->data['Orcamento']['nome_Orcamento'];
			
			if(empty($nome_Orcamento)){
				$nome_Orcamento= 'EXPEDIENTE';
			}
				
			$this->set(compact('nome_Orcamento'));
			$this->set(compact('dia'));
			
			if ($this->Orcamento->save($this->data)) {
				$ok=1;
			} else {
				$ok=0;
			}
			
		
			
				
			}
		
		
		
		$this->set(compact('ok'));
}

function externolista($nome_Orcamento=null,$dia = null) {
		$this->layout = 'ajax';
		$u = $this->Session->read('Usuario');
		$divisao=$u[0]['Usuario']['divisao'];
		$compara = $u[0]['Usuario']['privilegio_id'];
		
		$completa = '';
		
		if(empty($dia)){
			$dia .= date('Y-m-d',strtotime(' now '));
		}
		$completa .= "  and dia='$dia'  ";
		
		if(!empty($divisao)){
			$completa .= " and divisao='$divisao' ";
		}
		if(!empty($nome_Orcamento)){
			$completa .= " and nome_Orcamento='$nome_Orcamento'";
		}
		if(($compara==1)||(($compara==17)&&(!empty($divisao)))){
			$sql = "select * from Orcamentos as Orcamento where 1=1  $completa order by dia desc, divisao asc, nome_Orcamento asc, nome_completo asc ";
			//echo $sql;
			return $this->Orcamento->query($sql);
		}
		
		//return $this->Orcamento->find('all');
}
function externosetores() {
		$this->layout = 'ajax';
		//$consulta=$this->Orcamento->Setor->find('list',array('conditions'=>array('Setor.unidade_id'=>$this->data['Orcamento']['unidade_id'])));
		$consulta[0] = '---';

		$sql = "select * FROM Orcamentos as Orcamento ";
		$consulta = $this->Orcamento->query($sql);
		
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Orcamento']['id']}'>{$conteudo['Orcamento']['divisao']}</option>";
			//$setors[$conteudo['Setor']['id']]=$conteudo['Setor']['sigla_setor'];
		}
		
	//	foreach($consulta as $k => $v){	echo "<option value='$k'>$v</option>"; }
	
		exit();
		
}
function externogravapresenca() {
	$this->layout = 'ajax';
	//$consulta=$this->Orcamento->Setor->find('list',array('conditions'=>array('Setor.unidade_id'=>$this->data['Orcamento']['unidade_id'])));
	$ok = 0;
	
	$tipo = $_POST['tipo'];
	$valor = $_POST['valor'];
	$id = $_POST['id'];
	
	if($tipo=='I'){
		$completa .= " presenca_inicio='$valor' ";
	}else{
		$completa .= " presenca_termino='$valor' ";
	}
	
	$sql = "update Orcamentos set $completa where id='$id' ";
	$consulta = $this->Orcamento->query($sql);

	if($this->Orcamento->query($sql)){
		$ok = 1;
	}
	echo $ok;
	//	foreach($consulta as $k => $v){	echo "<option value='$k'>$v</option>"; }

	exit();

}

function externocalendario(){
	$mes = $this->params['url']['mes'];
	if(empty($mes)){
		$mes = date('m');
	}
	$ano = $this->params['url']['ano'];
	if(empty($ano)){
		$ano = date('Y');
	}
	//$this->layout = 'limpo';
	
	$u = $this->Session->read('Usuario');
	$divisao=$u[0]['Usuario']['divisao'];
	$completa = '';
	if(!empty($divisao)){
		$completa .= ' and divisao="'.$divisao.'"';
	}

	$sql = "select * from Orcamentos as Orcamento where 1=1  $completa group by dia, divisao, nome_Orcamento order by dia asc, divisao asc, nome_Orcamento asc ";
	$registros = $this->Orcamento->query($sql);
	
	foreach($registros as $registro){
		$dados[strtotime($registro['Orcamento']['dia'])]=array(
				'nome_Orcamento' => $registro['Orcamento']['nome_Orcamento'], 'dia' => $registro['Orcamento']['dia'], 'divisao' => $registro['Orcamento']['divisao']
		);

	}
	//echo '<br><br>';print_r($dados);
	$this->set('dados',$dados);
}

function indexPdf($dia=null, $nome_Orcamento=null, $divisao=null){
	$this->layout="xtcpdf";
	$u = $this->Session->read('Usuario');
	$sql = "select * from militars Militar 
			inner join Orcamentoefetivos Orcamentoefetivo on (Orcamentoefetivo.militar_id=Militar.id)
			inner join Orcamentos Orcamento on (Orcamento.Orcamentoefetivo_id=Orcamentoefetivo.id and Orcamento.dia='$dia' and Orcamento.nome_Orcamento='$nome_Orcamento' and Orcamento.divisao='$divisao' )
			inner join postos Posto on (Posto.id=Militar.posto_id) 
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id) 
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id) 
			order by Posto.antiguidade asc, Militar.nm_guerra asc ";


	$status = $this->Orcamento->query($sql);
	$this->set('militar',$status);
	$this->set('u',$u);
	$this->render();

}

function externogravajustificativa() {
	$this->layout = 'ajax';
	//$consulta=$this->Orcamento->Setor->find('list',array('conditions'=>array('Setor.unidade_id'=>$this->data['Orcamento']['unidade_id'])));
	$ok = 0;

	$tipo = $_POST['tipo'];
	$valor = $_POST['valor'];
	$id = $_POST['id'];

	if($tipo=='JI'){
		$completa .= " justificativa_inicio='$valor' ";
	}else{
		$completa .= " justificativa_termino='$valor' ";
	}

	$sql = "update Orcamentos set $completa where id='$id' ";
	$consulta = $this->Orcamento->query($sql);

	if($this->Orcamento->query($sql)){
		$ok = 1;
	}
	echo $ok;
	//	foreach($consulta as $k => $v){	echo "<option value='$k'>$v</option>"; }

	exit();

}

function externocomunicado() {
		$this->layout = 'mobile';
		//exit();
//		echo "<br><br><br><br>";
		
		$msgcomunicado = '';
		
		//print_r($this->data);
		if(!empty($this->data)){
			
		
		$arquivo = '/var/www/sgbdo/webroot/pdf/texto.txt';
		$u = $this->Session->read('Usuario');
		$nome=$u[0][0]['nome'];
		$somecontent = '<div class="warning"><b><u>3S (BCT, BCO, SAI) DA DIVISÃO DE OPERAÇÕES DISPONÍVEIS PARA AS ESCALAS RISAER</u></b><br><br>Clique no atalho para visualizar o PDF. <a href="'.$this->webroot.'/pdf/comunicado.pdf" target="_blank">>>>ATALHO<<<</a><br><br><br> <b><i>Atualizado em '.date('d-m-Y h:i:s').'</i></b></div>';
		
		if (is_writable($arquivo)) {
			if (!$handle = fopen($arquivo, 'w')) {
				$msgcomunicado.= "($arquivo) não pode ser aberto.";
				exit;
			}
		
			// Write $somecontent to our opened file.
			if (fwrite($handle, $somecontent) === FALSE) {
			$msgcomunicado .= "($arquivo) não pode ser escrito.";
			exit;
			}
		
			$msgcomunicado.=  "Sucesso!";
		
			fclose($handle);
		
		} else {
		$msgcomunicado.=  "$arquivo não tem permissão de escrita.";
		}		
		
		

		if (!empty($this->data)&& strlen($this->data['Orcamento']['dados']['tmp_name'])>0) {
			if ((stripos($this->data['Orcamento']['dados']['name'],'pdf')!==false)){
				$tmp_name = $this->data['Orcamento']['dados']['tmp_name'];
				if (is_uploaded_file($this->data['Orcamento']['dados']['tmp_name'])){
					if(move_uploaded_file($tmp_name, "/var/www/sgbdo/webroot/pdf/comunicado.pdf")){
						$msgcomunicado .= 'Os dados do comunicado foram gravados.';
					}else{
						$msgcomunicado .= 'Os dados de comunicado não foram gravados. Por favor, tente novamente.';
					}
				}
			}else {
				$msgcomunicado .= 'Somente arquivos do tipo imagem PDF . Por favor, tente novamente.';
			}
		}
			$this->set('msgcomunicado',$msgcomunicado);
		}
}

}
?>