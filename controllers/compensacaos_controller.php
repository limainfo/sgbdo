<?php
class CompensacaosController extends AppController {

	var $name = 'Compensacaos';
	var $helpers = array('Html', 'Form', 'Ajax', 'Pdf');
    var $components = array('RequestHandler');
    var $paginate = array('limit' => 15, 'page' => 1, 'order'=>array('nmcompleto'=>'asc'));
	
function add() {
		//$this->layout = null;
		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
		 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
		INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
		order by Posto.antiguidade,Militar.nm_completo asc";
		$this->set('compensacaos', $this->Compensacao->find('all'));

		$this->set(compact('militars'));
}

function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido ', true));
			$this->redirect(array('action'=>'add'));
		}
		$oculta= "&nbsp;&nbsp;<a onclick=\"this.href='#';HideContent('flashMsg');return false;\" href=\"{$this->webroot}compensacaos/externoadd\"><img border=\"0\" title=\"Oculta\" alt=\"Ocultar\" src=\"{$this->webroot}img/btsair.gif\"></a>";
		if ($this->Compensacao->delete($id)) {
			$this->Session->setFlash(__('Registro excluído'.$oculta, true));
			$this->redirect(array('action'=>'add'));
		}
}
 
function externoedit($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Compensacao->read(null,$id);
}

function externoadd($id = null) {
		$u=$this->Session->read('Usuario');
                
		$this->layout = null;
		$id = $this->data['id'];
		$this->data = $this->Compensacao->read(null,$id);
}

function externoeditgrava($id = null) {
	
		$this->layout = null;
//		$this->data['Militar']['id']=$this->data['Militar']['militar_id'];
//		unset($this->data['Militar']['militar_id']);
//		unset($divisao);
//		unset($subdivisao);
		$ok=0;
		if (!empty($this->data)) {
			$this->Compensacao->create();
			if ($this->Compensacao->save($this->data)) {
				$ok=1;
			} else {
				$ok=0;
			}
		}
		$this->set(compact('ok'));
}

function externolista($id = null) {
		$this->layout = 'ajax';
		$u=$this->Session->read('Usuario');
		
		//Somente os usuários que cadastraram
		$sql1 = "select * from compensacaos Compensacao
		where usuario_id='{$u[0]['Usuario']['militar_id']}'
		order by Compensacao.nmcompleto asc";
		
		$sql1 = "select * from compensacaos Compensacao 
		 order by Compensacao.nmcompleto asc";
		 //foreach (
		return $this->Compensacao->query($sql1);
}

function externogeraplanilha(){
		$this->layout = null;
		$ano = $this->data['Compensacao']['ano'];
		if(empty($ano)){
			$ano = date('Y');
		}
		$u=$this->Session->read('Usuario');

		//Somente os usuários que cadastraram
		$sql = "select * FROM compensacaos as Compensacao
		where Compensacao.usuario_id='{$u[0]['Usuario']['militar_id']}'
		order by Compensacao.nmcompleto asc ";
		$militares = $this->Compensacao->query($sql);
		

		$sql = "select * FROM compensacaos as Compensacao
		order by Compensacao.nmcompleto asc ";
		$militares = $this->Compensacao->query($sql);
				
		foreach($militares as $selecionado){
			
		$tudo = "select Escalasmonth.mes, Escalasmonth.id, Escala.tipo, Turno.hora_inicio, Turno.hora_termino, Setor.sigla_setor, Unidade.sigla_unidade, Militar.*, Cumprimentoescala.*, count(cumprido) total_turno_mes, Posto.sigla_posto, Especialidade.nm_especialidade, Quadro.sigla_quadro  from 
			cumprimentoescalas Cumprimentoescala
			inner join militars_escalas MilitarEscala on (MilitarEscala.militar_id=Cumprimentoescala.cumprido and MilitarEscala.militar_id='{$selecionado['Compensacao']['militar_id']}')
			inner join militars Militar on (Militar.id=Cumprimentoescala.cumprido)
			inner join postos Posto on (Posto.id=Militar.posto_id)
			inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			inner join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			inner join escalasmonths Escalasmonth on (Escalasmonth.id=Cumprimentoescala.escalasmonth_id and Escalasmonth.mes like '%{$ano}%' ) 
			inner join escalas Escala on (Escala.id=MilitarEscala.escala_id and Escalasmonth.escala_id=Escala.id) 
			inner join turnos Turno on (Turno.id=Cumprimentoescala.id_turno) 
			inner join setors Setor on (Setor.id=Escala.setor_id) 
			left join unidades Unidade on (Unidade.id=Setor.unidade_id) 
			group by Cumprimentoescala.escalasmonth_id, Cumprimentoescala.id_turno
			order by Escalasmonth.mes asc, Militar.nm_completo asc  
		";
		//echo $tudo;
		$conteudo = $this->Compensacao->query($tudo);
		//echo '<pre>';print_r($conteudo);echo '</pre>';exit();
		
		foreach($conteudo as $geral){
			$mes = substr($geral['Escalasmonth']['mes'],-2);
			$mes = (int)$mes;
			if(empty($mes)){
				$mes = 0;
			}
			$inicio = strtotime($geral['Turno']['hora_inicio']);
			$termino = strtotime($geral['Turno']['hora_termino']);
			$v1h1 = date('G', $inicio);
			$v1h2 = date('G', $termino);
			$v1m1 = date('i', $inicio);
			$v1m2 = date('i', $termino);
			$v1 = $v1h1 + ($v1m1/60);
			$v2 = $v1h2 + ($v1m2/60);
			if($v2<=$v1){
				$qtd_horas = (24-$v1) + $v2;
			}else{
				$qtd_horas = (abs($v1 - $v2));
			}
			$qtd_horas *= $geral[0]['total_turno_mes']; 
			
			$qtd_horas = abs($qtd_horas);

			$resultado[$selecionado['Compensacao']['militar_id']]['saram']=$geral['Militar']['saram'];
			$resultado[$selecionado['Compensacao']['militar_id']]['cpf']=$geral['Militar']['cpf'];
			$resultado[$selecionado['Compensacao']['militar_id']]['setor']=$geral['Unidade']['sigla_unidade'].'-'.$geral['Setor']['sigla_setor'];
			$resultado[$selecionado['Compensacao']['militar_id']]['identidade']=$geral['Militar']['identidade'];
			$resultado[$selecionado['Compensacao']['militar_id']]['posto']=$geral['Posto']['sigla_posto'];
			$resultado[$selecionado['Compensacao']['militar_id']]['nome']=$geral['Militar']['nm_completo'];
			$resultado[$selecionado['Compensacao']['militar_id']]['guerra']=$geral['Militar']['nm_guerra'];
			$resultado[$selecionado['Compensacao']['militar_id']]['licenca']=$geral['Militar']['nr_licenca'];
			$resultado[$selecionado['Compensacao']['militar_id']]['indicativo']=$geral['Militar']['indicativo'];
			$resultado[$selecionado['Compensacao']['militar_id']]['quadro']=trim($geral['Quadro']['sigla_quadro']).' '.trim($geral['Especialidade']['nm_especialidade']);
			$resultado[$selecionado['Compensacao']['militar_id']]['nomecomposto']=$geral['Posto']['sigla_posto'].' '.trim($geral['Quadro']['sigla_quadro']).' '.trim($geral['Especialidade']['nm_especialidade']).' '.$geral['Militar']['nm_completo'];
			
			$setor = $geral['Setor']['sigla_setor'];
			$resultado[$selecionado['Compensacao']['militar_id']][$mes]['nomeescala'][$geral['Escalasmonth']['id']]=$setor;
			$antes = $resultado[$selecionado['Compensacao']['militar_id']][$mes]['horas'][$geral['Escalasmonth']['id']];
			$total = $qtd_horas + $antes + 0;
			$resultado[$selecionado['Compensacao']['militar_id']][$mes]['horas'][$geral['Escalasmonth']['id']]=$total;
			
		}
		
		
		
		}
		//echo '<pre>';print_r($resultado);echo '</pre>'; exit();
		
		$this->set('resultado',$resultado);		
		$this->set('ano',$ano);		

}


}
?>
