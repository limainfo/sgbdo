<div class="necessidades form">
<?php echo $this->Form->create('Necessidade');?>
	<fieldset>
 		<legend><?php __('Edit Necessidade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('especialidade_id');
		echo $this->Form->input('sigla_unidade');
		echo $this->Form->input('setor_id');
		echo $this->Form->input('curso_id');
		echo $this->Form->input('divisao_solicitante');
		echo $this->Form->input('necessario');
		echo $this->Form->input('valor_diaria',array('class'=>'formulario'));
		echo $this->Form->input('valor_ajuda_custo',array('class'=>'formulario'));
		echo $this->Form->input('valor_passagem',array('class'=>'formulario'));
		echo $this->Form->input('classe');
		echo $this->Form->input('referencia');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Necessidade.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Necessidade.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Necessidades', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Especialidades', true), array('controller' => 'especialidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Especialidade', true), array('controller' => 'especialidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setors', true), array('controller' => 'setors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setor', true), array('controller' => 'setors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cursos', true), array('controller' => 'cursos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Curso', true), array('controller' => 'cursos', 'action' => 'add')); ?> </li>
	</ul>
</div>