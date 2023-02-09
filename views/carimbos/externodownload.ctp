<?php
if(isset($carimbos['Carimbo']['data'])){	
	
	//$dados = stripslashes($carimbos['Carimbo']['data']);
	$dados = ($carimbos['Carimbo']['data']);
	$im = imagecreatefromstring($dados);
	
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

//$context = stream_context_create($opts);

/* Sends an http request to www.example.com
   with additional headers shown above */
//echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->webroot.'fotos/externostream/'.$id;
ob_start();
//$fp = fopen('http://'.$_SERVER['HTTP_HOST'].'/'.$this->webroot.'fotos/externostream/'.$id, 'r', false, $context);
//fpassthru($fp);


	$nWidth = imagesx($im); 
	$nHeight = imagesy($im);
	$nDestinationWidth = 40; $nDestinationHeight = 30;
	$size=40;
  	$aspect_ratio = $nHeight/$nWidth;

   if ($nWidth <= $size) {
     $nDestinationWidth = $nWidth;
     $nDestinationHeight = $nHeight;
   } else {
     $nDestinationWidth = $size;
     $nDestinationHeight = abs($nDestinationWidth * $aspect_ratio);
   }	
   if(isset($alternativa)){
     $nDestinationWidth = $nWidth;
     $nDestinationHeight = $nHeight;
   }
	//echo $nWidth;
	//$nDestinationWidth = $nWidth; $nDestinationHeight = $nHeight;
	$oDestinationImage = imagecreatetruecolor($nDestinationWidth, $nDestinationHeight); 
	//$oDestinationImage = imagecreate($nDestinationWidth, $nDestinationHeight);
	$oResult = imagecopyresampled( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight); 
	//ImageCopyResized( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight);
	ImageCopyResized( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight);
	imageJPEG($oDestinationImage);
	$image_buffer = ob_get_contents();
//fclose($fp);
ob_end_clean();

	//header('Content-type: ' . $carimbos['Carimbo']['type']);
	//header('Content-length: ' . strlen($dados));
	//header('Content-Disposition: attachment; filename='.$carimbos['Carimbo']['name']);
echo $image_buffer;
//ImageDestroy($oDestinationImage);
}




/*
else
{
	if(isset($carimbos['Carimbo']['alt'])){

		//print_r($GLOBALS);

		$arquivo = substr($GLOBALS['DOCUMENT_ROOT'],0,-1).$GLOBALS['Dispatcher']->base.'/webroot/img/sem_imagem.png';
		header('Content-type: image/png');
		header('Content-length: ' . filesize($arquivo));
		header('Content-Disposition: attachment; filename=sem_imagem.png');

		$manip = fopen($arquivo,'r');
		echo fread($manip,filesize($arquivo));
		fclose($manip);

	}
}
*/
?>
