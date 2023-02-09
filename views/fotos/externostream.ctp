<?php
if(isset($fotos['Foto']['data'])){	
	
	$dados = $fotos['Foto']['data'];

	header('Content-type: ' . $fotos['Foto']['type']);
	header('Content-length: ' . strlen($dados));
	header('Content-Disposition: attachment; filename='.$fotos['Foto']['name']);
	echo $dados;

}


?>
