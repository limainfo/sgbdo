<div class="afastamentos view">
<h2><?php  __('Afastamento');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($afastamento['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $afastamento['Militar']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Motivo'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $afastamento['Afastamento']['motivo']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Inicio'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $afastamento['Afastamento']['dt_inicio']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Termino'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $afastamento['Afastamento']['dt_termino']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Obs'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $afastamento['Afastamento']['obs']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID Militar Responsável'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $afastamento['Afastamento']['militar_responsavel']; ?>
		</dt>
	</dl>
</div>
<br>
