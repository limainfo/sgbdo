<div class="especialidadesSetors view">
<h2><?php  __('EspecialidadesSetor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Especialidade Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['especialidade_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Setor Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['setor_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rotulo Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $especialidadesSetor['EspecialidadesSetor']['rotulo_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit EspecialidadesSetor', true), array('action'=>'edit', $especialidadesSetor['EspecialidadesSetor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete EspecialidadesSetor', true), array('action'=>'delete', $especialidadesSetor['EspecialidadesSetor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $especialidadesSetor['EspecialidadesSetor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List EspecialidadesSetors', true), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New EspecialidadesSetor', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
