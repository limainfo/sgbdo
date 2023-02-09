<div class="periodicidades index">
<h2><?php __('Periodicidades');?></h2>
<p><?php
$paginator->options(array('update' => 'wrapper', 'indicator' => 'spinner'));
echo $paginator->counter(array(
'format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
		<th><?php echo $paginator->sort('periodicidade');?></th>
		<th><?php echo $paginator->sort('desc_periodicidade');?></th>
		<th><?php echo $paginator->sort('nr_dias');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($periodicidades as $periodicidade):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $periodicidade['Periodicidade']['id']; ?></td>
		<td><?php echo $periodicidade['Periodicidade']['periodicidade']; ?></td>
		<td><?php echo $periodicidade['Periodicidade']['desc_periodicidade']; ?>
		</td>
		<td><?php echo $periodicidade['Periodicidade']['nr_dias']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $periodicidade['Periodicidade']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $periodicidade['Periodicidade']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php
		echo $yahooUi->generateScriptForSimpleDialog('del'.$periodicidade['Periodicidade']['id'], array('body'=>'Tem certeza que deseja excluir # '.$periodicidade['Periodicidade']['periodicidade'].' ?'));

		echo $yahooUi->imgForSimpleDialog('del'.$periodicidade['Periodicidade']['id'],'lixo.gif',array('function'=>'delete','id'=>$periodicidade['Periodicidade']['id'])); 
		
		
		?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200));?> <?php echo $paginator->next(__('Próxima', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
