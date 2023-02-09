<?php
class CursoativosController extends AppController {

	var $name = 'Cursoativos';
	var $helpers = array('Html', 'Form');

	function index() {

		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );
		
		if ( $findUrl != '' ) {
			$opcoes = " (LOWER(`Curso`.`codigo`) LIKE '%".$findUrl."%' OR LOWER(`Cursoativo`.`turma`) LIKE '%" . $findUrl ."%' )";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Cursoativo->recursive = 1;
					$registros = $this->Cursoativo->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Cursoativo->recursive = 1;
			$this->set('cursoativos', $this->paginate('Cursoativo',array(" (LOWER(`Curso`.`codigo`) LIKE '%".$findUrl."%' OR LOWER(`Cursoativo`.`turma`) LIKE '%" . $findUrl ."%' )")));	
			} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Cursoativo->recursive = 1;
					$registros = $this->Cursoativo->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Cursoativo->recursive = 0;
			$this->set('cursoativos', $this->paginate());
		}
		
	
	}

	function view($id = null) {
		$this->layout = 'admin';

		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Cursoativo.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->set('cursoativo', $this->Cursoativo->read(null, $id));
		//$this->set('militars', $this->Cursoativo->Indicadoscurso->Militar->find('all'));
	}

	function add($curso_id = null) {
		if (!empty($this->data)) {
			$this->Cursoativo->create();
			if ($this->Cursoativo->save($this->data)) {
				$this->Session->setFlash(__('Os dados de  Cursoativo foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Cursoativo não foram gravados. Por favor, tente novamente.', true));
			}
		}
		//$this->Cursoativo->unbindModel(array());
		$this->Cursoativo->Curso->recursive = 0;
		if($curso_id>0){
			$cursos_completos = $this->Cursoativo->Curso->findById($curso_id);
			$cursos[$cursos_completos['Curso']['id']] = $cursos_completos['Curso']['codigo'];
			$id = $cursos_completos['Curso']['id'];
			$this->set(compact('cursos','id'));
		}else{
		$sql = "select Curso.id, Curso.codigo from cursos Curso order by Curso.codigo asc";
		$rotulos = $this->Cursoativo->query($sql);
		//$vetor[0] = 'TODOS';
		foreach($rotulos as $linha){
			$vetor[$linha['Curso']['id']] = $linha['Curso']['codigo'];
		}
		$cursos = $vetor;
			
//			$cursos = $this->Cursoativo->Curso->find('list');
			/*
			$cursos_completos = $this->Cursoativo->Curso->find('all');
			//print_r($cursos_completos);
			foreach($cursos_completos as $curso){
			$cursos[$curso['Curso']['id']] = $curso['Curso']['codigo'];
			}
*/
		$tipocursos = $this->Cursoativo->Tipocurso->find('list');
			$this->set(compact('cursos','id','tipocursos'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Cursoativo', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cursoativo->save($this->data)) {
				$this->Session->setFlash(__('Os dados de Cursoativo foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados de Cursoativo não foram gravados. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cursoativo->read(null, $id);
		}
		$cursos = $this->Cursoativo->Curso->findById($this->data['Curso']['id']);
		
		$temp[$cursos['Curso']['id']] = $cursos['Curso']['codigo'];
		unset($cursos);
		$cursos = $temp; 
		
		$tipocursos = $this->Cursoativo->Tipocurso->find('list');
			$this->set(compact('cursos','id','tipocursos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Cursoativo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cursoativo->delete($id)) {
			$this->Session->setFlash(__('Cursoativo excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function indexExcel($ano = null)
	{

		$this->layout = 'openoffice' ; 
		//echo date('W',mktime(0,0,0,01,31,2009));
		$titulo = 'Dados dos cursos ativos';
		$tabela = 'Cursosativo';
		$nome = 'planilha_paeat_'.$ano;
		
		$this->Cursoativo->recursive = 0;
		$this->Cursoativo->conditions = array('or'=>array('year(Cursoativo.data_inicio)'=>$ano, 'year(Cursoativo.data_termino)'=>$ano));
		$this->Cursoativo->order = array('Curso.codigo'=>'asc', 'Cursoativo.data_inicio'=>'asc');
		$linha = $this->Cursoativo->find('all');
		
		$i = 0;
		foreach($linha as $coluna){
			//if(count($coluna['Indicadoscurso'])>0){
			$conteudo[$i]['Curso'] = $coluna['Curso']['codigo'];
			$conteudo[$i]['Turma'] = $coluna['Cursoativo']['turma'];
			$conteudo[$i]['DataInicio'] = $coluna['Cursoativo']['data_inicio'];
			$conteudo[$i]['DataTermino'] = $coluna['Cursoativo']['data_termino'];
			$conteudo[$i]['Vagas'] = $coluna['Cursoativo']['vagas'];
			$i ++;
			//}
		}
		//$campos = array('CURSO', 'JAN','FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ');
		$semanas = date('W',mktime(0,0,0,12,31,2009));
		
		$campos[0] = 'Curso';
		for($i=1;$i<=$semanas;$i++){
			$campos[$i] = $i;	
		}
		
		
		//$campos = array('Curso', 'Turma','DataInicio', 'DataTermino', 'Vagas');
		$contalinha = 0;
		$temp = $conteudo[0]['Curso'];
		$valor = '['.$conteudo[0]['Turma'].']';
		
		foreach($conteudo as $registros){
			if($temp == $registros['Curso']){
				$vetor[$contalinha]['Curso'] = $temp; 
				
				$data = explode('-',$registros['DataInicio']);
				$inicio = date('W',mktime(0,0,0,$data[1],$data[0],$data[2]));

				$data = explode('-',$registros['DataTermino']);
				$fim = date('W',mktime(0,0,0,$data[1],$data[0],$data[2]));
				
				$vetor[$contalinha]['inicio'] = $inicio;
				$vetor[$contalinha]['fim'] = $fim;
				
				if(empty($vetor[$contalinha][$inicio])){
					//$vetor[$contalinha][$inicio] = '('.$valor.'->'.$registros['DataInicio']."\n".$registros['DataTermino'].')';
				}else{
					//$vetor[$contalinha][$inicio] = '('.$valor.'->'.$registros['DataInicio']."\n".$registros['DataTermino'].')'.$vetor[$contalinha][$inicio];
				} 
				//$inicio++;
				for($indice=$inicio;$indice<=$fim;$indice++){
					$vetor[$contalinha][$indice] .= $valor; 
				}
				
			}else{
				$temp = $registros['Curso'];
				$valor = '['.$registros['Turma'].']';
				$contalinha++;
			}
			
		}
		unset($conteudo);
		$conteudo = $vetor;
		
		/*
		echo "<pre>";
		print_r($linha);
		echo "</pre>";
		exit(1);
		* 		*/
		
		
		$this->set(compact('titulo','tabela','conteudo','campos','nome'));
		
		$this->render();
	}	

}
?>