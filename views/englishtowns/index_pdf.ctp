<?php
echo '<pre>';
//print_r($englishtowns);
echo '</pre>';


$conta_orgao = 0;
$conta_nivel = 0;
$todos = 0;

foreach($englishtowns as $dados){

	$local = $dados['Englishtown']['Local'];
	$orgao = $dados['Englishtown']['orgao'];
	$ano = $dados['Englishtown']['ano'];
	$mes = $dados['Englishtown']['mes'];
	$nivel = $dados['Englishtown']['nivel_atual'];
	
	//$compara = $local.$orgao.$ano.$mes;
	
	$opcao = substr($nivel,5,3) + 0;
	
	
	if(substr($nivel,0,5)=='Level'){
		$total_orgao[$local.'|'.$orgao.'|'.$ano.'|'.$mes]++;
		$total_local[$local.'|'.$ano.'|'.$mes]++;
		$vetor[$local.'|'.$orgao.'|'.$ano.'|'.$mes][$opcao]++;
		$todos++;
	}
	//echo $opcao.substr($nivel,5,3).'<br>';
	//$vetor[$compara][$opcao]++;
	
}
echo '<pre>';
print_r($vetor);
echo '</pre>';
echo '<pre>';
print_r($total_orgao);
echo '</pre>';
echo '<pre>';
print_r($total_local);
echo '</pre>';

echo $todos;
?>
