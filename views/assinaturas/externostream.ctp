<?php
if(isset($fotos['Assinatura']['data'])){	
	
	$dados = stripslashes($fotos['Assinatura']['data']);

	header('Content-type: ' . $fotos['Assinatura']['type']);
	header('Content-length: ' . strlen($dados));
	header('Content-Disposition: attachment; filename='.$fotos['Assinatura']['name']);
	echo $dados;

}


?>
