<?php 
echo 'Novo Registro'.$ajax->link($html->image('novodoc.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'add'),array('escape'=>false, 'update'=>'View'), null,false);
?>

<div id='View'></div>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($testeopprovas as $testeopprova):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $testeopprova['Testeopprova']['nm_prova']; ?></td>
		<td class="actions"><?php 
			echo $ajax->link($html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
			echo $ajax->link($html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'edit', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
			?>
		<?php
		echo $html->link($html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$testeopprova['Testeopprova']['nm_prova']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$testeopprova['Testeopprova']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
		?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<br><hr>
