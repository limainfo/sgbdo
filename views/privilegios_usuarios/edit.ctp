<div class="privilegiosUsuarios form">
<?php echo $form->create('PrivilegiosUsuario');?>
	<fieldset>
 		<legend><?php __('Edit PrivilegiosUsuario');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('usuario_id');
		echo $form->input('privilegio_id');
	?>
	</fieldset>
<?php echo $form->end('Registrar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Excluir', true), array('action'=>'delete', $form->value('PrivilegiosUsuario.id')), array('class'=>'button'), sprintf(__('Tem certeza que deseja excluir # %s?', true), $form->value('PrivilegiosUsuario.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Exibir PrivilegiosUsuarios', true), array('action'=>'index'),array('class'=>'button'));?></li>
	</ul>
</div>
