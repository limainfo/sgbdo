<div class="cursosRotulos view">
<h2><?php  __('CursosRotulo');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cursosRotulo['CursosRotulo']['id']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rotulo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($cursosRotulo['Rotulo']['rotulo'], array('controller'=> 'rotulos', 'action'=>'view', $cursosRotulo['Rotulo']['id'])); ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Curso'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($cursosRotulo['Curso']['codigo'], array('controller'=> 'cursos', 'action'=>'view', $cursosRotulo['Curso']['id'])); ?>
			&nbsp;
		</dt>
	</dl>
</div>
<br>
