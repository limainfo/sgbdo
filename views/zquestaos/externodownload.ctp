<?php


if(isset($fotos[0]['Zfoto']['data'])){	
	$dados = ($fotos[0]['Zfoto']['data']);
	$im = imagecreatefromstring($dados);
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);
$alternativa=1;
ob_start();
	$nWidth = imagesx($im); 
	$nHeight = imagesy($im);
	$nDestinationWidth = 400; $nDestinationHeight = 300;
	//$size=$fotos[0]['Zfoto']['size'];
	$size = 600;
  	$aspect_ratio = $nHeight/$nWidth;

   if ($nWidth <= $size) {
     $nDestinationWidth = $nWidth;
     $nDestinationHeight = $nHeight;
   } else {
     $nDestinationWidth = $size;
     $nDestinationHeight = abs($nDestinationWidth * $aspect_ratio);
   }	

	$oDestinationImage = imagecreatetruecolor($nDestinationWidth, $nDestinationHeight); 
	$oResult = imagecopyresampled( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight); 
	ImageCopyResized( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight);
	imageJPEG($oDestinationImage);
	$image_buffer = ob_get_contents();
ob_end_clean();

echo $image_buffer;
}


?>
