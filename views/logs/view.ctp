<div class="logs view">
<h2><?php  __('Log');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['id']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['title']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['created']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Model'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['model']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Model Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['model_id']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Action'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['action']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['usuario_id']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario Nome'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['usuario_nome']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Changes'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['changes']; ?>
			&nbsp;
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ip'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $log['Log']['ip']; ?>
			&nbsp;
		</dt>
	</dl>
</div>
<br>
