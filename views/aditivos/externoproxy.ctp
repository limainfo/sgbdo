<?php 
function _get($type,$host,$port='80',$path='/',$data='') {
    $_err = 'lib sockets::'.__FUNCTION__.'(): ';
    switch($type) { case 'http': $type = ''; case 'ssl': continue; default: die($_err.'bad $type'); } if(!ctype_digit($port)) die($_err.'bad port');
//    if(!empty($data)) foreach($data AS $k => $v) $str .= urlencode($k).'='.urlencode($v).'&'; $str = substr($str,0,-1);
   
    $fp = fsockopen($host,$port,$errno,$errstr,$timeout=30);
    if(!$fp) die($_err.$errstr.$errno); else {
        fputs($fp, "POST $path HTTP/1.1\r\n"."Host: $host\r\n"."Content-type: application/x-www-form-urlencoded\r\n"."Content-length: ".strlen($data)."\r\n"."Connection: close\r\n\r\n".$data."\r\n\r\n");
        /*
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ".strlen($data)."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data."\r\n\r\n");
        */

       $controla = 0;
        while(!feof($fp)){
			$resposta = fgets($fp,16384);
			if($controla){
			 $d .= $resposta;
			}
			if(strpos($resposta,'<start>')!==false){
				$controla=1;
			}
		 }
        fclose($fp);
    }
     return $d;
} 

{


$total = count($_POST['campo']);
for($i=0;$i<$total;$i++){
if(!empty($_POST['campo'][$i]) && !empty($_POST['condicao'][$i]) && !empty($_POST['valor'][$i])){
	$postado .= "&campo%5B%5D={$_POST['campo'][$i]}&condicao%5B%5D={$_POST['condicao'][$i]}&valor%5B%5D={$_POST['valor'][$i]}";
}
}
$post = "_method=POST$postado";
// echo _get('http', 'localhost', 8888, '/servicos2/sdop/index.cfm', $post); 
 echo _get('http', 'servicos.decea.intraer', '80', '/sdop/index.cfm', $post); 
}



?>
