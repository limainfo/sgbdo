<div class="cursosSetors view">
<h2><?php  __('CursosSetor');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Curso'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($cursosSetor['Curso']['codigo'], array('controller'=> 'cursos', 'action'=>'view', $cursosSetor['Curso']['id'])); ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($cursosSetor['Setor']['sigla_setor'], array('controller'=> 'setors', 'action'=>'view', $cursosSetor['Setor']['id'])); ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Previsto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cursosSetor['CursosSetor']['previsto']; ?>
			&nbsp;
		</dt>
	</dl>
</div>
<br>
