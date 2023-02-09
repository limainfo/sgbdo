<?php
class OcorrenciasController extends AppController {

	var $name = 'Ocorrencias';
	var $helpers = array('Html', 'Form');

	
	function externoldap(){
		$ok = 1;
		/*
		$SERVER = 'ldaps://10.112.24.37';
		$PORT = '389';
		$BASE_DN = 'ou=Users,dc=cindacta4,dc=intraer';
		$DOMAIN_AUTENTICATION= 'dc=cindacta4,dc=intraer';
		$DIRTEMP = 'temp';
		#Classe de usuarios que devera ser consultada para validar os usuariosi(classe for autentication the users):
		$OBJECTCLASS = 'person';
		$ATTRIBUTE='uid';
		$SERVER = 'ldaps://10.112.24.37';
		$DOMAIN_AUTENTICATION= 'dc=cindacta4,dc=intraer';
		$USER = 'evaldoesl@cindacta4.intraer';
		
		$USER_DOMAIN="uid=$USER,$DOMAIN_AUTENTICATION";
		$ds=ldap_connect("$SERVER");

		$BASE_DN = 'ou=Users,dc=cindacta4,dc=intraer';
	    $USER_DN = ldap_get_entries($ds, ldap_search($ds, $BASE_DN, "uid=*"));
*/
		$USER_DN = $this->Ocorrencia->findAll('uid', '*');

		$mensagem = "<form id='ldapForm' method='POST' action='' onsubmit='return false;'><div style='align:center;border:2px solid #000000;padding: 3px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;'>CADASTRO DE E-MAILS PARA O CAMPO DESTINATÁRIOS</div>";
		$mensagem .= "<div style='padding: 3px;background: red url(".$this->webroot."webroot/img/fundo.jpg) no-repeat left top;overflow: auto; color: #000000;position: relative;height: 450px; opacity: 1;'>";
		foreach($USER_DN as $email){
			//$contato[$email['mail'][0]] = $email['cn'][0];
			$mensagem .= "<input type='checkbox' value='".$email['mail'][0]."'>".$email['cn'][0]."<br>";	
		}
		$mensagem .= "</div>";
		$mensagem .= "<div style='align:center;border:2px solid #000000;padding: 3px;color: #000000;position: relative;opacity: 1;background:#b0b0b0;'><input type='submit' value='CADASTRAR OS E-MAILS SELECIONADOS' class='botoes' onclick='atualizaDestinatario();'></div></form>";

	    header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.(addslashes($mensagem)).'"}';
		exit();

	}

	function externodespacho($tipo=null) {
		$ok = 1;
		$u=$this->Session->read('Usuario');
                
		
		$nomeform = 'Despacho'.$tipo;
		
		$id = $this->data[$nomeform]['id'];
		$supervisorturnoid = $this->data[$nomeform]['supervisorturno_id'];
		$tabelaid = $this->data[$nomeform]['tabelaid'];
		$militarid = $this->data[$nomeform]['militar_id'];
		$motivo = $this->data[$nomeform]['motivo'];
		$data = $this->data[$nomeform]['data_despacho'];
		
		if($motivo==''){
			$ok = 0; $mensagem .= '\nO despacho deve ser informado!';
		}
		
		$ok = 0;
		
		if($ok){
		}
		
		
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.($mensagem).'"}';
		exit();

	}
	
	
	
	
	
	
	
	
	
	function externosubstituicao() {
		$ok = 1;
		$u=$this->Session->read('Usuario');
                
		
		$cumprimentoid = $this->data['Ocorrencia']['cumprimentoescala_id'];
		$substitutoid = $this->data['Ocorrencia']['substituto_id'];
		$militarid = $this->data['Ocorrencia']['militar_id'];
		$motivo = $this->data['Ocorrencia']['motivo'];
		$data = $this->data['Ocorrencia']['data'];
		
		//print_r($this->data);
		
		if($substitutoid==$militarid){
			$ok = 0; $mensagem .= '\nO substituto deve ser diferente do substituído!';
		}
		
		if($motivo==''){
			$ok = 0; $mensagem .= '\nO motivo para a substituição deve ser informado!';
		}
		
		if($ok){
			$sqllegenda = "select * from cumprimentoescalas Cumprimentoescala
			inner join escalasmonths Escalasmonth on (Escalasmonth.id=Cumprimentoescala.escalasmonth_id)
			inner join militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.militar_id={$substitutoid})
			where Cumprimentoescala.id={$cumprimentoid} ";
			$dados = $this->Ocorrencia->query($sqllegenda);
			
			//print_r($dados);
			
			$legendaCumprida = $dados[0]['MilitarsEscala']['legenda_cumprida'];
			$escala = $dados[0]['Escalasmonth']['escala_id'];
			$escalasmonth = $dados[0]['Escalasmonth']['id'];
			$legendaAnterior = $dados[0]['Cumprimentoescala']['legenda_cumprido'];
			
			$sql = "select * from afastamentos Afastamento where militar_id={$substitutoid}  and (DATEDIFF('{$data}',dt_inicio)>=0 and DATEDIFF('{$data}',dt_termino)<=0)  and (escala_id=0 or escala_id={$escala}) ";
			$afastamento = $this->Ocorrencia->query($sql);
			

			
		if($afastamento[0]['Afastamento']['militar_id']>0){
			
			$ok = 0;
			$mensagem = 'Motivo:'.$afastamento[0]['Afastamento']['motivo']."  Obs.:".$afastamento[0]['Afastamento']['obs'];
		}else{
			
			
			$sqlatualiza = "update cumprimentoescalas set cumprido={$substitutoid}, legenda_cumprido='{$legendaCumprida}' where id={$cumprimentoid} ";
			$atual = $this->Ocorrencia->query($sqlatualiza);
			
			
			$sqlconfirma = "select * from cumprimentoescalas where cumprido={$substitutoid} and legenda_cumprido='{$legendaCumprida}' and id={$cumprimentoid} ";
			$confirma = $this->Ocorrencia->query($sqlconfirma);
			
			if(empty($confirma[0]['cumprimentoescalas']['id'])){
				$ok = 0;
			}else{
					$sqlt = "select * from versoescalas where escalasmonth_id=$escalasmonth ";
					$naoconformidade = $this->Ocorrencia->query($sqlt);
					$motivos = $naoconformidade[0]['versoescalas']['naoconformidades']."\r| ".$legendaAnterior.' por '.$legendaCumprida.' no dia '.$dia.' Motivo:'.$motivo.' |';

					$sqlt = "update versoescalas set naoconformidades='".addslashes($motivos)."' where escalasmonth_id=$escalasmonth ";
					$this->Ocorrencia->query($sqlt);
				
				
			}
			
		}
			
			
		}
		
		
		header('Content-type: application/x-json');
		echo '{ "ok":"'.$ok.'", "mensagem":"'.($mensagem).'"}';
		exit();

	}
	
	function externociente($tabela = null, $id = null, $militar_id = null) {
		//$this->layout = 'ajax';
		$ok = 0;
		$u=$this->Session->read('Usuario');
                
		
		$nmtabela = '0'.$tabela;
		$tabelasql = 'lrotabela'.$tabela;
		if($tabela<10){
			$nmtabela = '00'.$tabela;
			$tabelasql = 'lrotabela0'.$tabela;
		}

		$nomeTabela = 'lrotabela'.$nmtabela.'';
		$nomeVetor = $tabelasql.'s';

		
#configuracoes do servidor (server config):
$SERVER = 'ldaps://10.112.24.37';
$PORT = '389';
$BASE_DN = 'ou=Users,dc=cindacta4,dc=intraer';
$DOMAIN_AUTENTICATION= 'dc=cindacta4,dc=intraer';
$DIRTEMP = 'temp';
#Classe de usuarios que devera ser consultada para validar os usuariosi(classe for autentication the users):
$OBJECTCLASS = 'person';
$ATTRIBUTE='uid';
$SERVER = 'ldaps://10.112.24.37';
$DOMAIN_AUTENTICATION= 'dc=cindacta4,dc=intraer';

	if($_POST["usuario"]==""){
	//Usu�rio inseriu incorretamente ou veio da p�gina do termo
		 $USER="lixo@cindacta4.intraer";
} else{
		$USER=$_POST["usuario"];
	}
$USER_DOMAIN="uid=$USER,$DOMAIN_AUTENTICATION";
$ds=ldap_connect("$SERVER");
$P=$_POST["senha"];
	if($P!=""){
		$PASSWORD=$P;
	}else{$PASSWORD="lixo";}
$U=$_POST["usuario"];

$BASE_DN = 'ou=Users,dc=cindacta4,dc=intraer';


if ($ds) {
   if($_POST["usuario"]!=""){
   //$r=ldap_bind($ds,$USER,$PASSWORD);
   $USER_DN = ldap_get_entries($ds, ldap_search($ds, $BASE_DN, "uid=$USER", array("dn")));
   $r=ldap_bind($ds, $USER_DN[0]['dn'],$PASSWORD);
}

	if($r){
//   echo "<br>Usu�rio autenticado!!!<br>";
//Usu�rio autenticado no servidor LDAP, por�m n�o possui cadastro
	 if($r["usuario"]=="")
	 {

		 }else{
	  //Usu�rio autenticado no servidor LDAP e cadastrado no sistema
	 }
	  
	 }else{
  //   echo "<br>N�O AUTORIZADO!!!<br>";
			if($_POST["usuario"]!=""){
			echo "<center>Usu&aacute;rio ou senha incorreta !!</center>";
			}
	 }
	ldap_close($ds);
} else {
	echo "<h4>Servidor LDAP indispon�vel !!</h4>";
//	echo '<head><meta http-equiv="pragma" content="no-cache"></meta><meta http-equiv="refresh" content="0;url=index.php"></head>';
}
			

	  		
  /* Destinatário */
  $to  = "evaldoesl@cindacta4.intraer" . ", " ; // Observe a vírgula
  $to .= "oliveiraaos@cindacta4.intraer";
  /* assunto */
  $subject = "Novo anuncio no classificados:";

/* mensagem */
$message = '
<html>
<head>
<title>Anuncio</title>
</head>
<body>
<p>'.$_POST["usuario"].' --> Anunciou:</p>
<table border="1" cellspacing="1" cellpadding="1">
 <tr>
  <th>Titulo</th><th>Anuncio</th></tr>
 <tr>
  <td>'.$titulo.'</td><td>'.nl2br($anuncio).'</td></tr>
 <tr>
  <td></td><td></td></tr>
</table>
</body>
</html>
';

/* Para enviar email HTML, você precisa definir o header Content-type. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";



/* Enviar o email */
mail($to, $subject, $message, $headers);		
		
		
		$consultas = "select * from ".$tabelasql.'s where id='.$id;
		$atual = $this->Ocorrencia->query($consultas);
		
		$supervisorturno_id = $atual[0][$nomeTabela.'s']['supervisorturno_id'];
		
		
		if($tabela==1){
			$delete = 'delete from '.$tabelasql."s  where id={$id}";
			$resposta = $this->Ocorrencia->query($delete);
			$mensagem= "<table cellpadding='0' cellspacing='0'><tr><th>Nome do ATCO</th><th>Reporte ATC número</th><th>Ações</th></tr>";
			$consultas = "select * from ".$tabelasql.'s where supervisorturno_id='.$supervisorturno_id;
			$resultados = $this->Ocorrencia->query($consultas);
			$i = 0;
			$total = count($resultados);
			foreach ($resultados as $resultado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$resultado['Lrotabela01']['nome_atco']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$resultado['Lrotabela01']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
		//	$excluir = "<a onclick=\'return false;\' onmousedown=\"dialogo(\'Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero'].' ?" ,"javascript:var tabela=\"tabela01Dados\";var form=\"lrotabela01LroForm\";excluiRegistro(form,1,'.$resultado['lrotabela01s']['id'].',tabela);");\' href="'.$this->webroot.$this->params['controller'].'"><img border="0" title="Excluir" alt="Excluir" src="'.$this->webroot.'img/lixo.gif"/></a>';
			$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/accept.png"/>';
			$ciente = '<input type="checkbox" id="'.$resultado['lrotabela01s']['id'].'"  value="'.$resultado['lrotabela01s']['id'].'" />';
			$despacho = '<img border="0" title="Despacho" alt="despacho" src="'.$this->webroot.'img/despacho.gif"/>';
			$acao= $excluir.$ciente.$despacho;			
						//$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$resultado['lrotabela01s']['relato_atco_numero']." ?\" ,\"javascript:excluiRegistro(".$resultado['lrotabela01s']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";
			$mensagem .= "	<tr ><td{$class}>{$resultado['lrotabela01s']['nome_atco']}</td><td{$class}>{$resultado['lrotabela01s']['relato_atco_numero']}</td><td{$class}>{$acao}</td></tr>";
			endforeach;
			$mensagem.="</table>";
			$dados = $mensagem;
			$ok = 1;
		}
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes(str_replace("\n"," ",($dados))).'", "total":"'.$total.'" }';
		exit();

	}
	
	function externodelete($tabela = null, $id = null, $privilegio = null) {
		//$this->layout = 'ajax';
		$ok = 0;
		$u=$this->Session->read('Usuario');
                
		
		$nmtabela = '0'.$tabela;
		$tabelasql = 'lrotabela'.$tabela;
		if($tabela<100){
			if($tabela<10){
				$nmtabela = '00'.$tabela;
				$tabelasql = 'lrotabela0'.$tabela;
				$numeracao = $nmtabela;
			}else{
				$nmtabela = '0'.$tabela;
				$tabelasql = 'lrotabela'.$tabela;
				$numeracao = $nmtabela;
			}
		}

		$nomeTabela = 'lrotabela'.$nmtabela.'';
		$exibirTabela = 'exibir'.$nmtabela.'';
		$cabecalhoTabela = 'cabecalho'.$nmtabela.'';
		$nomeVetor = $tabelasql.'s';
		
		
		
		
		
		$consultas = "select * from ".$tabelasql.'s where id='.$id;
		$atual = $this->Ocorrencia->query($consultas);
		
		//echo $consultas;
		
		$supervisorturno_id = $atual[0][$tabelasql.'s']['supervisorturno_id'];
		
		
			$delete = 'delete from '.$tabelasql."s  where id={$id}";
			$resposta = $this->Ocorrencia->query($delete);

			$mensagem= "<table cellpadding='0' cellspacing='0'><tr><th>Nome do ATCO</th><th>Reporte ATC número</th><th>Ações</th></tr>";
			$consultas = "select * from ".$tabelasql.'s where supervisorturno_id='.$supervisorturno_id;
			$resultados = $this->Ocorrencia->query($consultas);
			$i = 0;
			$total = count($resultados);

			
			$mensagem= "<table cellpadding='0' cellspacing='0'>	<tr>";
			foreach($this->data[$cabecalhoTabela] as $chave=>$valor){
				$mensagem .= '<th>'.$valor.'</th>';
			}
			$mensagem .= '<th>Ações</th></tr>';
			
			$consultas = "select * from ".$tabelasql."s where supervisorturno_id={$this->data[$nomeTabela]['supervisorturno_id']}";
			$resultados = $this->Ocorrencia->query($consultas);
			
			$i = 0;
			$total = count($resultados);
			foreach ($resultados as $resultado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			
			
		//	$excluir = '<a onclick=\'return false;\' onmousedown=\"dialogo('Deseja realmente excluir o registro #".$resultado[$nomeVetor][$this->data[$exibirTabela][0]].' ?" ,"javascript:var tabela=\"tabela'.$numeracao.'Dados\";var form=\"lrotabela'.$numeracao.'LroForm\";excluiRegistro(form,'.$tabela.','.$resultado[$nomeVetor]['id'].',tabela);");\' href="'.$this->webroot.$this->params['controller'].'"><img border="0" title="Excluir" alt="Excluir" src="'.$this->webroot.'img/lixo.gif"/></a>';
			
			if(empty($resultado[$nomeVetor]['despacho_gerente_local'])){
				$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/visto_sem_despacho.png"/>';
			}else{
				$ciente = '<img border="0" title="Ciente" alt="ciente" src="'.$this->webroot.'img/visto_com_despacho.png"/>';
			}
			$despacho = '<a href="javascript:despacholocal('.$tabela.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');" onclick="despacholocal('.$tabela.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');"><img border="0" title="Despacho" alt="despacho" src="'.$this->webroot.'img/despacho.gif"/></a>';
			
			$acao = '';
			if($privilegio=='EXECUTANTE'){
				$acao = $excluir;
			}			
			if($privilegio=='GERLOCAL'){
				$acao .= $despacho;
			}			
			$acao .= $ciente;
			
			
			$acao= $excluir.$ciente.$despacho;		
				
			$mensagem .= '<tr>';
			foreach($this->data[$exibirTabela] as $chave=>$valor){
				$mensagem .= '<td'.$class.'>'.$resultado[$nomeVetor][$valor].'</td>';
			}
			$mensagem .= '<td'.$class.'>'.$acao.'</td></tr>';
			

	//-------------------------------------------------------------------------------------		
			
			endforeach;
			$mensagem.="</table><br>";
			$dados = $mensagem;
			$ok = 1;
		
		header('Content-type: application/x-json');
		//
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes(str_replace("\n"," ",($dados))).'", "total":"'.$total.'" }';
		exit();

	}
	
	
	function externoacoes($tabela = null, $privilegio = null, $acesso = null) {
		//$this->layout = 'ajax';
		$ok = 0;
		$u=$this->Session->read('Usuario');
                

		$nmtabela = '0'.$tabela;
		$tabelasql = 'lrotabela'.$tabela;
		if($tabela<100){
			if($tabela<10){
				$nmtabela = '00'.$tabela;
				$tabelasql = 'lrotabela0'.$tabela;
				$numeracao = $nmtabela;
			}else{
				$nmtabela = '0'.$tabela;
				$tabelasql = 'lrotabela'.$tabela;
				$numeracao = $nmtabela;
			}
		}

		$nomeTabela = 'lrotabela'.$nmtabela.'';
		$exibirTabela = 'exibir'.$nmtabela.'';
		$cabecalhoTabela = 'cabecalho'.$nmtabela.'';
		$nomeVetor = $tabelasql.'s';
		
		
			
		$sqlCampos = '(';	
		$sqlValores = 'values (';	
		$virgulas = count($this->data[$nomeTabela]) - 1;
		$conta = 1;
		foreach($this->data[$nomeTabela] as $chave=>$valor){
			if($conta>$virgulas){
				$sqlValores .= '\''.$valor.'\'';
				$sqlCampos .= $chave;
			}else{
				$sqlValores .= '\''.$valor.'\',';
				$sqlCampos .= $chave.', ';
			}
			
			$conta++;
		}
		$sqlCampos  .= ') ';
		$sqlValores .= ') ';	
		
			$insere = 'insert ignore into '.$tabelasql."s $sqlCampos $sqlValores ";
			//echo $insere."\n";
			$resposta = $this->Ocorrencia->query($insere);

			$mensagem= "<table cellpadding='0' cellspacing='0'>	<tr>";
			foreach($this->data[$cabecalhoTabela] as $chave=>$valor){
				$mensagem .= '<th>'.$valor.'</th>';
			}
			$mensagem .= '<th>Ações</th></tr>';
			
			$consultas = "select * from ".$tabelasql."s where supervisorturno_id={$this->data[$nomeTabela]['supervisorturno_id']}";
			$resultados = $this->Ocorrencia->query($consultas);
			
			$i = 0;
			$total = count($resultados);
			foreach ($resultados as $resultado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' style="background-color:#e0e0f0;"';
			}
			
			
		//	$excluir = '<a onclick=\'return false;\' onmousedown=\"dialogo('Deseja realmente excluir o registro #".$resultado[$nomeVetor][$this->data[$exibirTabela][0]].' ?" ,"javascript:var tabela=\"tabela'.$numeracao.'Dados\";var form=\"lrotabela'.$numeracao.'LroForm\";excluiRegistro(form,'.$tabela.','.$resultado[$nomeVetor]['id'].',tabela);");\' href="'.$this->webroot.$this->params['controller'].'"><img border="0" title="Excluir" alt="Excluir" src="'.$this->webroot.'img/lixo.gif"/></a>';
			
			$raiz = $this->webroot;

    	if(empty($resultado[$nomeVetor]['despacho_gerente_local'])){
    		if(!empty($resultado[$nomeVetor]['ciente_gerente_local'])){
    			$ciente = '<img border="0" title="Ciente" alt="ciente"	src="'.$raiz.'img/visto_sem_despacho.png" />';
	    	}
    	}else{
    		$ciente = '<img border="0" title="Ciente" alt="ciente"	src="'.$raiz.'img/visto_com_despacho.png" />';
    	} 
			
			$despacho = '<a href="javascript:despacholocal('.$tabela.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');" onclick="despacholocal('.$tabela.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');"><img border="0" title="Despacho" alt="despacho" src="'.$raiz.'img/despacho.gif"/></a>';
			
			$acao = '';
       		if(($privilegio=='EXECUTANTE')&&($acesso == 1)){ $acao .= $excluir; }
			if($privilegio=='GERLOCAL'){
				$acao .= $despacho;
			}			
			$acao .= $ciente;
			
			
			$acao= $excluir.$ciente.$despacho;		
				
			$mensagem .= '<tr>';
			foreach($this->data[$exibirTabela] as $chave=>$valor){
				$mensagem .= '<td'.$class.'>'.$resultado[$nomeVetor][$valor].'</td>';
			}
			$mensagem .= '<td'.$class.'>'.$acao.'</td></tr>';
			
			endforeach;
			$mensagem.="</table><br>";
			$dados = $mensagem;
			$ok = 1;
		
			
		header('Content-type: application/x-json');
		//
		//$conteudo = print_r($this->data, true);
		echo '{ "ok":"'.$ok.'", "mensagem":"'.addslashes(str_replace("\n"," ",($dados))).'", "total":"'.$total.'" }';
		exit();

	}

	function externoindex($mes = null, $ano = null) {
		$this->layout = 'admin';
//	Configure::write('debug', 2);	
		if(empty($this->data['Escala']['mes'])){
			$this->data['Escala']['mes'] = date('n');
			$this->data['Escala']['ano'] = date('Y');
		}
		
		$mes = array('1'=>'JAN','2'=>'FEV','3'=>'MAR','4'=>'ABR','5'=>'MAI','6'=>'JUN','7'=>'JUL','8'=>'AGO','9'=>'SET','10'=>'OUT','11'=>'NOV','12'=>'DEZ','TODOS'=>'TODOS');
		
		$u=$this->Session->read('Usuario');
                
		$setores = $u[0][0]['setores'];
		//print_r($u);
		
		$sql = "select concat(Setor.sigla_setor,'-',Localidade.sigla_localidade) Setor, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
		where Setor.setor_valido='S' and Setor.id in ($setores)
		group by Setor.id
		order by Setor.sigla_setor , Unidade.sigla_unidade, Localidade.sigla_localidade asc ";
		$ocorrencias = $this->Ocorrencia->query($sql);
		

		$sql = "select Escala.id, Escala.setor_id, Setor.sigla_setor, Escala.livro from escalas Escala
		INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.setor_valido='S' and Setor.id in ($setores))
		where Escala.mes={$this->data['Escala']['mes']} and Escala.ano={$this->data['Escala']['ano']} and Escala.livro not like ''
		order by Escala.livro asc, Setor.sigla_setor asc ";
		$livros = $this->Ocorrencia->query($sql);
                $livros[0]['Escala']['livro']='ACCAZ';
		
		//print_r($u);
		$sql = "select Escala.id from escalas Escala
		INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.setor_valido='S' and Setor.id in ($setores))
		where Escala.mes={$this->data['Escala']['mes']} and Escala.ano={$this->data['Escala']['ano']} and Escala.livro not like ''
		and Escala.gerentelocal_livro={$u[0]['Usuario']['militar_id']}
		order by Escala.livro asc, Setor.sigla_setor asc ";
		$gerentelocal = $this->Ocorrencia->query($sql);
		
		
		$sql = "select Escala.id from escalas Escala
		INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.setor_valido='S' and Setor.id in ($setores))
		where Escala.mes={$this->data['Escala']['mes']} and Escala.ano={$this->data['Escala']['ano']} and Escala.livro not like ''
		and Escala.gerenteregional_livro={$u[0]['Usuario']['militar_id']}
		order by Escala.livro asc, Setor.sigla_setor asc ";
		$gerenteregional = $this->Ocorrencia->query($sql);
		
		
		$sql = "select Escala.id from escalas Escala
		INNER JOIN setors Setor on (Setor.id=Escala.setor_id and Setor.setor_valido='S' and Setor.id in ($setores))
		INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.militar_id={$u[0]['Usuario']['militar_id']}  and MilitarsEscala.escala_id=Escala.id )
		where Escala.mes={$this->data['Escala']['mes']} and Escala.ano={$this->data['Escala']['ano']} and Escala.livro not like ''
		order by Escala.livro asc, Setor.sigla_setor asc ";
		$executante = $this->Ocorrencia->query($sql);
		
		$privilegioAtivo = 'CONSULTA';
		
		if(!empty($executante)){
			$privilegioAtivo = 'EXECUTANTE';
		}
		if(!empty($gerentelocal)){
			$privilegioAtivo = 'GERLOCAL';
		}
		if(!empty($gerenteregional)){
			$privilegioAtivo = 'GERREGIONAL';
		}
		
		
		
		$this->set(compact('ocorrencias','livros','mes', 'u','privilegioAtivo'));

	}

	
	function externoescala($juncao = null, $turnoId = null, $privilegio = null, $ano = null, $mes = null, $dia = null) {
		$this->layout = 'admin';
		$setorIdBL = '2';	
		$setorIdMU = '192';	
		$setorIdPH = '193';	
		$setorId = $juncao;
		$setor_id = $juncao;

		$libera = 0;
		$u=$this->Session->read('Usuario');
                
//			echo $u[0][0]['setores'];
			//print_r($u);

			
			$militarId = $u[0]['Usuario']['militar_id'];
		

		if(($ano ==null)||($mes ==null)||($dia ==null)){
			list ($ano, $mes, $dia) = split ('[/.-]', date('Y-m-d'));
		}
		if(!empty($this->data['Ocorrencia']['data'])){
			list ($dia, $mes, $ano ) = split ('[/.-]', $this->data['Ocorrencia']['data']);
		}
		
		$dataConsulta = $ano.'-'.$mes.'-'.$dia;
		
		
		$this->data['Ocorrencia']['data'] = $dia.'-'.$mes.'-'.$ano;
		
		if(!empty($privilegio)){
			$this->set('privilegio', $privilegio);
		}


		if($juncao=='ACCAZ'){
		$sql = "select concat(Setor.sigla_setor,'-',Localidade.sigla_localidade) Setor, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
		where Setor.setor_valido='S' and Setor.id=$setorIdMU
		group by Setor.id
		order by Setor.sigla_setor , Unidade.sigla_unidade, Localidade.sigla_localidade asc";
		}else{
		$sql = "select concat(Setor.sigla_setor,'-',Localidade.sigla_localidade) Setor, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
		where Setor.setor_valido='S' and Setor.id=$setor_id
		group by Setor.id
		order by Setor.sigla_setor , Unidade.sigla_unidade, Localidade.sigla_localidade asc";
		}
		
		if($juncao=='ACCAZ'){
			$ocorrencias[0][0]['Setor'] = 'ACCAZ';
			$ocorrencias[0]['Setor']['id'] = $setorIdMU;
		}else{
			$ocorrencias = $this->Ocorrencia->query($sql);
		}
		
		$dta = date('Y');
		$dtm = date('m');
		
		$dta = $ano;
		$dtm = $mes;
		//		$dia = date('d');

		$hora = date('H');
		$minuto = date('i');

		$hora_referencia = $hora.':'.$minuto.':00';

		$hora_antes =  strtotime('- 30 minutes');
		$hora_depois =  strtotime('+ 1 hour');
		$data_atual = date('H:i:00',$hora_antes);
		$data_depois = date('H:i:00',$hora_depois);
		//echo $data_atual.' -> '.$data_depois;
		$mesInicio = '8';

		$turnosql = "";

		if($turnoId>0){
			$fase1 = "select *
			FROM turnos Turno
			where Turno.id={$turnoId}
			";
			
			$dadosTurno = $this->Ocorrencia->query($fase1);
			foreach($dadosTurno as $turno){
				$inicioTurno = $turno['Turno']['hora_inicio'];
				$terminoTurno = $turno['Turno']['hora_termino'];
				
			}
			
			//$turnosql = " and Turno.hora_inicio='{$inicioTurno}' and Turno.hora_termino<='{$terminoTurno}' ";
			$turnosql = " and Turno.hora_inicio>='{$terminoTurno}'  ";
			
		}
		//echo $turnosql;
		//inner join turnos Turno on (Turno.escala_id=Escala.id )
		
		if($juncao=='ACCAZ'){
		$fase1 = "select * FROM escalas Escala
		inner join escalasmonths Escalasmonth on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes>={$mesInicio} and Escala.ano={$dta})
		order by Escala.ano asc, Escala.mes asc
		";
		}else{
		$fase1 = "select *
		FROM escalas Escala
		inner join escalasmonths Escalasmonth on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes>={$mesInicio} and Escala.ano={$dta})
		order by Escala.ano asc, Escala.mes asc
		";
			
		}
		//echo "<br>".$fase1."<br>";
		$escalasmonths = $this->Ocorrencia->query($fase1);

		//SetorIdescala
		if($juncao=='ACCAZ'){
		
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and (TIMEDIFF('{$hora_referencia}',hora_inicio)>=0 and TIMEDIFF('{$hora_referencia}',hora_termino)<=0) {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		order by Turno.id asc
		";
		}else{
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and (TIMEDIFF('{$hora_referencia}',hora_inicio)>=0 and TIMEDIFF('{$hora_referencia}',hora_termino)<=0) {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		order by Turno.id asc
		";
			
		}
		//echo $sql."<br>";
		$dados_escalas = $this->Ocorrencia->query($sql);



		$sql = "select *
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id {$turnosql} and (TIMEDIFF('{$hora_referencia}',hora_inicio)>=0 and TIMEDIFF('{$hora_referencia}',hora_termino)<=0) )
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		order by Turno.id asc
		";


		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escalasmonth.id
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id {$turnosql})
		order by Turno.id asc
		";


		$hora_antes =  strtotime(' - 30 minutes');
		$hora_depois =  strtotime(' + 1 hour');
		$data_atual = date('H:i:00',$hora_antes);
		$data_depois = date('H:i:00',$hora_depois);
		//echo $data_atual.' -> '.$data_depois;
		$data_atual = strtotime('now');

		$data = date('Y-m-d');
		$dt_atual = strtotime(date('Y-m-d'));
		$dt_inicio = strtotime(date('2009-9-8'));
		$sqlstatus = 0;
		if($dt_atual>=$dt_inicio){
			$sqlstatus = 1;
		}

		//Insere em SupervisorTurno todos os registros necessários

		$sql = "select * FROM cumprimentoescalas CumprimentoEscala
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=CumprimentoEscala.escalasmonth_id and CumprimentoEscala.dia>=1 and CumprimentoEscala.dia<=31)
		inner join escalas Escala on (Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm}  and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and CumprimentoEscala.id_turno=Turno.id  {$turnosql})
		group by CumprimentoEscala.dia, Turno.id
		order by CumprimentoEscala.dia asc, Turno.id asc
		";

		if($turnoId==0){

			$resultadoTurnos = $this->Ocorrencia->query($sql);


			foreach($resultadoTurnos as $dados){
				$data = $dta.'-'.$dtm.'-'.$dados['CumprimentoEscala']['dia'];
				$turnoID = $dados['CumprimentoEscala']['id_turno'];
				$escalaMES = $dados['CumprimentoEscala']['escalasmonth_id'];
				$insereSupervisorTurno = "insert ignore into supervisorturnos  (data, turno_id, escalasmonth_id, status)
				values ('{$data}', {$turnoID}, {$escalaMES}, '')
			";
					
				//echo $insereSupervisorTurno.'<br>';
					
				$this->Ocorrencia->query($insereSupervisorTurno);
					
			}
		}

		//not like '' and Supervisorturno.status='ABERTA'
		if($juncao=='ACCAZ'){
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo, Supervisorturno.data, Supervisorturno.status, Supervisorturno.id, Escalasmonth.id, Escala.livro
		FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id and Day(Supervisorturno.data)>=1 and Day(Supervisorturno.data)<=31)
		inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id {$turnosql})
		where Supervisorturno.status like '' or Supervisorturno.status like '%ABERTA%'
		group by Supervisorturno.id, Turno.id
		order by Supervisorturno.data asc,Turno.id asc
		";
		}else{
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo, Supervisorturno.data, Supervisorturno.status, Supervisorturno.id, Escalasmonth.id, Escala.livro
		FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id and Day(Supervisorturno.data)>=1 and Day(Supervisorturno.data)<=31)
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id {$turnosql})
		where Supervisorturno.status like '' or Supervisorturno.status like '%ABERTA%'
		group by Supervisorturno.id, Turno.id
		order by Supervisorturno.data asc,Turno.id asc
		";
			
		}
					//echo $sql."<br>";
		$escalas = $this->Ocorrencia->query($sql);



		for($i=0;$i<count($escalas);$i++){
			$turno_id = $escalas[$i]['Turno']['id'];

			list($horasIni, $minutosIni, $segundosIni) = split(':',$escalas[$i]['Turno']['hora_inicio']);
			list($horasFim, $minutosFim, $segundosFim) = split(':',$escalas[$i]['Turno']['hora_termino']);
			
			$string = strtotime($escalas[$i]['Supervisorturno']['data'].' '.$escalas[$i]['Turno']['hora_inicio'].' - 30 minutes');
			$hora_inicio = strtotime(date('Y-m-d H:i:00',$string));
			
				if($horasFim<$horasIni){
					$str = strtotime($escalas[$i]['Supervisorturno']['data'].' '.$escalas[$i]['Turno']['hora_termino'].' + 1 day + 60 minutes ');
				}else{
					$str = strtotime($escalas[$i]['Supervisorturno']['data'].' '.$escalas[$i]['Turno']['hora_termino'].' + 60 minutes ');
				}
			
			$hora_termino = strtotime(date('Y-m-d H:i:00',$str));
			
			//$str = strtotime($escalas[$i]['Supervisorturno']['data'].' '.$escalas[$i]['Turno']['hora_termino'].' + 60 minutes ');
			//$hora_termino = strtotime(date('Y-m-d H:i:00',$str));

			//echo "turnoinicio=>".$escalas[$i]['Supervisorturno']['data'].' '.$escalas[$i]['Turno']['hora_inicio']."    turnotermino=>".$escalas[$i]['Supervisorturno']['data'].' '.$escalas[$i]['Turno']['hora_termino'].'<br>';
			//echo "horainicio=>".$hora_inicio." - horatermino=>".$hora_termino."  atual=>".$data_atual." <br>";
			//echo "horainicio=>".date('d-m-Y H:i:s', $hora_inicio)." - horatermino=>".date('d-m-Y H:i:s',$hora_termino)."  atual=>".date('d-m-Y H:i:s',$data_atual)." <br>";

			$novostatus = '';

			$escalasmonth_id = $escalas[$i]['Escalasmonth']['id'];
			$hoje = date('Y-m-d');


			$novostatus = '';

			$mudaStatus = 1;

			//echo $escalas[$i]['Supervisorturno']['id'].' -> '.$escalas[$i]['Supervisorturno']['status'].$escalas[$i]['Supervisorturno']['data'].'<br>';

			//if(($escalas[$i]['Supervisorturno']['status']=='')&&($data_atual>=$hora_inicio)&&($data_atual<=$hora_termino)){
			if((($escalas[$i]['Supervisorturno']['status']=='ABERTA')||($escalas[$i]['Supervisorturno']['status']==''))&&($data_atual>=$hora_inicio)&&($data_atual<=$hora_termino)){
				$novostatus = 'ABERTA';
				$insere = "update supervisorturnos set status='{$novostatus}' where id={$escalas[$i]['Supervisorturno']['id']}";
				//echo $insere.'<br>';
				$this->Ocorrencia->query($insere);
			}

			if((($escalas[$i]['Supervisorturno']['status']=='ABERTA')||($escalas[$i]['Supervisorturno']['status']==''))&&($data_atual>$hora_termino)){
				$novostatus = 'FECHAMENTO AUTOMÁTICO';
				$insere = "update supervisorturnos set status='{$novostatus}' where id={$escalas[$i]['Supervisorturno']['id']}";
				//echo $insere.'<br>';
				$this->Ocorrencia->query($insere);
			}



		}

$sqlData = " where Supervisorturno.data = '{$dataConsulta}'  ";
		
if($privilegio=='EXECUTANTE'){
			$temp = strtotime($dataConsulta.' - 5 days ');
			$dataConsultaFim = date('Y-m-d',$temp);
			$sqlData = " where Supervisorturno.data <= '{$dataConsulta}' and Supervisorturno.data >= '{$dataConsultaFim}'	";
	
}

		
if($privilegio=='CONSULTA'){
			$temp = strtotime($dataConsulta.' - 30 days ');
			$dataConsultaFim = date('Y-m-d',$temp);
			$sqlData = " where Supervisorturno.data <= '{$dataConsulta}' and Supervisorturno.data >= '{$dataConsultaFim}'	";
	
}

if($privilegio=='GERLOCAL'){
			$temp = strtotime($dataConsulta.' - 10 days ');
			$dataConsultaFim = date('Y-m-d',$temp);
			$sqlData = " where Supervisorturno.data <= '{$dataConsulta}' and Supervisorturno.data >= '{$dataConsultaFim}'	";
	
}

if($privilegio=='GERREGIONAL'){
			$temp = strtotime($dataConsulta.' - 10 days ');
			$dataConsultaFim = date('Y-m-d',$temp);
			$sqlData = " where Supervisorturno.data <= '{$dataConsulta}' and Supervisorturno.data >= '{$dataConsultaFim}'	";
	
}


if($juncao=='ACCAZ'){
		$sql = "
		select * FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id )
		inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm}  and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id  {$turnosql})
		$sqlData
		group by Supervisorturno.data, Turno.id
		order by Supervisorturno.data desc, Turno.id desc
		";
		}else{
		$sql = "
		select * FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id )
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm}  and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id  {$turnosql})
		$sqlData
		group by Supervisorturno.data, Turno.id
		order by Supervisorturno.data desc, Turno.id desc
		";
			
		}

		//echo $sql;

		$turnos = $this->Ocorrencia->query($sql);


		if($turnoId>0){

			//$sql = "select Cumprimentoescala.escalasmonth_id, Cumprimentoescala.previsto, Cumprimentoescala.cumprido

			// echo $sql;
		if($juncao=='ACCAZ'){
			
			$sql1 = "select * FROM supervisorturnos Supervisorturno
			inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id)
			inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
			inner join turnos Turno on (Turno.escala_id=Escala.id and {$turnosql} Turno.hora_inicio>='{$hora_referencia}'  and Turno.hora_termino<='{$hora_referencia}')
		";

		}else{
			$sql1 = "select * FROM supervisorturnos Supervisorturno
			inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id)
			inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
			inner join turnos Turno on (Turno.escala_id=Escala.id and {$turnosql} Turno.hora_inicio>='{$hora_referencia}'  and Turno.hora_termino<='{$hora_referencia}')
		";
			
		}
			//		$escalas = $this->Ocorrencia->query($sql);

		if($juncao=='ACCAZ'){
		
			$sql = "select EscalasMonth.nm_escalantec nm_escalante, EscalasMonth.nm_chefe_orgaoc nm_chefe_orgao,
			EscalasMonth.nm_comandantec nm_comandante, EscalasMonth.id,  Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo,
			EscalasMonth.efetivo_total, Escala.supervisor_geral, Escala.supervisor_regional, Escala.livro, Escala.setor_id,
			EscalasMonth.media_hora_prevista, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao
			FROM escalasmonths EscalasMonth
			INNER JOIN escalas as Escala ON (Escala.setor_id in ({$setorIdMU}, {$setorIdPH}, {$setorIdBL}) and EscalasMonth.escala_id = Escala.id  )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			where EscalasMonth.mes={$dta}{$dtm}
		";
			
		}else{
			$sql = "select EscalasMonth.nm_escalantec nm_escalante, EscalasMonth.nm_chefe_orgaoc nm_chefe_orgao,
			EscalasMonth.nm_comandantec nm_comandante, EscalasMonth.id,  Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo,
			EscalasMonth.efetivo_total, Escala.supervisor_geral, Escala.supervisor_regional, Escala.livro,
			EscalasMonth.media_hora_prevista, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao
			FROM escalasmonths EscalasMonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and EscalasMonth.escala_id = Escala.id  )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			where EscalasMonth.mes={$dta}{$dtm}
		";
			
		}

			$escalados = $this->Ocorrencia->query($sql);

			
		if($juncao=='ACCAZ'){
			$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id  in ({$setorIdMU}, {$setorIdPH}, {$setorIdBL}) and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido "; 
			//{$turnosql}
			//echo $sql;
		}else{
			$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido "; 
			
			
		}

			//echo $sql;

			$cumprindoescala = $this->Ocorrencia->query($sql);
			$data = $cumprindoescala[0]['Supervisorturno']['data'];
			$supervisorturnoid = $cumprindoescala[0]['Supervisorturno']['id'];
			$cumprimentoescala_id = $cumprindoescala[0]['Cumprimentoescala']['id'];
			
			
		//if($juncao=='ACCAZ'){
		
		if($juncao=='ACCAZ'){
		
		$sqlMU = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdMU}  and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc ";
		
		
		$horaturno = $this->Ocorrencia->query($sqlMU);
		foreach($horaturno as $valido){
			$inicio = $valido['Turno']['hora_inicio'];
			$termino = $valido['Turno']['hora_termino'];
			$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
			$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
			$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
		}
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id, Turno.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			$spvRegionalMN = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
			
			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegionalMN = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			
			//echo $consultaSupervisorRegionalAtual."<br>";

			
			$turnosqlCHF = " and Turno.hora_termino>'{$inicioTurno}' and Turno.hora_termino<='{$terminoTurno}' ";
			
			$consultaChefeEquipeAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorChefeEquipe} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosqlCHF})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 

			$spvChefeEquipe = $this->Ocorrencia->query($consultaChefeEquipeAtual);
			
			$consultaSupervisorGeralAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosqlCHF})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido 	";
			 
			$spvGeralMN = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			//echo $consultaSupervisorGeralAtual;
			
			$todosSpvGeralMN = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			
		$sqlBL = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdBL}  and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc ";
		
		$horaturno = $this->Ocorrencia->query($sqlBL);
		
		foreach($horaturno as $valido){
			$inicio = $valido['Turno']['hora_inicio'];
			$termino = $valido['Turno']['hora_termino'];
			$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
			$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
			$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
		}
		
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			
			$spvRegionalBL = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
		
			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegionalBL = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			
			
		$sqlPH = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdPH}  and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc	";
		
		$horaturno = $this->Ocorrencia->query($sqlPH);
		foreach($horaturno as $valido){
			$inicio = $valido['Turno']['hora_inicio'];
			$termino = $valido['Turno']['hora_termino'];
			$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
			$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
			$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
		}
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
		$spvRegionalPH = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);

			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegionalPH = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
		
		$this->set('todosSpvRegionalMN',$todosSpvRegionalMN);
		$this->set('todosSpvRegionalBL',$todosSpvRegionalBL);
		$this->set('todosSpvRegionalPH',$todosSpvRegionalPH);
		$this->set('spvRegionalMN',$spvRegionalMN);
		$this->set('spvRegionalBL',$spvRegionalBL);
		$this->set('spvRegionalPH',$spvRegionalPH);
		$this->set('spvChefeEquipeMN',$spvChefeEquipe);
		$this->set('spvGeralMN',$spvGeralMN);
		$this->set('todosSpvGeralMN',$todosSpvGeralMN);
		
		
		
		}else{
			
			
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc ";
			
		}
		$horaturno = $this->Ocorrencia->query($sql);
		
		foreach($horaturno as $valido){

			if($juncao!='ACCAZ'){
				$inicio = $valido['Turno']['hora_inicio'];
				$termino = $valido['Turno']['hora_termino'];
				$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
				$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
				$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
				
			}
			
			$consultaChefeEquipeAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorChefeEquipe} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			$spvChefeEquipe = $this->Ocorrencia->query($consultaChefeEquipeAtual);
			
			
			$consultaChefeEquipe = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorChefeEquipe} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvChefeEquipe = $this->Ocorrencia->query($consultaChefeEquipe);
			
			
			
			$consultaSupervisorGeralAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			$spvGeral = $this->Ocorrencia->query($consultaSupervisorGeralAtual);

			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvGeral = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			

			
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			
			$spvRegional = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
			
			
			
			
			$consultaSupervisorRegionalAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegional = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
			
		if($juncao=='ACCAZ'){
			$consultaControladoresAtualMU = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdMU} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladoresMU = $this->Ocorrencia->query($consultaControladoresAtualMU);

			$consultaControladoresAtualPH = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdPH} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladoresPH = $this->Ocorrencia->query($consultaControladoresAtualPH);

			$consultaControladoresAtualBL = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdBL} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladoresBL = $this->Ocorrencia->query($consultaControladoresAtualBL);
			
			
		}else{
			$consultaControladoresAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladores = $this->Ocorrencia->query($consultaControladoresAtual);
			
			
		}
			
			
			
		}
			
			
		if($juncao=='ACCAZ'){
		$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdMU} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido

	"; 
		}else{
		$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido

	"; 
			
		}


			$supervisorgeral = $this->Ocorrencia->query($sql);
			
//		$supervisorturnoid=102571;	
			
			$libera = 1;

			for($i=1;$i<93;$i++){
				$tabelas[$i] = 'tabela'.$i;
				$conta = $i;
				if($i<10){
					$tabelas[$i] = 'tabela0'.$i;
					$conta = '0'.$i;
				}
 $supervisorturnoid=102571;

				$consulta = "select * from lro{$tabelas[$i]}s Lrotabela{$conta} where supervisorturno_id={$supervisorturnoid}";
				$$tabelas[$i] = $this->Ocorrencia->query($consulta);
			}			
			
			
			$this->set(compact('cumprimentoescala_id', 'todosControladores', 'todosControladoresMU', 'todosControladoresPH', 'todosControladoresBL', 'spvChefeEquipe','todosSpvChefeEquipe','spvGeral','todosSpvGeral','todosSpvRegional','spvRegional','ocorrencias','escalados', 'escalas', 'turnos', 'cumprindoescala','setorId','libera','data','supervisorturnoid',$tabelas));
		}
		if($libera==0){
			for($i=1;$i<90;$i++){
				$tabelas[$i] = 'tabela'.$i;
				$conta = $i;
				if($i<10){
					$tabelas[$i] = 'tabela0'.$i;
					$conta = '0'.$i;
				}
$supervisorturnoid=102571;

				$consulta = "select * from lro{$tabelas[$i]}s Lrotabela{$conta} where supervisorturno_id={$supervisorturnoid}";
			$$tabelas[$i] = $this->Ocorrencia->query($consulta);
			}			
			
			$this->set(compact('cumprimentoescala_id', 'todosControladores', 'spvChefeEquipe','todosSpvChefeEquipe','spvGeral','todosSpvGeral','todosSpvRegional','spvRegional','ocorrencias','escalados', 'escalas', 'turnos', 'cumprindoescala','setorId','libera',$tabelas));
		}

	}

	function externopdf($juncao = null, $turnoId = null, $privilegio = null, $ano = null, $mes = null, $dia = null) {
		$this->layout = 'pdf';

		$setorIdBL = '2';	
		$setorIdMU = '192';	
		$setorIdPH = '193';	
		$setorId = $juncao;
		$setor_id = $juncao;

		$libera = 0;
		$u=$this->Session->read('Usuario');
                
			
		$militarId = $u[0]['Usuario']['militar_id'];
		

		if(($ano ==null)||($mes ==null)||($dia ==null)){
			list ($ano, $mes, $dia) = split ('[/.-]', date('Y-m-d'));
		}
		if(!empty($this->data['Ocorrencia']['data'])){
			list ($dia, $mes, $ano ) = split ('[/.-]', $this->data['Ocorrencia']['data']);
		}
		
		$dataConsulta = $ano.'-'.$mes.'-'.$dia;
		
		
		$this->data['Ocorrencia']['data'] = $dia.'-'.$mes.'-'.$ano;
		
		if(!empty($privilegio)){
			$this->set('privilegio', $privilegio);
		}


		if($juncao=='ACCAZ'){
		$sql = "select concat(Setor.sigla_setor,'-',Localidade.sigla_localidade) Setor, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
		where Setor.setor_valido='S' and Setor.id=$setorIdMU
		group by Setor.id
		order by Setor.sigla_setor , Unidade.sigla_unidade, Localidade.sigla_localidade asc";
		}else{
		$sql = "select concat(Setor.sigla_setor,'-',Localidade.sigla_localidade) Setor, Setor.id from setors Setor
		LEFT JOIN unidades Unidade on (Unidade.id=Setor.unidade_id)
		INNER JOIN localidades Localidade on (Localidade.id=Unidade.localidade_id)
		where Setor.setor_valido='S' and Setor.id=$setor_id
		group by Setor.id
		order by Setor.sigla_setor , Unidade.sigla_unidade, Localidade.sigla_localidade asc";
		}
		
		if($juncao=='ACCAZ'){
			$ocorrencias[0][0]['Setor'] = 'ACCAZ';
			$ocorrencias[0]['Setor']['id'] = $setorIdMU;
		}else{
			$ocorrencias = $this->Ocorrencia->query($sql);
		}
		
		$dta = date('Y');
		$dtm = date('m');
		
		$dta = $ano;
		$dtm = $mes;
		//		$dia = date('d');

		$hora = date('H');
		$minuto = date('i');

		$hora_referencia = $hora.':'.$minuto.':00';

		$hora_antes =  strtotime('- 30 minutes');
		$hora_depois =  strtotime('+ 1 hour');
		$data_atual = date('H:i:00',$hora_antes);
		$data_depois = date('H:i:00',$hora_depois);
		//echo $data_atual.' -> '.$data_depois;
		$mesInicio = '8';

		$turnosql = "";

		if($turnoId>0){
			$fase1 = "select *
			FROM turnos Turno
			where Turno.id={$turnoId}
			";
			
			$dadosTurno = $this->Ocorrencia->query($fase1);
			foreach($dadosTurno as $turno){
				$inicioTurno = $turno['Turno']['hora_inicio'];
				$terminoTurno = $turno['Turno']['hora_termino'];
				
			}
			
			//$turnosql = " and Turno.hora_inicio='{$inicioTurno}' and Turno.hora_termino<='{$terminoTurno}' ";
			$turnosql = " and Turno.hora_inicio>='{$terminoTurno}'  ";
			
		}
		//echo $turnosql;
		//		inner join turnos Turno on (Turno.escala_id=Escala.id )
		
		if($juncao=='ACCAZ'){
		$fase1 = "select *
		FROM escalas Escala
		inner join escalasmonths Escalasmonth on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes>={$mesInicio} and Escala.ano={$dta})
		order by Escala.ano asc, Escala.mes asc
		";
		}else{
		$fase1 = "select *
		FROM escalas Escala
		inner join escalasmonths Escalasmonth on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes>={$mesInicio} and Escala.ano={$dta})
		order by Escala.ano asc, Escala.mes asc
		";
			
		}
		//echo "<br>".$fase1."<br>";
		$escalasmonths = $this->Ocorrencia->query($fase1);

		//SetorIdescala
		if($juncao=='ACCAZ'){
		
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and (TIMEDIFF('{$hora_referencia}',hora_inicio)>=0 and TIMEDIFF('{$hora_referencia}',hora_termino)<=0) {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		order by Turno.id asc
		";
		}else{
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and (TIMEDIFF('{$hora_referencia}',hora_inicio)>=0 and TIMEDIFF('{$hora_referencia}',hora_termino)<=0) {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		order by Turno.id asc
		";
			
		}
		//echo $sql."<br>";
		$dados_escalas = $this->Ocorrencia->query($sql);



		$sql = "select *
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id {$turnosql} and (TIMEDIFF('{$hora_referencia}',hora_inicio)>=0 and TIMEDIFF('{$hora_referencia}',hora_termino)<=0) )
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		order by Turno.id asc
		";


		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escalasmonth.id
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id {$turnosql})
		order by Turno.id asc
		";


		$hora_antes =  strtotime(' - 30 minutes');
		$hora_depois =  strtotime(' + 1 hour');
		$data_atual = date('H:i:00',$hora_antes);
		$data_depois = date('H:i:00',$hora_depois);
		//echo $data_atual.' -> '.$data_depois;
		$data_atual = strtotime('now');

		$data = date('Y-m-d');
		$dt_atual = strtotime(date('Y-m-d'));
		$dt_inicio = strtotime(date('2009-9-8'));
		$sqlstatus = 0;
		if($dt_atual>=$dt_inicio){
			$sqlstatus = 1;
		}

		//Insere em SupervisorTurno todos os registros necessários

		$sql = "select * FROM cumprimentoescalas CumprimentoEscala
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=CumprimentoEscala.escalasmonth_id and CumprimentoEscala.dia>=1 and CumprimentoEscala.dia<=31)
		inner join escalas Escala on (Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm}  and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and CumprimentoEscala.id_turno=Turno.id  {$turnosql})
		group by CumprimentoEscala.dia, Turno.id
		order by CumprimentoEscala.dia asc, Turno.id asc
		";

		if($turnoId==0){

			$resultadoTurnos = $this->Ocorrencia->query($sql);


			foreach($resultadoTurnos as $dados){
				$data = $dta.'-'.$dtm.'-'.$dados['CumprimentoEscala']['dia'];
				$turnoID = $dados['CumprimentoEscala']['id_turno'];
				$escalaMES = $dados['CumprimentoEscala']['escalasmonth_id'];
				$insereSupervisorTurno = "insert ignore into supervisorturnos  (data, turno_id, escalasmonth_id, status)
				values ('{$data}', {$turnoID}, {$escalaMES}, '')
			";
					
				//echo $insereSupervisorTurno.'<br>';
					
				$this->Ocorrencia->query($insereSupervisorTurno);
					
			}
		}

		//not like '' and Supervisorturno.status='ABERTA'
		if($juncao=='ACCAZ'){
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo, Supervisorturno.data, Supervisorturno.status, Supervisorturno.id, Escalasmonth.id, Escala.livro
		FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id and Day(Supervisorturno.data)>=1 and Day(Supervisorturno.data)<=31)
		inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id {$turnosql})
		where Supervisorturno.status like '' or Supervisorturno.status like '%ABERTA%'
		group by Supervisorturno.id, Turno.id
		order by Supervisorturno.data asc,Turno.id asc
		";
		}else{
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo, Supervisorturno.data, Supervisorturno.status, Supervisorturno.id, Escalasmonth.id, Escala.livro
		FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id and Day(Supervisorturno.data)>=1 and Day(Supervisorturno.data)<=31)
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id {$turnosql})
		where Supervisorturno.status like '' or Supervisorturno.status like '%ABERTA%'
		group by Supervisorturno.id, Turno.id
		order by Supervisorturno.data asc,Turno.id asc
		";
			
		}
					//echo $sql."<br>";
		$escalas = $this->Ocorrencia->query($sql);





if($juncao=='ACCAZ'){
		$sql = "
		select * FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id )
		inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm}  and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id  {$turnosql})
		$sqlData
		group by Supervisorturno.data, Turno.id
		order by Supervisorturno.data desc, Turno.id desc
		";
		}else{
		$sql = "
		select * FROM supervisorturnos Supervisorturno
		inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id )
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm}  and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id and Supervisorturno.turno_id=Turno.id  {$turnosql})
		$sqlData
		group by Supervisorturno.data, Turno.id
		order by Supervisorturno.data desc, Turno.id desc
		";
			
		}

		//echo $sql;

		$turnos = $this->Ocorrencia->query($sql);


		if($turnoId>0){

			//$sql = "select Cumprimentoescala.escalasmonth_id, Cumprimentoescala.previsto, Cumprimentoescala.cumprido

			// echo $sql;
		if($juncao=='ACCAZ'){
			
			$sql1 = "select * FROM supervisorturnos Supervisorturno
			inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id)
			inner join escalas Escala on (Escala.setor_id={$setorIdMU} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
			inner join turnos Turno on (Turno.escala_id=Escala.id and {$turnosql} Turno.hora_inicio>='{$hora_referencia}'  and Turno.hora_termino<='{$hora_referencia}')
		";

		}else{
			$sql1 = "select * FROM supervisorturnos Supervisorturno
			inner join escalasmonths Escalasmonth on (Escalasmonth.id=Supervisorturno.escalasmonth_id)
			inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
			inner join turnos Turno on (Turno.escala_id=Escala.id and {$turnosql} Turno.hora_inicio>='{$hora_referencia}'  and Turno.hora_termino<='{$hora_referencia}')
		";
			
		}
			//		$escalas = $this->Ocorrencia->query($sql);

		if($juncao=='ACCAZ'){
		
			$sql = "select EscalasMonth.nm_escalantec nm_escalante, EscalasMonth.nm_chefe_orgaoc nm_chefe_orgao,
			EscalasMonth.nm_comandantec nm_comandante, EscalasMonth.id,  Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo,
			EscalasMonth.efetivo_total, Escala.supervisor_geral, Escala.supervisor_regional, Escala.livro, Escala.setor_id,
			EscalasMonth.media_hora_prevista, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao
			FROM escalasmonths EscalasMonth
			INNER JOIN escalas as Escala ON (Escala.setor_id in ({$setorIdMU}, {$setorIdPH}, {$setorIdBL}) and EscalasMonth.escala_id = Escala.id  )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			where EscalasMonth.mes={$dta}{$dtm}
		";
			
		}else{
			$sql = "select EscalasMonth.nm_escalantec nm_escalante, EscalasMonth.nm_chefe_orgaoc nm_chefe_orgao,
			EscalasMonth.nm_comandantec nm_comandante, EscalasMonth.id,  Turno.id, Turno.hora_inicio, Turno.hora_termino, Turno.rotulo,
			EscalasMonth.efetivo_total, Escala.supervisor_geral, Escala.supervisor_regional, Escala.livro,
			EscalasMonth.media_hora_prevista, EscalasMonth.mes,EscalasMonth.hora_instrucao,EscalasMonth.obs_hora_instrucao
			FROM escalasmonths EscalasMonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and EscalasMonth.escala_id = Escala.id  )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			where EscalasMonth.mes={$dta}{$dtm}
		";
			
		}

			$escalados = $this->Ocorrencia->query($sql);

			
		if($juncao=='ACCAZ'){
			$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id  in ({$setorIdMU}, {$setorIdPH}, {$setorIdBL}) and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido "; 
			//{$turnosql}
			//echo $sql;
		}else{
			$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido "; 
			
			
		}

			//echo $sql;

			$cumprindoescala = $this->Ocorrencia->query($sql);
			$data = $cumprindoescala[0]['Supervisorturno']['data'];
			$supervisorturnoid = $cumprindoescala[0]['Supervisorturno']['id'];
			$cumprimentoescala_id = $cumprindoescala[0]['Cumprimentoescala']['id'];
			
			
		//if($juncao=='ACCAZ'){
		
		if($juncao=='ACCAZ'){
		
		$sqlMU = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdMU}  and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc ";
		
		
		$horaturno = $this->Ocorrencia->query($sqlMU);
		foreach($horaturno as $valido){
			$inicio = $valido['Turno']['hora_inicio'];
			$termino = $valido['Turno']['hora_termino'];
			$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
			$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
			$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
		}
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id, Turno.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			$spvRegionalMN = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
			
			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegionalMN = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			
			//echo $consultaSupervisorRegionalAtual."<br>";

			
			$turnosqlCHF = " and Turno.hora_termino>'{$inicioTurno}' and Turno.hora_termino<='{$terminoTurno}' ";
			
			$consultaChefeEquipeAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorChefeEquipe} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosqlCHF})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 

			$spvChefeEquipe = $this->Ocorrencia->query($consultaChefeEquipeAtual);
			
			$consultaSupervisorGeralAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosqlCHF})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido 	";
			 
			$spvGeralMN = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			//echo $consultaSupervisorGeralAtual;
			
			$todosSpvGeralMN = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			
		$sqlBL = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdBL}  and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc ";
		
		$horaturno = $this->Ocorrencia->query($sqlBL);
		
		foreach($horaturno as $valido){
			$inicio = $valido['Turno']['hora_inicio'];
			$termino = $valido['Turno']['hora_termino'];
			$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
			$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
			$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
		}
		
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			
			$spvRegionalBL = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
		
			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegionalBL = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
			
			
		$sqlPH = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setorIdPH}  and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc	";
		
		$horaturno = $this->Ocorrencia->query($sqlPH);
		foreach($horaturno as $valido){
			$inicio = $valido['Turno']['hora_inicio'];
			$termino = $valido['Turno']['hora_termino'];
			$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
			$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
			$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
		}
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
		$spvRegionalPH = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);

			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegionalPH = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			
		
		$this->set('todosSpvRegionalMN',$todosSpvRegionalMN);
		$this->set('todosSpvRegionalBL',$todosSpvRegionalBL);
		$this->set('todosSpvRegionalPH',$todosSpvRegionalPH);
		$this->set('spvRegionalMN',$spvRegionalMN);
		$this->set('spvRegionalBL',$spvRegionalBL);
		$this->set('spvRegionalPH',$spvRegionalPH);
		$this->set('spvChefeEquipeMN',$spvChefeEquipe);
		$this->set('spvGeralMN',$spvGeralMN);
		$this->set('todosSpvGeralMN',$todosSpvGeralMN);
		
		
		
		}else{
			
			
		$sql = "select Turno.id, Turno.hora_inicio, Turno.hora_termino, Escala.supervisor_geral, Escala.supervisor_regional, Escala.chefe_equipe
		FROM escalasmonths Escalasmonth
		inner join escalas Escala on (Escala.setor_id={$setor_id} and Escala.ativa>0 and Escalasmonth.escala_id=Escala.id and Escala.mes={$dtm} and Escala.ano={$dta})
		inner join turnos Turno on (Turno.escala_id=Escala.id   {$turnosql})
		inner join cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and Cumprimentoescala.dia={$dia} and Cumprimentoescala.id_turno=Turno.id)
		group by Turno.id
		order by Turno.id asc ";
			
		}
		$horaturno = $this->Ocorrencia->query($sql);
		
		foreach($horaturno as $valido){

			if($juncao!='ACCAZ'){
				$inicio = $valido['Turno']['hora_inicio'];
				$termino = $valido['Turno']['hora_termino'];
				$setorSupervisorGeral = $valido['Escala']['supervisor_geral'];
				$setorSupervisorRegional = $valido['Escala']['supervisor_regional'];
				$setorChefeEquipe = $valido['Escala']['chefe_equipe'];
				
			}
			
			$consultaChefeEquipeAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorChefeEquipe} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			$spvChefeEquipe = $this->Ocorrencia->query($consultaChefeEquipeAtual);
			
			
			$consultaChefeEquipe = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorChefeEquipe} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvChefeEquipe = $this->Ocorrencia->query($consultaChefeEquipe);
			
			
			
			$consultaSupervisorGeralAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			$spvGeral = $this->Ocorrencia->query($consultaSupervisorGeralAtual);

			$consultaSupervisorGeralAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorGeral} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvGeral = $this->Ocorrencia->query($consultaSupervisorGeralAtual);
			

			
			$consultaSupervisorRegionalAtual = "select Supervisorturno.id, MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id, Escala.setor_id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido	"; 
			
			$spvRegional = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
			
			
			
			
			$consultaSupervisorRegionalAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorSupervisorRegional} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosSpvRegional = $this->Ocorrencia->query($consultaSupervisorRegionalAtual);
			
		if($juncao=='ACCAZ'){
			$consultaControladoresAtualMU = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdMU} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladoresMU = $this->Ocorrencia->query($consultaControladoresAtualMU);

			$consultaControladoresAtualPH = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdPH} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladoresPH = $this->Ocorrencia->query($consultaControladoresAtualPH);

			$consultaControladoresAtualBL = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdBL} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladoresBL = $this->Ocorrencia->query($consultaControladoresAtualBL);
			
			
		}else{
			$consultaControladoresAtual = "select MilitarsEscala.militar_id,  
			MilitarsEscala.legenda_cumprida,
			Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1  )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id) "; 
			
			$todosControladores = $this->Ocorrencia->query($consultaControladoresAtual);
			
			
		}
			
			
			
		}
			
			
		if($juncao=='ACCAZ'){
		$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setorIdMU} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido

	"; 
		}else{
		$sql = "select Supervisorturno.data, Supervisorturno.id, Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido, Cumprimentoescala.legenda_cumprido , MilitarsEscala.militar_id, MilitarsEscala.cumprida,
			MilitarsEscala.legenda_cumprida, Escala.livro, Cumprimentoescala.id
			,Posto.sigla_posto, Especialidade.nm_especialidade, Militar.nm_guerra, Militar.nm_completo
			FROM escalasmonths Escalasmonth
			INNER JOIN escalas as Escala ON (Escala.setor_id = {$setor_id} and Escalasmonth.escala_id = Escala.id  and Escalasmonth.mes={$dta}{$dtm} )
			INNER JOIN turnos as Turno ON ( Turno.escala_id = Escala.id {$turnosql})
			INNER JOIN cumprimentoescalas Cumprimentoescala on (Cumprimentoescala.escalasmonth_id=Escalasmonth.id and  Cumprimentoescala.id_turno=Turno.id and Cumprimentoescala.dia={$dia})
			INNER JOIN supervisorturnos Supervisorturno on (Supervisorturno.escalasmonth_id=Escalasmonth.id and Supervisorturno.turno_id=Turno.id  )
			INNER JOIN militars_escalas MilitarsEscala on (MilitarsEscala.escala_id=Escalasmonth.escala_id and MilitarsEscala.cumprida=1 and MilitarsEscala.militar_id=Cumprimentoescala.cumprido )
			INNER JOIN militars Militar on (Militar.id=MilitarsEscala.militar_id)
			INNER JOIN postos Posto on (Militar.posto_id=Posto.id)
			INNER JOIN especialidades Especialidade on (Militar.especialidade_id=Especialidade.id)
		where Supervisorturno.data = '{$dataConsulta}'
			group by Turno.id, Escalasmonth.id, Cumprimentoescala.cumprido

	"; 
			
		}


			$supervisorgeral = $this->Ocorrencia->query($sql);
			
			
			
			$libera = 1;

			for($i=1;$i<93;$i++){
				$tabelas[$i] = 'tabela'.$i;
				$conta = $i;
				if($i<10){
					$tabelas[$i] = 'tabela0'.$i;
					$conta = '0'.$i;
				}
				$consulta = "select * from lro{$tabelas[$i]}s Lrotabela{$conta} where supervisorturno_id={$supervisorturnoid}";
				$$tabelas[$i] = $this->Ocorrencia->query($consulta);
			}			
			
			
			$this->set(compact('cumprimentoescala_id', 'todosControladores', 'todosControladoresMU', 'todosControladoresPH', 'todosControladoresBL', 'spvChefeEquipe','todosSpvChefeEquipe','spvGeral','todosSpvGeral','todosSpvRegional','spvRegional','ocorrencias','escalados', 'escalas', 'turnos', 'cumprindoescala','setorId','libera','data','supervisorturnoid',$tabelas));
		}
		if($libera==0){
			for($i=1;$i<93;$i++){
				$tabelas[$i] = 'tabela'.$i;
				$conta = $i;
				if($i<10){
					$tabelas[$i] = 'tabela0'.$i;
					$conta = '0'.$i;
				}
				$consulta = "select * from lro{$tabelas[$i]}s Lrotabela{$conta} where supervisorturno_id={$supervisorturnoid}";
				$$tabelas[$i] = $this->Ocorrencia->query($consulta);
			}			
			
			$this->set(compact('cumprimentoescala_id', 'todosControladores', 'spvChefeEquipe','todosSpvChefeEquipe','spvGeral','todosSpvGeral','todosSpvRegional','spvRegional','ocorrencias','escalados', 'escalas', 'turnos', 'cumprindoescala','setorId','libera',$tabelas));
		}
	}

}
?>
