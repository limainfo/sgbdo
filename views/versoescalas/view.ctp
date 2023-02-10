<div class="versoescalas view">
<h2><?php  __('Versoescala');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Escalasmonth Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['escalasmonth_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['item1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['item2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item3'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['item3']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item4'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['item4']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item5'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['item5']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item6'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $versoescala['Versoescala']['item6']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Versoescala', true), array('action'=>'edit', $versoescala['Versoescala']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Versoescala', true), array('action'=>'delete', $versoescala['Versoescala']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $versoescala['Versoescala']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Versoescalas', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Versoescala', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
