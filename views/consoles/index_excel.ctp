  
<?php 
	$csv->setFilename($nome);
	$csv->addGrid($conteudo);
	echo $csv->render(true,'CP1251','UTF-8');
?>
