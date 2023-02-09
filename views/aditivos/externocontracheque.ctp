<?php

//echo '<br><br><br>'.($u[0]['Usuario']['saram']);
// submit these variables to the server
//$post_data = array("test"=>"yes", "passed"=>"yes", "id"=>"3");
					
    $meses =  array(1=>'jan',2=>'fev',3=>'mar',4=>'abr',5=>'mai',6=>'jun',7=>'jul',8=>'ago',9=>'set',10=>'out',11=>'nov',12=>'dez');
    $mesatual = date('n');
    $anoatual = date('Y');
    $diaatual = date('j');

    if($diaatual>=20){
            $mes = $meses[$mesatual];
            $ano = $anoatual;
    }else{
            $mesatual -= 1;
            if($mesatual==0){
                    $anoatual -= 1;
                    $mesatual = 12;
            }
            $mes = $meses[$mesatual];
            $ano = $anoatual;
    }
						
							

$_POST['enviar']='Enviar';
$_POST['saram']=substr($u[0]['Usuario']['saram'],0,6);
$_POST['pesquisa']=substr($u[0]['Usuario']['saram'],0,6);
$_POST['mesano_pgto']=$mes.$ano;
$_POST['NP']=1;
$post_data = $_POST;

//$_GET['destino']='http://10.31.80.5/contracheque/processa_cc_novo.php&pegasessao=0&valorsessao=';
//destino=http://10.31.80.5/contracheque/entrada.php&pegasessao=1&valorsessao='
$_GET['valorsessao']='';
$_GET['destino']='http://10.31.80.5/contracheque/entrada.php';
$_GET['pegasessao']=1;

$_GET['valorsessao']=do_post_request($_GET['destino'], $post_data, $_GET['pegasessao'],$_GET['valorsessao']); 
$_GET['destino']='http://10.31.80.5/contracheque/processa_cc_novo.php';
$_GET['pegasessao']=0;
echo do_post_request($_GET['destino'], $post_data, $_GET['pegasessao'],$_GET['valorsessao']); 


function do_post_request($url, $data, $pegasessao, $valorsessao, $referer = ""){
    // convert the data array into URL Parameters like a=1&b=2 etc.
    //$data['usuario'] = "leandrolvs";
    //$data['senha'] = "270511";
    //$data['usuario'] = "marcosmvbr";
    //$data['senha'] = "261290";
    
    $data['usuario'] = 'TESADSSFSADSAS';
    $data['senha'] = 'FDAFOIAIOAKLDSMDSLAMADS';
    
    $post = $data;

    $data = http_build_query($data);
    // parse the given URL
    $url = parse_url($url); 
    
    if($url["scheme"] != "http"){ 
        die("Error: only HTTP requests supported!");
    }
 
    // extract host and path from url
    $host = $url["host"];
    $path = $url["path"];
 
    // open a socket connection with port 80, set timeout 40 sec.
    $fp = fsockopen($host, 80, $errno, $errstr, 40);
    $result = "";
 
    if($fp){ 
        // send a request headers

        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        if(!empty($valorsessao)){
        	fputs($fp, "Cookie: PHPSESSID=$valorsessao\r\n");
        }
        if($referer != "") fputs($fp, "Referer: $referer\r\n");
        
        
        
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ".strlen($data)."\r\n");
        
        
        
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);
        
                
        // receive result from request
        while(!feof($fp)) $result .= fgets($fp, 4096);
        
       // echo 'CONSULTA<br><hr>'.$result.'<br><br><br><hr>';
        
    }else{ 
	header('Content-type: application/x-json');
    	$retorno = array ("status"=>"err","error"=>$errstr.' '.$errno);
    	//echo '{"status":"err", "error":"'.$errstr.' '.$errno.'"}';
    	echo json_encode($retorno);
    }
 
    // close socket connection
    fclose($fp);
    
    // split result header from the content
    $result = explode("\r\n\r\n", $result, 2);
    $header = isset($result[0]) ? $result[0] : "";
    
    if($pegasessao>0){

    	$content = isset($result[0]) ? $result[0] : "";
    	$pinicio = strpos($content, 'PHPSESSID=');
    	$inicio = substr($content, $pinicio+10, strlen($content)-10 );
    	$pinicio = strpos($inicio, ';');
    	$inicio = substr($inicio, 0, $pinicio);
    	$content = $inicio;
    	
        return $content;
    	
    }else{
    	$content = isset($result[1]) ? $result[0] : "";
        //return $content;
            echo iconv('LATIN1','UTF8',$result[1]);

        
    }

    
    }
 
    

?>