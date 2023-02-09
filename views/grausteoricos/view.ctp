<div class="atividades view">
<h2><?php  __('Grausteorico');?><?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($atividade['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $atividade['Militar']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Orgao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividade['Atividade']['orgao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc Atividade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividade['Atividade']['desc_atividade']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Inicio'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividade['Atividade']['dt_inicio']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Termino'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividade['Atividade']['dt_termino']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Periodo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $atividade['Atividade']['periodo']; ?>
		</dt>
	</dl>
</div>
<br>
