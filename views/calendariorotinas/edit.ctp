<div class="calendariorotinas form">
<?php echo $form->create('Calendariorotina');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Calendariorotina');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('rotina_id');
		echo $form->input('rubrica');
		echo $form->input('obs');
		echo $datePicker->picker('dt_inicio_previsto');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<!-- 
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action'=>'delete', $form->value('Calendariorotina.id')), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir # %s?', true), $form->value('Calendariorotina.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Exibir Calendariorotinas', true), array('action'=>'index'),array('class'=>'button'));?></li>
		<li><?php echo $this->Html->link(__('Exibir Rotinas', true), array('controller'=> 'rotinas', 'action'=>'index'),array('class'=>'button')); ?> </li>
		<li><?php echo $this->Html->link(__('Cadastrar Rotina', true), array('controller'=> 'rotinas', 'action'=>'add'),array('class'=>'button')); ?> </li>
	</ul>
</div>
-->