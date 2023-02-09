<div class="cumprimentoescalas view">
<h2><?php  __('Cumprimentoescala');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cumprimentoescala['Cumprimentoescala']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Escalasmonth'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($cumprimentoescala['Escalasmonth']['id'], array('controller'=> 'escalasmonths', 'action'=>'view', $cumprimentoescala['Escalasmonth']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cumprimentoescala['Cumprimentoescala']['dia']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Turno'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cumprimentoescala['Cumprimentoescala']['turno']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Previsto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cumprimentoescala['Cumprimentoescala']['previsto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cumprido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cumprimentoescala['Cumprimentoescala']['cumprido']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Cumprimentoescala', true), array('action'=>'edit', $cumprimentoescala['Cumprimentoescala']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Cumprimentoescala', true), array('action'=>'delete', $cumprimentoescala['Cumprimentoescala']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $cumprimentoescala['Cumprimentoescala']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Cumprimentoescalas', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Cumprimentoescala', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Escalasmonths', true), array('controller'=> 'escalasmonths', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escalasmonth', true), array('controller'=> 'escalasmonths', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
