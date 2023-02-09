<div class="cumprimentoescalas form">
<?php echo $form->create('Cumprimentoescala');?>
	<fieldset>
 		<legend><?php __('Edit Cumprimentoescala');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('escalasmonth_id');
		echo $form->input('dia');
		echo $form->input('turno');
		echo $form->input('previsto');
		echo $form->input('cumprido');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action'=>'delete', $form->value('Cumprimentoescala.id')), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir # %s?', true), $form->value('Cumprimentoescala.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Cumprimentoescalas', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalasmonths', true), array('controller'=> 'escalasmonths', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escalasmonth', true), array('controller'=> 'escalasmonths', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
