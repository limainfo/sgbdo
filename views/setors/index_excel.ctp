  
<?php 
	$csv->setFilename($nome);
	$csv->addGrid($conteudo);
	echo $csv->render(true,'latin1','UTF-8');
?>
