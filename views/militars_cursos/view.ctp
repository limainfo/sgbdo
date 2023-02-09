<div class="militarsCursos view">
<h2><?php  __('MilitarsCurso');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($militarsCurso['Militar']['id'], array('controller'=> 'militars', 'action'=>'view', $militarsCurso['Militar']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Curso'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($militarsCurso['Curso']['codigo'], array('controller'=> 'cursos', 'action'=>'view', $militarsCurso['Curso']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Inicio Curso'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militarsCurso['MilitarsCurso']['dt_inicio_curso']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Fim Curso'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militarsCurso['MilitarsCurso']['dt_fim_curso']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Local Realizacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militarsCurso['MilitarsCurso']['local_realizacao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Documento'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militarsCurso['MilitarsCurso']['documento']; ?>
		</dt>
	</dl>
</div>
<br>
