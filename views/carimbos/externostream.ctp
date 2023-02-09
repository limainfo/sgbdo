<?php
if(isset($carimbos['Carimbo']['data'])){	
	
	$dados = $carimbos['Carimbo']['data'];

	header('Content-type: ' . $carimbos['Carimbo']['type']);
	header('Content-length: ' . strlen($dados));
	header('Content-Disposition: attachment; filename='.$carimbos['Carimbo']['name']);
	echo $dados;

}


?>
