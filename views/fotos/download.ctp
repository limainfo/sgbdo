<?php
if(isset($fotos['Foto']['data'])){
	header('Content-type: ' . $fotos['Foto']['type']);
	header('Content-length: ' . $fotos['Foto']['size']);
	header('Content-Disposition: attachment; filename='.$fotos['Foto']['name']);


	echo stripslashes($fotos['Foto']['data']);
}
/*
else
{
	if(isset($fotos['Foto']['alt'])){

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
