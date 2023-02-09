<table cellpadding="0" cellspacing="0"><tr><th>Provas</th></tr>
<?php 
$i=0;
		$testeopprovas = $this->requestAction('testeopprovas/externolista');
		foreach($testeopprovas as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}><td>{$dado['Testeopprova']['nm_prova']}</td></tr>";

		}
				
?>
</table>