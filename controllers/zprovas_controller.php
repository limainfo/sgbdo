<?php
class ZprovasController extends AppController {

	var $name = 'Zprovas';

	function index() {
		$this->Zprova->recursive = 0;
		$this->set('zprovas', $this->paginate());
	}

	function view() {
		$this->layout = 'csv';
		if(empty($this->data['Zprova']['dataprova'])){
			$nomeprova = $this->data['Zprova']['nomeprova'];
		}else{
			$nomeprova = $this->data['Zprova']['nomeprova'].' '.$this->data['Zprova']['dataprova'];
		}
		$sql1 = "select  * 	FROM zprovas as Zprova where concat(Zprova.nomeprova,' ',DATE_FORMAT(Zprova.dataprova,'%Y-%m-%d'))='$nomeprova' order by  Zprova.indice asc";
		//echo $sql1;
		$consulta = $this->Zprova->query($sql1);
		$indice = null;
		$total = 0;
		$acertos = 0;
		$erros = 0;
		$naomarcadas = 0;
		//print_r($this->data);
		
		foreach ($consulta as $dados){
			$total++;
			if(($dados['Zprova']['respostamarcada']==$dados['Zprova']['resposta'])&&($dados['Zprova']['respostamarcada']!='')){
				$acertos++;
				$listaquestoes[$dados['Zprova']['indice']]='ok';
			}else{
				if(($dados['Zprova']['respostamarcada']!='')){
				$erros++;
				$listaquestoes[$dados['Zprova']['indice']]='erro';
				}
			}
			if($dados['Zprova']['respostamarcada']==''){
				$naomarcadas++;
				$listaquestoes[$dados['Zprova']['indice']]='vazio';
			}
		}
		if(empty($this->data['Zprova']['proximoindice'])){
			$indice = $consulta[0]['Zprova']['indice'];
		}else{
			$indice = $this->data['Zprova']['proximoindice'];
		}

		$this->set('listaquestoes',$listaquestoes);
		$sql1 = "select  * 	FROM zprovas as Zprova where concat(Zprova.nomeprova,' ',DATE_FORMAT(Zprova.dataprova,'%Y-%m-%d'))='$nomeprova' and Zprova.indice=$indice";
		//echo $sql1;
		$consulta = $this->Zprova->query($sql1);
		$this->data['Zprova']['acertos']=$acertos;
		$this->data['Zprova']['erros']=$erros;
		$this->data['Zprova']['naomarcadas']=$naomarcadas;
		$this->data['Zprova']['total']=$total;
		$this->data['Zprova']['id']=$consulta[0]['Zprova']['id'];
		$this->data['Zprova']['indice']=$consulta[0]['Zprova']['indice'];
		$this->data['Zprova']['proximoindice']=$indice;
		$this->data['Zprova']['nomeprova']=$consulta[0]['Zprova']['nomeprova'];
		$this->data['Zprova']['nome_prova']=$consulta[0]['Zprova']['nomeprova'];
		$this->data['Zprova']['dataprova']=$consulta[0]['Zprova']['dataprova'];
		$this->data['Zprova']['regulamento']=$consulta[0]['Zprova']['regulamento'];
		$this->data['Zprova']['referencia']=$consulta[0]['Zprova']['referencia'];
		$this->data['Zprova']['item']=$consulta[0]['Zprova']['item'];
		$this->data['Zprova']['tentativas']=$consulta[0]['Zprova']['tentativas'];
		$this->data['Zprova']['zfoto_id']=$consulta[0]['Zprova']['zfoto_id'];
		$this->data['Zprova']['resposta']=$consulta[0]['Zprova']['resposta'];
		$this->data['Zprova']['respostamarcada']=$consulta[0]['Zprova']['respostamarcada'];
		
		
		//print_r($this->data);
		
		$this->set('zprova', $this->Zprova->read(null, $id));
	}

	function externomarca($resposta=null) {
		$u=$this->Session->read('Usuario');
		$this->layout = 'ajax';
		$ok = 1;
//		$mensagem=print_r($this->data['Zprova']['referencia'],true);
		$complemento='ok';
		
		$atual = 'select resposta, tentativas from zprovas where id="'.$this->data['Zprova']['id'].'"';
		$complemento = $this->Zprova->query($atual);
		
		$respcorreta = $complemento[0]['zprovas']['resposta'];
		$tentativas = $complemento[0]['zprovas']['tentativas'];
		$tentativas += 0;
		$tentativas++;
		//echo $tentativas;
		$sql1 = "update zprovas set respostamarcada='{$resposta}', tentativas={$tentativas} where id='{$this->data['Zprova']['id']}'";
		//echo $sql1;
		$consulta = $this->Zprova->query($sql1);
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.$complemento.'", "tentativas":"'.$tentativas.'" }';
		
		exit();
	}	
	
	function externoupdate() {
		$u=$this->Session->read('Usuario');
		
		//print_r($u);
		
		$this->layout = 'ajax';
		$ok = 1;
		//$mensagem=print_r($this->data['Zprova']['referencia'],true);
		
		$nomeprova=$this->data['Zprova']['nome_prova'];
		$dataprova=$this->data['Zprova']['dataprova'];
		
                $dtprova=explode('-',$this->data['Zprova']['dataprova']);
                
                $dataprova=$dtprova[2].'-'.$dtprova[1].'-'.$dtprova[0];
		$regulamento=trim($this->data['Zprova']['regulamento']);
                
                $idquestao = explode(',',$this->data['Zprova']['referencia'][0]);
                
                unset($this->data['Zprova']['referencia']);
                foreach($idquestao as $indice=>$dado){
                    $this->data['Zprova']['referencia'][$indice] = $dado;
                   // echo $indice.'=>'.$dado."\n";
                }
		
		$complemento = 'select * from zquestaos Zquestao where Zquestao.regulamento like \'%'.$regulamento.'%\' and ';
		$complemento .= ' Zquestao.referencia in (';
		foreach($this->data['Zprova']['referencia'] as $dados=>$valor){
			$complemento.= $valor.',';
		}
		if($this->data['Zprova']['ordem']=='ALEATORIO'){
			$complemento.='0) order by rand() ';
		}
		if($this->data['Zprova']['ordem']=='CRESCENTE'){
			$complemento.='0) order by Zquestao.id asc ';
		}
		if($this->data['Zprova']['ordem']=='DECRESCENTE'){
			$complemento.='0) order by Zquestao.id desc ';
		}
		$selecao = $this->Zprova->query($complemento);
		//echo $complemento;
                //exit();
		$vetordata = explode('-',$dataprova);
		$dataprova = $vetordata[2].'-'.$vetordata[1].'-'.$vetordata[0];
		
		$indice = 0;
		foreach ($selecao as $dados){
			if(empty($dados['Zquestao']['zfoto_id'])){
				$dados['Zquestao']['zfoto_id']=0;
			}
			$indice++;
			$insercao = 'insert into zprovas (id, nomeprova, dataprova, regulamento, referencia, item, resposta, indice, tentativas, zfoto_id) values (uuid(),';
			$insercao .= '\''.$nomeprova.'\','; 
			$insercao .= '\''.$dataprova.'\','; 
			$insercao .= '\''.$dados['Zquestao']['regulamento'].'\','; 
			$insercao .= '\''.$dados['Zquestao']['referencia'].'\','; 
			$insercao .= '\''.$dados['Zquestao']['item'].'\','; 
			$insercao .= '\''.$dados['Zquestao']['resposta'].'\','; 
			$insercao .= ''.$indice.','; 
			$insercao .= '0, '; 
			$insercao .= '\''.$dados['Zquestao']['zfoto_id'].'\')'; 
			$selecao = $this->Zprova->query($insercao);

		}
		
		
		
		//$sql1 = "select  Zquestao.referencia 	FROM zquestaos as Zquestao where Zquestao.regulamento like '%{$regulamento}%' group by Zquestao.referencia order by  Zquestao.referencia asc";
		//$consulta = $this->Zprova->query($sql1);
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.$mensagem.'" }';
		
		exit();
	}	
	
	function externoreferencia($regulamento) {
		//$u=$this->Session->read('Usuario');
		//print_r($u);
		
		$this->layout = 'ajax';

		//$setorsql = " and Setor.id in ({$u[0][0]['setores']}) ";
		$regulamento=trim($regulamento);
			$sql1 = "select  Zquestao.referencia, Zquestao.id 	FROM zquestaos as Zquestao where Zquestao.regulamento like '%{$regulamento}%' group by Zquestao.referencia order by  Zquestao.referencia asc";
			$consulta = $this->Zprova->query($sql1);

		//	$lista[0] = '';
		//	$lista[0] = '---';
			foreach($consulta as $dados){
				$lista[$dados['Zquestao']['id']]=$dados['Zquestao']['referencia'];
			}

			if(!empty($lista)) {
	  			foreach($lista as $k => $v) {
	  				echo "<option value='$k'>$v</option>";
	  			}
	 		 }

		exit();
	}	
	function add() {
		$sqlc = 'select Zquestao.regulamento from zquestaos Zquestao group by Zquestao.regulamento ';
		$regulamento = $this->Zprova->query($sqlc);
		foreach ($regulamento as $dados){
			$regulamentos[$dados['Zquestao']['regulamento']]=$dados['Zquestao']['regulamento'];
						
		}
               // print_r($regulamento);
		
		$sqlp = 'select Zprova.nomeprova, Zprova.dataprova from zprovas Zprova group by Zprova.nomeprova, Zprova.dataprova order by Zprova.nomeprova, Zprova.dataprova asc ';
		$prova = $this->Zprova->query($sqlp);
		$conta=0;
		$nomes[0]['zprovas']['nomeprova'] = $prova[0]['Zprova']['nomeprova'];
		foreach ($prova as $dados){
			$nomeprovas[$dados['Zprova']['nomeprova'].' '.$dados['Zprova']['dataprova']]=$dados['Zprova']['nomeprova'].' '.$dados['Zprova']['dataprova'];
			if (!array_key_exists($dados['Zprova']['nomeprova'], $nomes)) {
				$conta++;
				$nomes[$conta]['zprovas']['nomeprova'] = $dados['Zprova']['nomeprova'];
			}
		}

		$this->set(compact('regulamentos','nomeprovas','nomes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid zprova', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Zprova->save($this->data)) {
				$this->Session->setFlash(__('The zprova has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zprova could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Zprova->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for zprova', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Zprova->delete($id)) {
			$this->Session->setFlash(__('Zprova deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Zprova was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function externodownload($id = null)
	{
		$this->set('id',$id);
		$this->layout = ''; //this will use the pdf.thtml layout
		$sqlc = 'select * from zfotos Zfoto where Zfoto.id='.$id;
		$dados = $this->Zprova->query($sqlc);
		$this->set('fotos',$dados);
		$this->render();
	}	
	
}
?>