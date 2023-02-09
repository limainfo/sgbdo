<?php
/*
if(isset($fotos['Assinatura']['data'])){
	header('Content-type: ' . $fotos['Assinatura']['type']);
	header('Content-length: ' . $fotos['Assinatura']['size']);
	header('Content-Disposition: attachment; filename='.$fotos['Assinatura']['name']);


	echo stripslashes($fotos['Assinatura']['data']);
}else
{

		$arquivo = substr($GLOBALS['DOCUMENT_ROOT'],0,-1).$GLOBALS['Dispatcher']->base.'/webroot/img/sem_imagem.png';
		header('Content-type: image/png');
		header('Content-length: ' . filesize($arquivo));
		header('Content-Disposition: attachment; filename=sem_imagem.png');

		$manip = fopen($arquivo,'r');
		echo fread($manip,filesize($arquivo));
		fclose($manip);

	
}
*/
?>
<?php
if(isset($fotos['Assinatura']['data'])){
	header('Content-type: ' . $fotos['Assinatura']['type']);
	header('Content-length: ' . $fotos['Assinatura']['size']);
	header('Content-Disposition: attachment; filename='.$fotos['Assinatura']['name']);


	echo stripslashes($fotos['Assinatura']['data']);
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
