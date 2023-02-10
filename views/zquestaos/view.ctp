<div class="zquestaos view">
<h2><?php  __('Zquestao');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zquestao['Zquestao']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Regulamento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zquestao['Zquestao']['regulamento']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Referencia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zquestao['Zquestao']['referencia']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zquestao['Zquestao']['item']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Resposta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $zquestao['Zquestao']['resposta']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Zquestao', true), array('action' => 'edit', $zquestao['Zquestao']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Zquestao', true), array('action' => 'delete', $zquestao['Zquestao']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $zquestao['Zquestao']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Zquestaos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Zquestao', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
