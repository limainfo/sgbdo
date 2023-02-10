<div class="turnos view">
<h2><?php  __('Turno');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Escala'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($turno['Escala']['id'], array('controller'=> 'escalas', 'action'=>'view', $turno['Escala']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hora Inicio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['hora_inicio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hora Terminio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['hora_terminio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qtd'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['qtd']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Escala'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $turno['Turno']['dt_escala']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Turno', true), array('action'=>'edit', $turno['Turno']['id']),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Excluir Turno', true), array('action'=>'delete', $turno['Turno']['id']), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir  # %s?', true), $turno['Turno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Turnos', true), array('action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Turno', true), array('action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
