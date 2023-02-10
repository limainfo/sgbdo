<?php 
			if ($ok) {
				echo '<p class="message" id="mensagens"><b>Os dados foram gravados.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});HideContent(\'formularios\');</script>';
			} else {
				echo '<p class="message" id="mensagens"><b>Os dados não foram gravados. Por favor, tente novamente.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});</script>';
			}

?>
<table cellpadding="0" cellspacing="0">
<tr style="vertical-align:middle;"><th colspan="20" style="vertical-align:middle;border: 1px solid #000;background-color:#000060;color:#fff;"><center>LISTAGEM DAS PROVAS PARA TESTE OPERACIONAL&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	//echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'width'=> '10 px', 'height'=> '10 px', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
	echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
	?>
</center>
</th></tr>
<tr><th>Ano</th><th>Divisão</th><th>Subdivisão</th><th>Prova</th><th>Especialidade</th><th>Chamada 01</th><th>Chamada 02</th><th>Chamada 03</th><th>Chamada 04</th><th>Ações</th></tr>
	<?php 
$i=0;
		$dados = $this->requestAction('testeopprovasagendadas/externolista');
		foreach($dados as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}><td>{$dado['Testeopprovasagendada']['ano']}</td>";
				echo "<td>{$dado['Testeopprovasagendada']['divisao']}</td>";
				echo "<td>{$dado['Testeopprovasagendada']['subdivisao']}</td>";
				echo "<td>{$dado['Testeopprova']['nm_prova']}</td>";
				echo "<td>{$dado['Especialidade']['nm_especialidade']}</td>";
				echo "<td>{$dado['Testeopprovasagendada']['data_chamada01']}</td>";
				echo "<td>{$dado['Testeopprovasagendada']['data_chamada02']}</td>";
				echo "<td>{$dado['Testeopprovasagendada']['data_chamada03']}</td>";
				echo "<td>{$dado['Testeopprovasagendada']['data_chamada04']}</td>";
				echo "<td>";
				//echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
				echo $ajax->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoedit', $dado['Testeopprovasagendada']['id']),array('escape'=>false, 'update'=>'formularios','method'=>'post', 'with'=>'\'data[id]='.$dado['Testeopprovaagendada']['id'].'&value=help\'' ), null,false);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$dado['Testeopprovasagendada']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$dado['Testeopprovasagendada']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
				echo "<td></td></tr>";
			
		}
				
?>
</table>

