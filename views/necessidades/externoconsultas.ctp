<?php

if(!$problema){
	

echo '<p class="message" id="atencao"><b>Consulta concluída.</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 5});window.scroll(0,0);</script>';

	?>
<table cellpadding="0" cellspacing="0" align="center" style="color:black;">
<tr style="vertical-align:middle;">
<th colspan="3" style="vertical-align:middle;border: 1px solid #000;background-color:#000060;color:#fff;">
<center>RELAÇÃO DE MILITARES - Total:<?php echo count($existentes); ?>&nbsp;&nbsp;&nbsp;&nbsp;   Com o curso:<?php echo count($comcurso); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('btsair.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'width'=> '15px', 'height'=> '15px', 'title'=>'Excluir')), array(), array('onclick'=>"this.href='#';HideContent('existentes');return false;",'escape'=>false, 'escape'=>false), null,false); ?></center>
</th></tr>
<tr><th>Nome</th><th>Período do Curso</th><th>Local da realização</th></tr>
	<?php 
$i=0;
		//$testeopprovas = $this->requestAction('testeopprovas/externolista');
		foreach($existentes as $dado){
				$class = ' style="background-color:#fffff;"';
				foreach($comcurso as $possuicurso){
					if($possuicurso['Militar']['id']==$dado['Militar']['id']){
						$class = ' style="background-color:#c0d0f0;"';
						$dado['MilitarsCurso']['periodo']=$possuicurso['MilitarsCurso']['periodo'];
						
					}
				}
				$setor = str_pad($dado['Setor']['sigla_setor'],40,'_');
				echo "<tr><td {$class}>{$setor} {$dado['Posto']['sigla_posto']} {$dado['Quadro']['sigla_quadro']} {$dado['Especialidade']['nm_especialidade']} {$dado['Militar']['nm_completo']}</td>";
				echo "<td {$class}>{$dado['MilitarsCurso']['periodo']}</td>";
				echo "<td {$class}>{$dado['MilitarsCurso']['local_realizacao']}</td>";
				echo "</tr>";
			
		}
				
?>
</table>
<br>	
	<?php 
}else{
echo '<p class="message" id="atencao"><b>Os campos QUADRO, ESPECIALIDADE, UNIDADE, SETOR e CURSO devem ser selecionados .</b></p><script language="javascript">new Effect.Fade(\'atencao\',{delay: 15});window.scroll(0,0);</script>';
	
	
}
?>
<script>
$('existentes').show();
</script>
