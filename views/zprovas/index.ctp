<div class="zprovas index">
	<h2><?php __('Zprovas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nomeprova');?></th>
			<th><?php echo $this->Paginator->sort('dataprova');?></th>
			<th><?php echo $this->Paginator->sort('indice');?></th>
			<th><?php echo $this->Paginator->sort('respostamarcada');?></th>
			<th><?php echo $this->Paginator->sort('regulamento');?></th>
			<th><?php echo $this->Paginator->sort('referencia');?></th>
			<th><?php echo $this->Paginator->sort('item');?></th>
			<th><?php echo $this->Paginator->sort('resposta');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($zprovas as $zprova):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $zprova['Zprova']['id']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['nomeprova']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['dataprova']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['indice']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['respostamarcada']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['regulamento']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['referencia']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['item']; ?>&nbsp;</td>
		<td><?php echo $zprova['Zprova']['resposta']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $zprova['Zprova']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $zprova['Zprova']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $zprova['Zprova']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $zprova['Zprova']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Zprova', true), array('action' => 'add')); ?></li>
	</ul>
</div>