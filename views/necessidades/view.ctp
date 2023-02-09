<div class="necessidades view">
<h2><?php  __('Necessidade');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $necessidade['Necessidade']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Especialidade'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($necessidade['Especialidade']['nm_especialidade'], array('controller' => 'especialidades', 'action' => 'view', $necessidade['Especialidade']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sigla Unidade'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $necessidade['Necessidade']['sigla_unidade']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Setor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($necessidade['Setor']['sigla_setor'], array('controller' => 'setors', 'action' => 'view', $necessidade['Setor']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Curso'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($necessidade['Curso']['codigo'], array('controller' => 'cursos', 'action' => 'view', $necessidade['Curso']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Necessario'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $necessidade['Necessidade']['necessario']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Classe'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $necessidade['Necessidade']['classe']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Referencia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $necessidade['Necessidade']['referencia']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Necessidade', true), array('action' => 'edit', $necessidade['Necessidade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Necessidade', true), array('action' => 'delete', $necessidade['Necessidade']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $necessidade['Necessidade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Necessidades', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Necessidade', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Especialidades', true), array('controller' => 'especialidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Especialidade', true), array('controller' => 'especialidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setors', true), array('controller' => 'setors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setor', true), array('controller' => 'setors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cursos', true), array('controller' => 'cursos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curso', true), array('controller' => 'cursos', 'action' => 'add')); ?> </li>
	</ul>
</div>
