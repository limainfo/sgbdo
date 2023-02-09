<?php
class CursosController extends AppController {

	var $name = 'Cursos';

	function index() {
	/*
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
	*/	
		$findUrl = decodeURIComponent($this->data['formFind']['find']);
		$findUrl = str_replace('||','%',$findUrl);
		
		
		$opcoes = $findUrl;
		
		$esquema = $this->Curso->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Curso`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Curso`.``) LIKE '%" . $findUrl ."%' ";
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Curso->recursive = 1;
			//$this->Curso->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('cursos', $this->paginate('Curso',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Curso->recursive = 1;
			//$this->Curso->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('cursos', $this->paginate());
			}
	}


	function view($id = null, $setor_id = null, $especialidade_id = null, $popup = null) {
		if($popup=='p'){
		$this->layout = 'popupcursos';
		}else{
		$this->layout = 'admin';
		}
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Curso.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if($setor_id>0){
			$setor = ' and Militar.setor_id='.$setor_id.' ';
		}
		if($especialidade_id>0){
			$especialidade = ' and Militar.especialidade_id='.$especialidade_id.' ';
		}
		
		$sql1 = "select  Curso.id, Curso.codigo,Curso.descricao, Curso.pre_requisito, Curso.objetivo  , concat( Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_completo)  as nm_completo,
	 MilitarsCurso.id, Militar.identidade, Setor.sigla_setor, Unidade.sigla_unidade,
		MilitarsCurso.dt_inicio_curso, MilitarsCurso.dt_fim_curso, MilitarsCurso.local_realizacao,MilitarsCurso.documento
 FROM cursos as Curso
LEFT JOIN militars_cursos as MilitarsCurso on (MilitarsCurso.curso_id=Curso.id)
LEFT JOIN militars as Militar on (MilitarsCurso.militar_id=Militar.id and Militar.ativa>0)
LEFT JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id )
LEFT JOIN setors as Setor on (Militar.setor_id = Setor.id )
LEFT JOIN unidades as Unidade on (Unidade.id=Setor.unidade_id)
where  Curso.id=$id $especialidade $setor and Militar.ativa>0
order by Posto.antiguidade,Militar.nm_completo asc";
//echo $sql1;
//LEFT JOIN cursos as Curso on (Curso.id=$id)



$curso = $this->Curso->query($sql1);	
		
		$condicao = array('Cursoativo.curso_id'=>$id);
		$cursoativos =  $this->Curso->Cursoativo->findAll($condicao,null,array('Cursoativo.data_termino desc'));
		
		$this->set(compact('cursoativos','curso'));
		//$this->set('curso',$curso);
	}
	function add() {
		if (!empty($this->data)) {
			$this->Curso->create();
			if ($this->Curso->save($this->data)) {
			
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		foreach($this->data['Curso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Curso",now(),"Curso", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Curso->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela curso foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela curso não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$militars = $this->Curso->Militar->find('list');
		$this->set(compact('militars'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela curso não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from cursos Curso where Curso.id='.$id;
		$dadoslog=$this->Curso->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Curso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Curso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Curso",now(),"Curso", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Curso->query($monitora);
		
		
		
			if ($this->Curso->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela curso foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela curso não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Curso->read(null, $id);
		}
		$militars = $this->Curso->Militar->find('list');
		$this->set(compact('militars'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela curso não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from cursos Curso where Curso.id='.$id;
		$dadoslog=$this->Curso->query($consultalog);
		foreach($dadoslog[0]['Curso'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Curso",now(),"Curso", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Curso->query($monitora);
		
		
		
		
		
		if ($this->Curso->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Curso excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Curso não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Curso->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Curso->query('select * from cursos Curso where '.$filtro);
		$campos_busca = $this->Curso->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Curso';
		$tabela = 'Curso';
		$nome = 'planilha_Curso';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();


	}
	
	function broffice($id = null)
	{

		$this->layout = 'openoffice' ; //this will use the pdf.thtml layout
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Curso.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$sql1 = "select  Curso.id as ID, Curso.codigo as CODIGO,Curso.descricao as DESCRICAO,Curso.pre_requisito as REQUISITO,Curso.objetivo as OBJETIVO , concat( Posto.sigla_posto,' ',Especialidade.nm_especialidade,' ', Militar.nm_completo)  as MILITAR,
		Militar.identidade as IDENTIDADE, Setor.sigla_setor as SETOR, Unidade.sigla_unidade as UNIDADE,
		MilitarsCurso.dt_inicio_curso as INICIO, MilitarsCurso.dt_fim_curso as FIM, MilitarsCurso.local_realizacao as LOCAL,MilitarsCurso.documento as DOCUMENTO
 FROM militars as Militar INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
INNER JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
INNER JOIN setors as Setor on (Militar.setor_id = Setor.id and Militar.ativa>0)
INNER JOIN unidades as Unidade on (Unidade.id=Setor.unidade_id)
INNER JOIN cursos as Curso on (Curso.id=$id) 
INNER JOIN militars_cursos as MilitarsCurso on (MilitarsCurso.militar_id=Militar.id and MilitarsCurso.curso_id=Curso.id) 
order by Posto.antiguidade,Militar.nm_completo asc";

		$dados = $this->Curso->query($sql1);	
		//print_r($dados);
		
		$campos = array("ID","CODIGO","DESCRICAO","REQUISITO","OBJETIVO","MILITAR","IDENTIDADE","SETOR","UNIDADE","INICIO","FIM","LOCAL","DOCUMENTO");
				

		
		$titulo = "Relatório do Curso:".$dados[0]['Curso']['CODIGO'];

		$nome = 'relacao_militares_curso_'.$dados[0]['Curso']['CODIGO'];
		//exit();
		$this->set(compact('dados','nome','titulo','campos'));
		$this->render();
	}

	
}
?>