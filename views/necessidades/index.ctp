<div class="necessidades index">
	<h2><?php __('Necessidades');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('especialidade_id');?></th>
			<th><?php echo $this->Paginator->sort('sigla_unidade');?></th>
			<th><?php echo $this->Paginator->sort('setor_id');?></th>
			<th><?php echo $this->Paginator->sort('curso_id');?></th>
			<th><?php echo $this->Paginator->sort('necessario');?></th>
			<th><?php echo $this->Paginator->sort('classe');?></th>
			<th><?php echo $this->Paginator->sort('referencia');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($necessidades as $necessidade):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $necessidade['Necessidade']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($necessidade['Especialidade']['nm_especialidade'], array('controller' => 'especialidades', 'action' => 'view', $necessidade['Especialidade']['id'])); ?>
		</td>
		<td><?php echo $necessidade['Necessidade']['sigla_unidade']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($necessidade['Setor']['sigla_setor'], array('controller' => 'setors', 'action' => 'view', $necessidade['Setor']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($necessidade['Curso']['codigo'], array('controller' => 'cursos', 'action' => 'view', $necessidade['Curso']['id'])); ?>
		</td>
		<td><?php echo $necessidade['Necessidade']['necessario']; ?>&nbsp;</td>
		<td><?php echo $necessidade['Necessidade']['classe']; ?>&nbsp;</td>
		<td><?php echo $necessidade['Necessidade']['referencia']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $necessidade['Necessidade']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $necessidade['Necessidade']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $necessidade['Necessidade']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $necessidade['Necessidade']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Necessidade', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Especialidades', true), array('controller' => 'especialidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Especialidade', true), array('controller' => 'especialidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setors', true), array('controller' => 'setors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setor', true), array('controller' => 'setors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cursos', true), array('controller' => 'cursos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curso', true), array('controller' => 'cursos', 'action' => 'add')); ?> </li>
	</ul>
</div>