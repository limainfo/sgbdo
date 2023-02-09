<div class="especialidadesSetors form">
<?php echo $form->create('EspecialidadesSetor');?>
	<fieldset>
 		<legend><?php __('Edit EspecialidadesSetor');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('especialidade_id');
		echo $form->input('setor_id');
		echo $form->input('rotulo_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $form->value('EspecialidadesSetor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('EspecialidadesSetor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List EspecialidadesSetors', true), array('action'=>'index'));?></li>
	</ul>
</div>
