<?php
class MilitarsCursosController extends AppController {

	var $name = 'MilitarsCursos';
	var $helpers = array('Html', 'Form', 'Ajax');

	function externoview(){
		$ok = 1;
		//print_r($this->data);
		
		if($this->MilitarsCurso->save($this->data['MilitarsCurso'])){
			$ok = 1;
		}else{
			$ok = 0;
		}
		

	    header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.(addslashes($mensagem)).'"}';
		exit();

	}
	
	function index() {
		$this->redirect(array('action'=>'add'));
		/*
		 $this->MilitarsCurso->recursive = 0;
		 //$this->set('militarsCursos', $this->paginate());
		 $sql = 'select Unidade.sigla_unidade,Unidade.id, Setor.sigla_setor,Setor.id,  Especialidade.nm_especialidade, Especialidade.id, Quadro.sigla_quadro from setors Setor
		 INNER JOIN unidades Unidade on (Setor.unidade_id=Unidade.id)
		 LEFT JOIN especialidades Especialidade on (Especialidade.id>0 and trim(Especialidade.nm_especialidade)<>"")
		 INNER JOIN quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		 order by Unidade.sigla_unidade asc, Setor.sigla_setor asc, Especialidade.nm_especialidade asc';
		 $linhas = $this->MilitarsCurso->query($sql);



		 $sql = 'select Curso.codigo, Curso.id from cursos Curso order by Curso.codigo asc';
		 $colunas = $this->MilitarsCurso->query($sql);

		 $this->set(compact('colunas','linhas'));
		 */
	}

	function view($id = null) {
		$this->redirect(array('action'=>'add'));
		/*
		 $this->layout = 'admin';
		 if (!$id) {
			$this->Session->setFlash(__('Inválido Militar/Curso.', true));
			$this->redirect(array('action'=>'index'));
			}
			$this->set('militarsCurso', $this->MilitarsCurso->read(null, $id));
			*/
	}

	function add() {
		$this->layout = 'admin';
		//$this->MilitarsCurso->Militar->recursive = 1; //,'Militar.id=1' //,'hasAndBelongsToMany'=>array('Escala','Curso') , 'hasOne'=>array('Foto','Assinatura'),'belongsTo'=>array('Setor'),
		//$this->MilitarsCurso->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Escala','Curso'), 'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Afastamento','Atividade','Exame','Habilitacao')));
		//$this->MilitarsCurso->Curso->unbindModel(array('hasMany'=>array('MilitarsCurso','Cursoativo'),'hasAndBelongsToMany'=>array('Militar')));
		//$militares = $this->MilitarsCurso->Militar->find('all');

		/*
		 echo "<pre>";
		 print_r($militares);
		 echo "</pre>";
		 * 		* 		*/
		
		
$sql1 = "select  Militar.id  , concat( Militar.nm_completo,' - ',Militar.nm_guerra,  ' ',Posto.sigla_posto,' ',Especialidade.nm_especialidade)  as 'Militar.nm_completo'
 FROM militars as Militar INNER JOIN postos as Posto ON (Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
Where Militar.ativa>0
order by Posto.antiguidade asc,Militar.nm_completo asc";
			
		

		$militars = $this->MilitarsCurso->query($sql1);


		foreach($militars as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico[0]['Militar.nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);		
/*		
		foreach($militares as $milico){
			$vetor[]=$milico['Militar']['id'];
			$vetor2[]=$milico['Posto']['sigla_posto'].' - '.$milico['Especialidade']['nm_especialidade'].'  '.$milico['Militar']['nm_guerra'].' - '.$milico['Militar']['nm_completo'];
		}
		$militars=array_combine($vetor,$vetor2);
		asort($militars);
	*/	
		
		$sql = "select Curso.id, Curso.codigo from cursos Curso order by Curso.codigo asc ";
		$rotulos = $this->MilitarsCurso->query($sql);
		
		foreach($rotulos as $linha){
			$vetor3[$linha['Curso']['id']] = $linha['Curso']['codigo'];
		}
		$cursos = $vetor3;
		

		//$militars = $this->MilitarsCurso->Militar->find('list');
		//$cursos = $this->MilitarsCurso->Curso->find('list');


		$this->set(compact('militars', 'cursos'));
	}

	function edit($curso_id = null, $militar_id = null) {

		$this->layout = null;
				$ok='1';

		
		if(!empty($militar_id)){
			$options = 'MilitarsCurso.curso_id='.$curso_id.' and MilitarsCurso.militar_id='.$militar_id;
		}else{
			$options = 'MilitarsCurso.curso_id='.$curso_id;
		}
		
		$consulta='select * from militars Militar inner join militars_cursos MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
		inner join cursos Curso on (MilitarsCurso.curso_id=Curso.id)
		inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		inner join setors Setor on (Setor.id=Militar.setor_id)
		inner join postos Posto on (Posto.id=Militar.posto_id)
		where '.$options.'
		order by Militar.nm_completo asc
		';
		//echo $consulta;
		//$militarscursos= $this->MilitarsCurso->findAll($options);
		$militarscursos= $this->MilitarsCurso->query($consulta);
		
		
		$this->set(compact('militarscursos'));



	}

	function delete($id = null, $curso_id = null) {
		if (!$id) {
			$ok = '0';
		}
		if ($this->MilitarsCurso->delete($id)) {
			$ok='1';
		}
		$this->layout = null;
		
		/*
		$this->MilitarsCurso->recursive = 2;
		$this->MilitarsCurso->Militar->recursive = 2;
		$this->MilitarsCurso->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Escala','Curso'), 'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Afastamento','Atividade','Exame','Habilitacao')));
		$this->MilitarsCurso->Curso->unbindModel(array('hasMany'=>array('MilitarsCurso','Cursoativo'),'hasAndBelongsToMany'=>array('Militar')));
		$options = array('MilitarsCurso.curso_id'=>$curso_id);
		$militarscursos= $this->MilitarsCurso->findAll($options);
*/
		$options = 'MilitarsCurso.curso_id='.$curso_id;
		$consulta='select * from militars Militar inner join militars_cursos MilitarsCurso on (MilitarsCurso.militar_id=Militar.id)
		inner join cursos Curso on (MilitarsCurso.curso_id=Curso.id)
		inner join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		inner join setors Setor on (Setor.id=Militar.setor_id)
		inner join postos Posto on (Posto.id=Militar.posto_id)
		where '.$options.'
		order by Militar.nm_completo asc
		';
		//echo $consulta;
		//$militarscursos= $this->MilitarsCurso->findAll($options);
		$militarscursos= $this->MilitarsCurso->query($consulta);
		
		
		$this->set(compact('militarscursos','ok'));
			
		


	}

	function verso($curso_id = null) {
		$mensagem="";
		$ok='0';
		//print_r($this->data);
		//exit(1);
		if (!empty($this->data)) {
			$this->MilitarsCurso->create();
			if ($this->MilitarsCurso->save($this->data['MilitarsCurso'])) {
				//	if (1) {
				$ok='1';

				$this->MilitarsCurso->recursive = 2;
				$this->MilitarsCurso->Militar->recursive = 2;
				$this->MilitarsCurso->Militar->unbindModel(array('hasAndBelongsToMany'=>array('Escala','Curso'), 'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Afastamento','Atividade','Exame','Habilitacao')));
				$this->MilitarsCurso->Curso->unbindModel(array('hasMany'=>array('MilitarsCurso','Cursoativo'),'hasAndBelongsToMany'=>array('Militar')));
				$options = array('MilitarsCurso.curso_id'=>$curso_id);
				$militarscursos= $this->MilitarsCurso->findAll($options);
				$mensagem= "<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Setor</th><th>Curso</th><th>Data Inicio</th><th>Data Fim</th><th>Local</th><th>Documento</th><th>Ações</th></tr>";

				//				print_r($militarscursos);

				$i = 0;
				foreach ($militarscursos as $militarscurso):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}

				//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
				$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$militarscurso['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$militarscurso['MilitarsCurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

				$mensagem .= "	<tr {$class}><td>{$militarscurso['Militar']['Posto']['sigla_posto']} {$militarscurso['Militar']['Especialidade']['nm_especialidade']} - {$militarscurso['Militar']['nm_completo']}</td><td>{$militarscurso['Militar']['Setor']['sigla_setor']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['dt_inicio_curso']}</td><td>{$militarscurso['MilitarsCurso']['dt_fim_curso']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$militarscurso['MilitarsCurso']['documento']}</td><td>{$acao}</td></tr>";

				endforeach;
				$mensagem.="</table>";

			}
		}
		header('Content-type: application/x-json');

		//$ok = urlencode(print_r($this, true));

		//echo '{ "ok":"1","obs":"'.urlencode($retorno[0]['versoescalas'][$v1]).'", "alteracoes":"'.urlencode($retorno[0]['versoescalas'][$v2]).'", "obscmt":"'.urlencode($retorno[0]['versoescalas'][$v3]).'", "mensagem":"" }';
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'" }';

		exit();


	}


}
?>