<div class="militarsEscalas index">
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
		<th><?php echo $paginator->sort('escala_id');?></th>
		<th><?php echo $paginator->sort('militar_id');?></th>
		<th><?php echo $paginator->sort('codigo');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($militarsEscalas as $militarsEscala):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $militarsEscala['MilitarsEscala']['id']; ?></td>
		<td><?php echo $this->Html->link($militarsEscala['Escala']['nm_escala'], array('controller'=> 'escalas', 'action'=>'view', $militarsEscala['Escala']['id'])); ?>
		</td>
		<td><?php echo $this->Html->link($militarsEscala['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $militarsEscala['Militar']['id'])); ?>
		</td>
		<td><?php echo $militarsEscala['MilitarsEscala']['codigo']; ?></td>
		<td class="actions">		<?php
		echo $yahooUi->generateScriptForSimpleDialog('del'.$militarsEscala['MilitarsEscala']['id'], array('body'=>'Tem certeza que deseja excluir # '.$militarsEscala['MilitarsEscala']['id'].' ?'));

		echo $yahooUi->imgForSimpleDialog('del'.$militarsEscala['MilitarsEscala']['id'],'lixo.gif',array('function'=>'delete','id'=>$militarsEscala['MilitarsEscala']['id'])); 
		
		
		?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<br><hr>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>|<?php echo $paginator->numbers();?>|<?php echo $paginator->next(__('Próxima', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
