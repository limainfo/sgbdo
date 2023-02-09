<div class="especialidadesSetors index">
<h2><?php __('EspecialidadesSetors');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('especialidade_id');?></th>
	<th><?php echo $paginator->sort('setor_id');?></th>
	<th><?php echo $paginator->sort('rotulo_id');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($especialidadesSetors as $especialidadesSetor):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['id']; ?>
		</td>
		<td>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['especialidade_id']; ?>
		</td>
		<td>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['setor_id']; ?>
		</td>
		<td>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['rotulo_id']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action'=>'view', $especialidadesSetor['EspecialidadesSetor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $especialidadesSetor['EspecialidadesSetor']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $especialidadesSetor['EspecialidadesSetor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $especialidadesSetor['EspecialidadesSetor']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New EspecialidadesSetor', true), array('action'=>'add')); ?></li>
	</ul>
</div>
