<div class="turnos form">
<?php echo $form->create('Turno');?>
	<fieldset>
 		<legend><?php __('Add Turno');?></legend>
	<?php
		echo $form->input('nm_turno');
		echo $form->input('inicio_turno');
		echo $form->input('fim_turno');
		echo $form->input('qtd_militares');
		echo $form->input('Escala');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir Turnos', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas Turnos', true), array('controller'=> 'escalas_turnos', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escalas Turnos', true), array('controller'=> 'escalas_turnos', 'action'=>'add'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
