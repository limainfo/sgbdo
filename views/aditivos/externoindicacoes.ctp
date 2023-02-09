<?php

//echo '<br><br><br>'.($u[0]['Usuario']['saram']);
// submit these variables to the server
//$post_data = array("test"=>"yes", "passed"=>"yes", "id"=>"3");
							

$_POST['saram']=substr($u[0]['Usuario']['saram'],0,3).'.'.substr($u[0]['Usuario']['saram'],3,3).'-'.substr($u[0]['Usuario']['saram'],6,1);
$post_data = $_POST;

// conecta a um banco de dados chamado "flavia" em "localhost" na porta "5432"

$conectadctp = pg_connect("host=10.32.63.32 port=5432 dbname=trainning_development user=sgpo password=sgpo131415");


$resultado_id = pg_query($conectadctp, "SELECT party_id from pessoas where saram='{$_POST['saram']}' ");

if (!$resultado_id) {
    echo "Um erro ororreu.\n";
    exit;
}

$dados = pg_fetch_array($resultado_id, 0, PGSQL_NUM);
pg_close($conectadctp);
  


$_GET['valorsessao']='';
$_GET['destino']='http://dctp.decea.intraer/portal/meuscursos/pesquisacursos/'.$dados[0].'/indiconcl';
$_GET['pegasessao']=1;

echo do_get_request($_GET['destino'], $post_data); 


function do_get_request($url, $data){
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

        fputs($fp, "GET $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        if(!empty($valorsessao)){
//        	fputs($fp, "Cookie: PHPSESSID=$valorsessao\r\n");
        }
//        if($referer != "") fputs($fp, "Referer: $referer\r\n");
        
        
        
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
    
    $content = isset($result[1]) ? $result[0] : "";
    //return $content;
    echo $result[1];

    
    }
 
    

?>