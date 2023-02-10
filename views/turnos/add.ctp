<div class="turnos form">
<?php echo $form->create('Turno');?>
	<fieldset>
 		<legend><?php __('Add Turno');?></legend>
	<?php
		echo $form->input('escala_id');
		echo $form->input('hora_inicio');
		echo $form->input('hora_terminio');
		echo $form->input('qtd');
		echo $form->input('dt_escala');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir Turnos', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
