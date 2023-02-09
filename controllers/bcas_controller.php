<?php
class BcasController extends AppController {

	var $name = 'Bcas';
	var $helpers = array('Html', 'Form');
	var $paginate = array('limit' => 25,'order' => array('Bca.id' => 'desc'));

	function externoassinados($bca_id = null){
		$ok = 1;
		if(empty($militar_id)){
			$militar_id = 0;
		}

		
		$consultas = 'select * from bcasassinados inner join bcas on (bca_id=bcas.id and bca_id='.$bca_id.') left join militars on (militars.id=bcasassinados.militar_id) left join postos on (postos.id=militars.posto_id) left join setors on (militars.setor_id=setors.id) where DATEDIFF(NOW(),bcas.gerado)<90 order by bcas.gerado desc, bcasassinados.data desc, bcasassinados.data_visto desc, bcas.numero_bca asc limit 0,5';
		$resultados = $this->Bca->query($consultas);
		
		
		$contaAssinados = count($resultados);

		
		$mensagem = "<div style='align:center;border:2px solid #000000;padding: 0px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;'>STATUS ATUAL DOS BCAS</div>";
		$mensagem .= "<div style='padding: 0px;margin: 0px;overflow: auto; color: #000000;position: relative;height: 100px;background:#ffffff; opacity: 1;'>";

			$mensagem .= "<table cellpadding='0' cellspacing='0' width='100%' style='font-size:8px;'><tr style=\"background-color:#8080ff;\" ><th><b>Número BCA</b></th><th><b>Gerado</b></th><th><b>Data Acesso</b></th><th><b>Data Visto</b></th><th><b>Militar</b></th><th><b>Setor</b></th></tr>";


			$i = 0;
			
			$total = count($resultados);
			if(empty($resultados)){
				$total = 0;
			}
			foreach ($resultados as $resultado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;font-size:8px;"';
			}

		//	$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/accept.png"/>';
						//$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero']." ?\" ,\"javascript:excluiRegistro(".$resultado['lrotabela01s']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
			if(!empty($resultado['bcasassinados']['tipo_visto'])){
				$mensagem .= "	<tr ><td{$class}>".($resultado['bcas']['numero_bca'])."</td><td{$class}>".$resultado['bcas']['gerado']."</td><td{$class}>{$resultado['bcasassinados']['data']}</td><td{$class}>{$resultado['bcasassinados']['data_visto']}</td><td{$class}>".$resultado['postos']['sigla_posto'].' '.$resultado['militars']['nm_guerra']."</td><td{$class}>{$resultado['setors']['sigla_setor']}</td></tr>";
			}else{
				$class = " style=\"background-color:#f08080;\" ";
			$mensagem .= "	<tr><td {$class}>".($resultado['bcas']['numero_bca'])."</td><td{$class}>".$resultado['bcas']['gerado']."</td><td{$class}>{$resultado['bcasassinados']['data']}</td><td{$class}>{$resultado['bcasassinados']['data_visto']}</td><td{$class}>".$resultado['postos']['sigla_posto'].' '.$resultado['militars']['nm_guerra']."</td><td{$class}>{$resultado['setors']['sigla_setor']}</td></tr>";
			}
			endforeach;
			$mensagem.="</table>";
			$dados = $mensagem;
		
		
		$mensagem .= "</div>";
		$mensagem .= "<div style='align:center;border:2px solid #000000;padding: 0px;margin: 0px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;'></div>";

	    header('Content-type: application/x-json');
	    //$mensagem = encodeURIComponent($mensagem);
	    
		echo '{ "ok":"'.$ok.'", "mensagem":"'.(addslashes($mensagem)).'","total":"'.$total.'"}';
		exit();

	}
	
	function externodespacho(){
		$ok = 1;
		
		//print_r($this->data);
		foreach($this->data['Bcasassinado']['id'] as $bca_id){
			$vetor['Bcasassinado']['id'] = $bca_id;
			$vetor['Bcasassinado']['data_visto'] = date('Y-m-d H:i:s');
			$vetor['Bcasassinado']['tipo_visto'] = 'V';
			$this->Bca->Bcasassinado->save($vetor);
			
		}
		$militar_id = $this->data['Bca']['militar_id'];
		
		$consultas = 'select * from bcasassinados where data_visto is null and militar_id='.$militar_id.'  limit 2 ';
		$resultadosBcas = $this->Bca->query($consultas);
		
		
		$qtd = count($resultadosBcas);
		if(empty($qtd)){
			$qtd = 0;
		}
		
		
		
		//---------------------------------------
		//---------------------------------------
		$mensagem = "<form id='bcaForm' method='POST' action='' onsubmit='return false;'><div style='align:center;border:2px solid #000000;padding: 0px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;'>BCAS NÃO LIDOS - AGUARDANDO CONFIRMAÇÃO DE LEITURA</div>";
		$mensagem .= "<div style='padding: 0px;margin: 0px;overflow: auto; color: #000000;position: relative;height: 300px;background:#ffffff; opacity: 1;'>";

			$mensagem .= "<table cellpadding='0' cellspacing='0' width='700px' style=\"font-size:10px;align:center;\"><tr style=\"background-color:#8080ff;\" ><th  width='50px'><b>Número BCA</b></th><th  width='500px'><b>Extrato</b></th><th  width='50px'><b>Data Inclusão</b></th><th  width='100px'><b>Ações</b></th></tr>";
			$consultas = "select * from bcas inner join bcasassinados on (bcasassinados.bca_id=bcas.id and bcasassinados.militar_id=".$militar_id.' and data_visto is null)  limit 2';
		
			$resultados = $this->Bca->query($consultas);
			$mensagem .= '<input type="hidden" id="militar_id" name="data[Bca][militar_id]"  value="'.$militar_id.'" />';

			
			$i = 0;
			
			$total = count($resultados);
			//if(empty($resultados)){				$total = 0;			}
			foreach ($resultados as $resultado):
			$class = ' style="vertical-align:top;"';
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;vertical-align:top;"';
			}

			
        $ciente = '<input type="checkbox" name="data[Bcasassinado][id][]" id="'.$resultado['bcasassinados']['id'].'"  value="'.$resultado['bcasassinados']['id'].'" />';
			
			$ver = '';
			
			if(strlen($resultado['bcas']['arquivo'])>0){		
				$ver = '<a href="'.$this->webroot.'bcas/view/'.$resultado['bcas']['id'].'"><img border="0" title="Visualizar" alt="Exibir" src="'.$this->webroot.'img/lupa.gif"/></a>';
			}
			$acao= $ciente.$ver;			
						//$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero']." ?\" ,\"javascript:excluiRegistro(".$resultado['lrotabela01s']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

       $traduz = array("\n"=>' || ', "\r\n"=>' || ');
        //$foo = strtr(htmlentities($resultado['bcas']['extrato']),$traduz);
        $foo = $resultado['bcas']['extrato'];
        $mensagem .= "	<tr ><td{$class}>".($resultado['bcas']['numero_bca'])."</td><td{$class}><textarea rows=5 cols=55 >".$foo."'</textarea></td><td{$class} >{$resultado['bcasassinados']['data']}</td><td{$class} >{$acao}</td></tr>";
			endforeach;
			$mensagem.="</table>";
			$dados = $mensagem;
			
			/*
			
			$mensagem .= "	<tr ><td{$class}>".($resultado['bcas']['numero_bca'])."</td><td{$class}>".urlencode($resultado['bcas']['extrato'])."</td><td{$class}>{$resultado['bcasassinados']['data']}</td><td{$class}>{$acao}</td></tr>";
			endforeach;
			$mensagem.="</table>";
			$dados = $mensagem;
		*/
		
			
		$mensagem .= "</div>";
		$mensagem .= "<div style='align:center;border:2px solid #000000;padding: 0px;margin: 0px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;'><input type='submit' value='Estou ciente dos extratos BCA' class='formulario'  style='float:right;' onclick=\"despachaBCA('bcaForm');\"></div></form>";
		
	    header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.(rawurlencode(iconv('UTF-8','ISO-8859-1//IGNORE',$mensagem))).'","qtd":"'.$qtd.'"}';
		exit();

	}
	
	function externobca($militar_id = null){
		$ok = 1;
		if(empty($militar_id)){
			$militar_id = 0;
		}

		$consultas = 'select * from bcas ';
		$resultadosBcas = $this->Bca->query($consultas);
		
		$contabcas = count($resultadosBcas);
		
		$consultas = 'select * from bcasassinados where militar_id='.$militar_id.'  limit 2 ';
		$resultadoAssinados = $this->Bca->query($consultas);
		
		$contaAssinados = count($resultadoAssinados);

		
		$consultas = 'delete   from bcasassinados where bca_id not in (select id from bcas);';
		$this->Bca->query($consultas);
		
		
		
		if($contaAssinados<$contabcas){
		foreach($resultadosBcas as $insere){
			$insercao = 'insert ignore into bcasassinados (data, bca_id, militar_id) values(\''.date('Y-m-d H:i:s').'\','.$insere['bcas']['id'].','.$militar_id.');';
			$this->Bca->query($insercao);
		}
		
		
		}
		$mensagem = '<form id="bcaForm" method="POST" action="" onsubmit="return false;"><div style="align:center;border:2px solid #000000;padding: 0px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;">BCAS NÃO LIDOS - AGUARDANDO CONFIRMAÇÃO DE LEITURA</div>';
		$mensagem .= '<div style="padding: 0px;margin: 0px;overflow: auto; color: #000000;position: relative;height: 300px;background:#ffffff; opacity: 1;">';

			$mensagem .= '<table cellpadding="0" cellspacing="0" width="700px" style="font-size:10px;align:center;"><tr style="background-color:#8080ff;" ><th  width="50px"><b>Número BCA</b></th><th  width="500px"><b>Extrato</b></th><th  width="50px"><b>Data Inclusão</b></th><th  width="100px"><b>Ações</b></th></tr>';
			$consultas = "select * from bcas inner join bcasassinados on (bcasassinados.bca_id=bcas.id and bcasassinados.militar_id=".$militar_id.' and data_visto is null) limit 2';
			
		    //echo $consultas;

			$resultados = $this->Bca->query($consultas);
			$mensagem .= '<input type="hidden" id="militar_id" name="data[Bca][militar_id]"  value="'.$militar_id.'" />';

			$i = 0;
			
			//print_r($resultados);
			
			$total = count($resultados);
			if(empty($resultados)){
				$total = 0;
			}
			foreach ($resultados as $resultado):
			$class = ' style="vertical-align:top;"';
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;vertical-align:top;"';
			}

		//	$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/accept.png"/>';
			$ciente = '<input type="checkbox" name="data[Bcasassinado][id][]" id="'.$resultado['bcasassinados']['id'].'"  value="'.$resultado['bcasassinados']['id'].'" />';
			
			$ver = '';
			
			if(strlen($resultado['bcas']['arquivo'])>0){		
				$ver = '<a href="'.$this->webroot.'bcas/view/'.$resultado['bcas']['id'].'"><img border="0" title="Visualizar" alt="Exibir" src="'.$this->webroot.'img/lupa.gif"/></a>';
			}
			$acao= $ciente.$ver;

        $traduz = array("\n"=>' || ', "\r\n"=>' || ');
        //$foo = strtr(htmlentities(rawurlencode(iconv('UTF-8','ISO-8859-1',$resultado['bcas']['extrato'])),$traduz);
        $foo = $resultado['bcas']['extrato'];
        //$foo = $resultado['bcas']['extrato'];
        //  $foo = $resultado['bcas']['extrato'];
        
						//$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero']." ?\" ,\"javascript:excluiRegistro(".$resultado['lrotabela01s']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
		$mensagem .= '	<tr ><td'.$class.'>'.($resultado['bcas']['numero_bca']).'</td><td'.$class.'><textarea rows=5 cols=55 >'.$foo.'</textarea></td><td'.$class.' >'.$resultado['bcasassinados']['data'].'</td><td'.$class.' >'.$acao.'</td></tr>';
		endforeach;
		$mensagem.= '</table>';
		$dados = $mensagem;
		
		$mensagem .= '</div>';
		$mensagem .= '<div style="align:center;border:2px solid #000000;padding: 0px;margin: 0px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;"><input type="submit" value="Estou ciente dos extratos BCA" class="formulario"  style="float:right;" onclick="despachaBCA(\'bcaForm\');"></div></form>';
		
	    header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.(rawurlencode(iconv('UTF-8','ISO-8859-1//IGNORE',$mensagem))).'","total":"'.$total.'"}';
		exit();

	}
	
	function index() {
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(($this->cleanData['formFind']['find']) );
		$this->Bca->recursive = 1;
		
		if ( $findUrl != '' ) {
			$opcoes = " LOWER(`Bca`.`numero_bca`) LIKE '%" . $findUrl ."%'  OR LOWER(`Bca`.`extrato`) LIKE '%" . $findUrl ."%'  ";
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Bca->recursive = 1;
					$registros = $this->Bca->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$teste=$findUrl+0;
			$this->set('bcas', $this->paginate('Bca',array(" LOWER(`Bca`.`numero_bca`) LIKE '%" . $findUrl ."%'  OR LOWER(`Bca`.`extrato`) LIKE '%" . $findUrl ."%'  ")));
					
		} else {
			if(!empty($this->data['formFind']['paginas'])){
				if($this->data['formFind']['paginas']=='TODAS'){
					$this->Bca->recursive = 1;
					$registros = $this->Bca->find('all',$opcoes);
					$qtdPaginas = $this->data['formFind']['paginas'];
					$this->data['formFind']['paginas'] = count($registros);
				}
				$this->paginate['limit'] = $this->data['formFind']['paginas'];
			}
			$this->data['formFind']['paginas'] = $this->paginate['limit'];
			$this->set('bcas', $this->paginate());
															
			}
		
		
	}

	function externoindex() {
		$this->layout = 'adminexterno';
		uses('sanitize');
		$sanitize = new Sanitize();
		$this->set('findUrlNotCleaned',
		trim($this->data['formFind']['find']) );
		$this->cleanData = $sanitize->clean($this->data );
		$findUrl = low(($this->cleanData['formFind']['find']) );
		if ( $findUrl != '' ) {
			$this->Bca->recursive = 0;
			$teste=$findUrl+0;
			if($findUrl>0){
				$this->set('bcas', $this->paginate('Bca',array(" YEAR(`Bca`.`entrada_cindacta`)=" . $findUrl ." OR (`Bca`.`entrada_cindacta`)='" . $findUrl ."'  OR `Bca`.`parecer` LIKE '%" . $findUrl ."%' OR  LOWER(`Bca`.`oficio`) LIKE '%" . $findUrl ."%'  ")));
			}else{
				$this->set('bcas', $this->paginate('Bca',array(" LOWER(`Bca`.`oficio`) LIKE '%" . $findUrl ."%'  OR LOWER(`Bca`.`situacao`) LIKE '%" . $findUrl ."%'  OR LOWER(`Bca`.`parecer`) LIKE '%" . $findUrl ."%'")));
			}
		} else {
			$this->Bca->recursive = 0;
			$this->set('bcas', $this->paginate());
		}

	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  Bca.', true));
			$this->redirect(array('action'=>'index'));
		}
		$file = $this->Bca->findById($id);
		if(($file['Bca']['type']=='application/pdf')||($file['Bca']['type']=='application/save')){
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");;
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment;filename=bca".$file['Bca']['oficio'].'.pdf');
			echo stripslashes($file['Bca']['arquivo']);
					}else{
			header('Content-type: text/html');
			header('Content-Disposition: attachment; filename=bca'.$file['Bca']['oficio'].'.html');
			echo $file['Bca']['arquivo'];
		}
		exit();

	}

	function externoview($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Valor inválido para  BCA.', true));
			$this->redirect(array('action'=>'index'));
		}
		$file = $this->Bca->findById($id);
		if(($file['Bca']['type']=='application/pdf')||($file['Bca']['type']=='application/save')){
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");;
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment;filename=bca".$file['Bca']['oficio'].'.pdf');
			echo stripslashes($file['Parecerestecnico']['arquivo']);
		}else{
			header('Content-type: text/html');
			header('Content-Disposition: attachment; filename=bca'.$file['Bca']['oficio'].'.html');
			echo $file['Bca']['arquivo'];
		}
		exit();

		
	}
	function add() {
		$status=1;
		if (is_uploaded_file($this->data['Bca']['arquivos']['tmp_name'])){
			$conteudo = fread(fopen($this->data['Bca']['arquivos']['tmp_name'], "r"),	$this->data['Bca']['arquivos']['size']);
		}

		if (strlen($conteudo)>0) {
			$this->data['Bca']['type'] = $this->data['Bca']['arquivos']['type'];
			$this->data['Bca']['size'] = $this->data['Bca']['arquivos']['size'];
			
			if ((stripos($this->data['Bca']['arquivos']['type'],'application') !== false)||(stripos($this->data['Bca']['arquivos']['type'],'htm') !== false)||(stripos($this->data['Bca']['arquivos']['type'],'pdf') !== false)||(stripos($this->data['Bca']['arquivos']['type'],'application') !== false)){
				$this->data['Bca']['arquivo'] = addslashes($conteudo);

			}else {
				$status=0;
				$this->Session->setFlash(__('Somente arquivos do tipo html ou pdf. Por favor, tente novamente.', true));
					
			}

		}
		unset($this->data['Bca']['arquivos']);

		if (!empty($this->data)&&($status==1)) {
			$this->Bca->create();
			if ($this->Bca->save($this->data)) {
				$this->Session->setFlash(__('Os dados foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados não foram gravados. Por favor, tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		$status=1;
		if (is_uploaded_file($this->data['Bca']['arquivos']['tmp_name'])){
			$conteudo = fread(fopen($this->data['BCa']['arquivos']['tmp_name'], "r"),	$this->data['Bca']['arquivos']['size']);
		}

		if (strlen($conteudo)>0) {
		//	print_r($this->data['Parecerestecnico']['arquivos']);
		//	exit();
			$this->data['Bca']['type'] = $this->data['Bca']['arquivos']['type'];
			$this->data['Bca']['size'] = $this->data['Bca']['arquivos']['size'];
			$this->data['Bca']['id'] = $id;
			
			if ((stripos($this->data['Bca']['arquivos']['type'],'application') !== false)||(stripos($this->data['Bca']['arquivos']['type'],'htm') !== false)||(stripos($this->data['Bca']['arquivos']['type'],'pdf') !== false)||(stripos($this->data['Bca']['arquivos']['type'],'application') !== false)){
				$this->data['Bca']['arquivo'] = addslashes($conteudo);

			}else {
				$status=0;
				$this->Session->setFlash(__('Somente arquivos do tipo html ou pdf. Por favor, tente novamente.', true));
					
			}

		}
		unset($this->data['Bca']['arquivos']);
		/*
		 echo '<pre>';
		 print_r($this->data);
		 echo 'status='.$status;
		 echo '</pre>';
		 */

		if (!empty($this->data)&&($status==1)) {
			//$this->Bca->create();
			if ($this->Bca->save($this->data)) {
				$this->Session->setFlash(__('Os dados foram gravados.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Os dados não foram gravados. Por favor, tente novamente.', true));
			}
		}
		

		if (empty($this->data)) {
			$this->data = $this->Bca->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID inválido para BCA', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Bca->delete($id)) {
			$this->Session->setFlash(__('BCA excluído', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>