<div class="zprovas form">
<?php echo $this->Form->create('Zprova');?>
	<fieldset>
 		<legend><?php __('Edit Zprova'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nomeprova');
		echo $this->Form->input('dataprova');
		echo $this->Form->input('indice');
		echo $this->Form->input('respostamarcada');
		echo $this->Form->input('regulamento');
		echo $this->Form->input('referencia');
		echo $this->Form->input('item');
		echo $this->Form->input('resposta');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Zprova.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Zprova.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Zprovas', true), array('action' => 'index'));?></li>
	</ul>
</div>