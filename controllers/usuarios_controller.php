<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';
	//var $helpers = array('Html', 'Form');
//	var $components = array('Captcha');
	var $paginate = array('limit'=>50);

	function beforeFilter() {
		if ($this->action != 'login' && $this->action != 'logout' ) {
			$this->checkAdmin();
		}
	}
/*        
        function externosecurimageaudio(){
            $this->layout = 'ajax_embutido'; //a blank layout
            if (!empty($_GET['namespace'])) $this->captcha->setNamespace($_GET['namespace']);

            $this->captcha->outputAudioFile();
            exit();
        }

	function securimage($id){

		//override variables set in the component - look in component for full list

		$this->captcha->image_height = 50;
		$this->captcha->image_width = 250;
		$this->captcha->image_bg_color = '#ffffff';
		$this->captcha->line_color = '#cccccc';
		$this->captcha->arc_line_colors = '#999999,#cccccc';
		$this->captcha->code_length = 5;
		$this->captcha->font_size = 30;
		$this->captcha->text_color = '#000000';
		$this->captcha->text_maximum_distance = 40;
		$this->captcha->text_minimum_distance = 30;
                $_SESSION['securimage_code_value']='';
		$this->set('id', $id); //dynamically creates an image
		//$this->set('captcha_data'.$id, $this->captcha->show()); //dynamically creates an image
                echo $this->captcha->show();
                exit();
	}
*/
	function logout() {
		//$this->Session->delete('Usuario');
		//$this->Session->delete('Privilegio');
		//echo "<br>".$this->Session->_userAgent;
		//unset($u);
		//unset($acesso);
		//$this->Usuario->query('delete from cake_sessions where data like "%'.$this->Session->_userAgent.'%"');
                $this->Session->destroy();
                if (!empty($this->data)) {
                    $this->Session->setFlash('Usuário realizou logout.');
                    unset($this->data);
                }
		$this->redirect('/usuarios/login',null,true);
	}


	function login() {
            	//Configure::write('debug', 2);
//		$this->Session->delete('Usuario');
//		$this->Session->delete('Privilegio');

		unset($u);
		unset($acesso); 
                if(empty($this->data)){
                    $this->data['Usuario']['senha']='';
                    $this->data['Usuario']['identidade']='';
                }
//		$this->set('captcha_form_url', $this->webroot.'usuarios/login'); //url for the form

//		$captcha_success_msg = 'The code you entered matched the captcha';
//		$captcha_error_msg = 'The code you entered does not match';

		$biblia="select * from biblias where versiculoinicio>0 order by rand() limit 0,1";
		$versiculo=$this->Usuario->query($biblia);
		
		$versiculos="select * from biblias where livroseq='{$versiculo[0]['biblias']['livroseq']}' and capitulo={$versiculo[0]['biblias']['capitulo']} and versiculo>={$versiculo[0]['biblias']['versiculoinicio']} and versiculo<={$versiculo[0]['biblias']['versiculofim']}";
		//echo $versiculos;
		$mensagem=$this->Usuario->query($versiculos);
                
		$this->set('mensagem',$mensagem);
		
		$this->set('avisos',$this->Usuario->query('select * from avisos Aviso order by updated desc, created desc'));
		//$this->set('manutencaos',$this->Usuario->query('select * from avisos Aviso where tipo like "%MANUTEN%" order by updated desc, created desc'));

		$this->layout = 'admin';
		
		if(empty($this->data['Usuario']['privilegio_id'])){
			$this->data['Usuario']['privilegio_id'] = 0;
		}
		//LEFT JOIN usuarios Usuario	on (Militar.id=Usuario.militar_id and Usuario.senha='{$this->data['Usuario']['senha']}' and Usuario.privilegio_id=2)
        //LEFT JOIN usuarios Usuario  on (Militar.id=Usuario.militar_id and Usuario.senha='{$this->data['Usuario']['senha']}' and Usuario.privilegio_id={$this->data['Usuario']['privilegio_id']})
//and Usuario.privilegio_id={$this->data['Usuario']['privilegio_id']}		
		$sql=<<<SQL
		select concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome, Usuario.militar_id, Usuario.privilegio_id, Usuario.id, Privilegio.acesso, Privilegio.inicio, Privilegio.descricao, Usuario.divisao,	Privilegio.id, Militar.saram, Militar.identidade FROM militars as Militar
		LEFT JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
                INNER JOIN usuarios Usuario  on (Militar.id=Usuario.militar_id and Usuario.senha=md5('{$this->data['Usuario']['senha']}') )
                LEFT JOIN setors_usuarios SetorsUsuario on (SetorsUsuario.usuario_id=Usuario.id)
		INNER JOIN privilegios Privilegio on (Privilegio.id=Usuario.privilegio_id )
		WHERE (Militar.identidade='{$this->data['Usuario']['identidade']}' or upper(Usuario.login)=upper('{$this->data['Usuario']['identidade']}')) and Militar.ativa>0 group by Militar.id limit 0,1
SQL;

//echo $sql.'<br><br>';
		$usuario=$this->Usuario->query($sql);
//var_dump($usuario);
                if($usuario){
                    $this->data['Usuario']['privilegio_id']=$usuario[0]['Usuario']['privilegio_id'];
                    $usuario[0]['Usuario']['saram']=$usuario[0]['Militar']['saram'];
                    $usuario[0]['Usuario']['identidade']=$usuario[0]['Militar']['identidade'];
                $sqlsetor=<<<SQLSETOR
select Setor.id from usuarios Usuario 
inner join militars Militar on (Militar.id=Usuario.militar_id and Militar.id='{$usuario[0]['Usuario']['militar_id']}')
left join setors_usuarios SetorsUsuario on (SetorsUsuario.usuario_id=Usuario.id) 
left join setors Setor on (Setor.id=SetorsUsuario.setor_id)
where Usuario.privilegio_id={$usuario[0]['Usuario']['privilegio_id']}   
SQLSETOR;
		$setor=$this->Usuario->query($sqlsetor);
                $setores = '\''.$setor[0]['Setor']['id'].'\', \'';
                foreach($setor as $chave=>$dado){
                    $setores .= $dado['Setor']['id'].'\', \'';
                }
                    $setores .= $dado['Setor']['id'].'\'';
                    
                $temp = $setores;
//                $usuario[0][0]['setores']='\''.str_replace(',', '\', \'',$temp).'\'';
                $usuario[0][0]['setores']=$setores;
                }

		//print_r($this->Usuario->query($sql));

		$this->set('usuario',$usuario);
		$this->Session->write('Usuario',$usuario);
//echo '<pre>'.print_r($usuario);exit();                

		//$this->set('error_captcha', ''); //error message displayed to user
		//$this->set('success_captcha', ''); //success message displayed to user
                
//		if( (!empty($usuario[0][0]['nome'])) && ($this->captcha->check($this->data['Usuario']['captcha_code'])) ) {
		if( (!empty($usuario[0][0]['nome'])) ) {
                //echo '<br><br>Check login<br><br>';
		
		if(!empty($usuario[0][0]['nome'])){
		
			//	tabelas Tabela INNER JOIN privilegios_tabelas PrivilegiosTabela on (PrivilegiosTabela.tabela_id=Tabela.id and PrivilegiosTabela.privilegio_id={$usuario[0]['Usuario']['privilegio_id']})";
			$sql="select Tabela.tabela, PrivilegiosTabela.dia_inicio, PrivilegiosTabela.dia_fim, PrivilegiosTabela.ver, PrivilegiosTabela.editar, PrivilegiosTabela.adicionar, PrivilegiosTabela.deletar from
			tabelas Tabela INNER JOIN privilegios_tabelas PrivilegiosTabela on (PrivilegiosTabela.tabela_id=Tabela.id and PrivilegiosTabela.privilegio_id='{$this->data['Usuario']['privilegio_id']}')";
//echo $sql;exit();
			$privilegio=$this->Usuario->query($sql);
			$this->set('privilegio',$privilegio);
                        
//			print_r($usuario);exit();
			$complementosql="select Privilegio.id, Privilegio.descricao from
			usuarios Usuario
			inner join privilegios_tabelas PrivilegiosTabela on (PrivilegiosTabela.privilegio_id=Usuario.privilegio_id)
			inner join privilegios Privilegio on (Privilegio.id=PrivilegiosTabela.privilegio_id)
			where Usuario.militar_id='{$usuario[0]['Usuario']['militar_id']}'
			group by Privilegio.id
			";


			$complemento=$this->Usuario->query($complementosql);

                        
			foreach($complemento as $chave=>$valor){
                            $usuario['ModificaPerfil'][$chave][$valor['Privilegio']['id']]=$valor['Privilegio']['descricao'];
			}
			
                        //$this->Session->write('Usuario',$usuario);
			//$this->Session->write('Privilegio',$privilegio);
			//echo '<pre>';print_r($usuario);exit();
	    
//----------------------------
//			$this->set('u',$usuario);
			$this->Session->write('Privilegio',$privilegio);
//-----------------------------
//			$this->Session->write('u',$u);
//print_r($usuario);exit();
			$bca = 0;
			
			if($this->data['Usuario']['privilegio_id']==12){
				//$bca=$this->Usuario->Bca->query('select * from bcas, bcasassinados where bcasassinados.bca_id=bcas.id and bcasassinados.militar_id='.$usuario[0]['Usuario']['militar_id']);
				$bca = 1;
			}
			//echo 'select * from bcas, bcasassinados where bcasassinados.bca_id=bcas.id and bcasassinados.militar_id='.$usuario[0]['Usuario']['militar_id'];
			$this->Session->write('Bca',$bca);
                        
                       
/*
                        //$this->loadModel('Assinatura');
                        $buscaassinatura = "select * from assinaturas Assinatura where militar_id='{$usuario[0]['Usuario']['militar_id']}'";
                        $resultadoassinatura = $this->Usuario->query($buscaassinatura);
                                
//                        print_r($resultadoassinatura);exit();
                        //$verificaassinatura=$this->Assinatura->findByMilitarId($usuario[0]['Usuario']['militar_id']);
                        $verificaassinatura=$resultadoassinatura[0]['Assinatura']['id'];
                        if(empty($verificaassinatura)){
                            $usuario[0]['Privilegio']['inicio']='assinaturas/add/'.$usuario[0]['Usuario']['militar_id'];
                        }
*/                        
                         
                        //print_r($u);exit();
//echo '/'.$usuario[0]['Privilegio']['inicio'];exit();
                        
			$this->set('usuario',$usuario);
			$this->Session->write('Usuario',$usuario);}
                	$this->redirect('/'.$usuario[0]['Privilegio']['inicio'],null,true);
//                	echo ('/'.$usuario[0]['Privilegio']['inicio']);
			//print_r($this->Session);//exit();

			//$this->set('sql',$sql);
		} else {
					           // print_r($_SESSION);
                        
		//	$oculta= "&nbsp;&nbsp;<a onclick=\"this.href='#';HideContent('flashMsg');return false;\" href=\"{$this->webroot}testeopprovas/externoedit\"><img border=\"0\" title=\"Oculta\" alt=\"Ocultar\" src=\"{$this->webroot}img/btsair.gif\"></a>";
//                        if ( (!empty($this->data['Usuario']['identidade'])) || (!empty($this->data['Usuario']['senha'])) || (!empty($this->data['Usuario']['captcha_code'])) ) {
                        if ( (!empty($this->data['Usuario']['identidade'])) || (!empty($this->data['Usuario']['senha']))  ) {
                            //$this->Usuario->query("delete from cake_sessions where data like '%{$usuario[0][0]['nome']}%'");
                            $this->Session->destroy();
                            $this->Session->setFlash('Os dados informados não foram reconhecidos. Por favor, tente novamente.'.$oculta);
                            unset($this->data);
                        }
		}
                        //    $this->redirect('/avisos',null,true);
//                $this->set('captcha',$this->captcha);

	}
	function index() {
		$this->layout = 'admin';

		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(trim($this->cleanData['formFind']['find']) );

		$u = $this->Session->read('Usuario');
		//print_r($u);
		$this->Usuario->recursive = 0;
		if(($u[0]['Privilegio']['acesso']==0)||($u[0]['Privilegio']['acesso']==3)){
			$this->set('usuarios', $this->paginate('Usuario',array("(LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' )")));
		}else{
			$this->redirect('/'.$u[0]['Privilegio']['inicio'],null,true);
		}
	}

	function view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Usuario.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('usuario', $this->Usuario->read(null, $id));
	}

	function add($id = null) {
        $u = $this->Session->read('Usuario');        
        $this->paginate['limit'] = 4000;
        
        //Configure::write(array('debug'=> 2));
        
		$this->data['Usuario']['email']='';  
	    $this->layout = 'admin';
		$this->Usuario->Setor->recursive = 0;
		$this->Usuario->unbindModel(array('hasAndBelongsToMany'=>array('Bca','Setor')));
		
		if(($u[0]['Privilegio']['acesso']==3)){
            $restringe=' and privilegios.id  in (5,6,12) ';
            $restringir=' and Usuario.privilegio_id  in (5,6,12)  ';
			$this->Usuario->Privilegio->recursive = 0;
            $privilegios = $this->Usuario->Privilegio->find('list', array('conditions'=>array(' Privilegio.id  in (5,6,12) ')));
       }else{
		if(($u[0]['Privilegio']['acesso']==11)){
            $restringe=' and privilegios.id  in (5,6) ';
            $restringir=' and Usuario.privilegio_id  in (5,6)  ';
			$this->Usuario->Privilegio->recursive = 0;
            $privilegios = $this->Usuario->Privilegio->find('list', array('conditions'=>array(' Privilegio.id  in (5,6) ')));
       }else{
       	if(($u[0]['Privilegio']['privilegio_id']==0)){
			$this->Usuario->Privilegio->recursive = 0;
       		$privilegios = $this->Usuario->Privilegio->find('list');
       	}
       }
       }
       
       if(!empty($id)){
          $temID=$id;
         $this->set(compact('temID'));
       }
        
       if(($u[0]['Privilegio']['acesso']==3)||($u[0]['Privilegio']['acesso']==11)){
       	 
		$observacoes = "select privilegios.descricao, usuarios.privilegio_id, group_concat(unidades.sigla_unidade, '->', setors.sigla_setor  SEPARATOR ' | ') setores,militar_id from usuarios
left join setors_usuarios on (setors_usuarios.usuario_id=usuarios.id and setors_usuarios.setor_id in ({$u[0][0]['setores']}))
inner join setors on (setors.id=setors_usuarios.setor_id  )
inner join privilegios on (privilegios.id=usuarios.privilegio_id $restringe)
left join unidades on (unidades.id=setors.unidade_id)
group by usuarios.id, usuarios.privilegio_id
having length(setores)>3		";
       }else{
       	$observacoes = "select privilegios.descricao, usuarios.privilegio_id, group_concat(unidades.sigla_unidade, '->', setors.sigla_setor  SEPARATOR ' | ') setores,militar_id from usuarios
       	left join setors_usuarios on (setors_usuarios.usuario_id=usuarios.id)
       	left join setors on (setors.id=setors_usuarios.setor_id)
       	inner join privilegios on (privilegios.id=usuarios.privilegio_id $restringe)
       	left join unidades on (unidades.id=setors.unidade_id)
       	group by usuarios.id, usuarios.privilegio_id";
       	
       	
       }
       
       //echo '<br><br>'.$observacoes;
		$dicas = $this->Usuario->query($observacoes);
		$this->set('dicas', $dicas);
		
		
		$setores = $u[0][0]['setores'];
		//where Setor.setor_valido="S"
		if(($u[0]['Privilegio']['acesso']==0)){
			$consultasetores = 'select Setor.id, concat(Unidade.sigla_unidade," - ", Setor.sigla_Setor) Setor, Escala.tipo from setors Setor 
	                    left join unidades Unidade on (Setor.unidade_id=Unidade.id)
	                    left join escalas Escala on (Escala.setor_id=Setor.id)
	                    order by Escala.tipo asc,Unidade.sigla_unidade asc, Setor.sigla_setor asc';
		}else{
			$consultasetores = 'select Setor.id, concat(Unidade.sigla_unidade," - ", Setor.sigla_Setor) Setor, Escala.tipo from setors Setor
                    left join unidades Unidade on (Setor.unidade_id=Unidade.id)
                    left join escalas Escala on (Escala.setor_id=Setor.id)
					where Setor.id in ('.$setores.')
					order by Escala.tipo asc,Unidade.sigla_unidade asc, Setor.sigla_setor asc';
				
		}
      // echo '<br><br>'.$consultasetores;
		
		$rsetores = $this->Usuario->Setor->query($consultasetores);
		foreach($rsetores as $rsetor){
			$setors[$rsetor['Setor']['id']] = $rsetor[0]['Setor']; 
		}
	//	$setors = $this->Usuario->Setor->find('list');
	//print_r($setors);
		$sql1 = "select concat( Militar.nm_completo,' - ', Posto.sigla_posto,' ',Quadro.sigla_quadro,' ',Especialidade.nm_especialidade) as nome, Militar.id, Militar.saram   FROM militars as Militar inner JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) left JOIN quadros as Quadro ON (Quadro.id=Especialidade.quadro_id) WHERE Posto.antiguidade<=122   order by  Militar.nm_completo asc";
		
		$sql1 = "select  Militar.id  , concat( Militar.nm_completo,' - ', Posto.sigla_posto)  as 'Militar.nm_completo', Militar.saram, Militar.identidade, Militar.email 
 FROM militars as Militar inner JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Militar.nm_completo asc";
/*
		$sql1 = "select  Militar.id  , concat( Posto.sigla_posto,' ', Militar.nm_completo)  as 'Militar.nm_completo'
 FROM militars as Militar inner JOIN postos as Posto ON(Posto.id = Militar.posto_id) 
LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
order by Posto.antiguidade,Militar.nm_completo asc";
	*/	
		$militares = $this->Usuario->query($sql1);
		$militars[]='';


      // if(!empty($id)){
			foreach($militares as $milico){
				$militars[$milico['Militar']['id']]=$milico[0]['Militar.nm_completo'];
			}
		//}
		//		print_r($militars);

		//$privilegios = $this->Usuario->Privilegio->find('list');
		$this->data['Usuario']['email']='';  

		if (empty($this->data['Usuario']['confirma_senha']) && !$id){
			uses('sanitize');
			$sanitize = new Sanitize();
			$this->set('findUrlNotCleaned',trim($this->data['formFind']['find']) );
			$this->cleanData = $sanitize->clean($this->data );
			$findUrl = low(trim($this->cleanData['formFind']['find']) );
			if ( $findUrl != '' ) {
				$this->Usuario->recursive = 0;
				$this->set('usuarios', $this->paginate('Usuario',array(" (LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' OR LOWER(`Militar`.`identidade`) LIKE '%" . $findUrl ."%' OR LOWER(`Privilegio`.`descricao`) LIKE '%" . $findUrl ."%') $restringir")));
				// OR LOWER(`Setor`.`sigla_setor`) LIKE '%" . $findUrl ."%'
				//echo "LOWER(`Militar`.`nm_completo`) LIKE '%" . $findUrl ."%' OR LOWER(`Militar`.`identidade`) LIKE '%" . $findUrl ."%' OR LOWER(`Privilegio`.`descricao`) LIKE '%" . $findUrl ."%'";
				$this->set(compact( 'setors', 'militars', 'privilegios','usuarios'));
				$this->render('add');
			} else {
				$this->Usuario->recursive = 0;
				$this->set('usuarios', $this->paginate('Usuario',array(" 1=1 $restringir ")));
				$this->set(compact( 'setors', 'militars', 'privilegios','usuarios'));
				//print_r($usuarios);
				$this->render('add');
			}

		}else{
		   if (!empty($this->data)) {
				//$this->data['Usuario']['senha']=md5($this->data['Usuario']['senha']);
				$this->Usuario->recursive = 1;
				$this->Usuario->create();
				if ($this->data['Usuario']['confirma_senha']==$this->data['Usuario']['senha']){
                   $this->data['Usuario']['senha']=md5($this->data['Usuario']['senha']);
				}else{
					unset($this->data['Usuario']['senha']);
				}
				if ($this->Usuario->save($this->data)) {
					$this->Session->setFlash(__('Os dados de  Usuario foram gravados.', true));
				} else {
					$this->Session->setFlash(__('Os dados de Usuario não foram gravados. Por favor, tente novamente.', true));
				}
				$this->data = null;
			}

			if ($id) {
				$this->data = $this->Usuario->read(null, $id);
			}
		
		
		$dicas = $this->Usuario->query($observacoes);
		$this->set('dicas', $dicas);
		
		
		
        //$this->set('usuarios', $this->paginate('Usuario',array('conditions'=>array(" 1=1  $restringir "))));
       	if(($u[0]['Privilegio']['privilegio_id']!=0)){
			$this->Usuario->recursive = 0;
       		$this->set('usuarios', $this->paginate('Usuario',array(" 1=1 $restringir ")));
       	}else{
			$this->Usuario->recursive = 0;
       		//print_r($usuarios);
			$this->set('usuarios', $this->paginate('Usuario',array(" 1=1 $restringir ")));
       	}
		//$this->set('usuarios', $this->paginate());
        $this->set(compact( 'setors', 'militars', 'privilegios','usuarios'));
        //print_r($setors);
//exit();
		$this->render('add');
		}
	}

	function trocasenha($id = null) {
		$u = $this->Session->read('Usuario');
		$this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Valor inválido para Usuario', true));
			$this->redirect(array('action'=>'fim'));
		}
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->cleanData = $sanitize->clean($this->data );
		$v1 = trim($this->cleanData['Usuario']['senha']) ;
		$v2 = trim($this->cleanData['Usuario']['confirma_senha']) ;
			
		if (!empty($this->data)&&($v1==$v2)&&(strlen($v1)>3)) {
			if($u[0]['Usuario']['id']==$id){
                                $this->data['Usuario']['senha']=md5($this->data['Usuario']['senha']);
				if ($this->Usuario->save($this->data)) {
					$this->Session->setFlash(__('Os dados de Usuario foram gravados.', true));
					$this->render('edit');
					//$this->redirect(array('action'=>'fim'));
				} else {
					$this->Session->setFlash(__('Os dados de Usuario não foram gravados. Por favor, tente novamente.', true));
					$this->render('edit');
				}
			}else{
				$this->Session->setFlash(__('Tentativa de burlar o sistema. Modifique apenas os seus dados!', true));
				$this->render('edit');
			}
		}else{
			if (($v1!=$v2)&&((strlen($v1)>3)||(strlen($v2)>3))) {
				$this->Session->setFlash(__('A senha não foi modificada. Verifique se os campos possuem a mesma senha.', true));
				$this->render('edit');
			}
			if (($v1==$v2)&&((strlen(trim($v1))==0))&&(!empty($this->data))) {
				//$this->Session->setFlash(__('A senha não foi modificada. Campos em branco.', true));
				$this->render('edit');
			}
			
				
		}

		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
	}
	
	function edit($id = null) {
		$u = $this->Session->read('Usuario');
		//print_r($u);
		$this->layout = 'admin';
		if (empty($u[0]['Usuario']['id']) && empty($this->data)) {
			$this->Session->setFlash(__('Valor inválido para Usuario', true));
			$this->redirect(array('action'=>'fim'));
		}
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->cleanData = $sanitize->clean($this->data );
		$v1 = trim($this->cleanData['Usuario']['senha']) ;
		$v2 = trim($this->cleanData['Usuario']['confirma_senha']) ;
		$this->data['Usuario']['updated'] = date('Y-m-d h:i:s');
		//print_r($this->data);
		if (!empty($this->data)&&($v1==$v2)&&(strlen($v1)>3)) {
			if(!empty($u[0]['Usuario']['id'])){
				$this->data['Usuario']['id']=$u[0]['Usuario']['id'];
//				print_r($this->data);
	//			echo $u[0]['Usuario']['id'];
		//		exit();
				//unset($this->data['Usuario']['confirma_senha']);
                                $this->data['Usuario']['senha']=md5($this->data['Usuario']['senha']);
                            
				if ($this->Usuario->save($this->data)) {
					$this->Session->setFlash('Os dados de Usuario foram gravados. Acesse normalmente as opções do menu.');
					$this->data = $this->Usuario->read(null,$u[0]['Usuario']['id']);
					$this->render('edit');
					//$this->redirect(array('action'=>'fim'));
				}else{
					$this->Session->setFlash('Os dados de Usuario não foram gravados. Por favor, tente novamente.');
					$this->data = $this->Usuario->read(null,$u[0]['Usuario']['id']);
					$this->render('edit');
				}
			}else{
				$this->Session->setFlash('Tentativa de burlar o sistema. Modifique apenas os seus dados!');
				$this->data = $this->Usuario->read(null,$u[0]['Usuario']['id']);
				$this->render('edit');
			}
		}else{
			if (($v1!=$v2)&&((strlen($v1)>3)||(strlen($v2)>3))) {
				$this->Session->setFlash('A senha não foi modificada. Verifique se os campos possuem a mesma senha.');
				$this->data = $this->Usuario->read(null,$u[0]['Usuario']['id']);
				$this->render('edit');
			}
			/*
			if (($v1==$v2)&&((strlen(trim($v1))==0))&&(!empty($this->data))) {
				$this->data = $this->Usuario->read(null,$id);
				$this->Session->setFlash(__('A senha não foi modificada. Campos em branco.', true));
				$this->render('edit');
			}
			*/
				
		}

		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null,$u[0]['Usuario']['id']);
			//print_r($this->data);
			$this->set(compact('id',$u[0]['Usuario']['id']));
		}
		
	}

	function delete($id = null) {
		//----------------------------------------------------------------
		$ip = $_SERVER['REMOTE_ADDR'];
		$u = $this->Session->read('Usuario');
		$usuario = $u[0][0]['nome'];
		$consultamilitar = 'select Posto.sigla_posto, Quadro.sigla_quadro, Especialidade.nm_especialidade,
		Militar.nm_completo, Militar.id,  Privilegio.descricao, group_concat(Setor.sigla_setor) as setores from militars Militar
		left join postos Posto on (Posto.id=Militar.posto_id)
		left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
		left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
		inner join usuarios Usuario on (Usuario.militar_id=Militar.id and Usuario.id="'.$id.'")
		inner join privilegios Privilegio on (Privilegio.id=Usuario.privilegio_id)
		inner join setors_usuarios SetorUsuario on (SetorUsuario.usuario_id=Usuario.id)
		inner join setors Setor on (Setor.id=SetorUsuario.setor_id)	
		group by Usuario.id
			';
		$result=$this->Usuario->query($consultamilitar);
		$militar = $result[0]['Posto']['sigla_posto'].' '.$result[0]['Quadro']['sigla_quadro'].' '.$result[0]['Especialidade']['nm_especialidade'].' '.$result[0]['Militar']['nm_completo'];
		$militarid = $result[0]['Militar']['id'];
		$setores = $result[0][0]['setores'];
		$perfil = $result[0]['Privilegio']['descricao'];
		
		$mudanca = 'Excluído o Usuário->'.$militar.' perfil:'.$perfil.' '.$setores.' no dia:'.date('d-m-Y h:i');
		$monitora = 'insert into logs (title, created, model, action, usuario_nome, ip, changes) values ("Excluir usuarios",now(),"USUARIOS", "Delete","'.$usuario.'", "'.$ip.'", "'.$mudanca.'")';
		
		$this->Usuario->query($monitora);

		//------------------------------------------------------------------------------------------------------------
		
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para Usuario', true));
			$this->redirect(array('action'=>'add'));
		}
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(__('Usuario excluído', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function update() {
		$this->layout = 'ajax_embutido';
   		if(!empty($this->data['Usuario']['identidade'])) {
			$sql1 = "select Privilegio.id, Privilegio.descricao from usuarios Usuario
			inner join militars Militar on (Militar.id=Usuario.militar_id) 
			inner join privilegios Privilegio on (Usuario.privilegio_id=Privilegio.id)
            where (Militar.identidade='{$this->data['Usuario']['identidade']}' or upper(Usuario.login)=upper('{$this->data['Usuario']['identidade']}') and Militar.ativa='1')
			";
			//echo $sql1;
			$militars = $this->Usuario->query($sql1);
			//Configure::write(array('debug'=> 2));
					
			//print_r($militars);
				
			foreach($militars as $milico){
				$vetor[]=$milico['Privilegio']['id'];
				$vetor2[]=$milico['Privilegio']['descricao'];
			}
			$militares=array_combine($vetor,$vetor2);
			
 			$this->set('options',$militares);
 		}
		
	}
	
	
	function loginMuda() {
		
		$this->Session->delete('Usuario');
		$this->Session->delete('Privilegio');

		$this->layout = 'admin';
		
			$sql=<<<SQL
		select concat( Posto.sigla_posto,' ', Militar.nm_completo) as nome, Usuario.militar_id, Usuario.privilegio_id, Usuario.id, Privilegio.acesso, Privilegio.inicio, Privilegio.descricao, Usuario.divisao, Militar.saram, Militar.identidade FROM militars as Militar
		inner JOIN postos as Posto ON(Posto.id = Militar.posto_id)
		LEFT JOIN especialidades as Especialidade on (Especialidade.id=Militar.especialidade_id) 
		INNER JOIN usuarios Usuario	on (Militar.id=Usuario.militar_id and Usuario.privilegio_id={$this->data['Usuario']['privilegio_id']} 
                    and Usuario.militar_id='{$this->data['Usuario']['militar_id']}' and  Militar.ativa>0)
		INNER JOIN privilegios Privilegio on (Privilegio.id=Usuario.privilegio_id )
                group by Militar.id
SQL;

		$usuario=$this->Usuario->query($sql);
                    
		$sqlsetor=<<<SQLSETOR
select Setor.id from usuarios Usuario 
inner join militars Militar on (Militar.id=Usuario.militar_id and Militar.id='{$this->data['Usuario']['militar_id']}')
left join setors_usuarios SetorsUsuario on (SetorsUsuario.usuario_id=Usuario.id) 
left join setors Setor on (Setor.id=SetorsUsuario.setor_id)
where Usuario.privilegio_id={$this->data['Usuario']['privilegio_id']}   
SQLSETOR;
                
		$setor=$this->Usuario->query($sqlsetor);
                 $setores = '\''.$setor[0]['Setor']['id'].'\', \'';
                foreach($setor as $chave=>$dado){
                    $setores .= $dado['Setor']['id'].'\', \'';
                }
                    $setores .= $dado['Setor']['id'].'\'';
                    
                $temp = $setores;
//                $usuario[0][0]['setores']='\''.str_replace(',', '\', \'',$temp).'\'';
                $usuario[0][0]['setores']=$setores;

		$usuario[0]['Usuario']['saram']=$usuario[0]['Militar']['saram'];
		$usuario[0]['Usuario']['identidade']=$usuario[0]['Militar']['identidade'];

		
		
		$this->set('usuario',$usuario);

		
			$sql="select Tabela.tabela, PrivilegiosTabela.dia_inicio, PrivilegiosTabela.dia_fim, PrivilegiosTabela.ver, PrivilegiosTabela.editar, PrivilegiosTabela.adicionar, PrivilegiosTabela.deletar from
			tabelas Tabela INNER JOIN privilegios_tabelas PrivilegiosTabela on (PrivilegiosTabela.tabela_id=Tabela.id and PrivilegiosTabela.privilegio_id={$this->data['Usuario']['privilegio_id']})";
			$privilegio=$this->Usuario->query($sql);
			$this->set('privilegio',$privilegio);

			
			$complementosql="select Privilegio.id, Privilegio.descricao from
			usuarios Usuario
			inner join privilegios_tabelas PrivilegiosTabela on (PrivilegiosTabela.privilegio_id=Usuario.privilegio_id)
			inner join privilegios Privilegio on (Privilegio.id=PrivilegiosTabela.privilegio_id)
			where Usuario.militar_id='{$usuario[0]['Usuario']['militar_id']}'
			group by Privilegio.id
			";
			
			$complemento=$this->Usuario->query($complementosql);
			
			foreach($complemento as $chave=>$valor){
					$usuario['ModificaPerfil'][$chave][$valor['Privilegio']['id']]=$valor['Privilegio']['descricao'];
			}
			
			$this->Session->write('Usuario',$usuario);
			$this->Session->write('Privilegio',$privilegio);
			$bca = 0;
			
			if($this->data['Usuario']['privilegio_id']==12){
				$bca = 1;
			}
			$this->Session->write('Bca',$bca);
			
			$this->redirect('/'.$usuario[0]['Privilegio']['inicio'],null,true);

	}
	function externoconsultanomes(){
		$nome = $this->params['form']['nome'];
		//Configure::write(array('debug'=> 2));
		$this->layout = null;
		if(!empty($nome)){
			$sql = "select * from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			where Militar.nm_completo like '%$nome%' and Militar.ativa='1' order by Militar.nm_completo asc
			";
			$resultados = $this->Usuario->query($sql);
			foreach($resultados as $dado){
				$nomes[$dado['Militar']['id']] = str_pad($dado['Militar']['nm_completo'],50,'_').$dado['Posto']['sigla_posto'].' '.$dado['Especialidade']['nm_especialidade'];

			}
			//print_r($nomes);
			$this->set(compact('nomes'));
		}
	}
	function externoconsultasaram(){
		$nome = $this->data['Usuario']['militar_id'];
		$saram = '';
		//Configure::write(array('debug'=> 2));
		$this->layout = null;
		header('Content-type: application/x-json');
		if(!empty($nome)){
			$sql = "select * from militars Militar 
			where Militar.id = '$nome';
			";
			$resultados = $this->Usuario->query($sql);
			$saram=$resultados[0]['Militar']['saram'];
			$rg=$resultados[0]['Militar']['identidade'];
			
		}
		//echo '{ "saram":"'.$saram.'"}';
		echo '{ "saram":"'.$saram.'", "identidade":"'.$rg.'"}';       
 		exit();
	}
	
}
?>