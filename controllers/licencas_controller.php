<?php
class LicencasController extends AppController {

	var $name = 'Licencas';

	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
		if ( $findUrl != '' ) {
			$this->Licenca->recursive = 1;
			$opcoes = "LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' OR LOWER(`Licenca`.`nr_licenca`) LIKE '%" . $findUrl ."%' ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$registros = $this->Licenca->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->Licenca->recursive = 2;
			$this->set('licencas', $this->paginate('Licenca',array("LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' OR LOWER(`Licenca`.`nr_licenca`) LIKE '%" . $findUrl ."%' ")));
		} else {
			$this->Licenca->recursive = 2;
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
				$registros = $this->Licenca->find('all',$opcoes);
				$qtdPaginas = $this->data['formFind']['paginas'];
				$this->data['formFind']['paginas'] = count($registros);
			}
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
		}
		$this->data['formFind']['paginas'] = $this->paginate['limit'];
		$this->Licenca->recursive = 1;
		$this->set('licencas', $this->paginate());
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela licenca não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('licenca', $this->Licenca->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Licenca->create();
			
			$sql_ultima_licenca = 'select max(nr_licenca) maximo from militars;';
			$resultado=$this->Licenca->query($sql_ultima_licenca);
			$this->data['Licenca']['nr_licenca']=$resultado[0][0]['maximo']+1;
			
			$sql_ultimo_indicativo = 'select id, min(indicativo) minimo from indicativos where militar_id is null and indicativo > "EHBD";';
			$resultado=$this->Licenca->query($sql_ultimo_indicativo);
			$this->data['Licenca']['indicativo']=$resultado[0][0]['minimo'];
			
			$indicativoId=$resultado[0]['indicativos']['id'];
			
			$sql_atualiza_indicativo = 'update indicativos  set militar_id='.$this->data['Licenca']['militar_id'].', licenca='.$this->data['Licenca']['nr_licenca'].', created=now() where id='.$resultado[0]['indicativos']['id'].';';
			//$this->Licenca->query($sql_atualiza_indicativo);
			
			$sql_atualiza_militars = 'update militars set nr_licenca='.$this->data['Licenca']['nr_licenca'].', indicativo="'.$this->data['Licenca']['indicativo'].'" where id='.$this->data['Licenca']['militar_id'].';';
			//$this->Licenca->query($sql_atualiza_militars);
			
			$codigo_barra = 'PQ-RSCt 0'.date('m').date('Y').'.'.date('m').str_pad($indicativoId,7,'0');
			$this->data['Licenca']['codigo_barra'] = $codigo_barra;
			
			$this->data['Licenca']['expedicao'] = date('Y-m-d');
			$this->data['Licenca']['validade'] = date('Y-m-d',strtotime('+5 years'));
				
			if ($this->Licenca->save($this->data)) {
				
			$ip = $_SERVER['REMOTE_ADDR'];
			$u = $this->Session->read('Usuario');
			$usuario = $u[0][0]['nome'];

			foreach($this->data['Licenca'] as $chave=>$valor){
				$mudanca .= '['.$chave.']='.$valor.' ,';
			}
			$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Licenca",now(),"Licenca", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
			$this->Licenca->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela licenca foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela licenca não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$unidades = $this->Licenca->Unidade->find('list');
		$carimbos = $this->Licenca->Carimbo->find('list');
		$atas = $this->Licenca->Ata->find('list');
		//$militars = $this->Licenca->Militar->find('list');
		$militars[0] = 'Selecione a Unidade';
		$atas[0] = 'Selecione a Unidade';
		$boletiminternos[0] = 'Selecione a Unidade';
		$this->set(compact('unidades', 'militars', 'atas', 'boletiminternos', 'carimbos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela licenca não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
        	$sql_atualiza_militars = 'update militars set nr_licenca='.$this->data['Licenca']['nr_licenca'].', indicativo="'.$this->data['Licenca']['indicativo'].'" where id='.$this->data['Licenca']['militar_id'].';';
		$this->Licenca->query($sql_atualiza_militars);
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from licencas Licenca where Licenca.id='.$id;
		$dadoslog=$this->Licenca->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Licenca'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Licenca'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Licenca",now(),"Licenca", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Licenca->query($monitora);
		
		
		
			if ($this->Licenca->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela licenca foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela licenca não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Licenca->read(null, $id);
		}
		$this->Licenca->Unidade->recursive = 0;
        //$unidades = $this->Licenca->Unidade->read(null, $this->data['Licenca']['unidade_id']);
        $unidades = $this->Licenca->query('select Unidade.sigla_unidade, Unidade.id from unidades Unidade where Unidade.id='.$this->data['Licenca']['unidade_id']);
        $unidadestemp[$unidades[0]['Unidade']['id']]=$unidades[0]['Unidade']['sigla_unidade'];
		unset($unidades);
		$unidades=$unidadestemp;
		
		$this->Licenca->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
		$militars = $this->Licenca->Militar->read(null,$this->data['Licenca']['militar_id']);
		//print_r($militars);
		$militarstemp[$militars['Militar']['id']]=$militars['Militar']['nm_completo'].' - '.$militars['Posto']['sigla_posto'].' '.$militars['Especialidade']['nm_especialidade'];
		unset($militars);
		$militars=$militarstemp;
		
		
		$atas = $this->Licenca->Ata->find('list');
		$boletiminternos = $this->Licenca->Boletiminterno->find('list');
		$atas[0] = 'Não cadastrado';
		$boletiminternos[0] = 'Não cadastrado';
		$carimbos = $this->Licenca->Carimbo->find('list');
		$this->set(compact('unidades', 'militars', 'atas', 'boletiminternos','carimbos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela licenca não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from licencas Licenca where Licenca.id='.$id;
		$dadoslog=$this->Licenca->query($consultalog);
		foreach($dadoslog[0]['Licenca'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Licenca",now(),"Licenca", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Licenca->query($monitora);
		
		
		
		
		
		if ($this->Licenca->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Licenca excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Licenca não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function indexPdf($id = null)
	{
		$this->layout = 'pdf'; //this will use the pdf.thtml layout
		$this->Licenca->recursive = 1;
		
		if($id>0){
			$this->set('um',100);
			//print_r($this->Licenca->read(null, $id));
			//exit();
			//$licencas=$this->Licenca->read(null, $id);
			//$this->Licenca->bindModel(array('hasOne'=>array('Foto' => array('className' => 'Foto','foreignKey' => 'militar_id','dependent' => false,'conditions' => 'Foto.militar_id='.$licencas['Licenca']['militar_id']))));

			$militar_id=$this->Licenca->read('militar_id', $id);
			//$this->Licenca->bindModel(array('hasOne'=>array('Foto' => array('className' => 'Foto','foreignKey' => false,'dependent' => false,))));
			$this->Licenca->recursive = null;
			//echo 'Foto.militar_id='.$militar_id['Licenca']['militar_id'];
			$this->Licenca->bindModel(array('hasOne'=>array('Foto' => array('foreignKey' => false, 'dependent' => false, 'conditions' => array('Foto.militar_id='.$militar_id['Licenca']['militar_id'])))));
			$this->Licenca->unbindModel(array('belongsTo'=>array('Ata','Boletiminterno','Unidade')));
			$this->set('licencas', $this->Licenca->read(null, $id));
			//,'fields'=>array('id')
			$foto_id=$this->Licenca->Foto->find('first', array('conditions'=>array('Foto.militar_id'=>$militar_id['Licenca']['militar_id'])));
			$this->set('fotos', $foto_id['Foto']['id']);
			$this->set('carimbos', $this->Licenca->read('carimbo_id', $id));
			
			//print_r($this->Licenca->Foto->find('first', array('conditions'=>array('Foto.militar_id'=>$militar_id['Licenca']['militar_id']))));
			//print_r($foto_id);
			//print_r($this->Licenca->read(null, $id));
			//exit();
			//$this->set('fotos', $licencas['Foto']);
			
		}else{
			$consulta = decodeURIComponent($consulta);
			$consulta = str_replace('||','%',$consulta);
			$consulta = str_replace(']]]','/',$consulta);
			//$this->Licenca->unbindModel(array('hasAndBelongsToMany'=>'Escala', 'hasOne'=>'Assinatura','hasMany'=>'Afastamento'));
			$militars=$this->Licenca->findAll($consulta);
			$this->set(compact('licencas','consulta'));
		}
		$this->render();
	}
	
            function externomilitares() {
                    $this->layout = null;
                    $this->Militar->recursive = 0;
                    header('Content-type: application/x-json');

                    $sql = "select Militar.nm_guerra , Posto.sigla_posto , Quadro.sigla_quadro, Especialidade.nm_especialidade , Militar.nm_completo,
                    Militar.id
                    FROM militars as Militar
                    INNER JOIN postos as Posto ON(Posto.id = Militar.posto_id and Posto.id=Posto.id )
                    LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id)
                    INNER JOIN quadros as Quadro on (Quadro.id=Especialidade.quadro_id)
                    LEFT JOIN setors as Setor on (Militar.setor_id = Setor.id)
                    INNER JOIN unidades as Unidade on (Setor.unidade_id = Unidade.id and Unidade.id='{$this->data['Licenca']['unidade_id']}')
                    group by Militar.id
                    order by  Militar.nm_completo asc, Posto.antiguidade asc, Militar.dt_ultima_promocao asc ";


                    $dados = $this->Licenca->query($sql);

                    if(!empty($dados)){
                        foreach($dados as $dado){
                            $militars[$dado['Militar']['id']]=$dado['Militar']['nm_completo'].'-'.$dado['Posto']['sigla_posto'].' '.$dado['Quadro']['sigla_quadro'].' '.$dado['Especialidade']['nm_especialidade'];
                            echo "<option value='{$dado['Militar']['id']}'>{$militars[$dado['Militar']['id']]}</option>";
                        }
                    }

            //              echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes($mensagem).'", "atual":"'.addslashes($atual).'" }';

                    exit();
            }
	function externoatas() {
		$this->layout = 'ajax';
		$consulta[0] = '---';

		$sql = "select Ata.id, Ata.numero, Ata.data_reuniao
		FROM atas Ata where Ata.unidade_id = {$this->data['Licenca']['unidade_id']}
		Order by Ata.data_reuniao asc , Ata.numero asc ";
		$consulta = $this->Licenca->query($sql);
		
		echo "<option value=''>Selecione a ata</option>";
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Ata']['id']}'>{$conteudo['Ata']['numero']} - {$conteudo['Ata']['data_reuniao']} </option>";
		}
		
	
		exit();
		
	}
	
	function externoboletins() {
		$this->layout = 'ajax';
		$consulta[0] = '---';

		$sql = "select Boletiminterno.id, Boletiminterno.numero, Boletiminterno.data_publicacao
		FROM boletiminternos Boletiminterno where Boletiminterno.unidade_id = {$this->data['Licenca']['unidade_id']}
		Order by Boletiminterno.data_publicacao asc , Boletiminterno.numero asc ";
		$consulta = $this->Licenca->query($sql);
		
		echo "<option value=''>Selecione o boletim</option>";
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Boletiminterno']['id']}'>{$conteudo['Boletiminterno']['numero']} - {$conteudo['Boletiminterno']['data_publicacao']} </option>";
		}
		
	
		exit();
		
	}
	
}
?>