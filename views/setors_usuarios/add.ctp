<div class="setorsUsuarios form">
<?php echo $form->create('SetorsUsuario');?>
	<fieldset>
 		<legend><?php __('Add SetorsUsuario');?></legend>
	<?php
		echo $form->input('usuario_id');
		echo $form->input('setor_id');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Exibir SetorsUsuarios', true), array('action'=>'index'),array('class'=>'button'));?></li>
	</ul>
</div>
