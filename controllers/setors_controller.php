<?php
class SetorsController extends AppController {

	var $name = 'Setors';

	function index() {
	/*
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']));
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']));
	*/	
            //Configure::write(array('debug'=> 2));
		$findUrl = decodeURIComponent($this->data['formFind']['find']);
		$findUrl = str_replace('||','%',$findUrl);
		
		
		$opcoes = $findUrl;
		
		$esquema = $this->Setor->_schema;
		
		$this->set('esquema',$esquema);
		
		//$opcoes = "LOWER(`Setor`.``) LIKE '%" . $findUrl ."%' OR LOWER(`Setor`.``) LIKE '%" . $findUrl ."%' ";
                $setores = $this->Setor->query('select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id from unidades Unidade, setors Setor where Setor.unidade_id=Unidade.id and (Setor.tipo="DIVISAO" or Setor.tipo="SUBDIVISAO" or Setor.tipo="COMANDO" )');
                foreach($setores as $registro){
                    $rotulos[$registro['Setor']['id']]=$registro['Unidade']['sigla_unidade'].'-'.$registro['Setor']['sigla_setor'];
                }
                $this->set( 'rotulos' , $rotulos);
		

		
		if ( $findUrl != '' ) {
			$this->paginate['limit'] = $this->data['formFind']['paginas'];
			$this->Setor->recursive = 1;
			//$this->Setor->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('setors', $this->paginate('Setor',array($opcoes)));

		} else {
			if(!empty($this->data['formFind']['paginas'])){
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->Setor->recursive = 1;
			//$this->Setor->Militar->unbindModel(array('belongsTo'=>array('Unidade','Quadro'),'hasOne'=>array('Foto','Assinatura'),'hasMany'=>array('Atividade','Exame','Afastamento','Habilitacao','Paeatsindicado'),'hasAndBelongsToMany'=>array('Curso','Escala')),false);
			$this->set('setors', $this->paginate());
			}
                        
	}


	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela setor não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('setor', $this->Setor->read(null, $id));
	}

	function add() {
    echo '<br><br><br><br>';print_r($this->data);
		if (isset($this->data)) {
			$this->Setor->create();
			if ($this->Setor->save($this->data)) {
			
				$ip = $_SERVER['REMOTE_ADDR'];
				$u = $this->Session->read('Usuario');
				$usuario = $u[0][0]['nome'];

				foreach($this->data['Setor'] as $chave=>$valor){
					$mudanca .= '['.$chave.']='.$valor.' ,';
				}
				$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Cadastro em Setor",now(),"Setor", "Add","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
				$this->Setor->query($monitora);
			
				$this->Session->setFlash(__('Os dados para a tabela setor foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela setor não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		$unidades = $this->Setor->Unidade->find('list');
                $setores = $this->Setor->query('select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id from unidades Unidade, setors Setor where Setor.unidade_id=Unidade.id and (Setor.tipo="DIVISAO" or Setor.tipo="SUBDIVISAO" or Setor.tipo="COMANDO" )');
                foreach($setores as $registro){
                    $setors[$registro['Setor']['id']]=$registro['Unidade']['sigla_unidade'].'-'.$registro['Setor']['sigla_setor'];
                }
                $this->set( 'setors' , $setors);
                
                $this->set(compact('unidades'));
                
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Registro da tabela setor não encontrado.', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from setors Setor where Setor.id='.$id;
		$dadoslog=$this->Setor->query($consultalog);
		$mudanca = "Antes:";
		foreach($dadoslog[0]['Setor'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$mudanca .= "Depois:";
		foreach($this->data['Setor'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Modificação em Setor",now(),"Setor", "Edit","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Setor->query($monitora);
		
		
		
			if ($this->Setor->save($this->data)) {
				$this->Session->setFlash(__('Os dados para a tabela setor foram armazenados.', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Os dados para a tabela setor não foram armazenados. Corrija os dados e tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Setor->read(null, $id);
		}
                $setores = $this->Setor->query('select Unidade.sigla_unidade, Setor.sigla_setor, Setor.id from unidades Unidade, setors Setor where Setor.unidade_id=Unidade.id and (Setor.tipo="DIVISAO" or Setor.tipo="SUBDIVISAO" or Setor.tipo="COMANDO" )');
                foreach($setores as $registro){
                    $setors[$registro['Setor']['id']]=$registro['Unidade']['sigla_unidade'].'-'.$registro['Setor']['sigla_setor'];
                }
                $this->set( 'setors' , $setors);
		$unidades = $this->Setor->Unidade->find('list');
		$this->set(compact('unidades'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Registro da tabela setor não encontrado.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];

		$consultalog = 'select * from setors Setor where Setor.id='.$id;
		$dadoslog=$this->Setor->query($consultalog);
		foreach($dadoslog[0]['Setor'] as $chave=>$valor){
			$mudanca .= '['.$chave.']='.$valor.' ,';
		}
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Exclusão de Setor",now(),"Setor", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		$this->Setor->query($monitora);
		
		
		
		
		
		if ($this->Setor->delete($id)) {
			$this->Session->setFlash(__('Registro da tabela Setor excluído.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Registro da tabela Setor não foi excluído.', true));
		$this->redirect(array('action' => 'index'));
	}

	function indexExcel($consulta = null)
	{

		$this->layout = null;
		$this->Setor->recursive = null;
		$filtro = decodeURIComponent($this->data['formFind']['find']);
		$filtro = str_replace('||','%',$filtro);
		$filtro = str_replace(']]]','/',$filtro);
		if(empty($this->data['formFind']['find'])){
			$filtro = ' 1=1 ';
		}
		$conteudo = $this->Setor->query('select * from setors Setor where '.$filtro);
		$campos_busca = $this->Setor->_schema;
		$i=0;
		foreach($campos_busca as $campo=>$valor){
			$campos[$i] = $campo;
			$tipos[$i] = $valor['type'];
			$i ++;
		}
		$titulo = 'Dados de Setor';
		$tabela = 'Setor';
		$nome = 'planilha_Setor';
		$this->set(compact('titulo','tabela','conteudo','campos','nome', 'tipos'));
		$this->render();
	}

	function externosetores($UnidadeID) {
		$this->layout = 'ajax';
		$consulta[0] = '---';
		$sql = "select Setor.sigla_setor, Setor.id
		FROM setors as Setor
		inner join unidades on (unidades.id=Setor.unidade_id and unidades.id={$UnidadeID})
		where Setor.id not in (select setor_id from escalas)
		order by  Setor.sigla_setor asc ";
		$consulta = $this->Setor->query($sql);
		foreach($consulta as $conteudo){
			echo "<option value='{$conteudo['Setor']['id']}'>{$conteudo['Setor']['sigla_setor']}</option>";
		}
		exit();
	}
function externoconsultaajax() {
        $this->layout = null;
        $this->Setor->recursive = 0;
       header('Content-type: application/x-json');
//        where Militar.saram='{$_POST['saram']}'

        $sql = "select *
        FROM setors as Setor 
        inner join unidades Unidade on Unidade.id=Setor.unidade_id ";

        $dados = $this->Setor->query($sql);
        
        echo json_encode($dados);
        
        

        exit();
}
        
	
}
?>