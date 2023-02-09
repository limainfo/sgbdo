<?php
/*
echo '<pre>';
print_r($habilitacaos);
echo '</pre>';
exit();
*/

if($destino=='Licenca'){
	
	
$pdf->SetFont('Arial','',14);
$pdf->AliasNbPages('{total}');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 25);

foreach($licencas as $dados){
    $caminho = substr(__FILE__, 0, strrpos(__FILE__, '/'));
    $caminho = str_replace('views/aditivos','',$caminho);
    $pdf->barcode("CODE128");
    $barnumber=$dados['Licenca']['codigo_barra'];//"PQ-RSCt 0072011.070000001"
    $pdf->setSymblogy("CODE128");
    $pdf->setHeight(40);
    $pdf->setHexColor("#000000","#FFFFFF");
    //$caminho = str_replace("index.php","tmpfotos/codigobarra",$_SERVER["SCRIPT_FILENAME"]);
    $nomecodigobarra = $caminho.'webroot/tmpfotos/emitente'.$dados['Licenca']['nr_licenca'];
    $pdf->genBarCode($barnumber,"jpg",$nomecodigobarra);			

				
    if(isset($dados['Militar']['Foto']['data'])){	
	$nm_arquivo = $caminho."webroot/tmpfotos/foto{$dados['Militar']['Foto']['id']}.jpg";
	$conteudo = ($dados['Militar']['Foto']['data']);
	$im = imagecreatefromstring($conteudo);
	
ob_start();

	$nWidth = imagesx($im); 
	$nHeight = imagesy($im);
	$nDestinationWidth = 200; $nDestinationHeight = 200;
	$size=200;
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
	$oDestinationImage = imagecreatetruecolor($nDestinationWidth, $nDestinationHeight); 
	$oResult = imagecopyresampled( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight); 
	ImageCopyResized( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight);
	imageJPEG($oDestinationImage);
	$image_buffer = ob_get_contents();
ob_end_clean();

	$fp = fopen($nm_arquivo, 'w+b');
	fwrite($fp, $image_buffer);
	fclose($fp);
	$fotos[$dados['Licenca']['nr_licenca']]=$nm_arquivo;
}
				
	
if(isset($dados['Carimbo']['data'])){	
	
	$nm_arquivo = $caminho."webroot/tmpfotos/carimbo{$dados['Carimbo']['id']}.png";
	$conteudo = ($dados['Carimbo']['data']);
	$im = imagecreatefromstring($conteudo);
	
ob_start();

	$nWidth = imagesx($im); 
	$nHeight = imagesy($im);
	$nDestinationWidth = 200; $nDestinationHeight = 200;
	$size=200;
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
	$oDestinationImage = imagecreatetruecolor($nDestinationWidth, $nDestinationHeight); 

	imagealphablending($oDestinationImage, false);
	imagesavealpha($oDestinationImage, true);
	$transparent = imagecolorallocatealpha($oDestinationImage, 255, 255, 255, 127);
	imagefilledrectangle($oDestinationImage, 0, 0, $nDestinationWidth, $nDestinationHeight, $transparent);
	
	$oResult = imagecopyresampled( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight); 
	ImageCopyResized( $oDestinationImage, $im, 0, 0, 0, 0, $nDestinationWidth, $nDestinationHeight, $nWidth, $nHeight);
	imagepng($oDestinationImage);
	$image_buffer = ob_get_contents();
ob_end_clean();

	$fp = fopen($nm_arquivo, 'w+b');
	fwrite($fp, $image_buffer);
	fclose($fp);
	$carimbos[$dados['Licenca']['nr_licenca']]=$nm_arquivo;
}		
			 
		}
	//print_r($fotos);exit();	

$pdf->LicencaRelatorio($licencas, $fotos, $carimbos);
 $pdf->fpdfOutput('licenca.pdf', 'I');
 
}else{
	
$pdf->SetFont('Arial','',14);
$pdf->AliasNbPages('{total}');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 25);
$pdf->HabilitacaoRelatorio($habilitacaos);
 $pdf->fpdfOutput('habilitacao.pdf', 'I');

	
}
?>
