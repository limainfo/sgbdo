<div class="escalasmonths form">
<?php echo $form->create('Escalasmonth');?>
	<fieldset>
 		<legend><?php __('Add Escalasmonth');?></legend>
	<?php
		echo $form->input('hora_instrucao');
		echo $form->input('efetivo_total');
		echo $form->input('qtd_militares');
		echo $form->input('mes');
		echo $form->input('escala_id');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir Escalasmonths', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Escalas', true), array('controller'=> 'escalas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
