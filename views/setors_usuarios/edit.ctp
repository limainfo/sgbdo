<div class="setorsUsuarios form">
<?php echo $form->create('SetorsUsuario');?>
	<fieldset>
 		<legend><?php __('Edit SetorsUsuario');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('usuario_id');
		echo $form->input('setor_id');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action'=>'delete', $form->value('SetorsUsuario.id')), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir # %s?', true), $form->value('SetorsUsuario.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Exibir SetorsUsuarios', true), array('action'=>'index'),array('class'=>'button'));?></li>
	</ul>
</div>
